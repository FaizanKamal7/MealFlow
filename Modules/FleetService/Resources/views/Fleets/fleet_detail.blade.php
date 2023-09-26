@extends('layouts.admin_master')
@section('title', ' Fleet Details')

@section("extra_style")

<link href="https://cdn.jsdelivr.net/npm/ni@1.1.0/dist/ni.min.css" rel="stylesheet">
<style>
    .icon.icon-shape {
        background-color: white;
        border-radius: 20%;
    }
</style>
@endsection

@section('main_content')

<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">

        <h1 class="fs-lg-2x  pb-3 px-2 pt-10">Fleet Details </h1>
        <div class="col-lg-12  py-10">
            <!--begin::Engage widget 8-->
            <div class="card " style="background-image: linear-gradient(310deg,#627594,#a8b8d8);">
                <!--begin::Body-->
                <div class="card-body px-5 z-index-1 bg-cover">
                    <!--begin::Row-->
                    <div class="row  ">
                        <!--begin::Col-->
                        <div class="col-lg-3 col-12 my-auto mx-auto">
                            <!--begin::Title-->
                            <div class="d-flex  align-items-center">
                                <!--begin::Avatar-->

                                <!--end::Avatar-->
                                <!--begin::Contact details-->
                                <div class="d-flex flex-column gap-1 ">


                                    <h3 class=" fw-bolder text-white  opacity-9 " style="font-size: 20px;">Since last
                                        Charge</h3>

                                    <hr class="horizontal light mt-1 mb-3 " style="color: white;">
                                    <!--end::Email-->

                                    <div class="d-flex gap-5">
                                        <div>
                                            <h6 class="mb-0 text-white opacity-7 mb-7" style="font-family: Open Sans;font-size: 16px;line-height: 26px;">Distance</h6>
                                            <h3 class="text-white " style="font-size: 30px;">145 <small class="text-sm align-top" style="font-size: 14px;">/km</small></h3>

                                        </div>
                                        <div class="ms-lg-6 ms-4">
                                            <h6 class="mb-0 text-white opacity-7 mb-7 " style="font-family: Open Sans;font-size: 16px;line-height: 26px; text-color: rgb(185, 74, 72) solid 1px;">Milage</h6>
                                            <h3 class="text-white " style="font-size: 30px;">{{$vehicle->mileage}} <small class="text-sm align-top" style="font-size: 14px;">Km/l</small></h3>
                                        </div>
                                    </div>
                                    <!--begin::Phone-->

                                    <!--end::Phone-->
                                </div>
                                <!--end::Contact details-->
                            </div>

                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-lg-5 col-sm-12 text-center">


                            <img class="w-100    d-md-block lifted-image" src="{{asset('static/media//vehicle/mercedes-eqc.png')}}" alt="car image">
                            <div class="d-flex align-items-center pt-8">
                                <h4 class="text-white opacity-7 ms-0 ms-md-auto">Available Fuel</h4>
                                <h2 class="text-white ms-2 me-auto">70<small class="text-sm align-top"> %</small></h2>
                            </div>
                        </div>

                        <div class="col-lg-3 col-12 my-auto ">
                            <h4 class="text-white opacity-9">Vehicle info</h4>
                            <hr class="horizontal light mt-1 mb-3" style="width: 150px; color:white ">
                            <div class="d-flex">
                                <div class=" ">
                                    <h6 class="mb-0 text-white">{{ucfirst($vehicle->vehicleModel->make)}} {{ucfirst($vehicle->vehicleModel->model)}}</h6>
                                    <h6 class="mb-0 text-white">{{ucfirst($vehicle->registration_number)}}</h6>
                                </div>
                                <div class="ms-lg-6 ms-4">
                                    <button class="btn btn-icon-only btn-rounded btn-outline-white mb-0">
                                        <i class="ni ni-map-big" aria-hidden="true"></i>
                                    </button>
                                </div>
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
        <div class="row mt-4">
            <div class="col-lg-3  my-3 col-md-6 col-12">
                <div class="card " style="background-image: linear-gradient(310deg,#627594,#a8b8d8);">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-white text-sm mb-0 text-capitalize font-weight-bold opacity-7">Today's Trip</p>
                                    <h5 class="text-white font-weight-bolder mb-0">
                                        145 Km
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-white shadow text-center border-radius-3 p-1">
                                    <i class="bi bi-calendar-check fs-2x" aria-hidden="true"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3  my-3  col-md-6 col-12">
                <div class="card " style="background-image: linear-gradient(310deg,#627594,#a8b8d8);">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-white text-sm mb-0 text-capitalize font-weight-bold opacity-7">Today's Trip</p>
                                    <h5 class="text-white font-weight-bolder mb-0">
                                        145 Km
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-white shadow text-center border-radius-md p-1">
                                    <i class="bi bi-calendar-check fs-2x" aria-hidden="true"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3  my-3  col-md-6 col-12">
                <div class="card " style="background-image: linear-gradient(310deg,#627594,#a8b8d8);">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-white text-sm mb-0 text-capitalize font-weight-bold opacity-7">Today's Trip</p>
                                    <h5 class="text-white font-weight-bolder mb-0">
                                        145 Km
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-white shadow text-center border-radius-md p-1">
                                    <i class="bi bi-calendar-check fs-2x" aria-hidden="true"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 my-3  col-md-6 col-12">
                <div class="card " style="background-image: linear-gradient(310deg,#627594,#a8b8d8);">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-white text-sm mb-0 text-capitalize font-weight-bold opacity-7">Today's Trip</p>
                                    <h5 class="text-white font-weight-bolder mb-0">
                                        145 Km
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape shadow text-center p-1">
                                    <i class="bi bi-calendar-check fs-2x" aria-hidden="true"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row pt-15">

            <!--begin::Col-->

            <div class="mb-20">
                <h1 class="fs-lg-2x px-2">Current Location</h1>
                <img src="{{asset($vehicle->qr_code)}}" class="" alt="qr code" />
                {{-- <p class="fs-lg-2x px-2">{{$vehicle->qr_code}} </p> --}}

            </div>



            <div class="col-lg-6 col-sm-12">
                <div class="flex-column flex-lg-row-auto  mb-10">
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Summary-->
                            <!--begin::User Info-->
                            {{-- <div class="d-flex flex-center flex-column py-5">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-100px symbol-circle mb-7">
                                    <img src="{{asset('static/media//avatars/300-11.jpg')}}" alt="image" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Name-->
                                <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">Emma Smith</a>
                                <!--end::Name-->
                                <!--begin::Position-->
                                <div class="mb-9">
                                    <!--begin::Badge-->
                                    <div class="badge badge-lg badge-light-primary d-inline">Administrator</div>
                                    <!--begin::Badge-->
                                </div>
                                <!--end::Position-->
                                <!--begin::Info-->


                                <!--end::Info-->
                            </div> --}}
                            <!--end::User Info-->
                            <!--end::Summary-->
                            <!--begin::Details toggle-->
                            <div class="d-flex flex-stack fs-4 py-3">
                                {{-- <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Details
                                    <span class="ms-2 rotate-180">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div> --}}
                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit customer details">
                                    <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_update_details">Edit</a>
                                </span>
                            </div>
                            <!--end::Details toggle-->
                            <div class="separator"></div>
                            <!--begin::Details content-->
                            <div id="kt_user_view_details" class="collapse show">
                                <div class="pb-5 fs-6">


                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-7">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-50px me-5">
                                            <img src="{{asset('static/media//avatars/300-11.jpg')}}" class="" alt="" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Text-->
                                        <div class="flex-grow-1">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ date('F j, Y', strtotime('$vehicle->registration_issue_date'))}}</a>
                                            <span class="text-muted d-block fw-bold">{{date('F j, Y', strtotime('$vehicle->registration_expiry_date'))}}</span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-7">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-50px me-5">
                                            <img src="{{asset('static/media//avatars/300-11.jpg')}}" class="" alt="" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Text-->
                                        <div class="flex-grow-1">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{date('F j, Y', strtotime('$vehicle->municipality_issue_date'))}}</a>
                                            <span class="text-muted d-block fw-bold">{{date('F j, Y', strtotime('$vehicle->municipality_expiry_date'))}}</span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-7">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-50px me-5">
                                            <img src="{{asset('static/media//avatars/300-11.jpg')}}" class="" alt="" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Text-->
                                        <div class="flex-grow-1">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{date('F j, Y', strtotime('$vehicle->insurance_issue_date'))}}</a>
                                            <span class="text-muted d-block fw-bold">{{date('F j, Y', strtotime('$vehicle->insurance_expiry_date'))}}</span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-50px me-5">
                                            <img src="{{asset('static/media//avatars/300-11.jpg')}}" class="" alt="" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Text-->
                                        <div class="flex-grow-1">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Dan Wilson</a>
                                            <span class="text-muted d-block fw-bold">PHP, SQLite, Artisan CLI</span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Item-->

                                </div>
                            </div>
                            <!--end::Details content-->
                        </div>
                        <!--end::Card body-->
                    </div>


                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class="flex-lg-row-fluid ms-lg-15">

                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade show active" id="" role="tabpanel">

                            <div class=" card h-100 ">

                                <img src="{{asset('static/media/Fleet/map.jpeg')}}" class="img-fluid h-100" alt="" />
                            </div>


                        </div>
                        <!--end:::Tab pane-->


                    </div>
                    <!--end:::Tab content-->
                </div>
            </div>

            <!--end::Tables Widget 9-->

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
<div class="modal fade" id="kt_modal_update_details" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="#" id="kt_modal_update_user_form">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_update_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Edit Fleet Details</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_user_header" data-kt-scroll-wrappers="#kt_modal_update_user_scroll" data-kt-scroll-offset="300px">
                        <!--begin::User toggle-->
                        <div class="fw-boldest fs-3 rotate collapsible mb-7" data-bs-toggle="collapse" href="#kt_modal_update_user_user_info" role="button" aria-expanded="false" aria-controls="kt_modal_update_user_user_info">General Details
                            <span class="ms-2 rotate-180">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::User toggle-->
                        <!--begin::User form-->
                        <div id="kt_modal_update_user_user_info" class="collapse show">
                            <!--begin::Input group-->
                            <div class="mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">
                                    <span>Update Fleet Image</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Allowed file types: png, jpg, jpeg."></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Image input wrapper-->
                                <div class="mt-1">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/300-6.jpg"></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Edit-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit-->
                                        <!--begin::Cancel-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                </div>
                                <!--end::Image input wrapper-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Reg Number</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="" name="Reg" value="Emma Smith" />
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Engine Number</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="" name="Engine" value="Emma Smith" />
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Chassis Number</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="" name="Chassis" value="Emma Smith" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Make</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="" name="Chassis" value="Emma Smith" />
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Model</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="" name="Chassis" value="Emma Smith" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->

                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-15">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Year</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="language" aria-label="Select a Language" data-control="select2" data-placeholder="Select a Year" class="form-select form-select-solid" data-dropdown-parent="#kt_modal_update_details">
                                    <option></option>
                                    <option value="id">2019</option>
                                    <option value="msa">2020</option>

                                </select>
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-15">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Status</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="language" aria-label="Select a Language" data-control="select2" data-placeholder="Select a Year" class="form-select form-select-solid" data-dropdown-parent="#kt_modal_update_details">
                                    <option></option>
                                    <option value="id">Active</option>
                                    <option value="msa">Pending</option>

                                </select>

                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Model</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="" name="Chassis" value="Emma Smith" />
                                <!--end::Input-->
                            </div>


                            <!--end::Input group-->
                        </div>
                        <!--end::User form-->
                        <!--begin::Address toggle-->
                        <div class="fw-boldest fs-3 rotate collapsible mb-7" data-bs-toggle="collapse" href="#kt_modal_update_user_address" role="button" aria-expanded="false" aria-controls="kt_modal_update_user_address">Registration Details
                            <span class="ms-2 rotate-180">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Address toggle-->
                        <!--begin::Address form-->
                        <div id="kt_modal_update_user_address" class="collapse show">
                            <!--begin::Input group-->
                            <div class="mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">
                                    <span>Update Registration Image</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Allowed file types: png, jpg, jpeg."></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Image input wrapper-->
                                <div class="mt-1">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/300-6.jpg)"></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Edit-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit-->
                                        <!--begin::Cancel-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                </div>
                                <!--end::Image input wrapper-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2"> issue Date</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="" name="reg_issue_date" type="date" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Expiry Date</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="" name="reg_exp_date" type="date" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->

                            <!--end::Input group-->
                        </div>
                        <!--end::Address form-->

                        <!--begin::Address toggle-->
                        <div class="fw-boldest fs-3 rotate collapsible mb-7" data-bs-toggle="collapse" href="#kt_modal_update_user_address" role="button" aria-expanded="false" aria-controls="kt_modal_update_user_address">insurance
                            <span class="ms-2 rotate-180">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Address toggle-->
                        <div id="kt_modal_update_user_address" class="collapse show">
                            <!--begin::Input group-->
                            <div class="mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">
                                    <span>Update Isurance Picture</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Allowed file types: png, jpg, jpeg."></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Image input wrapper-->
                                <div class="mt-1">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/300-6.jpg)"></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Edit-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit-->
                                        <!--begin::Cancel-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                </div>
                                <!--end::Image input wrapper-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2"> Insurance Date</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="" name="Insurance_date" type="date" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Insurance Expiry Date</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="" name="ins_exp_date" type="date" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">
                                    <span>Intervel</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="country" aria-label="Select a Country" data-control="select2" data-placeholder="Select a Intervel..." class="form-select form-select-solid" data-dropdown-parent="#kt_modal_update_details">
                                    <option value="">Select Intervel</option>
                                    <option value="AF">Intervel 1</option>
                                    <option value="AF">Intervel 1</option>
                                    <option value="AF">Intervel 1</option>
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>


                        <div class="fw-boldest fs-3 rotate collapsible mb-7" data-bs-toggle="collapse" href="#kt_modal_update_user_address" role="button" aria-expanded="false" aria-controls="kt_modal_update_user_address">Municipality
                            <span class="ms-2 rotate-180">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>

                        <div id="kt_modal_update_user_address" class="collapse show">
                            <!--begin::Input group-->
                            <div class="mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">
                                    <span>Municipality Picture</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Allowed file types: png, jpg, jpeg."></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Image input wrapper-->
                                <div class="mt-1">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/300-6.jpg)"></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Edit-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit-->
                                        <!--begin::Cancel-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                </div>
                                <!--end::Image input wrapper-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2"> Municipality Date</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="" name="Municipality_date" type="date" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Municipality Expiry Date</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="" name="Municipality_exp_date" type="date" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->

                            <!--end::Input group-->
                        </div>

                        <div class="fw-boldest fs-3 rotate collapsible mb-7" data-bs-toggle="collapse" href="#kt_modal_update_user_address" role="button" aria-expanded="false" aria-controls="kt_modal_update_user_address">Api
                            <span class="ms-2 rotate-180">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>

                        <div id="kt_modal_update_user_address" class="collapse show">


                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Api Unit Id</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="" name="api_unit_date" type="text" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->

                            <!--end::Input group-->
                        </div>





                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>


@endsection

@section('extra_scripts')
<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="{{ asset('static/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('static/js/custom/apps/user-management/users/view/view.js') }}"></script>
<script src="{{ asset('static/js/custom/apps/user-management/users/view/update-details.js') }}"></script>
<script src="{{ asset('static/js/custom/apps/user-management/users/view/add-schedule.js') }}"></script>
<script src="{{ asset('static/js/custom/apps/user-management/users/view/add-task.js') }}"></script>
<script src="{{ asset('static/js/custom/apps/user-management/users/view/update-email.js') }}"></script>
<script src="{{ asset('static/js/custom/apps/user-management/users/view/update-password.js') }}"></script>
<script src="{{ asset('static/js/custom/apps/user-management/users/view/update-role.js') }}"></script>




@endsection
