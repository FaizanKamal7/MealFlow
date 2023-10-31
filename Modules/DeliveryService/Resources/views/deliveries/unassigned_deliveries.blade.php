@extends('businessservice::layouts.master')
@section('title', 'Unassigned Deliveries')

@section('extra_style')
<link href="{{ asset('static/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css/">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 


@endsection
@section('main_content')


<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <div class="container">

            <!--begin::Card header-->
            <div class="d-flex mt-2 align-items-center pricing-header justify-content-between">
                <div class="activate-service">
                    <h1 class="fs-lg-2x ">Unassigned Deliveries</h1>
                </div>
                <!--begin::Card title-->
                <div class="card-title d-flex align-items-center">
                    <!--begin::Search-->
                    {{-- <div class="d-flex align-items-center position-relative me-3">
                        <span class="svg-icon svg-icon-1 position-absolute ms-6 location-icon" id="searchIcon">
                            <x-iconsax-lin-search-normal-1 />
                        </span>
                        <input type="text" name="query" id="myInput" data-kt-permissions-table-filter="search"
                            class="form-control form-control-solid w-200px ps-20 location-dropdown" placeholder="Search"
                            value="{{ request()->query('query') }}" />
                    </div> --}}
                    <!--end::Search-->
                    <div class="d-flex align-items-center position-relative me-3">
                        <input class="form-control w-250px" placeholder="Select a date range" id="kt_datepicker_7" />
                        <span class="svg-icon svg-icon-1 position-absolute location-icon"
                            style="right: 6%; cursor:pointer" id="calendar_icon">
                            <x-iconsax-bul-calendar />
                        </span>
                    </div>
                </div>
                <!--end::Card title-->

            </div>
            <div class="mt-2 d-flex align-items-center print-div unassigned-second-div">
                <div class="me-3">
                    <a class="btn csv-btn">CSV</a>
                </div>
                <div class="me-3">
                    <a class="btn csv-btn">Print</a>
                </div>
                <div class="column-select">
                    <select class="form-select" id="columnVisibility" data-control="select2"
                        data-placeholder="Column Visisbility" multiple>
                    </select>
                </div>

            </div>

            <input type="hidden" name="selected_delivery_ids">

            <div class="d-flex mt-2 align-items-center justify-content-between unassigned-second-div">


                <div class="d-flex align-items-center detail-div">
                    <div class="me-3">
                        <select id="partnerSelect" class="form-select" data-control="select2"
                            data-placeholder="Select Partner" data-allow-clear="true">
                            <option></option>
                            @foreach ($partners as $partner)
                            <option value="{{ $partner->name }}">{{ $partner->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="me-3">
                        <select id="emirateSelect" class="form-select" data-control="select2"
                            data-placeholder="Select Emirate" data-allow-clear="true">
                            <option></option>
                            @foreach ($emirate as $city)
                            <option value="{{ $city->name }}">
                                {{ $city->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="">
                        <select id="timeSlotSelect" class="form-select" data-control="select2"
                            data-placeholder="Select Time Slot" data-allow-clear="true">
                            <option></option>
                            @foreach ($time_slot as $slot)
                            <option value="{{ $slot['start_time'] }}-{{ $slot['end_time'] }}">
                                {{ $slot['start_time'] }} - {{ $slot['end_time'] }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <a class="btn text-white activate-btn" style="height: 38px !important ">Show Details</a>
                    </div>

                </div>

            </div>

            <div class="align-items-center justify-content-between mt-3 select-option-div unassigned-second-div"
                style="display: none;">
                <div class="driver-div">
                    <select id="driverSelect" name="driver_id" class="form-select" data-control="select2"
                        data-placeholder="Select Driver" data-allow-clear="true" onchange="handleDriverSelection()">
                        <option value="">Select Driver</option>
                        @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->employee->first_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex align-items-center assign-div">
                    <div class="me-3">
                        <button id="assignButton" onclick="assignDeliveries()" class="btn csv-btn other-btn">Assign
                            Driver</button>
                    </div>
                    <div class="me-3">
                        <a id="autoAssignButton" class="btn csv-btn other-btn">Auto-Assign</a>
                    </div>
                    <div class="me-3">
                        <a class="btn csv-btn other-btn">Reschedule</a>
                    </div>
                    <div class="me-3">
                        <a class="btn csv-btn cancel" onclick="uncheckAllCheckboxes()">Cancel</a>
                    </div>
                    <div class="me-3">
                        <a class="btn csv-btn cancel ">Delete</a>
                    </div>
                    <div class="">
                        <a class="btn csv-btn other-btn" href="#" onclick="printSelectedLabels()">Print Label
                            with
                            Logo</a>
                    </div>

                </div>
            </div>
            <div class="mt-3 table-responsive location-card">
                <table id="unassigned_table" class="table table-striped table-row-bordered gy-5 gs-7">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th class=""><input class="form-check-input" type="checkbox" value="">
                            </th>
                            <th class="w-150px">Order ID</th>
                            <th class="w-150px">Status</th>
                            <th class="w-150px">Suggested Driver</th>
                            <th class="w-100px">Plan ID</th>
                            <th class="w-150px">Customers</th>
                            <th class="w-150px">Delivery Address</th>
                            <th class="w-100px">Notes</th>
                            <th class="w-150px">Time Slot</th>
                            <th class="w-150px">Partner</th>
                            <th class="w-100px">Created At</th>
                            <th class="w-150px">Uplaoded By</th>
                            <th class="w-100px">Pickup Location</th>
                            <th class="w-100px">Product Type</th>
                            <th>Notification</th>
                            <th>Payment</th>
                            {{-- <th>Company Delivery Id</th> --}}
                            <th class="w-100px">Google Link</th>
                            <th class="min-w-1px">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($deliveries as $delivery)
                        <tr class="">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $delivery->id }}"
                                        id="checkbox-{{ $delivery->id }}">
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    <b>{{ $delivery->id }}</b>
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    <span class="badge badge-secondary">{{ $delivery->status }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    @foreach ($delivery->suggested_drivers as $driver)
                                    {{ $driver->employee->first_name }}<br>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div class="w-100px">
                                    {{ $delivery->id }}
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    {{ $delivery->customer->user->name }}
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    {{ $delivery->customerAddress->address }}
                                </div>
                            </td>
                            <td>
                                <div class="w-200px">
                                    {{ $delivery->note }}
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    {{ $delivery->deliverySlot->city->name }}
                                    {{ $delivery->deliverySlot->start_time }}-{{ $delivery->deliverySlot->end_time
                                    }}
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    {{ $delivery->branch->business->name ?? 'Null' }}
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    {{ $delivery->created_at }}
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    Uploaded By
                                </div>
                            </td>
                            <td>
                                <div class="w-150px">
                                    {{ $delivery->branch->address }}
                                </div>
                            </td>
                            <td>
                                <div class="w-100px">
                                    Food
                                </div>
                            </td>
                            <td>
                                <div class="w-100px">
                                    {{ $delivery->is_notification_enabled ? 'Yes' : 'No' }}
                                </div>
                            </td>
                            <td>
                                <div class="w-100px">
                                    {{ $delivery->payment_status ? 'Yes' : 'No' }}
                                </div>
                            </td>
                            {{-- <td>
                                <div class="w-150px">
                                    {{ $delivery->id }}
                                </div>
                            </td> --}}
                            <td>
                                <div class="w-150px">
                                    https://www.google.co.uk/ </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="table-icon" onclick="">
                                        <x-iconsax-bul-edit-2 />
                                    </span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- end table div --}}




        </div>

    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
@endsection

@section('extra_scripts')
{{-- js file for all the functionality --}}
<script src="{{ asset('static/js/custom/apps/ecommerce/customers/deliveries/unassigned_deliveries.js') }}"></script>
<script src="{{ asset('static/plugins/custom/documentation/general/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('static/js/custom/documentation/general/datatables/subtable.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endsection