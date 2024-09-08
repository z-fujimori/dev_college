<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    </head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('say') }}
        </h2>
    </x-slot>
    
    <div class="text-black">
        <p>テストform</p>
        <form action="/testform" method="POST">
            @csrf
            <input name="test[time]" type="datetime-local">
            <input type="submit">
        </form>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            
            <div id="styleid" class="style">
                <div classname="name">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            
            <br>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="/posts" method="POST">
                        @csrf
                        <div class="title">
                            <h2>Title</h2>
                            <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}" />
                            @if($errors->has('post.title'))
                            　　{{ $errors->first('post.title') }}
                            @endif 
                        </div>
                        <div class="body">
                            <h2>Body</h2>
                            <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。">{{ old('post.body') }}</textarea>
                            @if($errors->has('post.body'))
                            　　{{ $errors->first('post.body') }}
                            @endif 
                        </div>
                        <input type="submit" value="store"/>
                    </form>
                </div>
            </div>
            
            <br>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-xl font-bold">投稿</p>
                    
                    @foreach ($posts as $post)
                        <div class="bg-gray-200 text-gray-800 rounded-lg ">
                            <div class='text-xl mx-3'>{{ $post->title }}</>
                            <p class='body mx-5'>{{ $post->body }}</p>
                        </div>
                        <br />
                    @endforeach
                    <div class="">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
</html>