<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function connection(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|integer|exists:session,code',
            'password' => 'required|string|max:255',
        ]);

        $session = Session::where('code', $validatedData['code'])->first();

        if ($session->password && $session->password !== $validatedData['password']) {
            return response()->json(['message' => 'Mot de passe incorrect'], 401);
        }

        return response()->json(['message' => 'Connexion réussie', 'session' => $session]);
        
    }

    public function accessToSurvey(Request $request, $code)
    {
        $session = Session::where('code', $code)->first();

        if (!$session) {
            return response()->json(['message' => 'Code de session invalide'], 404);
        }

        return response()->json(['message' => 'Accès au sondage réussi', 'session' => $session]);
    }
}
