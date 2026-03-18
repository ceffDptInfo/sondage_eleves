<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Archives;
use App\Models\Session;
use App\Models\Survey;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProbeController extends Controller
{
    public function setUp(Request $request)
    {
        if (Survey::find($request->survey_id)->user_id !== auth()->id()) {
            return response()->json(['message' => 'Vous n\'êtes pas autorisé à configurer une session pour ce sondage.'], 403);
        }

        $messages = [
            'survey_id.required' => 'L\'ID du sondage est requis.',
            'survey_id.exists' => 'Le sondage spécifié n\'existe pas.',
            'status.required' => 'Le statut de la session est requis.',
            'status.in' => 'Le statut doit être "active".',
            'class.string' => 'La classe doit être une chaîne de caractères.',
            'class.max' => 'La classe ne doit pas dépasser 255 caractères.',
            'remark.string' => 'La remarque doit être une chaîne de caractères.',
            'remark.max' => 'La remarque ne doit pas dépasser 1000 caractères.',
            'code.required' => 'Le code de session est requis.',
            'code.integer' => 'Le code de session doit être un entier.',
            'code.unique' => 'Le code de session doit être unique.',
            'password.required' => 'Le mot de passe est requis.',
            'password.string' => 'Le mot de passe doit être une chaîne de caractères.',
            'password.max' => 'Le mot de passe ne doit pas dépasser 255 caractères.',
        ];

        $validatedData = $request->validate([
            'survey_id' => 'required|exists:survey,id',
            'status' => 'required|in:active',
            'class' => 'nullable|string|max:255',
            'remark' => 'nullable|string|max:1000',
            'code' => 'required|integer|unique:sessions,code',
            'password' => 'required|string|max:255',
        ], $messages);

        $session = Session::create($validatedData);

        return response()->json(['message' => 'Session créée avec succès', 'session' => $session], 201);
    }

    public function getById($id)
    {
        $session = Session::findOrFail($id);

        return response()->json($session);
    }

    public function complete($id)
    {
        $session = Session::findOrFail($id);
        $session->status = 'completed';
        $session->save();

        return response()->json(['message' => 'Sondage terminé avec succès', 'session' => $session]);
    }

    public function getResults($id)
    {
        $session = Session::findOrFail($id);
        $remarks = $session->remarks()->with('votes')->get();   

        return response()->json($remarks);
    }

    public function getSurveyById($id)
    {
        $survey = Survey::findOrFail($id);

        return response()->json($survey);
    }

    public function closeSession($id)
    {
        $session = Session::findOrFail($id);
        $survey = Survey::findOrFail($session['survey_id']);
        $remarks = $session->remarks()->with('votes')->get();
        $user = User::findOrFail($survey['user_id']);

        $dataPdf = [
            'survey' => $survey,
            'session' => $session,
            'remarks' => $remarks,
            'date' => now()->format('d/m/Y H:i:s'),
        ];

        $pdf = $this->generatePdf($dataPdf);
        $filename = 'archive_' . time() . '.pdf';
        $path = 'archives/' . $filename;
        Storage::disk('public')->put($path, $pdf->output());

        $dataArchive = [
            'file_name' => $filename,
            'adding_date' => now(),
            'teacher_name' => $user['name'],
            'teacher_email' => $user['email'],
            'survey_name' => $survey['name'],
            'survey_description' => $survey['description'],
            'survey_question' => $survey['question'],
            'session_class' => $session['class'],
            'session_remark' => $session['remark'],
        ];

        $this->saveArchive($dataArchive);

        $session->delete();

        return response()->json(['message' => 'Session clôturée et archivée avec succès', 'archive' => $dataArchive]);
    }

    public function generatePdf($data)
    {
        $pdf = Pdf::loadView('result_survey_pdf', $data);
        return $pdf;
    }

    public function saveArchive($data)
    {
        Archives::create($data);
    }
}
