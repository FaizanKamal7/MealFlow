<?php

namespace Modules\FinanceService\Helper;

use Exception;
use Stripe\Exception\CardException;
use Stripe\StripeClient;


class PaymentHelper
{

    private $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
    }
    public function createStripeCharge($card_data)
    {   
        $charge = null;
        try {

            $charge = $this->stripe->charges->create([
                    "amount" => $card_data['amount'] *100,
                    "currency" => "usd",
                    "source" => $card_data['stripe_token'],
                    "description" => "monthly subscription" 
          
            ]);

        }catch(CardException $e){
            $charge['error'] = $e->getError()->message;
        }catch(Exception $e){
            $charge['error'] = $e->getMessage();

        }

        return $charge;
    }

    public function createStripeSession($card_data){

        $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
        $session = null;
        $session = $this->stripe->checkout->sessions->create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'USD',
                        'product_data' => [
                            "name" => "test product",
                        ],
                        'unit_amount'  =>$card_data['amount'] *100,
                    ],
                    'quantity'   => 1,
                ],
                 
            ],
            'mode'        => 'payment',
            'success_url' => $baseUrl.'/businessservice/wallet/credit/paymentSuccess/{CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('storeCredit'),
        ]);

        return $session;
    }

    public function retrieveSession($id){
        $session = null;

        try {
            $session = $this->stripe->checkout->sessions->retrieve($id,['expand'=>['payment_intent.payment_method']]);

        }catch (Exception $e){
            $session["error"] = $e->getMessage();
        }
        return $session;
    }
}