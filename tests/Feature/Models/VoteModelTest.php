<?php

use App\Models\Remark;
use App\Models\Vote;

describe('Votes', function () {
    it('contrôle que nous avons 5 votes', function () {
        $votes = Vote::factory()->count(5)->create();
        expect($votes)->toHaveCount(5);
    });

    it('contrôle que les votes ont un titre et un contenu', function () {
        $vote = Vote::factory()->create();
        expect($vote->type)->not()->toBeEmpty();
        expect($vote->ip_address)->not()->toBeEmpty();
        expect($vote->remark_id)->not()->toBeEmpty();
    });

    it('Créer un vote (expect)', function () {
        $vote = Vote::factory()->create([
            'type' => 'like',
            'ip_address' => '192.168.20.10',
        ]);
        expect($vote->type)->toBe('like');
        expect($vote->ip_address)->toBe('192.168.20.10');

        $this->assertDatabaseHas('vote', [
            'type' => 'like',
            'ip_address' => '192.168.20.10',
        ]);
    });

    it('Créer un vote (assertHasData)', function () {
        Vote::factory()->create([
            'type' => 'like',
            'ip_address' => '192.168.20.10',
        ]);

        $this->assertDatabaseHas('vote', [
            'type' => 'like',
            'ip_address' => '192.168.20.10',
        ]);
    });

    it('Vérifie la relation entre Vote et Remark', function () {
        $remark = Remark::factory()->create();
        $vote = Vote::factory()->create([
            'remark_id' => $remark->id,
        ]);

        expect($vote->remark)->toBeInstanceOf(Remark::class);
        expect($vote->remark->remark_id)->toBe($remark->remark_id);
    });
});
