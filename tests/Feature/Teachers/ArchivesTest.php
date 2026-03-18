<?php

use App\Models\Archives;
use App\Models\User;

describe('Archives', function () {
    it('contrôle le listing des archives', function () {
        $user = User::factory()->create();
        Archives::factory()->create([
            'file_name' => 'archive_test.pdf',
            'adding_date' => '2024-01-01',
            'teacher_name' => $user->name,
            'teacher_email' => $user->email,
            'survey_name' => 'Sondage de test',
            'survey_description' => 'Description du sondage de test',
            'survey_question' => 'Quelle est votre couleur préférée ?',
            'session_class' => 'Classe de test',
            'session_remark' => 'Remarque de test',
        ]);

        $response = $this->actingAs($user)->get(route('teachers.archives.list'));
        $response ->assertStatus(200)
                 ->assertJsonFragment([
                        'file_name' => 'archive_test.pdf',
                        'adding_date' => '2024-01-01',
                        'teacher_name' => $user->name,
                        'teacher_email' => $user->email,
                        'survey_name' => 'Sondage de test',
                        'survey_description' => 'Description du sondage de test',
                        'survey_question' => 'Quelle est votre couleur préférée ?',
                        'session_class' => 'Classe de test',
                        'session_remark' => 'Remarque de test',
                 ]);
    });
});
