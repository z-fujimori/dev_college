<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncludeAlchole extends Model
{
    use HasFactory;
    protected $table = 'includes';
    protected $fillable = [
        'name',
        'strange',
    ];

    public function recipes(){
        return $this->belongsToMany(Recipe::class,'include_recipe','include_id','recipe_id');
    }
}
