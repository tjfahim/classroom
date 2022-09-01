<?php

namespace App\Http\Controllers;

use App\Models\Problem_request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
class Problem_RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $problem = Problem_request::all();
        // return response()->json([
        // "success" => true,
        // "message" => "Problem List",
        // "data" => $problem]);
        $student_id=Auth::user()->id;
        $requested_problem=Problem_request::where('users_id',  '!=',"$student_id")->paginate(12);
        return $requested_problem;
    //    $myid= Auth::user()->id;
    //     return Problem_request::whereNotIn('users_id', "$myid")->paginate(12);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
            public function store(Request $request)
            {
        //         $input = $request->all();
        //         $validator = Validator::make($input, [
        //         'title' => 'required',
        //         'description' => 'required',
        //         'subject' => 'required',
        //         'image' => 'required',
        //         'date' => 'required',
        //         ]);
        //         if($validator->fails()){
        //         return $this->sendError('Validation Error.', $validator->errors());
        //         }
        //         $problem = Problem_request::create($input);
        //         return response()->json([
        //         "success" => true,
        //         "message" => "Problem created successfully.",
        //         "data" => $problem
        // ]);


        // $input=new Problem_request();
        // $input->title = $request->Problem_request['title'];
        // $input->description = $request->Problem_request['description'];
        // $input->subject = $request->Problem_request['subject'];
        // $input->image = $request->Problem_request['image'];
        // $input->date = $request->Problem_request['date'];
        // $input->status = $request->Problem_request['status'];

        // $input->save();
        // return $input;
        //     }

       $input = $request->all();

        // $validator = Validator::make($input, [
        // 'title' => 'required',
        // 'description' => 'required',
        // 'subject' => 'required',
        // 'image' => 'required',
        // 'date' => 'required',
        // ]);
        // if($validator->fails()){
        // return $this->sendError('Validation Error.', $validator->errors());
        // }



        // $problem = Problem_request::create($input);


        // return response()->json([
        // "success" => true,
        // "message" => "problem created successfully.",
        // "data" => $problem
        // ]);}




        $problem = Problem_request::create([
          "users_id"=>Auth::user()->id,
            "title"=>$request->title,
            'description'=>$request->description,
            'subject'=>$request->subject,
            'date'=>$request->date,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
            'image'=>$request->image,
            'status'=>0,

        ]);

        return response()->json([
                "success" => true,
                "message" => "problem created successfully.",
                "data" => $problem
                ]);}




// public function store(Request $request)
//     {
//         $item=new Problem_request();
//         $item->title = $request->Problem_request['title'];
//         $item->description = $request->Problem_request['description'];
//         $item->subject = $request->Problem_request['subject'];
//         $item->image = $request->Problem_request['image'];
//         $item->date = $request->Problem_request['date'];

//         $item->save();
//         return $item;
//     }

    // public function store(Request $request)
    // {
    //     $problem=new Problem_request();
    //     $problem->title = $request->Problem['title'];
    //     $problem->description = $request->Problem['description'];
    //     $problem->subject = $request->Problem['subject'];
    //     $problem->image = $request->Problem['image'];
    //     $problem->date = $request->Problem['date'];

    //     $problem->save();
    //     return $problem;
    // }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $problem = Problem_request::find($id);
        if (is_null($problem)) {
        return $this->sendError('Problem not found.');
        }
        return response()->json([
        "success" => true,
        "message" => "Problem retrieved successfully.",
        "data" => $problem
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Problem_request $problem)
    // {
    //     $input = $request->all();
    //     $validator = Validator::make($input, [
    //     'title' => 'required',
    //     'description' => 'required',
    //     'image' => 'required',
    //     'date' => 'required',
    //     'subject' => 'required'
    //     ]);
    //     // if($validator->fails()){
    //     // return $this->sendError('Validation Error.', $validator->errors());
    //     // }
    //     $problem->title = $input['title'];
    //     $problem->description = $input['description'];
    //     $problem->image = $input['image'];
    //     $problem->date = $input['date'];
    //     $problem->subject = $input['subject'];
    //     $problem->save();
    //     return response()->json([
    //     "success" => true,
    //     "message" => "problem updated successfully.",
    //     "data" => $problem
    //     ]);



    // }


    // public function update(Request $request, Problem_request $problem)
    // {

    // $problem->title = $request->title;
    //     $problem->description = $request->description;
    //     $problem->image = $request->image;
    //     $problem->date = $request->date;
    //     $problem->subject = $request->subject;
    //     $problem->save();
    //     return response()->json([
    //     "success" => true,
    //     "message" => "problem updated successfully.",
    //     "data" => $problem
    //     ]);


    public function update(Request $request, $id)
    {
        $updateproblem = Problem_request::find($id);
        $input = $request->all();
        // $updateproblem->title = $request->$input['title'];
        //     $updateproblem->description = $request->$input['description'];
        //     $updateproblem->subject = $request->$input['subject'];
        //     $updateproblem->image = $request->$input['image'];
        //     $updateproblem->date = $request->$input['date'];
        //     $updateproblem->save();
        $updateproblem->fill($input);
        $updateproblem->save();

        return response()->json([
            "success" => true,
            "message" => "Problem updated successfully.",
            "data" => $updateproblem
            ]);

         }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */





    public function destroy(Problem_request $problem)
    {
        $problem->delete();
        return response()->json([
        "success" => true,
        "message" => "Problem deleted successfully.",
        "data" => $problem
        ]);
        }
        // public function changeStatus(Problem_request $problem, Request $request)
        // {
        //     $problem = Problem_request::find($request->id)->update(['status' => $request->status]);

        //     return response()->json([
        //         "success" => true,
        //         "message" => "Problem deleted successfully.",
        //         "data" => $problem
        //         ]);
        // }


}









