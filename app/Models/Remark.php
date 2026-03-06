<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    use HasFactory;

    protected $table = 'remark';

    protected $fillable = [
        'value',
        'status',
        'private',
        'ip_address',
        'session_id',
    ];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
