<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'post_id',
        'user_id',
        'coment_id',
        'text'
    ];
    
    public function User(){
        return $this->belongsTo(User::class);
    }
    
    public function Post(){
        return $this->belongsTo(Post::class);
    }
    
    public function parent(){
        return $this->belongsTo(Coment::class);
    }
    
    public function children(){
        return $this->hasMany(Coment::class);
    }
}
