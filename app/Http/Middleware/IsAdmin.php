<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ($user->role !== 'admin' && ! ($user->is_admin ?? false))) {
            abort(403, 'Akses ditolak. Hanya admin yang bisa mengakses.');
        }

        return $next($request);
    }
}
