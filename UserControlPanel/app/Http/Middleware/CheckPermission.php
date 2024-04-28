<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        $user = $request->user();
        $adminLevel = $user->adminLevel; // Ensure this attribute exists and is correct

        // Check if user's adminLevel is less than the required level
        if ($adminLevel < $requiredLevel) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
