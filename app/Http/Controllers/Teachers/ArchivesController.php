<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Archives;
use Illuminate\Http\Request;

class ArchivesController extends Controller
{
    public function getArchives(Request $request)
    {
        $teacher = $request->user();
        $archives = Archives::where('teacher_name', $teacher->name)->get();

        return response()->json($archives);
    }
}
