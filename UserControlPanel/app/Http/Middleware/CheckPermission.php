<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $requiredLevel)
    {
        $user = Auth::user(); // Get the currently authenticated user object

        if (!$user) {
            abort(403, 'Hozzáférés megtagadva!'); // No user is authenticated
        }

        $adminlevel = $user->adminlevel; // Ensure this attribute exists and is correct
        // Check if user's adminLevel is less than the required level
        if ($adminlevel < $requiredLevel) {
            abort(403, 'Hozzáférés megtagadva!'); // Return 403 Forbidden response
        }

        return $next($request);
    }

}
