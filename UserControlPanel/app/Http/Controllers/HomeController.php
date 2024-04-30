<?php

namespace App\Http\Controllers;

use App\Models\SerialChange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\User;
use app\Models\Characters;

class HomeController extends Controller
{
    public function admin_view()
    {
        $this->setActiveCharacter();
        return view('admin.newsidebar');
    }
    public function serialManage()
    {
        $serialChanges = SerialChange::all();
        return view('admin.serial.manage', compact('serialChanges'));
    }

    public function setActiveCharacter()
    {
        $user = Auth::user(); // Get the currently authenticated user

        // Load the first character related to the user
        $firstCharacter = $user->character()->first();

        if ($firstCharacter) {
            $user->activecharacter = $firstCharacter->id;
            $user->save();  // Save the user with the updated active character ID
        }
    }

    public function showAdminTeam()
    {
        $users = User::where('adminlevel', '>', 0)->with('character')->get();

        return view('adminteam', compact('users'));
    }
}
