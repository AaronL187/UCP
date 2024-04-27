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
        $search = $request->input('search');

        // Query builder with advanced filtering
        $query = Vehicles::query();

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('id', $search)
                    ->orWhereHas('character', function ($q) use ($search) {
                        $q->where('charactername', 'like', "%{$search}%");
                    })
                    ->orWhere('model', $search);
            });
        }

        $vehicles = $query->with('character')->paginate(50)->appends([
            'search' => $search
        ]);

        $vehicleModels = $this->getVehicleModels();
        return view('admin.vehicles.show', compact('vehicles', 'vehicleModels'));
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
    public function getVehiclesByOwner($owner)
    {
        // Fetch vehicles based on owner ID
        $vehicles = Vehicles::where('owner_id', $owner)->get();

        $vehicleModels = $this->getVehicleModels();
        return view('admin.vehicles.myvehicles', compact('vehicles', 'vehicleModels'));
    }

}
