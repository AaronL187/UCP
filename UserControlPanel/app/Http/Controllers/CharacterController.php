<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterUpdateRequest;
use App\Models\Characters;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $characters = Characters::when($search, function ($query) use ($search) {
            return $query->where('charactername', 'like', "%{$search}%")
                ->orWhere('id', $search);
        })->paginate(25);

        return view('admin.characterlist.show', compact('characters'));
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
    public function show(Characters $characters)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $character = Characters::findOrFail($id);
        return view('admin.characterlist.edit', compact('character'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CharacterUpdateRequest $request, $id)
    {
        $character = Characters::findOrFail($id);
        $character->charactername = $request->input('charactername');
        $character->health = $request->input('health');
        $character->armor = $request->input('armor');
        $character->hunger = $request->input('hunger');
        $character->thirst = $request->input('thirst');
        $character->money = $request->input('money');
        $character->pp = $request->input('pp');
        $character->skin_id = $request->input('skin_id');
        $character->maxvehs = $request->input('maxvehs');
        $character->maxinteriors = $request->input('maxinteriors');
        $character->faction_id = $request->input('faction_id');

        $character->save();

        return redirect()->back()->with('success', 'Karakter sikeresen frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Characters $characters)
    {
        //
    }

}
