@extends('hrmanagement::layouts.master')
@section('title', 'HR - Add New Policy')

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
                                <h2>Add New Policy</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">

                            <!--begin::Form-->
                            <form id="re_add_leave_policy_form" name="re_add_leave_policy_form" method="post"
                                  class="form"
                                  action="{{route('hr_leave_policy_store')}}" enctype="multipart/form-data">
                                @csrf
                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <div class="col-lg-4 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="required">Policy Name</span>
                                            </label>
                                            <!--end::Label-->
                                           <input type="text" name="policy_name" id="policy_name" class="form-control form-control-solid">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="required">Description</span>
                                            </label>
                                            <!--end::Label-->
                                            <input type="text" name="description" id="description" class="form-control form-control-solid">
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Input group-->
                                <div class="row mb-7 justify-content-center" id="re_leave_type_repeater">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="kt_docs_repeater_basic">
                                            <div data-repeater-item>
                                                <div class="form-group row">
                                                    <div class="col-lg-4 mb-3">
                                                        <div class="fv-row">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label">
                                                                <span class="required">Leave Type</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Select2-->
                                                            <select class="form-select form-control form-control-solid"
                                                                    name="leave_type_id" id="leave_type_id" data-control="select2"
                                                                    data-placeholder="Select an option">
                                                                <option></option>
                                                                @foreach($leave_types as $leaveType)
                                                                <option value="{{$leaveType->id}}">{{$leaveType->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <!--begin::Select2-->
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 mb-3">
                                                        <div class="fv-row">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label">
                                                                <span class="required">Allowed</span>
                                                            </label>
                                                            <!--end::Label-->
                                                          <input type="text" class="form-control form-control-solid" name="allowed" id="allowed">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 mb-3">
                                                        <div class="fv-row">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label">
                                                                <span class="required">Impact on Pay</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <input type="text" class="form-control form-control-solid" name="impact_on_pay" id="impact_on_pay">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                            <i class="la la-trash-o"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Form group-->

                                    <!--begin::Form group-->
                                    <div class="form-group mt-5">
                                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                            <i class="la la-plus"></i>Add
                                        </a>
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <!--begin::Actions-->
                                <button id="re_add_leave_policy_submit" type="submit"
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
    <script src="{{ asset("static/js/custom/apps/hrm/add_leave_policy.js") }}"></script>
    <script src="{{ asset("static/plugins/custom/formrepeater/formrepeater.bundle.js") }}"></script>

    <script>
        $('#re_leave_type_repeater').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    </script>


@endsection
