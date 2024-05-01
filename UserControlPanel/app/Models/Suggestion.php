<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Suggestion extends Model
{
    use SoftDeletes;
    use HasFactory;


    protected $fillable = ['suggested_by', 'suggestion', 'status', 'handled_by', 'reason', 'handled_at', 'reward'];

}
