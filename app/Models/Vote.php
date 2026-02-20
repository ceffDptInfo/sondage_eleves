<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $table = 'vote';

    protected $fillable = [
        'type',
        'ip_address',
        'session_id',
    ];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
