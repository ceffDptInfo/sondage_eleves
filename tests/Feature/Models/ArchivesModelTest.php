<?php

use App\Models\Archives;

describe('ArchivesModel', function () {
    it('contrôle que les archives ont un nom de fichier et une date d\'ajout', function () {
        $archive = Archives::factory()->create();
        expect($archive->file_name)->not()->toBeEmpty();
        expect($archive->adding_date)->not()->toBeEmpty();
        expect($archive->teacher_name)->not()->toBeEmpty();
        expect($archive->teacher_email)->not()->toBeEmpty();
        expect($archive->survey_name)->not()->toBeEmpty();
        expect($archive->survey_description)->not()->toBeEmpty();
        expect($archive->survey_question)->not()->toBeEmpty();
        expect($archive->session_class)->not()->toBeEmpty();
        expect($archive->session_remark)->not()->toBeEmpty();
    });

    it('Créer une archive', function () {
        $archive = Archives::factory()->create([
            'file_name' => 'archive_test.pdf',
            'adding_date' => now(),
            'teacher_name' => 'John Doe',
            'teacher_email' => 'john.doe@example.com',
            'survey_name' => 'Sondage de test',
            'survey_description' => 'Description du sondage de test',
            'survey_question' => 'Question du sondage de test',
            'session_class' => 'Classe de test',
            'session_remark' => 'Remarque de test',
        ]);
        expect($archive->file_name)->toBe('archive_test.pdf');
        expect($archive->teacher_name)->toBe('John Doe');
        expect($archive->teacher_email)->toBe('john.doe@example.com');
        expect($archive->survey_name)->toBe('Sondage de test');
        expect($archive->survey_description)->toBe('Description du sondage de test');
        expect($archive->survey_question)->toBe('Question du sondage de test');
        expect($archive->session_class)->toBe('Classe de test');
        expect($archive->session_remark)->toBe('Remarque de test');
    });
});
