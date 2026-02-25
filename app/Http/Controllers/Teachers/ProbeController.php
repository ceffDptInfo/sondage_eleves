<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Session;

class ProbeController extends Controller
{
    public function setUp(Request $request)
    {
        $validatedData = $request->validate([
            'survey_id' => 'required|exists:survey,id',
            'status' => 'required|in:created',
            'class' => 'nullable|string|max:255',
            'remark' => 'nullable|string|max:1000',
            'code' => 'required|integer|unique:sessions,code',
            'password' => 'nullable|string|max:255',
        ]);

        $session = Session::create($validatedData);

        return response()->json(['message' => 'Sondage configuré avec succès', 'session' => $session]);
    }

    public function getById($id)
    {
        $session = Session::findOrFail($id);
        return response()->json($session);
    }
}
