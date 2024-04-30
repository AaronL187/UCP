<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
    protected $table = 'gs_data.pets';
    protected $connection = 'gs_data';

    public function owner()
    {
        return $this->belongsTo(Characters::class, 'owner_id');
    }
}
