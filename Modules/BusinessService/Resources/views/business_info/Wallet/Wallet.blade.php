@extends('layouts.admin_master')
@section('title', 'Business | Wallet')

@section('extra_style')
<link href="{{ asset('static/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('static/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet"
    type="text/css" />
@endsection
@section('main_content')

<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Row-->

        <div class="main_topup_div mb-5">
            <div class="d-flex align-items-center top_up">
                <div class="d-flex icon_topup_div">
                    <span class="svg-icon svg-icon-2 top_icon">
                        <x-iconsax-bol-wallet-add />
                    </span>
                    <h5>You have to <span class="top_clr">TOP-UP</span> some balance to start deliveries</h5>
                </div>

            </div>
            <div class="d-flex justify-content-between align-items-center current_blnce">
                <div class="d-flex current">
                    <h5>Current Balance: </h5> <span class="aed_blue"> 0.00 AED</span>
                </div>
                <div class="amount_btn">
                    <a class="btn text-white activate-btn" data-bs-toggle="modal"
                        data-bs-target="#bank_transfer_modal">+ Add
                        Amount (Bank Transfer)</a>
                    <a class="btn text-white activate-btn" data-bs-toggle="modal" data-bs-target="#kt_modal_1">+ Add
                        Amount (Stripe)</a>
                </div>


            </div>
        </div>
        {{-- add amount modal --}}
        <div class="modal fade" tabindex="-1" id="kt_modal_1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Add Amount</h3>
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <form id="kt_modal_new_card_form" class="form" action="{{ route('storeCredit') }}" method="POST"
                            data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                            @csrf
                            <div class="d-flex flex-column mb-2 fv-row">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold form-label mb-2">Amount</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative">
                                    <!--begin::Input-->
                                    <input type="number" class="form-control form-control-solid"
                                        placeholder="Enter amount" name="amount" value="" />
                                    <!--end::Input-->
                                    @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--end::Input wrapper-->
                            </div>

                            <!--begin::Action-->
                            <div class="d-flex align-items-end modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Top up </button>

                            </div>
                            <!--end::Action-->
                        </form>

                    </div>
                </div>
            </div>
        </div>
        {{-- end modal --}}

        {{-- add bank transfer amount modal --}}
        <div class="modal fade" tabindex="-1" id="bank_transfer_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Bank Transfer</h3>
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <form id="kt_modal_new_card_form" class="form"
                            action="{{ route('upload_bank_transfer_details') }}" enctype="multipart/form-data"
                            method="POST" data-cc-on-file="false">
                            @csrf
                            <div class="d-flex flex-column mb-2 fv-row">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold form-label mb-2">Bank Details</label>
                                <br>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative">
                                    <div class="text-primary">

                                        <b>Bank Name:</b> Allied Bank Limited <br>
                                        <b>Account number:</b> 15687891234856 <br>
                                        <b>Account Title:</b> Muhammad Sami <br>
                                        <b>IBAN:</b> UE2f3342343232423 <br>


                                    </div>
                                    <br>
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Enter sender name" name="name" value="" />
                                    <!--end::Input-->
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <!--begin::Input-->
                                    <input type="number" class="form-control form-control-solid"
                                        placeholder="Enter amount" name="amount" value="" />
                                    <!--end::Input-->
                                    @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <br>
                                    <div class="mb-3">
                                        <label for="bank_transfer_ss" class="form-label">Send desired amount to
                                            following
                                            bank and upload screenshot</label>
                                        <input class="form-control" type="file" name="bank_transfer_ss"
                                            id="bank_transfer_ss">
                                        @error('bank_transfer_ss')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Input wrapper-->
                            </div>

                            <!--begin::Action-->
                            <div class="d-flex align-items-end modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Top up </button>

                            </div>
                            <!--end::Action-->
                        </form>

                    </div>
                </div>
            </div>
        </div>
        {{-- end modal --}}


        <div class="graph_second_div mb-5">
            <div class="col-xxl-12">
                <!--begin::Chart widget 26-->
                <div class="card card-flush overflow-hidden h-xl-100 wallet-graph">
                    <!--begin::Header-->
                    <div class="card-header wallet-card-header">
                        <!--begin::Title-->
                        <h3 class="card-title wallet-title fw-bolder">Balance Statistics</h3>
                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-between align-items-center gap-10 mt-2 ">
                            <p>Credit</p>
                            <p>Debit</p>
                            <p style="background: rgba(0, 66, 110, 1);
                                color: white;
                                padding: 10px;
                                border-radius: 6px;
                                text-align: center;">
                                Balance</p>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                            <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left"
                                class="btn btn-sm btn-light d-flex align-items-center px-4">
                                <!--begin::Display range-->
                                <div class="text-gray-600 fw-bolder">Loading date range...</div>
                                <!--end::Display range-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                <span class="svg-icon svg-icon-1 ms-2 me-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path opacity="0.3"
                                            d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                            fill="currentColor" />
                                        <path
                                            d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                            fill="currentColor" />
                                        <path
                                            d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Daterangepicker-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex justify-content-between flex-column pt-0 pb-1 px-0">
                        <!--begin::Chart-->
                        <div id="kt_charts_widget_26" class="min-h-auto ps-4 pe-6" data-kt-chart-info="Transactions"
                            style="height: 300px"></div>
                        <!--end::Chart-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Chart widget 26-->
            </div>

        </div>

        <div class="row g-xl-10 mt-5 mb-5 mb-xl-10">
            <div class="col-xl-7 credit-details">
                <div class="wallet-graph overflow-hidden">
                    <div class="credit-header wallet-card-header">
                        <h3 class="wallet-title fw-bolder">Credit Details</h3>

                    </div>
                    <div class="credit_table">
                        <table class="table table-rounded table-striped border gy-3 gs-7">
                            <thead class="credit-thead">
                                <tr class="text-start fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-1px">Card</th>
                                    <th class="min-w-1px">Amount</th>
                                    <th class="min-w-1px">Date</th>
                                    <th class="min-w-1px">Note</th>
                                </tr>
                            </thead>
                            @php
                            $dummyData = [
                            [
                            'Logo' =>
                            'https://w7.pngwing.com/pngs/23/320/png-transparent-mastercard-credit-card-visa-payment-service-mastercard-company-orange-logo-thumbnail.png',
                            'Card' => 'Visa Card',
                            'Number' => '**** **** **** 1234',
                            'Amount' => '15,000 AED',
                            'Date' => '2023-09-20',
                            'Note' => 'Sample note 1',
                            ],
                            [
                            'Logo' =>
                            'https://w7.pngwing.com/pngs/23/320/png-transparent-mastercard-credit-card-visa-payment-service-mastercard-company-orange-logo-thumbnail.png',
                            'Card' => 'Master Card',
                            'Number' => '**** **** **** 5678',
                            'Amount' => '10,000 AED',
                            'Date' => '2023-09-21',
                            'Note' => 'Sample note 2',
                            ],
                            [
                            'Logo' =>
                            'https://w7.pngwing.com/pngs/23/320/png-transparent-mastercard-credit-card-visa-payment-service-mastercard-company-orange-logo-thumbnail.png',
                            'Card' => 'Amex Card',
                            'Number' => '**** **** **** 9012',
                            'Amount' => '5,000 AED',
                            'Date' => '2023-09-22',
                            'Note' => 'Sample note 3',
                            ],
                            [
                            'Logo' =>
                            'https://w7.pngwing.com/pngs/23/320/png-transparent-mastercard-credit-card-visa-payment-service-mastercard-company-orange-logo-thumbnail.png',
                            'Card' => 'Amex Card',
                            'Number' => '**** **** **** 9012',
                            'Amount' => '5,000 AED',
                            'Date' => '2023-09-22',
                            'Note' => 'Sample note 3',
                            ],
                            ];
                            @endphp

                            @foreach ($dummyData as $data)
                            <tr>
                                <td class="text-gray-700"> <img style="width:30px" src="{{ $data['Logo'] }}" alt="Logo">
                                    {{ $data['Card'] }} <br>{{ $data['Number'] }} </td>
                                <td>{{ $data['Amount'] }}</td>
                                <td class="text-gray-700">{{ $data['Date'] }}</td>
                                <td class="text-gray-700">{{ $data['Note'] }}</td>
                            </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-xl-5 debit_details ">
                <div class="wallet-graph overflow-hidden">
                    <div class="credit-header wallet-card-header">
                        <h3 class="wallet-title fw-bolder">Debit Details</h3>

                    </div>
                    <div class="credit_table">
                        <table class="table table-rounded table-striped border gy-3 gs-7">
                            <thead class="credit-thead">
                                <tr class="text-start fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-1px">Amount <br></th>
                                    <th class="min-w-1px">Date</th>
                                    <th class="min-w-1px">Details</th>
                                </tr>
                            </thead>
                            @php
                            $dummyData = [
                            [
                            'Amount' => '15,000 AED',
                            'Date' => '2023-09-20',
                            ],
                            [
                            'Amount' => '10,000 AED',
                            'Date' => '2023-09-21',
                            ],
                            [
                            'Amount' => '5,000 AED',
                            'Date' => '2023-09-22',
                            ],
                            [
                            'Amount' => '5,000 AED',
                            'Date' => '2023-09-22',
                            ],
                            [
                            'Amount' => '5,000 AED',
                            'Date' => '2023-09-22',
                            ],
                            ];
                            @endphp

                            @foreach ($dummyData as $data)
                            <tr>
                                <td>{{ $data['Amount'] }}</td>
                                <td class="text-gray-700">{{ $data['Date'] }}</td>
                                <td class="text-gray-700"><a href="/">View</a> </td>
                            </tr>
                            @endforeach
                        </table>

                    </div>

                </div>

            </div>
        </div>

    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
