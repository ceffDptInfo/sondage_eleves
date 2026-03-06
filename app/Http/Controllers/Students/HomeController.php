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

        if (! $session) {
            return response()->json(['message' => 'Session non trouvée'], 404);
        }

        if($session->status === 'completed') {
            return response()->json(['message' => 'Cette session est terminée'], 403);
        }

        if ($session->password && $session->password !== $validatedData['password']) {
            return response()->json(['message' => 'Mot de passe incorrect'], 401);
        }

        $request->session()->put('student_session_code', $validatedData['code']);
        $request->session()->put('student_session_id', $session->id);
        $request->session()->put('student_authentificated', 'true');
        $request->session()->save();
        $request->session()->regenerate();

        return response()->json(['message' => 'Connexion réussie', 'session' => $session]);
    }
}
