<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getByTeacher()
    {
        $surveys = Survey::where('user_id', auth()->id())->get();

        return response()->json($surveys);
    }

    // public function getById($id)
    // {
    //     $survey = Survey::findOrFail($id);

    //     return response()->json($survey);
    // }
}
