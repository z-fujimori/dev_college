//import '@fullcalendar/core/vdom'; // （for Vite）ver6には不要なので、エラーが出たらここを消す。
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";  // 追記（イベント追加ー）
import axios from 'axios';  // 追記(DB接続)

// idがcalendarのDOMを取得
var calendarEl = document.getElementById("calendar");

// カレンダーの設定
let calendar = new Calendar(calendarEl, {
    plugins: [interactionPlugin, dayGridPlugin], // 

    // 最初に表示させる形式
    initialView: "dayGridMonth",

    // ヘッダーの設定（左/中央/右）
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "",
    },
    
    // 以下追記
    selectable: true,  // 複数日選択可能
    select: function (info) {  // 選択時の処理
        console.log(info)
        
        const eventName = prompt("イベントを入力してください");
        
        // 入力された時に実行される
        if (eventName) {
            // 以下追記
            axios
                .post('/calendar', {
                    start_date: info.start.valueOf(),
                    end_date: info.end.valueOf(),
                    name: eventName,
                })
                .then(() => {
                    // イベントの追加
                    calendar.addEvent({
                        title: eventName,
                        start: info.start,
                        end: info.end,
                        allDay: true,
                    });
                })
                .catch(() => {
                    // バリデーションエラーなど
                    alert("登録に失敗しました");
                });
        }
    },
    
});

// レンダリング
calendar.render();