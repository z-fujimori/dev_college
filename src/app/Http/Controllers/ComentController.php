<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Coment;

use Illuminate\Http\Request;

class ComentController extends Controller
{
    //
    
    public function allComent(Coment $coment){
        return $coment->id(2)->get();
    }
    
    public function getChild(Coment $coment){
        // dd($coment);
        return $coment->children()->get();
    }
    
    
    public function store(PostRequest $request, Coment $coment){
        $input = $request['coment'];
        $input = ["user_id"=>auth()->user()->id];
        $coment->fill($input)->save();
        // return 
    }
}
