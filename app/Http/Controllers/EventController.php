<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    // カレンダー表示
    public function show(){
        return view("calendar/calendar");
    }
    
    public function store(Request $request)
    {
        $event = new Event;
        // 日付に変換。JavaScriptのタイムスタンプはミリ秒なので秒に変換
        $event->start_date = date('Y-m-d H:i:s', $request->input('start_date') / 1000);
        $event->end_date = date('Y-m-d H:i:s', $request->input('end_date') / 1000);
        $event->name = $request->input('name');
        $event->body = $request->input('body');
        $event->color = $request->input('color');
        $event->save();
    }

    public function getEvent(Request $request)
    {
        // カレンダー表示期間
        $start_date = date('Y-m-d H:i:s', $request->input('start_date') / 1000 );
        $end_date = date('Y-m-d H:i:s', $request->input('end_date') / 1000 );
    
        // 登録処理
        return Event::query()
            ->select(
                // FullCalendarの形式に合わせる
                'start_date as start',
                'end_date as end',
                'name as title',
                'id',
                'color'
            )
            // FullCalendarの表示範囲のみ表示
            ->where('end_date', '>', $start_date)
            ->where('start_date', '<', $end_date)
            ->get();
    }
    
    public function update(Request $request, Event $event)
    {
        $input = new Event();
    
        $input->name = $request->input('name');
        $input->body = $request->input('body');
        $input->color = $request->input('color');
        
        dd($input);
    
        // 更新する予定をDBから探し（find）、内容が変更していたらupdated_timeを変更（fill）して、DBに保存する（save）
        $event->find($request->input('id'))->fill($input->attributesToArray())->save();
        // fill()の中身はArray型が必要だが、$inputのままではコレクションが返ってきてしまうため、Array型に変換
        
        return view("calendar/calendar");
    }
}