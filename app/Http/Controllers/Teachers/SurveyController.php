<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Le nom du sondage est requis.',
            'name.string' => 'Le nom du sondage doit être une chaîne de caractères.',
            'name.max' => 'Le nom du sondage ne doit pas dépasser 255 caractères.',
            'creation_date.required' => 'La date de création est requise.',
            'creation_date.date' => 'La date de création doit être une date valide.',
            'description.required' => 'La description est requise.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'question.required' => 'La question du sondage est requise.',
            'question.string' => 'La question du sondage doit être une chaîne de caractères.',
        ];

         $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'creation_date' => 'required|date',
            'description' => 'required|string',
            'question' => 'required|string',
        ], $messages);

        $validatedData['user_id'] = auth()->id();

        $survey = Survey::create($validatedData);

        return response()->json(['message' => 'Sondage créé avec succès', 'survey' => $survey], 201);
    }

    public function getByTeacher()
    {
        $surveys = Survey::where('user_id', auth()->id())->get();
        return response()->json($surveys);
    }

    public function getById($id)
    {
        $survey = Survey::findOrFail($id);
        return response()->json($survey);
    }
}
