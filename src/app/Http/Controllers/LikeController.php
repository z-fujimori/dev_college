<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function show(){
        return view('test.like');
    }
    
    public function store(Request $request){
        dd("実装してないよ");
        return response()->json(["a"=>"aaa"]);;
    }
}
