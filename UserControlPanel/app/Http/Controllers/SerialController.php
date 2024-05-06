<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSerialChangeRequest;
use App\Models\SerialChange;
use App\Models\SerialChangeLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Characters;

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
   public function checkIfRequestExists($userId)
    {
        return SerialChange::where('character_id', $userId)
            ->whereNull('status')
            ->exists();
    }
    public function store(StoreSerialChangeRequest $request)
    {
        // Retrieve the authenticated user's ID
        $userId = Auth::id();
        $pendingChangeExists = $this->checkIfRequestExists($userId);

        if(!$pendingChangeExists) {
            $data = [
                'character_id' => $userId,
                'old_serial' => $request->input('old_serial'),
                'new_serial' => $request->input('new_serial'),
                'reason' => $request->input('reason'),
                'handled_by' => NULL,
            ];
            SerialChange::create($data);

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
        $user = Auth::user();  // Get the authenticated user
        $pendingChangeExists = $this->checkIfRequestExists($user->id);

        // Fetch serial changes directly related to the user's account
        $serialChanges = SerialChange::where('character_id', $user->id)->get();

        // Use debug to check values (Remove or comment out in production)

        // Pass serial changes and user's current serial to the view
        return view('admin.serial.serialchanges', [
            'serialChanges' => $serialChanges,
            'currentSerial' => $user->serial,
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
        $serialChanges = SerialChange::all()->sortByDesc('date');

        // Collect character_ids to minimize the number of queries
        $characterIds = $serialChanges->pluck('character_id')->unique();

        // Retrieve users based on these character_ids from the other database
        $users = \DB::connection('gs_data')->table('users')
            ->whereIn('id', $characterIds)
            ->get()->keyBy('id');

        // Append user details to each serial change for easy access in the view
        foreach ($serialChanges as $change) {
            $user = $users->get($change->character_id);
            $change->username = $user ? $user->username : 'Unknown';
            $change->userId = $user ? $user->id : 'Unknown';
        }

        // Pass the serial changes to the view
        return view('admin.serial.manage', compact('serialChanges'));
    }

    public function accept($id)
    {
        // Retrieve the serial change request
        $serialChange = SerialChange::findOrFail($id);

        // Update the status of the serial change request to 'Accepted'
        $serialChange->status = 1; // Assuming 1 is the status code for 'Accepted'
        $serialChange->save();

        // Retrieve the user associated with this serial change
        $user = \DB::table('gs_data.users')->where('id', $serialChange->character_id)->first();

        if($user) {
            try {
                \DB::connection('gs_data')->table('users')->where('id', $user->id)->update(['serial' => $serialChange->new_serial]);
            } catch (\Exception $e) {
                // Handle exception
                return back()->withErrors('update_failed', $e->getMessage());
            }
        }
        $detailedMessage = [
            'detail' => 'Serial change accepted by ' . $user->adminnickname,
            'adminuserid' => Auth::id(),
            'new_serial' => $serialChange->new_serial,
            'previous_serial' => $serialChange->old_serial
        ];
        $log = new SerialChangeLog([
            'date' => now(),
            'type' => 'SerialChangeAccepted',
            'character' => $serialChange->character_id,
            'message' => json_encode([$detailedMessage]),
        ]);

        $log->save();

        // Redirect back with a success message
        return back()->with('success', 'Change request accepted and serial updated.');
    }


    public function decline($id)
    {
        $serialChange = SerialChange::findOrFail($id);
        $serialChange->status = 0; // Assuming 0 is the status code for 'Declined'
        $serialChange->save();

        $user = auth::user();

        // Redirect back with a success message
        $detailedMessage = [
            'detail' => 'Serial change declined by ' . $user->adminnickname,
            'adminuserid' => Auth::id(),
            'new_serial' => $serialChange->new_serial,
            'previous_serial' => $serialChange->old_serial
        ];
        $log = new SerialChangeLog([
            'date' => now(),
            'type' => 'SerialChangeDeclined',
            'character' => $serialChange->character_id,
            'message' => json_encode([$detailedMessage]),
        ]);

        $log->save();
        return back()->with('success', 'Change request declined.');
    }

}
