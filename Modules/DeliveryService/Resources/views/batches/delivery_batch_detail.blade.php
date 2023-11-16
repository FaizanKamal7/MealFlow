@extends('layouts.admin_master')
@section('title', 'Delivery Batch Detail')

@section('extra_style')
    <link rel="stylesheet" href="{{ asset('static/css/pickup_batch.css') }}" type="text/css">
@endsection
@section('main_content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <div class="bread mb-4">
                <ol class="breadcrumb breadcrumb-line text-muted fs-6 fw-semibold">
                    <li class="breadcrumb-item"><a style="color: rgba(0, 66, 110, 1);"
                            href="{{ route('view_delivery_batch') }}" class="">Delivery Batch</a></li>
                    <li class="breadcrumb-item text-muted">Delivery Batch Details</li>
                </ol>
            </div>
            <div class="d-flex main-div-container col-xl-12">

                <div class="pickup-batch-div col-5 col-xl-5 me-4">
                    <div class="vehicle-detail-div mb-4">
                        <h5 class="mb-4 ms-3">Vehicle Details</h5>
                        <div class="detail-div d-flex">
                            <div class="img-div me-2">
                                <img alt="Logo" style="" src="{{ asset('static/media/van.png') }}"
                                    class="van-img" />
                            </div>
                            <div class="all-detail-div">
                                <div class="d-flex vehicle-detail">
                                    <p class="vehicle-detail-title">Vehicle #</p>
                                    <p class="vehicle-detail-content">AHR 3478, Toyota Hiace, 2022</p>
                                </div>
                                <div class="d-flex vehicle-detail">
                                    <p class="vehicle-detail-title">Driver</p>
                                    <p class="vehicle-detail-content">Driver Name</p>
                                </div>
                                <div class="d-flex vehicle-detail">
                                    <p class="vehicle-detail-title">Driver Contact</p>
                                    <p class="vehicle-detail-content">+97 13 040885424</p>
                                </div>
                                <div class="d-flex vehicle-detail">
                                    <p class="vehicle-detail-title">Temperature</p>
                                    <p class="vehicle-detail-content">32°C</p>
                                </div>
                                <div class="d-flex vehicle-detail">
                                    <p class="vehicle-detail-title">Current Location</p>
                                    <p class="vehicle-detail-content">29 st, Dubai, UAE</p>
                                </div>
                                <button class="lock-button my-2">Lock</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-div-batches">
                        <div class="pickup-batches">
                            <h4>Delivery List</h4>
                        </div>
                        <?php
                        // Dummy data array
                        $deliveries = [['id' => 127, 'order_id' => '2938938832', 'bag_id' => '29389388', 'start_time' => '09:07:36 am', 'status' => 'Completed'], ['id' => 127, 'order_id' => '2938938832', 'bag_id' => '29389388', 'start_time' => '09:07:36 am', 'status' => 'In Progress'], ['id' => 127, 'order_id' => '2938938832', 'bag_id' => '29389388', 'start_time' => '09:07:36 am', 'status' => 'In Progress'], ['id' => 127, 'order_id' => '2938938832', 'bag_id' => '29389388', 'start_time' => '10:30 am - 11:00 am', 'status' => 'In Progress']];
                        ?>
                        @foreach ($deliveries as $delivery)
                            <div class="order-div d-flex justify-content-between align-items-center px-3 pt-2">
                                <div class="order-detail">
                                    <p class="order_id_p">Order ID # {{ $delivery['order_id'] }}</p>
                                    <p class="bag_id">Bag ID # {{ $delivery['bag_id'] }}</p>
                                    <p class="start_time">Start Time: {{ $delivery['start_time'] }}</p>
                                </div>
                                <div class="status">
                                    <span>{{ $delivery['status'] }}</span>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="map-div col-7 col-xl-7">
                    <img alt="Map Image" src="{{ asset('static/media/delivery-map.png') }}" style="width:100%"
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
