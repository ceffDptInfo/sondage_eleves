<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class ProbeController extends Controller
{
    public function setUp(Request $request)
    {
        $validatedData = $request->validate([
            'survey_id' => 'required|exists:survey,id',
            'status' => 'required|in:created',
            'class' => 'required|string|max:255',
            'remark' => 'nullable|string|max:1000',
        ]);

        $survey = Session::create($validatedData);

        return response()->json(['message' => 'Sondage configuré avec succès']);
    }
}
