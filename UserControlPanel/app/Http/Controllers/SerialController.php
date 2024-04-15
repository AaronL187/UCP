<?php

namespace App\Http\Controllers;

use App\Models\SerialChange;
use Illuminate\Http\Request;

class SerialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::id()) {
            return redirect('home');
        } else {
            $room = room::all();
            return view('user.home', compact('room'));
        }

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
        $validated = $request->validate([
            // Validation rules here
            'character_id' => 'required|integer',
            'old_serial' => 'required|string|max:32',
            'new_serial' => 'required|string|max:32',
            'reason' => 'required',
            'handled_by' => 'required|string',
            // Assume status is optional and handled internally or through the form
        ]);

        SerialChange::create($validated);

        return redirect()->route('serial.create')->with('message', 'Serial change successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $serialChanges = SerialChange::all()->toArray();
        return view('admin.serial.serialchanges', ['serialChanges' => $serialChanges]);
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
