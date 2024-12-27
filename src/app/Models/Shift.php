<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'event_id',
    ];
    
    public function event(){
        return $this->belognsTo(Event::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
