@extends('fleetservice::layouts.master')
@section('title', 'Bags | Add Bags')

@section("extra_style")
@endsection

@section('main_content')

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header mt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        {{-- <h3>Add Bags:</h3> --}}
                        <!--begin::Search-->
                        {{-- <div class="d-flex align-items-center position-relative my-1 me-5">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                          height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                          fill="currentColor"/>
                                                    <path
                                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                        fill="currentColor"/>
                                                </svg>
                                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-Make-table-filter="search"
                                   class="form-control form-control-solid w-250px ps-15"
                                   placeholder="Search Make"/>
                        </div> --}}
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    {{-- <div class="card-toolbar">
                        <!--begin::Button-->
                        <button type="button" class="btn btn-light-primary" data-bs-toggle="modal"
                                data-bs-target="#nixus_add_vehicle_make">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5"
                                                          fill="currentColor"/>
                                                    <rect x="10.8891" y="17.8033" width="12" height="2" rx="1"
                                                          transform="rotate(-90 10.8891 17.8033)" fill="currentColor"/>
                                                    <rect x="6.01041" y="10.9247" width="12" height="2" rx="1"
                                                          fill="currentColor"/>
                                                </svg>
                                            </span>
                            <!--end::Svg Icon-->Add Make
                        </button>
                        <!--end::Button-->
                    </div> --}}
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Form-->
                    <form action="{{route('store_new_bag',["partner_id"=>"232"])}}" method="post" id="add_new_bag_form">
                        @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-select" aria-label="Select example" id="partner_id" name="partner_id">
                                <option>Select Partner</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            @error('partner_id')
                            <span class="text-danger">{{$message}}</span>    
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <input type="number" id="no_of_bags" name="no_of_bags" class="form-control form-control-solid" placeholder="Enter no of bags"/>
                            @error('no_of_bags')
                            <span class="text-danger">{{$message}}</span>    
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-light-primary" id="add_bag_submit_btn">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5"
                                                          fill="currentColor"/>
                                                    <rect x="10.8891" y="17.8033" width="12" height="2" rx="1"
                                                          transform="rotate(-90 10.8891 17.8033)" fill="currentColor"/>
                                                    <rect x="6.01041" y="10.9247" width="12" height="2" rx="1"
                                                          fill="currentColor"/>
                                                </svg>
                                            </span>
                            <!--end::Svg Icon-->Add Bags
                        </button>
                        </div>
                    </div>
                </form>
                    <!--end::Form-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            <!--begin::Modals-->
            <!--begin::Modal - Add Make-->
            <div class="modal fade" id="nixus_add_vehicle_make" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder">Add Vehicle Make</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                 data-kt-Make-modal-action="close">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                                              rx="1" transform="rotate(-45 6 17.3137)"
                                                              fill="currentColor"/>
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
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <!--begin::Form-->
                            <form id="nixus_add_vehicle_make_form" class="form" action="#">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-5 mx-2">
                                        <span class="required"> Vehicle Make </span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                           data-bs-toggle="popover" data-bs-trigger="hover"
                                           data-bs-html="true"
                                           data-bs-content="Vehicle Make  is required to be unique."></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid"
                                           placeholder="Enter Vehicle Make" name="make"/>
                                    <!--end::Input-->


                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3"
                                            data-kt-Make-modal-action="cancel">Discard
                                    </button>
                                    <button type="submit" class="btn btn-primary"
                                            data-kt-Make-modal-action="submit">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - Add Make-->
            <!--begin::Modal - Update Make-->


            <div class="modal fade" id="nixus_update_vehicle_make" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder">Update Model</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                 data-kt-Make-modal-action="close">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                                              rx="1" transform="rotate(-45 6 17.3137)"
                                                              fill="currentColor"/>
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
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <!--begin::Notice-->

                            <!--end::Notice-->
                            <!--begin::Form-->
                            <form id="nixus_update_vehicle_make_form" class="form" action="#">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-5 mx-2">
                                        <span class="required">Vehicle Make</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                           data-bs-toggle="popover" data-bs-trigger="hover"
                                           data-bs-html="true"
                                           data-bs-content=" Vehicle Make  is required to be unique."></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid"
                                           placeholder="Make" name="permission_name"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3"
                                            data-kt-Make-modal-action="cancel">Discard
                                    </button>
                                    <button type="submit" class="btn btn-primary"
                                            data-kt-Make-modal-action="submit">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - Update Make-->
            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

@endsection

@section('extra_scripts')

<script src="{{asset("static/js/custom/apps/bag/add_bag.js")}}" ></script>

@endsection
