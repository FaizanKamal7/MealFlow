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
            <h4>{{$delivery_slot_pricing[0]->city->name}}</h4>
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
            @endforeach
        </div>

        <div class="d-flex flex-column m-3">
            <h2>Range Pricing</h2>
            <hr>
            @foreach ($business_range_pricing as $range_pricing)
            
            <h4>{{$range_pricing[0]->city->name}}</h4>
            <h6>Daily range count</h6>
            @foreach ($range_pricing as $single_pricing)
            <li class="d-flex align-items-center py-2">
                <span class="bullet bullet-dot bg-info me-5"></span>
                {{$single_pricing->min_range}} - {{$single_pricing->max_range}}
                <br>
                Per Delivery Price: {{$single_pricing->delivery_price}} | {{$single_pricing->same_loc_delivery_price}}
                (Same Location) <br>
                Per Bag Collection Price: {{$single_pricing->bag_collection_price}} |
                {{$single_pricing->same_loc_bag_collection_price}} (Same Location) <br>
                Per Cash Collection Price: {{$single_pricing->cash_collection_price}} |
                {{$single_pricing->same_loc_cash_collection_price}} (Same Location) <br>
            </li> <br><br>
            @endforeach

            @endforeach
        </div>



        <p>We are pleased to provide the Range Wise Pricing as well for your consideration:</p>
        <li class="d-flex align-items-center py-2">
            <span class="bullet bullet-dot bg-info me-5"></span>First 8 deliveries = USD
            5.4/Delivery
        </li>
        <li class="d-flex align-items-center py-2">
            <span class="bullet bullet-dot bg-info me-5"></span> 9 - 20 deliveries = USD
            5.13/Delivery

        </li>
        <li class="d-flex align-items-center py-2">
            <span class="bullet bullet-dot bg-info me-5"></span> 21 - 40 deliveries = USD
            4.59/Delivery

        </li>
        <li class="d-flex align-items-center py-2">
            <span class="bullet bullet-dot bg-info me-5"></span> 41 - 80 deliveries = USD
            4.32/Delivery

        </li>
        <li class="d-flex align-items-center py-2">
            <span class="bullet bullet-dot bg-info me-5"></span> 81 - 160 deliveries = USD
            4.05/Delivery

        </li>
        <li class="d-flex align-items-center py-2">
            <span class="bullet bullet-dot bg-info me-5"></span> 161 - 320 deliveries = USD
            3.78/Delivery

        </li>


        <!--begin::Toolbar-->
        <div class="d-flex align-items-center mb-5">
            <a href="#" class="btn btn-sm btn-light btn-color-muted btn-active-light-success px-4 py-2 me-4">
                <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                <span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3"
                            d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                            fill="currentColor" />
                        <rect x="6" y="12" width="7" height="2" rx="1" fill="currentColor" />
                        <rect x="6" y="7" width="12" height="2" rx="1" fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->120
            </a>
            <a href="#" class="btn btn-sm btn-light btn-color-muted btn-active-light-danger px-4 py-2">
                <!--begin::Svg Icon | path: icons/duotune/general/gen030.svg-->
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M18.3721 4.65439C17.6415 4.23815 16.8052 4 15.9142 4C14.3444 4 12.9339 4.73924 12.003 5.89633C11.0657 4.73913 9.66 4 8.08626 4C7.19611 4 6.35789 4.23746 5.62804 4.65439C4.06148 5.54462 3 7.26056 3 9.24232C3 9.81001 3.08941 10.3491 3.25153 10.8593C4.12155 14.9013 9.69287 20 12.0034 20C14.2502 20 19.875 14.9013 20.7488 10.8593C20.9109 10.3491 21 9.81001 21 9.24232C21.0007 7.26056 19.9383 5.54462 18.3721 4.65439Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->15
            </a>
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Post-->
    <!--begin::Separator-->
    <div class="separator mb-4"></div>
    <!--end::Separator-->
    <!--begin::Reply input-->
    <form class="position-relative mb-6">
        <textarea class="form-control border-0 p-0 pe-10 resize-none min-h-25px" data-kt-autosize="true" rows="1"
            placeholder="Reply.."></textarea>
        <div class="position-absolute top-0 end-0 me-n5">
            <span class="btn btn-icon btn-sm btn-active-color-primary pe-0 me-2">
                <!--begin::Svg Icon | path: icons/duotune/communication/com008.svg-->
                <span class="svg-icon svg-icon-3 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3"
                            d="M4.425 20.525C2.525 18.625 2.525 15.525 4.425 13.525L14.825 3.125C16.325 1.625 18.825 1.625 20.425 3.125C20.825 3.525 20.825 4.12502 20.425 4.52502C20.025 4.92502 19.425 4.92502 19.025 4.52502C18.225 3.72502 17.025 3.72502 16.225 4.52502L5.82499 14.925C4.62499 16.125 4.62499 17.925 5.82499 19.125C7.02499 20.325 8.82501 20.325 10.025 19.125L18.425 10.725C18.825 10.325 19.425 10.325 19.825 10.725C20.225 11.125 20.225 11.725 19.825 12.125L11.425 20.525C9.525 22.425 6.425 22.425 4.425 20.525Z"
                            fill="currentColor" />
                        <path
                            d="M9.32499 15.625C8.12499 14.425 8.12499 12.625 9.32499 11.425L14.225 6.52498C14.625 6.12498 15.225 6.12498 15.625 6.52498C16.025 6.92498 16.025 7.525 15.625 7.925L10.725 12.8249C10.325 13.2249 10.325 13.8249 10.725 14.2249C11.125 14.6249 11.725 14.6249 12.125 14.2249L19.125 7.22493C19.525 6.82493 19.725 6.425 19.725 5.925C19.725 5.325 19.525 4.825 19.125 4.425C18.725 4.025 18.725 3.42498 19.125 3.02498C19.525 2.62498 20.125 2.62498 20.525 3.02498C21.325 3.82498 21.725 4.825 21.725 5.925C21.725 6.925 21.325 7.82498 20.525 8.52498L13.525 15.525C12.325 16.725 10.525 16.725 9.32499 15.625Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </span>
            <span class="btn btn-icon btn-sm btn-active-color-primary ps-0">
                <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                <span class="svg-icon svg-icon-2 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3"
                            d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                            fill="currentColor" />
                        <path
                            d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </span>
        </div>
    </form>
    <!--edit::Reply input-->
</div>