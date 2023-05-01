@extends('layouts.admin_master')
@section('title', ' Dashboard')

@section("extra_style")

@endsection

@section('main_content')

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-xl-6">
                    <h1 class="fs-lg-2x  pb-5">General Statistics</h1>

                    <!--begin::Row-->
                    <div class="row gy-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-sm-6 col-xl-6 mb-xl-5">
                            <!--begin::Card widget 2-->
                            <div class="card h-lg-100 " style=" border-radius: 3em">
                                <!--begin::Body-->
                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                    <!--begin::Icon-->
                                    <div class="m-0">
                                        <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                  d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z"
                                                  fill="currentColor"/>
                                            <path
                                                d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z"
                                                fill="currentColor"/>
                                        </svg>
                                    </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Section-->
                                    <div class="d-flex flex-column my-7">
                                        <div class="m-0">
                                            <span class="fw-bold fs-6 text-gray-400 ">Total Deliveries</span>
                                        </div>
                                        <!--begin::Number-->
                                        <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">1.5M</span>
                                        <!--end::Number-->
                                        <!--begin::Follower-->

                                        <!--end::Follower-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Badge-->
                                    <span class="badge badge-success fs-base">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                    <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1"
                                                  transform="rotate(90 13 6)" fill="currentColor"/>
                                            <path
                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                fill="currentColor"/>
                                        </svg>
                                    </span>
                                        <!--end::Svg Icon-->+ 55%
                                </span>
                                    <!--end::Badge-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card widget 2-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-sm-6 col-xl-6 mb-xl-5 mb-5">
                            <!--begin::Card widget 2-->
                            <div class="card h-lg-100" style=" border-radius: 3em">
                                <!--begin::Body-->
                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                    <!--begin::Icon-->
                                    <div class="m-0">
                                        <!--begin::Svg Icon | path: icons/duotune/graphs/gra001.svg-->
                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                  d="M14 3V21H10V3C10 2.4 10.4 2 11 2H13C13.6 2 14 2.4 14 3ZM7 14H5C4.4 14 4 14.4 4 15V21H8V15C8 14.4 7.6 14 7 14Z"
                                                  fill="currentColor"/>
                                            <path
                                                d="M21 20H20V8C20 7.4 19.6 7 19 7H17C16.4 7 16 7.4 16 8V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z"
                                                fill="currentColor"/>
                                        </svg>
                                    </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Section-->
                                    <div class="d-flex flex-column my-7">
                                        <!--begin::Follower-->
                                        <div class="m-0">
                                            <span class="fw-bold fs-6 text-gray-400">Total partners</span>
                                        </div>
                                        <!--end::Follower-->
                                        <!--begin::Number-->
                                        <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">75</span>
                                        <!--end::Number-->

                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Badge-->
                                    <span class="badge badge-success fs-base">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                    <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1"
                                                  transform="rotate(90 13 6)" fill="currentColor"/>
                                            <path
                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                fill="currentColor"/>
                                        </svg>
                                    </span>
                                        <!--end::Svg Icon-->+25%
                                </span>
                                    <!--end::Badge-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card widget 2-->
                        </div>
                        <!--end::Col-->

                    </div>
                    <!--end::Row-->

                    <!--begin::Row-->
                    <div class="row gy-5 g-xl-10">
                        <div class="col-sm-6 col-xl-6 mb-xl-5">
                            <!--begin::Card widget 2-->
                            <div class="card h-lg-100" style=" border-radius: 3em">
                                <!--begin::Body-->
                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                    <!--begin::Icon-->
                                    <div class="m-0">
                                        <!--begin::Svg Icon | path: icons/duotune/graphs/gra001.svg-->
                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                  d="M14 3V21H10V3C10 2.4 10.4 2 11 2H13C13.6 2 14 2.4 14 3ZM7 14H5C4.4 14 4 14.4 4 15V21H8V15C8 14.4 7.6 14 7 14Z"
                                                  fill="currentColor"/>
                                            <path
                                                d="M21 20H20V8C20 7.4 19.6 7 19 7H17C16.4 7 16 7.4 16 8V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z"
                                                fill="currentColor"/>
                                        </svg>
                                    </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Section-->
                                    <div class="d-flex flex-column my-7">
                                        <!--begin::Follower-->
                                        <div class="m-0">
                                            <span class="fw-bold fs-6 text-gray-400">Todays Customers</span>
                                        </div>
                                        <!--end::Follower-->
                                        <!--begin::Number-->
                                        <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">75</span>
                                        <!--end::Number-->

                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Badge-->
                                    <span class="badge badge-success fs-base">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                    <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1"
                                                  transform="rotate(90 13 6)" fill="currentColor"/>
                                            <path
                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                fill="currentColor"/>
                                        </svg>
                                    </span>
                                        <!--end::Svg Icon-->+5%
                                </span>
                                    <!--end::Badge-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card widget 2-->
                        </div>
                        <div class="col-sm-6 col-xl-6 mb-xl-5">
                            <!--begin::Card widget 2-->
                            <div class="card h-lg-100" style=" border-radius: 3em">
                                <!--begin::Body-->
                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                    <!--begin::Icon-->
                                    <div class="m-0">
                                        <!--begin::Svg Icon | path: icons/duotune/graphs/gra001.svg-->
                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                  d="M14 3V21H10V3C10 2.4 10.4 2 11 2H13C13.6 2 14 2.4 14 3ZM7 14H5C4.4 14 4 14.4 4 15V21H8V15C8 14.4 7.6 14 7 14Z"
                                                  fill="currentColor"/>
                                            <path
                                                d="M21 20H20V8C20 7.4 19.6 7 19 7H17C16.4 7 16 7.4 16 8V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z"
                                                fill="currentColor"/>
                                        </svg>
                                    </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Section-->
                                    <div class="d-flex flex-column my-7">
                                        <!--begin::Follower-->
                                        <div class="m-0">
                                            <span class="fw-bold fs-6 text-gray-400">Total Vehicles</span>
                                        </div>
                                        <!--end::Follower-->
                                        <!--begin::Number-->
                                        <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2 mt-3">65</span>
                                        <!--end::Number-->

                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Badge-->
                                    <span class="badge badge-danger fs-base">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                    <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1"
                                                  transform="rotate(90 13 6)" fill="currentColor"/>
                                            <path
                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                fill="currentColor"/>
                                        </svg>
                                    </span>
                                        <!--end::Svg Icon-->-5%
                                </span>
                                    <!--end::Badge-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card widget 2-->
                        </div>

                    </div>
                    <!--end::Row-->

                    <!--begin::Mixed Widget 4-->
                    <div class=" row card card-xl-stretch mb-xl-8 mb-10">
                        <!--begin::Beader-->
                        <div class="card-header border-1 pb-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Total Delivery Process</span>
                            </h3>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="  card-body d-flex flex-column">
                            <div class="row">

                                <div class="col-3 h-50">
                                    <div class="flex-grow-1">
                                        <div class="mixed-widget-4-chart" data-kt-chart-color="primary"
                                             style="height: 150px">
                                        </div>

                                    </div>


                                </div>
                                <div class="d-flex flex-column col-3 ">
                                    <div class="m-0">
                                        <span class="fw-bold  text-dark-300 ">(2AM-6AM)</span>
                                    </div>
                                    <!--begin::Number-->
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2">Total :1146</span>
                                    <span class="fw-bold   text-gray-500  pb-1">pending :11</span>
                                    <span class="fw-bold   text-gray-500  pb-1">Completed:116</span>
                                    <span class="fw-bold  text-gray-500  pb-1">Cancelled :16</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->

                                    <!--end::Follower-->
                                </div>

                                <div class="col-3 h-50 px-3">
                                    <div class="flex-grow-1">
                                        <div class="mixed-widget-4-chart" data-kt-chart-color="primary"
                                             style="height: 150px">
                                        </div>

                                    </div>


                                </div>
                                <div class="d-flex flex-column col-3 ">
                                    <div class="m-0">
                                        <span class="fw-bold  text-dark-300 ">(2AM-6AM)</span>
                                    </div>
                                    <!--begin::Number-->
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2">Total :1146</span>
                                    <span class="fw-bold   text-gray-500  pb-1">pending :11</span>
                                    <span class="fw-bold   text-gray-500  pb-1">Completed:116</span>
                                    <span class="fw-bold  text-gray-500  pb-1">Cancelled :16</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->

                                    <!--end::Follower-->
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-3 h-50">
                                    <div class="flex-grow-1">
                                        <div class="mixed-widget-4-chart" data-kt-chart-color="primary"
                                             style="height: 150px">
                                        </div>

                                    </div>


                                </div>
                                <div class="d-flex flex-column col-3 ">
                                    <div class="m-0">
                                        <span class="fw-bold  text-dark-300 ">(2AM-6AM)</span>
                                    </div>
                                    <!--begin::Number-->
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2">Total :1146</span>
                                    <span class="fw-bold   text-gray-500  pb-1">pending :11</span>
                                    <span class="fw-bold   text-gray-500  pb-1">Completed:116</span>
                                    <span class="fw-bold  text-gray-500  pb-1">Cancelled :16</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->

                                    <!--end::Follower-->
                                </div>

                                <div class="col-3 h-50 px-3">
                                    <div class="flex-grow-1">
                                        <div class="mixed-widget-4-chart" data-kt-chart-color="primary"
                                             style="height: 150px">
                                        </div>

                                    </div>


                                </div>
                                <div class="d-flex flex-column col-3 ">
                                    <div class="m-0">
                                        <span class="fw-bold  text-dark-300 ">(2AM-6AM)</span>
                                    </div>
                                    <!--begin::Number-->
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2">Total :1146</span>
                                    <span class="fw-bold   text-gray-500  pb-1">pending :11</span>
                                    <span class="fw-bold   text-gray-500  pb-1">Completed:116</span>
                                    <span class="fw-bold  text-gray-500  pb-1">Cancelled :16</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->

                                    <!--end::Follower-->
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-3 h-50">
                                    <div class="flex-grow-1">
                                        <div class="mixed-widget-4-chart" data-kt-chart-color="primary"
                                             style="height: 150px">
                                        </div>

                                    </div>


                                </div>
                                <div class="d-flex flex-column col-3 ">
                                    <div class="m-0">
                                        <span class="fw-bold  text-dark-300 ">(2AM-6AM)</span>
                                    </div>
                                    <!--begin::Number-->
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2">Total :1146</span>
                                    <span class="fw-bold   text-gray-500  pb-1">pending :11</span>
                                    <span class="fw-bold   text-gray-500  pb-1">Completed:116</span>
                                    <span class="fw-bold  text-gray-500  pb-1">Cancelled :16</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->

                                    <!--end::Follower-->
                                </div>

                                <div class="col-3 h-50 px-3">
                                    <div class="flex-grow-1">
                                        <div class="mixed-widget-4-chart" data-kt-chart-color="primary"
                                             style="height: 150px">
                                        </div>

                                    </div>


                                </div>
                                <div class="d-flex flex-column col-3 ">
                                    <div class="m-0">
                                        <span class="fw-bold  text-dark-300 ">(2AM-6AM)</span>
                                    </div>
                                    <!--begin::Number-->
                                    <span class="fw-bold   text-gray-500 pb-1 pt-2">Total :1146</span>
                                    <span class="fw-bold   text-gray-500  pb-1">pending :11</span>
                                    <span class="fw-bold   text-gray-500  pb-1">Completed:116</span>
                                    <span class="fw-bold  text-gray-500  pb-1">Cancelled :16</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->

                                    <!--end::Follower-->
                                </div>


                            </div>


                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Mixed Widget 4-->


                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-6">

                    <div class="row">
                        <div class="card  mt-20 mb-10 "
                             style="padding-right:0 ; padding-left: 0; background-color:#9A0E90 ; border-radius: 2em;">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between  flex-column ">

                                <!--end::Icon-->
                                <!--begin::Section-->
                                <div class="row">
                                    <div class="d-flex flex-column my-7 col-9">
                                        <div class="m-0">
                                        <span class="fw-bold fs-6 text-white ">hello there,Hope You Have Great Day
                                        </span>
                                        </div>
                                        <!--begin::Number-->
                                        <span class="fw-bold fs-3x text-white lh-1 ls-n2 mt-3">Dubai -29 C</span>
                                        <!--end::Number-->
                                        <!--begin::Follower-->

                                        <!--end::Follower-->
                                    </div>
                                    <!--end::Section-->

                                    <div class="col-3 my-3 ">

                                    <span class="svg-icon svg-icon-5hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="256"
                                             height="256" viewBox="0 0 256 256" xml:space="preserve">

                                            <defs>
                                            </defs>
                                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                                               transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                                <circle cx="34.717" cy="35.307" r="19.817"
                                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(232,224,119); fill-rule: nonzero; opacity: 1;"
                                                        transform="  matrix(1 0 0 1 0 0) "/>
                                                <path
                                                    d="M 42.869 37.202 c 0.799 -6.532 6.455 -11.579 13.087 -11.579 c 4.749 0 9.038 2.489 11.398 6.553 c 1.78 -1.822 4.203 -2.851 6.775 -2.851 c 4.815 0 8.875 3.661 9.416 8.406 C 87.423 39.216 90 42.937 90 47.112 c 0 5.543 -4.51 10.054 -10.054 10.054 H 44.536 c -5.543 0 -10.054 -4.51 -10.054 -10.054 C 34.482 42.18 38.054 38.004 42.869 37.202 z"
                                                    style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(183,189,244); fill-rule: nonzero; opacity: 1;"
                                                    transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                                <path
                                                    d="M 62.119 48.202 C 61.066 39.593 53.612 32.94 44.87 32.94 c -6.259 0 -11.912 3.28 -15.022 8.637 c -2.346 -2.402 -5.539 -3.758 -8.929 -3.758 c -6.347 0 -11.698 4.825 -12.411 11.079 C 3.397 50.857 0 55.76 0 61.263 c 0 7.306 5.944 13.251 13.251 13.251 h 46.672 c 7.306 0 13.251 -5.945 13.251 -13.251 C 73.173 54.763 68.466 49.259 62.119 48.202 z"
                                                    style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(131,141,229); fill-rule: nonzero; opacity: 1;"
                                                    transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                            </g>
                                        </svg>
                                    </span>
                                        <!--end::Svg Icon-->
                                        <span class="fw-bold fs-2x text-white lh-1 ls-n2 mt-3">Cloudy</span>


                                    </div>


                                </div>


                                <!--begin::Badge-->

                                <!--end::Badge-->
                            </div>
                            <!--end::Body-->
                        </div>

                    </div>
                    <!--begin::Mixed Widget 7-->

                    <!--end::Mixed Widget 7-->
                    <div id="kt_amcharts_3" style="height: 600px;"></div>

                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->

            <!--end::Row-->
            <!--begin::Row-->
            <div class="row ">
                <!--begin::Col-->
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Chart widget 4-->
                    <div class="card card-flush overflow-hidden h-md-100">
                        <!--begin::Header-->
                        <div class="card-header py-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-dark">Key Performance Indicator</span>

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
                <div class="col-xl-6">
                    <!--begin::Card widget 4-->
                    <div class="card card-flush h-100 mb-5 mb-xl-10">
                        <div class="card-header py-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-dark">Partner's Comparison Dilervery Wise</span>

                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->

                        </div>
                        <!--begin::Card body-->
                        <div class="card-body pt-2 pb-4 d-flex align-items-center">
                            <!--begin::Chart-->

                            <div id="kt_chart_widgets_22_chart_1" class="mx-auto mb-4"></div>

                            <!--end::Chart-->
                            <!--begin::Labels-->
                            <div class="d-flex flex-column content-justify-center w-100">
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4 fs-3 my-1">Super Meals</div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-boldest text-gray-700 text-xxl-end">25%(250)</div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4 fs-3 my-1">Super Meals</div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-boldest text-gray-700 text-xxl-end">25%(250)</div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4 fs-3 my-1">Super Meals</div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-boldest text-gray-700 text-xxl-end">25%(250)</div>
                                    <!--end::Stats-->
                                </div>
                                <div class="d-flex fs-6 fw-bold align-items-center">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4 fs-3 my-1">Super Meals</div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-boldest text-gray-700 text-xxl-end">25%(250)</div>
                                    <!--end::Stats-->
                                </div>

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

            <div class="row ">
                <!--begin::Col-->
                <!--begin::Col-->
                <div class="col-xl-6">
                    <div class="row">
                        <div class="col-xl-12">
                            <!--begin::Statistics Widget 5-->
                            <a href="#" class="card bg-info hoverable card-xl-stretch   my-10 mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->
                                    <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <path opacity="0.3"
                                              d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z"
                                              fill="currentColor"/>
                                        <path
                                            d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z"
                                            fill="currentColor"/>
                                    </svg>
                                </span>
                                    <!--end::Svg Icon-->
                                    <div class="fw-bold text-white">Earning</div>
                                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">$50,000</div>

                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>


                        <div>


                            <div class="row">

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


                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-xl-6">

                            </div>
                            <!--end::Col-->

                        </div>

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
                                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                                          transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                          transform="rotate(45 7.41422 6)" fill="currentColor"/>
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
                                                       placeholder=""
                                                       name="calendar_event_name"/>
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
                                                       placeholder=""
                                                       name="calendar_event_description"/>
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
                                                       placeholder=""
                                                       name="calendar_event_location"/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-9">
                                                <!--begin::Checkbox-->
                                                <label class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                           id="kt_calendar_datepicker_allday"/>
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
                                                               id="kt_calendar_datepicker_start_date"/>
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
                                                               id="kt_calendar_datepicker_start_time"/>
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
                                                               name="calendar_event_end_date"
                                                               placeholder="Pick a end date"
                                                               id="kt_calendar_datepicker_end_date"/>
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
                                                               name="calendar_event_end_time"
                                                               placeholder="Pick a end time"
                                                               id="kt_calendar_datepicker_end_time"/>
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
                                                      fill="currentColor"/>
                                                <path
                                                    d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                    fill="currentColor"/>
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
                                                    fill="currentColor"/>
                                                <path opacity="0.5"
                                                      d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                      fill="currentColor"/>
                                                <path opacity="0.5"
                                                      d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                      fill="currentColor"/>
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
                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                                      transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                      transform="rotate(45 7.41422 6)" fill="currentColor"/>
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
                                                      fill="currentColor"/>
                                                <path
                                                    d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                    fill="currentColor"/>
                                                <path
                                                    d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                    fill="currentColor"/>
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
                                                <circle fill="currentColor" cx="12" cy="12" r="8"/>
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
                                                <circle fill="currentColor" cx="12" cy="12" r="8"/>
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
                                                      fill="currentColor"/>
                                                <path
                                                    d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                    fill="currentColor"/>
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

                <div class="col-xl-6 mb-10">

                    <!--begin::Card widget 4-->
                    <div class="card card-flush h-100 mb-5  my-10 mb-xl-10">
                        <div class="card-header border border-1 py-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-dark">Complaints OverView</span>

                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->

                        </div>
                        <!--begin::Body-->
                        <div class="card-body d-flex justify-content-between flex-column p-0 py-5">
                            <!--begin::Items-->
                            <div class="mb-5 px-9">
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-3 mt-2">
                                        <!--begin::Icon-->
                                        <img src="{{ asset("static/media/svg/brand-logos/dribbble-icon-1.svg") }}" class="me-3 w-30px"
                                             alt=""/>
                                        <!--end::Icon-->
                                        <!--begin::Section-->
                                        <div class="flex-grow-1">
                                            <a href="#"
                                               class="text-gray-800 text-hover-primary fs-5 fw-bolder  mt-2">Dillevery
                                                on
                                                Wrong Adress (Driver Error)</a>

                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-center w-100 mw-125px">
                                        <!--begin::Progress-->
                                        <div class="progress h-6px w-100 me-2 bg-light-success">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 65%"
                                                 aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <!--end::Progress-->
                                        <!--begin::Value-->
                                        <span class="text-gray-400 fw-bold">65%</span>
                                        <!--end::Value-->
                                    </div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-4"></div>

                                <!--end::Separator-->

                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-3 mt-2">
                                        <!--begin::Icon-->
                                        <img src="{{ asset("static/media/svg/brand-logos/dribbble-icon-1.svg") }}" class="me-3 w-30px"
                                             alt=""/>
                                        <!--end::Icon-->
                                        <!--begin::Section-->
                                        <div class="flex-grow-1">
                                            <a href="#"
                                               class="text-gray-800 text-hover-primary fs-5 fw-bolder  mt-2">Employee
                                                Complaints</a>

                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-center w-100 mw-125px">
                                        <!--begin::Progress-->
                                        <div class="progress h-6px w-100 me-2 bg-light-success">
                                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 65%"
                                                 aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <!--end::Progress-->
                                        <!--begin::Value-->
                                        <span class="text-gray-400 fw-bold">65%</span>
                                        <!--end::Value-->
                                    </div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Item-->

                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-4"></div>
                                <!--end::Separator-->

                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-3 mt-2">
                                        <!--begin::Icon-->
                                        <img src="{{ asset("static/media/svg/brand-logos/dribbble-icon-1.svg") }}" class="me-3 w-30px"
                                             alt=""/>
                                        <!--end::Icon-->
                                        <!--begin::Section-->
                                        <div class="flex-grow-1">
                                            <a href="#"
                                               class="text-gray-800 text-hover-primary fs-5 fw-bolder  mt-2">Negative
                                                Reviews</a>

                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-center w-100 mw-125px">
                                        <!--begin::Progress-->
                                        <div class="progress h-6px w-100 me-2 bg-light-success">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 65%"
                                                 aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <!--end::Progress-->
                                        <!--begin::Value-->
                                        <span class="text-gray-400 fw-bold">30%</span>
                                        <!--end::Value-->
                                    </div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Separator-->


                            </div>
                            <!--end::Items-->

                        </div>
                        <!--end::Body-->

                        <div class="Card-footer">

                            <div class="d-flex flex-column my-7 mx-8">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="m-0">

                                            <span class="fw-bold fs-2x text-gray-800 lh-1 ls-n2 my-3">865 Complaints</span>

                                        </div>
                                        <!--begin::Number-->
                                        <span class="fw-bold fs-6 text-gray-400 ">Total numbers of complain in last 30 Days</span>
                                    </div>

                                    <div class="col-4">
                                        <a class="btn btn-dark text-white">all Complaints</a>
                                    </div>
                                </div>

                            </div>


                        </div>

                        <div>
                        </div>
                        <!--end::Card widget 4-->


                    </div>

                </div>
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

                    <script>
                        am5.ready(function () {

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
                    </script>
@endsection
