<?php

namespace Modules\FinanceService\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\FinanceService\Helper\PaymentHelper;
use Modules\FinanceService\Interfaces\BusinessCardInterface;
use Modules\FinanceService\Interfaces\BusinessWalletInterface;
use Modules\FinanceService\Interfaces\WalletCreditInterface;
use Stripe;
use Modules\BusinessService\Http\Middleware\BusinessCheck;
use Stripe\Balance;

class WalletCreditController extends Controller
{

    private $paymentHelper;
    private BusinessCardInterface $businessCardRepository;
    private WalletCreditInterface $wallteCreditRepository;
    private BusinessWalletInterface $businessWalletRepository;


    public function __construct(PaymentHelper $payment_helper, BusinessCardInterface $businessCardRepository, WalletCreditInterface $wallteCreditRepository, BusinessWalletInterface $businessWalletRepository)
    {
        $this->paymentHelper = $payment_helper;
        $this->businessCardRepository = $businessCardRepository;
        $this->wallteCreditRepository = $wallteCreditRepository;
        $this->businessWalletRepository = $businessWalletRepository;

    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $business = view()->shared('business');
        $data = ['wallet', $business->wallet];
        return view('financeservice::index', $data);
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

            $validatedData = $request->validate([
                'amount' => ['required'],
            ]);
            // CALLING STRIPE PAYMENT HELPER TO START A STRIPE SESSION FOR PAYMENT
            $charge = $this->paymentHelper->createStripeSession($validatedData);
            return redirect()->away($charge->url);


        } catch (Exception $e) {
            dd($e);
        }
    }


    public function paymentSuccess($session_id)
    {
        // AFTER THE PAYMENT IS SUCCESSFULL WE WILL GET STRIPE DATA USING STRIPE SESSION ID
        $business = view()->shared('business');
        $session = $this->paymentHelper->retrieveSession($session_id);
        $payment_intent = $session->payment_intent;

        // CREATING A db TRANSECTION TO HANDLE DB OPERATION RELATED TO NEW TRANSECTION 

        DB::transaction(function () use ($business, $payment_intent) {

            $card = $this->businessCardRepository->createBusinessCard(
                $payment_intent->payment_method->card['last4'],
                $payment_intent->payment_method->billing_details['name'],
                $payment_intent->payment_method->card['brand'],
                $payment_intent->payment_method->card['exp_month'],
                $payment_intent->payment_method->card['exp_year'],
                $business->wallet->id
            );
            $amount = $payment_intent['amount'] / 100; // BECAUSE STRIPE SENT THE AMOUNT IN CENTS

            $this->wallteCreditRepository->createWalletCredit(
                $amount,
                date('Y-m-d H:i:s'),
                'topup',
                $business->wallet->id,
                $card->id
            );

            $balance = $business->wallet->balance + $amount;

            $this->businessWalletRepository->updateWallet($business->wallet->id, $balance);
        });

        return redirect()->route('viewWallet')->with('success', 'Balance Credited Successfully');
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