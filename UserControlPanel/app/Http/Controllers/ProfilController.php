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

    public function selectCharacter(Request $request)
    {
        $user = Auth::user(); // Get the currently authenticated user
        $characterId = $request->input('character_id'); // Get the submitted character ID

        if ($characterId) {
            $user->activecharacter = $characterId; // Set the active character
            $user->save(); // Save the user with the updated active character ID

            return redirect()->back()->with('success', 'Karakter kiválasztva!'); // Redirect back with success message
        }

        return redirect()->back()->withErrors(['msg' => 'Karakter kiválasztása nem sikerült!']); // Redirect back with error message if character ID is missing
    }

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
    public function show()
    {
        // Initialize the query to the User model
        $query = User::on('gs_data');



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

