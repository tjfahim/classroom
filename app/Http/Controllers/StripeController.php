<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Problem_request;
use App\Models\problem_request_user;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe;
use Session;
class StripeController extends Controller
{
    /**
     * payment view
     */
    public function handleGet()
    {
        return view('payment');
    }




    public function payment(Request $request,$id)
    {


       $student_id=Auth::user()->id;
       $single_problems=Problem_request::where('users_id', "$student_id")->get();
       $problem= $single_problems[$id];

       $requested_problem = Problem_request::find($problem->id)->id;
       $group_problem_user=DB::table('problem_request_user')->where('problem_request_id', "$requested_problem")->get();
       $group_total_member =   json_encode(count($group_problem_user))+1;


        $stripe = new \Stripe\StripeClient(
            'sk_test_51LBF4EHRMz4hUhDWWn0I5WPDdTEDsLPNwKne7mIldHiMvfRjelb6cURQvXMaG0V1w3PsPVsaHkD5qGEvyA1A2caE00fHNNnZMQ'
          );

          $token=$stripe->tokens->create([
            'card'=>[
                'number'=>$request->number,
                'exp_month'=>$request->exp_month,
                'exp_year'=>$request->exp_year,
                'cvc'=>$request->cvc,
            ]
            ]);

         $customer=  $stripe->customers->create([
                'description' => 'My First Test Customer (created for API docs at https://www.stripe.com/docs/api)',
                'name'=>Auth::user()->name,
                'phone'=>Auth::user()->phone,
                'email'=>Auth::user()->email,
                'address'=>Auth::user()->address,
                ]);
        $stripe->customers->createSource(
            $customer->id,
            ['source' => $token['id']]

        );
        if($group_total_member>1){
            $charge= $stripe->charges->create([
                'customer'=>$customer['id'],
                'amount' => round(100/$group_total_member*100),
                'currency' => 'usd',
                'description' => 'My First Test Charge (created for API docs at https://www.stripe.com/docs/api)',
                ]);
        }else{
            $charge= $stripe->charges->create([
                'customer'=>$customer['id'],
                'amount' => 100*100,
                'currency' => 'usd',
                'description' => 'My First Test Charge (created for API docs at https://www.stripe.com/docs/api)',
                ]);
            }


        if($charge['status']=='succeeded'){
            $transection =new Payment();
            $transection->stdt_id=Auth::user()->id;
            $transection->prblm_id=$problem->id;
            $transection->status='approved';
            $transection->charge_id=$charge['id'];
            $transection->save();
            }



    }



    public function group_payment(Request $request,$id)
    {


        $student_id=Auth::user()->id;
        $group_problems=DB::table('problem_request_user')->where('user_id', "$student_id")->get();
        $problem=$group_problems[$id];


        $requested_problem = Problem_request::find($problem->id)->id;
        $group_problem_user=DB::table('problem_request_user')->where('problem_request_id', "$requested_problem")->get();
        $group_total_member =   json_encode(count($group_problem_user))+1;


        $stripe = new \Stripe\StripeClient(
            'sk_test_51LBF4EHRMz4hUhDWWn0I5WPDdTEDsLPNwKne7mIldHiMvfRjelb6cURQvXMaG0V1w3PsPVsaHkD5qGEvyA1A2caE00fHNNnZMQ'
          );

          $token=$stripe->tokens->create([
            'card'=>[
                'number'=>$request->number,
                'exp_month'=>$request->exp_month,
                'exp_year'=>$request->exp_year,
                'cvc'=>$request->cvc,
            ]
            ]);


         $customer=  $stripe->customers->create([
                'description' => 'My First Test Customer (created for API docs at https://www.stripe.com/docs/api)',
                'name'=>Auth::user()->name,
                'phone'=>Auth::user()->phone,
                'email'=>Auth::user()->email,
                'address'=>Auth::user()->address,
                ]);
        $stripe->customers->createSource(
            $customer->id,
            ['source' => $token['id']]

        );
        $charge= $stripe->charges->create([
            'customer'=>$customer['id'],
            'amount' => round(100*100/$group_total_member),
            'currency' => 'usd',
            'description' => 'My First Test Charge (created for API docs at https://www.stripe.com/docs/api)',
            ]);

        if($charge['status']=='succeeded'){

            $transection =new Payment();
            $transection->stdt_id=Auth::user()->id;
            $transection->prblm_id=$problem->id;
            $transection->status='approved';
            $transection->charge_id=$charge['id'];
            $transection->save();

            }

    }


    // public function refund($id){

    //     $stripe = new \Stripe\StripeClient(
    //         'sk_test_51LBF4EHRMz4hUhDWWn0I5WPDdTEDsLPNwKne7mIldHiMvfRjelb6cURQvXMaG0V1w3PsPVsaHkD5qGEvyA1A2caE00fHNNnZMQ'
    //       );



    //    $student_id=Auth::user()->id;
    //    $single_problems=Problem_request::where('users_id', "$student_id")->get();
    //    $problem= $single_problems[$id];

    //    $requested_problem = Problem_request::find($problem->id)->id;
    //    $group_problem_user=DB::table('problem_request_user')->where('problem_request_id', "$requested_problem")->get();
    //    $group_total_member =   json_encode(count($group_problem_user))+1;



    //     $charge_id= Payment::get()->charge_id;
    //     $stripe->refunds->create([
    //         'charge' => $charge_id,
    //         'amount' => (100*100/ $group_total_member)-(100*100),
    //         'reason' => 'refund'
    //     ]);
    // }
    // public function group_refund($id){

    //     $stripe = new \Stripe\StripeClient(
    //         'sk_test_51LBF4EHRMz4hUhDWWn0I5WPDdTEDsLPNwKne7mIldHiMvfRjelb6cURQvXMaG0V1w3PsPVsaHkD5qGEvyA1A2caE00fHNNnZMQ'
    //       );


    //       $student_id=Auth::user()->id;
    //       $group_problems=DB::table('problem_request_user')->where('user_id', "$student_id")->get();
    //       $problem=$group_problems[$id];


    //       $requested_problem = Problem_request::find($problem->id)->id;
    //       $group_problem_user=DB::table('problem_request_user')->where('problem_request_id', "$requested_problem")->get();
    //       $group_total_member =   json_encode(count($group_problem_user))+1;

    //     $charge_id= Payment::get()->charge_id;
    //     $stripe->refunds->create([
    //         'charge' => $charge_id,
    //         'amount' => (100*100/ $group_total_member)-(100*100),
    //         'reason' => 'refund'
    //     ]);
    // }





}



