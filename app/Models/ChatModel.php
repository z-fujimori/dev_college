<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatModel extends Model
{
    use HasFactory;
    
    protected $table = 'chats';
    
    public function direct_messages()
    {
        return $this->hasMany(Direct_essage::class);
    }
}
