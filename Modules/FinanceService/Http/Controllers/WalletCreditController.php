<?php

namespace Modules\FinanceService\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\FinanceService\Helper\PaymentHelper;
use Modules\FinanceService\Interfaces\BusinessCardInterface;
use Stripe;
use Modules\BusinessService\Http\Middleware\BusinessCheck;

class WalletCreditController extends Controller
{

    private $paymentHelper;
    private BusinessCardInterface $businessCardRepository;
    public function __construct(PaymentHelper $payment_helper, BusinessCardInterface $businessCardRepository)
    {
        $this->paymentHelper = $payment_helper;
        $this->businessCardRepository = $businessCardRepository;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('financeservice::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('financeservice::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));




            $validatedData = $request->validate([
                // 'card_number'=> ['required'],
                // 'card_holder_name' =>['required'],
                // 'cvv'=>['required','max:3'],
                // 'expiry_month' =>['required'],
                // 'expiry_year' =>['required'],
                'amount' => ['required'],
                // 'stripe_token'=>[],
                // 'save_card'=>[]
            ]);


            if ($request->save_card) {
                echo "save card";
            }


            $charge = $this->paymentHelper->createStripeSession($validatedData);
            return redirect()->away($charge->url);
       

        } catch (Exception $e) {
            dd($e);
        }
    }


    public function paymentSuccess($session_id)
    {
        $business = view()->shared('business');
        $session = $this->paymentHelper->retrieveSession($session_id);
        $payment_intent = $session->payment_intent;
      
        $this->businessCardRepository->createBusinessCard(
            $payment_intent->payment_method->card['last4'],
            $payment_intent->payment_method->billing_details['name'],
            $payment_intent->payment_method->card['brand'],
            $payment_intent->payment_method->card['exp_month'],
            $payment_intent->payment_method->card['exp_year'],
            $business->wallet->id
        );
        echo "payment successfull";
        // return view('financeservice::show');
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('financeservice::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('financeservice::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}