<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\assertDatabaseCount;

pest()->use(RefreshDatabase::class);

describe('UsersModel', function () {
    it('contrôle que nous avons 5 users', function () {
        $users = User::factory()->count(5)->create();
        expect($users)->toHaveCount(5);
    });

    it('contrôle que les users ont un nom et un email', function () {
        $user = User::factory()->create();
        expect($user->name)->not()->toBeEmpty();
        expect($user->email)->not()->toBeEmpty();
    });

    it('Seeder créé utilisateur Test', function () {
        $user = User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
        ]);
        expect($user->name)->toBe('Test');
        expect($user->email)->toBe('test@example.com');
    });

    it('Seeder créé 10 utilisateurs', function () {
        $this->seed();
        $users = User::all();
        // test user + 10 users de la factory + 10 users créés par la factory des sondages
        assertDatabaseCount('users', 21);
    });

    it('Créer un utilisateur (expect)', function () {
        $user = User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => bcrypt('12345678'),
        ]);
        expect($user->name)->toBe('Test');
        expect($user->email)->toBe('test@example.com');
        expect(\Hash::check('12345678', $user->password))->toBeTrue();
    });

    it('Créer un utilisateur (assertHasData)', function () {
        $user = User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
        ]);
        $this->assertDatabaseHas('users', [
            'name' => 'Test',
            'email' => 'test@example.com',
        ]);
    });

    it('Modifier un utilisateur (expect)', function () {
        $user = User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->update([
            'name' => 'Test Modified',
            'email' => 'testmodified@example.com',
        ]);
        expect($user->name)->toBe('Test Modified');
        expect($user->email)->toBe('testmodified@example.com');
    });

    it('Modifier un utilisateur (assertHasData)', function () {
        $user = User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->update([
            'name' => 'Test Modified',
            'email' => 'testmodified@example.com',
        ]);
        $this->assertDatabaseHas('users', [
            'name' => 'Test Modified',
            'email' => 'testmodified@example.com',
        ]);
    });

    it('Supprimer un utilisateur', function () {
        $user = User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->delete();
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    });
});
