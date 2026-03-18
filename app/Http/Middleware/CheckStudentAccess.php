<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStudentAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $codes = Session::pluck('code')->toArray();
        if (!in_array($request->code, $codes)) {
            abort(404, 'Session non trouvée');
        } 
        else {
            $session = Session::where('code', $request->code)->first();
            if ($request->session()->get('student_authentificated') !== 'true' || $request->session()->get('student_session_code') !== $request->code) {
                abort(403, 'Accès non autorisé');
            }
        }
        return $next($request);
    }
}
