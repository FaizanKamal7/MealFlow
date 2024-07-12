@extends('businessservice::layouts.master')
@section('title', 'Unassigned Pickups')

@section('extra_style')
<link href="{{ asset('static/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css/">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('main_content')

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-fluid">
        <div class="container">
            <!--begin::Card header-->
            <div class="d-flex mt-2 align-items-center pricing-header justify-content-between">
                <div class="activate-service">
                    <h1 class="fs-lg-2x ">Unassigned Bag Pickups</h1>
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
                        <button id="assignButton" onclick="assignBagPickups()" class="btn csv-btn other-btn">Assign
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
                            <th>#</th>
                            <th class="min-w-125px">Delivery ID</th>
                            <th class="min-w-1px">Partner</th>
                            <th class="min-w-1px">Time Slot</th>
                            <th class="min-w-1px">Customer</th>
                            <th class="min-w-1px">Delivery Address</th>
                            <th class="min-w-1px">Delivery Status</th>
                            <th class="min-w-1px">Pickup Location</th>
                            <th class="min-w-1px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deliveries as $delivery)
                        <tr class="">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $delivery->id }}"
                                        id="checkbox-{{ $delivery->id }}">
                                </div>
                            </td>
                            <td>{{$delivery->id}}</td>
                            <td>{{$delivery->branch->name }}</td>
                            <td> {{$delivery->customerAddress->area->name}}
                                ({{$delivery->deliverySlot->start_time}} -
                                {{$delivery->deliverySlot->end_time}})</td>
                            <td>{{$delivery->customer->user->name }} <br>
                                {{$delivery->customer->user->phone }}</td>
                            <td>{{$delivery->customerAddress->address }}</td>
                            <td>
                                <span class="badge badge-secondary">{{ $delivery->status }}</span>
                            </td>
                            <td>{{$delivery->branch->name}}</td>
                            <td>
                                <!--begin::Members-->
                                <a href="" class="btn btn-icon btn-active-light-success w-30px h-30px"
                                    data-bs-toggle="tooltip" title="Team Members">
                                    <!--begin::Svg Icon | path: assets/media/icons/duotune/communication/com014.svg-->
                                    <span class="svg-icon svg-icon-3"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z"
                                                fill="currentColor" />
                                            <rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2"
                                                fill="currentColor" />
                                            <path
                                                d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z"
                                                fill="currentColor" />
                                            <rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                <!--end::Members-->
                                <!--begin::Edit-->

                                <a onclick="" class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                    data-bs-toggle="tooltip" title="Edit">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z"
                                                fill="currentColor" />
                                            <path
                                                d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z"
                                                fill="currentColor" />
                                            <path
                                                d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                <!--end::Edit-->
                                <!--begin::Delete-->
                                <a id="delete_team_btn_{{ $delivery->id }}" onclick=""
                                    class="btn btn-icon btn-active-light-danger w-30px h-30px" data-bs-toggle="tooltip"
                                    title="Delete">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                fill="currentColor" />
                                            <path opacity="0.5"
                                                d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                fill="currentColor" />
                                            <path opacity="0.5"
                                                d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                <!--end::Delete-->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>



@endsection

@section('extra_scripts')
<script src="{{ asset('static/js/custom/apps/ecommerce/customers/deliveries/unassigned_bag_pickups.js') }}"></script>
<script src="{{ asset('static/js/custom/documentation/general/datatables/subtable.js')}}"></script>
<script src="{{ asset('static/plugins/custom/documentation/general/datatables/datatables.bundle.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>



@endsection