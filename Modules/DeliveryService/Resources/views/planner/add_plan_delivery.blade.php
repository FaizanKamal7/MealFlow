@extends('layouts.admin_master')
@section('title', 'Add Meal Plan')

@section('extra_style')
    <link rel="stylesheet" href="{{ asset('static/css/plan_delivery.css') }}" type="text/css">
@endsection
@section('main_content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <div class="">
                <div class="d-flex mt-2 align-items-center pricing-header justify-content-between">
                    <div class="activate-service">
                        <h1 class="fs-lg-2x ">Add Plan / Schedule</h1>
                    </div>
                    <!--begin::Card title-->
                    <div class="">
                        <a href="javascript:history.back();" class="btn text-white activate-btn"
                            style="height: 38px !important ">Back</a>
                    </div>
                    <!--end::Card title-->

                </div>
                <div class="mt-2 d-flex align-items-center justify-content-between print-div unassigned-second-div">
                    <div class="me-3 business-heading">
                        <h1 class="fs-lg-2x">Select</h1>
                    </div>
                    <div class="d-flex align-items-center business-second">
                        <div class="me-3">
                            <select id="partnerSelect" class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Select a Partner">
                                <option></option>
                                @foreach ($partners as $partner)
                                    <option value={{ $partner->id }}>
                                        {{ $partner->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="me-3">
                            <select id="customerSelect" class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Select a Customer">
                                <option></option>
                                @foreach ($other_customers as $i)
                                    <option value={{ $i->id }}>
                                        {{ $i->customer->user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="me-3">
                            <a onclick="check()" class="btn text-white activate-btn" id="getRecordBtn"
                                style="pointer-events: none; background:rgb(92 120 139)">Get
                                Record</a>
                        </div>
                    </div>
                </div>

                <div class="customer_detail_div mt-5">
                    <div class="table customer_table">
                        <div class="table-row top-row">
                            <div class="cell">
                                <p>Customer Name</p>
                            </div>
                            <div class="cell">
                                <p>Code</p>
                            </div>
                            <div class="cell">
                                <p>Contact</p>
                            </div>
                            <div class="cell">
                                <p>Partner</p>
                            </div>
                            <div class="cell">
                                <p>Email</p>
                            </div>
                        </div>
                        <div class="table-row bottom-row">
                            <div class="cell customer_name">
                                <h5 class="fw-bolder">{{ $business_customer->customer->user->name }}</h5>
                            </div>
                            <div class="cell">
                                <p class="fw-bolder">FR-2820</p>
                            </div>
                            <div class="cell">
                                <p class="fw-bolder">{{ $business_customer->customer->user->phone }}</p>
                            </div>
                            <div class="cell">
                                <p class="fw-bolder">Freshly</p>
                            </div>
                            <div class="cell">
                                <p class="fw-bolder">{{ $business_customer->customer->user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2 form-generate-div">
                    <div class="activate-service mt-5">
                        <h1 style="font-weight: 500" class="fs-lg-2x ">Generate Plan/Schedule For Deliveries</h1>
                    </div>
                    <div class="form-group row my-10">
                        <div class="col-md-3">
                            <label class="form-label upload-label">Select days to skip </label>
                            <select class="form-select" data-control="select2" data-placeholder="Select (Optional)"
                                id="Skipdays" name="Skipdays" multiple>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label upload-label">Select Start Date</label>
                            <input class="form-control upload-control" id="datePicker" placeholder="Pick a date"
                                name="startDate" />
                        </div>
                        <div class="col-md-3">
                            <label class="form-label upload-label">No. of Plan days</label>
                            <input type="number" class="form-control upload-control mb-2 mb-md-0" placeholder="2"
                                name="planDays" autocomplete="off" id="planDays" />
                        </div>
                        <div class="col-md-3 mt-8">
                            <a onclick="generatePlan()" id="generatePlan" class="btn text-white activate-btn"
                                style="pointer-events: none; background:rgb(92 120 139)">Generate Plan</a>
                        </div>
                    </div>
                </div>
                <div id="meal-planner-form-id" style="display: none">
                    @livewire('deliveryservice::meal-planner-form', ['customer_addresses' => $customer_addresses, 'product_type' => $product_type, 'branches' => $branches])
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

@endsection

@section('extra_scripts')

    <script>
        $(document).ready(function() {
            // dropdown disable
            $('#partnerSelect, #customerSelect').on('change', function() {
                // Check if all select elements have a selected option with a value
                if ($('#partnerSelect').val() && $('#customerSelect').val()) {
                    // If all are selected, enable the "Get Record" button
                    $('#getRecordBtn').removeAttr('style'); // Remove the style attribute
                } else {
                    $('#getRecordBtn').css('pointer-events', 'none'); // Add or set pointer-events: none
                }
            });

            // geenrate plan button disable
            $('#datePicker, #planDays').on('change', function() {
                if ($('#datePicker').val() && $('#planDays').val()) {
                    $('#generatePlan').removeAttr('style');
                } else {
                    $('#generatePlan').css('pointer-events', 'none');
                }
            });
            // Calculate tomorrow's date
            var tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            var tomorrowFormatted = tomorrow.toISOString().split('T')[0];
            $(this).find('#datePicker').flatpickr({
                dateFormat: "Y-m-d", // Define your desired date format
                defaultDate: tomorrowFormatted, // Set default date to tomorrow
                minDate: tomorrowFormatted, // Disable previous dates
            });
        });

        function generatePlan() {
            var datePicker = document.getElementById('datePicker');
            var planDays = document.getElementById('planDays');
            var skipDaysSelect = document.getElementById('Skipdays');

            var startDate = new Date(datePicker.value);
            var numPlanDays = parseInt(planDays.value, 10);
            var skipDays = Array.from(skipDaysSelect.selectedOptions, option => option.value);
            if (isNaN(numPlanDays) || isNaN(startDate.getTime())) {
                return;
                console.log('in if')
            }
            var includedDates = [];
            var currentDate = new Date(startDate);

            while (includedDates.length < numPlanDays) {
                var dayOfWeek = currentDate.getDay(); // 0 for Sunday, 1 for Monday, ..., 6 for Saturday
                // Check if the day is not in the list of skipped days
                if (!skipDays.includes(getDayName(dayOfWeek))) {
                    includedDates.push(currentDate.toISOString().slice(0, 10));
                }
                // Move to the next day
                currentDate.setDate(currentDate.getDate() + 1);
            }
            var expiryDate = new Date(includedDates[includedDates.length - 1]); // Last included date

            console.log('Expiry Date: ' + expiryDate.toISOString().slice(0, 10));
            console.log('Included Dates: ' + includedDates.join(', '));
            invokeForm(expiryDate, startDate, includedDates, numPlanDays)
        }
        // Helper function to get the name of the day
        function getDayName(dayOfWeek) {
            const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            return daysOfWeek[dayOfWeek];
        }

        function invokeForm(expiry_date, start_date, included_dates, no_of_days) {
            console.log(expiry_date, start_date, no_of_days, included_dates)
            var form_component = document.getElementById("meal-planner-form-id");
            form_component.style.display = "block";
            var component_id = document.querySelector('#meal-planner-form-id [wire\\:id]').getAttribute('wire:id');
            var component = Livewire.find(component_id);
            component.set('included_dates', included_dates);
            component.set('expiry_dates', expiry_date);
            component.set('starting_date', start_date);
            component.set('no_of_days', no_of_days);

        }
    </script>
@endsection
