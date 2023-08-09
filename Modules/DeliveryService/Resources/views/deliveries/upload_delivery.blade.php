@extends('businessservice::layouts.master')
@section('title', 'Upload Deliveries')

@section('extra_style')
{{--<link href="{{ asset('static/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css/">--}}
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
                                <h2>Upload Deliveries</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Card title-->
                            <div class="">
                                <a href="#uploadByExcel" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#nixus_modal_upload_excel"><i class="fa fa-file-excel"></i> Upload By Excel</a>
                                <button class="btn btn-sm btn-primary mx-1"
                                        data-toggle="tooltip"
                                        title="Add Row" id="add_row">+
                                </button>
{{--                                <button class="btn btn-sm btn-danger"--}}
{{--                                        data-toggle="tooltip"--}}
{{--                                        title="Delete Row" id="delete_row">---}}
{{--                                </button>--}}
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Form-->
                            <form id="re_add_bulk_form" name="re_add_bulk_form" method="post"
                                  class="form"
                                  action="{{ route("upload_deliveries_by_form") }}" enctype="multipart/form-data">
                                @csrf

                                <!--begin::Table-->
                                <table class="table border gy-5 gs-7 table-responsive" id="re_bulk_table">
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


    <!--begin::Modal - Upload By Excel-->
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
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
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
{{--                    <form id="nixus_modal_upload_excel_form" class="form" action="#">--}}
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Upload By Excel</h1>
                            <!--end::Title-->
                            <!--begin::Description-->
                            <div class="text-muted fw-bold fs-5">Please first download prefilled template by providing no. of deliveries you want to upload.
                             </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Heading-->
                        <form method="get" action="{{ route("generate_delivery_template") }}">
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Total No. of Deliveries</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify total deliveries you want to upload."></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input group-->
                            <div class="input-group mb-5">
                                <input type="text" class="form-control form-control-solid" placeholder="Enter total deliveries" name="total_deliveries"  aria-describedby="basic-addon2"/>
                                <button type="submit" class="input-group-text btn-primary" id="basic-addon2">
        <i class="fa fa-file-download fs-4 text-white"></i>
    </button>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Input group-->
                        </form>
                    <form method="post" action="{{ route("upload_deliveries_by_excel") }}" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Excel File</label>
                            <input type="file" class="form-control form-control-solid" placeholder="Select excel file" name="excel_file"/>

                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="nixus_modal_upload_excel_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="nixus_modal_upload_excel_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>

{{--                    </form>--}}
{{--                    <!--end:Form-->--}}
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
{{--<script src="{{ asset('static/plugins/custom/documentation/general/datatables/datatables.bundle.js')}}"></script>--}}
{{-- <script src="{{ asset('static/js/custom/documentation/general/datatables/subtable.js')}}"></script> --}}
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
</script>
@endsection
