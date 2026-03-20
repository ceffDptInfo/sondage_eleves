<?php

use App\Models\Remark;
use App\Models\Session;
use App\Models\Survey;
use App\Models\User;
use App\Models\Vote;

describe('Students.Survey', function () {
    beforeeach(function () {
        $this->user = User::factory()->create();
        $this->survey = Survey::factory()->create([
            'user_id' => $this->user->id,
        ]);
        $this->session = Session::factory()->create([
            'code' => 123456,
            'password' => '1234',
            'survey_id' => $this->survey->id,
        ]);
    });

    it('contrôle la récupération des remarques', function () {
        Remark::factory(10)->create([
            'session_id' => $this->session->id,
        ]);

        $response = $this->actingAs($this->user)->withSession([
            'student_session_code' => $this->session->code,
        ])->get(route('students.get_remarks', ['code' => $this->session->code]));

        $response->assertStatus(200);
        $response->assertJsonCount(10, 'remarks');
    });

    it('contrôle le post de remarques', function () {
        $response = $this->actingAs($this->user)->withSession([
            'student_session_code' => $this->session->code,
        ])->post(route('students.post_remark', ['code' => $this->session->code]), [
            'value' => 'Test remark',
            'status' => 'positive',
            'private' => false,
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Remarque ajoutée avec succès']);
        $response->assertJsonStructure(['remark' => ['id', 'session_id', 'value', 'status', 'private', 'ip_address', 'created_at', 'updated_at']]);
        $response->assertJsonFragment(['value' => 'Test remark', 'status' => 'positive', 'private' => false]);
    });

    it('contrôle la récupération des votes', function () {
        Remark::factory()->create([
            'session_id' => $this->session->id,
        ]);

        Vote::factory(10)->create([
            'remark_id' => $this->session->id,
        ]);

        $response = $this->actingAs($this->user)->withSession([
            'student_session_code' => $this->session->code,
        ])->get(route('students.get_votes', ['code' => $this->session->code]));

        $response->assertStatus(200);
        $response->assertJsonCount(10, 'votes');
    });

    it('contrôle le post de vote', function () {
        $remark = Remark::factory()->create([
            'session_id' => $this->session->id,
        ]);
        $response = $this->actingAs($this->user)->withSession([
            'student_session_code' => $this->session->code,
        ])->post(route('students.post_vote', ['id' => $remark->id]), [
            'type' => 'like',
            'ip_address' => request()->ip(),
            'session_id' => $this->session->id,
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Remarque votée avec succès']);

        $vote = Vote::latest()->first();
        expect($vote->type)->toBe('like');
        expect($vote->ip_address)->toBe(request()->ip());
        expect($vote->remark_id)->toBe($remark->id);
    });

    it('contrôle la récupération de session', function () {
        $response = $this->actingAs($this->user)->withSession([
            'student_session_code' => $this->session->code,
        ])->get(route('students.get_session', ['code' => $this->session->code]));

        $response->assertStatus(200);
        $response->assertJson([
            'session' => [
                'id' => $this->session->id,
                'status' => $this->session->status,
                'class' => $this->session->class,
                'remark' => $this->session->remark,
                'code' => $this->session->code,
                'password' => $this->session->password,
                'survey_id' => $this->session->survey_id,
            ],
        ]);
    });
});
