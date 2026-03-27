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

    public function destroy($id)
    {
        $survey = Survey::findOrFail($id);

        if ($survey->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $survey->delete();

        return response()->json(['message' => 'Sondage supprimé avec succès.']);
    }
}
