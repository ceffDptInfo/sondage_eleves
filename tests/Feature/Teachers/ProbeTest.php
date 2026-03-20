<?php

use App\Models\Archives;
use App\Models\User;
use App\Models\Session;
use App\Models\Survey;
use App\Models\Remark;

describe('Teachers.Probe', function () {
    beforeeach(function () {
        $this->user = User::factory()->create();
        $this->survey = Survey::factory()->create(['id' => 1, 'user_id' => $this->user->id]);
    });

    it('contrôle la création d\'une session', function () {
        $response = $this->actingAs($this->user)->post(route('probe.session.store'), [
            'status' => 'active',
            'class' => 'Classe de test',
            'remark' => 'Remarque de test',
            'code' => 123456,
            'password' => 'motdepasse',
            'survey_id' => 1,
        ]
        );

        $response->assertStatus(201);
    });

    it('contrôle la récupération de session via l\'id', function () {
        $session = Session::factory()->create([
            'id' => 1,
            'status' => 'active',
            'class' => 'Classe de test',
            'remark' => 'Remarque de test',
            'code' => 123456,
            'password' => 'motdepasse',
            'survey_id' => 1,
        ]);

        $response = $this->actingAs($this->user)->get(route('probe.session.get', ['id' => $session->id]));
        $response ->assertJson([
            'id' => $session->id,
            'status' => $session->status,
            'class' => $session->class,
            'remark' => $session->remark,
            'code' => $session->code,
            'password' => $session->password,
            'survey_id' => $session->survey_id,
        ]);

        $response->assertStatus(200);
    });

    it('contrôle la fermeture d\'une session', function () {
        $session = Session::factory()->create([
            'id' => 1,
            'survey_id' => 1,
        ]);

        $response = $this->actingAs($this->user)->patch(route('probe.session.complete', ['id' => $session->id]));

        $session->refresh();
        expect($session->status)->toBe('completed');

        $response->assertStatus(200);
    });

    it('contrôle la récupération des résultats d\'une session', function () {
        $session = Session::factory()->create([
            'id' => 1,
            'survey_id' => 1,
        ]);

        Remark::factory(10)->create(['session_id' => $session->id]);

        $response = $this->actingAs($this->user)->get(route('probe.session.results', ['id' => $session->id]));
        $response->assertJsonCount(10);

        $response->assertStatus(200);
    });

    it('contrôle la récupération d\'un sondage via l\'id', function () {
        $response = $this->actingAs($this->user)->get(route('survey.get.by_id', ['id' => 1]));
        $response->assertJson([
            'id' => 1,
            'user_id' => $this->user->id,
        ]);

        $response->assertStatus(200);
    });

    it('contrôle la fermeture d\'une session et la génération du PDF', function () {
        $session = Session::factory()->create([
            'id' => 1,
            'survey_id' => 1,
        ]);

        Remark::factory(10)->create(['session_id' => $session->id]);

        $archivesBefore = Storage::disk('public')->files('archives');

        $response = $this->actingAs($this->user)->get(route('probe.session.generatePdf', ['id' => $session->id]));
        
        $archivesAfter = Storage::disk('public')->files('archives');
        expect(count($archivesAfter))->toBeGreaterThan(count($archivesBefore));

        $archive = Archives::latest()->first();

        expect($archive->file_name)->toContain('archive_');
        expect($archive->file_name)->toContain('.pdf');
        expect($archive->teacher_name)->toBe($this->user->name);
        expect($archive->survey_name)->toBe($session->survey->name);
        expect($archive->survey_description)->toBe($session->survey->description);
        expect($archive->survey_question)->toBe($session->survey->question);

        $response->assertStatus(200);
    });
});
