<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Problem_request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

public function index(){
    return Auth::user();
}

    public function handlePost(Request $request)
    {
        // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // Stripe\Charge::create ([
        //         // "id"=>Auth::id(),
        //         "object"=> "charge",
        //         "amount" => 100 * 50,
        //         "currency" => "usd",
        //         "source" => $request->id,
        //         "description" => "Payment successful",
        //         // "billing_details"=> [
        //         //     "address"=>$address,
        //         //     "email"=> $email,
        //         //     "name"=> $name,
        //         // ],

        // ]);

        $stripe = new \Stripe\StripeClient(
  'sk_test_51LBF4EHRMz4hUhDWWn0I5WPDdTEDsLPNwKne7mIldHiMvfRjelb6cURQvXMaG0V1w3PsPVsaHkD5qGEvyA1A2caE00fHNNnZMQ'
);
$stripe->charges->create([
  'amount' => 2000,
  'currency' => 'usd',
  'source' => 'tok_visa',
  'description' => 'My First Test Charge (created for API docs at https://www.stripe.com/docs/api)',
]);
return $stripe->charges;
    }
    public function test()
    {
        $stripe = new \Stripe\StripeClient(
            'pk_test_51LBF4EHRMz4hUhDWtL7J37dd7c0DJ0xuXVIOyEkqiLQbdaJVPlrhz3cw0FiDw8Y7qNH4ts2hqJQe2TgztUXyTKSD00idxoSdTi'
          );
          $stripe->charges->create([
            'amount' => 2000,
            'currency' => 'usd',
            'source' => 'tok_visa',
            'description' => 'My First Test Charge (created for API docs at https://www.stripe.com/docs/api)',
          ]);
          $stripe->customers->create([
            'description' => 'My First Test Customer (created for API docs at https://www.stripe.com/docs/api)',
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
