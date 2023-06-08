@extends('fleetservice::layouts.master')
@section('title', 'Drivers')

@section("extra_style")
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
                                <div class="position-relative my-1  me-7">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <!-- <span class="svg-icon svg-icon-2 position-absolute top-50 translate-middle-y ms-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                        </svg>
                                    </span> -->
                                    <!--end::Svg Icon-->
                                    <!-- <input type="text" data-kt-table-widget-4="search" class="form-control w-150px fs-7 ps-12" placeholder="Search" style="width: 200px!important;" /> -->
                                </div>
                                <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal" data-bs-target="#nixus_add_new_driver">Add Driver</a>
                                <!--end::Daterangepicker-->

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
                                    <th class="text-center min-w-150px ">Licence No</th>
                                    <th class="text-center min-w-150px">Licence Document</th>
                                    <th class="text-center min-w-150px ">Licence Expiry date</th>
                                    <th class="text-end min-w-100px">Employee</th>
                                    <th class="text-center min-w-100px">Status</th>

                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bolder text-gray-600">
                                <tr data-kt-table-widget-4="subtable_template" class="d-none">
                                    <td colspan="2">
                                        <div class="d-flex align-items-center gap-3">
                                            <a href="#" class="symbol symbol-50px bg-secondary bg-opacity-25 rounded">
                                                <img src="" data-kt-src-path="assets/media/stock/ecommerce/" alt="" data-kt-table-widget-4="template_image" />
                                            </a>
                                            <div class="d-flex flex-column text-muted">
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bolder" data-kt-table-widget-4="template_name">Product name</a>
                                                <div class="fs-7" data-kt-table-widget-4="template_description">Product
                                                    description</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="text-gray-800 fs-7">Cost</div>
                                        <div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_cost">1
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="text-gray-800 fs-7">Qty</div>
                                        <div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_qty">1
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="text-gray-800 fs-7">Total</div>
                                        <div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_total">
                                            name</div>
                                    </td>
                                    <td class="text-end">
                                        <div class="text-gray-800 fs-7 me-3">On hand</div>
                                        <div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_stock">
                                            32</div>
                                    </td>
                                    <td class="text-end">
                                        <div class="text-gray-800 fs-7 me-3">On hand</div>
                                        <div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_Fuel">
                                            32</div>
                                    </td>


                                </tr>





                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-3 ">
                                                <img src="{{asset('static/media/avatars/300-1.jpg')}}" class="" alt="" />


                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6">Ahmed</a>
                                                <span class="text-gray-400 fw-bold d-block fs-7">Ahmed@gmail.com</span>
                                            </div>
                                        </div>
                                    </td>


                                    <!--begin::Product ID-->
                                    <td class="text-center">#AGXG903297</td>
                                    <!--end::Product ID-->
                                    <!--begin::Date added-->
                                    <td class="text-center">KASJKSKLM</td>
                                    <td class="text-center">02 Apr, 2022</td>
                                    <!--begin::Price-->
                                    <td class="text-end">Ali Ahmed</td>
                                    <!--end::Price-->
                                    <!--begin::Status-->
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-primary">Available</span>
                                    </td>
                                    <!--end::Status-->
                                    <!--begin::Qty-->


                                    <!--end::Qty-->
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-3 ">
                                                <img src="{{asset('static/media/avatars/300-11.jpg')}}" class="" alt="" />


                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6">Ahmed</a>
                                                <span class="text-gray-400 fw-bold d-block fs-7">Ahmed@gmail.com</span>
                                            </div>
                                        </div>
                                    </td>


                                    <!--begin::Product ID-->
                                    <td class="text-center">#AGXG903297</td>
                                    <!--end::Product ID-->
                                    <!--begin::Date added-->
                                    <td class="text-center">KASJKSKLM</td>
                                    <td class="text-center">02 Apr, 2022</td>
                                    <!--begin::Price-->
                                    <td class="text-end">Junaid</td>
                                    <!--end::Price-->
                                    <!--begin::Status-->
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-primary">Available</span>
                                    </td>
                                    <!--end::Status-->
                                    <!--begin::Qty-->


                                    <!--end::Qty-->
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-3 ">
                                                <img src="{{asset('static/media/avatars/300-13.jpg')}}" class="" alt="" />


                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6">Ahmed</a>
                                                <span class="text-gray-400 fw-bold d-block fs-7">Ahmed@gmail.com</span>
                                            </div>
                                        </div>
                                    </td>


                                    <!--begin::Product ID-->
                                    <td class="text-center">#AGXG903297</td>
                                    <!--end::Product ID-->
                                    <!--begin::Date added-->
                                    <td class="text-center">KASJKSKLM</td>
                                    <td class="text-center">02 Apr, 2022</td>
                                    <!--begin::Price-->
                                    <td class="text-end">hamza</td>
                                    <!--end::Price-->
                                    <!--begin::Status-->
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-primary">Available</span>
                                    </td>
                                    <!--end::Status-->
                                    <!--begin::Qty-->


                                    <!--end::Qty-->
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-3 ">
                                                <img src="{{asset('static/media/avatars/300-10.jpg')}}" class="" alt="" />


                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6">Ahmed</a>
                                                <span class="text-gray-400 fw-bold d-block fs-7">Ahmed@gmail.com</span>
                                            </div>
                                        </div>
                                    </td>

                                    <!--begin::Product ID-->
                                    <td class="text-center">#AGXG903297</td>
                                    <!--end::Product ID-->
                                    <!--begin::Date added-->
                                    <td class="text-center">KASJKSKLM</td>
                                    <td class="text-center">02 Apr, 2022</td>
                                    <!--begin::Price-->
                                    <td class="text-end">Ali Ahmed</td>
                                    <!--end::Price-->
                                    <!--begin::Status-->
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-primary">Available</span>
                                    </td>
                                    <!--end::Status-->
                                    <!--begin::Qty-->


                                    <!--end::Qty-->
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-3 ">
                                                <img src="{{asset('static/media/avatars/300-13.jpg')}}" class="" alt="" />


                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6">Ahmed</a>
                                                <span class="text-gray-400 fw-bold d-block fs-7">Ahmed@gmail.com</span>
                                            </div>
                                        </div>
                                    </td>


                                    <!--begin::Product ID-->
                                    <td class="text-center">#AGXG903297</td>
                                    <!--end::Product ID-->
                                    <!--begin::Date added-->
                                    <td class="text-center">KASJKSKLM</td>
                                    <td class="text-center">02 Apr, 2022</td>
                                    <!--begin::Price-->
                                    <td class="text-end">Ali Ahmed</td>
                                    <!--end::Price-->
                                    <!--begin::Status-->
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-primary">Available</span>
                                    </td>
                                    <!--end::Status-->
                                    <!--begin::Qty-->


                                    <!--end::Qty-->
                                </tr>







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
							<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
							<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
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
                    <form class="form" action="#" id="nixus_add_new_driver_form">
                        <!--begin::Modal header-->

                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body py-10 px-lg-13">
                            <!--begin::Scroll-->
                            <div class="scroll-y me-n7 pe-7" id="nixus_add_new_driver_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#nixus_add_new_driver_header" data-kt-scroll-wrappers="#nixus_add_new_driver_scroll" data-kt-scroll-offset="300px">
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
                                                <select id="employee" class="form-select form-select-solid" name="Employee1" data-placeholder="Select Employee">
                                                    <option></option>
                                                    <option value="0" data-kt-rich-content-subcontent="asad@gmail.com" data-kt-rich-content-icon="{{ asset('static/media/avatars/300-6.jpg') }}">Asad</option>
                                                    <option value="1" data-kt-rich-content-subcontent="ahmed@gmail.com" data-kt-rich-content-icon="{{ asset('static/media/avatars/300-7.jpg') }}">Ahmed</option>
                                                </select>

                                            </div>
                                            <!--end::Select-->
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->




                                    <!--end::Col-->
                                </div>

                                <div class="row g-9 mb-10">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">Licence Number</span>
                                        </label>
                                        <!--end::Label-->
                                        <input type="text" class="form-control form-control-solid" placeholder="Enter Licence Number" name="Licence" />
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">Licence Document</span>
                                        </label>
                                        <!--end::Label-->
                                        <input type="file" class="form-control form-control-solid" placeholder="Enter Licence Document" name="Licence_Document" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row g-9 mb-10">


                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-bold mb-2">Licence Expiry Date</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">

                                            <!--begin::Datepicker-->
                                            <input class="form-control form-control-solid ps-12" placeholder="Select a date" name="licence_Date" type="date" />
                                            <!--end::Datepicker-->
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">Experience</span>
                                        </label>
                                        <!--end::Label-->
                                        <input type="text" class="form-control form-control-solid" placeholder="Enter Experience " name="Experience" />
                                    </div>

                                </div>
                                <div class="d-flex flex-stack mb-8">
                                    <!--begin::Label-->
                                    <div class="me-5">

									<span>

										<label class="form-check form-switch form-check-custom form-check-solid">
											<input class="form-check-input mx-4" type="checkbox" value="1" checked="checked" /><span class="fs-6 fw-bold">Is Available</span>

										</label>
                                    </span>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Switch-->

                                    <!--end::Switch-->
                                </div>


                            </div>
                            <!--end::Scroll-->
                        </div>
                        <!--end::Modal body-->
                        <!--begin::Modal footer-->
                        <div class="modal-footer flex-center">
                            <!--begin::Button-->
                            <button type="reset" id="nixus_add_new_driver_cancel" class="btn btn-light me-3">Discard</button>
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
    <script src="{{ asset('static/js/custom/utilities/modals/drivers.js') }}"></script>
    <script>

    </script>
@endsection
