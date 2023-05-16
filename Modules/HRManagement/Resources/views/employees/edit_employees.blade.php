@extends('hrmanagement::layouts.master')
@section('title', 'HR - Employees - Edit')

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
                                <h2>Update Employee Data</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
                                <li class="nav-item">
                                    <a class="nav-link active fw-bold text-black" data-bs-toggle="tab"
                                       href="#re_tab_personal_information">Personal Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold text-black" data-bs-toggle="tab"
                                       href="#re_tab_employment">Employment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold text-black" data-bs-toggle="tab"
                                       href="#re_tab_bank_details">Bank Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold text-black" data-bs-toggle="tab" href="#re_tab_salary">Salary</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold text-black" data-bs-toggle="tab"
                                       href="#re_tab_leave_policy">Leave Policy</a>
                                </li>
                                {{--                                <li class="nav-item">--}}
                                {{--                                    <a class="nav-link fw-bold text-black" data-bs-toggle="tab"--}}
                                {{--                                       href="#re_tab_user_settings">User Settings</a>--}}
                                {{--                                </li>--}}
                                {{--                                <li class="nav-item">--}}
                                {{--                                    <a class="nav-link fw-bold text-black" data-bs-toggle="tab"--}}
                                {{--                                       href="#re_tab_team">Team</a>--}}
                                {{--                                </li>--}}

                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="re_tab_personal_information" role="tabpanel">
                                    <form id="re_add_employee_form_personal_info" name="re_add_employee_form_personal_info" method="post"
                                          class="form"
                                          action="{{ route("hr_employees_personal_information_update") }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="employee_id" id="employee_id" value="{{$employee->id}}">
                                        <div class="row mb-7 justify-content-center">
                                            <div class="col-lg-4 col-sm-6 col-md-6 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="required">First Name</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="first_name" id="first_name"
                                                           value="{{$employee->first_name}}"/>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6 col-md-6 mb-3">
                                                <!--begin::Input group-->
                                                <div class="row justify-content-center">

                                                    <div class="fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-bold form-label">
                                                            <span class="required">Last Name</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid"
                                                               name="last_name" id="last_name"
                                                               value="{{$employee->last_name}}"/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
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
                                                        @if($employee->picture)
                                                            <a href="{{ asset($employee->picture) }}"
                                                               class="text-primary"
                                                               target="_blank">
                                                                View Image
                                                            </a>
                                                        @endif
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="row mb-7 justify-content-center">
                                            <div class="col-lg-4 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Hire Date</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="date" class="form-control form-control-solid"
                                                           name="hire_date" id="hire_date"
                                                           value="{{$employee->hire_date}}"/>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Probation Start Date</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="date" class="form-control form-control-solid"
                                                           name="probation_period_start" id="probation_period_start"
                                                           value="{{$employee->probation_period_start}}"/>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Probation End Date</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="date" class="form-control form-control-solid"
                                                           name="probation_period_end" id="probation_period_end"
                                                           value="{{$employee->probation_period_end}}"/>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-7 justify-content-center">
                                            <div class="col-lg-4 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Country</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select class="form-select form-control form-control-solid"
                                                            name="country" id="country" data-control="select2"
                                                            data-placeholder="Select">
                                                        <option value=""></option>
                                                        <option value="Pakistan"
                                                                @if($employee->country=="Pakistan")selected @endif>
                                                            Pakistan
                                                        </option>
                                                        <option value="United States"
                                                                @if($employee->country=="United States")selected @endif>
                                                            United States
                                                        </option>
                                                        <option value="United Kingdom"
                                                                @if($employee->country=="United Kingdom")selected @endif>
                                                            United Kingdom
                                                        </option>
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label ">
                                                        <span class="">City</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select class="form-select form-control form-control-solid"
                                                            name="city" id="city" data-control="select2"
                                                            data-placeholder="Select">
                                                        <option value=""></option>
                                                        <option value="Islamabad"
                                                                @if($employee->city=="Islamabad")selected @endif>
                                                            Islamabad
                                                        </option>
                                                        <option value="New York"
                                                                @if($employee->city=="New York")selected @endif>New York
                                                        </option>
                                                        <option value="London"
                                                                @if($employee->city=="London")selected @endif>London
                                                        </option>
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Marital Status</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select class="form-select form-control form-control-solid"
                                                            name="marital_status" id="marital_status"
                                                            data-control="select2"
                                                            data-placeholder="Select">
                                                        <option value=""></option>
                                                        <option value="Married"
                                                                @if($employee->marital_status=="Married")selected @endif>
                                                            Married
                                                        </option>
                                                        <option value="Unmarried"
                                                                @if($employee->marital_status=="Unmarried")selected @endif>
                                                            Unmarried
                                                        </option>
                                                        <option value="Divorced"
                                                                @if($employee->marital_status=="Divorced")selected @endif>
                                                            Divorced
                                                        </option>
                                                        <option value="Better Not to Say"
                                                                @if($employee->marital_status=="Better Not to Say")selected @endif>
                                                            Better Not to Say
                                                        </option>
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="row mb-7 justify-content-center">
                                            <div class="col-lg-6 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Personal Email Address</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="personal_email_address" id="personal_email_address"
                                                           value="{{$employee->personal_email_address}}"/>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <!--begin::Input group-->
                                                <div class="row justify-content-center">

                                                    <div class="fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-bold form-label">
                                                            <span class="required">Personal Phone Number</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid"
                                                               name="personal_phone_number" id="personal_phone_number"
                                                               value="{{$employee->personal_phone_number}}"/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="row mb-7 justify-content-center">
                                            <div class="col-lg-6 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="required">Company Email Address</span><i
                                                            class="fas fa-exclamation-circle fs-7"
                                                            data-bs-toggle="tooltip"
                                                            title="User account will be created on this email address."></i>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="company_email_address" id="company_email_address"
                                                           value="{{$employee->company_email_address}}"/>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <!--begin::Input group-->
                                                <div class="row justify-content-center">

                                                    <div class="fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-bold form-label">
                                                            <span class="">Company Phone Number</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid"
                                                               name="company_phone_number" id="company_phone_number"
                                                               value="{{$employee->company_phone_number}}"/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button id="re_add_employee_personal_info_submit" type="submit"
                                                class="btn btn-primary float-end">
                                             <span class="indicator-label">
                                                    Save Personal Information
                                                </span>
                                            <span class="indicator-progress">
                                                Please wait... <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="re_tab_employment" role="tabpanel">
                                    <form id="re_add_employee_form_employment" name="re_add_employee_form_employment" method="post"
                                          class="form"
                                          action="{{ route("hr_employees_employment_update") }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="employee_id" id="employee_id" value="{{$employee->id}}">
                                        <div class="row mb-7">
                                            <div class="col-lg-4 col-sm-6 col-md-6 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="required">Designation</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select class="form-select form-control form-control-solid"
                                                            name="designation" id="designation" data-control="select2"
                                                            data-placeholder="Select">

                                                        @if($employee->designation_id)
                                                            @foreach($designations as $designation)
                                                                <option value="{{ $designation->id }}" @if($employee->designation->id==$designation->id)selected @endif>{{ $designation->name }}</option>
                                                            @endforeach
                                                        @else
                                                            <option value=""></option>
                                                            @foreach($designations as $designation)
                                                                <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6 col-md-6 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Employment Type</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select class="form-select form-control form-control-solid"
                                                            name="employee_type" id="employee_type"
                                                            data-control="select2"
                                                            data-placeholder="Select an option">
                                                        <option value="Full Time" @if($employee->employee_type=="Full Time")selected @endif>Full Time</option>
                                                        <option value="Contracted" @if($employee->employee_type=="Contracted")selected @endif>Contracted</option>
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="row mb-7 @if($employee->employee_type != 'Contracted') d-none @endif"
                                            id="contract_div">
                                            <div class="col-lg-4 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Contract Start Date</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="date" class="form-control form-control-solid"
                                                           name="contract_start_date" id="contract_start_date"
                                                           value="{{$employee->contract_start_date}}"/>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Contract End Date</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="date" class="form-control form-control-solid"
                                                           name="contract_end_date" id="contract_end_date"
                                                           value="{{$employee->contract_end_date}}"/>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <!--begin::Input group-->
                                                <div class="row justify-content-center">
                                                    <div class="fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-bold form-label">
                                                            <span class="">Agreement File</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="file" class="form-control form-control-solid"
                                                               name="agreement_file" id="agreement_file" value=""/>
                                                        @if($employeeMedia)
                                                            <a href="{{asset($employeeMedia->path)}}" class="text-primary"
                                                               target="_blank">
                                                                View Agreement File
                                                            </a>
                                                        @endif

                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!--end::Form-->
                                        <button id="re_add_employee_employment_submit" type="submit"
                                                class="btn btn-primary float-end">
                                             <span class="indicator-label">
                                                    Save Employment
                                                </span>
                                            <span class="indicator-progress">
                                                Please wait... <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="re_tab_bank_details" role="tabpanel">
                                    <form id="re_add_employee_form_bank_detail" name="re_add_employee_form_bank_detail" method="post"
                                          class="form"
                                          action="{{ route("hr_employees_bank_update") }}"
                                          enctype="multipart/form-data">
                                        @csrf

                                        <!--begin::Input group-->
                                        <div class="row mb-7 justify-content-center">
                                            <div class="col-lg-12 col-sm-6 col-md-6 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Bank Name</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="hidden" name="employee_id" id="employee_id"
                                                           value="{{$employee->id}}">
                                                    <!--begin::Input-->

                                                    <input type="text" class="form-control form-control-solid"
                                                           name="bank_name" id="bank_name"
                                                           value="{{$employee->employeeBank->bank_name ?? ""}}"/>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="row mb-7 justify-content-center">
                                            <div class="col-lg-6 col-sm-6 col-md-6 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Account Title</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="account_title" id="account_title"
                                                           value="{{$employee->employeeBank->account_title ?? ""}}"/>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-md-6 mb-3">
                                                <!--begin::Input group-->
                                                <div class="row justify-content-center">

                                                    <div class="fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-bold form-label">
                                                            <span class="">Account Number</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid"
                                                               name="account_number" id="account_number"
                                                               value="{{$employee->employeeBank->account_number ?? ""}}"/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="row mb-7 justify-content-center">
                                            <div class="col-lg-6 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">IBAN</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="iban" id="iban"
                                                           value="{{$employee->employeeBank->iban ?? ""}}"/>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Swift Code</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="swift_code" id="swift_code"
                                                           value="{{$employee->employeeBank->swift_code ?? ""}}"/>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Sort Code</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="sort_code" id="sort_code"
                                                           value="{{$employee->employeeBank->sort_code ?? ""}}"/>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Account Currency</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select class="form-select form-control form-control-solid"
                                                            name="account_currency" id="account_currency"
                                                            data-control="select2"
                                                            data-placeholder="Select">
                                                        <option value=""></option>
                                                        @if($employee->employeeBank)
                                                            <option value="PKR"
                                                                    @if($employee->employeeBank->account_currency == 'PKR') selected @endif>
                                                                PKR
                                                            </option>
                                                        @else
                                                            <option value="PKR">PKR</option>
                                                        @endif
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>
                                            </div>
                                        </div>
                                        <button id="re_add_employee_bank_submit" type="submit"
                                                class="btn btn-primary float-end">
                                             <span class="indicator-label">
                                                    Save Changes
                                                </span>
                                            <span class="indicator-progress">
                                                Please wait... <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>

                                    </form>
                                </div>
                                <div class="tab-pane fade" id="re_tab_salary"
                                     role="tabpanel">
                                    <form id="re_add_employee_form_salary" name="re_add_employee_form_salary" method="post"
                                          class="form"
                                          action="{{ route("hr_employees_salary_update") }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-7 justify-content-center">
                                            <div class="col-lg-4 col-sm-4 col-md-4 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="required">Basic Salary</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="hidden" name="employee_id" id="employee_id"
                                                           value="{{$employee->id}}"/>
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="basic_salary" id="basic_salary"
                                                           value="{{$employee->employeeSalary->basic_salary ?? ""}}"/>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-4 col-md-4 mb-3">
                                                <!--begin::Input group-->
                                                <div class="row justify-content-center">

                                                    <div class="fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-bold form-label">
                                                            <span class="">Salary Cycle</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Select2-->
                                                        <select class="form-select form-control form-control-solid"
                                                                name="cycle" id="cycle" data-control="select2"
                                                                data-placeholder="Select an option">
                                                            <option
                                                                value="{{$employee->employeeSalary->cycle ?? "" }}">{{$employee->employeeSalary->cycle ?? ""}}</option>
                                                            <option value="Weekly">Weekly</option>
                                                            <option value="Monthly">Monthly</option>
                                                            <option value="Yearly">Yearly</option>
                                                        </select>
                                                        <!--begin::Select2-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-4 col-md-4 mb-3">
                                                <!--begin::Input group-->
                                                <div class="row justify-content-center">
                                                    <div class="fv-row">
                                                        <div
                                                            class="form-check form-check-custom form-check-solid mt-10">
                                                            @if($employee->employeeSalary->taxable)
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="1"
                                                                       id="taxable" name="taxable" checked/>
                                                            @else
                                                                <input class="form-check-input" type="checkbox"
                                                                       value="1"
                                                                       id="taxable" name="taxable"/>
                                                            @endif
                                                            <label class="form-check-label " for="taxable">
                                                                Salary is Taxable
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin::Input group-->
                                        <div
                                            class="row mb-7   @if($employee->employeeSalary->taxable == false) d-none @endif"
                                            id="tax_row">
                                            <div class="col-lg-4 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Tax Class</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select class="form-select form-control form-control-solid"
                                                            name="tax_id" id="tax_id" data-control="select2"
                                                            data-placeholder="Select">
                                                        @if($employee->employeeSalary->tax_id != null)
                                                            @foreach($taxes as $tax)
                                                                <option value="{{$tax->id}}" @if($employee->employeeSalary->tax->id==$tax->id)selected @endif>{{$tax->name}}</option>
                                                            @endforeach
                                                        @else
                                                            <option value=""></option>
                                                            @foreach($taxes as $tax)
                                                                <option value="{{$tax->id}}">{{$tax->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>
                                            </div>
                                        </div>
                                        <button id="re_add_employee_salary_submit" type="submit"
                                                class="btn btn-primary float-end">
                                             <span class="indicator-label">
                                                    Save Changes
                                                </span>
                                            <span class="indicator-progress">
                                                Please wait... <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="re_tab_leave_policy" role="tabpanel">
                                    <form id="re_add_employee_form_leave_policy" name="re_add_employee_form_leave_policy" method="post"
                                          class="form"
                                          action="{{ route("hr_employees_leave_policy_update") }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <!--begin::Input group-->
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6 col-md-6 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Leave Policy</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="hidden" name="employee_id" id="employee-id"
                                                           value="{{$employee->id}}">
                                                    <!--begin::Select2-->
                                                    <select class="form-select form-control form-control-solid"
                                                            name="leave_policy" id="leave_policy" data-control="select2"
                                                            data-placeholder="Select">
                                                        <option value=""></option>
                                                        @foreach($leavePolicy as $policy)
                                                            <option value="{{$policy->id}}" @if($employee->leave_policy_id==$policy->id) selected @endif>{{$policy->policy_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>
                                            </div>

                                        </div>

                                        <button id="re_add_employee_submit" type="submit"
                                                class="btn btn-primary float-end">
                                             <span class="indicator-label">
                                                    Save Changes
                                                </span>
                                            <span class="indicator-progress">
                                                Please wait... <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>

                                    </form>
                                </div>

                                {{--                                    <div class="tab-pane fade" id="re_tab_user_settings"--}}
                                {{--                                         role="tabpanel">--}}
                                {{--                                        <div class="row mb-7">--}}
                                {{--                                            <div class="col-lg-6 col-sm-6 col-md-6 mb-3">--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="row">--}}
                                {{--                                                    <div class="fv-row">--}}
                                {{--                                                        <div class="form-check form-check-custom form-check-solid mt-10">--}}
                                {{--                                                            <input class="form-check-input" type="checkbox" value="1"--}}
                                {{--                                                                   id="create_user" name="create_user" />--}}
                                {{--                                                            <label class="form-check-label" for="create_user">--}}
                                {{--                                                                Create User for this Employee--}}
                                {{--                                                            </label>--}}
                                {{--                                                        </div>--}}
                                {{--                                                    </div>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}

                                {{--                                        </div>--}}

                                {{--                                        <!--begin::Input group-->--}}
                                {{--                                        <div class="row mb-7 d-none" id="user_details_div">--}}
                                {{--                                            <div class="col-lg-4 col-sm-4 col-md-4 mb-3">--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="fv-row">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="fs-6 fw-bold form-label">--}}
                                {{--                                                        <span class="required">Email Address</span>--}}
                                {{--                                                    </label>--}}
                                {{--                                                    <!--end::Label-->--}}

                                {{--                                                    <input type="email" name="user_email" id="user_email" class="form-control form-control-solid" disabled style="cursor: not-allowed" value="">--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="col-lg-4 col-sm-4 col-md-4 mb-3">--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="fv-row">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="fs-6 fw-bold form-label">--}}
                                {{--                                                        <span class="">Password </span> <i class="fas fa-exclamation-circle fs-7" data-bs-toggle="tooltip" title="Leave empty if you want to send user a link to set up password"></i>--}}
                                {{--                                                    </label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <input type="password" name="password" id="password" class="form-control form-control-solid">--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}

                                {{--                                        </div>--}}

                                {{--                                    </div>--}}

                                {{--                                    <div class="tab-pane fade" id="re_tab_team" role="tabpanel">--}}
                                {{--                                        <!--begin::Form-->--}}
                                {{--                                        <!--begin::Input group-->--}}
                                {{--                                        <div class="row">--}}
                                {{--                                            <div class="col-lg-6 col-sm-6 col-md-6 mb-3">--}}
                                {{--                                                <div class="fv-row">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="fs-6 fw-bold form-label">--}}
                                {{--                                                        <span class="">Team</span>--}}
                                {{--                                                    </label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Select2-->--}}
                                {{--                                                    <select class="form-select form-control form-control-solid"--}}
                                {{--                                                            name="team" id="team" data-control="select2"--}}
                                {{--                                                            data-placeholder="Select an option">--}}
                                {{--                                                        <option value="">{{$employee->employeeTeams}}</option>--}}
                                {{--                                                        @foreach($teams as $team)--}}
                                {{--                                                            <option value="{{ $team->id }}" >{{ $team->team_name }}</option>--}}
                                {{--                                                        @endforeach--}}
                                {{--                                                    </select>--}}
                                {{--                                                    <!--begin::Select2-->--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}

                                {{--                                        </div>--}}

                                {{--                                        <!--end::Form-->--}}
                                {{--                                    </div>--}}
                                <!--begin::Actions-->

                                <!--end::Actions-->
                            </div>
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
    <script src="{{ asset("static/js/custom/apps/hrm/edit_employees.js") }}"></script>
    <script>
        $("#taxable").change(function () {
            if (this.checked) {
                $("#tax_row").removeClass("d-none");
            } else {
                $("#tax_row").addClass("d-none");
            }
        })
    </script>
    <script>
        $("#create_user").change(function () {
            if (this.checked) {
                $("#user_details_div").removeClass("d-none");
            } else {
                $("#user_details_div").addClass("d-none");
            }
        })
    </script>
    <script>
        $("#employee_type").change(function () {
            var selected_type = $("#employee_type").find(":selected").val();
            if (selected_type === "Contracted") {
                $("#contract_div").removeClass("d-none");
            } else {
                $("#contract_div").addClass("d-none");
            }
        })
    </script>
    <script>

        $(document).ready(function () {
            $('#company_email_address').on('keyup', function () {
                var email = $(this).val();
                $('#user_email').val(email);
            });
        });
    </script>
@endsection
