<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interior extends Model
{
    protected $connection = 'gs_data';
    protected $table = 'gs_data.interiors';
    use HasFactory;
}
