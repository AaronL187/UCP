<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NameChangeLog extends Model
{
    protected $table = 'name_change_logs';
    protected $connection = 'gs_log';
    protected $fillable = ['date', 'type', 'character', 'message'];

    use HasFactory;
}
