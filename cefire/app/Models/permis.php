<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permis extends Model
{
    public $table = 'permis';
    use HasFactory;
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
