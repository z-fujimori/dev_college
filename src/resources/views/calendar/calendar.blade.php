
    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <x-app-layout>
        <body>
            <div className="p-5 m-5">
                <div>カレンダー</div>
                <div id='calendar'></div>
            </div>
            
            <div class="w-full flex flex-col items-center contents-center">
                <div class="flex items-center mt-5">
                    <h3 class="">選択ボタン： </h3>
                    <div id="nowSelect" class="font-bold text-xl">右</div>
                </div>
                <div class="flex [&>button]:m-2 [&>button]:p-2 [&>button]:rounded-lg">
                    <button class="aria-pressed:bg-green-800" id="select1" type="button" aria-pressed="false">トグルボタン：OFF</button>
                    <button class="aria-pressed:bg-green-800" id="select2" type="button" aria-pressed="true">トグルボタン：ON</button>
                </div>
            </div>
        
            <div id="modal-update" class="modal">
                <div class="modal-contents">
                    <form method="POST" action="{{ route('event.update') }}" class="text-green-950" >
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="id" name="id" value="" />
                        <label for="event_title">タイトル</label>
                        <input class="input-title" type="text" id="event_title" name="name" value="" />
                        
                        <label for="start_date">開始日時</label>
                        <input class="input-date" type="datetime" id="start_date" name="start_date" value="" >
                        
                        <label for="end_date">終了日時</label>
                        <input class="input-date" type="datetime" id="end_date" name="end_date" value="" />
                        
                        <label for="event_body" style="display: block">内容</label>
                        <textarea id="event_body" name="body" rows="3" value=""></textarea>
                        <label for="event_color">背景色</label>
                        <select id="event_color" name="color">
                            <option value="blue">青</option>
                            <option value="green">緑</option>
                            <option value="olive">青</option>
                            <option value="maroon">赤？</option>
                            <option value="purple">紫</option>
                            <option value="teal">綺麗な色</option>
                        </select>
                        <button type="button" onclick="closeUpdateModal()">キャンセル</button>
                        <button type="submit">決定</button>
                    </form>
                </div>
            </div>
            
            <script src="js/calen.js"></script>
        </body>
    </x-app-layout>
    
    
  <style scoped>
    .modal{
        display: none; /* モーダル開くとflexに変更（ここの切り替えでモーダルの表示非表示をコントロール） */
        justify-content: center;
        align-items: center;
        position: absolute;
        z-index: 10; /* カレンダーの曜日表示がz-index=2のため、それ以上にする必要あり */
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(0,0,0,0.5);
    }
    /* モーダル */
    .modal-contents{
        background-color: white;
        height: 400px;
        width: 600px;
        padding: 20px;
    }
    
    /* 以下モーダル内要素のデザイン調整 */
    input{
        padding: 2px;
        border: 1px solid black;
        border-radius: 5px;
    }
    .input-title{
        display: block;
        width: 80%;
        margin: 0 0 20px;
    }
    .input-date{
        width: 27%;
        margin: 0 5px 20px 0;
    }
    textarea{
        display: block;
        width: 80%;
        margin: 0 0 20px;
        padding: 2px;
        border: 1px solid black;
        border-radius: 5px;
        resize: none;
    }
    select{
        display: block;
        width: 20%;
        margin: 0 0 20px;
        padding: 2px;
        border: 1px solid black;
        border-radius: 5px;
    }
    
    /* 予定の上ではカーソルがポインターになる */
    .fc-event-title-container{
        cursor: pointer;
    }
    </style>
