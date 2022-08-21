<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function studentregister(Request $req){
        $student=User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'subject'=>$req->subject,
            'password'=>Hash::make($req->password)
        ]);
        if($student){
            return response()->json([$student,'status'=>true]);
        }
        else{
            return response()->json(['status'=>false]);
        }
    }

    public function studentlog(Request $request){
        $credentials = $request->only('email', 'password');

        if (! $token = auth()->guard('student-api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $token;
    }

    public function student()
    {
        return response()->json(auth()->guard('student-api')->user());
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
