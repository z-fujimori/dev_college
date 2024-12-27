<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpeechController extends Controller
{
    //
    public function test(){
        return view('speech/test');
    }
    
    public function index(){
        return view('speech/index');
    }
}
