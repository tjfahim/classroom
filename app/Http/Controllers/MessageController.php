<?php

namespace App\Http\Controllers;

use App\Models\message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        // return message::where('teachers_id',$request->teachers_id)->where('users_id', Auth::user()->id)->latest()->get();

        // return message::where('teachers_id',$request->teachers_id)->where('users_id', Auth::user()->id)->latest()->get();

        return message::pluck('message','created_at');

    }

    public function store(Request $request)
    {

        return Auth::user();
        $message = new message;

        $message->student_id=auth()->user->type == 'teacher' ? $request->data_id : auth()->user->id;
        $message->teachers_id=auth()->user->type == 'teacher' ? auth()->user->id : $request->data_id;
        // $message->teachers_id=$request->teachers_id;
        $message->message=$request->message;
        $message->save()
        ;


        return response()->json([
        "success" => true,
        "message" => "message created successfully.",
        "data" => $message
        ]);}

}
