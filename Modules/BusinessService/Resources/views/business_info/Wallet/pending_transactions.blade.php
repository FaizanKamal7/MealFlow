@extends('businessservice::layouts.master')

@section('main_content')

<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <h1 class="fs-lg-2x  pb-7 px-2">Pending Business Transactions </h1>

        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">

                <!--begin::Card-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header mt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1 me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                            transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" data-kt-permissions-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-15" placeholder="Search" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->

                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="re_employees_table">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Business</th>
                                    <th class="min-w-50px">Current Amount</th>
                                    <th class="min-w-50px">Sender Name</th>
                                    <th class="min-w-50px">Topped up amount</th>
                                    <th class="min-w-50px">Screenshot</th>
                                    <th class="min-w-50px">Status</th>
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600">
                                @foreach($pending_transactions as $transaction)
                                <td>
                                    {{$transaction->businessWallet->business->name}}
                                </td>
                                <td>
                                    {{$transaction->businessWallet->balance}}
                                </td>
                                <td>
                                    {{ json_decode($transaction->info)->name }}
                                </td>
                                <td>
                                    <p contenteditable="true"> {{ json_decode($transaction->info)->amount }} </p>
                                </td>
                                <td>

                                    <img src="{{ asset(json_decode($transaction->info)->image) }}" alt="Image"
                                        height="110rem">


                                </td>
                                <td>
                                    <span class="badge badge-warning">{{$transaction->status}}</span>
                                </td>

                                <!--begin::Action=-->
                                <td class="text-end">
                                    <!--begin::Update-->

                                    <form id="kt_modal_new_card_form" class="form"
                                        action="{{ route('approve_pending_transaction') }}"
                                        enctype="multipart/form-data" method="POST" data-cc-on-file="false">
                                        @csrf
                                        <input type="hidden" name="business_transaction_id"
                                            value="{{$transaction->id}}">
                                        <input type="hidden" name="amount"
                                            value=" {{ json_decode($transaction->info)->amount }}">
                                        <input type="hidden" name="business_id"
                                            value=" {{ $transaction->businessWallet->business_id }}">

                                        <button type="submit" class="btn btn-primary">Approve</button>
                                    </form>
                                    <!--end::Update-->

                                </td>
                                <!--end::Action=-->
                                </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->


                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->



            </div>
            <!--end::Content-->
        </div>

    </div>
    <!--end::Container-->
</div>
<!--end::Post-->


</div>
<!--end::Container-->
</div>
<!--end::Alert-->

@endsection

@section('extra_scripts')


<script src="{{ asset('static/js/custom/business/new_requests.js')}}"></script>
<script src="{{ asset('static/plugins/global/plugins.bundle.js')}}"></script>
@endsection