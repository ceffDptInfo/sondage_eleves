<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'creation_date' => 'required|date',
            'description' => 'nullable|string',
            'question' => 'required|string',
        ]);

        $validatedData['user_id'] = auth()->id();

        $survey = Survey::create($validatedData);

        return response()->json(['message' => 'Sondage créé avec succès', 'survey' => $survey], 201);
    }

    public function get($id)
    {
        $survey = Survey::findOrFail($id);
        return response()->json($survey);
    }
}
