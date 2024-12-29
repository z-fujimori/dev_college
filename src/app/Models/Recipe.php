<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'strange',
        'process'
    ];//fillable:文字を入力する能力を与える

    public function includes(){
        return $this->belongsToMany(Includealchole::class,'include_recipe','recipe_id','include_id');
        //return $this->belongsToMany(Includealchole::class);
    }
}
