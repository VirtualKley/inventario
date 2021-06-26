<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function model(){
        return $this->belongsTo(Modelo::class);
    }

    public function color(){
        return $this->belongsTo(Color::class);
    }
}
