//import '@fullcalendar/core/vdom'; // （for Vite）ver6には不要なので、エラーが出たらここを消す。
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from "@fullcalendar/interaction";  // 追記（イベント追加ー）
import axios from 'axios';  // 追記(DB接続)




function formatDate(date, pos) {
    const dt = new Date(date);
    if(pos==="end"){
        dt.setDate(dt.getDate() - 1);
    }
    return dt.getFullYear() + '-' +('0' + (dt.getMonth()+1)).slice(-2)+ '-' +  ('0' + dt.getDate()).slice(-2);
};

// idがcalendarのDOMを取得
var calendarEl = document.getElementById("calendar");

// カレンダーの設定
if (calendarEl) {
    let calendar = new Calendar(calendarEl, {
        plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin], // 
    
        timeZone: 'Asia/Tokyo',
    
        // 最初に表示させる形式
        // initialView: "dayGridMonth",
        initialView: "timeGridWeek",
        // initialView: "timeGridDay",
    
        // ヘッダーの設定（左/中央/右）
        headerToolbar: { // ヘッダーの設定
            // コンマのみで区切るとページ表示時に間が空かず、半角スペースで区切ると間が空く（半角があるかないかで表示が変わることに注意）
            start: "prev,next today", // ヘッダー左（前月、次月、今日の順番で左から配置）
            center: "title", // ヘッダー中央（今表示している月、年）
            end: "dayGridMonth,timeGridWeek", // ヘッダー右（月形式、時間形式）
        },
        height: "auto", // 高さをウィンドウサイズに揃える
    
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
            const eventName = prompt("予定を入力してくださ");
            const eventColor = prompt("いろ設定（teal, maroon, purple, olive, green）","teal");
            
            // 入力された時に実行される
            if (eventName && eventColor) {
                // 以下追記
                axios
                    .post('/calendar/store', {
                        start_date: info.start.valueOf(),
                        end_date: info.end.valueOf(),
                        name: eventName,
                        color: eventColor,
                    })
                    .then(() => {
                        // イベントの追加
                        calendar.addEvent({
                            title: eventName,
                            start: info.start,
                            end: info.end,
                            color: eventColor,
                            allDay: false,
                        });
                    })
                    .catch(() => {
                        // バリデーションエラーなど
                        alert("登録に失敗しまし");
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
        eventClick: function(info) {
                // console.log(info.event); // info.event内に予定の全情報が入っているので、必要に応じて参照すること
                document.getElementById("id").value = info.event.id;
                document.getElementById("event_title").value = info.event.title;
                document.getElementById("start_date").textContent = info.event.start;
                document.getElementById("end_date").textContent = info.event.end;
                document.getElementById("event_body").value = info.event.extendedProps.description;
                document.getElementById("event_color").value = info.event.backgroundColor;
        
                // 予定編集モーダルを開く
                document.getElementById('modal-update').style.display = 'flex';
        },
    });
    
    // レンダリング
    calendar.render();
    
    window.closeAddModal = function(){
        document.getElementById('modal-add').style.display = 'none';
    }
    
    //（ここから）追記
    // 予定編集モーダルを閉じる
    window.closeUpdateModal = function(){
        document.getElementById('modal-update').style.display = 'none';
    }
}