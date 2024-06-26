<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use Illuminate\Http\Request;

class BanController extends Controller
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
    public function show(Request $request)
    {
        $search = $request->input('search');
        $bans = Ban::when($search, function ($query) use ($search) {
            return $query->where('username', 'like', "%{$search}%")
                ->orWhere('userid', $search);
        })->paginate(25);

        return view('admin.banlist.show', compact('bans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ban $ban)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ban $ban)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ban $ban)
    {
        //
    }
}
