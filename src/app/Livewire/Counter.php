<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Post;

class Counter extends Component
{
    public $count = 0;

    public function increment() {
        $post = new Post;
        $input = ["title"=>"livewireを使ってみよう", "body"=>$this->count,"user_id"=>auth()->user()->id];
        $post->create($input);
        $this->count++;
        // dd($this->count);
    }

    public function decrement() {
        $this->count--;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
