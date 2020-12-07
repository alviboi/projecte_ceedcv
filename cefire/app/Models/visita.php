<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visita extends Model
{
    public $table = 'visita';
    use HasFactory;
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
