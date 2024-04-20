<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialChange extends Model
{
    protected $table = 'gs_ucp.serial_changes';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'character_id',
        'old_serial',
        'new_serial',
        'reason',
    ];
}
