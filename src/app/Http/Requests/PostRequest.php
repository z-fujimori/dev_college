<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'post.title' => 'required|string|max:50',
            'post.body' => 'required|string|max:200',
        ];
    }
}
