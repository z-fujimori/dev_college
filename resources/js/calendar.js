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
        console.log(info)
        
        const eventName = prompt("予定を入力してください");
        
        // 入力された時に実行される
        if (eventName) {
            // 以下追記
            axios
                .post('/calendar', {
                    start_date: info.start.valueOf(),
                    end_date: info.end.valueOf(),
                    name: eventName,
                })
                .then((response) => {
                    // イベントの追加
                    calendar.addEvent({
                        //id: response.date.id,
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
    events: function (info, successCallback, failureCallback) {
        console.log("カレンダー取得");
        axios
            .post("/calendar/event", {
                start_date: info.start.valueOf(),
                end_date: info.end.valueOf(),
            })
            .then(response => {
                // 追加したイベントを削除
                calendar.removeAllEvents();
                // カレンダーに読み込み
                successCallback(response.data);
            })
            .catch(() => {
                // バリデーションエラーなど
                alert("取得に失敗しました");
            });
    },
    eventDrop: function(info) {
        const id = info.event._def.publicId;  // イベントのDBに登録されているidを取得
        console.log(id);
        axios
            .post(`/calendar/${id}`, {
                start_date: info.event._instance.range.start.valueOf(),
                end_date: info.event._instance.range.end.valueOf(),
            })
            .then(() => {
                alert("登録に成功しました！");
            })
            .catch(() => {
                // バリデーションエラーなど
                alert("登録に失敗しました");
            });
    },
});

// レンダリング
calendar.render();