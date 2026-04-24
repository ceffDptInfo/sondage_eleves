<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function connection(Request $request, $code = null)
    {
        if ($code) {
            $request->merge(['code' => $code]);
        }
        $messages = [
            'code.required' => 'Le code de session est requis.',
        ];

        $validatedData = $request->validate([
            'code' => 'required|integer',
        ], $messages);

        $session = Session::where('code', $validatedData['code'])->first();

        if (! $session) {
            return response()->json(['message' => 'Session non trouvée.'], 404);
        }

        if ($session->status === 'completed') {
            return response()->json(['message' => 'Cette session est terminée.'], 403);
        }

        $request->session()->put('student_session_code', $validatedData['code']);
        $request->session()->put('student_session_id', $session->id);
        $request->session()->put('student_authentificated', 'true');
        $request->session()->save();

        return redirect()->route('students.access_survey', ['code' => $validatedData['code']], 302);
    }
}