<!--begin::Modal - New Card-->
{{-- <div class="modal fade" id="kt_modal_new_card" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Add New Card</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_new_card_form" class="form" action="{{ route('storeCredit') }}" method="POST"
                    data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                    @csrf
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-7 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                            <span class="required">Name On Card</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                title="Specify a card holder's name"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Max doe"
                            name="card_holder_name" value="" />
                        <input type="text" class="form-control form-control-solid" hidden name="stripe_token"
                            value="" />
                        @error('card_holder_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-7 fv-row">
                        <!--begin::Label-->
                        <label class="required fs-6 fw-bold form-label mb-2">Card Number</label>
                        <!--end::Label-->
                        <!--begin::Input wrapper-->
                        <div class="position-relative">
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="Enter card number"
                                name="card_number" value="" />
                            <span class="text-danger" id="card_number"></span>

                            <!--end::Input-->
                            <!--begin::Card logos-->
                            <div class="position-absolute translate-middle-y top-50 end-0 me-5">
                                <img src="{{ asset('static/media/svg/card-logos/visa.svg') }}" alt="" class="h-25px" />
                                <img src="{{ asset('static/media/svg/card-logos/mastercard.svg') }}" alt=""
                                    class="h-25px" />
                                <img src="{{ asset('static/media/svg/card-logos/american-express.svg') }}" alt=""
                                    class="h-25px" />
                            </div>
                            <!--end::Card logos-->
                        </div>
                        <!--end::Input wrapper-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-10">
                        <!--begin::Col-->
                        <div class="col-md-8 fv-row">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold form-label mb-2">Expiration Date</label>
                            <!--end::Label-->
                            <!--begin::Row-->
                            <div class="row fv-row">
                                <!--begin::Col-->
                                <div class="col-6">
                                    <select name="expiry_month" class="form-select form-select-solid"
                                        data-control="select2" data-hide-search="true" data-placeholder="Month">
                                        <option value="">MM</option>
                                        @foreach (range(1, 12) as $month)
                                        <option value="{{ $month }}">{{ $month }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="expiry_month"></span>

                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-6">
                                    <select name="expiry_year" class="form-select form-select-solid"
                                        data-control="select2" data-hide-search="true" data-placeholder="Year">
                                        <option value="">YYYY</option>
                                        @foreach (range(date('Y'), date('Y') + 10) as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach

                                    </select>
                                    <span class="text-danger" id="expiry_year"></span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-4 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                <span class="required">CVV</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Enter a card CVV code"></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative">
                                <!--begin::Input-->
                                <input type="number" class="form-control form-control-solid" minlength="3" maxlength="4"
                                    placeholder="CVV" name="cvv" />
                                <!--end::Input-->
                                <span class="text-danger" id="cvv"></span>

                                <!--begin::CVV icon-->
                                <div class="position-absolute translate-middle-y top-50 end-0 me-3">
                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                                    <span class="svg-icon svg-icon-2hx">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path d="M22 7H2V11H22V7Z" fill="currentColor" />
                                            <path opacity="0.3"
                                                d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::CVV icon-->
                            </div>
                            <!--end::Input wrapper-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-7 fv-row">
                        <!--begin::Label-->
                        <label class="required fs-6 fw-bold form-label mb-2">Amount</label>
                        <!--end::Label-->
                        <!--begin::Input wrapper-->
                        <div class="position-relative">
                            <!--begin::Input-->
                            <input type="number" class="form-control form-control-solid" placeholder="Enter amount"
                                name="amount" value="" />
                            <!--end::Input-->
                            @error('amount')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--end::Input wrapper-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-stack">
                        <!--begin::Label-->
                        <div class="me-5">
                            <label class="fs-6 fw-bold form-label">Save Card for further billing?</label>
                            <div class="fs-7 fw-bold text-muted">
                            </div>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" name="save_card" type="checkbox" value="1"
                                checked="checked" />
                            <span class="form-check-label fw-bold text-muted">Save Card</span>
                        </label>
                        <!--end::Switch-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">Discard</button>
                        <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div> --}}
<!--end::Modal - New Card-->
@endsection

@section('extra_scripts')

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="{{ asset('static/js/custom/apps/finance/stripe_payment.js') }}"></script>

<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('static/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('static/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('static/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('static/js/custom/widgets.js') }}"></script>
<script src="{{ asset('static/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('static/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('static/js/custom/utilities/modals/top-up-wallet.js') }}"></script>
<script src="{{ asset('static/js/custom/utilities/modals/create-account.js') }}"></script>
<script src="{{ asset('static/js/custom/utilities/modals/users-search.js') }}"></script>
<!--end::Page Custom Javascript-->
<script src="{{ asset('static/js/custom/apps/fleet/add_model.js') }}"></script>

@if ($errors->any())
<script>
    $(document).ready(function() {
                // Show the modal when there are validation errors
                $('#bank_transfer_modal').modal('show');

            });
</script>
@endif
@endsection