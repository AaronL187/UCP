<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Characters;
use App\Models\User;

/**
 * Get the active character ID for the currently authenticated user.
 *
 * @return int|null
 */
function getActiveCharacterId()
{
    $user = Auth::user();
    return $user ? $user->getActiveCharacterId() : null;
}
