@extends('layouts.admin_master')
@section('title', ' Bag Timeline')

@section('extra_style')
@endsection
@section('main_content')

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::container2-->
            <div class="container_not_padding">
                <!--begin::Row-->

                <div class="d-flex align-items-center justify-content-between bags_upperdiv">
                    <div class="activate-service">
                        <h1 class="fs-lg-2x">Bag History</h1>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                        <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left"
                            class="btn btn-sm btn-light d-flex align-items-center px-4">
                            <!--begin::Display range-->
                            <div class="text-gray-600 fw-bolder">Loading date range...</div>
                            <!--end::Display range-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                            <span class="svg-icon svg-icon-2"
                                style="color: rgba(0, 83, 138, 1)!important; margin-left: 10px;">
                                <x-iconsax-bul-calendar />
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Daterangepicker-->
                    </div>
                </div>

                <div class="customer_div d-flex mt-5 bags_second_div">
                    <div class="customer_details business-heading">
                        <h1>Customer Details</h1>
                        <div class="qr_div d-flex align-items-center mt-8 mb-6">
                            <div class="symbol symbol-100px symbol-lg-100px symbol-fixed position-relative">
                                <img src="{{ asset($bag->qr_code) }}" alt="image" />
                                <div
                                    class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px">
                                </div>
                            </div>
                            <div class="second_div_customer">
                                <div class="business_name_div">
                                    <h3 class="fw-bolder fs-6">{{ $bag->business->name }}</h3>
                                </div>
                                <div class="d-flex  align-items-center contact_div gap-2">
                                    <h5 class="not_black_h5">Contact:</h5>
                                    <h5 class="black_h5">+97 13040885424</h5>
                                </div>
                                <div class="d-flex  align-items-center contact_div flex-wrap gap-2">
                                    <h5 class="not_black_h5">Address:</h5>
                                    <h5 class="black_h5">Southend Arterial Road (A127),WickFord,SS213 ,Uk</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="vehicle_details business-heading">
                        <h1>Vehicle Details</h1>
                        <div class="vehicle_div d-flex mt-8 mb-6">
                            <div class="symbol symbol-100px symbol-lg-100px symbol-fixed position-relative">
                                <img src="{{ asset('static/media\Fleet\images-2.jpg') }}" class="" alt="" />
                            </div>
                            <div class="second_div_customer">
                                <div class="d-flex align-items-center contact_div gap-2">
                                    <h5>Vehicle # </h5>
                                    <h5><a href="{{ route('update_bag_status', ['bag_id' => $bag->id]) }}"
                                            class="fs-1x fw-bold">AJHE7890</a></h5>
                                </div>
                                <div class="d-flex  align-items-center contact_div gap-2">
                                    <h5 class="not_black_h5">Driver:</h5>
                                    <h5 class="black_h5">Usman Rafique</h5>
                                </div>
                                <div class="d-flex  align-items-center contact_div gap-2">
                                    <h5 class="not_black_h5">Driver Contact:</h5>
                                    <h5 class="black_h5">+9713040885424</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="delivery_info mt-5">
                    <div class="card-header wallet-card-header heading_info">
                        <!--begin::Title-->
                        <h3 class="card-title wallet-title fw-bolder">Delivery Info</h3>
                        <!--end::Title-->
                    </div>
                    <div class="order_detail_div">
                        <div class="order_id d-flex">
                            <h5 class="opacity-75">1. Order ID</h5>
                            <h5 class="fw-bolder ms-8">12382hwd</h5>
                        </div>
                        <div class="detail_div">
                            <!--begin::Timeline-->
                            <div class="timeline-label">
                                <!--begin::Item-->
                                <div class="timeline-item mb-15 mt-5">
                                    <!--begin::Badge-->
                                    <div class="timeline-badge ms-13">
                                        <i class="fa fa-circle text-success fs-1"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Content-->
                                    <div class="timeline_content ms-8 d-flex px-10 justify-content-between w-400px">
                                        <div class="fw-bolder me-10">Picked by driver</div>
                                        <div class="fw-bolder text-gray-600 fs-6">12:00 am, 12-09-2023</div>
                                    </div>

                                    <!--end::Content-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="timeline-item mb-15 mt-5">
                                    <!--begin::Badge-->
                                    <div class="timeline-badge ms-13">
                                        <i class="fa fa-circle text-danger fs-1"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Content-->
                                    <div class="timeline_content ms-8 d-flex px-10 justify-content-between w-400px">
                                        <span class="fw-bolder me-10">Delivered(at customer)</span>
                                        <div class="fw-bolder text-gray-600 fs-6">1:00 pm, 13-09-2023</div>
                                    </div>

                                    <!--end::Content-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="timeline-item mb-15 mt-5">
                                    <!--begin::Badge-->
                                    <div class="timeline-badge ms-13">
                                        <i class="fa fa-circle text-primary fs-1"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Content-->
                                    <div class="timeline_content ms-8 d-flex px-10 justify-content-between w-400px">
                                        <span class="fw-bolder me-10">Out for Delivery</span>
                                        <div class="fw-bolder text-gray-600 fs-6">3:00 pm, 15-09-2023</div>
                                    </div>

                                    <!--end::Content-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="timeline-item mb-15 mt-5">
                                    <!--begin::Badge-->
                                    <div class="timeline-badge ms-13">
                                        <i class="fa fa-circle text-danger fs-1"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Content-->
                                    <div class="timeline_content ms-8 d-flex px-10 justify-content-between w-400px">
                                        <span class="fw-bolder me-10">At the warehouse</span>
                                        <div class="fw-bolder text-gray-600 fs-6">3:00 pm, 15-09-2023</div>
                                    </div>

                                    <!--end::Content-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="timeline-item mb-15 mt-5">
                                    <!--begin::Badge-->
                                    <div class="timeline-badge ms-13">
                                        <i class="fa fa-circle text-info fs-1"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Content-->
                                    <div class="timeline_content ms-8 d-flex px-10 justify-content-between w-400px">
                                        <span class="fw-bolder me-10">Picked For Delivery</span>
                                        <div class="fw-bolder text-gray-600 fs-6">3:00 pm, 15-09-2023</div>
                                    </div>

                                    <!--end::Content-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="timeline-item mb-15 mt-5">
                                    <!--begin::Badge-->
                                    <div class="timeline-badge ms-13">
                                        <i class="fa fa-circle text-success fs-1"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Content-->
                                    <div class="timeline_content ms-8 d-flex px-10 justify-content-between w-400px">
                                        <span class="fw-bolder me-10">Vacant</span>
                                        <div class="fw-bolder text-gray-600 fs-6">4:00 pm, 16-09-2023</div>
                                    </div>

                                    <!--end::Content-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--begin::Details toggle-->
                            <div class="d-flex flex-stack fs-4 pb-3">
                                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse"
                                    href="#kt_customer_view_details" role="button" aria-expanded="true"
                                    aria-controls="kt_customer_view_details">View More
                                    <span class="ms-2 rotate-180">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>

                            </div>
                            <!--end::Details toggle-->
                             <!--begin::Details content-->
                             <div id="kt_customer_view_details" class="mt-5 collapse hide">
                                <div class="order_id d-flex mb-10">
                                    <h5 class="opacity-75">2. Order ID</h5>
                                    <h5 class="fw-bolder ms-8">22392hwd</h5>
                                </div>
                                <div class="timeline-label">
                                    <!--begin::Item-->
                                    <div class="timeline-item mb-15 mt-5">
                                        <!--begin::Badge-->
                                        <div class="timeline-badge ms-13">
                                            <i class="fa fa-circle text-success fs-1"></i>
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Content-->
                                        <div class="timeline_content ms-8 d-flex px-10 justify-content-between w-400px">
                                            <div class="fw-bolder me-10">Picked by driver</div>
                                            <div class="fw-bolder text-gray-600 fs-6">12:00 am, 12-09-2023</div>
                                        </div>
    
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="timeline-item mb-15 mt-5">
                                        <!--begin::Badge-->
                                        <div class="timeline-badge ms-13">
                                            <i class="fa fa-circle text-danger fs-1"></i>
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Content-->
                                        <div class="timeline_content ms-8 d-flex px-10 justify-content-between w-400px">
                                            <span class="fw-bolder me-10">Delivered(at customer)</span>
                                            <div class="fw-bolder text-gray-600 fs-6">1:00 pm, 13-09-2023</div>
                                        </div>
    
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="timeline-item mb-15 mt-5">
                                        <!--begin::Badge-->
                                        <div class="timeline-badge ms-13">
                                            <i class="fa fa-circle text-primary fs-1"></i>
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Content-->
                                        <div class="timeline_content ms-8 d-flex px-10 justify-content-between w-400px">
                                            <span class="fw-bolder me-10">Out for Delivery</span>
                                            <div class="fw-bolder text-gray-600 fs-6">3:00 pm, 15-09-2023</div>
                                        </div>
    
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="timeline-item mb-15 mt-5">
                                        <!--begin::Badge-->
                                        <div class="timeline-badge ms-13">
                                            <i class="fa fa-circle text-danger fs-1"></i>
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Content-->
                                        <div class="timeline_content ms-8 d-flex px-10 justify-content-between w-400px">
                                            <span class="fw-bolder me-10">At the warehouse</span>
                                            <div class="fw-bolder text-gray-600 fs-6">3:00 pm, 15-09-2023</div>
                                        </div>
    
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="timeline-item mb-15 mt-5">
                                        <!--begin::Badge-->
                                        <div class="timeline-badge ms-13">
                                            <i class="fa fa-circle text-info fs-1"></i>
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Content-->
                                        <div class="timeline_content ms-8 d-flex px-10 justify-content-between w-400px">
                                            <span class="fw-bolder me-10">Picked For Delivery</span>
                                            <div class="fw-bolder text-gray-600 fs-6">3:00 pm, 15-09-2023</div>
                                        </div>
    
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="timeline-item mb-15 mt-5">
                                        <!--begin::Badge-->
                                        <div class="timeline-badge ms-13">
                                            <i class="fa fa-circle text-success fs-1"></i>
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Content-->
                                        <div class="timeline_content ms-8 d-flex px-10 justify-content-between w-400px">
                                            <span class="fw-bolder me-10">Vacant</span>
                                            <div class="fw-bolder text-gray-600 fs-6">4:00 pm, 16-09-2023</div>
                                        </div>
    
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Item-->
                                </div>

                            </div>
                            <!--end::Details content-->
                        </div>
                    </div>
                </div>


                {{-- <div class="row gy-5 g-xl-8">
                    <!--begin::Col-->
                    <div class="col-xl-8">
                        <!--begin::Tables Widget 9-->
                        <!--begin::List widget 10-->
                        <div class="card card-flush ">
                            <!--begin::Header-->
                            <div class="card-header pt-7">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder text-gray-800">Bag History</span>
                                </h3>
                                <!--end::Title-->
                                <!--begin::Toolbar-->
                                <div class="card-toolbar">
                                    <div class="">
                                        <input class="form-control form-control-solid" placeholder="Pick date rage"
                                            id="kt_daterangepicker_1" />
                                    </div>
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Nav-->

                                <!--end::Nav-->
                                <!--begin::Tab Content-->
                                <div class="">
                                    <!--begin::Tap pane-->
                                    <div class="" id="kt_list_widget_10_tab_1">
                                        <!--begin::Item-->
                                        <div class="m-0">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex align-items-sm-center pb-15">
                                                <!--begin::Symbol-->
                                                <div class="me-7 mb-4">
                                                    <div
                                                        class="symbol symbol-100px symbol-lg-100px symbol-fixed position-relative">
                                                        <img src="{{ asset($bag->qr_code) }}" alt="image" />
                                                        <div
                                                            class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                                    <div class="flex-grow-1 ">
                                                        <span
                                                            class="text-gray-800 fw-bolder d-block fs-6">{{ $bag->business->name }}</span>
                                                        <a href="#"
                                                            class="text-gray-400 fs-1x fw-bold">#AJHE7890</a>
                                                        <span href="#"
                                                            class="text-gray-400 fs-1x d-block fw-bold">Southend
                                                            Artriel Road (A127),</span>
                                                        <span href="#"
                                                            class="text-gray-400 fs-1x d-block fw-bold">WickFord,SS213
                                                            ,Uk</span>

                                                    </div>

                                                </div>
                                                <div
                                                    class="symbol symbol-100px symbol-lg-150px symbol-fixed position-relative">
                                                    <img src="{{ asset('static/media\Fleet\images-2.jpg') }}"
                                                        class="" alt="" />
                                                </div>
                                                <div class="me-2 mb-4 ps-10">
                                                    <div class="flex-grow-1 ">
                                                        <span class="text-gray-800 fw-bolder d-block fs-6">Vehicle
                                                            number</span>
                                                        <a href="{{ route('update_bag_status', ['bag_id' => $bag->id]) }}"
                                                            class="text-gray-400 fs-1x fw-bold">#AJHE7890</a>
                                                        <span href="#"
                                                            class="text-gray-400 fs-1x d-block fw-bold">Usman
                                                            Rafique,</span>
                                                        <span href="#"
                                                            class="text-gray-400 fs-1x d-block fw-bold">+9713040885424</span>

                                                    </div>
                                                </div>
                                                <!--end::Section-->
                                            </div>
                                            <div class=" d-flex justify-content-center mb-7 ">
                                                <div class=" me-2">

                                                </div>
                                            </div>

                                            <!--end::Wrapper-->
                                            <!--begin::Timeline-->
                                            <div class="timeline-label">
                                                <!--begin::Item-->
                                                <div class="timeline-item mb-15 mt-5">
                                                    <!--begin::Label-->
                                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">10:00</div>
                                                    <!--end::Label-->
                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge">
                                                        <i class="fa fa-genderless text-success fs-1"></i>
                                                    </div>
                                                    <!--end::Badge-->
                                                    <!--begin::Content-->
                                                    <div class="timeline-content d-flex">
                                                        <span class="fw-bolder text-gray-800 ps-3">Picked by driver</span>
                                                        <div class="fw-mormal timeline-content text-muted ps-3"></div>
                                                        <div class="badge badge-lg badge-light-success fw-bolder"
                                                            data-bs-toggle="tooltip" data-bs-html="true"
                                                            data-bs-placement="top" data-bs-custom-class="tooltip-dark"
                                                            title="Delivery ID : AGZ5161<br>Customer : Natasha<br>Driver : Ali Ahmed <br>Vehicle :1817CC">
                                                            Details</div>
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="timeline-item mb-15">
                                                    <!--begin::Label-->
                                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">14:37</div>
                                                    <!--end::Label-->
                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge">
                                                        <i class="fa fa-genderless text-primary fs-1"></i>
                                                    </div>
                                                    <!--end::Badge-->
                                                    <!--begin::Desc-->
                                                    <div class="timeline-content fw-bolder text-gray-800 ps-3">Delivered(at
                                                        customer)</div>

                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="timeline-item mb-15 mt-5">
                                                    <!--begin::Label-->
                                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">10:00</div>
                                                    <!--end::Label-->
                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge">
                                                        <i class="fa fa-genderless text-warning fs-1"></i>
                                                    </div>
                                                    <!--end::Badge-->
                                                    <!--begin::Content-->
                                                    <div class="timeline-content d-flex">
                                                        <span class="fw-bolder text-gray-800 ps-3">Out for Delivery</span>
                                                        <div class="fw-mormal timeline-content text-muted ps-3"></div>
                                                        <div class="badge badge-lg badge-light-success fw-bolder"
                                                            data-bs-toggle="tooltip" data-bs-html="true"
                                                            data-bs-placement="top" data-bs-custom-class="tooltip-dark"
                                                            title="Delivery ID : AGZ5161<br>Customer : JAKSHSA67<br>Driver : Ali Ahmed <br>Vehicle :1817CC">
                                                            Details</div>

                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="timeline-item mb-15">
                                                    <!--begin::Label-->
                                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">14:37</div>
                                                    <!--end::Label-->
                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge">
                                                        <i class="fa fa-genderless text-danger fs-1"></i>
                                                    </div>
                                                    <!--end::Badge-->
                                                    <!--begin::Desc-->
                                                    <div class="timeline-content fw-bolder text-gray-800 ps-3">At the
                                                        warehouse</div>

                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="timeline-item mb-15 mt-5">
                                                    <!--begin::Label-->
                                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">10:00</div>
                                                    <!--end::Label-->
                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge">
                                                        <i class="fa fa-genderless text-success fs-1"></i>
                                                    </div>
                                                    <!--end::Badge-->
                                                    <!--begin::Content-->
                                                    <div class="timeline-content d-flex">
                                                        <span class="fw-bolder text-gray-800 ps-3">Picked For
                                                            Delivery</span>
                                                        <div class="fw-mormal timeline-content text-muted ps-3"></div>
                                                        <div class="badge badge-lg badge-light-success fw-bolder"
                                                            data-bs-toggle="tooltip" data-bs-html="true"
                                                            data-bs-placement="top" data-bs-custom-class="tooltip-dark"
                                                            title="Delivery ID : AGZ5161<br>Customer : JAKSHSA67<br>Driver : Ali Ahmed <br>Vehicle :1817CC">
                                                            Details</div>

                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="timeline-item mb-15">
                                                    <!--begin::Label-->
                                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">14:37</div>
                                                    <!--end::Label-->
                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge">
                                                        <i class="fa fa-genderless text-primary fs-1"></i>
                                                    </div>
                                                    <!--end::Badge-->
                                                    <!--begin::Desc-->
                                                    <div class="timeline-content fw-bolder text-gray-800 ps-3">vacant</div>

                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Item-->

                                            </div>
                                            <!--begin::Details toggle-->
                                            <div class="d-flex flex-stack fs-4 pb-3">
                                                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse"
                                                    href="#kt_customer_view_details" role="button" aria-expanded="true"
                                                    aria-controls="kt_customer_view_details">View More
                                                    <span class="ms-2 rotate-180">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none">
                                                                <path
                                                                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </div>

                                            </div>
                                            <!--end::Details toggle-->
                                            <div class="separator separator-dashed my-3"></div>
                                            <!--begin::Details content-->
                                            <div id="kt_customer_view_details" class="collapse hide">
                                                <div class="timeline-label">
                                                    <!--begin::Item-->
                                                    <div class="timeline-item mb-15 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="timeline-label fw-bolder text-gray-800 fs-6">10:00
                                                        </div>
                                                        <!--end::Label-->
                                                        <!--begin::Badge-->
                                                        <div class="timeline-badge">
                                                            <i class="fa fa-genderless text-success fs-1"></i>
                                                        </div>
                                                        <!--end::Badge-->
                                                        <!--begin::Content-->
                                                        <div class="timeline-content d-flex">
                                                            <span class="fw-bolder text-gray-800 ps-3">Picked by
                                                                driver</span>
                                                            <div class="fw-mormal timeline-content text-muted ps-3"></div>
                                                            <div class="badge badge-lg badge-light-success fw-bolder"
                                                                data-bs-toggle="tooltip" data-bs-html="true"
                                                                data-bs-placement="top"
                                                                data-bs-custom-class="tooltip-dark"
                                                                title="Delivery ID : AGZ5161<br>Customer : Natasha<br>Driver : Ali Ahmed <br>Vehicle :1817CC">
                                                                Details</div>
                                                        </div>
                                                        <!--end::Content-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="timeline-item mb-15">
                                                        <!--begin::Label-->
                                                        <div class="timeline-label fw-bolder text-gray-800 fs-6">14:37
                                                        </div>
                                                        <!--end::Label-->
                                                        <!--begin::Badge-->
                                                        <div class="timeline-badge">
                                                            <i class="fa fa-genderless text-primary fs-1"></i>
                                                        </div>
                                                        <!--end::Badge-->
                                                        <!--begin::Desc-->
                                                        <div class="timeline-content fw-bolder text-gray-800 ps-3">
                                                            Delivered(at customer)</div>

                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="timeline-item mb-15 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="timeline-label fw-bolder text-gray-800 fs-6">10:00
                                                        </div>
                                                        <!--end::Label-->
                                                        <!--begin::Badge-->
                                                        <div class="timeline-badge">
                                                            <i class="fa fa-genderless text-warning fs-1"></i>
                                                        </div>
                                                        <!--end::Badge-->
                                                        <!--begin::Content-->
                                                        <div class="timeline-content d-flex">
                                                            <span class="fw-bolder text-gray-800 ps-3">Out for
                                                                Delivery</span>
                                                            <div class="fw-mormal timeline-content text-muted ps-3"></div>
                                                            <div class="badge badge-lg badge-light-success fw-bolder"
                                                                data-bs-toggle="tooltip" data-bs-html="true"
                                                                data-bs-placement="top"
                                                                data-bs-custom-class="tooltip-dark"
                                                                title="Delivery ID : AGZ5161<br>Customer : JAKSHSA67<br>Driver : Ali Ahmed <br>Vehicle :1817CC">
                                                                Details</div>

                                                        </div>
                                                        <!--end::Content-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="timeline-item mb-15">
                                                        <!--begin::Label-->
                                                        <div class="timeline-label fw-bolder text-gray-800 fs-6">14:37
                                                        </div>
                                                        <!--end::Label-->
                                                        <!--begin::Badge-->
                                                        <div class="timeline-badge">
                                                            <i class="fa fa-genderless text-danger fs-1"></i>
                                                        </div>
                                                        <!--end::Badge-->
                                                        <!--begin::Desc-->
                                                        <div class="timeline-content fw-bolder text-gray-800 ps-3">At the
                                                            warehouse</div>

                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="timeline-item mb-15 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="timeline-label fw-bolder text-gray-800 fs-6">10:00
                                                        </div>
                                                        <!--end::Label-->
                                                        <!--begin::Badge-->
                                                        <div class="timeline-badge">
                                                            <i class="fa fa-genderless text-success fs-1"></i>
                                                        </div>
                                                        <!--end::Badge-->
                                                        <!--begin::Content-->
                                                        <div class="timeline-content d-flex">
                                                            <span class="fw-bolder text-gray-800 ps-3">Picked For
                                                                Delivery</span>
                                                            <div class="fw-mormal timeline-content text-muted ps-3"></div>
                                                            <div class="badge badge-lg badge-light-success fw-bolder"
                                                                data-bs-toggle="tooltip" data-bs-html="true"
                                                                data-bs-placement="top"
                                                                data-bs-custom-class="tooltip-dark"
                                                                title="Delivery ID : AGZ5161<br>Customer : JAKSHSA67<br>Driver : Ali Ahmed <br>Vehicle :1817CC">
                                                                Details</div>

                                                        </div>
                                                        <!--end::Content-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="timeline-item mb-15">
                                                        <!--begin::Label-->
                                                        <div class="timeline-label fw-bolder text-gray-800 fs-6">14:37
                                                        </div>
                                                        <!--end::Label-->
                                                        <!--begin::Badge-->
                                                        <div class="timeline-badge">
                                                            <i class="fa fa-genderless text-primary fs-1"></i>
                                                        </div>
                                                        <!--end::Badge-->
                                                        <!--begin::Desc-->
                                                        <div class="timeline-content fw-bolder text-gray-800 ps-3">vacant
                                                        </div>

                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Item-->

                                                </div>

                                            </div>
                                            <!--end::Details content-->
                                        </div>
                                        <!--end::Item-->

                                    </div>
                                    <!--end::Tap pane-->

                                </div>
                                <!--end::Tab Content-->
                            </div>
                            <!--end: Card Body-->
                        </div>
                    </div>
                    <!--end::Col-->
                </div> --}}


            </div>
            <!--end::2Container-->
        </div>
        <!--end::Container-->
    </div>



    <!--end::Post-->
@endsection

@section('extra_scripts')
    <script src="{{ asset('static/js/custom/apps/ecommerce/sales/listing.js') }}"></script>

    <script>
        $("#kt_daterangepicker_1").daterangepicker();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>


@endsection
