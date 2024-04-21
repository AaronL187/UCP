<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NameChange extends Model
{
    protected $table = 'gs_ucp.name_changes';
    use HasFactory;
    protected $fillable = ['character_id', 'old_name', 'new_name', 'reason', 'handled_by', 'updated_at'];

    public function handler()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }
}
