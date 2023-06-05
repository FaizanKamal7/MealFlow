@extends('fleetservice::layouts.master')
@section('title', 'Maintenance Logs')

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
                        <!--begin::Header-->

                        <div class="card-header pt-5 mb-3">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-gray-800 fs-lg-2x">Vehicles Maintenance</span>

                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->


                            <div class="card-toolbar ">
                                <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                                   data-bs-target="#nixus_add_maintenance_log">Add Vehicle Maintenance</a>
                                <!--end::Daterangepicker-->
                            </div>

                        </div>
                        <!--end::Header-->
                        <div class="card-body">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                <!--begin::Table head-->
                                <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="  pb-3  text-center">Vehicle</th>

                                    <th class="text-end pe-3 min-w-80px">Employee</th>

                                    <th class="text-end pe-3 min-w-100px"> Maintenance Date</th>
                                    <th class="text-end pe-0 min-w-25px"> Maintenance Type</th>

                                    <th class="text-end pe-3 min-w-100px">Cost</th>
                                    <th class="text-end  min-w-80px">Garage</th>


                                </tr>

                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bolder text-gray-600">
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-70px me-3 ">
                                                <img src="{{asset('static/media\Fleet\images-1.jpg')}}" class=""
                                                     alt=""/>
                                                <a href="#"
                                                   class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6">Suzuki</a>


                                            </div>
                                        </div>
                                    </td>

                                    <!--begin::Product ID-->
                                    <td class="text-end">Ahmed</td>
                                    <!--end::Product ID-->

                                    <td class="text-end">02 Apr, 2022</td>
                                    <!--begin::Date added-->
                                    <td class="text-end pe-2">OIL & Filter</td>
                                    <!--end::Date added-->

                                    <!--begin::Price-->

                                    <!--end::Price-->
                                    <!--begin::Status-->
                                    <td class="text-end">
                                        $1,230
                                    </td>
                                    <!--end::Status-->
                                    <!--begin::Qty-->
                                    <td class="text-end pe-1">GH 11</td>

                                    <!--end::Qty-->
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-70px me-3 ">
                                                <img src="{{asset('static/media\Fleet\images-2.jpg')}}" class=""
                                                     alt=""/>
                                                <a href="#"
                                                   class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6">Suzuki</a>


                                            </div>
                                        </div>
                                    </td>

                                    <!--begin::Product ID-->
                                    <td class="text-end">Ahmed</td>
                                    <!--end::Product ID-->

                                    <td class="text-end">02 Apr, 2022</td>
                                    <!--begin::Date added-->
                                    <td class="text-end pe-2">OIL & Filter</td>
                                    <!--end::Date added-->

                                    <!--begin::Price-->

                                    <!--end::Price-->
                                    <!--begin::Status-->
                                    <td class="text-end">
                                        $1,230
                                    </td>
                                    <!--end::Status-->
                                    <!--begin::Qty-->
                                    <td class="text-end pe-1">GH 11</td>

                                    <!--end::Qty-->
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-70px me-3 ">
                                                <img src="{{asset('static/media\Fleet\images-4.jpg')}}" class=""
                                                     alt=""/>
                                                <a href="#"
                                                   class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6">Suzuki</a>


                                            </div>
                                        </div>
                                    </td>

                                    <!--begin::Product ID-->
                                    <td class="text-end">Ahmed</td>
                                    <!--end::Product ID-->

                                    <td class="text-end">02 Apr, 2022</td>
                                    <!--begin::Date added-->
                                    <td class="text-end pe-2">OIL & Filter</td>
                                    <!--end::Date added-->

                                    <!--begin::Price-->

                                    <!--end::Price-->
                                    <!--begin::Status-->
                                    <td class="text-end">
                                        $1,230
                                    </td>
                                    <!--end::Status-->
                                    <!--begin::Qty-->
                                    <td class="text-end pe-1">GH 11</td>

                                    <!--end::Qty-->
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-70px me-3 ">
                                                <img src="{{asset('static/media\Fleet\images-4.jpg')}}" class=""
                                                     alt=""/>
                                                <a href="#"
                                                   class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6">Suzuki</a>


                                            </div>
                                        </div>
                                    </td>

                                    <!--begin::Product ID-->
                                    <td class="text-end">Ahmed</td>
                                    <!--end::Product ID-->

                                    <td class="text-end">02 Apr, 2022</td>
                                    <!--begin::Date added-->
                                    <td class="text-end pe-2">OIL & Filter</td>
                                    <!--end::Date added-->

                                    <!--begin::Price-->

                                    <!--end::Price-->
                                    <!--begin::Status-->
                                    <td class="text-end">
                                        $1,230
                                    </td>
                                    <!--end::Status-->
                                    <!--begin::Qty-->
                                    <td class="text-end pe-1">GH 11</td>

                                    <!--end::Qty-->
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-70px me-3 ">
                                                <img src="{{asset('static/media\Fleet\image-6.png')}}" class="" alt=""/>
                                                <a href="#"
                                                   class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6">Suzuki</a>


                                            </div>
                                        </div>
                                    </td>

                                    <!--begin::Product ID-->
                                    <td class="text-end">Ahmed</td>
                                    <!--end::Product ID-->

                                    <td class="text-end">02 Apr, 2022</td>
                                    <!--begin::Date added-->
                                    <td class="text-end pe-2">OIL & Filter</td>
                                    <!--end::Date added-->

                                    <!--begin::Price-->

                                    <!--end::Price-->
                                    <!--begin::Status-->
                                    <td class="text-end">
                                        $1,230
                                    </td>
                                    <!--end::Status-->
                                    <!--begin::Qty-->
                                    <td class="text-end pe-1">GH 11</td>

                                    <!--end::Qty-->
                                </tr>


                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Tables Widget 9-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->

            <!--end::Row-->


            <!--begin::Modals-->


            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>

    <div class="modal fade" id="nixus_add_maintenance_log" tabindex="-1" aria-hidden="true">
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
                                  transform="rotate(-45 6 17.3137)" fill="currentColor"/>
							<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                  fill="currentColor"/>
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
                    <h1 class="mb-3">Add Vehicle Maintenance</h1>
                    <!--end::Title-->

                </div>
                <!--end::Heading-->

                <!--begin::Modal body-->
                <div class="modal-body  pt-0 ">
                    <!--begin:Form-->
                    <form class="form" action="#" id="nixus_add_maintenance_log_form">
                        <!--begin::Modal header-->

                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body py-10 px-lg-13">
                            <!--begin::Scroll-->
                            <div class="scroll-y me-n7 pe-7" id="nixus_add_maintenance_log_scroll" data-kt-scroll="true"
                                 data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                 data-kt-scroll-dependencies="#nixus_add_maintenance_log_header"
                                 data-kt-scroll-wrappers="#nixus_add_maintenance_log_scroll"
                                 data-kt-scroll-offset="300px">
                                <!--begin::Notice-->
                                <!--begin::Notice-->

                                <!--end::Notice-->
                                <!--end::Notice-->
                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <div class="d-flex flex-column mb-5 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Vehicle</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                   data-bs-toggle="tooltip"></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select data-control="select2" data-placeholder=" Select Vehicle"
                                                    class="form-select form-select-solid" data-control="select2"
                                                    data-dropdown-parent="#nixus_add_maintenance_log">
                                                <option value="">Select a Vehicle...</option>
                                                <option value="AF">Honda</option>
                                                <option value="AF">TOyota</option>

                                            </select>
                                            <!--end::Select-->
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <div class="d-flex flex-column mb-5 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Employee</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select data-placeholder="Select Employee"
                                                    class="form-select form-select-solid" name="Employee"
                                                    data-control="select2"
                                                    data-dropdown-parent="#nixus_add_maintenance_log">
                                                <option value="">Select Employee...</option>
                                                <option value="AF">Sam</option>
                                                <option value="AF">Tom Cruz</option>

                                            </select>
                                            <!--end::Select-->
                                        </div>
                                    </div>

                                    <!--end::Col-->
                                </div>

                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <div class="d-flex flex-column mb-5 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Maintenance type</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select name="Fuel Type" data-control="select2"
                                                    data-dropdown-parent="#nixus_add_maintenance_log"
                                                    data-placeholder="Select a Maintenance Type"
                                                    class="form-select form-select-solid">
                                                <option value="">Select a Fuel Type...</option>
                                                <option value="AF">Oil And Filter</option>
                                                <option value="AF">Tyres check</option>
                                                <option value="AF">Break maintenance.</option>
                                                <option value="AF">Operation Maintenance.</option>

                                            </select>
                                            <!--end::Select-->
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-bold mb-2">Maintenance Date</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">

                                            <!--begin::Datepicker-->
                                            <input class="form-control form-control-solid ps-12"
                                                   placeholder="Select a Maintenance" name="due_date" type="date"/>
                                            <!--end::Datepicker-->
                                        </div>
                                        <!--end::Input-->
                                    </div>


                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">Maintenance Cost</span>
                                        </label>
                                        <!--end::Label-->
                                        <input type="number" class="form-control form-control-solid"
                                               placeholder="Enter Maintenance Cast" name="target_title"/>
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">Garage</span>
                                        </label>
                                        <!--end::Label-->
                                        <input type="text" class="form-control form-control-solid"
                                               placeholder="Enter Garage" name="target_title"/>
                                    </div>


                                </div>
                                <!--end::Input group-->
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Description</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid"
                                           placeholder="Enter Description" name="target_title"/>
                                </div>
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-8">
                                    <label class="fs-6 fw-bold mb-2">Notes</label>
                                    <textarea class="form-control form-control-solid" rows="3" name="target_details"
                                              placeholder="Enter Notes"></textarea>
                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--end::Scroll-->
                        </div>
                        <!--end::Modal body-->
                        <!--begin::Modal footer-->
                        <div class="modal-footer flex-center">
                            <!--begin::Button-->
                            <button type="reset" id="nixus_add_maintenance_log_cancel" class="btn btn-light me-3">
                                Discard
                            </button>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="nixus_add_maintenance_log_submit" class="btn btn-primary">
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


@endsection
