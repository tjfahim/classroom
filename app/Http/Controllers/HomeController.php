<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    // public function login(Request $request){
    //      $user = User::where('email', '=', $request->email)->first();
    //      if(!$user) {
    //         return response()->json(['error' => 'Email or password does not match'], 404);
    //     }

    //      if (!Auth::attempt($request->only('email', 'password'))) {
    //         return response()->json([
    //             'message' => 'Invalid login details'
    //         ], 401);
    //     }
    //     $user = User::where('email', $request['email'])->firstOrFail();
    //     $token = $user->createToken('auth_token')->plainTextToken;

    //     return[
    //         'token'=>$token,
    //         'token_type' => 'Bearer',
    //     ];
    // }

    public function login(Request $request){
     $user = User::where('email', '=', $request->email)->first();
       if($user->type=='student'){
        $guard='student-api';
       }
       else if($user->type=='teacher') {
        $guard='teacher-api';
       }

       if(!$user) return "Email does Not found";
       if (! $token = auth()->guard("$guard")->attempt([
           'email'=>$request->email,
           'password'=>$request->password,
       ]))
       {
           return response()->json(['error' => 'Unauthorized'], 401);
       }
       return[
           'token'=>$token,
           'data'=>$user,

       ];
   }


//     public function logout()
//     {
//        if(auth()->guard('teacher-api')->logout()){
// return response()->json(['message' => 'Successfully logged out']);
//        }
//        elseif(auth()->guard('student-api')->logout()){

//        }

//        return response()->json(['message' => 'Successfully logged out']);

//        ;
//     }

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
