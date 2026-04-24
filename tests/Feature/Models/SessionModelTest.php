<?php

use App\Models\Session;
use App\Models\Survey;

describe('SessionsModel', function () {
    it('contrôle que nous avons 5 sessions', function () {
        $sessions = Session::factory()->count(5)->create();
        expect($sessions)->toHaveCount(5);
    });

    it('contrôle que les sessions ont un nom et une description', function () {
        $session = Session::factory()->create();
        expect($session->status)->not()->toBeEmpty();
        expect($session->code)->not()->toBeEmpty();
        expect($session->survey_id)->not()->toBeEmpty();
    });

    it('Créer une session', function () {
        $session = Session::factory()->create([
            'status' => 'active',
            'code' => 156236,
        ]);
        expect($session->status)->toBe('active');
        expect($session->code)->toBe(156236);
    });

    it('Supprimer une session', function () {
        $session = Session::factory()->create();
        $session->delete();
        $this->assertDatabaseMissing('session', [
            'id' => $session->id,
        ]);
    });

    it('Vérifie la relation entre Session et Survey', function () {
        $survey = Survey::factory()->create();
        $session = Session::factory()->create([
            'survey_id' => $survey->id,
        ]);

        expect($session->survey)->toBeInstanceOf(Survey::class);
        expect($session->survey->id)->toBe($survey->id);
    });
});
