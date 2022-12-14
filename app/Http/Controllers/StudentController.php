<?php

namespace App\Http\Controllers;

use App\Models\Problem_request;
use App\Models\problem_request_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function join_class($id)
    {

        $Problem_request = Problem_request::find($id);

        $userIds = [Auth::user()->id];
        $Problem_request->users()->attach($userIds);
        return response()->json([
            "success" => true,
            "message" => "group_student_id updated successfully.",
            "data" =>$Problem_request,
            ]);
        // return $Problem_request->pivot->Problem_request_id;

}
    public function requested_problem()
    {

        $student_id=Auth::user()->id;
        $requested_problem=Problem_request::where('users_id', "$student_id")->paginate(12);
        return $requested_problem;

}
    public function requested_problem_id($id)
    {

        $student_id=Auth::user()->id;
        $group_problems=Problem_request::where('users_id', "$student_id")->get();
        return $group_problems[$id];

}

    public function requested_group_problem()
    {

        $student_id=Auth::user()->id;
        $requested_problem=DB::table('problem_request_user')->where('user_id', "$student_id")->paginate(12);

        return $requested_problem;

}
    public function requested_group_problem_id($id)
    {

        $student_id=Auth::user()->id;
        $requested_problem=DB::table('problem_request_user')->where('user_id', "$student_id")->get();
        $group_problems = json_decode($requested_problem, true);
        return $group_problems[$id];

}
    public function all()
    {

    // $student_id=Auth::user()->id;
    // $requested_problem=Problem_request::select('users_id');
    // $requested_group_problem=DB::table('problem_request_user')->select('problem_request_id')->union($requested_problem)->get();

    $first = DB::table('problem_requests')
    ->selett('users_id');

    $users = DB::table('problem_request_user')
        ->select('problem_request_id')
        ->union($first)
        ->get();
        return $users;
    // return $requested_group_problem;
    // return $requested_group_problem->union($requested_problem);

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
