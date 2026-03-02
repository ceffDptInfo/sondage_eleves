<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Remark;
use App\Models\Session;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function getRemarks(Request $request, $code)
    {
        $session = Session::where('code', $code)->first();

        if (! $session) {
            return response()->json(['message' => 'Session non trouvée'], 404);
        }

        if ($request->session()->get('student_session_code') !== $code) {
            return response()->json(['message' => 'Accès non autorisé à cette session'], 403);
        }

        $messages = $session->remarks()->orderBy('created_at', 'desc')->get();

        return response()->json(['messages' => $messages]);
    }

    public function postRemark(Request $request, $code)
    {
        $session = Session::where('code', $code)->first();

        if (! $session) {
            return response()->json(['message' => 'Session non trouvée'], 404);
        }

        if ($request->session()->get('student_session_code') !== $code) {
            return response()->json(['message' => 'Accès non autorisé à cette session'], 403);
        }

        $validatedData = $request->validate([
            'value' => 'required|string|max:255',
            'status' => 'required|string|in:positive,negative',
            'private' => 'required|boolean',
        ]);

        $validatedData['ip_address'] = $request->ip();
        $validatedData['session_id'] = $session->id;

        $remark = Remark::create($validatedData);

        return response()->json(['message' => 'Remarque ajoutée avec succès', 'remark' => $remark]);
    }
}
