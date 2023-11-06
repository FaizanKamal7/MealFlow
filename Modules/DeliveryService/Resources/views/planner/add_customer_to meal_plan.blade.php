@extends('layouts.admin_master')
@section('title', 'Upload Customer to Meal Plan')

@section('extra_style')
<link rel="stylesheet" href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.19/css/intlTelInput.css" />

@endsection
@section('main_content')

<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <div class="container">
            <div class="d-flex mt-2 align-items-center pricing-header justify-content-between">
                <div class="activate-service">
                    <h1 class="fs-lg-2x ">Add Customers to meal Plan</h1>
                </div>
            </div>

            <div class="mt-2 d-flex align-items-center justify-content-between print-div unassigned-second-div">
                @can('view_all_businesses') <div class="me-3 business-heading">
                    <h1 class="fs-lg-2x">Select Business</h1>
                </div>
                <div class="d-flex align-items-center business-second">
                    <div class="me-3 w-300px">
                        <select id="businessSelect" class="form-select form-select-solid" data-control="select2"
                            data-placeholder="Select a Business" onchange="setBusinessID()">
                            <option></option>
                            @foreach ($businesses as $business)
                            <option value={{ $business->id }}> {{ $business->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endcan

                <div class="d-flex align-items-center business-second">
                    <a href="#uploadByExcel" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#nixus_modal_upload_excel"><i class="fa fa-file-excel"></i> Upload
                        By
                        Excel</a>
                </div>
            </div>
            <!--begin::Content-->

        </div>

    </div>


    <!--end::Container-->
</div>
<!--end::Post-->
<!--begin::Modal - Upload By Excel-->
{{-- modal div here --}}
<div class="modal fade" id="nixus_modal_upload_excel" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
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
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin:Form-->
                {{-- <form id="nixus_modal_upload_excel_form" class="form" action="#"> --}}
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Upload By Excel</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="text-muted fw-bold fs-5">Please first download prefilled template by providing
                            no.
                            of deliveries you want to upload.
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                    <a href="{{ route('generate_delivery_template') }}">
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required"><u> Download Sample Deliveries Sheet</u></span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify total deliveries you want to upload."></i>

                            </label>
                        </div>
                        <!--end::Input group-->
                    </a>

                    <form method="post" action="{{ route('store_new_customers_excel_info') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" id="business_id" name="business_id" value={{ Auth::user()->is_admin()
                        ? Auth::user()->business->id : ""}}>

                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Excel File</label>
                            <input type="file" class="form-control form-control-solid" placeholder="Select excel file"
                                name="excel_file" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="nixus_modal_upload_excel_cancel" class="btn btn-light me-3"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="nixus_modal_upload_excel_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>

                    {{--
                </form> --}}
                {{--
                <!--end:Form--> --}}
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Upload By Excel-->
@endsection

@section('extra_scripts')
<script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>

<script>
    function setBusinessID() {
        console.log("Before: " + document.getElementById('business_id').value);
        document.getElementById('business_id').value =  document.getElementById("businessSelect").value;
        console.log(document.getElementById('business_id').value);
    }


    $(document).ready(function() {
        function reInitializeDataValidation() {
            $(".fv-plugins-message-container.invalid-feedback").remove();

        }
        $("#kt_datepicker_3").flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
        });
    });
</script>
@endsection