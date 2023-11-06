<?php

namespace Modules\FinanceService\Http\Controllers;

use App\Enum\BusinessWalletTransactionStatusEnum;
use App\Enum\BusinessWalletTransactionTypeEnum;
use App\Enum\ModulesTitleEnum;
use App\Http\Helper\Helper;
use Exception;
use Illuminate\Auth\Events\Validated;
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
use Modules\FinanceService\Interfaces\BusinessWalletTransactionInterface;
use Stripe\Balance;

class WalletTransactionController extends Controller
{

    private $paymentHelper;
    private BusinessCardInterface $businessCardRepository;
    private WalletCreditInterface $wallteCreditRepository;
    private BusinessWalletTransactionInterface $businessWalletTransactionRepository;
    private BusinessWalletInterface $businessWalletRepository;
    private $helper;


    public function __construct(
        PaymentHelper $payment_helper,
        BusinessCardInterface $businessCardRepository,
        BusinessWalletTransactionInterface $businessWalletTransactionRepository,
        WalletCreditInterface $wallteCreditRepository,
        BusinessWalletInterface $businessWalletRepository,
        Helper $helper,
    ) {
        $this->paymentHelper = $payment_helper;
        $this->businessWalletRepository = $businessWalletRepository;
        $this->businessCardRepository = $businessCardRepository;
        $this->businessWalletTransactionRepository = $businessWalletTransactionRepository;
        $this->wallteCreditRepository = $wallteCreditRepository;
        $this->helper = $helper;
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



            $this->businessWalletTransactionRepository->createBusinessWalletTransactions(
                $amount,
                BusinessWalletTransactionTypeEnum::CREDIT->value,
                $business->wallet->id,
                BusinessWalletTransactionStatusEnum::APPROVED->value,
                null,
                null,
                null,
                $card->id,

            );

            $balance = $business->wallet->balance + $amount;

            $this->businessWalletRepository->updateWallet($business->wallet->id, $balance);
        });

        return redirect()->route('viewWallet')->with('success', 'Balance Credited Successfully');
    }


    public function storeBankTransferDetails(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'bank_transfer_ss' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);
        if ($validator) {
            $name = $request->input('name');
            $amount = $request->input('amount');
            $image = $request->file('bank_transfer_ss');
            $image_url =  $this->helper->storeFile($image, ModulesTitleEnum::FINANCE_SERVICE->value, 'Credits');

            // Save as JSON
            $transaction_info = [
                'name' => $name,
                'amount' => $amount,
                'image' => $image_url,
            ];
            // TODO: Uncomment below after implementation of Gaurd
            // $business_user = $this->businessUserRepository->getBusinessUser(auth()->user()->id);
            // $business = $this->businessWalletRepository->getBusinessWallet($business_user->business_id);


            $business_wallet = $this->businessWalletRepository->getBusinessWallet('9a67ee94-b544-482e-9545-3e22f9382899');

            $this->businessWalletTransactionRepository->createBusinessWalletTransactions(
                $amount,
                BusinessWalletTransactionTypeEnum::CREDIT->value,
                $business_wallet->id,
                BusinessWalletTransactionStatusEnum::PENDING->value,
                json_encode($transaction_info),
                null,
                null,
            );
            return redirect()->back()->with('success', 'Bank Transfer details shared. Wait for the approval. Thanks for your patience ');
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }


    public function pendingTransactionsView()
    {
        $pending_transactions = $this->businessWalletTransactionRepository->getPendingBusinessWalletTransaction();
        return view('BusinessService::business_info.Wallet.pending_transactions', ['pending_transactions' => $pending_transactions]);
    }


    public function approvePendingTransaction(Request $request)
    {
        $business_transaction_id = $request->input('business_transaction_id');
        $amount = $request->input('amount');
        $business_id = $request->input('business_id');
        $this->businessWalletRepository->creditWallet($business_id, $amount);
        $data = ['amount' => $amount, 'status' => BusinessWalletTransactionStatusEnum::APPROVED->value];
        $pending_transactions = $this->businessWalletTransactionRepository->updateBusinessWalletTransactionWhere($business_transaction_id, $data);

        if ($pending_transactions) {
            return redirect()->route('pending_transactions')->with('success', 'Transaction Approved. Top-up added ');
        } else {
            return redirect()->route('pending_transactions')->with('error', 'Something went wrong');
        }
    }
}
