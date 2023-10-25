@extends('layouts.admin_master')
@section('title', 'Add Meal Plan')

@section('extra_style')
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
                    <a class="btn text-white activate-btn" style="height: 38px !important ">+Add New Plan</a>
                </div>
                <!--end::Card title-->

            </div>
            <div class="mt-2 d-flex align-items-center justify-content-between print-div unassigned-second-div">
                <div class="me-3 business-heading">
                    <h1 class="fs-lg-2x">Select</h1>
                </div>
                <div class="d-flex align-items-center business-second">
                    <div class="me-3">
                        <select id="business" name="business" class="form-select form-select-solid"
                            data-control="select2" data-placeholder="Select a Partner"
                            onchange="getBusinessCustomers()">

                            @if ($businesses->count())
                            @foreach ($businesses as $business)
                            <option value="{{ $business->id }}">{{ $business->name }}</option>
                            @endforeach
                            @else
                            <option value="">Businesses not available</option>
                            @endif

                        </select>
                    </div>
                    <div class="me-3">
                        <select id="customer" name="customer" class="form-select form-select-solid"
                            data-control="select2" data-placeholder="Select a Customer">
                            <option></option>
                        </select>
                    </div>

                    <div class="me-3">
                        <a class="btn text-white activate-btn">Get Record</a>
                    </div>
                </div>
            </div>

            <div class="mt-3 table-responsive location-card">
                <table id="assigned_table" class="table table-striped table-row-bordered gy-5 gs-7">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th class="w-150px">Plan ID</th>
                            <th class="w-150px">Start Date</th>
                            <th class="w-150px">End Date</th>
                            <th class="w-100px">Plan Days</th>
                            <th class="w-200px">Deliveries Details</th>
                            <th class="w-150px">Total Days</th>
                            <th class="w-100px">Status</th>
                            <th class="w-150px">Plan Details</th>
                            <th class="min-w-1px">Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        {{-- to be completed, loop on data --}}
                        {{-- @foreach ($deliveries as $delivery)
                        <tr class="">
                            <div class="w-100px">
                                <b>{{ $delivery['order_id'] }}</b>
                            </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    {{ $delivery['customer'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    {{ $delivery['suggested_driver'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-100px">
                                    {{ $delivery['plan_id'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    {{ $delivery['delivery_address'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-100px">
                                    {{ $delivery['notes'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    {{ $delivery['time'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    {{ $delivery['partner'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    {{ $delivery['created_at'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    {{ $delivery['upload_by'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    {{ $delivery['pickup'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-100px">
                                    {{ $delivery['type'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-100px">
                                    {{ $delivery['notification'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-100px">
                                    {{ $delivery['payment'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    {{ $delivery['company_id'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    {{ $delivery['google_add'] }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="table-icon" onclick="">
                                        <x-iconsax-bul-edit-2 />
                                    </span>
                                </div>
                            </td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->

@endsection

@section('extra_scripts')
<script>
    function getBusinessCustomers(business_id) {
        var businessID = document.getElementById("business").value;
        var customers_dropdown = document.getElementById("customer");

        // Clear current options
        customers_dropdown.innerHTML = '<option value="">Select Customers</option>';

        // Make AJAX request to fetch city
        if (stateID) {
            var url = "/core/settings/locations/get-cities";

            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                data: { state_id: stateID },
                success: function (response) {
                    var city = response;
                    // Populate city dropdown
                    // Loop through the response data and create an option element for each item
                    city.forEach((item) => {
                        console.log(item);
                        const option = document.createElement("option");
                        option.value = item.id; // Set the value attribute
                        option.text = item.name; // Set the displayed text
                        customers_dropdown.appendChild(option); // Add the option to the dropdown
                    });
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }
    }
</script>
@endsection