@extends('layouts.admin_master')
@section('title', 'Fuel Logs')

@section('extra_style')
@endsection

@section('main_content')


    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->

            <!--begin::Row-->
            <div class="row gy-5 g-xl-8">

                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::Tables Widget 9-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Card header-->
                        <div class="card-header pt-5 mb-3">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-gray-800 fs-lg-2x">Fuel Logs</span>

                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar ">
                                <div class="position-relative my-1  me-7">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-2 position-absolute top-50 translate-middle-y ms-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                fill="currentColor" />
                                            <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <input type="text" data-kt-table-widget-4="search"
                                        class="form-control w-150px fs-7 ps-12" placeholder="Search" />
                                </div>
                                <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                                    data-bs-target="#nixus_add_fuel_model">Add vehicle Fuel</a>
                                <!--end::Daterangepicker-->

                            </div>

                        </div>

                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-2">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_4_table">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px text-center">Vehicle </th>
                                        <th class="text-end min-w-100px">Driver</th>
                                        <th class="text-end min-w-125px">Fuel Type</th>
                                        <th class="text-end min-w-100px">Fuel Qty</th>
                                        <th class="text-end min-w-100px">Fuel Date</th>
                                        <th class="text-end min-w-100px">Fuel Cost</th>
                                        <th class="text-end min-w-100px">Supplier</th>





                                        <th class="text-end">Notes</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bolder text-gray-600">
                                  


                                    @foreach($fuelList as $fuel)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-70px me-3 ">
                                                    <img src="{{ asset('static/media\Fleet\images-1.jpg') }}" class=""
                                                        alt="" />
                                                    <a href="#"
                                                        class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6">{{$fuel->vehicle->registration_number}} {{$fuel->vehicle->vehicleModel->make}}</a>


                                                </div>
                                            </div>
                                        </td>


                                        <!--begin::Product ID-->
                                        <td class="text-end">{{$fuel->employee->first_name}}</td>
                                        <!--end::Product ID-->
                                        <!--begin::Date added-->
                                        <td class="text-end">{{$fuel->fuel_type}}</td>
                                        <!--end::Date added-->
                                        <td class="text-end" data-order="58">
                                            <span class="text-dark fw-bolder">{{$fuel->fuel_quantity}} LIT</span>
                                        </td>
                                        <!--begin::Price-->
                                        <td class="text-end">{{$fuel->fuel_date}}</td>
                                        <!--end::Price-->
                                        <!--begin::Status-->
                                        <td class="text-end">
                                            {{$fuel->fuel_cost}}
                                        </td>
                                        <!--end::Status-->
                                        <!--begin::Qty-->
                                        <td class="text-end">{{$fuel->supplier}}</td>
                                        <td class="text-end">{{$fuel->notes}}</td>

                                        <!--end::Qty-->
                                    </tr>
                                    @endforeach
 
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Tables Widget 9-->
                </div>
                <!--end::Col-->
            </div>

        </div>
        <!--end::Container-->
    </div>


    <div class="modal fade" id="nixus_add_fuel_model" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-750px ">
            <!--begin::Modal content-->
            <div class="modal-content rounded  ">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Heading-->
                <div class="my-5 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Add Vehicle Fuel</h1>
                    <!--end::Title-->

                </div>
                <!--end::Heading-->

                <!--begin::Modal body-->
                <div class="modal-body  pt-0 ">
                    <!--begin:Form-->
                    <form class="form" action="{{ route('store_fleet_fuel')}}" method="POST" id="nixus_add_fuel_form">
                        @csrf
                        <!--begin::Modal body-->
                        <div class="modal-body py-10 px-lg-13">
                            <!--begin::Scroll-->
                            <div class="scroll-y me-n7 pe-7" id="nixus_add_fuel_log_scroll" data-kt-scroll="true"
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#nixus_add_fuel_log_header"
                                data-kt-scroll-wrappers="#nixus_add_fuel_log_scroll" data-kt-scroll-offset="300px">
                                <!--begin::Notice-->
                                <!--begin::Notice-->

                                <!--end::Notice-->
                                <!--end::Notice-->
                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <div class="d-flex flex-column mb-5 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Vehicle</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                    data-bs-toggle="tooltip"></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select name="vehicle_id" data-control="select2"
                                                data-placeholder=" Select Vehicle" class="form-select form-select-solid"
                                                data-control="select2" data-dropdown-parent="#nixus_add_fuel_log">
                                                <option value="">Select a Vehicle...</option>
                                                @foreach ($vehicles as $vehicle)
                                                    <option value="{{ $vehicle->id }}">
                                                        {{-- {{ $vehicle->vehicleModel->make }}
                                                        {{ $vehicle->vehicleModel->model }} --}}
                                                        {{ $vehicle->registration_number }} </option>
                                                @endforeach
                                            </select>
                                            @error('vehicle_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <!--end::Select-->
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <div class="d-flex flex-column mb-5 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Employee</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select name="employee_id" data-placeholder="Select Driver"
                                                class="form-select form-select-solid" data-control="select2"
                                                data-dropdown-parent="#nixus_add_fuel_log">
                                                <option value="">Select Employee...</option>
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}">{{ $employee->first_name }}
                                                        ({{ $employee->designation->name }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('employee_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <!--end::Select-->
                                        </div>
                                    </div>

                                    <!--end::Col-->
                                </div>

                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <div class="d-flex flex-column mb-5 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Fuel type</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select name="fuel_type" data-control="select2"
                                                data-dropdown-parent="#nixus_add_fuel_log"
                                                data-placeholder="Select a Fuel Type"
                                                class="form-select form-select-solid">
                                                <option value="">Select a Fuel Type...</option>
                                                <option value="petrol" selected>Petrol</option>
                                                <option value="gas">Gas </option>
                                                <option value="electric">Electric</option>
                                                <option value="diesel">Diesel</option>

                                            </select>
                                            @error('fuel_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                            <!--end::Select-->
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">Fuel Quantity</span>
                                        </label>
                                        <!--end::Label-->
                                        <input type="number" name="fuel_quantity"
                                            class="form-control form-control-solid" placeholder="Enter Fuel Quantity" />
                                            @error('fuel_quantity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">Fuel Cost</span>
                                        </label>
                                        <!--end::Label-->
                                        <input type="number" class="form-control form-control-solid"
                                            placeholder="Enter Fuel Cast" name="fuel_cost" />
                                            @error('fuel_cost')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-bold mb-2">Fuel Date</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">

                                            <!--begin::Datepicker-->
                                            <input class="form-control form-control-solid "
                                                placeholder="Select a date" name="fuel_date" type="date" />
                                                
                                            <!--end::Datepicker-->
                                        </div>
                                        @error('fuel_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        <!--end::Input-->
                                    </div>

                                </div>
                                <!--end::Input group-->


                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <div class="d-flex flex-column mb-5 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Payment Type</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select name="payment_method" data-control="select2"
                                                data-placeholder="Select a Fuel Type"
                                                class="form-select form-select-solid">
                                                <option value="">Select a Payment Type...</option>
                                                <option value="topup" selected>Topup</option>
                                                <option value="cash">Cash </option>

                                            </select>
                                            @error('payment_method')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                            <!--end::Select-->
                                        </div>
                                    </div>
                                    <!--end::Col-->


                                    <div class="col-md-6 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">Supplier</span>
                                        </label>
                                        <!--end::Label-->
                                        <select name="supplier" data-control="select2"
                                        data-placeholder="Select a Fuel Type"
                                        class="form-select form-select-solid">
                                        <option value="">Select a Payment Type...</option>
                                        <option value="enoc">ENOC</option>
                                        <option value="adnoc">ADNOC</option>

                                    </select>
                                    @error('supplier')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                        <!--end::Input-->
                                    </div>

                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-8">
                                    <label class="fs-6 fw-bold mb-2">Notes</label>
                                    <textarea class="form-control form-control-solid" rows="3" name="notes" placeholder="Enter Notes"></textarea>
                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--end::Scroll-->
                        </div>
                        <!--end::Modal body-->
                        <!--begin::Modal footer-->
                        <div class="modal-footer flex-center">
                            <!--begin::Button-->
                            <button type="reset" id="nixus_add_fuel_log_cancel"
                                class="btn btn-light me-3">Discard</button>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="nixus_add_fuel_log_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                        <!--end::Modal footer-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
        </div>
    </div>

    <!--end::Post-->
@endsection

@section('extra_scripts')
@if ($errors->any())
<script>
    $(document).ready(function() {
        // Show the modal when there are validation errors
        $('#nixus_add_fuel_model').modal('show');
    });
</script>
@endif

@endsection
