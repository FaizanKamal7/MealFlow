@extends('hrmanagement::layouts.master')
@section('title', 'HR - Edit Leave')
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
                                <h2>Edit Leave</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">

                            <!--begin::Form-->
                            <form id="re_add_leave_application_form" name="re_add_leave_application_form" method="post"
                                  class="form"
                                  action="{{route('hr_leave_application_update', ["id"=>$leave->id])}}" enctype="multipart/form-data">
                                @csrf
                                <!--begin::Input group-->
                                <div class="row mb-7 justify-content-center">
                                    <div class="col-lg-4 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="required">Employee</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select2-->
                                            <select class="form-select form-control form-control-solid"
                                                    name="employee_id" id="employee_id" data-control="select2"
                                                    data-placeholder="Select an option" disabled
                                                    style="cursor: not-allowed">
                                                @foreach($employees as $employee)
                                                    <option></option>
                                                    <option
                                                        value="{{$employee->id}}"
                                                        @if($employee->id == $leave->employee_id) selected @endif>{{$employee->first_name}} {{$employee->last_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--begin::Select2-->
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="required">Leave Type</span>
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Select2-->
                                            <!--populate Leave Types : But id is Policy Record ID-->
                                            <select class="form-select form-control form-control-solid"
                                                    name="leave_type_id" id="leave_type_id" data-control="select2"
                                                    data-placeholder="Select an option" disabled
                                                    style="cursor: not-allowed">
                                                @foreach($policy_records as $policy_record)
                                                    <option
                                                        value="{{$policy_record->id}}"
                                                        @if($policy_record->id==$leave->leave_policy_record_id) selected @endif>{{$policy_record->leaveType->name}}</option>
                                                @endforeach
                                            </select>
                                            <!--To Populates all L_types : allowed : impact -->
                                            <span id="my_leave_types" class="d-none">
                                                @foreach($policy_records as $policy_record)
                                                    <input type="number" class="d-none"
                                                           id='{{ $policy_record->id . "allowed" }}'
                                                           value="{{$policy_record->allowed}}">
                                                    <input type="number" class="d-none"
                                                           id='{{ $policy_record->id . "impact" }}'
                                                           value="{{$policy_record->impact_on_pay}}">
                                                @endforeach
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="required">Duration</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select2-->
                                            <select class="form-select form-control form-control-solid"
                                                    name="duration" id="duration" data-control="select2"
                                                    data-placeholder="Select an option">
                                                <option value="Half Day" @if($leave->duration == "Half Day")selected @endif>Half day</option>
                                                <option value="Full Day" @if($leave->duration == "Full Day")selected @endif>Full Day</option>
                                                <option value="Multiple Day" @if($leave->duration == "Multiple Day")selected @endif>Multiple day</option>
                                            </select>
                                            <!--begin::Select2-->
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Input group-->
                                <div class="row mb-7 justify-content-center">
                                    <div class="col-lg-4 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="required">Start Date</span>
                                            </label>
                                            <!--end::Label-->
                                            <input type="date" name="start_date" id="start_date"
                                                   class="form-control form-control-solid"
                                                   value="{{ $leave->start_date }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="required">End Date</span>
                                            </label>
                                            <!--end::Label-->
                                            <input type="date" name="end_date" id="end_date"
                                                   class="form-control form-control-solid"
                                                   value="{{ $leave->end_date }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="required">Impact on Pay</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                   name="impact_on_pay" id="impact_on_pay"
                                                   value="{{ $leave->impact_on_pay }}"/>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="text-danger d-none" id="policy_error">Note : This Employee don't have any Leave Policy associated.</span>
                                    <span class="text-danger d-none" id="went_wrong">Note : Something went wrong contact support.</span>
                                    <span class="text-danger d-none" id="over_days">Note : You are not authorized to add leaves more than allowed leaves.</span>

                                </div>
                                <!--begin::Actions-->
                                <button id="re_add_leave_application_submit" type="submit"
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

                    <!--Calculations -->
                    <div class="card card-flush mt-10">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Title-->
                                <h4>Calculations</h4>
                                <!--end::Title-->
                            </div>
                            <!--end::Card title-->
                        </div>
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <table class="table border gy-5 gs-7" id="re_expense_reclaims_table">
                                <!--begin::Table head-->
                                <thead class="bg-light-dark">
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-600 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px">Total Allowed Leaves</th>
                                    <th class="min-w-100px">Consumed Leaves</th>
                                    <th class="min-w-100px">Remaining Leaves</th>
                                    <th class="min-w-100px">Impact Of Current</th>
                                    <th class="min-w-100px">Remaining After Current Impact</th>
                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                <tr>
                                    <td><span id="total_allowed"></span></td>
                                    <td><span id="consumed"></span></td>
                                    <td><span id="remaining"></span></td>
                                    <td><span id="current_impact"></span></td>
                                    <td><span id="remaining_after"></span></td>

                                </tr>
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection

@section('extra_scripts')
    <script src="{{ asset("static/js/custom/apps/hrm/edit_leave_application.js") }}"></script>

@endsection
