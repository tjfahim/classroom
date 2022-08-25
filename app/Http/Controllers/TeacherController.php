<?php

namespace App\Http\Controllers;

use App\Models\Problem_request;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function teacherregister(Request $req){
        $teacher=Teacher::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'qualification'=>$req->qualification,
            'password'=>Hash::make($req->password)
        ]);
        if($teacher){
            return response()->json([$teacher,'status'=>true]);
        }
        else{
            return response()->json(['status'=>false]);
        }
    }
    // public function teacherregister1(Request $req){
    //     $teacher=Teacher::create([
    //         'name'=>$req->name,
    //         'email'=>$req->email,
    //         'qualification'=>$req->qualification,
    //         'password'=>Hash::make($req->password)
    //     ]);
    //     if($teacher){
    //         return response()->json([$teacher,'status'=>true]);
    //     }
    //     else{
    //         return response()->json(['status'=>false]);
    //     }
    //     $credentials = $req->only('email', 'password');

    //     if (! $token = auth()->guard('teacher-api')->attempt($credentials)) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     return $token;
    // }


    public function teacherlog(Request $request){
        $credentials = $request->only('email', 'password');

        if (! $token = auth()->guard('teacher-api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $token;
    }

    public function teacher()
    {
        return response()->json(auth()->guard('teacher-api')->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function teacherlogout()
    {
        auth()->guard('teacher-api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function update(Request $request, $id)
            {
                $updateproblem = Problem_request::find($id);

                $updateproblem->status = $request->status=1;
                $updateproblem->update();
                return response()->json([
                    "success" => true,
                    "message" => "Problem updated successfully.",
                    "data" => $updateproblem
                    ]);


        }


        // public function changeStatus(Request $request, $id)
        //     {
        //         $updateproblem = Problem_request::find($id);


        //     return $updateproblem;

        // }
            public function available_problem()
                {
                    $available_problem=Problem_request::get()->where('status', '0');
                    // if($available_problem==0){
                    // }
                    return $available_problem;

        }

}
