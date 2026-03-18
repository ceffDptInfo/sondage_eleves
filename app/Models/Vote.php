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
        'remark_id',
    ];

    public function remark()
    {
        return $this->belongsTo(Remark::class, 'remark_id');
    }
}
