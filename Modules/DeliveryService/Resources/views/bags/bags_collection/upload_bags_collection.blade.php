@extends('layouts.admin_master')
@section('title', 'Upload Bags Collection')

@section('extra_style')
@endsection
@section('main_content')

<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <div class="container">
            <div class="d-flex mt-2 align-items-center pricing-header justify-content-between">
                <div class="activate-service">
                    <h1 class="fs-lg-2x ">Upload Bags Collection</h1>
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
                            data-bs-target="#nixus_modal_upload_excel"><i class="fa fa-file-excel"></i> Upload
                            By
                            Excel</a>
                    </div>
                </div>
            </div>

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
                                            Bag Collection
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
                                            <div class="col-md-6">
                                                <label class="form-label upload-label">Customer*</label>
                                                <select class="form-select" data-kt-repeater="select2"
                                                    data-placeholder="Select customer" id="customer" name="customer"
                                                    onchange="updateFormForCustomer()">
                                                    <option></option>
                                                    @foreach ($customers as $customer)
                                                    <option value="{{ $customer}}"
                                                        data-object="{{ json_encode($customer) }}">
                                                        {{ $customer->user->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('kt_docs_repeater_advanced.*.area'))
                                                <div class=" upload-errors">
                                                    {{ $errors->first('kt_docs_repeater_advanced.0.area') }}
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
                                            <div class="col-md-6">
                                                <label class="form-label upload-label">Address</label>
                                                <select class="form-select" data-kt-repeater="select2"
                                                    data-placeholder="Select an option" id="addresses" name="addresses">
                                                    <!-- Options will go here -->

                                                </select>

                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label upload-label">Phone</label>
                                                <input type="text" class="form-control upload-control mb-2 mb-md-0"
                                                    placeholder="Phone" id="phone" name="phone" autocomplete="off"
                                                    value="" />
                                                @if ($errors->has('kt_docs_repeater_advanced.*.phone'))
                                                <div class="upload-errors">
                                                    {{ $errors->first('kt_docs_repeater_advanced.0.phone') }}
                                                </div>
                                                @endif

                                            </div>
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
                                        <div class="form-group row mb-10" id="empty_bags_section" style="display: none">
                                            <!--begin::Alert-->
                                            <div class="alert alert-warning d-flex align-items-center p-5">
                                                <!--begin::Icon-->
                                                <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span
                                                        class="path1"></span><span class="path2"></span></i>
                                                <!--end::Icon-->

                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-column">
                                                    <!--begin::Title-->
                                                    <h4 class="mb-1 text-dark">Warning: Customer Empty Bags</h4>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span>This customer currently have following
                                                        empty bags and they are already in unassigned section.<br>
                                                        You don't need to upload them again</span>
                                                    <!--end::Title-->



                                                    <!--begin::Content-->
                                                    <span>
                                                        {{-- Populating with cusomters empty bags --}}
                                                        <b>
                                                            <div class="col-md-12" id="customer_empty_bags"> </div>
                                                        </b>
                                                    </span>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Alert-->

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
                    <form method="get" action="{{ route('generate_delivery_template') }}">
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Download Sample Deliveries Sheet</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify total deliveries you want to upload."></i>
                                <button type="submit" class="input-group-text btn-primary px-2" id="basic-addon2">
                                    <i class="fa fa-file-download fs-4 text-white"></i>
                                </button>
                            </label>
                        </div>
                        <!--end::Input group-->
                    </form>

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
                        <div class="mb-2">
                            <label for="" class="form-label">Select date </label>
                            <input name="delivery_date" class="form-control form-control-solid" placeholder="Pick date"
                                id="kt_datepicker_3" />
                        </div>
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
{{-- <script src="assets/plugins/global/plugins.bundle.js"></script> --}}

<script>
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

        function updateFormForCustomer() {
            const customerSelect = document.getElementById("customer");
            const selected_customer = JSON.parse(customerSelect.selectedOptions[0].getAttribute('data-object'));

            // --- P O P U L A T E   only specific customer's addresses
            const addressSelect = document.getElementById("addresses");
            addressSelect.innerHTML = '<option></option>'; // Clear and add empty option
            
            if (selected_customer.customerAddresses) {
                selected_customer.customerAddresses.forEach(address => {
                    const option = new Option(address.address, address.id);
                    addressSelect.add(option);
                });
            }

            // --- P O P U L A T E   phone of specific customer
            document.getElementById("phone").value = selected_customer.user.phone;



            // --- P O P U L A T E   customer's empty bags
            var empty_bags_div = document.getElementById("customer_empty_bags");
            var empty_bags_section_div = document.getElementById("empty_bags_section");
            

            const url = `/admin/deliveries/bag/customer-empty-bags/`+ selected_customer.id;
            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                success: function(empty_delivery_bags) {
                    if (empty_delivery_bags) {
                        empty_bags_section_div.style.display = "block";
                        var empty_bags_div = document.getElementById("customer_empty_bags");
                        empty_delivery_bags.forEach(empty_delivery_bag => {
                            var bag_div = document.createElement('p');
                            
                            if (empty_delivery_bag.delivery && empty_delivery_bag.delivery.id) {
                                bag_div.textContent = 'Bag id: '+ empty_delivery_bag.delivery.id + ' | Partner: '+empty_delivery_bag.delivery.branch.business.name;
                            } else {
                                bag_div.textContent = 'No delivery ID';
                            }
                            
                            empty_bags_div.appendChild(bag_div);
                        });
                    }
                },
                error: function(error) {
                    console.log(error);
                },
            });
           
        }

        


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