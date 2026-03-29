<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
   protected $fillable = ['titulo', 'contenido', 'color', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    } 
}
