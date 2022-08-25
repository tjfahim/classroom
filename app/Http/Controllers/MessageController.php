<?php

namespace App\Http\Controllers;

use App\Models\message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
public function index(Request $request)
{
    return message::where('teachers_id',$request->teachers_id)->where('users_id', Auth::user()->id)->latest()->get();
}

    public function store(Request $request)
    {
        $message = message::create([
            "users_id"=>Auth::user()->id,
            "teachers_id"=>$request->teachers_id,
            'message'=>$request->message
        ]);

        return response()->json([
        "success" => true,
        "message" => "message created successfully.",
        "data" => $message
        ]);}

}
