@extends('layouts.admin_master')
@section('title', 'Maintenance Logs')

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
                        <!--begin::Header-->

                        <div class="card-header pt-5 mb-3">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-gray-800 fs-lg-2x">Vehicles Maintenance</span>

                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->


                            <div class="card-toolbar ">
                                <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                                    data-bs-target="#add_maintenance_model">Add Vehicle Maintenance</a>
                                <!--end::Daterangepicker-->
                            </div>

                        </div>
                        <!--end::Header-->
                        <div class="card-body">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="pb-3  text-center">Vehicle</th>
                                        <th class="text-end pe-3 min-w-80px">Employee</th>

                                        <th class="text-end pe-0 min-w-25px">Type</th>
                                        <th class="text-end pe-0 min-w-25px">details</th>
                                        <th class="text-end pe-3 min-w-100px">quantity</th>

                                        <th class="text-end pe-0 min-w-25px"> Meter Reading</th>
                                        <th class="text-end pe-0 min-w-25px">payment Status</th>
                                        <th class="text-end pe-0 min-w-25px">paid date</th>

                                        <th class="text-end pe-3 min-w-100px">Cost</th>
                                        <th class="text-end  min-w-80px">Garage</th>
                                        <th class="text-end  min-w-80px">notes</th>

                                        <th class="text-end pe-3 min-w-100px">Date</th>




                                    </tr>

                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bolder text-gray-600">
                                    @foreach ($vehiclesMaintenances as $maintenance)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-70px me-3 ">
                                                        <img src="{{ asset('static/media\Fleet\images-1.jpg') }}"
                                                            class="" alt="" />
                                                        <a href="#"
                                                            class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6">{{ $maintenance->vehicle->vehicleModel->make }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-end">{{ $maintenance->employee->first_name }}</td>
                                            <td class="text-end">{{ $maintenance->maintenanceCategory->name }}</td>

                                            <td class="text-end">{{ $maintenance->maintenance_detail }}</td>

                                            <td class="text-end">{{ $maintenance->quantity }}</td>

                                            <td class="text-end">{{ $maintenance->meter_reading }}</td>

                                            <td class="text-end">{{ $maintenance->payment_status }}</td>

                                            <td class="text-end">{{ $maintenance->paid_date }}</td>

                                            <td class="text-end pe-2">{{ $maintenance->cost }}</td>

                                            <td class="text-end">{{ $maintenance->garage }}</td>

                                            <td class="text-end pe-1">{{ $maintenance->notes }}</td>
                                            <td class="text-end pe-1">{{ $maintenance->maintenance_date }}</td>


                                            <!--end::Qty-->
                                        </tr>
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end: Card Body-->
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

    <div class="modal fade" id="add_maintenance_model" tabindex="-1" aria-hidden="true">
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
                    <h1 class="mb-3">Add Vehicle Maintenance</h1>
                    <!--end::Title-->

                </div>
                <!--end::Heading-->

                <!--begin::Modal body-->
                <div class="modal-body  pt-0 ">
                    <!--begin:Form-->
                    <form class="form" action="{{ route('store_fleet_maintenance') }}" method="post"
                        id="add_maintenance_form">
                        @csrf
                        <!--begin::Modal body-->
                        <div class="modal-body py-10 px-lg-13">
                            <!--begin::Scroll-->
                            <div class="scroll-y me-n7 pe-7" id="nixus_add_maintenance_log_scroll" data-kt-scroll="true"
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#nixus_add_maintenance_log_header"
                                data-kt-scroll-wrappers="#nixus_add_maintenance_log_scroll" data-kt-scroll-offset="300px">
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
                                            <select data-control="select2" data-placeholder=" Select Vehicle"
                                                class="form-select form-select-solid" data-control="select2"
                                                name="vehicle_id">
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
                                            <select data-placeholder="Select Employee"
                                                class="form-select form-select-solid" name="employee_id"
                                                data-control="select2">
                                                <option value="">Select Employee...</option>
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}">{{ $employee->first_name }}
                                                        ({{ $employee->designation->name }})</option>
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
                                                <span class="required">Maintenance type</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select name="maintenance_category_id" data-control="select2"
                                                data-placeholder="Select a Maintenance Type"
                                                class="form-select form-select-solid">
                                                <option value="">Select a maintenance Type...</option>
                                                @foreach ($maintenanceCategories as $maintenanceCategory)
                                                    <option value="{{ $maintenanceCategory->id }}">
                                                        {{ $maintenanceCategory->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('maintenance_category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <!--end::Select-->
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class=" fs-6 fw-bold mb-2">Maintenance Detail</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">
                                            <!--begin::Datepicker-->
                                            <input name="maintenance_detail" class="form-control form-control-solid "
                                                placeholder="Maintenance Detail" type="text" />
                                            <!--end::Datepicker-->
                                        </div>
                                        @error('maintenance_detail')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">Maintenance Cost</span>
                                        </label>
                                        <!--end::Label-->
                                        <input type="number" name="cost" class="form-control form-control-solid"
                                            placeholder="Enter Maintenance Cast" />
                                        @error('cost')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">Quantity</span>
                                        </label>
                                        <!--end::Label-->
                                        <input type="text" name="quantity" class="form-control form-control-solid"
                                            placeholder="Enter quantity" />
                                        @error('quantity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">Meter Reading</span>
                                        </label>
                                        <!--end::Label-->
                                        <input type="number" name="meter_reading"
                                            class="form-control form-control-solid" placeholder="Enter Meter Reading" />
                                        @error('meter_reading')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">Garage</span>
                                        </label>
                                        <!--end::Label-->
                                        <input type="text" name="garage" class="form-control form-control-solid"
                                            placeholder="Enter Garage" />
                                        @error('garage')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">Payment Status</span>
                                        </label>
                                        <!--end::Label-->
                                        <select name="payment_status" data-dropdown-parent="#nixus_add_maintenance_log"
                                            data-placeholder="Select a Maintenance Type"
                                            class="form-select form-select-solid">
                                            <option value="unpaid" selected>Unpaid</option>
                                            <option value="paid">Paid</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-bold mb-2">Maintenance Date</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">

                                            <!--begin::Datepicker-->
                                            <input name="maintenance_date" class="form-control form-control-solid "
                                                placeholder="Select a Maintenance" type="date" />
                                            <!--end::Datepicker-->
                                        </div>
                                        @error('maintenance_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row g-9 mb-8">
                                    <div class=" fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="">Notes</span>
                                        </label>
                                        <!--end::Label-->
                                        <textarea class="form-control form-control-solid" rows="3" name="notes" placeholder="Enter Notes"></textarea>
                                        @error('notes')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--end::Scroll-->
                        </div>
                        <!--end::Modal body-->
                        <!--begin::Modal footer-->
                        <div class="modal-footer flex-center">
                            <!--begin::Button-->
                            <button type="reset" id="nixus_add_maintenance_log_cancel" class="btn btn-light me-3">
                                Discard
                            </button>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="nixus_add_maintenance_log_submit" class="btn btn-primary">
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
                $('#add_maintenance_model').modal('show');
            });
        </script>
    @endif
@endsection
