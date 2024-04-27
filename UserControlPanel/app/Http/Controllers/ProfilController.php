<?php

namespace App\Http\Controllers;

use App\Models\Characters;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the authenticated user ID
        $userId = Auth::id();

        // Retrieve characters linked to the user's account
        $characters = Characters::where('account', $userId)->get();

        // Pass characters to the view
        return view('admin.profil.selector', ['characters' => $characters]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($identifier)
    {
        // Initialize the query to the User model
        $query = User::on('gs_data');

        // Check if the identifier is numeric and use the appropriate field
        if (is_numeric($identifier)) {
            $query->where('id', $identifier);
        } else {
            $query->where('username', $identifier);
        }

        // Attempt to load the user and their associated active character
        $user = $query->firstOrFail();

        // Get the ID of the active character
        $activeCharacterId = $user->activecharacter;

        // Fetch the active character using its ID
        $activeCharacter = Characters::find($activeCharacterId);

        // Check if the active character exists
        if (!$activeCharacter) {
            // Handle the case where the active character does not exist
            abort(404, 'Active character not found.');
        }

        // Prepare the response data
        $responseData = [
            // Any additional data you want to pass to the view
        ];

        // Return the active character data to the view
        return view('admin.profil.profile', ['character' => $activeCharacter]);
    }

    public function selectCharacter()
    {
        $userId = Auth::id(); // Get the authenticated user's ID

        // Fetch characters that belong to the user
        $characters = Characters::where('account', $userId)->get();

        // Passing characters to the view
        return view('admin.profil.selector', ['characters' => $characters]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

