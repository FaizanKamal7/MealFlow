@extends('fleetservice::layouts.master')
@section('title', 'Fleet Details')

@section("extra_style")
@endsection

@section('main_content')

<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">

        <h1 class="fs-lg-2x  pb-7 px-2">Fleet Details</h1>
        <div class="col-lg-12  py-10">
            <!--begin::Engage widget 8-->
            <div class="card h-md-100   " style="background-color: #D2DCF0">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row align-items-center h-100">
                        <!--begin::Col-->
                        <div class="col-7 ps-xl-13">
                            <!--begin::Title-->
                            <div class="d-flex gap-7 align-items-center">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-circle symbol-150px">
                                    <img src="{{asset('static/media/avatars/300-11.jpg')}}" alt="image" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Contact details-->
                                <div class="d-flex flex-column gap-2">
                                    <!--begin::Name-->
                                    <div class="fs-4 fw-bold me-2 d-block lh-1 pb-2 opacity-75 text-dark ">Occupied By
                                    </div>

                                    <!--end::Name-->
                                    <!--begin::Email-->
                                    <div class="d-flex align-items-center gap-2">
                                        <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <h3 class=" fw-bolder text-dark fs-2qx">Muhammad Ali</h3>
                                    </div>
                                    <!--end::Email-->
                                    <!--begin::Phone-->
                                    <div class="d-flex align-items-center gap-2">
                                        <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->
                                        <span class="svg-icon svg-icon-2 ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z"
                                                    fill="currentColor" />
                                                <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <a href="#"
                                            class="fs-4 fw-bold me-2 d-block lh-1 pb-2 opacity-75 text-dark">+6141 234
                                            567</a>
                                    </div>
                                    <!--end::Phone-->
                                </div>
                                <!--end::Contact details-->
                            </div>
                            <div class="row mt-15">
                                <div class="card-Fluid   rounded-pill " style="background-color:  #344767">
                                    <div class="px-10 py-5">
                                        <h3 class=" fw-bolder text-white fs-4">Milage : <span
                                                class="fs-1qx">  15km/lit</span>
                                        </h3>
                                        <div class="fs-4 fw-bold text-white ">Temperature:<span class="fs-1qx">
                                                7*C</span>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-lg-5 col-sm-5  flex-column ">

                            <div class=" h-300px d-flex flex-column	align-items-center gap-2  ">
                                <img src="{{asset('static/media/Fleet/image-6.png')}}"
                                    class="img-fluid" alt="" style="height:300px;" />
                            </div>

                            <div class="d-flex flex-column	align-items-center gap-2">


                                <div class="d-flex align-items-center gap-2">


                                    <h3 class="mb-0 text-dark fs-2qx">LOZ 4352</h3>
                                </div>
                                <!--end::Email-->
                                <!--begin::Phone-->
                                <div class="d-flex align-items-center gap-2">
                                    <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->

                                    <!--end::Svg Icon-->
                                    <a href="#"
                                        class="fs-3px fw-bold me-2 d-block lh-1 pb-2 opacity-75 text-dark">REGISTRATION
                                        NUMBER</a>
                                </div>
                                <!--end::Phone-->
                            </div>
                        </div>

                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Engage widget 8-->
        </div>

        <div class="row pt-10">

            <!--begin::Col-->
            <div class="">
                <div class="mb-20">
                    <h1 class="fs-lg-2x   px-2">Current Location</h1>
                </div>


                <div class="">

                    <div class=" card h-md-100 ">

                        <img src="{{asset('static/media/Fleet/map.jpeg')}}" class=""
                            alt="" />
                    </div>



                </div>
                <!--end::Tables Widget 9-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Row-->

        <!--end::Row-->


        <!--begin::Modals-->


        <!--end::Modals-->
    </div>
    <!--end::Container-->
</div>

<!--end::Post-->
@endsection

@section('extra_scripts')
/

@endsection
