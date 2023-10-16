@extends('businessservice::layouts.master')
@section('title', 'Assigned Bag Collections')

@section('extra_style')
<link href="{{ asset('static/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css/">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('main_content')
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <div class="container">
            <div class="">
                <!--begin::Card header-->
                <div class="d-flex mt-2 align-items-center pricing-header justify-content-between">
                    <div class="activate-service">
                        <h1 class="fs-lg-2x ">Assigned Bag Collections</h1>
                    </div>
                    <!--begin::Card title-->
                    <div class="card-title d-flex align-items-center">
                        <!--begin::Search-->
                        {{-- <div class="d-flex align-items-center position-relative me-3">
                            <span class="svg-icon svg-icon-1 position-absolute ms-6 location-icon" id="searchIcon">
                                <x-iconsax-lin-search-normal-1 />
                            </span>
                            <input type="text" name="query" id="myInput" data-kt-permissions-table-filter="search"
                                class="form-control form-control-solid w-200px ps-20 location-dropdown"
                                placeholder="Search" value="{{ request()->query('query') }}" />
                        </div> --}}
                        <!--end::Search-->
                        <div class="d-flex align-items-center position-relative me-3">
                            <input class="form-control w-250px" placeholder="Select a date range"
                                id="kt_datepicker_7" />
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

                <input type="hidden" name="selected_empty_bag_collection_ids">

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

                    <div class="d-flex align-items-center assign-div">

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
                                <th class=""><input class="form-check-input" type="checkbox" value=""></th>
                                <th class="w-150px">ID</th>
                                <th class="w-150px">Status</th>
                                <th class="w-150px">Bag ID</th>
                                <th class="w-150px">Customer</th>
                                <th class="w-100px">Partner</th>
                                <th class="w-150px">Time slot</th>
                                <th class="w-100px">Address</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($empty_bags_collection as $empty_bag)
                            <tr class="">
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $empty_bag->id }}"
                                            id="checkbox-{{ $empty_bag->id }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="w-150px">
                                        <b>{{ $empty_bag->id }}</b>
                                    </div>
                                </td>
                                <td>
                                    <div class="w-150px">
                                        <b>{{ $empty_bag->status }}</b>
                                    </div>
                                </td>
                                <td>
                                    <div class="w-150px">
                                        {{ $empty_bag->bag_id}}

                                    </div>
                                </td>
                                <td>
                                    <div class="w-150px">
                                        {{ $empty_bag->customer->user->name }} <br>
                                        {{ $empty_bag->customer->user->phone ?? ''}}

                                    </div>
                                </td>
                                <td>
                                    <div class="w-100px">
                                        {{ $empty_bag->delivery->branch->business->name ?? '' }}
                                    </div>
                                </td>
                                <td>
                                    <div class="w-150px">
                                        @if ($empty_bag->customerAddress)
                                        {{$empty_bag->customerAddress->city->name ?? ''}} ({{
                                        $empty_bag->delivery->deliverySlot->start_time ?? '' }} - {{
                                        $empty_bag->delivery->deliverySlot->end_time ?? '' }})
                                        @else
                                        NA
                                        @endif

                                    </div>
                                </td>
                                <td>
                                    <div class="w-150px">
                                        {{ $empty_bag->customerAddress->address ?? '' }}
                                    </div>
                                </td>
                                <td>
                                    <div class="w-200px">
                                        {{ $empty_bag->note }}
                                    </div>
                                </td>
                                <td>
                                    <div class="w-150px">
                                        {{ $empty_bag->deliverySlot->city->name ?? ''}}
                                        {{ $empty_bag->deliverySlot->start_time ?? ''}}-{{
                                        $empty_bag->deliverySlot->end_time
                                        ?? ''}}
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- end table div --}}



            </div>
        </div>

    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
@endsection

@section('extra_scripts')
{{-- js file for all the functionality --}}
<script src="{{ asset('static/js/custom/apps/ecommerce/customers/deliveries/unassigned_bag_collection.js') }}"></script>
<script src="{{ asset('static/plugins/custom/documentation/general/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('static/js/custom/documentation/general/datatables/subtable.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endsection