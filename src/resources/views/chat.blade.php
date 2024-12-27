<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Chat
        </h2>
    </x-slot>

    <div class="py-12 text-green-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <div class="">
                        @foreach($users as $user)
                            <div>
                                <a href="/chat/{{ $user->id }}">{{ $user->name }}とチャットする</a>
                            </div>
                        @endforeach
                    </div>



    <ul class="list-disc" id="list_message">
        
    </ul>

                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>