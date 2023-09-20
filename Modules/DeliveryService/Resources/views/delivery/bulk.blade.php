@extends('hrmanagement::layouts.master')
@section('title', 'Delivery -Bulk Add')
@section('extra_style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main_content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                    <!--begin::form card-->
                    <div class="card card-flush">
                        <!--begin::Card header-->
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Title-->
                                <h2> Bulk</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Card title-->
                            <div class="">
                                <button class="btn btn-sm btn-primary mx-1"
                                        data-toggle="tooltip"
                                        title="Add Row" id="add_row">+
                                </button>
                                <button class="btn btn-sm btn-danger"
                                        data-toggle="tooltip"
                                        title="Delete Row" id="delete_row">-
                                </button>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Form-->
                            <form id="re_add_bulk_form" name="re_add_bulk_form" method="post"
                                  class="form"
                                  action="{{ route('bulk_delivery_add') }}" enctype="multipart/form-data">
                                @csrf

                                <!--begin::Table-->
                                <table class="table border gy-5 gs-7" id="re_bulk_table">
                                    <!--begin::Table head-->
                                    <thead class="bg-light-dark">
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-600 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px">Customer</th>
                                        <th class="min-w-125px">Delivery Address</th>
                                        <th class="min-w-125px">Delivery Slot</th>
                                        <th class="min-w-125px">Item Type</th>
                                        <th class="min-w-125px">Instructions</th>
                                        <th class="min-w-125px">Notes</th>
                                        <th class="min-w-125px">COD Amount</th>
                                        <th class="text-center min-w-100px">Actions</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->

                                <!--begin::Actions-->
                                <button id="re_add_bulk_submit" type="submit"
                                        class="btn btn-primary float-end">
                                             <span class="indicator-label">
                                                    Save Changes
                                                </span>
                                    <span class="indicator-progress">
                                                Please wait... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                </button>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::form card-->
                </div>
            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection

@section('extra_scripts')
    <script>
        $(document).ready(function () {
            function reInitializeDataValidation(){
                $(".fv-plugins-message-container.invalid-feedback").remove();

            }
            // Submit button handler
            const AppreciationSubmitButton = document.getElementById('re_add_bulk_submit');
            AppreciationSubmitButton.addEventListener('click', function (e) {
                $(".fv-plugins-message-container.invalid-feedback").remove();
                console.log("re")
                // Define form element
                const addAppreciationForm = document.getElementById('re_add_bulk_form');

                // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/

                var addAppreciationValidator = FormValidation.formValidation(
                    addAppreciationForm,
                    {
                        fields: {
                            'customer[]': {
                                validators: {
                                    notEmpty: {
                                        message: 'Customer is required'
                                    }
                                }
                            },
                            'delivery_address[]': {
                                validators: {
                                    notEmpty: {
                                        message: 'Address is required'
                                    }
                                }
                            },
                            'delivery_slot[]': {
                                validators: {
                                    notEmpty: {
                                        message: 'Slot is required'
                                    }
                                }
                            },


                        },

                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: '.fv-row',
                                eleInvalidClass: '',
                                eleValidClass: '',
                                // Do not show the error message in default area
                                // defaultMessageContainer: false,
                            }),
                            // Again, remember to register the Tooltip plugin before Icon plugin
                            // tooltip: new FormValidation.plugins.Tooltip(),
                            // icon: new FormValidation.plugins.Icon({
                            //     valid: 'fa fa-check',
                            //     invalid: 'fa fa-times',
                            //     validating: 'fa fa-refresh'
                            // }),
                        }
                    }
                );
                // Prevent default button action
                e.preventDefault();




                // Validate form before submit
                if (addAppreciationValidator) {
                    addAppreciationValidator.validate().then(function (status) {
                        console.log('validated!');
                        if (status == 'Valid') {
                            // Show loading indication
                            AppreciationSubmitButton.setAttribute('data-kt-indicator', 'on');

                            // Disable button to avoid multiple click
                            AppreciationSubmitButton.disabled = true;

                            // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            setTimeout(function () {
                                // Remove loading indication
                                AppreciationSubmitButton.removeAttribute('data-kt-indicator');

                                // Enable button
                                AppreciationSubmitButton.disabled = false;

                                // Show popup confirmation
                                // Swal.fire({
                                //     text: "Form has been successfully submitted!",
                                //     icon: "success",
                                //     buttonsStyling: false,
                                //     confirmButtonText: "Ok, got it!",
                                //     customClass: {
                                //         confirmButton: "btn btn-primary"
                                //     }
                                // });

                                addAppreciationForm.submit(); // Submit form
                            }, 1500);
                        }
                    });
                }


            });

            var rowCounter = 1;
            // Add row when plus button is clicked
            $("#add_row").on("click", function () {
                let newRow = $("<tr>");
                let cols = "";
                // Customer
                cols += '<td><div class="fv-row">';
                cols += '<select class="form-select form-control" name="customer[]" data-control="select2" data-placeholder="Select an option">';
                cols += '<option></option>';
                cols += '<option value="Cus 1">Cus 1</option>';
                cols += '<option value="Cus 2">Cus 2</option>';
                cols += '</select>';
                cols += '</div></td>';
                // Delivery Address
                cols += '<td><div class="fv-row">';
                cols += '<select class="form-select form-control" name="delivery_address[]" data-control="select2" data-placeholder="Select an option">';
                cols += '<option></option>';
                cols += '<option value="Addr 1">Addr 1</option>';
                cols += '<option value="Addr 2">Addr 2</option>';
                cols += '</select>';
                cols += '</div></td>';
                // Delivery Slot
                cols += '<td><div class="fv-row">';
                cols += '<select class="form-select form-control" name="delivery_slot[]" data-control="select2" data-placeholder="Select an option">';
                cols += '<option></option>';
                cols += '<option value="Slot 1">Slot 1</option>';
                cols += '<option value="Slot 2">Slot 2</option>';
                cols += '</select>';
                cols += '</div></td>';
                // Item Type
                cols += '<td><div class="fv-row"><input type="text" class="form-control" name="item_type[]" ></div></td>';

                // Special Instructions
                cols += '<td><div class="fv-row"><input type="text" class="form-control" name="special_instructions[]" ></div></td>';
                // Notes
                cols += '<td><div class="fv-row"><input type="text" class="form-control" name="notes[]" ></div></td>';

                // open filed
                cols += '<td><div class="fv-row"><input type="text" class="form-control" name="cod_amount[]" ></div></td>';



                cols += '<td><button class="btn btn-sm btn-danger delete-row" data-toggle="tooltip" data-original-title="Delete Row">-</button></td>';

                newRow.append(cols);
                $("table").append(newRow);

                rowCounter++;
                // // Initialize Select2 on the newly added dropdown
                $("select[data-control='select2']").select2();
                reInitializeDataValidation();
            });

            // Delete last row when minus button is clicked
            $("#delete_row").on("click", function () {
                let rowCount = $("table tbody tr").length;
                if (rowCount >= 1) {
                    $("table tbody tr:last").remove();
                }
                reInitializeDataValidation();
            });
            // Delete row when delete button is clicked
            $(document).on("click", ".delete-row", function () {
                $(this).closest("tr").remove();
                reInitializeDataValidation();
            });



        });

        //Update customer addresses dropdown
        $("select[name='customer[]']").change(function(){
            console.log("im here");
        });
        $(document).on("change", "select[name='customer[]']", function() {
            console.log("im here");
            var selectedCustomer = $(this).val();
            var deliveryAddressDropdown = $(this).closest("tr").find("select[name='delivery_address[]']");

            deliveryAddressDropdown.empty(); // Clear existing options
            deliveryAddressDropdown.append($('<option></option>')); // Add empty option
            deliveryAddressDropdown.append($('<option></option>').attr('value', "abc").text("abc"));
            deliveryAddressDropdown.select2();
            // Fetch delivery addresses via AJAX
            // $.ajax({
            //     url: "/get-delivery-addresses",
            //     type: "GET",
            //     data: { customer: selectedCustomer },
            //     success: function(response) {
            //         deliveryAddressDropdown.empty(); // Clear existing options
            //         deliveryAddressDropdown.append($('<option></option>')); // Add empty option
            //
            //         // Populate delivery addresses
            //         $.each(response.deliveryAddresses, function(index, address) {
            //             deliveryAddressDropdown.append($('<option></option>').attr('value', address).text(address));
            //         });
            //
            //         // Reinitialize Select2 on the updated dropdown
            //         deliveryAddressDropdown.select2();
            //     },
            //     error: function(error) {
            //         console.log(error);
            //     }
            // });
        });
    </script>
@endsection
