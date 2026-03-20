<?php

use App\Models\User;
use App\Models\Session;
use App\Models\Survey;

describe('Students.Home', function () {
    it('contrôle la connection à la session de sondage', function () {
        $user = User::factory()->create();
        Survey::factory()->create([
            'user_id' => $user->id,
            'name' => 'Sondage de test',
            'description' => 'Description du sondage de test',
            'question' => 'Quelle est votre couleur préférée ?',
        ]);
        Session::factory()->create([
            'code' => 123456,
            'password' => '1234',
            'status' => 'active',
        ]);

        $response = $this->actingAs($user)->post(route('students.connection'), [
            'code' => 123456,
            'password' => '1234',
        ]);
        $response->assertStatus(200)->assertJson(['message' => 'Connexion réussie']);
        $_SESSION = session()->all();
        expect($_SESSION['student_session_code'])->toBe(123456);
        expect($_SESSION['student_session_id'])->toBe(Session::where('code', 123456)->first()->id);
        expect($_SESSION['student_authentificated'])->toBe('true');
    });
});