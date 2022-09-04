<?php

namespace App\Http\Controllers;

use App\Models\message;
use App\Models\Problem_request;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function teacherregister(Request $req){
        $teacher=User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'type'=>'teacher',
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


    // public function teacherlog(Request $request){
    //     $credentials = $request->only('email', 'password');

    //     if (! $token = auth()->guard('teacher-api')->attempt($credentials)) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     return $token;
    // }


    public function update(Request $request)
    {
         $teacher =Auth::user();
         $input = $request->all();
        $teacher->fill($input);
         $teacher->save();
         return response()->json([
            "success" => true,
            "message" => "Teacher updated successfully.",
            "data" => $teacher
            ]);

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

    public function statusupdate(Request $request, $id)
            {

                $updateproblem = Problem_request::find($id);

                $updateproblem->teacher_id=$request->teacher_id=Auth::user()->id;
                $updateproblem->status = $request->status=1;
                $updateproblem->update();
                return response()->json([
                    "success" => true,
                    "message" => "Problem updated successfully.",
                    "data" => $updateproblem
                    ]);

        }
     public function calendaradd($id)
        {
            $calendaradd = Problem_request::find($id);
            // return $calendaradd->date;
            $data= collect([

                    'date' =>$calendaradd->date,
                   'start_time' =>$calendaradd->start_time,
                    'title' =>$calendaradd->end_time,
                    'subject' =>$calendaradd->description,
                    'end_time' =>$calendaradd->title,
                    'description' =>$calendaradd->subject
            ]);

            return response()->json([
                'data' => $data->toArray()
            ]);
    }


        // public function changeStatus(Request $request, $id)
        //     {
        //         $updateproblem = Problem_request::find($id);


        //     return $updateproblem;

        // }
            public function available_problem()
                {
                    $available_problem=Problem_request::where('status', '0')->paginate(12);
                    return $available_problem;

        }
            public function accepted_problem()
                {
                    $teacher_id=Auth::user()->id;
                    $accepted_problem=Problem_request::where('teacher_id', "$teacher_id")->paginate(12);
                    return $accepted_problem;
        }

        public function message()
        {

            // return message::pluck('message','created_at');

            return message::pluck('message','created_at');


}



}
