<?php

namespace App\Http\Controllers;

use App\Models\Characters;
use App\Models\Vehicles;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchId = $request->input('searchId');
        $searchOwner = $request->input('searchOwner');
        $searchModelId = $request->input('searchModelId');
        $search = $request->input('search');
        // Query builder with advanced filtering
        $query = Vehicles::query();

        if (!empty($searchId)) {
            $query->where('id', $searchId);
        }
        if (!empty($searchOwner)) {
            $query->where(function ($query) use ($searchOwner) {
                $query->whereHas('character', function ($q) use ($searchOwner) {
                    $q->where('charactername', 'like', '%' . $searchOwner . '%');
                })->orWhere('owner_id', $searchOwner);
            });
        }


        if (!empty($searchModelId)) {
            $query->where('model', $searchModelId);
        }

        $vehicles = $query->with('character')->paginate(50);

        $tuningArray = Vehicles::where('tuning', '!=', null)
            ->get()
            ->mapWithKeys(function ($vehicle) {
                return [$vehicle->id => json_decode($vehicle->tuning, true)];
            })->all();



        $vehicleModels = $this->getVehicleModels();
        return view('admin.vehicles.show', compact('vehicles', 'vehicleModels', 'tuningArray'));
    }


    protected function getVehicleModels()
    {
        $models = [
            400 => 'Explorer Sedan',
            401 => 'Mystique Convertible',
            402 => 'Voyager Hatchback',
            403 => 'Summit SUV',
            // ... Additional models with incrementing IDs up to 610
        ];

        for ($id = 404; $id <= 610; $id++) {
            $models[$id] = 'Model ' . chr(64 + ($id % 26) + 1) . ' ' . str_pad(($id % 100), 2, '0', STR_PAD_LEFT); // Example naming convention
        }

        return $models;
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
    public function show(Vehicles $vehicles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicles $vehicles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicles $vehicles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicles $vehicles)
    {
        //
    }
    public function getVehiclesByOwner()
    {
        // Fetch the authenticated user's ID
        $ownerId = auth()->id();  // Retrieves the ID of the currently authenticated user

        // Check if a user is authenticated
        if (!$ownerId) {
            // Optionally, redirect to login or abort with unauthorized error
            return redirect('login')->with('error', 'You must be logged in to see this page.');
            // or use abort(403, 'Unauthorized access');
        }
        if (auth()->id() != $ownerId) {
            // Handle unauthorized access
            abort(403, 'Unauthorized access');
        }
        // Fetch vehicles based on the authenticated owner's ID
        $vehicles = Vehicles::where('owner_id', $ownerId)->get();

        $vehicleModels = $this->getVehicleModels();
        return view('admin.vehicles.myvehicles', compact('vehicles', 'vehicleModels'));
    }


}
