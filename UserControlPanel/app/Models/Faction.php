<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faction extends Model
{
    use HasFactory;
    public function owner()
    {
        // Assuming 'account' is the foreign key in the characters table that references the 'id' field in the users table
        return $this->belongsTo(Characters::class, 'id');
    }
}
