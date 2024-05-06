<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialChangeLog extends Model
{
    use HasFactory;
    protected $table = 'serial_change_logs';
    protected $connection = 'gs_log';
    protected $fillable = ['date', 'type', 'character', 'message'];
}
