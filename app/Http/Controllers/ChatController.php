<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;
// use App\Models\Message; // LibraryでMessageクラスを使っているためこれを使うならモデルから名前を変更してください
use App\Models\User;
use App\Models\ChatModel;
use App\Models\Direct_message;

use App\Library\Chat;   // for new Message;
use App\Events\MessageSent; // for MessageSent::dispatch()


class ChatController extends Controller
{
    public function __construct()
    {
        // 認証されたユーザーだけが、このコントローラのページにアクセスすることができる。
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        return view('chat')->with(['users'=>$user->get()]);
    }
    
    public function openChat(User $user)
    {
        // 自分と相手のIDを取得
        $myUserId = auth()->user()->id;
        $otherUserId = $user->id; // ここで相手のユーザーIDを指定

        // データベース内でチャットが存在するかを確認
        $chat = ChatModel::where(function($query) use ($myUserId, $otherUserId) {
            $query->where('owner_id', $myUserId)
                ->where('guest_id', $otherUserId);
        })->orWhere(function($query) use ($myUserId, $otherUserId) {
            $query->where('owner_id', $otherUserId)
                ->where('guest_id', $myUserId);
        })->first();

        // チャットが存在しない場合、新しいチャットを作成
        if (!$chat) {
            $chat = new ChatModel();
            $chat->owner_id = $myUserId;
            $chat->guest_id = $otherUserId;
            $chat->save();
        }

        $messages = Direct_message::where('chat_id', $chat->id)->orderBy('updated_at', 'DESC')->get();;
        
        $allUser = new User;

        return view('chats/chat')->with(['chat' => $chat, 'messages' => $messages, 'users'=>$allUser->get()]);
    }
    
    // メッセージ送信時の処理
    public function sendMessage(Direct_message $direct_message, Request $request )
    {
        // auth()->user() : 現在認証しているユーザーを取得
        $user = auth()->user();
        $strUserId = $user->id;
        $strUsername = $user->name;
        
        // リクエストからデータの取り出し
        $strMessage = $request->input('message');
        
        // メッセージオブジェクトの作成と公開メンバー設定
        $chat = new Chat;
        $chat->body = $strMessage;
        $chat->userName = $strUsername;
        $chat->chat_id = $request->input('chat_id');
       
        // 送信者を含めてメッセージを送信
        //event( new MessageSent( $message ) ); // Laravel V7までの書き方
        MessageSent::dispatch($chat);    // Laravel V8以降の書き方
        
        //データベースへの保存処理
        $direct_message->user_id = $strUserId;
        $direct_message->body = $strMessage;
        $direct_message->chat_id = $request->input('chat_id');
        $direct_message->save();
        
        // 送信者を除いて他者にメッセージを送信
        // Note : toOthersメソッドを呼び出すには、
        //        イベントでIlluminate\Broadcasting\InteractsWithSocketsトレイトをuseする必要がある。
        //broadcast( new MessageSent($message))->toOthers();
        
        //return ['message' => $strMessage];
        return response()->json(['message' => 'Message sent successfully']);
    }
}
