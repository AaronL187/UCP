<?php

namespace App\Http\Controllers;

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
    public function edit(Characters $characters)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Characters $characters)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Characters $characters)
    {
        //
    }
}
