<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compensa extends Model
{
    public $table = 'compensa';
    use HasFactory;
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
