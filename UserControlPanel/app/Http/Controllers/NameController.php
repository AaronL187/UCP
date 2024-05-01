<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNameChangeRequest;
use App\Models\NameChange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class NameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
    public function checkIfRequestExists($characterId)
    {
        return NameChange::where('character_id', $characterId)
            ->whereNull('status')
            ->exists();
    }
    public function store(StoreNameChangeRequest $request)
    {
        // Retrieve the authenticated user's ID
        $userId = Auth::id();
        $character = User::find($userId)->character()->first();
        $pendingChangeExists = $this->checkIfRequestExists($character->id);
        if(!$pendingChangeExists) {
            $data = [
                'character_id' => $character->id,
                'old_name' => $character->charactername,
                'new_name' => $request->input('new_name'),
                'reason' => $request->input('reason'),
                'handled_by' => 0,
            ];
            NameChange::create($data);
            return redirect()->back()->with('message', 'Sikeresen benyújtottad a kérelmedet.');
        } else {
            return redirect()->back()->with('error', 'Már van függőben lévő kérelmed.');
        }

    }
    /**
     * Display the specified resource.
     */


    public function show()
    {
        $user = Auth::user();
        // Assuming that the user can have only one character
        $character = $user->character()->first();
        $pendingChangeExists = $this->checkIfRequestExists($character->id);
        // Fetch name changes related to the user's character
        // Adjust this if the NameChange model doesn't use 'character_id' directly
        $nameChanges = NameChange::where('character_id', $character->id)->get();
        // Pass name changes and character's current name to the view
        return view('admin.name.namechanges', [
            'nameChanges' => $nameChanges,
            'currentName' => $character->charactername, // Replace 'serial' with 'name' or the appropriate field
            'checkIfRequestExists' => $pendingChangeExists,
        ]);
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
    public function manage()
    {
        // Get all serial changes
        $nameChanges = NameChange::all()->sortByDesc('date');

        // Collect character_ids to minimize the number of queries
        $characterIds = $nameChanges->pluck('character_id')->unique();
        $adminnick = Auth::user()->adminnickname;
        // Retrieve users based on these character_ids from the other database
        $users = \DB::connection('gs_data')->table('characters')
            ->whereIn('id', $characterIds)
            ->get()->keyBy('id');

        // Append user details to each serial change for easy access in the view
        foreach ($nameChanges as $change) {
            $user = $users->get($change->character_id);
            $change->username = $user ? $user->charactername: 'Unknown';
            $change->userId = $user ? $user->id : 'Unknown';
            $change->adminnick = $adminnick ? $adminnick : 'Unknown';
            $change->updated_at = $change->updated_at->format('Y-m-d H:i:s') ?? 'Unknown';
        }

        // Pass the serial changes to the view
        return view('admin.name.manage', compact('nameChanges'));
    }

    public function accept($id)
    {
        // Retrieve the name change request
        $nameChange = NameChange::findOrFail($id);


        // Check if the name change request is already accepted or declined
        if (!is_null($nameChange->status)) {
            // Redirect back with an error message if the request is already processed
            return back()->with('error', 'This request has already been processed.');
        }

        // Update the status of the name change request to 'Accepted'
        $nameChange->status = 1; // Assuming 1 is the status code for 'Accepted'
        $nameChange->handled_by = Auth::id();
        $nameChange->updated_at = now();

        $nameChange->save();

        // Retrieve the character associated with this name change from the 'gs_data' connection
        $character = \DB::connection('gs_data')->table('characters')->where('id', $nameChange->character_id)->first();

        // Proceed if the character exists
        if ($character) {
            // Wrap the operation in a transaction for data integrity
            \DB::connection('gs_data')->transaction(function () use ($nameChange, $character) {
                // Update the character's name in the 'gs_data.characters' table
                \DB::connection('gs_data')->table('characters')->where('id', $character->id)->update(['charactername' => $nameChange->new_name]);
            });

            // Redirect back with a success message
            return back()->with('success', 'Change request accepted and character name updated.');
        } else {
            // Redirect back with an error message if the character doesn't exist
            return back()->with('error', 'The associated character does not exist.');
        }
    }



    public function decline($id)
    {
        $nameChange = NameChange::findOrFail($id);
        if (!is_null($nameChange->status)) {
            // Redirect back with an error message if the request is already processed
            return back()->with('error', 'This request has already been processed.');
        }

        $nameChange->status = 0; // Assuming 0 is the status code for 'Declined'
        $nameChange->handled_by = Auth::id();
        $nameChange->updated_at = now();
        $nameChange->save();

        // Redirect back with a success message
        return back()->with('success', 'Change request declined.');
    }

}
