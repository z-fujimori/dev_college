//import '@fullcalendar/core/vdom'; // （for Vite）ver6には不要なので、エラーが出たらここを消す。
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from "@fullcalendar/interaction";  // 追記（イベント追加ー）
import axios from 'axios';  // 追記(DB接続)



// idがcalendarのDOMを取得
var calendarEl = document.getElementById("calendar");

// カレンダーの設定
let calendar = new Calendar(calendarEl, {
    plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin], // 

    timeZone: 'Asia/Tokyo',

    // 最初に表示させる形式
    // initialView: "dayGridMonth",
    initialView: "timeGridWeek",
    // initialView: "timeGridDay",

    // ヘッダーの設定（左/中央/右）
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "",
    },

    allDaySlot: false,
    
    slotMinTime: "10:00:00",
    slotMaxTime: "22:00:00",
    
    slotLabelInterval:　"01:00",
    
    expandRows: true, // 行の高さを調整
    
    
    // 以下追記
    selectable: true,  // 複数日選択可能
    select: function (info) {  // 選択時の処理
        console.log(info.start);
        console.log(info.start.valueOf());
        console.log("a");
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
                .then(() => {
                    // イベントの追加
                    calendar.addEvent({
                        title: eventName,
                        start: info.start,
                        end: info.end,
                        allDay: false,
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
                alert("失敗しました");
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
    eventClick: function(info){
        
    },
});

// レンダリング
calendar.render();