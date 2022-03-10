<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genere extends Model
{
    use HasFactory;
    protected $table = 'generes';

    public function videos() {
        return $this->belongsToMany(Video::class);
    }
}
