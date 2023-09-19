@extends('layouts.admin_master')
@section('title', 'Drivers')

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
                            <span class="card-label fw-bolder text-gray-800 fs-lg-2x">Drivers</span>

                        </h3>
                        <!--end::Title-->
                        <!--begin::Toolbar-->



                        <div class="card-toolbar ">

                            <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                                data-bs-target="#nixus_add_new_driver">Add Driver</a>

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
                                    <th class="min-w-100px text-center">Driver </th>
                                    <th class="text-center min-w-150px ">license No</th>
                                    <th class="text-center min-w-150px">license Document</th>
                                    <th class="text-center min-w-150px ">license Expiry date</th>
                                    <th class="text-end min-w-100px">Vehicle</th>
                                    <th class="text-center min-w-100px">Status</th>
                                    <th class="text-center min-w-100px">Action</th>


                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bolder text-gray-600">

                                @foreach ($drivers as $driver)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-3 ">
                                                <img src="{{ asset('static/media/avatars/300-1.jpg') }}" class=""
                                                    alt="" />


                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="{{ route('fleet_view_driver_detail', ['driver_id' => $driver->id]) }}"
                                                    class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6">{{
                                                    $driver->employee->first_name }}
                                                    {{ $driver->employee->last_name }}</a>
                                                <span class="text-gray-400 fw-bold d-block fs-7">{{
                                                    $driver->employee->personal_email_address }}</span>
                                            </div>
                                        </div>
                                    </td>


                                    <!--begin::Product ID-->
                                    <td class="text-center">{{ $driver->license_number }}</td>
                                    <!--end::Product ID-->
                                    <!--begin::Date added-->
                                    <td class="text-center">
                                        {{ $driver->license_Document ? $driver->license_Document : 'Not Available' }}
                                    </td>
                                    <td class="text-center">{{ $driver->license_expiry_date }}</td>
                                    <!--begin::Price-->
                                    <td class="text-end"> @if ($driver->lastIncompleteTimeline) {{
                                        $driver->lastIncompleteTimeline->vehicle->registration_number }}@else NA @endif
                                    </td>
                                    <!--end::Price-->
                                    <!--begin::Status-->
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-primary">Available</span>
                                    </td>
                                    <!--end::Status-->
                                    <!--begin::Action=-->
                                    <td class="text-center">
                                        <!--begin::Delete-->
                                        <button class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                            type="button"
                                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this record?')) document.getElementById('delete-form').submit();"
                                            data-kt-permissions-table-filter="delete_row">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                            <span class="svg-icon svg-icon-3">
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
                                        </button>
                                        <form method="POST" id="delete-form"
                                            action="{{ route('delete_driver', ['driver_id' => $driver]) }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <!--end::Delete-->
                                    </td>
                                    <!--end::Action=-->
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


<div class="modal fade" id="nixus_add_new_driver" tabindex="-1" aria-hidden="true">
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="currentColor" />
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
                <h1 class="mb-3">Add Driver</h1>
                <!--end::Title-->

            </div>
            <!--end::Heading-->

            <!--begin::Modal body-->
            <div class="modal-body  pt-0 ">
                <!--begin:Form-->
                <form class="form" action="{{ route('fleet_store_driver') }}" id="nixus_add_new_driver_form"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Modal header-->

                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-13">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7" id="nixus_add_new_driver_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#nixus_add_new_driver_header"
                            data-kt-scroll-wrappers="#nixus_add_new_driver_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Notice-->
                            <!--begin::Notice-->

                            <!--end::Notice-->
                            <!--end::Notice-->
                            <!--begin::Input group-->
                            <div class="row g-9 mb-5">
                                <!--begin::Col-->
                                <div class="col-md-12 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Employee</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Select-->
                                        <div class="border rounded">
                                            <select id="employee" class="form-select form-select-solid" name="Employee1"
                                                data-placeholder="Select Employee">
                                                <option></option>
                                                @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    data-kt-rich-content-subcontent="{{ $employee->personal_email_address }}"
                                                    data-kt-rich-content-icon="{{ asset('static/media/avatars/300-6.jpg') }}">
                                                    {{ $employee->first_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <!--end::Select-->
                                    </div>
                                    @error('Employee1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row g-9 mb-10">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">license Number</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Enter license Number" name="license_number"
                                        value="{{ old('license_number') }}" />
                                    @error('license_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">license Document</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="file" class="form-control form-control-solid"
                                        placeholder="Enter license Document" name="license_Document"
                                        value="{{ old('license_Document') }}" />
                                    @error('license_Document')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row g-9 mb-10">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-bold mb-2">license Issue Date</label>
                                    <!--begin::Input-->
                                    <div class="position-relative d-flex align-items-center">
                                        <!--begin::Datepicker-->
                                        <input class="form-control form-control-solid ps-12" placeholder="Select a date"
                                            name="license_issue_Date" type="date"
                                            value="{{ old('license_issue_Date') }}" />

                                        <!--end::Datepicker-->
                                    </div>
                                    @error('license_issue_Date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <!--end::Input-->
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-bold mb-2">license Expiry Date</label>
                                    <!--begin::Input-->
                                    <div class="position-relative d-flex align-items-center">

                                        <!--begin::Datepicker-->
                                        <input class="form-control form-control-solid ps-12" placeholder="Select a date"
                                            name="license_expiry_Date" type="date"
                                            value="{{ old('license_expiry_Date') }}" />

                                        <!--end::Datepicker-->
                                    </div>
                                    @error('license_expiry_Date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <!--end::Input-->
                                </div>
                            </div>
                            <div class="d-flex flex-stack mb-8">
                                <!--begin::Label-->
                                <div class="me-5">
                                    <span>
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input mx-4" type="checkbox" value="1"
                                                name="is_available" checked="checked" @if (old('is_available')) selected
                                                @endif /><span class="fs-6 fw-bold">Is
                                                Available</span>
                                        </label>
                                    </span>
                                </div>
                                @error('is_available')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <!--end::Label-->
                                <!--begin::Switch-->
                                <!--end::Switch-->
                            </div>
                            <div class="col-md-12 fv-row">
                                <label for="" class="form-label">Driver Areas</label>
                                <select class="form-select form-select-lg form-select-solid" data-control="select2"
                                    data-placeholder="Select an option" data-allow-clear="true" multiple="multiple"
                                    id="driver_areas[]" name="driver_areas[]">
                                    <option></option>
                                    @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }} -
                                        {{-- {{ $area->city->name }} --}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('driver_areas')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="nixus_add_new_driver_cancel"
                            class="btn btn-light me-3">Discard</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="nixus_add_new_driver_submit" class="btn btn-primary">
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
<script src="{{ asset('static/js/custom/apps/fleet/add_driver.js') }}"></script>
@if ($errors->any())
<script>
    $(document).ready(function() {
                // Show the modal when there are validation errors
                $('#nixus_add_new_driver').modal('show');

            });
</script>
@endif
@endsection