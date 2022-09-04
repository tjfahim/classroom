<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Problem_request;
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



    public function handlePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 150,
                "currency" => "tk",
                "source" => $request->stripeToken,
                "description" => "Making test payment1"
        ]);
    }










    /**
     * handling payment with POST
     */
    // public function handlePost(Request $request )
    // {
    //     // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    //     // Stripe\Charge::create ([
    //     //         "amount" => 100 * 150,
    //     //         "currency" => "inr",
    //     //         "source" => $request->stripeToken,
    //     //         "description" => "Making test payment."
    //     // ]);

    //     // Session::flash('success', 'Payment has been successfully processed.');

    //     // return back();


    //         $stripe=Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    //         // $order=Problem_request::get();
    //         try{
    //             $token=$stripe->tokens()->create([
    //                 'card'=>[
    //                     'number'=>$request->card_no,
    //                     'exp_month'=>$request->exp_month,
    //                     'exp_year'=>$request->exp_year,
    //                     'cvc'=>$request->cvc,
    //                 ]
    //                 ]);
    //                 if(!isset($token['id'])){
    //                    return 'stripe_error The stripe token was not generated correctly';

    //                 }
    //                 $customer= $stripe->customers()->create([
    //                     'name'=>$request->firstname,
    //                     'email'=>$request->email,
    //                     // 'phone'=>$request->mobile,
    //                     // 'address'=>$request->address,
    //                     // 'source'=>$token['id']
    //                 ]);
    //                 $charge=$stripe->charges()->create([
    //                     'customer'=>$customer['id'],
    //                     'currency'=>'USD',
    //                     'amount'=>100 * 150,
    //                     'description'=>'Payment for order no',
    //                 ]);
    //                 if($charge['status']=='successed'){
    //                     // $this->makeTransection($order->id,'approved');
    //                     $this->resetCart();
    //                 }
    //                 else{
    //                   return 'stripe_error Successfull in Transaction';

    //                 }
    //         }catch(Exception $e){
    //             $error="exception error";
    //             return [
    //                 $e->getMessage(),
    //                 $error
    //             ];
    //         }


    // }
}
