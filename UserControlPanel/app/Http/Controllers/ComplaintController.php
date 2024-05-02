<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComplaintRequest;
use App\Models\Characters;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
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
        return view('user.complaint.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComplaintRequest $request)
    {
        // Create a new Complaint instance
        $complaint = new Complaint();

        // Assign values from the request to the Complaint instance
        $complaint->title = $request->title;
        $complaint->complained_against = $request->complained_against;
        $complaint->complained_by = auth()->user()->activecharacter;
        $complaint->description = $request->description;
        $complaint->prooflink = $request->prooflink;
        $complaint->messages = null;

        // Save the Complaint instance
        $complaint->save();
        // Redirect to a relevant page with a success message
        return back()->with('status', 'A panaszát sikeresen elküldte! Köszönjük a visszajelzését.');
    }
    public function show(Complaint $complaint)
    {
        $user = Auth::user();
        $character = $user->activecharacter;
        $complaints = Complaint::where('complained_by', $character)->get();
        return view('admin.complaint.manage', compact('complaints'));
    }

    /**
     * Display the specified resource.
     */
    public function showSpecific($id)
    {
        // Fetch the suggestion
        $complaint = Complaint::findOrFail($id);

        // Initialize variables for suggestor and handled by user
        $complained_by = null;
        $id = null;
        $handledby = null;

        // Check if the suggestion is handled and fetch handled by user's admin nickname
        if (!is_null($complaint->status)) {
            $handledbyUser = User::find($complaint->handled_by);
            if ($handledbyUser) {
                $handledby = $handledbyUser->adminnickname;
            }
        }

        // Fetch suggestor details
        $complaindbyCharacter = Characters::find($complaint->complained_by);
        if ($complaindbyCharacter) {
            $suggestor = $complaindbyCharacter->charactername;
            $suggestorid = $complaindbyCharacter->id;
        }

        // Check if the suggestion belongs to the active user's character
        if ($id != Auth::user()->activecharacter && Auth::user()->adminlevel <= 2) {
            return abort(403, 'Hozzáférés megtagadva!');
        }

        // Pass suggestion data to the view
        return view('user.complaint.specific', compact('complaint', 'complained_by', 'handledby', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Complaint $complaint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        //
    }

    public function accept(Request $request, $id)
    {
        // Retrieve the complaint based on the provided ID
        $complaint = Complaint::findOrFail($id);

        if (!is_null($complaint->status)) {
            // Redirect back with an error message if the complaint has already been processed
            return back()->with('error', 'This complaint has already been processed.');
        }

        // Update the complaint details
        $complaint->status = 1; // Status set to 'accepted'
        $complaint->handled_by = Auth::id();
        $complaint->resolution = $request->input('resolution');
        $complaint->handled_at = now();
        $complaint->save();

        // Redirect back with a success message
        return back()->with('success', 'A panasz elfogadva lett. Köszönjük a visszajelzést!');
    }

    public function reject(Request $request, $id)
    {
        // Retrieve the complaint based on the provided ID
        $complaint = Complaint::findOrFail($id);

        if (!is_null($complaint->status)) {
            // Redirect back with an error message if the complaint has already been processed
            return back()->with('error', 'A panasz már feldolgozásra került.');
        }

        // Update the complaint details
        $complaint->status = 0; // Status set to 'rejected'
        $complaint->handled_by = Auth::id();
        $complaint->resolution = $request->input('resolution');
        $complaint->handled_at = now();
        $complaint->save();

        // Redirect back with a success message
        return back()->with('success', 'A panasz elutasításra került. Köszönjük a visszajelzést!');
    }

    public function manage(Request $request)
    {
        $search = $request->input('search');
        $complaints = Complaint::when($search, function ($query) use ($search) {
            return $query->where('complained_by', 'like', "%{$search}%")
                ->orWhere('id', $search);
        })->paginate(25);  // Adjust pagination as needed

        return view('admin.complaint.manage', compact('complaints'));
    }

}
