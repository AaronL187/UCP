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
    protected $casts = [
        'tuning' => 'array',
        'deletion_info' => 'array'
    ];
    public function name()
    {
        return $this->belongsTo('App\Models\Characters', 'owner_id');
    }
}
