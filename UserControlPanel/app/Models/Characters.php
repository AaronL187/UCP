<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characters extends Model
{
    protected $connection = 'gs_data';
    protected $table = 'gs_data.characters';


    use HasFactory;

    // Define the relationship to the User model
    public function user()
    {
        // Assuming 'account' is the foreign key in the characters table that references the 'id' field in the users table
        return $this->belongsTo(User::class, 'account');
    }
    public function serialChanges()
    {
        return $this->hasMany(SerialChange::class);
    }
    protected $casts = [
        'last_login_time' => 'datetime',
    ];

}
