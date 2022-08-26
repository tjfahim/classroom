<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function login(Request $request){
         $user = User::where('email', '=', $request->email)->first();
        if(!$user) return "Email does Not found";
        if (! $token = auth()->guard('student-api')->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'type'=>"$user->type",
            // 'type'=> "$user ?? $user->type",



        ])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return[
            'token'=>$token,
            'data'=>$user,

        ];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
