<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archives extends Model
{
    protected $fillable = [
        'document',
        'file_name',
        'adding_date',
        'teacher_name',
        'teacher_email',
        'survey_name',
        'survey_description',
        'survey_question',
        'session_class',
        'session_remark',
    ];
}
