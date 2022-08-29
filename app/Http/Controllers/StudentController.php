<?php

namespace App\Http\Controllers;

use App\Models\Problem_request;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function studentregister(Request $req){
        $student=User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'type'=>'student',
            'password'=>Hash::make($req->password)
        ]);
        if($student){
            return response()->json([$student,'status'=>true]);
        }
        else{
            return response()->json(['status'=>false]);
        }

    }


    public function update(Request $request)
    {
         $student =Auth::user();
         $input = $request->all();
        $student->fill($input);
         $student->save();
         return response()->json([
            "success" => true,
            "message" => "Student updated successfully.",
            "data" => $student
            ]);

         }


    // public function studentregister1(Request $req){
    //     $student=User::create([
    //         'name'=>$req->name,
    //         'email'=>$req->email,
    //         'subject'=>$req->subject,
    //         'password'=>Hash::make($req->password)
    //     ]);
    //     if($student){
    //         return response()->json([$student,'status'=>true]);
    //     }
    //     else{
    //         return response()->json(['status'=>false]);
    //     }

    //    return $this->createNewToken($token);0000
    // }

    // protected function createNewToken($token){
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth()->factory()->getTTL() * 60,
    //         'user' => auth()->user()
    //     ]);
    // }

    // public function login(Request $request){

    //     $user = User::where('email', '=', $request->email)->first();
    //     if(!$user) return "Email does Not found";
    //     if (! $token = auth()->guard('student-api')->attempt([
    //         'email'=>$request->email,
    //         'password'=>$request->password,
    //         'type'=>"$user->type",
    //         // 'type'=> "$user ?? $user->type",



    //     ])) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }
    //     return[
    //         'token'=>$token,
    //         'data'=>$user,

    //     ];}

    public function student()
    {

        return response()->json(auth()->guard('student-api')->user());
    }

    public function requested_problem()
    {

        $student_id=Auth::user()->id;
        $requested_problem=Problem_request::get()->where('users_id', "$student_id");

        return $requested_problem;

}

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function studentlogout()
    {
        auth()->guard('student-api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

}
