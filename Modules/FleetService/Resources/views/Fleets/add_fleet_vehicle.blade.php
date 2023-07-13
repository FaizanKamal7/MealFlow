@extends('fleetservice::layouts.master')
@section('title', 'Add Fleet')

@section('extra_style')
@endsection

@section('main_content')

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">

            <!--begin::Form-->
            <form id="add_fleet_vehicle_form" name="add_fleet_vehicle_form" action="{{ route('fleet_vehicle_store') }}"
                enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row" method="post">
                @csrf
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                href="#nixus_general_details">Vehicles Details</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#nixus_insurance">Documentation</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#nixus_api">API</a>
                        </li>

                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="nixus_general_details" role="tab-panel">

                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>General</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">

                                        <div class="mb-10 row">
                                            <!--begin::Label-->
                                            <div class="col-lg-4 fv-row">
                                                <!--begin::Input-->

                                                <label class="required form-label">Reg Number</label>
                                                <input type="text" name="registration_number" class="form-control mb-2"
                                                    value="" />


                                                <!--end::Input-->

                                            </div>

                                            <div class="col-lg-4 fv-row">

                                                <!--begin::Input-->
                                                <label class="required form-label">Engine Number</label>
                                                <input type="text" name="engine_number" class="form-control mb-2"
                                                    value="" />
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-lg-4 fv-row">
                                                <!--begin::Input-->
                                                <label class="required form-label">Chassis Number</label>
                                                <input type="text" name="chassis_number" class="form-control mb-2"
                                                    value="" />
                                                <!--end::Input-->


                                            </div>
                                        </div>

                                        <div class="mb-10 row">
                                            <!--begin::Label-->
                                            <div class="col-lg-4 fv-row">
                                                <!--begin::Input-->

                                                <label class="required form-label">Make</label>
                                                <select class="form-select form-control form-control" name="vehicle_make"
                                                    id="vehicle_make" data-control="select2"
                                                    data-placeholder="Select an option">
                                                    <option value="" >Select Make</option>

                                                    @foreach ($vehicleMakes as $vehicleMake)
                                                        <option value="{{ $vehicleMake }}">{{ $vehicleMake }}</option>
                                                    @endforeach

                                                </select>
                                                <!--end::Input-->

                                            </div>

                                            <div class="col-lg-4 fv-row">

                                                <!--begin::Input-->
                                                <label class="required form-label">Model</label>
                                                <select class="form-select form-control form-control" name="vehicle_model"
                                                    id="vehicle_model" data-control="select2"
                                                    data-placeholder="Select an option">
                                                    <option value="">Select Model</option>

                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-lg-4 fv-row">
                                                <!--begin::Input-->

                                                <label class="required form-label">Year</label>
                                                <select class="form-select form-control form-control" name="vehicle_year"
                                                    id="vehicle_year" data-control="select2"
                                                    data-placeholder="Select an option">


                                                    <option value="3089ce8d-f476-11ed-8c5a-42b4abf843ed">2020</option>

                                                    <option value="37d1b992-f476-11ed-8c5a-42b4abf843ed">2021</option>

                                                    <option value="3cdfc3d0-f476-11ed-8c5a-42b4abf843ed">2022</option>
                                                </select>
                                                <!--end::Input-->

                                            </div>

                                        </div>
                                        <div class="mb-10 row">
                                            <!--begin::Label-->
                                            <div class="col-lg-4 fv-row mt-4">
                                                <!--begin::Input-->

                                                <label class=" form-label">Color</label>
                                                <input type="color" name="vehicle_color" class="form-control mb-2"
                                                    value="#563d7c" />


                                                <!--end::Input-->

                                            </div>


                                            <div class="col-lg-4 fv-row">
                                                <!--begin::Input-->
                                                <label class=" form-label">Status</label>
                                                <select class="form-select form-control form-control" name="vehicle_status"
                                                    id="vehicle_status" data-control="select2"
                                                    data-placeholder="Select an option">
                                                    <option value="Active">Active</option>
                                                    <option value="Booked">Booked</option>
                                                    <option value="In Maintenance">In Maintenance
                                                    </option>
                                                </select>
                                                <!--end::Input-->


                                            </div>
                                            <div class="col-lg-4 fv-row">
                                                <!--begin::Input-->

                                                <label class=" form-label">Type</label>
                                                <select class="form-select form-control form-control" name="vehicle_type"
                                                    id="vehicle_type" data-control="select2"
                                                    data-placeholder="Select an option">

                                                    @foreach ($vehicleTypes as $vehicleType)
                                                        <option value="{{ $vehicleType->id }}"> {{ $vehicleType->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                <!--end::Input-->

                                            </div>



                                        </div>
                                        <div class="mb-10 row">
                                            <!--begin::Label-->


                                            <div class="col-lg-4 fv-row">

                                                <!--begin::Input-->
                                                <label class=" form-label">Picture</label>
                                                <input type="File" name="vehicle_picture" class="form-control mb-2"
                                                    value="" />
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-lg-4 fv-row">
                                                <!--begin::Input-->
                                                <label class=" form-label">Milage</label>
                                                <input type="numbers" name="vehicle_mileage" class="form-control mb-2"
                                                    value="" />
                                                <!--end::Input-->


                                            </div>
                                        </div>


                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                                <!--begin::Media-->
                            </div>
                        </div>

                        <!--end::Tab pane-->
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade" id="nixus_insurance" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">

                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Registration</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->


                                        <div class="mb-10 row">
                                            <!--begin::Label-->
                                            <div class="col-lg-4 fv-row">
                                                <label class="required form-label mb-4">Registration Picture</label>
                                                <input type="file" name="registration_picture"
                                                    class="form-control mb-2" value="" />
                                            </div>

                                            <div class="col-lg-4 fv-row">
                                                <label class=" form-label mb-4">Reg Issue Date </label>
                                                <input type="Date" name="registration_issue_date"
                                                    class="form-control mb-2" value="" />

                                            </div>

                                            <div class="col-lg-4 fv-row">
                                                <label class=" form-label mb-4">Expiry Date </label>
                                                <input type="Date" name="registration_expiry_date"
                                                    class="form-control mb-2" value="" />

                                            </div>
                                        </div>

                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card header-->
                                </div>

                                <!--begin::Inventory-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Insurance</h2>

                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <div class="mb-10 row">
                                            <!--begin::Label-->
                                            <div class="col-lg-4 fv-row">
                                                <label class="required form-label mb-4">Insurance Picture</label>
                                                <input type="file" name="insurance_picture" class="form-control mb-2"
                                                    value="" />
                                            </div>

                                            <div class="col-lg-4 fv-row">
                                                <label class=" form-label mb-4">Insurance Issue Date </label>
                                                <input type="Date" name="insurance_issue_date"
                                                    class="form-control mb-2" value="" />

                                            </div>

                                            <div class="col-lg-4 fv-row">
                                                <label class=" form-label mb-4"> Insurance Expiry Date </label>
                                                <input type="Date" name="insurance_expiry_date"
                                                    class="form-control mb-2" value="" />

                                            </div>

                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                </div>

                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Municipality</h2>

                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <div class="mb-10 row">
                                            <!--begin::Label-->
                                            <div class="col-lg-4 fv-row">
                                                <label class="required form-label mb-4">Municipality Picture</label>
                                                <input type="file" name="municipality_picture"
                                                    class="form-control mb-2" value="" />
                                            </div>

                                            <div class="col-lg-4 fv-row">
                                                <label class=" form-label mb-4">Municipality Issue Date </label>
                                                <input type="Date" name="municipality_issue_date"
                                                    class="form-control mb-2" value="" />

                                            </div>

                                            <div class="col-lg-4 fv-row">
                                                <label class=" form-label mb-4"> Municipality Expiry Date </label>
                                                <input type="Date" name="municipality_expiry_date"
                                                    class="form-control mb-2" value="" />

                                            </div>

                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="nixus_api" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::Inventory-->

                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>API</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <div class="row mb-2" data-kt-buttons="true">
                                            <!--begin::Col-->
                                            <div class="mb-10 row">
                                                <div class="col-lg-8 fv-row">
                                                    <label class=" form-label required">Api Unit Id</label>
                                                    <input type="number" name="api_unit_id" class="form-control mb-2"
                                                        value="" />
                                                </div>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Tab content-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="#" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancel</a>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="re_add_fleet_vehicle_submit" class="btn btn-primary">
                            <span class="indicator-label">Save Changes</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                </div>

            </form>
            <!--end::Form-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection

@section('extra_scripts')
    <script src="{{ asset('static/js/custom/apps/fleet/add_vehicle.js') }}"></script>
@endsection
