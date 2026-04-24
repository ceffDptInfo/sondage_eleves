<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'session';

    protected $fillable = [
        'status',
        'class',
        'remark',
        'code',
        'survey_id',
    ];

    public function remarks()
    {
        return $this->hasMany(Remark::class);
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
