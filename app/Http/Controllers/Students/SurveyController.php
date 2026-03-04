<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Remark;
use App\Models\Session;
use App\Models\Vote;
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

        $remarks = $session->remarks()->orderBy('created_at', 'desc')->get();

        return response()->json(['remarks' => $remarks]);
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

    public function getVotes(Request $request, $code) {
        $session = Session::where('code', $code)->first();

        if (! $session) {
            return response()->json(['message' => 'Session non trouvée'], 404);
        }

        if ($request->session()->get('student_session_code') !== $code) {
            return response()->json(['message' => 'Accès non autorisé à cette session'], 403);
        }

        $votes = Vote::whereIn('remark_id', $session->remarks()->pluck('id'))->get(); // wherein methode pour supprimer les éléments non conformes de la liste
        // pluck permet de récupérer une liste d'id de remarque associée à la session, puis on récupère tous les votes associés à ces remarques

        return response()->json(['votes' => $votes]);
    }

    public function vote(Request $request, $id) {
        $remark = Remark::where('id', $id)->first();

        if (!$remark) {
            return response()->json(['message' => 'Session ou remarque non trouvée'], 404);
        }

        $validatedData = $request->validate([
            'type' => 'required|string|in:like,dislike',
        ]);

        $validatedData['ip_address'] = $request->ip();
        $validatedData['remark_id'] = $remark->id;

        if (Vote::where('ip_address', request()->ip())->where('remark_id', $remark->id)->where('type', $validatedData['type'])->exists()) {
            return response()->json(['message' => 'Vous avez déjà voté pour cette remarque'], 400);
        } elseif (Vote::where('ip_address', request()->ip())->where('remark_id', $remark->id)->exists()) {
            Vote::where('ip_address', request()->ip())->where('remark_id', $remark->id)->update(['type' => $validatedData['type']]);
        } else {
            Vote::create($validatedData);
        }

        return response()->json(['message' => 'Remarque votée avec succès']);
    }
}
