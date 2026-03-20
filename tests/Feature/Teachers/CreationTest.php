<?php

use App\Models\User;

describe('Teachers.Creation', function () {
    it('contrôle la création d un nouveau sondage', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('survey.store'), [
            'name' => 'Sondage de test',
            'creation_date' => '2024-01-01',
            'description' => 'Description du sondage de test',
            'question' => 'Quelle est votre couleur préférée ?',
        ]);
        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'Sondage créé avec succès',
            'survey' => [
                'name' => 'Sondage de test',
                'creation_date' => '2024-01-01',
                'description' => 'Description du sondage de test',
                'question' => 'Quelle est votre couleur préférée ?',
            ],
        ]);
    });
});
