@extends('layouts.admin_master')
@section('title', 'View Meal Plan')

@section('extra_style')
    <link rel="stylesheet" href="{{ asset('static/css/pickup_batch.css') }}" type="text/css">
@endsection
@section('main_content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <div class="d-flex main-div-container col-xl-12">
                <div class="pickup-batch-div col-5 col-xl-5 me-2">
                    <div class="mb-4 d-flex on-route-first">
                        <div class="route-div col-8">
                            <div class="d-flex gap-12 on-route mb-2">
                                <span class="svg-icon svg-icon-2x"
                                    style="border-radius: 5px;
                        color: rgba(0, 66, 110, 1) !important;">
                                    <x-iconsax-bol-convert-3d-cube />
                                </span>
                                <p class="p-route">On Route</p>
                                <h5 class="h5-route">231</h5>

                            </div>
                            <div class="d-flex gap-12 completed">
                                <span class="svg-icon svg-icon-2x"
                                    style="border-radius: 5px;
                        color: rgba(0, 146, 93, 1) !important;">
                                    <x-iconsax-bol-convert-3d-cube />
                                </span>
                                <p class="p-route">Completed </p>
                                <h5 class="h5-route">31</h5>
                            </div>
                        </div>
                        <div class="delivery-car-pick col-4 d-flex justify-content-center align-items-center">
                            <img alt="Logo" src="{{ asset('static/media/delivey_car.png') }}" class="" />
                        </div>
                    </div>
                    <div class="search-div mb-4">
                        <input type="search" class="search-box col-10" placeholder="Search...">
                        <span class="svg-icon svg-icon-2x setting-icon">
                            <x-iconsax-bro-setting-4 /> </span>
                    </div>
                    <div class="tab-heading-div mb-4 ">
                        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x fs-6">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">All <br>
                                    <span class="num-span">234</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">Stopped <br>
                                    <span class="num-span">12</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_3">Driving<br>
                                    <span class="num-span">222</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_4">Idling<br>
                                    <span class="num-span">34</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_5">No Data<br>
                                    <span class="num-span">3</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-div-batches">
                        <div class="pickup-batches">
                            <h4>
                                Pickup Batches
                            </h4>
                        </div>
                        <div class="tab-view tab-content" id="myTabContent">
                            <div class="tab-pane fade show active d-flex flex-column" id="kt_tab_pane_1" role="tabpanel">
                                <?php
                                // Dummy data array
                                $deliveries = [
                                    ['id' => 127, 'time' => '12:09 am', 'driverName' => 'John Doe', 'vehicleNumber' => 'XYZ 1234', 'rate' => '29/65', 'timeLeft' => '4h 26m', 'width' => 60],
                                    ['id' => 128, 'time' => '1:15 pm', 'driverName' => 'Jane Smith', 'vehicleNumber' => 'ABC 9876', 'rate' => '45/70', 'timeLeft' => '3h 12m', 'width' => 80],
                                    // ... add as many arrays as you want to loop over
                                ];
                                ?>
                                @foreach ($deliveries as $delivery)
                                    <div class="d-flex batch-row">
                                        <div class="id-div">
                                            <p class="delivery-id">ID # {{ $delivery['id'] }}</p>
                                            <p class="delivery-time">{{ $delivery['time'] }}</p>
                                        </div>
                                        <div class="driver-name-div">
                                            <p class="driver-name">{{ $delivery['driverName'] }}</p>
                                            <p class="vehicle-number">{{ $delivery['vehicleNumber'] }}</p>
                                        </div>

                                        <div class="progress-div">
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center ">
                                                <div class="d-flex align-items-center w-100 justify-content-between mb-3">
                                                    <span class="rate fw-bolder">{{ $delivery['rate'] }}</span>
                                                    <span class="text-black-700 opacity-75 fw-bolder">Time Left
                                                        {{ $delivery['timeLeft'] }}</span>
                                                </div>
                                                <!--end::Section-->
                                            </div>
                                            <!--end::Section-->
                                            <!--begin::Statistics-->
                                            <div class="d-flex align-items-center w-100">
                                                <!--begin::Progress-->
                                                <div class="progress h-6px w-100 ">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: 58%; background: rgba(0, 66, 110, 1);"
                                                        aria-valuenow={{ $delivery['width'] }} aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <!--end::Progress-->
                                            </div>
                                            <!--end::Statistics-->
                                        </div>

                                    </div>
                                @endforeach
                            </div>

                            <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                ... Driver Name 2
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                                ...
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                                ...
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                                ...
                            </div>
                        </div>
                    </div>
                </div>

                <div class="map-div col-7 col-xl-7">
                    <img alt="Logo" src="{{ asset('static/media/delivery-map.png') }}" style="width:100%"
                        class="" />

                </div>

            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

@endsection

@section('extra_scripts')
@endsection
