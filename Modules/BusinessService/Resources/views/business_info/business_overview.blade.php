@extends('businessservice::layouts.master')

@section('main_content')

<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Navbar-->
        <div class="card mb-5 mb-xxl-8">
            <div class="card-body pt-9 pb-0">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap">
                    <!--begin: Pic-->
                    <div class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            {{-- <img src={{ $business->name->getUrlfriendlyAvatar() }} /> --}}
                            <img src="{{ Avatar::create($business->name)->toBase64() }}" />

                            <div
                                class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px">
                            </div>
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <!--begin::User-->
                            <div class="d-flex flex-column">
                                <!--begin::Name-->
                                <div class="d-flex align-items-center mb-2">
                                    <a href="#"
                                        class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{$business->name}}</a>
                                    <a href="#">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                        <span class="svg-icon svg-icon-1 svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z"
                                                    fill="#00A3FF" />
                                                <path class="permanent"
                                                    d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                </div>
                                <!--end::Name-->
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                    <a href="#"
                                        class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                        <span class="svg-icon svg-icon-4 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->{{$business->status}}
                                    </a>

                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::User-->
                            <!--begin::Actions-->
                            <div class="d-flex my-4">


                                <!--begin::Menu-->
                                <div class="me-0">
                                    <button class="btn btn-sm btn-primary me-2" data-kt-menu-trigger="click"
                                        data-kt-menu-placement="bottom-end">
                                        Create custom pricing for this business
                                    </button>
                                    <!--begin::Menu 3-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3"
                                        data-kt-menu="true">
                                        <!--begin::Heading-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Pricing
                                                Types
                                            </div>
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{route('add_range_base_pricing')}}" target="_blank"
                                                class="menu-link px-3">Daily
                                                Range Wise Pricing</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{route('add_delivery_slot_base_pricing')}}" target="_blank"
                                                class="menu-link px-3">Delivery Slot Wise Pricing</a>
                                        </div>
                                        <!--end::Menu item-->

                                    </div>
                                    <!--end::Menu 3-->
                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap flex-stack">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column flex-grow-1 pe-8">

                                <!--begin::Stat-->
                                <div class="d-flex flex-wrap">
                                    <b>Phone: </b>{{$business->mainBranch->phone }} <br>
                                </div>
                                <div class="d-flex flex-wrap"> <b>Address: </b>{{$business->mainBranch->address }},
                                    @if ($business->mainBranch->area)
                                    {{$business->mainBranch->area->name}},
                                    @endif
                                    {{$business->mainBranch->city->name}},
                                    {{$business->mainBranch->state->name}},{{$business->mainBranch->country->name}}
                                </div>
                                <div class="d-flex flex-wrap"> <b>Admin: </b> {{$business->user->name }} </div>
                                <br>
                                <!--end::Stat-->

                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Progress-->
                            <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                    <span class="fw-bold fs-6 text-gray-400">Profile Compleation</span>
                                    <span class="fw-bolder fs-6">50%</span>
                                </div>
                                <div class="h-5px mx-3 w-100 bg-light mb-3">
                                    <div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;"
                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Details-->

            </div>
        </div>
        <!--end::Navbar-->
        <!--begin::Row-->
        <div class="row g-5 g-xxl-8">
            <!--begin::Col-->
            <div class="col-xl-12">
                <!--begin::Feeds Widget 2-->
                <div class="card mb-5 mb-xxl-8">
                    <!--begin::Body-->
                    {{-- @include('business_info.contract_file') --}}
                    <div class="card-body pb-0">
                        <!--begin::Header-->
                        <h3>Business Contract Info</h3>
                        <!--end::Header-->
                        <!--begin::Post-->
                        <div class="mb-5 m-6">
                            <h4 class="text-center">
                                SERVICE AGREEMENT
                            </h4>
                            <!--begin::Text-->
                            <p class="text-gray-800 fw-normal mb-5 text-center">


                                This agreement (the “Agreement”) made in Dubai is effective from signature date.
                                BETWEEN
                                <b>L O G X Transport LLC (The “Service Provider”)</b>, with DED License Number 776770,
                                and
                                Address Office Warehouse B4, building 2, Al Quoz 3, Dubai, represented by Mr Abdul Sami
                                Khan Shamshad Ali Khan and Mr Pir Abid Shah Abdurrehman Shah.
                                <br>
                                AND
                                <br>
                                <b> {{$business->name}} (The "Company")</b>, with Trade License CN-3861514 and Abu
                                dhabi
                                referred to as the “Parties”.

                            </p>
                            <!--end::Text-->

                            <h5 class="text-center">PREAMBLE</h5>
                            <h5> WHEREAS:</h5>
                            <p> - The Company has requested from the Service Provider Specific Delivery/Logistics
                                services
                                (the “Service(s)”.
                                - The Service Provider, for the price and subject to the Terms and Conditions contained
                                herein, is prepared to sell to the Company, on an ongoing basis and as its exclusive
                                Delivery, and Company is prepared to buy on this basis from The Service Provider, all
                                the
                                Company’s Service requirements. NOW, THEREFORE, IN CONSIDERATION OF THE MUTUAL COVENANTS
                                AND
                                AGREEMENTS HERETO CONTAINED AND FOR OTHER GOOD AND VALUABLE CONSIDERATION, DULY
                                RECEIVED,
                                THE PARTIES HERETO AGREE AS FOLLOWS:
                            </p>

                            <h5>1. DEFINITIONS AND INTERPRETATION </h5>
                            <p> 1.1 Whenever used in this Agreement, the schedules
                                thereto, or any ancillary document thereto, the following terms, unless the subject
                                matter
                                or context otherwise requires, shall have the following meanings:<br>
                            <p class="m-6">
                                &nbsp 1.1.1 “Agreement” means or refers to this Agreement as amended from time to time
                                and any
                                indenture, agreement or instrument supplemental or ancillary hereto or in implementation
                                hereof.<br>

                                &nbsp 1.1.2 “Business Day” means every day of the week except Public Holidays, which in
                                the
                                U.A.E.
                                is a legal holiday or a day on which financial institutions are authorized by law or by
                                local proclamation to close.<br>

                                &nbsp 1.1.3 “Client” means any individual, company, corporation, partnership, firm,
                                trust,
                                sole
                                proprietorship, government or entity howsoever designated, agrees with the company to
                                purchase Meal Plan through the website.<br>

                                &nbsp 1.1.4 “Bags” refers to the portable insulated cooler bag that carries all meals
                                for the
                                client.<br>

                                &nbsp 1.1.5 “Service(s)” means or refers to the specific Delivery of the bags from the
                                place
                                of
                                preparing the meal to the client.<br>
                            </p>
                            </p>

                            <h5>2. ORDERS AND DELIVERY OF SERVICES: </h5>
                            <p> 2.1 Daily Delivery schedule for orders for Services purchased pursuant to this Agreement
                                shall be communicated in advance (By 3pm for the next day delivery & for final bag
                                collection by 5pm) always by email and in such other manner expressly agreed upon
                                between the interested parties.<br><br>
                                2.2 The Service Provider shall deliver Services to clients by the agreed cut-off time on
                                specific days as required by Company – this being as agreed Delivery timings as agreed
                                between both The Service Provider and Company..<br><br>
                                2.3 Deliveries will be made between times mentioned below for Company to pick up the
                                bags as soon as possible after the respective time slot finishes. No specific time is
                                offered, bags will be dropped at the door of client’s location with a text or WhatsApp
                                notification to inform Client as per the time slot. .<br><br>
                            </p>

                            <div class="d-flex flex-column m-3">
                                <h2>Delivery Slot Pricing</h2>
                                <hr>
                                @foreach ($business_delivery_slot_pricing as $delivery_slot_pricing)
                                @if (!empty($delivery_slot_pricing))
                                @if (isset($delivery_slot_pricing[0]->city))
                                <h4>{{$delivery_slot_pricing[0]->city->name}}</h4>
                                @endif

                                <li class="d-flex align-items-center py-2">
                                    <span class="bullet bullet-dot bg-info me-5"></span>
                                    @foreach ($delivery_slot_pricing as $single_pricing)
                                    <b>{{$single_pricing->deliverySlot->start_time}} -
                                        {{$single_pricing->deliverySlot->end_time}}</b>&nbsp;&nbsp;&nbsp;
                                    <hr>
                                    <br>
                                    Delivery Price: {{$single_pricing->delivery_price}}<br>
                                    Bag Collection Price: {{$single_pricing->bag_collection_price}}<br>
                                    Cash Collection Price: {{$single_pricing->cash_collection_price}}<br>
                                    Delivery Price (Same location): {{$single_pricing->same_loc_delivery_price}}<br>
                                    Bag Collection Price (Same location):
                                    {{$single_pricing->same_loc_bag_collection_price}}<br>
                                    Cash Collection Price (Same location):
                                    {{$single_pricing->same_loc_cash_collection_price}}<br>
                                    <br>
                                    <hr>
                                    @endforeach
                                </li>
                                @endif
                                @endforeach
                            </div>

                            <div class="d-flex flex-column m-3">
                                <h2>Range Pricing</h2>
                                <hr>
                                @foreach ($business_range_pricing as $range_pricing)
                                @if (!empty($range_pricing))
                                @if (isset($range_pricing[0]->city))
                                <h4>{{$range_pricing[0]->city->name}}</h4>
                                <h6>Daily range count</h6>
                                @endif
                                @foreach ($range_pricing as $single_pricing)
                                <li class="d-flex align-items-center py-2">
                                    <span class="bullet bullet-dot bg-info me-5"></span>
                                    {{$single_pricing->min_range}} - {{$single_pricing->max_range}}
                                    <br>
                                    Per Delivery Price: {{$single_pricing->delivery_price}} |
                                    {{$single_pricing->same_loc_delivery_price}}
                                    (Same Location) <br>
                                    Per Bag Collection Price: {{$single_pricing->bag_collection_price}} |
                                    {{$single_pricing->same_loc_bag_collection_price}} (Same Location) <br>
                                    Per Cash Collection Price: {{$single_pricing->cash_collection_price}} |
                                    {{$single_pricing->same_loc_cash_collection_price}} (Same Location) <br>
                                </li> <br><br>
                                @endforeach
                                @endif
                                @endforeach
                            </div>




                        </div>
                        <!--end::Post-->
                        <!--begin::Separator-->
                        <div class="separator mb-4"></div>
                        <!--end::Separator-->

                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Feeds Widget 2-->

                <!--begin::Feeds widget 4, 5 load more-->
                @if ($business->status == "NEW REQUEST")
                <a href="{{route('send_contract_file', ['business_id'=> $business->id])}}"
                    class="btn btn-primary w-100 text-center">
                    Send Contract File

                </a>
                @endif

                <!--end::Feeds widget 4, 5 load more-->
            </div>
            <!--end::Col-->

        </div>
        <!--end::Row-->
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
@endsection