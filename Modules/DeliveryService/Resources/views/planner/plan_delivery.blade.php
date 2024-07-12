@extends('layouts.admin_master')
@section('title', 'View Meal Plan')

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
                    <!--end::Card title-->
                    <form id="yourForm" action="{{ route('add_plan_delivery') }}" method="post">
                        @csrf
                        <div class="">
                            <button id='addDeliveryBtn' type="submit" class="btn text-white activate-btn"
                                style="height: 38px !important; pointer-events: none; background:rgb(92 120 139)">+Add
                                New
                                Plan</button>
                        </div>
                        <input type="hidden" name="partner" id="partnerInput">
                        <input type="hidden" name="customer" id="customerInput">
                    </form>


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
                                @foreach ($business_customers as $business_customer)
                                    <option value={{ $business_customer->customer->id }}>
                                        {{ $business_customer->customer->user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="me-3">
                            <a onclick="get_record()" class="btn text-white activate-btn" id="getRecordBtn"
                                style="pointer-events: none; background:rgb(92 120 139)">Get
                                Record</a>
                        </div>
                    </div>
                </div>

                {{-- P L A N R E P O R T --}}
                <div id="plan_report_id" style="display: none">
                    @livewire('deliveryservice::plan-report')
                </div>

            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

@endsection

@section('extra_scripts')

    <script>
        // Attach an event handler to the form's submit event
        document.getElementById('yourForm').addEventListener('submit', function(event) {
            // Get the selected values from the <select> elements
            var partnerValue = document.getElementById('partnerSelect').value;
            var customerValue = document.getElementById('customerSelect').value;

            // Set the values in the hidden input fields
            document.getElementById('partnerInput').value = partnerValue;
            document.getElementById('customerInput').value = customerValue;
        });

        $(document).ready(function() {
            $('#partnerSelect, #customerSelect, #clientCodeSelect').on('change', function() {
                // Check if all select elements have a selected option with a value
                if ($('#partnerSelect').val() && $('#customerSelect').val()) {
                    // If all are selected, enable the "Get Record" button
                    $('#getRecordBtn').removeAttr('style');
                    $('#addDeliveryBtn').removeAttr('style'); // Remove the style attribute
                } else {
                    $('#getRecordBtn').css('pointer-events', 'none'); // Add or set pointer-events: none
                    $('#addDeliveryBtn').css('pointer-events', 'none'); // Add or set pointer-events: none

                }
            });

            // Get the table headers and populate the dropdown
            const tableHeaders = document.querySelectorAll(
                "#plan_table thead th"
            );
            const columnVisibilityDropdown =
                document.getElementById("columnVisibility");

            tableHeaders.forEach((header, index) => {
                const columnHeader = header.textContent.trim();
                const option = document.createElement("option");
                option.value = index;
                option.textContent = columnHeader;
                columnVisibilityDropdown.appendChild(option);
            });
        });

        // Handle column visibility
        $("#columnVisibility").change(function() {
            const selectedColumns = $(this).val();
            if (Array.isArray(selectedColumns)) {
                // Show all columns
                $("#plan_table th, #plan_table td").show();

                // Hide selected columns
                selectedColumns.forEach(function(index) {
                    $(
                        `#plan_table th:nth-child(${
                    parseInt(index) + 1
                }), #plan_table td:nth-child(${parseInt(index) + 1})`
                    ).hide();
                });
            } else {
                // Handle the case where selectedColumns is not an array
                console.error("selectedColumns is not an array.");
            }
        });


        // function setPartnerCustomers($data) {

        // console.log("here");
        // console.log(array);
        // // const business_id = document.getElementById('partnerSelect').value;
        // // const customerSelect = document.getElementById('customerSelect');

        // // if (business_id) {

        // //     // Make an AJAX request using jQuery
        // //     $.ajax({
        // //         url: `/businessservice/business_info/get-customers/${business_id}`,
        // //         method: 'GET',
        // //         dataType: 'json',
        // //         success: function(business_customers) {
        // //             customerSelect.innerHTML = '<option></option>'; // Clear existing options

        // //             console.log(typeof(business_customers.data));
        // //             console.log(business_customers.data);
        // //             // Populate customer options in the business_customerselect dropdown
        // //             business_customers.data.forEach(business_customer => { 
        // //                 const option = document.createElement('option');
        // //                 option.value = business_customer;
        // //                 console.log('here');
        // //                 console.log(typeof(business_customer));
        // //                 console.log(business_customer);

        // //                 console.log(business_customer.bu);

        // //                 // option.textContent = business_customer.customer.id;
        // //                 // customerSelect.appendChild(option);
        // //             });
        // //         },
        // //         error: function(error) {
        // //             console.error('Error:', error);
        // //         }
        // //     });
        // // } else {
        // //     // Clear customerSelect dropdown if no partner is selected
        // //     const customerSelect = document.getElementById('customerSelect');
        // //     customerSelect.innerHTML = '<option></option>';
        // // }
        // }


        function get_record() {
            const customer_id = document.getElementById('customerSelect').value;
            console.log('in')
            let urlTemplate = "{{ route('get_customer_meal_plans', ['customer_id' => ':id']) }}";
            let customerUrl = urlTemplate.replace(':id', customer_id);
            $.ajax({
                url: customerUrl,
                method: 'GET',
                dataType: 'json',
                // Inside your AJAX success callback
                success: function(response) {
                    console.log("here", response.success);
                    console.log(response.data.user, response.data.meal_plans);
                    console.log(typeof(response.data.user), typeof(response.data.meal_plans));
                    var form_component = document.getElementById("plan_report_id");
                    form_component.style.display = "block";
                    var component_id = document.querySelector('#plan_report_id [wire\\:id]').getAttribute(
                        'wire:id');
                    var component = Livewire.find(component_id);

                    component.set('customer_meal_plans', response.data.meal_plans);
                    component.set('user', response.data.user);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    </script>
@endsection
