<?php

use App\Models\Remark;
use App\Models\Session;

describe('Remarks', function () {
    it('contrôle que nous avons 5 remarques', function () {
        $remarks = Remark::factory()->count(5)->create();
        expect($remarks)->toHaveCount(5);
    });

    it('contrôle que les remarques ont un titre et un contenu', function () {
        $remark = Remark::factory()->create();
        expect($remark->value)->not()->toBeEmpty();
        expect($remark->status)->not()->toBeEmpty();
        expect($remark->private)->not()->toBeEmpty();
        expect($remark->ip_address)->not()->toBeEmpty();
    });

    it('Créer une remarque (expect)', function () {
        $remark = Remark::factory()->create([
            'value' => 'Ceci est une remarque de test',
            'status' => 'positive',
            'private' => false,
            'ip_address' => '192.168.20.10',
        ]);
        expect($remark->value)->toBe('Ceci est une remarque de test');
        expect($remark->status)->toBe('positive');
        expect($remark->private)->toBeFalse();
        expect($remark->ip_address)->toBe('192.168.20.10');

        $this->assertDatabaseHas('remark', [
            'value' => 'Ceci est une remarque de test',
            'status' => 'positive',
            'private' => false,
            'ip_address' => '192.168.20.10',
        ]);
    });

    it('Créer une remarque (assertHasData)', function () {
        $remark = Remark::factory()->create([
            'value' => 'Ceci est une remarque de test',
            'status' => 'positive',
            'private' => false,
            'ip_address' => '192.168.20.10',
        ]);

        $this->assertDatabaseHas('remark', [
            'value' => 'Ceci est une remarque de test',
            'status' => 'positive',
            'private' => false,
            'ip_address' => '192.168.20.10',
        ]);
    });

    it('Vérifie la relation entre Remark et Session', function () {
        $session = Session::factory()->create();
        $remark = Remark::factory()->create([
            'session_id' => $session->id,
        ]);

        expect($remark->session)->toBeInstanceOf(Session::class);
        expect($remark->session->id)->toBe($session->id);
    });
});