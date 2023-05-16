@extends('hrmanagement::layouts.master')
@section('title', 'HR -  Add New Appreciation')

@section('main_content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
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
                                <h2>Add New Appreciation</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <div class="separator"></div>
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Form-->
                            <form id="re_add_appreciation_form" name="re_add_appreciation_form" method="post"
                                  class="form"
                                  action="" enctype="multipart/form-data">
                                @csrf


                                <div class="row mb-3 justify-content-center">
                                    <div class="col-lg-6 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="required">Employee</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select2-->
                                            <select class="form-select form-control form-control-solid"
                                                    name="employee_id" id="employee_id" data-control="select2"
                                                    data-placeholder="Select an option">
                                                <option></option>
                                                <option value="Pakistan" selected>Pakistan</option>
                                            </select>
                                            <!--begin::Select2-->
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label ">
                                                <span class="required">Award</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select2-->
                                            <select class="form-select form-control form-control-solid"
                                                    name="award_id" id="award_id" data-control="select2"
                                                    data-placeholder="Select an option">
                                                <option></option>
                                                <option value="Islamabad" selected>Islamabad</option>
                                            </select>
                                            <!--begin::Select2-->
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-6 col-md-6 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="">Bonus Amount</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                   name="amount" id="amount" value=""/>
                                            <!--end::Input-->
                                        </div>
                                    </div>

                                </div>


                                <!--begin::Input group-->
                                <div class="row mb-3 justify-content-center">
                                    <div class="col-lg-6 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="required">Date</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="date" class="form-control form-control-solid"
                                                   name="date" id="date" value=""/>
                                            <!--end::Input-->
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <!--begin::Input group-->
                                        <div class="row justify-content-center">

                                            <div class="fv-row">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold form-label">
                                                    <span class="">Picture</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="file" class="form-control form-control-solid"
                                                       name="picture" id="picture" value=""/>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <div class="col-lg-12 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="">Note</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                           <textarea class="form-control form-control-solid" name="note" id="note"></textarea>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                </div>

                                <!--begin::Actions-->
                                <button id="re_add_appreciation_submit" type="submit"
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
                <!--end::Content-->


            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection

@section('extra_scripts')
    <script src="{{ asset("static/js/custom/apps/hrm/add_appreciation.js") }}"></script>

@endsection
