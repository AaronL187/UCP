<?php

namespace App\Http\Controllers;

use App\Models\Characters;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        // Attempt to load the user and their associated character
        $user = $query->with('character')->firstOrFail(); // Assume you have relationships for admin and faction

        // Now we have the User model, which includes the Character relationship
        $character = $user->character;

        // Prepare the response data
        $responseData = [
            // Any additional data you want to pass to the view
        ];

        // Return the character data (excluding sensitive information)
        return view('admin.profil.profile', ['character' => $character]);
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

