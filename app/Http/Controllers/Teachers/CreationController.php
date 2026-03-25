<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;

class CreationController extends Controller
{
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Le nom du sondage est requis.',
            'name.string' => 'Le nom du sondage doit être une chaîne de caractères.',
            'name.max' => 'Le nom du sondage ne doit pas dépasser 255 caractères.',
            'creation_date.required' => 'La date de création est requise.',
            'creation_date.date' => 'La date de création doit être une date valide.',
            'description.string' => 'La description du sondage doit être une chaîne de caractères.',
            'question.required' => 'La question du sondage est requise.',
            'question.string' => 'La question du sondage doit être une chaîne de caractères.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'creation_date' => 'required|date',
            'question' => 'required|string',
            'description' => 'nullable|string',
        ], $messages);

        $validatedData['user_id'] = auth()->id();

        $survey = Survey::create($validatedData);

        return response()->json(['message' => 'Sondage créé avec succès', 'survey' => $survey], 201);
    }
}
