<?php

namespace App\Http\Controllers;

use App\Models\Faction;
use Illuminate\Http\Request;

class FactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $factions = Faction::all()->map(function ($faction) {
            $faction->factiondata = json_decode($faction->factiondata, true);
            $faction->motto = $details['motto'] ?? 'No Motto';
            $faction->size = $details['size'] ?? 0;
            return $faction;
        });
        return view('admin.faction.index', compact('factions'));
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
    public function show(Faction $faction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faction $faction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faction $faction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faction $faction)
    {
        //
    }
}
