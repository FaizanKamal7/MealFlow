@extends('fleetservice::layouts.master')
@section('title', 'Drivers')

@section('extra_style')
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
                                <span class="card-label fw-bolder text-gray-800 fs-lg-2x">Price Calculator</span>

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

                                <!--end::Daterangepicker-->

                            </div>

                        </div>

                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-2">
                            <form>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="d-flex flex-column mb-5 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Country</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <div class="border rounded">
                                                <select id="employee" class="form-select form-select-solid"
                                                        name="Employee1" data-placeholder="Select Employee">

                                                    <option value="UAE">UAE</option>
                                                </select>

                                            </div>
                                            <!--end::Select-->
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="d-flex flex-column mb-5 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">State</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <div class="border rounded">
                                                <select id="employee" class="form-select form-select-solid"
                                                        name="Employee1" data-placeholder="Select Employee">
                                                    <option value="Dubai">Dubai</option>

                                                </select>

                                            </div>
                                            <!--end::Select-->
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="d-flex flex-column mb-5 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">City</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <div class="border rounded">
                                                <select id="employee" class="form-select form-select-solid"
                                                        name="Employee1" data-placeholder="Select Employee">

                                                    <option value="Dubai">Dubai</option>

                                                </select>

                                            </div>
                                            <!--end::Select-->
                                        </div>
                                    </div>

                                    <div class="col-lg-3 mt-9">
                                        <button  class="btn btn-primary er fs-6 px-8 py-4"
                                           >Calculate Price</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Tables Widget 9-->
                </div>
                <!--end::Col-->

                <div class="col-xl-12">
                    <!--begin::Accordion-->
                    <div class="accordion" id="kt_accordion_1">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="kt_accordion_1_header_1">
                                <button class="accordion-button fs-4 fw-bold collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#kt_accordion_1_body_1" aria-expanded="true"
                                        aria-controls="kt_accordion_1_body_1">
                                    Delivery Slot (6AM-10AM)
                                    <div class="form-check form-check-custom form-check-solid ms-auto">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Select Slot
                                        </label>
                                    </div>
                                </button>
                            </h2>
                            <div id="kt_accordion_1_body_1" class="accordion-collapse collapse"
                                 aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                                <div class="accordion-body">
                                    <table class="table align-middle table-row-dashed fs-6 gy-3">
                                        <thead class="thead-dark">
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th>No. of Deliveries</th>
                                            <th>Price</th>
                                        </tr>
                                        </thead>
                                        <tbody class="tab">
                                        <tr>
                                            <td>10-20/ Day</td>
                                            <td>10 AED / Delivery</td>
                                        </tr>
                                        <tr>
                                            <td>20-30/ Day</td>
                                            <td>20 AED / Delivery</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="kt_accordion_1_header_2">
                                <button class="accordion-button fs-4 fw-bold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_2"
                                        aria-expanded="false" aria-controls="kt_accordion_1_body_2">
                                    Delivery Slot (11AM-3PM)
                                    <div class="form-check form-check-custom form-check-solid ms-auto">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Select Slot
                                        </label>
                                    </div>
                                </button>
                            </h2>
                            <div id="kt_accordion_1_body_2" class="accordion-collapse collapse"
                                 aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                                <div class="accordion-body">
                                    <table class="table align-middle table-row-dashed fs-6 gy-3">
                                        <thead class="thead-dark">
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th>No. of Deliveries</th>
                                            <th>Price</th>
                                        </tr>
                                        </thead>
                                        <tbody class="tab">
                                        <tr>
                                            <td>10-20/ Day</td>
                                            <td>10 AED / Delivery</td>
                                        </tr>
                                        <tr>
                                            <td>20-30/ Day</td>
                                            <td>20 AED / Delivery</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="kt_accordion_1_header_3">
                                <button class="accordion-button fs-4 fw-bold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_3"
                                        aria-expanded="false" aria-controls="kt_accordion_1_body_3">
                                    Delivery Slot (4PM-10PM)
                                    <div class="form-check form-check-custom form-check-solid ms-auto">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Select Slot
                                        </label>
                                    </div>
                                </button>
                            </h2>
                            <div id="kt_accordion_1_body_3" class="accordion-collapse collapse"
                                 aria-labelledby="kt_accordion_1_header_3" data-bs-parent="#kt_accordion_1">
                                <div class="accordion-body">
                                    <table class="table align-middle table-row-dashed fs-6 gy-3">
                                        <thead class="thead-dark">
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th>No. of Deliveries</th>
                                            <th>Price</th>
                                        </tr>
                                        </thead>
                                        <tbody class="tab">
                                        <tr>
                                            <td>10-20/ Day</td>
                                            <td>10 AED / Delivery</td>
                                        </tr>
                                        <tr>
                                            <td>20-30/ Day</td>
                                            <td>20 AED / Delivery</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Accordion-->
                </div>
            </div>

        </div>
        <!--end::Container-->
    </div>


    <!--end::Post-->
@endsection

@section('extra_scripts')
    <script src="{{ asset('static/js/custom/apps/fleet/add_driver.js') }}"></script>
@endsection

