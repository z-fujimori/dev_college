<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="">
                    @foreach($users as $user)
                        <div>
                            <a class="" href="/chat/{{ $user->id }}">{{ $user->name }}とチャットする</a>
                        </div>
                    @endforeach
                </div>
                
                <div class="p-6 bg-white border-b border-gray-200">
                {{-- エンターキーによるボタン押下を行うために、
                         <button type="button">ではなく、<form>と<button type="submit">を使用。
                         ボタン押下(=submit)時にページリロードが行われないように、
                         onsubmitの設定の最後に"return false;"を追加。
                         (return false;の結果として、submitが中断され、ページリロードは行われない。）--}}
                    <form method="post" onsubmit="onsubmit_Form(); return false;">
                        メッセージ : <input type="text" id="input_message" autocomplete="off" />
                        <input type="hidden" id="chat_id" name="chat_id" value="{{ $chat->id }}"> 
                        <button type="submit" class="text-white bg-blue-700 px-5 py-2">送信</button>
                    </form>
                
                    <ul class="list-disc" id="list_message">
                        @foreach ($messages as $message)
                            <li>
                                <strong>{{ $message->user->name }}:</strong>
                                <div>{{ $message->body }}</div>
                            </li>
                         @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
<script>
        const elementInputMessage = document.getElementById( "input_message" );
        const chatId = document.getElementById("chat_id").value;
        
        {{-- formのsubmit処理 --}}
        function onsubmit_Form()
        {
            
            {{-- 送信用テキストHTML要素からメッセージ文字列の取得 --}}
            let strMessage = elementInputMessage.value;
            if( !strMessage )
            {   
                console.log("no messe");
                return;
            }
            params = { 
                'message': strMessage,
                'chat_id': chatId
            };
            
            {{-- POSTリクエスト送信処理とレスポンス取得処理 --}}
            axios
                .post( '/chat', params )
                .then( response => {
                    console.log(response);
                    console.log(chatId);
                } )
                .catch(error => {
                    console.log(error.response);
                    console.log(error.response);
                } );
            {{-- テキストHTML要素の中身のクリア --}}
            elementInputMessage.value = "";
        }
        

        
    </script>
</x-app-layout>