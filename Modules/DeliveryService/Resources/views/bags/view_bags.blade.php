@extends('layouts.admin_master')
@section('title', 'Bags | View Bags')

@section('extra_style')
@endsection

@section('main_content')

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="container_not_padding">

                <div class="d-flex align-items-center justify-content-between bags_upperdiv">
                    <div class="activate-service">
                        <h1 class="fs-lg-2x">Bags</h1>
                    </div>
                    <div class="d-flex align-items-center ">
                        <div class="me-8 business-heading">
                            <h1 class="fs-lg-2x" style="margin-bottom: 0;">Select Business</h1>
                        </div>

                        <div class="form-div">
                            <!--begin::Form-->
                            <form action="{{ route('view_business_bags') }}" method="post" id="view_partner_bag_form"
                                class="d-flex align-items-center">
                                @csrf
                                <div class="me-3 w-300px">
                                    <select class="form-select" aria-label="Select example" data-control="select2"
                                        id="business_id" name="business_id">
                                        <option value="">Select Business</option>
                                        @foreach ($businesses as $business)
                                            <option value="{{ $business->id }}">{{ $business->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('business_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="me-3">
                                    <button type="submit" class="btn text-white activate-btn" id="add_bag_submit_btn">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20"
                                                    height="20" rx="5" fill="currentColor" />
                                                <rect x="10.8891" y="17.8033" width="12" height="2"
                                                    rx="1" transform="rotate(-90 10.8891 17.8033)"
                                                    fill="currentColor" />
                                                <rect x="6.01041" y="10.9247" width="12" height="2"
                                                    rx="1" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        Get Bags
                                    </button>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                </div>

                @if ($bags)

                    <div class="mt-5 bag_table_div">
                        <div
                            class="card-header wallet-card-header bag_details d-flex align-items-center justify-content-between">
                            <!--begin::Title-->
                            <h3 class="card-title wallet-title fw-bolder">Bag Details</h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
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
                            <!--end::Toolbar-->
                        </div>

                        <div class="table_container">

                            <table id="bag_view_table" class="table table-rounded table-striped border gy-7 gs-7">
                                <thead>
                                    <tr class="text-start fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-1px w-200px">Qr Code</th>
                                        <th class="min-w-1px">Bag ID</th>
                                        <th class="min-w-1px">Business</th>
                                        <th class="min-w-1px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bags as $bag)
                                        <tr>
                                            <!--begin::Name=-->
                                            <td> <img src="{{ asset($bag->qr_code) }}" width="100px" alt="image" /></td>
                                            <!--end::Name=-->
                                            <!--begin::Name=-->
                                            <td><a href="{{ route('view_bag_timeline', ['bag_id' => $bag->id]) }}">
                                                    {{ $bag->id }}</a></td>
                                            <!--end::Name=-->
                                            <!--begin::Name=-->
                                            <td>{{ $bag->business->name }}</td>
                                            <!--end::Name=-->
                                            <!--begin::Action=-->
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Delete-->
                                                    <button class="me-3 btn btn-icon btn-active-light-primary w-30px h-30px"
                                                        data-kt-Make-table-filter="delete_row">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                        <span class="table-icon" onclick="">
                                                            <x-iconsax-bul-trash />
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </button>
                                                    <!--end::Delete-->
                                                    <span class="table-icon" onclick="">
                                                        <x-iconsax-bul-edit-2 /> </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>

                @endif
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
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-Make-modal-action="close">
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
                                <form id="nixus_add_vehicle_make_form" class="form" action="#">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold form-label mb-5 mx-2">
                                            <span class="required"> Vehicle Make </span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                                data-bs-trigger="hover" data-bs-html="true"
                                                data-bs-content="Vehicle Make  is required to be unique."></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder="Enter Vehicle Make"
                                            name="make" />
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
                                <form id="nixus_update_vehicle_make_form" class="form" action="#">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold form-label mb-5 mx-2">
                                            <span class="required">Vehicle Make</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                                data-bs-trigger="hover" data-bs-html="true"
                                                data-bs-content=" Vehicle Make  is required to be unique."></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder="Make"
                                            name="permission_name" />
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


                {{-- end_container --}}
            </div>
            <!--end::ktContainer-->
        </div>

    </div>
    <!--end::Post-->

@endsection

@section('extra_scripts')

    <script src="{{ asset(' static/js/custom/apps/bag/add_bag.js') }}"></script>

@endsection
