@extends('layouts.admin_master')
@section('title', 'Upload Deliveries')

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
                        <h1 class="fs-lg-2x ">Upload Deliveries</h1>
                    </div>
                </div>
                <div class="mt-2 d-flex align-items-center justify-content-between print-div unassigned-second-div">
                    <div class="me-3 business-heading">
                        <h1 class="fs-lg-2x">Select Business</h1>
                    </div>
                    <div class="d-flex align-items-center business-second">
                        <div class="me-3 w-300px">
                            <select class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Select a Business">
                                <option></option>
                                @foreach ($businesses as $business)
                                    <option value={{ $business->id }}> {{ $business->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="me-3">
                            <a class="btn text-white activate-btn">+ Add New Delivery</a>
                        </div>
                    </div>
                </div>

                <!--begin::Content-->
                <div class="mt-3 upload-delivery-div">
                    <form id="kt_upload_delivery_form" class="form" action="{{ route('upload_deliveries_multiple') }}"
                        method="post">

                        @csrf
                        {{-- @if ($errors->any())
                            <div class="upload-errors">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}

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

                                        <div id="upload_delivery_repeater_form" class="main-div-form">
                                            <div class="fv-row form-group row mb-10 mt-6">
                                                <div class="fv-row col-md-3">
                                                    <label class="form-label upload-label">Name</label>
                                                    <input type="text" class="form-control upload-control mb-2 mb-md-0"
                                                        placeholder="Sharjah Emirate" name="delivery_name"
                                                        value="{{ old('kt_docs_repeater_advanced.0.delivery_name') }}" />

                                                    @if ($errors->has('kt_docs_repeater_advanced.*.delivery_name'))
                                                        @foreach ($errors->get('kt_docs_repeater_advanced.*.delivery_name') as $error)
                                                            <div class="upload-errors">{{ $error[0] }}</div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="fv-row col-md-3">
                                                    <label class="form-label upload-label">Phone Number</label>
                                                    <input type="number" name="phone_number"
                                                        class="form-control upload-control mb-2 mb-md-0"
                                                        placeholder="+971 123 456" autocomplete="off"
                                                        value="{{ old('kt_docs_repeater_advanced.0.phone_number') }}" />

                                                    @if ($errors->has('kt_docs_repeater_advanced.*.phone_number'))
                                                        @foreach ($errors->get('kt_docs_repeater_advanced.*.phone_number') as $error)
                                                            <div class="upload-errors">{{ $error[0] }}</div>
                                                        @endforeach
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
                                                        @foreach ($errors->get('kt_docs_repeater_advanced.*.area') as $error)
                                                            <div class="upload-errors">{{ $error[0] }}</div>
                                                        @endforeach
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
                                                        @foreach ($errors->get('kt_docs_repeater_advanced.*.emirates_with_time') as $error)
                                                            <div class="upload-errors">{{ $error[0] }}</div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row mb-10">
                                                <div class="col-md-2">
                                                    <label class="form-label upload-label">Date</label>
                                                    <input class="form-control upload-control" data-kt-repeater="datepicker"
                                                        placeholder="Pick a date" name="datepicker" />
                                                    @if ($errors->has('kt_docs_repeater_advanced.*.datepicker'))
                                                        @foreach ($errors->get('kt_docs_repeater_advanced.*.datepicker') as $error)
                                                            <div class="upload-errors">{{ $error[0] }}</div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label upload-label">Company Delivery Id</label>
                                                    <input type="text" class="form-control upload-control mb-2 mb-md-0"
                                                        placeholder="UAE" name="company_delivery_id" autocomplete="off"
                                                        value="{{ old('kt_docs_repeater_advanced.0.company_delivery_id') }}" />

                                                    @if ($errors->has('kt_docs_repeater_advanced.*.company_delivery_id'))
                                                        @foreach ($errors->get('kt_docs_repeater_advanced.*.company_delivery_id') as $error)
                                                            <div class="upload-errors">{{ $error[0] }}</div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label upload-label">Delivery Amount</label>
                                                    <input type="text" class="form-control upload-control mb-2 mb-md-0"
                                                        placeholder="AED" name="delivery_amount" autocomplete="off"
                                                        value="{{ old('kt_docs_repeater_advanced.0.delivery_amount') }}" />

                                                    @if ($errors->has('kt_docs_repeater_advanced.*.delivery_amount'))
                                                        @foreach ($errors->get('kt_docs_repeater_advanced.*.delivery_amount') as $error)
                                                            <div class="upload-errors">{{ $error[0] }}</div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label upload-label">Signature</label>
                                                    <select class="form-select" data-kt-repeater="select2"
                                                        data-placeholder="Select" name="signature">
                                                        <option></option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                    @if ($errors->has('kt_docs_repeater_advanced.*.signature'))
                                                        @foreach ($errors->get('kt_docs_repeater_advanced.*.signature') as $error)
                                                            <div class="upload-errors">{{ $error[0] }}</div>
                                                        @endforeach
                                                    @endif

                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label upload-label">Notification *</label>
                                                    <select class="form-select" data-kt-repeater="select2"
                                                        data-placeholder="Select" name="notification">
                                                        <option></option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                    @if ($errors->has('kt_docs_repeater_advanced.*.notification'))
                                                        @foreach ($errors->get('kt_docs_repeater_advanced.*.notification') as $error)
                                                            <div class="upload-errors">{{ $error[0] }}</div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row mb-10">
                                                <div class="col-md-5">
                                                    <label class="form-label upload-label">Pickup Address</label>
                                                    <input type="text" class="form-control upload-control mb-2 mb-md-0"
                                                        placeholder="Pickup address" name="pickup_address"
                                                        autocomplete="off"
                                                        value="{{ old('kt_docs_repeater_advanced.0.pickup_address') }}" />

                                                    @if ($errors->has('kt_docs_repeater_advanced.*.pickup_address'))
                                                        @foreach ($errors->get('kt_docs_repeater_advanced.*.pickup_address') as $error)
                                                            <div class="upload-errors">{{ $error[0] }}</div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label upload-label">Delivery Address</label>
                                                    <input type="text" class="form-control upload-control mb-2 mb-md-0"
                                                        placeholder="Delivery Address" name="delivery_address"
                                                        autocomplete="off"
                                                        value="{{ old('kt_docs_repeater_advanced.0.delivery_address') }}" />

                                                    @if ($errors->has('kt_docs_repeater_advanced.*.delivery_address'))
                                                        @foreach ($errors->get('kt_docs_repeater_advanced.*.delivery_address') as $error)
                                                            <div class="upload-errors">{{ $error[0] }}</div>
                                                        @endforeach
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
                                                        @foreach ($errors->get('kt_docs_repeater_advanced.*.product_type') as $error)
                                                            <div class="upload-errors">{{ $error[0] }}</div>
                                                        @endforeach
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
                                                        @foreach ($errors->get('kt_docs_repeater_advanced.*.notes') as $error)
                                                            <div class="upload-errors">{{ $error[0] }}</div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label upload-label">Google Link Address</label>
                                                    <input type="text" class="form-control upload-control mb-2 mb-md-0"
                                                        placeholder="https://www.google.com/" name="google_link_address"
                                                        autocomplete="off"
                                                        value="{{ old('kt_docs_repeater_advanced.0.google_link_address') }}" />

                                                    @if ($errors->has('kt_docs_repeater_advanced.*.google_link_address'))
                                                        @foreach ($errors->get('kt_docs_repeater_advanced.*.google_link_address') as $error)
                                                            <div class="upload-errors">{{ $error[0] }}</div>
                                                        @endforeach
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
                            <button type="reset" data-kt-contacts-type="cancel"
                                class="btn btn-light me-3">Cancel</button>
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

        // Wrap your code inside a DOMContentLoaded event listener
        // document.addEventListener("DOMContentLoaded", function() {
        //     // Define form element
        //     const form = document.getElementById('kt_upload_delivery_form');

        //     const deliveryNameInput = document.getElementById('asdasd');

        //     // const deliveryNameInput = document.getElementsByName('phone_number')[
        //     // 0]; // Use [0] to access the first matching element
        //     console.log('form', form, deliveryNameInput);


        //     // Init form validation rules...
        //     var validator = FormValidation.formValidation(
        //         form, {
        //             fields: {
        //                 delivery_name: {
        //                     validators: {
        //                         notEmpty: {
        //                             message: "Delivery name is required",
        //                         },
        //                         regexp: {
        //                             regexp: /^[^\d]+$/,
        //                             message: "First name should not contain digits",
        //                         },
        //                     },
        //                 },
        //                 phone_number: {
        //                     validators: {
        //                         notEmpty: {
        //                             message: "Phone Number is required",
        //                         },
        //                     },
        //                 },
        //             },

        //             plugins: {
        //                 trigger: new FormValidation.plugins.Trigger(),
        //                 bootstrap: new FormValidation.plugins.Bootstrap5({
        //                     rowSelector: '.fv-row',
        //                     eleInvalidClass: '',
        //                     eleValidClass: ''
        //                 })
        //             }

        //         },

        //     );

        //     console.log('plugin', validator)
        //     // Submit button handler
        //     const submitButton = document.getElementById('kt_docs_formvalidation_text_submit');
        //     submitButton.addEventListener('click', function(e) {
        //         // Prevent default button action
        //         e.preventDefault();

        //         // Validate form before submit
        //         if (validator) {
        //             validator.validate().then(function(status) {
        //                 console.log('validated!', validator, status);

        //                 if (status == 'Valid') {
        //                     // Show loading indication
        //                     submitButton.setAttribute('data-kt-indicator', 'on');

        //                     // Disable button to avoid multiple click
        //                     submitButton.disabled = true;

        //                     // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
        //                     setTimeout(function() {
        //                         // Remove loading indication
        //                         submitButton.removeAttribute('data-kt-indicator');

        //                         // Enable button
        //                         submitButton.disabled = false;

        //                         // Submit the form programmatically
        //                         var form = document.getElementById(
        //                             "kt_upload_delivery_form"
        //                         );
        //                         console.log('here form', form)


        //                         // Show popup confirmation
        //                         Swal.fire({
        //                             text: "Form has been successfully submitted!",
        //                             icon: "success",
        //                             buttonsStyling: false,
        //                             confirmButtonText: "Ok, got it!",
        //                             customClass: {
        //                                 confirmButton: "btn btn-primary"
        //                             }
        //                         });

        //                         console.log('submitted')
        //                         // form.submit(); // Submit form
        //                     }, 2000);
        //                 } else {
        //                     Swal.fire({
        //                         text: "Sorry, looks like there are some errors detected, please try again.",
        //                         icon: "error",
        //                         buttonsStyling: false,
        //                         confirmButtonText: "Ok, got it!",
        //                         customClass: {
        //                             confirmButton: "btn btn-light"
        //                         }
        //                     });
        //                 }
        //             });
        //         }
        //     });
        // });
    </script>


    <script>
        // $(document).ready(function() {
        //     function reInitializeDataValidation() {
        //         $(".fv-plugins-message-container.invalid-feedback").remove();

        //     }
        //     // Submit button handler
        //     const AppreciationSubmitButton = document.getElementById('re_add_bulk_submit');
        //     AppreciationSubmitButton.addEventListener('click', function(e) {
        //         $(".fv-plugins-message-container.invalid-feedback").remove();
        //         console.log("re")
        //         // Define form element
        //         const addAppreciationForm = document.getElementById('re_add_bulk_form');

        //         // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/

        //         var addAppreciationValidator = FormValidation.formValidation(
        //             addAppreciationForm, {
        //                 fields: {
        //                     'customer[]': {
        //                         validators: {
        //                             notEmpty: {
        //                                 message: 'Customer is required'
        //                             }
        //                         }
        //                     },
        //                     'delivery_address[]': {
        //                         validators: {
        //                             notEmpty: {
        //                                 message: 'Address is required'
        //                             }
        //                         }
        //                     },
        //                     'delivery_slot[]': {
        //                         validators: {
        //                             notEmpty: {
        //                                 message: 'Slot is required'
        //                             }
        //                         }
        //                     },


        //                 },

        //                 plugins: {
        //                     trigger: new FormValidation.plugins.Trigger(),
        //                     bootstrap: new FormValidation.plugins.Bootstrap5({
        //                         rowSelector: '.fv-row',
        //                         eleInvalidClass: '',
        //                         eleValidClass: '',
        //                         // Do not show the error message in default area
        //                         // defaultMessageContainer: false,
        //                     }),
        //                     // Again, remember to register the Tooltip plugin before Icon plugin
        //                     // tooltip: new FormValidation.plugins.Tooltip(),
        //                     // icon: new FormValidation.plugins.Icon({
        //                     //     valid: 'fa fa-check',
        //                     //     invalid: 'fa fa-times',
        //                     //     validating: 'fa fa-refresh'
        //                     // }),
        //                 }
        //             }
        //         );
        //         // Prevent default button action
        //         e.preventDefault();




        //         // Validate form before submit
        //         if (addAppreciationValidator) {
        //             addAppreciationValidator.validate().then(function(status) {
        //                 console.log('validated!');
        //                 if (status == 'Valid') {
        //                     // Show loading indication
        //                     AppreciationSubmitButton.setAttribute('data-kt-indicator', 'on');

        //                     // Disable button to avoid multiple click
        //                     AppreciationSubmitButton.disabled = true;

        //                     // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
        //                     setTimeout(function() {
        //                         // Remove loading indication
        //                         AppreciationSubmitButton.removeAttribute(
        //                             'data-kt-indicator');

        //                         // Enable button
        //                         AppreciationSubmitButton.disabled = false;

        //                         // Show popup confirmation
        //                         // Swal.fire({
        //                         //     text: "Form has been successfully submitted!",
        //                         //     icon: "success",
        //                         //     buttonsStyling: false,
        //                         //     confirmButtonText: "Ok, got it!",
        //                         //     customClass: {
        //                         //         confirmButton: "btn btn-primary"
        //                         //     }
        //                         // });

        //                         addAppreciationForm.submit(); // Submit form
        //                     }, 1500);
        //                 }
        //             });
        //         }


        //     });

        //     var rowCounter = 1;
        //     // Add row when plus button is clicked
        //     $("#add_row").on("click", function() {
        //         let newRow = $("<tr>");
        //         let cols = "";
        //         // Customer
        //         cols += '<td><div class="fv-row">';
        //         cols +=
        //             '<select class="form-select form-control upload-control" name="customer[]" data-control="select2" data-placeholder="Select an option">';
        //         cols += '<option></option>';
        //         cols += '<option value="Cus 1">Cus 1</option>';
        //         cols += '<option value="Cus 2">Cus 2</option>';
        //         cols += '</select>';
        //         cols += '</div></td>';
        //         // Delivery Address
        //         cols += '<td><div class="fv-row">';
        //         cols +=
        //             '<select class="form-select form-control upload-control" name="delivery_address[]" data-control="select2" data-placeholder="Select an option">';
        //         cols += '<option></option>';
        //         cols += '<option value="Addr 1">Addr 1</option>';
        //         cols += '<option value="Addr 2">Addr 2</option>';
        //         cols += '</select>';
        //         cols += '</div></td>';
        //         // Delivery Slot
        //         cols += '<td><div class="fv-row">';
        //         cols +=
        //             '<select class="form-select form-control upload-control" name="delivery_slot[]" data-control="select2" data-placeholder="Select an option">';
        //         cols += '<option></option>';
        //         cols += '<option value="Slot 1">Slot 1</option>';
        //         cols += '<option value="Slot 2">Slot 2</option>';
        //         cols += '</select>';
        //         cols += '</div></td>';
        //         // Item Type
        //         cols +=
        //             '<td><div class="fv-row"><input type="text" class="form-control upload-control" name="item_type[]" ></div></td>';

        //         // Special Instructions
        //         cols +=
        //             '<td><div class="fv-row"><input type="text" class="form-control upload-control" name="special_instructions[]" ></div></td>';
        //         // Notes
        //         cols +=
        //             '<td><div class="fv-row"><input type="text" class="form-control upload-control" name="notes[]" ></div></td>';

        //         // open filed
        //         cols +=
        //             '<td><div class="fv-row"><input type="text" class="form-control upload-control" name="cod_amount[]" ></div></td>';



        //         cols +=
        //             '<td><button class="btn btn-sm btn-danger delete-row" data-toggle="tooltip" data-original-title="Delete Row">-</button></td>';

        //         newRow.append(cols);
        //         $("table").append(newRow);

        //         rowCounter++;
        //         // // Initialize Select2 on the newly added dropdown
        //         $("select[data-control='select2']").select2();
        //         reInitializeDataValidation();
        //     });

        //     // Delete last row when minus button is clicked
        //     $("#delete_row").on("click", function() {
        //         let rowCount = $("table tbody tr").length;
        //         if (rowCount >= 1) {
        //             $("table tbody tr:last").remove();
        //         }
        //         reInitializeDataValidation();
        //     });
        //     // Delete row when delete button is clicked
        //     $(document).on("click", ".delete-row", function() {
        //         $(this).closest("tr").remove();
        //         reInitializeDataValidation();
        //     });


        //     $("#kt_datepicker_3").flatpickr({
        //         enableTime: false,
        //         dateFormat: "Y-m-d",
        //     });
        // });


        // $(document).on("change", "select[name='customer[]']", function() {
        //     var selectedCustomer = $(this).val();
        //     var deliveryAddressDropdown = $(this).closest("tr").find("select[name='delivery_address[]']");

        //     // Fetch delivery addresses via AJAX
        //     $.ajax({
        //         url: "/get-delivery-addresses",
        //         type: "GET",
        //         data: {
        //             customer: selectedCustomer
        //         },
        //         success: function(response) {
        //             deliveryAddressDropdown.empty(); // Clear existing options
        //             deliveryAddressDropdown.append($('<option></option>')); // Add empty option

        //             // Populate delivery addresses
        //             $.each(response.deliveryAddresses, function(index, address) {
        //                 deliveryAddressDropdown.append($('<option></option>').attr('value',
        //                     address).text(address));
        //             });

        //             // Reinitialize Select2 on the updated dropdown
        //             deliveryAddressDropdown.select2();
        //         },
        //         error: function(error) {
        //             console.log(error);
        //         }
        //     });
        // });
    </script>
@endsection
