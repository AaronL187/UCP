<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::when($search, function ($query) use ($search) {
            return $query->where('username', 'like', "%{$search}%")
                ->orWhere('id', $search);
        })->paginate(25);

        return view('admin.userlist.show', compact('users'));
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $adminrankname = User::getAdminRankName($user->adminlevel);
        return view('admin.userlist.edit', compact('user', 'adminrankname'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        // Validation passed, proceed to update user
        $user = User::findOrFail($id);

        // Update user details
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->serial = $request->input('serial');
        $user->password = bcrypt($request->input('password'));
        $user->adminlevel = $request->input('adminlevel');
        $user->adminnickname = $request->input('adminnickname');
        $user->activecharacter = $request->input('activecharacter');

        // Save the updated user
        $user->save();

        // Optionally, you can flash a success message
        // Or return a JSON response indicating success
        return redirect()->back()->with('success', 'Felhasználó sikeresen frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

}
