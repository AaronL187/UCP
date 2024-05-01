<?php

namespace App\Http\Controllers;

use App\Models\Characters;
use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;

class SuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function mySuggestion(int $id)
    {
        // Fetch the suggestion
        $suggestion = Suggestion::findOrFail($id);

        // Initialize variables for suggestor and handled by user
        $suggestor = null;
        $suggestorid = null;
        $handledby = null;

        // Check if the suggestion is handled and fetch handled by user's admin nickname
        if (!is_null($suggestion->status)) {
            $handledbyUser = User::find($suggestion->handled_by);
            if ($handledbyUser) {
                $handledby = $handledbyUser->adminnickname;
            }
        }

        // Fetch suggestor details
        $suggestorCharacter = Characters::find($suggestion->suggested_by);
        if ($suggestorCharacter) {
            $suggestor = $suggestorCharacter->charactername;
            $suggestorid = $suggestorCharacter->id;
        }

        // Check if the suggestion belongs to the active user's character
        if ($suggestorid != Auth::user()->activecharacter && Auth::user()->adminlevel <= 2) {
            return abort(403, 'Hozzáférés megtagadva!');
        }

        // Pass suggestion data to the view
        return view('user.suggestion.specific', compact('suggestion', 'suggestor', 'handledby', 'suggestorid'));
    }


    public function manage(Request $request)
    {

        $search = $request->input('search');
        $suggestions = Suggestion::when($search, function ($query) use ($search) {
            return $query->where('suggested_by', 'like', "%{$search}%")
                ->orWhere('id', $search);
        })->paginate(25);
        return view('admin.suggestion.manage', compact('suggestions'));
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
    public function show(Suggestion $suggestion)
    {
        $user = Auth::user();
        // Assuming that the user can have only one character
        $character = $user->activecharacter;

        // Since you have the $suggestion object, there is no need to query it again
        // If you need additional data related to the $suggestion or handling user, ensure your model relationships are set up accordingly.

        // Assuming you want to fetch additional suggestions made by the same character
        $suggestions = Suggestion::where('suggested_by', $character)->get();

        // Pass additional suggestions and character's current name to the view
        return view('user.suggestion.show', [
            'suggestions' => $suggestions // Passing the current suggestion
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suggestion $suggestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suggestion $suggestion)
    {
        //
    }
}
