<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketValidationRequest;
use App\Models\Characters;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
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
        return view('user.ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketValidationRequest $request)
    {
        $ticket = new Ticket();
        $ticket->ticket_by = auth()->user()->activecharacter; // assuming you have user authentication
        $ticket->problem = $request->problem;
        $ticket->proofurl = $request->proofurl;
        $ticket->status = null; // pending status
        $ticket->save();

        return redirect()->back()->with('status', 'Ticket submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function manage(Request $request)
    {

        $search = $request->input('search');
        $tickets = Ticket::when($search, function ($query) use ($search) {
            return $query->where('ticket_by', 'like', "%{$search}%")
                ->orWhere('id', $search);
        })->paginate(25);
        return view('admin.ticket.manage', compact('tickets'));
    }

    public function showSpecific($id)
    {
        // Fetch the ticket with related data, assuming similar relationships exist
        $ticket = Ticket::findOrFail($id);

        // Directly access related user, if they exist
        $handledby = null;  // assuming the handler might have an admin nickname
        $submitter = null;  // or whatever field you use for user identification
        $submitterid = null;

        // Ensure the active user has permission to view this ticket
        if (!is_null($ticket->status)) {
            $handledbyUser = User::find($ticket->handled_by);
            if ($handledbyUser) {
                $handledby = $handledbyUser->adminnickname;
            }
        }
        $suggestorCharacter = Characters::find($ticket->ticket_by);
        if ($suggestorCharacter) {
            $submitter = $suggestorCharacter->charactername;
            $submitterid = $suggestorCharacter->id;
        }
        if ($this->userCannotViewTicket($submitterid)) {
            abort(403, 'Hozzáférés megtagadva!');
        }
        return view('user.ticket.specific', compact('ticket', 'submitter', 'handledby', 'submitterid'));
    }



    /**
     * Check if the current user is allowed to view the ticket.
     *
     * @param int $submitterid
     * @return bool
     */
    private function userCannotViewTicket($submitterid)
    {
        return $submitterid != Auth::user()->activecharacter && Auth::user()->adminlevel <= 2;
    }

    public function accept(TicketValidationRequest $request, $id)
    {
        // Retrieve the ticket
        $ticket = Ticket::findOrFail($request->id);
        if (!is_null($ticket->status)) {
            // Redirect back with an error message if the ticket is already processed
            return back()->with('error', 'Ez a jegy már feldfeldolgozásra került.');
        }
        $character = Characters::find($ticket->ticket_by);
        $ticket->status = 1;
        $ticket->handled_by = Auth::id();
        $ticket->updated_at = now();
        $ticket->reward = $request->reward;
        $ticket->reason = $request->reason;
        $ticket->ticket_by;
        $ticket->problem;
        $ticket->save();
        $character->pp += $request->reward;
        $character->save();
        return back()->with('success', 'A jegy elfogadásra került. A jutalom jóváírásra került.');
    }
    public function reject(TicketValidationRequest $request, $id)
    {
        // Retrieve the ticket
        $ticket = Ticket::findOrFail($request->id);
        if (!is_null($ticket->status)) {
            // Redirect back with an error message if the ticket is already processed
            return back()->with('error', 'Ez a jegy már feldfeldolgozásra került.');
        }
        $ticket->status = 0;
        $ticket->handled_by = Auth::id();
        $ticket->updated_at = now();
        $ticket->reward = $request->reward;
        $ticket->reason = $request->reason;
        $ticket->ticket_by;
        $ticket->problem;
        $ticket->reward = 0;
        $ticket->save();

        // Redirect back with a success message
        return back()->with('success', 'A jegy elutasításra került.');
    }



}
