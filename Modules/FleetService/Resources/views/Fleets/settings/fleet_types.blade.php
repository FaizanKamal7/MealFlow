@extends('layouts.admin_master')
@section('title', 'Settings | Fleet Types')

@section('extra_style')
@endsection

@section('main_content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header mt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1 me-5">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-permissions-table-filter="search"
                                class="form-control form-control-solid w-250px ps-15" placeholder="Search type" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <button type="button" class="btn btn-light-primary" data-bs-toggle="modal"
                            data-bs-target="#nixus_add_vehicle_type">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                        rx="5" fill="currentColor" />
                                    <rect x="10.8891" y="17.8033" width="12" height="2" rx="1"
                                        transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                                    <rect x="6.01041" y="10.9247" width="12" height="2" rx="1"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->Add type
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="nixus_type_table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Vehicle type</th>
                                <th class="min-w-125px">Capacity</th>
                                <th class="min-w-125px">Icon</th>
                                <th class="min-w-125px">Status</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                            @foreach ($types as $type)
                                <tr>
                                    <!--begin::Name=-->
                                    <td class="name-cell">{{ $type->name }}</td>
                                    <!--end::Name=-->
                                    <!--begin::Name=-->
                                    <td class="capacity-cell">{{ $type->capacity }}</td>
                                    <td class="icon-cell"><i class="far {{ $type->icon }} fs-5x p-0"></i><span
                                            class="d-none">{{ $type->icon }}</span></td>
                                    <td class="status-cell">{{ $type->active_status }}</td>

                                    <!--end::Name=-->
                                    <!--begin::Action=-->
                                    <td class="text-end">
                                        <!--begin::Update-->
                                        <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
                                            data-bs-toggle="modal" data-bs-target="#nixus_update_vehicle_type"
                                            data-type-id="{{ $type->id }}" onclick="editVehicleType(this)">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z"
                                                        fill="currentColor" />
                                                    <path opacity="0.3"
                                                        d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--end::Update-->
                                        <!--begin::Delete-->

                                        <button class="btn btn-icon btn-active-light-primary w-30px h-30px" type="submit"
                                            onclick="event.preventDefault(); document.getElementById('delete-form').submit();"
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
                                        <form id="delete-form"
                                            action="{{ route('delete_vehicle_type', ['type_id' => $type->id]) }}"
                                            method="POST" enctype="multipart/form-data"
                                            onsubmit="return confirm('Are you sure you want to Delete Type ?');">
                                            @csrf
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
            <!--end::Card-->
            <!--begin::Modals-->
            <!--begin::Modal - Add types-->
            <div class="modal fade" id="nixus_add_vehicle_type" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder">Add Vehicle type</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-types-modal-action="close">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16"
                                            height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                            fill="currentColor" />
                                        <rect x="7.41422" y="6" width="16" height="2"
                                            rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
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
                            <form id="nixus_add_vehicle_type_form" class="form"
                                action="{{ route('add_vehicle_types') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-5 mx-2">
                                        <span class="required"> Vehicle type </span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                            data-bs-trigger="hover" data-bs-html="true"
                                            data-bs-content="Vehicle type  is required to be unique."></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" type="text"
                                        placeholder="Enter Vehicle type" name="vehicle_type"
                                        value="{{ old('vehicle_type') }}" />
                                    <!--end::Input-->
                                    @error('vehicle_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-5 mx-2">
                                        <span class="required"> Capacity </span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                            data-bs-trigger="hover" data-bs-html="true"
                                            data-bs-content="Vehicle capicity  is required to be unique."></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" type="text"
                                        placeholder="Enter Vehicle capacity" name="vehicle_capacity" />
                                    <!--end::Input-->
                                    @error('vehicle_capacity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-5 mx-2">
                                        <span class="required"> Icon </span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                            data-bs-trigger="hover" data-bs-html="true"
                                            data-bs-content="Vehicle icon  is required to be unique."></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" type="text"
                                        placeholder="Enter Vehicle icon code" name="vehicle_icon" />
                                    <!--end::Input-->
                                    @error('vehicle_icon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-7">

                                    <!--begin::Input-->
                                    <span>

                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input mx-4" type="checkbox" value="1"
                                                name="active_status" checked="checked" /><span class="fs-6 fw-bold">Is
                                                Available</span>

                                        </label>
                                    </span>
                                    <!--begin::Input-->
                                </div>
                                <!--end::Input group-->


                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3" id="nixus_add_new_type_cancel"
                                        data-kt-types-modal-action="cancel">Discard
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="nixus_add_new_type_submit"
                                        data-kt-types-modal-action="submit">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
            <!--end::Modal - Add types-->


            <!--begin::Modal - Update types-->
            <div class="modal fade" id="nixus_update_vehicle_type" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder">Update type</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-types-modal-action="close">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16"
                                            height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                            fill="currentColor" />
                                        <rect x="7.41422" y="6" width="16" height="2"
                                            rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
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
                            <form id="nixus_update_vehicle_type_form" class="form" action="#" method="POST">
                                @csrf
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-5 mx-2">
                                        <span class="required">Vehicle type</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                            data-bs-trigger="hover" data-bs-html="true"
                                            data-bs-content=" Vehicle type is required to be unique."></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" placeholder="Enter a type Name"
                                        name="updated_type_name" id="updated_type_name" />
                                    <!--end::Input-->
                                    @error("updated_type_name")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-5 mx-2">
                                        <span class="required"> Capacity </span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                            data-bs-trigger="hover" data-bs-html="true"
                                            data-bs-content="Vehicle capicity  is required."></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" type="text"
                                        placeholder="Enter Vehicle capacity" name="updated_type_capacity"
                                        id="updated_type_capacity" />
                                    <!--end::Input-->

                                </div>
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-5 mx-2">
                                        <span class="required"> Icon </span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                            data-bs-trigger="hover" data-bs-html="true"
                                            data-bs-content="Vehicle icon  is required."></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" type="text"
                                        placeholder="Enter Vehicle icon code" name="updated_type_icon"
                                        id="updated_type_icon" />
                                    <!--end::Input-->

                                </div>
                                <div class="fv-row mb-7">

                                    <!--begin::Input-->
                                    <span>

                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input mx-4" type="checkbox"
                                                name="updated_active_status" id="updated_active_status"
                                                checked="checked" /><span class="fs-6 fw-bold">Is Available</span>

                                        </label>
                                    </span>
                                    <!--begin::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3"
                                        data-kt-types-modal-action="cancel">Discard
                                    </button>
                                    <button type="submit" class="btn btn-primary" data-kt-types-modal-action="submit">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
            <!--end::Modal - Update types-->
            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->


@endsection

@section('extra_scripts')
    <script src="{{ asset('static/js/custom/apps/fleet/add_type.js') }}"></script>
    @if($errors->any())
    <script>
        $(document).ready(function() {
            // Show the modal when there are validation errors
            $('#nixus_add_vehicle_type').modal('show');

        });
    </script>
@endif
@endsection
