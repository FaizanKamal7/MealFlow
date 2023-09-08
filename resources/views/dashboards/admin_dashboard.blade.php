@extends('layouts.admin_master')
@section('title', ' Dashboard')

@section('extra_style')
    {{-- styles for earth are in admin dashboard css file, comment out in last --}}
@endsection

@section('main_content')

{{-- globe div, for later use --}}
    <!--begin::Post-->
    {{-- <div id="earth"></div>
    <div class="canva_earth">

        <canvas id="scene"></canvas>
    </div>

    <div class="container">
        <canvas id="canvas"></canvas>
    </div> --}}

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-xl-7">
                    <div class="general_statistic">
                        <div class="head_general">
                            <h1 class="fs-lg-2x  pb-5 heading_type">General Statistics</h1>
                        </div>
                        <!--begin::Row-->
                        <div class="bottom_div">
                            <div class="row gy-5 g-xl-10 mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 col-xl-6">
                                    <!--begin::Card widget 2-->
                                    <div class="card h-lg-100 delivery" style=" border-radius: 3em">
                                        <!--begin::Body-->
                                        <div class="card-body d-flex justify-content-between card_body">
                                            <!--begin::Icon-->

                                            <!--end::Icon-->
                                            <!--begin::Section-->
                                            <div class="box_div">
                                                <div class="d-flex box-div_btm">
                                                    <span
                                                        class="fw-bold fs-3x text-primary-800 lh-1 ls-n2 onePoint">1.5M</span>
                                                    <div class="m-0">
                                                        <span class="badge badge-success fs-base">
                                                            +55%
                                                        </span>
                                                    </div>
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Badge-->
                                                <span class="fw-bold fs-6 text-black-400 ">Total Deliveries</span>
                                            </div>
                                            <div class="m-0 icon-div">
                                                <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                                                <span class="svg-icon svg-icon-2 svg white-icon">
                                                    <x-iconsax-bol-box-1 />
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <!--end::Badge-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Card widget 2-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6 col-xl-6 ">
                                    <!--begin::Card widget 2-->
                                    <div class="card h-lg-100 delivery" style=" border-radius: 3em">
                                        <!--begin::Body-->
                                        <div class="card-body d-flex justify-content-between card_body">
                                            <div class="box_div">
                                                <div class="d-flex box-div_btm">
                                                    <span
                                                        class="fw-bold fs-3x text-primary-800 lh-1 ls-n2 onePoint">75</span>
                                                    <div class="m-0">
                                                        <span class="badge badge-danger fs-base">
                                                            -25%
                                                        </span>
                                                    </div>
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Badge-->
                                                <span class="fw-bold fs-6 text-black-400 ">Total partners</span>
                                            </div>
                                            <div class="m-0 icon-div">
                                                <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                                                <span class="svg-icon svg-icon-2 svg white-icon">
                                                    <x-iconsax-bol-profile-2user />
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Card widget 2-->
                                </div>
                                <!--begin::Icon-->
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row gy-5 g-xl-10">
                                <div class="col-sm-6 col-xl-6">
                                    <!--begin::Card widget 2-->
                                    <div class="card h-lg-100 delivery" style=" border-radius: 3em">
                                        <!--begin::Body-->
                                        <div class="card-body d-flex justify-content-between card_body">
                                            <div class="box_div">
                                                <div class="d-flex box-div_btm">
                                                    <span class="fw-bold fs-3x text-primary-800 lh-1 ls-n2 onePoint">154
                                                        K</span>
                                                    <div class="m-0">
                                                        <span class="badge badge-success fs-base">
                                                            +3%
                                                        </span>
                                                    </div>
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Badge-->
                                                <span class="fw-bold fs-6 text-black-400 ">Todays Customers</span>
                                            </div>
                                            <div class="m-0 icon-div">
                                                <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                                                <span class="svg-icon svg-icon-2 svg white-icon">
                                                    <x-iconsax-bul-people />
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Card widget 2-->
                                </div>
                                <div class="col-sm-6 col-xl-6 mb-xl-5">
                                    <!--begin::Card widget 2-->
                                    <div class="card h-lg-100 delivery" style=" border-radius: 3em">
                                        <!--begin::Body-->
                                        <div class="card-body d-flex justify-content-between card_body">
                                            <div class="box_div">
                                                <div class="d-flex box-div_btm">
                                                    <span
                                                        class="fw-bold fs-3x text-primary-800 lh-1 ls-n2 onePoint">65</span>
                                                    <div class="m-0">
                                                        <span class="badge badge-success fs-base">
                                                            +5%
                                                        </span>
                                                    </div>
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Badge-->
                                                <span class="fw-bold fs-6 text-black-400 ">Total Vehicles</span>
                                            </div>
                                            <div class="m-0 icon-div">
                                                <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                                                <span class="svg-icon svg-icon-2 svg white-icon">
                                                    <x-iconsax-bol-car />
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Card widget 2-->
                                </div>
                            </div>
                            <!--end::Row-->
                        </div>
                    </div>
                    <!--begin::Mixed Widget 4-->

                    <!--end::Mixed Widget 4-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-5">

                    <div class="col-xl-12">
                        <div class="card outer-card">
                            <h2> Hello there, Hope You Have
                                Great Day! </h2>
                            <div class="card mb-10 weather-card ">
                                <!--begin::Body-->
                                <div class="card-body d-flex justify-content-between  flex-column ">

                                    <!--end::Icon-->
                                    <!--begin::Section-->
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <span class="svg-icon svg-icon-5hx svg-icon-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                    width="256" height="256" viewBox="0 0 256 256"
                                                    xml:space="preserve">

                                                    <defs>
                                                    </defs>
                                                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                                                        transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                                        <circle cx="34.717" cy="35.307" r="19.817"
                                                            style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(232,224,119); fill-rule: nonzero; opacity: 1;"
                                                            transform="  matrix(1 0 0 1 0 0) " />
                                                        <path
                                                            d="M 42.869 37.202 c 0.799 -6.532 6.455 -11.579 13.087 -11.579 c 4.749 0 9.038 2.489 11.398 6.553 c 1.78 -1.822 4.203 -2.851 6.775 -2.851 c 4.815 0 8.875 3.661 9.416 8.406 C 87.423 39.216 90 42.937 90 47.112 c 0 5.543 -4.51 10.054 -10.054 10.054 H 44.536 c -5.543 0 -10.054 -4.51 -10.054 -10.054 C 34.482 42.18 38.054 38.004 42.869 37.202 z"
                                                            style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(183,189,244); fill-rule: nonzero; opacity: 1;"
                                                            transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                        <path
                                                            d="M 62.119 48.202 C 61.066 39.593 53.612 32.94 44.87 32.94 c -6.259 0 -11.912 3.28 -15.022 8.637 c -2.346 -2.402 -5.539 -3.758 -8.929 -3.758 c -6.347 0 -11.698 4.825 -12.411 11.079 C 3.397 50.857 0 55.76 0 61.263 c 0 7.306 5.944 13.251 13.251 13.251 h 46.672 c 7.306 0 13.251 -5.945 13.251 -13.251 C 73.173 54.763 68.466 49.259 62.119 48.202 z"
                                                            style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(131,141,229); fill-rule: nonzero; opacity: 1;"
                                                            transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                    </g>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            {{-- <span class="fw-bold fs-2x text-white lh-1 ls-n2 mt-3">Cloudy</span> --}}
                                        </div>

                                        <div class="d-flex my-7 col-7"
                                            style="
                                    border-left: 1px solid gray;
                                    border-width: 3px;
                                    padding: 0 15px;
                                ">
                                            <!--begin::Number-->
                                            <div class="flex-column ">

                                                <span class="fw-bold fs-3x lh-1 ls-n2 mt-3">-29 °C</span>
                                                <div class="ms-5">
                                                    <span class="fw-bold fs-6" style="color: gray">Mostly Cloudy
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="m-0 dubai">
                                                <span class="fw-bold fs-6">Dubai
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--begin::Badge-->
                                    <!--end::Badge-->
                                </div>
                                <!--end::Body-->
                            </div>
                        </div>

                    </div>
                    <!--begin::Mixed Widget 7-->

                    <!--end::Mixed Widget 7-->
                    {{-- commented out this div to remove extra space in height --}}
                    {{-- <div id="kt_amcharts_3" style="height: 600px;"></div> --}}

                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->

            <div class="row gy-5 g-xl-8">

                <div class="col-xl-7">
                    <div class="card card-xl-stretch mb-xl-8 mb-10 delivery-card">
                        <!--begin::Beader-->
                        <div class="card-header border-1 pb-5 delivery-header">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1 header-font">Today’s
                                    Deliveries Progress</span>
                            </h3>
                            <h4 class="card-label fw-bolder fs-3 mb-1 view">
                                View All</h4>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="  card-body d-flex flex-column delivery-body">
                            <div class="row">
                                <div class="col-3 h-50">
                                    <div class="d-flex flex-column flex-grow-1 align-items-center">
                                        <div class="mixed-widget-4-chart" data-kt-chart-color="primary"
                                            style="height: 150px">
                                        </div>
                                        <div class="time-div">
                                            <span class="fw-bold  text-dark-300 time ">(2 AM - 6 AM)</span>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex flex-column col-3 flex-nowrap text-nowrap">
                                    <!--begin::Number-->
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2"><span class="dash text-gray">-</span>
                                        <span class="complete span-adjust"> Completed </span> <span class="number"> 1100
                                        </span></span>
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2"><span class="dash">-</span> <span
                                            class="pending span-adjust"> Pending </span> <span class="number"> 42
                                        </span></span>
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2"><span class="dash"
                                            style="color: rgba(241, 65, 108, 1);
                                        ">-</span>
                                        <span class="cancel span-adjust"> Cancelled </span> <span class="number"
                                            style="color: rgba(241, 65, 108, 1);
                                            ">
                                            3 </span></span>
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2"><span class="dash">-</span> <span
                                            class="complete span-adjust"> Total </span> <span class="number"> 1146
                                        </span></span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->

                                    <!--end::Follower-->
                                </div>

                                <div class="col-3 h-50">
                                    <div class="d-flex flex-column flex-grow-1 align-items-center">
                                        <div class="mixed-widget-4-chart" data-kt-chart-color="primary"
                                            style="height: 150px">
                                        </div>
                                        <div class="time-div">
                                            <span class="fw-bold  text-dark-300 time ">(2 AM - 7 AM)</span>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex flex-column col-3 flex-nowrap text-nowrap">
                                    <!--begin::Number-->
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2"><span class="dash text-gray">-</span>
                                        <span class="complete span-adjust"> Completed </span> <span class="number"> 1100
                                        </span></span>
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2"><span class="dash">-</span> <span
                                            class="pending span-adjust"> Pending </span> <span class="number"> 42
                                        </span></span>
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2"><span class="dash"
                                            style="color: rgba(241, 65, 108, 1);
                                        ">-</span>
                                        <span class="cancel span-adjust"> Cancelled </span> <span class="number"
                                            style="color: rgba(241, 65, 108, 1);
                                            ">
                                            3 </span></span>
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2"><span class="dash">-</span> <span
                                            class="complete span-adjust"> Total </span> <span class="number"> 1146
                                        </span></span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->

                                    <!--end::Follower-->
                                </div>
                            </div>
                            <div class="separator"></div>

                            <div class="row">
                                <div class="col-3 h-50">
                                    <div class="d-flex flex-column flex-grow-1 align-items-center">
                                        <div class="mixed-widget-4-chart" data-kt-chart-color="primary"
                                            style="height: 150px">
                                        </div>
                                        <div class="time-div">
                                            <span class="fw-bold  text-dark-300 time ">(2 AM - 6 AM)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column col-3 flex-nowrap text-nowrap">
                                    <!--begin::Number-->
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2"><span class="dash text-gray">-</span>
                                        <span class="complete span-adjust"> Completed </span> <span class="number"> 1100
                                        </span></span>
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2"><span class="dash">-</span> <span
                                            class="pending span-adjust"> Pending </span> <span class="number"> 42
                                        </span></span>
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2"><span class="dash"
                                            style="color: rgba(241, 65, 108, 1);
                                        ">-</span>
                                        <span class="cancel span-adjust"> Cancelled </span> <span class="number"
                                            style="color: rgba(241, 65, 108, 1);
                                            ">
                                            3 </span></span>
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2"><span class="dash">-</span> <span
                                            class="complete span-adjust"> Total </span> <span class="number"> 1146
                                        </span></span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->

                                    <!--end::Follower-->
                                </div>
                                <div class="col-3 h-50">
                                    <div class="d-flex flex-column flex-grow-1 align-items-center">
                                        <div class="mixed-widget-4-chart" data-kt-chart-color="primary"
                                            style="height: 150px">
                                        </div>
                                        <div class="time-div">
                                            <span class="fw-bold  text-dark-300 time ">(2 AM - 7 AM)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column col-3 flex-nowrap text-nowrap">
                                    <!--begin::Number-->
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2"><span class="dash text-gray">-</span>
                                        <span class="complete span-adjust"> Completed </span> <span class="number"> 1100
                                        </span></span>
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2"><span class="dash">-</span> <span
                                            class="pending span-adjust"> Pending </span> <span class="number"> 42
                                        </span></span>
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2"><span class="dash"
                                            style="color: rgba(241, 65, 108, 1);
                                        ">-</span>
                                        <span class="cancel span-adjust"> Cancelled </span> <span class="number"
                                            style="color: rgba(241, 65, 108, 1);
                                            ">
                                            3 </span></span>
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2"><span class="dash">-</span> <span
                                            class="complete span-adjust"> Total </span> <span class="number"> 1146
                                        </span></span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->

                                    <!--end::Follower-->
                                </div>
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="col-xl-12">
                        <!--begin::Statistics Widget 5-->
                        <div class="card hoverable card-length">
                            <!--begin::Body-->
                            <div class="card-body earning-card">
                                <h3 class="earning"> Earnings</h3>
                                <p class="last-week">+15% since last week</p>
                                <h2 class="dollar">$15,800</h2>
                                <div class="">
                                    <a class="btn btn-primary text-white view-more">View More</a>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Statistics Widget 5-->
                    </div>
                </div>
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row ">
                <!--begin::Col-->
                <!--begin::Col-->
                <div class="col-xl-7">
                    <!--begin::Chart widget 4-->
                    <div class="card card-flush overflow-hidden h-md-100 delivery-card">
                        <!--begin::Header-->
                        <div class="card-header py-5 delivery-header">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-dark header-font">Key Performance Indicator</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                            <!--begin::Chart-->
                            <div id="kt_charts_widget_4" class="min-h-auto ps-4 pe-6" style="height: 300px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Chart widget 4-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-5">
                    <!--begin::Card widget 4-->
                    <div class="card card-flush h-100  delivery-card">
                        <div class="card-header py-5 delivery-header">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column ">
                                <span class="card-label fw-bolder text-dark header-font">Partner's Comparison Dilervery
                                    Wise</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                        </div>
                        <!--begin::Card body-->
                        <div class="px-4 pt-2 pb-2">
                            <!--begin::Chart-->
                            <div class="d-flex justify-content-around align-items-center">
                                <div id="kt_chart_widgets_22_chart_1" class="mb-4 ms-n12"></div>
                                <div class="">
                                    <a class="btn btn-primary text-white view-more">See All Partners</a>
                                </div>
                            </div>
                            <!--end::Chart-->
                            <!--begin::Labels-->
                            <div class="delivery-body d-flex flex-column content-justify-center w-100">
                                <h3
                                    style="color: rgba(0, 66, 110, 1); 
                                    opacity:0.7; 
                                    font-size:16px !important;
                                ">
                                    Partner's List</h3>
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-15px h-6px rounded-2 me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-black-700 opacity-75 flex-grow-1 me-4 my-1">Super Meals</div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="text-gray-600 text-xxl-end"><span class="fw-boldest text-700"
                                            style="color:rgba(0, 66, 110, 1);
                                        ">25%
                                        </span>(250)
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <div class="separator"></div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-15px h-6px rounded-2 me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-black-700 opacity-75 flex-grow-1 me-4 my-1">Super Meals</div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="text-gray-600 text-xxl-end"><span class="fw-boldest text-700"
                                            style="color:rgba(0, 66, 110, 1);
                                        ">25%
                                        </span>(250)
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <div class="separator"></div>
                                <div class="d-flex fs-6 fw-bold align-items-center">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-15px h-6px rounded-2 me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-black-700 opacity-75 flex-grow-1 me-4 my-1">Super Meals</div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="text-gray-600 text-xxl-end"><span class="fw-boldest text-700"
                                            style="color:rgba(0, 66, 110, 1);
                                        ">25%
                                        </span>(250)
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <div class="separator"></div>

                            </div>
                            <!--end::Labels-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 4-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            {{-- copyyy --}}
            <!--begin::Row-->
            <div class="row my-2 mb-8 gy-5 g-xl-8">
                <!--begin::Col-->
                <!--begin::Col-->
                <div class="col-xl-7">
                    <!--begin::Chart widget 4-->
                    <div class="card card-flush h-100 mb-5 delivery-card">
                        <div class="card-header border border-1 delivery-header justify-content-between"
                            style="padding: 0 30px !important;">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-dark">Complaints OverView</span>

                            </h3>
                            <div class="d-flex justify-content-between align-items-center gap-10 mt-2 ">
                                <p>Month</p>
                                <p>Week</p>
                                <p
                                    style="background: rgba(0, 66, 110, 1);
                                color: white;
                                padding: 10px;
                                border-radius: 6px;
                                width: 54px;
                                text-align: center;">
                                    Day</p>
                            </div>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                        </div>
                        <!--begin::Body-->
                        <div class="card-body d-flex justify-content-between flex-column p-0 pt-5">
                            <!--begin::Items-->
                            <div class="mb-5 px-9">
                                <!--begin::Item-->
                                <div class="row">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-3 my-2">
                                        <div class="d-flex align-items-center w-100 justify-content-between">
                                            <a href="#"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bolder  ">Dillevery
                                                on
                                                Wrong Adress (Driver Error)</a>
                                            <span class="text-black-700 fw-bolder">68%</span>
                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-center w-100">
                                        <!--begin::Progress-->
                                        <div class="progress h-6px w-100 me-2 bg-light-success">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: 65%; background: linear-gradient(180deg, #246FA1 0%, #488CB9 100%);
                                            "
                                                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <!--end::Progress-->
                                        <!--begin::Value-->
                                        <!--end::Value-->
                                    </div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-4"></div>
                                <div class="row">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-3 my-2">
                                        <div class="d-flex align-items-center w-100 justify-content-between">
                                            <a href="#"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bolder">Employee
                                                Complaints</a>
                                            <span class="text-black-700 fw-bolder">58%</span>
                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-center w-100">
                                        <!--begin::Progress-->
                                        <div class="progress h-6px w-100 me-2 bg-light-success">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: 58%;"
                                                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <!--end::Progress-->
                                        <!--begin::Value-->
                                        <!--end::Value-->
                                    </div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-4"></div>

                                <div class="row">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-3 my-2">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center w-100 justify-content-between">
                                            <a href="#"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bolder">Negative
                                                Reviews</a>
                                            <span class="text-black-700 fw-bolder">28%</span>
                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-center w-100">
                                        <!--begin::Progress-->
                                        <div class="progress h-6px w-100 me-2 bg-light-success">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 28%; "
                                                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Separator-->
                                <div class="separator" style="margin-top: 30px !important"></div>
                            </div>
                            <!--end::Items-->

                        </div>
                        <!--end::Body-->

                        <div class="Card-footer">

                            <div class="d-flex flex-column my-7 mx-8">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="m-0">
                                            <span class="fw-bold fs-6 text-gray-400 ">Total numbers of complain in last 30
                                                Days</span>
                                        </div>
                                        <span class="fw-bold fs-2x text-gray-800 lh-1 ls-n2 my-3">865 Complaints</span>
                                        <!--begin::Number-->
                                    </div>

                                    <div class="col-4">
                                        <a class="btn btn-primary text-white view-more" style="width: auto !important">See
                                            All Complaints</a>
                                    </div>
                                </div>

                            </div>


                        </div>

                        <div>
                        </div>
                        <!--end::Card widget 4-->


                    </div>
                    <!--end::Chart widget 4-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-5">
                    <!--begin::Card widget 4-->
                    <div class="card card-flush delivery-card">
                        <div class="card-header py-5 delivery-header">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column ">
                                <span class="card-label fw-bolder text-dark header-font">Revenues</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                        </div>
                        <!--begin::Card body-->
                        <div class="px-4 pt-2 pb-2">
                            <div class="delivery-body d-flex flex-column content-justify-center w-100">

                                <div class="d-flex fs-6 fw-bold align-items-center mt-5">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-15px h-6px rounded-2 me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-black-700 opacity-75  w-150px">Deliveries Revenue
                                    </div>
                                    <div class="text-success fw-boldest opacity-75 flex-grow-1">+3%</div>

                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="text-xxl-end fw-boldest text-700 fs-1"
                                        style="color:rgba(0, 66, 110, 1);
                                        ">$54,340

                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <div class="separator"></div>
                                <div class="d-flex fs-6 fw-bold align-items-center mt-5">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-15px h-6px rounded-2 me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text opacity-75 w-150px">Bags Revenue</div>
                                    <div class="text-success fw-boldest opacity-75 flex-grow-1">+3%</div>

                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="text-700 text-xxl-end fw-boldest fs-1" style="color:rgba(0, 66, 110, 1)">
                                        154 K
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <div class="align-self-center mt-20">
                                    <a class="btn btn-primary text-white view-more">See All Revenue</a>
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                            </div>
                            <!--end::Labels-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    {{-- <div class="">

                        <div class="col-6">
                            <div class="card card-xl-stretch " style="background-color: #F7D9E3">
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <!--begin::Title-->
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Dilevery
                                            Revenue</a>
                                        <!--end::Title-->
                                        <!--begin::Chart-->
                                        <div class="mixed-widget-13-chart" style="height: 100px"></div>
                                        <!--end::Chart-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Stats-->
                                    <div class="pt-5">
                                        <!--begin::Symbol-->
                                        <span class="text-dark fw-bolder fs-2x lh-0">$</span>
                                        <!--end::Symbol-->
                                        <!--begin::Number-->
                                        <span class="text-dark fw-bolder fs-3x me-2 lh-0">560</span>
                                        <!--end::Number-->
                                        <!--begin::Text-->
                                        <span class="text-dark fw-bolder fs-6 lh-0">+ 28% this week</span>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Body-->
                            </div>

                        </div>

                        <div class="col-6">
                            <div class="card card-xl-stretch bg-light-success" style="">
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <!--begin::Title-->
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Bag
                                            Revenue</a>
                                        <!--end::Title-->
                                        <!--begin::Chart-->
                                        <div class="mixed-widget-13-chart" style="height: 100px"></div>
                                        <!--end::Chart-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Stats-->
                                    <div class="pt-5">
                                        <!--begin::Symbol-->
                                        <span class="text-dark fw-bolder fs-2x lh-0">$</span>
                                        <!--end::Symbol-->
                                        <!--begin::Number-->
                                        <span class="text-dark fw-bolder fs-3x me-2 lh-0">560</span>
                                        <!--end::Number-->
                                        <!--begin::Text-->
                                        <span class="text-dark fw-bolder fs-6 lh-0">+ 28% this week</span>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Body-->
                            </div>

                        </div>


                    </div> --}}
                    <!--end::Col-->
                    <!--end::Card widget 4-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            {{-- copy --}}

            <div class="row ">
                <!--begin::Col-->
                <!--begin::Col-->
                <div class="col-xl-6">
                    <div class="row">

                        <!--begin::Modals-->
                        <!--begin::Modal - New Product-->
                        <div class="modal fade" id="kt_modal_add_event" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Form-->
                                    <form class="form" action="#" id="kt_modal_add_event_form">
                                        <!--begin::Modal header-->
                                        <div class="modal-header">
                                            <!--begin::Modal title-->
                                            <h2 class="fw-bolder" data-kt-calendar="title">Add Event</h2>
                                            <!--end::Modal title-->
                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                id="kt_modal_add_event_close">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                <span class="svg-icon svg-icon-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="6" y="17.3137"
                                                            width="16" height="2" rx="1"
                                                            transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                        <rect x="7.41422" y="6" width="16"
                                                            height="2" rx="1"
                                                            transform="rotate(45 7.41422 6)" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <!--end::Close-->
                                        </div>
                                        <!--end::Modal header-->
                                        <!--begin::Modal body-->
                                        <div class="modal-body py-10 px-lg-17">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold required mb-2">Event Name</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="" name="calendar_event_name" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold mb-2">Event Description</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="" name="calendar_event_description" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold mb-2">Event Location</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="" name="calendar_event_location" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-9">
                                                <!--begin::Checkbox-->
                                                <label class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="kt_calendar_datepicker_allday" />
                                                    <span class="form-check-label fw-bold"
                                                        for="kt_calendar_datepicker_allday">All
                                                        Day</span>
                                                </label>
                                                <!--end::Checkbox-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row row-cols-lg-2 g-10">
                                                <div class="col">
                                                    <div class="fv-row mb-9">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-bold mb-2 required">Event Start
                                                            Date</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input class="form-control form-control-solid"
                                                            name="calendar_event_start_date"
                                                            placeholder="Pick a start date"
                                                            id="kt_calendar_datepicker_start_date" />
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <div class="col" data-kt-calendar="datepicker">
                                                    <div class="fv-row mb-9">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-bold mb-2">Event Start Time</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input class="form-control form-control-solid"
                                                            name="calendar_event_start_time"
                                                            placeholder="Pick a start time"
                                                            id="kt_calendar_datepicker_start_time" />
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row row-cols-lg-2 g-10">
                                                <div class="col">
                                                    <div class="fv-row mb-9">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-bold mb-2 required">Event End Date</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input class="form-control form-control-solid"
                                                            name="calendar_event_end_date" placeholder="Pick a end date"
                                                            id="kt_calendar_datepicker_end_date" />
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <div class="col" data-kt-calendar="datepicker">
                                                    <div class="fv-row mb-9">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-bold mb-2">Event End Time</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input class="form-control form-control-solid"
                                                            name="calendar_event_end_time" placeholder="Pick a end time"
                                                            id="kt_calendar_datepicker_end_time" />
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Modal body-->
                                        <!--begin::Modal footer-->
                                        <div class="modal-footer flex-center">
                                            <!--begin::Button-->
                                            <button type="reset" id="kt_modal_add_event_cancel"
                                                class="btn btn-light me-3">Cancel
                                            </button>
                                            <!--end::Button-->
                                            <!--begin::Button-->
                                            <button type="button" id="kt_modal_add_event_submit"
                                                class="btn btn-primary">
                                                <span class="indicator-label">Submit</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                        <!--end::Modal footer-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                            </div>
                        </div>

                        <!--end::Modal - New Product-->
                        <!--begin::Modal - New Product-->
                        <div class="modal fade" id="kt_modal_view_event" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Modal header-->
                                    <div class="modal-header border-0 justify-content-end">
                                        <!--begin::Edit-->
                                        <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary me-2"
                                            data-bs-toggle="tooltip" data-bs-dismiss="click" title="Edit Event"
                                            id="kt_modal_view_event_edit">
                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <!--end::Edit-->
                                        <!--begin::Edit-->
                                        <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger me-2"
                                            data-bs-toggle="tooltip" data-bs-dismiss="click" title="Delete Event"
                                            id="kt_modal_view_event_delete">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                            <span class="svg-icon svg-icon-2">
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
                                        </div>
                                        <!--end::Edit-->
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary"
                                            data-bs-toggle="tooltip" title="Hide Event" data-bs-dismiss="modal">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="6" y="17.3137" width="16"
                                                        height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                                        fill="currentColor" />
                                                    <rect x="7.41422" y="6" width="16" height="2"
                                                        rx="1" transform="rotate(45 7.41422 6)"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <!--end::Close-->
                                    </div>
                                    <!--end::Modal header-->
                                    <!--begin::Modal body-->
                                    <div class="modal-body pt-0 pb-20 px-lg-17">
                                        <!--begin::Row-->
                                        <div class="d-flex">
                                            <!--begin::Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-muted me-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <!--end::Icon-->
                                            <div class="mb-9">
                                                <!--begin::Event name-->
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="fs-3 fw-bolder me-3"
                                                        data-kt-calendar="event_name"></span>
                                                    <span class="badge badge-light-success"
                                                        data-kt-calendar="all_day"></span>
                                                </div>
                                                <!--end::Event name-->
                                                <!--begin::Event description-->
                                                <div class="fs-6" data-kt-calendar="event_description"></div>
                                                <!--end::Event description-->
                                            </div>
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs050.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-success me-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <circle fill="currentColor" cx="12" cy="12"
                                                        r="8" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <!--end::Icon-->
                                            <!--begin::Event start date/time-->
                                            <div class="fs-6">
                                                <span class="fw-bolder">Starts</span>
                                                <span data-kt-calendar="event_start_date"></span>
                                            </div>
                                            <!--end::Event start date/time-->
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <div class="d-flex align-items-center mb-9">
                                            <!--begin::Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs050.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-danger me-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <circle fill="currentColor" cx="12" cy="12"
                                                        r="8" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <!--end::Icon-->
                                            <!--begin::Event end date/time-->
                                            <div class="fs-6">
                                                <span class="fw-bolder">Ends</span>
                                                <span data-kt-calendar="event_end_date"></span>
                                            </div>
                                            <!--end::Event end date/time-->
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-muted me-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <!--end::Icon-->
                                            <!--begin::Event location-->
                                            <div class="fs-6" data-kt-calendar="event_location"></div>
                                            <!--end::Event location-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Modal body-->
                                </div>
                            </div>
                        </div>
                        <!--end::Modal - New Product-->
                        <!--end::Modals-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Post-->
            @endsection



            @section('extra_scripts')

                <!--begin::Page Custom Javascript(used by dashboard)-->
                <script src="https://cdn.amcharts.com/lib/4/geodata/worldLow.js"></script>
                <script src="https://cdn.amcharts.com/lib/4/geodata/continentsLow.js"></script>
                <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
                <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
                <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
                <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
                <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
                <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
                <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

                {{-- globe scripts --}}
                {{-- <script src="{{ asset('static/js/three.js') }}"></script> --}}

                {{-- <script type="module">
                    {
                        "imports": {
                            "three": "https://unpkg.com/three@0.138.0/build/three.module.js",
                            "OrbitControls": "https://unpkg.com/three@0.138.0/examples/jsm/controls/OrbitControls.js",
                            "BufferGeometryUtils": "https://unpkg.com/three@0.138.0/examples/jsm/utils/BufferGeometryUtils.js"
                        }
                    }
                </script> --}}
                {{-- <script src="{{ asset('static/js/three.js') }}" type="module"></script> --}}

                {{-- <script type="module">
                    import * as THREE from "nixus_erp/node_modules/three";
                    // import * as BufferGeometryUtils from "three/examples/jsm/utils/BufferGeometryUtils.js";
                    // import {
                    //     OrbitControls
                        
                    // } from "three/examples/jsm/controls/OrbitControls";
                    var check = 1;
                    const CANVAS = document.querySelector("#canvas");
                    console.log('hehe', check)


                    const SCENE_ANTIALIAS = true;
                    const SCENE_ALPHA = true;
                    const SCENE_BACKGROUND_COLOR = 0x000000;

                    const CAMERA_FOV = 20;
                    const CAMERA_NEAR = 100;
                    const CAMERA_FAR = 500;
                    const CAMERA_X = 0;
                    const CAMERA_Y = 0;
                    const CAMERA_Z = 220;

                    const MASK_IMAGE = "./assets/map.png";

                    const SPHERE_RADIUS = 30;
                    const LATITUDE_COUNT = 80;
                    const DOT_DENSITY = 0.8;

                    const DOT_SIZE = 0.2;
                    const DOT_COLOR = 0xffffff;

                    // Utility function to convert a dot on a sphere into a UV point on a
                    // rectangular texture or image.
                    const spherePointToUV = (dotCenter, sphereCenter) => {
                        // Create a new vector and give it a direction from the center of the sphere
                        // to the center of the dot.
                        const newVector = new THREE.Vector3();
                        newVector.subVectors(sphereCenter, dotCenter).normalize();

                        // Calculate the  UV coordinates of the dot and return them as a vector.
                        const uvX = 1 - (0.5 + Math.atan2(newVector.z, newVector.x) / (2 * Math.PI));
                        const uvY = 0.5 + Math.asin(newVector.y) / Math.PI;

                        return new THREE.Vector2(uvX, uvY);
                    };

                    // Utility function to sample the data of an image at a given point. Requires
                    // an imageData object.
                    const sampleImage = (imageData, uv) => {
                        // Calculate and return the data for the point, from the UV coordinates.
                        const point =
                            4 * Math.floor(uv.x * imageData.width) +
                            Math.floor(uv.y * imageData.height) * (4 * imageData.width);

                        return imageData.data.slice(point, point + 4);
                    };

                    // Render the scene.
                    const renderScene = (imageData) => {
                        // Define the renderer, in this case WebGL.
                        const renderer = new THREE.WebGLRenderer({
                            canvas: CANVAS,
                            antialias: SCENE_ANTIALIAS,
                            alpha: SCENE_ALPHA
                        });

                        // // Set up and position the camera.
                        const camera = new THREE.PerspectiveCamera(
                            CAMERA_FOV,
                            CANVAS.width / CANVAS.height,
                            CAMERA_NEAR,
                            CAMERA_FAR
                        );

                        // Set up the orbit controls.
                        const controls = new OrbitControls(camera, renderer.domElement);

                        // Position the camera.
                        camera.position.set(CAMERA_X, CAMERA_Y, CAMERA_Z);

                        // Update the controls (required after positioning the camera).
                        controls.update();

                        // Set up the scene.
                        const scene = new THREE.Scene();

                        // Add a background color.
                        scene.background = new THREE.Color(SCENE_BACKGROUND_COLOR);

                        // Define an array to hold the geometries of all the dots.
                        const dotGeometries = [];

                        // Create a blank vector to be used by the dots.
                        const vector = new THREE.Vector3();

                        // Loop across the latitude lines.
                        for (let lat = 0; lat < LATITUDE_COUNT; lat += 1) {
                            // Calculate the radius of the latitude line.
                            const radius =
                                Math.cos((-90 + (180 / LATITUDE_COUNT) * lat) * (Math.PI / 180)) *
                                SPHERE_RADIUS;
                            // Calculate the circumference of the latitude line.
                            const latitudeCircumference = radius * Math.PI * 2 * 2;
                            // Calculate the number of dots required for the latitude line.
                            const latitudeDotCount = Math.ceil(latitudeCircumference * DOT_DENSITY);

                            // Loop across the dot count for the latitude line.
                            for (let dot = 0; dot < latitudeDotCount; dot += 1) {
                                const dotGeometry = new THREE.CircleGeometry(DOT_SIZE, 5);
                                // Calculate the phi and theta angles for the dot.
                                const phi = (Math.PI / LATITUDE_COUNT) * lat;
                                const theta = ((2 * Math.PI) / latitudeDotCount) * dot;

                                // Set the vector using the spherical coordinates generated from the sphere radius, phi and theta.
                                vector.setFromSphericalCoords(SPHERE_RADIUS, phi, theta);

                                // Make sure the dot is facing in the right direction.
                                dotGeometry.lookAt(vector);

                                // Move the dot geometry into position.
                                dotGeometry.translate(vector.x, vector.y, vector.z);

                                // Find the bounding sphere of the dot.
                                dotGeometry.computeBoundingSphere();

                                // Find the UV position of the dot on the land image.
                                const uv = spherePointToUV(
                                    dotGeometry.boundingSphere.center,
                                    new THREE.Vector3()
                                );

                                // Sample the pixel on the land image at the given UV position.
                                const sampledPixel = sampleImage(imageData, uv);

                                // If the pixel contains a color value (in other words, is not transparent),
                                // continue to create the dot. Otherwise don't bother.
                                if (sampledPixel[3]) {
                                    // Push the positioned geometry into the array.
                                    dotGeometries.push(dotGeometry);
                                }
                            }
                        }

                        // Merge all the dot geometries together into one buffer geometry.
                        const mergedDotGeometries = BufferGeometryUtils.mergeBufferGeometries(
                            dotGeometries
                        );

                        // Define the material for the dots.
                        const dotMaterial = new THREE.MeshBasicMaterial({
                            color: DOT_COLOR,
                            side: THREE.DoubleSide
                        });

                        // Create the dot mesh from the dot geometries and material.
                        const dotMesh = new THREE.Mesh(mergedDotGeometries, dotMaterial);

                        // Add the dot mesh to the scene.
                        scene.add(dotMesh);

                        // Animate the scene using the browser's native requestAnimationFrame method.
                        const animate = (time) => {
                            // Reduce the current timestamp to something manageable.
                            time *= 0.001;

                            // Update the dot mesh rotation.
                            dotMesh.rotation.y = time * 0.1;

                            // Update the orbit controls now that things have changed.
                            controls.update();

                            // Re-render the scene and trigger another animation frame.
                            renderer.render(scene, camera);

                            requestAnimationFrame(animate);
                        };

                        // Trigger the first animation frame.
                        requestAnimationFrame(animate);
                    };

                    // Establish the canvas size and call the function to render the scene.
                    const setCanvasSize = () => {
                        CANVAS.width = window.innerWidth;
                        CANVAS.height = window.innerHeight;

                        // Initialise an image loader.
                        const imageLoader = new THREE.ImageLoader();

                        // Load the image used to determine where dots are displayed. The sphere
                        // cannot be initialised until this is complete.
                        imageLoader.load(MASK_IMAGE, (image) => {
                            // Create an HTML canvas, get its context and draw the image on it.
                            const tempCanvas = document.createElement("canvas");

                            tempCanvas.width = image.width;
                            tempCanvas.height = image.height;

                            const ctx = tempCanvas.getContext("2d");

                            ctx.drawImage(image, 0, 0);

                            // Read the image data from the canvas context.
                            const imageData = ctx.getImageData(0, 0, image.width, image.height);

                            renderScene(imageData);
                        });
                    };

                    setCanvasSize();

                    // When the window is resized, redraw the scene.
                    window.addEventListener("resize", setCanvasSize);


                    // Your JavaScript code here
                </script> --}}



                {{-- scene id script-commenting out, for later use --}}
                {{-- <script>
                    // console.clear();

                    // Get the canvas element from the DOM
                    const canvas = document.querySelector('#scene');
                    canvas.width = canvas.clientWidth;
                    canvas.height = canvas.clientHeight;
                    // Store the 2D context
                    const ctx = canvas.getContext('2d');

                    if (window.devicePixelRatio > 1) {
                        canvas.width = canvas.clientWidth * 2;
                        canvas.height = canvas.clientHeight * 2;
                        ctx.scale(2, 2);
                    }

                    /* ====================== */
                    /* ====== VARIABLES ===== */
                    /* ====================== */
                    let width = canvas.clientWidth; // Width of the canvas
                    let height = canvas.clientHeight; // Height of the canvas
                    let rotation = 0; // Rotation of the globe
                    let dots = []; // Every dots in an array

                    /* ====================== */
                    /* ====== CONSTANTS ===== */
                    /* ====================== */
                    /* Some of those constants may change if the user resizes their screen but I still strongly believe they belong to the Constants part of the variables */
                    const DOTS_AMOUNT = 2000; // Amount of dots on the screen
                    const DOT_RADIUS = 2; // Radius of the dots
                    let GLOBE_RADIUS = width * 1; // Radius of the globe
                    let GLOBE_CENTER_Z = -GLOBE_RADIUS; // Z value of the globe center
                    let PROJECTION_CENTER_X = width / 2; // X center of the canvas HTML
                    let PROJECTION_CENTER_Y = height / 2; // Y center of the canvas HTML
                    let FIELD_OF_VIEW = width * 0.8;

                    class Dot {
                        constructor(x, y, z) {
                            this.x = x;
                            this.y = y;
                            this.z = z;

                            this.xProject = 0;
                            this.yProject = 0;
                            this.sizeProjection = 0;
                        }
                        // Do some math to project the 3D position into the 2D canvas
                        project(sin, cos) {
                            const rotX = cos * this.x + sin * (this.z - GLOBE_CENTER_Z);
                            const rotZ = -sin * this.x + cos * (this.z - GLOBE_CENTER_Z) + GLOBE_CENTER_Z;
                            this.sizeProjection = FIELD_OF_VIEW / (FIELD_OF_VIEW - rotZ);
                            this.xProject = (rotX * this.sizeProjection) + PROJECTION_CENTER_X;
                            this.yProject = (this.y * this.sizeProjection) + PROJECTION_CENTER_Y;
                        }
                        // Draw the dot on the canvas
                        draw(sin, cos) {
                            this.project(sin, cos);
                            // ctx.fillRect(this.xProject - DOT_RADIUS, this.yProject - DOT_RADIUS, DOT_RADIUS * 2 * this.sizeProjection, DOT_RADIUS * 2 * this.sizeProjection);
                            ctx.fillStyle = 'gray'; // Change dot color to red

                            ctx.beginPath();
                            ctx.arc(this.xProject, this.yProject, DOT_RADIUS * this.sizeProjection, 0, Math.PI * 2);
                            ctx.closePath();
                            ctx.fill();
                        }
                    }

                    function createDots() {
                        // Empty the array of dots
                        dots.length = 0;

                        // Create a new dot based on the amount needed
                        for (let i = 0; i < DOTS_AMOUNT; i++) {
                            const theta = Math.random() * 2 * Math.PI; // Random value between [0, 2PI]
                            const phi = Math.acos((Math.random() * 2) - 1); // Random value between [-1, 1]

                            // Calculate the [x, y, z] coordinates of the dot along the globe
                            const x = GLOBE_RADIUS * Math.sin(phi) * Math.cos(theta);
                            const y = GLOBE_RADIUS * Math.sin(phi) * Math.sin(theta);
                            const z = (GLOBE_RADIUS * Math.cos(phi)) + GLOBE_CENTER_Z;
                            dots.push(new Dot(x, y, z));
                        }
                    }

                    /* ====================== */
                    /* ======== RENDER ====== */
                    /* ====================== */
                    function render(a) {
                        // Clear the scene
                        ctx.clearRect(0, 0, width, height);

                        // Increase the globe rotation
                        rotation = a * 0.00008;

                        const sineRotation = Math.sin(rotation); // Sine of the rotation
                        const cosineRotation = Math.cos(rotation); // Cosine of the rotation

                        // Loop through the dots array and draw every dot
                        for (var i = 0; i < dots.length; i++) {
                            dots[i].draw(sineRotation, cosineRotation);
                        }

                        window.requestAnimationFrame(render);
                    }


                    // Function called after the user resized its screen
                    function afterResize() {
                        width = canvas.offsetWidth;
                        height = canvas.offsetHeight;
                        if (window.devicePixelRatio > 1) {
                            canvas.width = canvas.clientWidth * 2;
                            canvas.height = canvas.clientHeight * 2;
                            ctx.scale(2, 2);
                        } else {
                            canvas.width = width;
                            canvas.height = height;
                        }
                        GLOBE_RADIUS = width * 0.5;
                        GLOBE_CENTER_Z = -GLOBE_RADIUS;
                        PROJECTION_CENTER_X = width / 2;
                        PROJECTION_CENTER_Y = height / 2;
                        FIELD_OF_VIEW = width * 0.8;

                        createDots(); // Reset all dots
                    }

                    // Variable used to store a timeout when user resized its screen
                    let resizeTimeout;
                    // Function called right after user resized its screen
                    function onResize() {
                        // Clear the timeout variable
                        resizeTimeout = window.clearTimeout(resizeTimeout);
                        // Store a new timeout to avoid calling afterResize for every resize event
                        resizeTimeout = window.setTimeout(afterResize, 500);
                    }
                    window.addEventListener('resize', onResize);

                    // Populate the dots array with random dots
                    createDots();

                    // Render the scene
                    window.requestAnimationFrame(render);





                    am5.ready(function() {

                        // Create root element
                        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                        var root = am5.Root.new("kt_amcharts_3");


                        // Set themes
                        // https://www.amcharts.com/docs/v5/concepts/themes/
                        root.setThemes([
                            am5themes_Animated.new(root)
                        ]);


                        // Create the map chart
                        // https://www.amcharts.com/docs/v5/charts/map-chart/
                        var chart = root.container.children.push(am5map.MapChart.new(root, {
                            panX: "rotateX",
                            panY: "rotateY",
                            projection: am5map.geoOrthographic(),
                            paddingBottom: 20,
                            paddingTop: 20,
                            paddingLeft: 20,
                            paddingRight: 20
                        }));


                        // Create main polygon series for countries
                        // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/
                        var polygonSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {
                            geoJSON: am5geodata_worldLow
                        }));

                        polygonSeries.mapPolygons.template.setAll({
                            tooltipText: "{name}",
                            toggleKey: "active",
                            interactive: true
                        });

                        polygonSeries.mapPolygons.template.states.create("hover", {
                            fill: root.interfaceColors.get("primaryButtonHover")
                        });


                        // Create series for background fill
                        // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/#Background_polygon
                        var backgroundSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {}));
                        backgroundSeries.mapPolygons.template.setAll({
                            fill: root.interfaceColors.get("alternativeBackground"),
                            fillOpacity: 0.1,
                            strokeOpacity: 0
                        });
                        backgroundSeries.data.push({
                            geometry: am5map.getGeoRectangle(90, 180, -90, -180)
                        });


                        // Create graticule series
                        // https://www.amcharts.com/docs/v5/charts/map-chart/graticule-series/
                        var graticuleSeries = chart.series.push(am5map.GraticuleSeries.new(root, {}));
                        graticuleSeries.mapLines.template.setAll({
                            strokeOpacity: 0.1,
                            stroke: root.interfaceColors.get("alternativeBackground")
                        })


                        // Rotate animation
                        chart.animate({
                            key: "rotationX",
                            from: 0,
                            to: 360,
                            duration: 30000,
                            loops: Infinity
                        });


                        // Make stuff animate on load
                        chart.appear(1000, 100);

                    }); // end am5.ready()
                </script> --}}
            @endsection
