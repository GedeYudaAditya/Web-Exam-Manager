<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if ($user->role == 'mahasiswa') {
            return redirect()->route('mahasiswa.index');
        } elseif ($user->role == 'dosen') {
            return redirect()->route('dosen.index');
        } else {
            return $next($request);
        }
    }
}
