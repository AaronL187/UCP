<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;
    protected $connection = 'gs_data';
    protected $table = 'gs_data.vehicles';

    public function character()
    {
        return $this->belongsTo(Characters::class, 'owner_id', 'id');
    }

    public function name()
    {
        return $this->belongsTo('App\Models\Characters', 'owner_id');
    }
    protected $casts = [
        'tuning' => 'array',
        'deletion_info' => 'array',
    ];

    public function formattedTuning()
    {
        $tuningStages = [
            'wheels' => 'Kerék Tuning',
            'engine' => 'Motor Tuning',
            'ecu' => 'ECU Tuning',
            'transmission' => 'Váltó Tuning',
            'nitro' => 'Nitro Tuning'
        ];

        $formatted = collect($this->tuning)->map(function ($value, $key) use ($tuningStages) {
            $stageName = $tuningStages[$key] ?? ucfirst($key);
            return "{$stageName}: Stage {$value}";
        });

        return $formatted->all();  // Returns an array of formatted strings
    }
}
