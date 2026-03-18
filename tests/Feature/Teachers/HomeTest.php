<?php

use App\Models\User;
use App\Models\Survey;

describe('Home', function () {
    it('contrôle la récupération des sondages', function () {
        $user = User::factory()->create();
        Survey::factory()->create([
            'user_id' => $user->id,
            'name' => 'Sondage de test',
            'description' => 'Description du sondage de test',
            'question' => 'Quelle est votre couleur préférée ?',
        ]);

        $response = $this->actingAs($user)->get(route('survey.get'));
        $response->assertStatus(200)
                 ->assertJsonFragment([
                        'user_id' => $user->id,
                        'name' => 'Sondage de test',
                        'description' => 'Description du sondage de test',
                        'question' => 'Quelle est votre couleur préférée ?',
                 ]);
    });
});