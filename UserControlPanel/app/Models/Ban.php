<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ban extends Model
{
    use HasFactory;
    protected $connection = 'gs_data';
    use SoftDeletes;
    protected $dates = ['banned_until'];
    protected $casts = [
        'banned_until' => 'datetime',
    ];
}
