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


public function retest(){
    return Auth::user();
}

    public function handlePost(Request $request)
    {

        $stripe = new \Stripe\StripeClient(
            'sk_test_51LBF4EHRMz4hUhDWWn0I5WPDdTEDsLPNwKne7mIldHiMvfRjelb6cURQvXMaG0V1w3PsPVsaHkD5qGEvyA1A2caE00fHNNnZMQ'
          );
          $stripe->charges->create ([
                "object"=> "charge",
                "amount" => 100 * 50,
                "currency" => "usd",
                "source" => $request->id,
                "description" => "Payment successful",
        ]);
        // $stripe->customers->create([
        //     'description' => 'My First Test Customer (created for API docs at https://www.stripe.com/docs/api)',
        //     'name'=>Auth::user()->name,
        //     'phone'=>Auth::user()->phone,
        //     'email'=>Auth::user()->email,
        //     'address'=>Auth::user()->address,
        //     ]);


    }
    
    public function post(Request $request)
    {

        $stripe = new \Stripe\StripeClient(
            'sk_test_51LBF4EHRMz4hUhDWWn0I5WPDdTEDsLPNwKne7mIldHiMvfRjelb6cURQvXMaG0V1w3PsPVsaHkD5qGEvyA1A2caE00fHNNnZMQ'
          );


         $customer=  $stripe->customers->create([
                'description' => 'My First Test Customer (created for API docs at https://www.stripe.com/docs/api)',
                'name'=>Auth::user()->name,
                'phone'=>Auth::user()->phone,
                'email'=>Auth::user()->email,
                'address'=>Auth::user()->address,
                ]);
        $stripe->customers->createSource(
            $customer->id,
            ['source' => $request->id]
        );
        $stripe->charges->create([
            'customer'=>$customer['id'],
            'amount' => 2000,
            'currency' => 'usd',
            'description' => 'My First Test Charge (created for API docs at https://www.stripe.com/docs/api)',
            ]);


    }







}
