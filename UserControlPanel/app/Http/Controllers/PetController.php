<?php

namespace App\Http\Controllers;

use App\Models\Characters;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the ID of the active character of the logged-in user
        $activeCharacterId = auth()->user()->activecharacter; // Assuming the user model has an attribute that stores the active character's ID

        // Fetch the character information
        $character = Characters::find($activeCharacterId);

        $pets = [];
        if ($character) {
            $pets = Pet::where('owner_id', $activeCharacterId)->get();
        }


        return view('user.pet.show', compact('pets', 'character'));
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
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        //
    }
}
