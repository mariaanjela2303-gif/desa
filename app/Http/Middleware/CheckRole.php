<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('warning', 'Silakan login terlebih dahulu.');
        }

        $user = auth()->user();

        if (!in_array($user->role, $roles, true)) {
            // Jika admin mencoba masuk ke kades atau kades mencoba masuk ke admin
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('error', 'Halaman tersebut khusus akun Kepala Desa.');
            }
            if ($user->isKepalaDesa()) {
                return redirect()->route('kepaladesa.dashboard')->with('error', 'Akses ditolak: Kepala Desa hanya memiliki hak akses pemantauan (monitoring).');
            }
            abort(403, 'Akses Ditolak: Anda tidak memiliki izin untuk membuka halaman ini.');
        }

        return $next($request);
    }
}
