@extends('layouts.admin_master')
@section('title', 'Business Pricing')

@section('extra_style')
    <link href="{{ asset('static/plugins/custom/datatables/datatables.bundle.css') }} rel=" stylesheet" type="text/css/">
@endsection
@section('main_content')


    <div id="kt_content_container" class="container-xxl">
        <div class="container">
            <div class="d-flex mt-2 align-items-center pricing-header justify-content-between">
                <div class="activate-service">
                    <h1 class="fs-24">Daily Delivery Range Based Pricing</h1>
                </div>
                <!--begin::Card title-->
                <div class="card-title d-flex align-items-center">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative me-3">
                        <span class="svg-icon svg-icon-1 position-absolute ms-6 location-icon" id="searchIcon">
                            <x-iconsax-lin-search-normal-1 />
                        </span>
                        <input type="text" name="query" id="myInput" data-kt-permissions-table-filter="search"
                            class="form-control form-control-solid w-150px ps-20 location-dropdown" placeholder="Search"
                            value="" />
                    </div>
                    <!--end::Search-->
                    <div class="me-3">
                        <a href="{{ route('add_range_base_pricing') }}" class="btn text-white activate-btn">
                            Add Delivery Range Price
                        </a>
                    </div>
                </div>
                <!--end::Card title-->
            </div>

            <div class="cities d-flex mt-2 align-items-center justify-content-between">
                <h2 class="table-sort"> Cities</h2>
                <h2> Actions</h2>

            </div>
            {{-- end city div --}}
            <div class="accordion-div">
                <?php
            // Loop through cities to create accordion items
            foreach ($cities as $city) {
                ?>
                <div class="accordion" id="accordion_<?php echo str_replace(' ', '_', $city['name']); ?>">
                    <div class="accordion-item price-accordion">
                        <h2 class="accordion-header price-header" id="heading_{{ $city['id'] }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_{{ $city['id'] }}" aria-expanded="true"
                                aria-controls="collapse_{{ $city['id'] }}">
                                <?php echo $city['name']; ?>
                            </button>
                            <span class="trash" onclick="">
                                <x-iconsax-bul-trash />
                            </span>
                        </h2>
                        <div id="collapse_{{ $city['id'] }}" class="accordion-collapse collapse"
                            aria-labelledby="heading_{{ $city['id'] }}">
                            <div class="accordion-body p-0">
                                <table class="table table-rounded table-striped border gy-7 gs-7">
                                    <thead>
                                        <tr class="text-start fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="min-w-1px">Range</th>
                                            <th class="min-w-1px">Delivery Price<br>(Same Location)</th>
                                            <th class="min-w-1px">Bag Collection Price<br>(Same Location)</th>
                                            <th class="min-w-1px">Cash Collection Price<br>(Same Location)</th>
                                            <th class="min-w-1px">Active Status</th>
                                            <th class="min-w-1px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    // Loop through delivery slots for this city
                                    foreach ($city['slots'] as $slot) {
                                        ?>
                                        <tr>
                                            <td>{{ $slot['range'] }}</td>
                                            <td>{{ $slot['price'] }}</td>
                                            <td>{{ $slot['bag'] }}</td>
                                            <td>{{ $slot['cash'] }}</td>
                                            <td>{{ $slot['status'] }}</td>
                                            <td>{{ $slot['added'] }}</td>

                                            <td>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="table-icon" onclick="">
                                                        <x-iconsax-bul-edit-2 /> </span>
                                                    <span class="table-icon" onclick="">
                                                        <x-iconsax-bul-eye-slash /> </span>
                                                    <span class="table-icon" onclick="">
                                                        <x-iconsax-bul-trash />
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

            </div>
            {{-- end accordion div --}}
            <div class="mt-6">
                <ul class="pagination" id="paginationList">
                    <li class="page-item previous"><a id="prevPage" href="#" class="page-link"><i
                                class="previous"></i></a>
                    </li>
                    <li class="page-item active"><a href="#" class="page-link"></a></li>
                    <li class="page-item next"><a id="nextPage" href="#" class="page-link"><i class="next"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection

@section('extra_scripts')
    {{-- all function of range base are same as slot wise, so same js class --}}
    <script src="{{ asset('static/js/custom/apps/ecommerce/customers/deliveries/delivery_slot_base.js') }}"></script>
    <script src="{{ asset('static/js/custom/apps/ecommerce/customers/deliveries/delivery_range_base.js') }}"></script>

@endsection
