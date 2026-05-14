<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\ChildClass;
use App\Models\Classroom;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class messageController extends Controller
{
       

      public function teacherChat()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $classrooms = $user->classroom;

        $parents = User::where('role', 2)->whereHas('children', function ($query) use ($classrooms) {
            $query->whereHas('classroom', function ($subQuery) use ($classrooms) {
                $subQuery->whereIn('id', $classrooms->pluck('id'));
            });
        })->get();

        return view('chat.teacher', compact('parents'));
    }

    // Giao diện chat của phụ huynh
    public function parentChat()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

       $teachersArray = [];

$children = Child::where('user_id', $user->id)->get();

foreach ($children as $child) {
    $childclass = ChildClass::where('child_id', $child->id)->get();
    $classrooms = Classroom::whereIn('id', $childclass->pluck('classroom_id'))->get();

    $teachers = User::where('role', 1)
                    ->whereHas('classroom', function ($query) use ($classrooms) {
                        $query->whereIn('id', $classrooms->pluck('id'));
                    })->get();

    foreach ($teachers as $teacher) {
        $teachersArray[] = $teacher; 
    }
}$teachersArray = collect($teachersArray)->unique('id')->values()->all();

       if (!$teachersArray || $teachers->isEmpty()) {
            return back()->with('error',' chưa có giáo viên ');
       } else {
        return view('chat.parent', compact('teachers'));
       }
       
    }

  public function sendMessage(Request $request)
{
    $user = Auth::user();
    if (!$user) {
        return response()->json(['error' => 'Bạn chưa đăng nhập'], 401);
    }

    $request->validate([
        'receiver_id' => 'required|exists:users,id',
        'message' => 'required|string',
    ]);

    Message::create([
        'sender_id' => $user->id,
        'receiver_id' => $request->receiver_id,
        'message' => $request->message,
    ]);

    return response()->json(['success' => 'Tin nhắn đã được gửi!']);
}



   public function chatHistory($receiverId)
{
    $user = Auth::user(); 

    $messages = Message::where(function ($query) use ($user, $receiverId) {
        $query->where('sender_id', $user->id)
              ->where('receiver_id', $receiverId);
    })->orWhere(function ($query) use ($user, $receiverId) {
        $query->where('sender_id', $receiverId)
              ->where('receiver_id', $user->id);
    })->orderBy('created_at', 'asc')->get();

    return response()->json($messages);
}
public function getNewMessages(Request $request)
{
    $user = Auth::user();
    $receiverId = $request->receiver_id;

    $lastMessageId = $request->last_message_id;

    $messages = Message::where(function ($query) use ($user, $receiverId) {
        $query->where('sender_id', $receiverId)
              ->where('receiver_id', $user->id);
    })->where('id', '>', $lastMessageId)
      ->orderBy('created_at', 'asc')
      ->get();

    return response()->json($messages);
}

}