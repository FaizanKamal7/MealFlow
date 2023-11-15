@extends('layouts.admin_master')
@section('title', 'Upload Deliveries')

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
                    <h1 class="fs-lg-2x ">Upload Deliveries</h1>
                </div>
            </div>
            <div class="mt-2 d-flex align-items-center justify-content-between print-div unassigned-second-div">
                <div class="me-3 business-heading">
                    <h1 class="fs-lg-2x">Select Business</h1>
                </div>
                <div class="d-flex align-items-center business-second">
                    <div class="me-3 w-300px">
                        <select id="businessSelect" class="form-select form-select-solid" data-control="select2"
                            data-placeholder="Select a Business" onchange="getBusinessBranches()">
                            <option></option>
                            @foreach ($businesses as $business)
                            <option value={{ $business->id }}> {{ $business->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="me-3">
                        <a class="btn text-white activate-btn" href="{{ route('test') }}">+ Add New Delivery</a>
                    </div>
                    <div class="me-3">
                        <a href="#uploadByExcel" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#excel_upload_modal"><i class="fa fa-file-excel"></i> Upload
                            By
                            Excel</a>
                    </div>
                </div>
            </div>

            {{-- ------------ --}}

            <form action="{{route('test_upload_db')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex flex-column mb-8 fv-row">
                    <label class="required fs-6 fw-bold mb-2">Excel File</label>
                    {{-- <input type="file" class="form-control form-control-solid" placeholder="Select excel file"
                        name="excel_file" /> --}}
                    <input type="file" class="form-control form-control-solid" placeholder="Select excel file(s)"
                        name="excel_files[]" multiple />
                </div>

                <button type="submit" class="btn-light-danger"> Upload Business data</button>
            </form>
            {{-- ------------ --}}

            <!--begin::Content-->
            <div class="mt-3 upload-delivery-div">
                <form id="kt_upload_delivery_form" class="form" action="{{ route('upload_deliveries_multiple') }}"
                    method="post">
                    @csrf
                    <!--begin::Repeater-->
                    <div id="kt_docs_repeater_advanced">
                        <!--begin::Form group-->
                        <div class="form-group">
                            <div data-repeater-list="kt_docs_repeater_advanced">
                                <div data-repeater-item>
                                    <div
                                        class="form-group d-flex align-items-center justify-content-between upload-delivery-header">
                                        <h4 class="delivery-heading upload-label">
                                            Delivery
                                        </h4>
                                        <div class="remove-btn">
                                            <a href="javascript:;" data-repeater-delete
                                                class="btn btn-flex btn-sm btn-light-danger">
                                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span
                                                        class="path2"></span><span class="path3"></span><span
                                                        class="path4"></span><span class="path5"></span></i>
                                                Remove
                                            </a>
                                        </div>
                                    </div>
                                    <hr
                                        style="background: radial-gradient(50% 50% at 50% 50%, #432C2C 0%, rgba(80, 28, 28, 0) 100%);">
                                    <!--begin::Form-->
                                    <input type="hidden" name="business_id" id="businessId" value="">


                                    <div id="upload_delivery_repeater_form" class="main-div-form">
                                        <div class="fv-row form-group row mb-10 mt-6">
                                            <div class="fv-row col-md-3">
                                                <label class="form-label upload-label">Name</label>
                                                <input type="text" class="form-control upload-control mb-2 mb-md-0"
                                                    placeholder="John Doe" name="delivery_name"
                                                    value="{{ old('kt_docs_repeater_advanced.0.delivery_name') }}" />

                                                @if ($errors->has('kt_docs_repeater_advanced.*.delivery_name'))
                                                <div class="upload-errors">
                                                    {{ $errors->first('kt_docs_repeater_advanced.0.delivery_name') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="fv-row col-md-3">
                                                <label class="form-label upload-label">Phone Number</label>
                                                <input type="number" name="phone" id="phone"
                                                    class="form-control upload-control mb-2 mb-md-0"
                                                    placeholder="0512233123" autocomplete="off"
                                                    value="{{ old('kt_docs_repeater_advanced.0.phone') }}" />


                                                @if ($errors->has('kt_docs_repeater_advanced.0.phone'))

                                                <div class="upload-errors">
                                                    {{ $errors->first('kt_docs_repeater_advanced.0.phone') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label upload-label">Area*</label>
                                                <select class="form-select" data-kt-repeater="select2"
                                                    data-placeholder="Select area" name="area">
                                                    <option></option>
                                                    @foreach ($areas as $area)
                                                    <option value="{{ $area->id }}">
                                                        {{ $area->city->name }} ({{ $area->name }})</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('kt_docs_repeater_advanced.*.area'))
                                                <div class="upload-errors">
                                                    {{ $errors->first('kt_docs_repeater_advanced.0.area') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label upload-label">Emirates with time</label>
                                                <select class="form-select" data-kt-repeater="select2"
                                                    data-placeholder="Select an option" name="emirates_with_time">
                                                    <option></option>
                                                    @foreach ($time_slot as $slot)
                                                    <option value="{{ $slot->id }}">
                                                        {{ $slot->city->name }} ({{ $slot['start_time'] }} -
                                                        {{ $slot['end_time'] }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('kt_docs_repeater_advanced.*.emirates_with_time'))
                                                <div class="upload-errors">
                                                    {{ $errors->first('kt_docs_repeater_advanced.0.emirates_with_time')
                                                    }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mb-10">
                                            <div class="col-md-3">
                                                <label class="form-label upload-label">Date</label>
                                                <input class="form-control upload-control" data-kt-repeater="datepicker"
                                                    placeholder="Pick a date" name="datepicker" />
                                                @if ($errors->has('kt_docs_repeater_advanced.*.datepicker'))
                                                <div class="upload-errors">
                                                    {{ $errors->first('kt_docs_repeater_advanced.0.datepicker') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label upload-label">Delivery Amount</label>
                                                <input type="text" class="form-control upload-control mb-2 mb-md-0"
                                                    placeholder="AED" name="delivery_amount" autocomplete="off"
                                                    value="{{ old('kt_docs_repeater_advanced.0.delivery_amount') }}" />

                                                @if ($errors->has('kt_docs_repeater_advanced.*.delivery_amount'))
                                                <div class="upload-errors">
                                                    {{ $errors->first('kt_docs_repeater_advanced.0.delivery_amount') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label upload-label">Signature</label>
                                                <select class="form-select" data-kt-repeater="select2"
                                                    data-placeholder="Select" name="signature">
                                                    <option></option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                                @if ($errors->has('kt_docs_repeater_advanced.*.signature'))
                                                <div class="upload-errors">
                                                    {{ $errors->first('kt_docs_repeater_advanced.0.signature') }}
                                                </div>
                                                @endif

                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label upload-label">Notification *</label>
                                                <select class="form-select" data-kt-repeater="select2"
                                                    data-placeholder="Select" name="notification">
                                                    <option></option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                                @if ($errors->has('kt_docs_repeater_advanced.*.notification'))
                                                <div class="upload-errors">
                                                    {{ $errors->first('kt_docs_repeater_advanced.0.notification') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mb-10">
                                            <div class="col-md-5">
                                                <label class="form-label upload-label">Pickup Address</label>
                                                <select id="business_branches" class="form-select"
                                                    data-kt-repeater="select2" data-placeholder="Select an option"
                                                    name="branch_dropdown">
                                                    <option></option>
                                                </select>
                                                @if ($errors->has('kt_docs_repeater_advanced.*.branch_dropdown'))
                                                <div class="upload-errors">
                                                    {{ $errors->first('kt_docs_repeater_advanced.0.branch_dropdown') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label upload-label">Delivery Address</label>
                                                <input type="text" class="form-control upload-control mb-2 mb-md-0"
                                                    placeholder="Delivery Address" name="delivery_address"
                                                    autocomplete="off"
                                                    value="{{ old('kt_docs_repeater_advanced.0.delivery_address') }}" />

                                                @if ($errors->has('kt_docs_repeater_advanced.*.delivery_address'))
                                                <div class="upload-errors">
                                                    {{ $errors->first('kt_docs_repeater_advanced.0.delivery_address') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label upload-label">Product Type</label>
                                                <select class="form-select" data-kt-repeater="select2"
                                                    data-placeholder="Select" name="product_type">
                                                    <option></option>
                                                    @foreach ($product_type as $type)
                                                    <option value="{{ $type->id }}">
                                                        {{ $type->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('kt_docs_repeater_advanced.*.product_type'))
                                                <div class="upload-errors">
                                                    {{ $errors->first('kt_docs_repeater_advanced.0.product_type') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mb-10">
                                            <div class="col-md-6">
                                                <label class="form-label upload-label">Notes</label>
                                                <input type="text" class="form-control upload-control mb-2 mb-md-0"
                                                    placeholder="Additonal Notes" name="notes" autocomplete="off"
                                                    value="{{ old('kt_docs_repeater_advanced.0.notes') }}" />

                                                @if ($errors->has('kt_docs_repeater_advanced.*.notes'))
                                                <div class="upload-errors">
                                                    {{ $errors->first('kt_docs_repeater_advanced.0.notes') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label upload-label">Google Link Address</label>
                                                <input type="text" class="form-control upload-control mb-2 mb-md-0"
                                                    placeholder="https://www.google.com/" name="google_link_address"
                                                    autocomplete="off"
                                                    value="{{ old('kt_docs_repeater_advanced.0.google_link_address') }}" />

                                                @if ($errors->has('kt_docs_repeater_advanced.*.google_link_address'))
                                                <div class="upload-errors">
                                                    {{ $errors->first('kt_docs_repeater_advanced.0.google_link_address')
                                                    }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3 mb-10 add-div">
                            <a href="javascript:;" data-repeater-create class="btn btn-flex ">
                                <i class="ki-duotone ki-plus fs-3"></i>
                                + Add Another
                            </a>
                        </div>
                        <!--end::Form group-->
                    </div>
                    <hr style="background: radial-gradient(50% 50% at 50% 50%, #432C2C 0%, rgba(80, 28, 28, 0) 100%);">

                    <div class="d-flex justify-content-end mt-8">
                        <!--begin::Button-->
                        <button type="reset" data-kt-contacts-type="cancel" class="btn btn-light me-3">Cancel</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_docs_formvalidation_text_submit" data-kt-contacts-type="submit"
                            class="btn text-white activate-btn ">
                            <span class="indicator-label ">Save Deliveries</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Repeater-->
                </form>
            </div>
            {{-- extra removed, in txt file, here --}}
        </div>

    </div>


    <!--end::Container-->
</div>
<!--end::Post-->
<!--begin::Modal - Upload By Excel-->
{{-- modal div here --}}
<div class="modal fade" id="excel_upload_modal" tabindex="-1" aria-hidden="true">
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
                {{-- <form id="excel_upload_modal_form" class="form" action="#"> --}}
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
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required"> <a href="{{ route('generate_delivery_template') }}">
                                    Download Sample Deliveries Sheet</a> </span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                title="Specify total deliveries you want to upload."></i>

                        </label>
                    </div>
                    <!--end::Input group-->


                    <form method="post" action="{{ route('upload_deliveries_by_excel') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <select class="form-select form-select-solid mb-5" data-control="select2"
                            data-placeholder="Select a Business" name="business_id">
                            <option></option>
                            @foreach ($businesses as $business)
                            <option value={{ $business->id }}> {{ $business->name }}</option>
                            @endforeach
                        </select>
                        @error('business_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="mb-2">
                            <label for="" class="form-label">Select date </label>
                            <input name="delivery_date" class="form-control form-control-solid" placeholder="Pick date"
                                id="kt_datepicker_3" />
                            @error('delivery_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Excel File</label>
                            <input type="file" class="form-control form-control-solid" placeholder="Select excel file"
                                name="excel_file" />
                            @error('excel_file')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="excel_upload_modal_cancel" class="btn btn-light me-3"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="excel_upload_modal_submit" class="btn btn-primary">
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
{{-- <script src="assets/plugins/global/plugins.bundle.js"></script> --}}
<script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>

<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        separateDialCode: true,
        excludeCountries: ["in", "il"],
        preferredCountries: ["ae", "pk", "sa"]
    });

    $('#kt_docs_repeater_advanced').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();

                // Re-init select2
                $(this).find('[data-kt-repeater="select2"]').select2();

                // Calculate tomorrow's date
                var tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                var tomorrowFormatted = tomorrow.toISOString().split('T')[0];

                // Re-init flatpickr
                $(this).find('[data-kt-repeater="datepicker"]').flatpickr({
                    dateFormat: "Y-m-d", // Define your desired date format
                    defaultDate: tomorrowFormatted, // Set default date to tomorrow
                    minDate: tomorrowFormatted, // Disable previous dates
                });
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function() {
                // Init select2
                $('[data-kt-repeater="select2"]').select2();
                // Calculate tomorrow's date
                var tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                var tomorrowFormatted = tomorrow.toISOString().split('T')[0];

                // Init flatpickr
                $('[data-kt-repeater="datepicker"]').flatpickr({
                    dateFormat: "Y-m-d", // Define your desired date format
                    defaultDate: tomorrowFormatted, // Set default date to tomorrow
                    minDate: tomorrowFormatted, // Disable previous dates
                });
            }
        });

        function getBusinessBranches() {

            var businessId = document.getElementById("businessSelect").value;
            var branch_dropdown = document.getElementById("business_branches");
            const businessIdInput = document.getElementById('businessId');
            // setting hidden field value to business which is selected
            businessIdInput.value = businessId;
            console.log(businessId)

            // Clear current options
            branch_dropdown.innerHTML = '';
            // Make AJAX request to fetch states
            if (businessId) {
                const url = `/admin/deliveries/get-business-branches/${businessId}`
                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        var branches = response.branches;
                        // Populate branches dropdown
                        console.log(branches)
                        branches.forEach(function(branch) {
                            var option = document.createElement("option");
                            option.value = branch.id;
                            option.text = '(' + branch.name + ') ' + branch.address;
                            branch_dropdown.appendChild(option);
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            }
        }
</script>

<script>
    $(document).ready(function() {
        function removeValidationMessage() {
        // Remove any validation error messages
        $(".fv-plugins-message-container.invalid-feedback").remove();
        }
        // Calculate tomorrow's date
        var tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);


        // Initialize the date picker
        $("#kt_datepicker_3").flatpickr({
            enableTime: false, // Disable time selection
            dateFormat: "Y-m-d", // Set the date format to Year-Month-Day
            minDate: "today", // Minimum selectable date is tomorrow
            maxDate: new Date().fp_incr(+30), // Disable dates before today
            defaultDate: tomorrow,
            onClose: removeValidationMessage // Remove validation messages when the date picker is closed
        });
    });
</script>


@if ($errors->any())
<script>
    $(document).ready(function() {
        // Show the modal when there are validation errors
        $('#excel_upload_modal').modal('show');

    });
</script>
@endif
@endsection