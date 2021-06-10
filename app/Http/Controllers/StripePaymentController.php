<?php

namespace App\Http\Controllers;
use Stripe;

use Illuminate\Http\Request;

class StripePaymentController extends Controller
{
    public function checkout()
    {   
        // Enter Your Stripe Secret
        \Stripe\Stripe::setApiKey('sk_test_51IduU6SB7eYJs6WF1kEQSegju0vUyUiuYZNWP2Bos78pIskTU2m087zBJMVUG1yKOZJUO6GH4I6vyXhpqns3CH6w00PYCTy92h');
        		
		$amount = 100;
		$amount *= 100;
        $amount = (int) $amount;
        
        $payment_intent = \Stripe\PaymentIntent::create([
			'description' => 'Stripe Test Payment',
			'amount' => $amount,
			'currency' => 'INR',
			'description' => 'Payment From Yash Codetrinity',
			'payment_method_types' => ['card'],
		]);
		$intent = $payment_intent->client_secret;

		return view('stripe',compact('intent'));

    }

    public function afterPayment()
    {
        echo 'Payment Has been Received';
    }
}