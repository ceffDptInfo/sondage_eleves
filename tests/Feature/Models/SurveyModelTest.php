<?php

use App\Models\Survey;
use App\Models\User;

describe('SurveysModel', function () {
    it('contrôle que nous avons 5 surveys', function () {
        $surveys = Survey::factory()->count(5)->create();
        expect($surveys)->toHaveCount(5);
    });

    it('contrôle que les surveys ont un nom et une description', function () {
        $survey = Survey::factory()->create();
        expect($survey->name)->not()->toBeEmpty();
        expect($survey->description)->not()->toBeEmpty();
        expect($survey->creation_date)->not()->toBeEmpty();
        expect($survey->question)->not()->toBeEmpty();
        expect($survey->user_id)->not()->toBeEmpty();
    });

    it('contrôle le seeding', function () {
        $this->seed();
        $surveys = Survey::all();
        expect($surveys)->toHaveCount(10);
    });
    
    it('Créer un sondage', function () {
        $survey = Survey::factory()->create([
            'name' => 'Sondage 1',
            'description' => 'Description du sondage 1',
            'creation_date' => '2024-06-01',
            'question' => 'Question du sondage 1',
        ]);
        expect($survey->name)->toBe('Sondage 1');
        expect($survey->description)->toBe('Description du sondage 1');
        expect($survey->creation_date)->toBe('2024-06-01');
        expect($survey->question)->toBe('Question du sondage 1');
    });

    it('Modifier un sondage', function () {
        $survey = Survey::factory()->create();
        $survey->update([
            'name' => 'Sondage 2',
            'description' => 'Description du sondage 2',
            'creation_date' => '2024-06-02',
            'question' => 'Question du sondage 2',
        ]);
        expect($survey->name)->toBe('Sondage 2');
        expect($survey->description)->toBe('Description du sondage 2');
        expect($survey->question)->toBe('Question du sondage 2');
        expect($survey->creation_date)->toBe('2024-06-02');
    });

    it('Supprimer un sondage', function () {
        $survey = Survey::factory()->create();
        $survey->delete();
        $this->assertDatabaseMissing('survey', [
            'id' => $survey->id,
        ]);
    });

    it('Vérifie la relation entre Survey et User', function () {
        $user = User::factory()->create();
        $survey = Survey::factory()->create([
            'user_id' => $user->id,
        ]);

        expect($survey->user)->toBeInstanceOf(User::class);
        expect($survey->user->id)->toBe($user->id);
    });
});
