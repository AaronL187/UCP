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
        // Fetch search criteria from request
        $searchId = $request->input('searchId');
        $searchOwner = $request->input('searchOwner');
        $searchModelId = $request->input('searchModelId');

        // Query builder with advanced filtering
        $query = Vehicles::query();

        if (!empty($searchId)) {
            $query->where('id', $searchId);
        }

        if (!empty($searchOwner)) {
            $query->whereHas('owner', function ($q) use ($searchOwner) {
                $q->where('name', 'like', '%' . $searchOwner . '%');
            });
        }

        if (!empty($searchModelId)) {
            $query->where('model', $searchModelId);
        }

        $vehicles = $query->with('character')->paginate(50);

        // Vehicle models mapping
        $vehicleModels = $this->getVehicleModels();
        // Passing data to the view
        return view('admin.vehicles.show', compact('vehicles', 'vehicleModels'));
    }
    protected function getVehicleModels()
    {
        return [
            1 => 'Sedan',
            2 => 'Convertible',
            3 => 'Hatchback',
            4 => 'SUV',
            // Additional models
        ];
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
}
