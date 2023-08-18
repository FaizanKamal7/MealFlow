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
}