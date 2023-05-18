@extends('hrmanagement::layouts.master')
@section('title', 'HR - Employees - Add New')

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
                                <h2>Add New Employee</h2>
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
                                <li class="nav-item">
                                    <a class="nav-link fw-bold text-black" data-bs-toggle="tab"
                                       href="#re_tab_user_settings">User Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold text-black" data-bs-toggle="tab"
                                       href="#re_tab_team">Team</a>
                                </li>

                            </ul>
                            <!--begin::Form-->
                            <form id="re_add_employee_form" name="re_add_employee_form" method="post"
                                  class="form"
                                  action="{{ route("hr_employees_store") }}" enctype="multipart/form-data">
                                @csrf
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="re_tab_personal_information"
                                         role="tabpanel">
                                        <!--begin::Input group-->
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
                                                           name="first_name" id="first_name" value=""/>
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
                                                               name="last_name" id="last_name" value="" />
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
                                                           name="hire_date" id="hire_date" value=""/>
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
                                                           value=""/>
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
                                                           value=""/>
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
                                                            data-placeholder="Select an option">
                                                        <option></option>
                                                        <option value="Pakistan" selected>Pakistan</option>
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
                                                            data-placeholder="Select an option">
                                                        <option></option>
                                                        <option value="Islamabad" selected>Islamabad</option>
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
                                                            data-placeholder="Select an option" >
                                                        <option></option>
                                                        <option value="Married">Married</option>
                                                        <option value="Unmarried">Unmarried</option>
                                                        <option value="Divorced">Divorced</option>
                                                        <option value="Better Not to Say">Better Not to Say</option>
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
                                                           value=""/>
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
                                                               value=""/>
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
                                                        <span class="required">Company Email Address</span><i class="fas fa-exclamation-circle fs-7" data-bs-toggle="tooltip" title="User account will be created on this email address."></i>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="company_email_address" id="company_email_address"
                                                           value=""/>
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
                                                               value=""/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="re_tab_employment" role="tabpanel">
                                        <!--begin::Form-->
                                        <!--begin::Input group-->
                                        <div class="row mb-7">
                                            <div class="col-lg-4 col-sm-6 col-md-6 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="required">Department</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select class="form-select form-control form-control-solid"
                                                            name="department[]" id="department" data-control="select2"
                                                            data-placeholder="Select an option" multiple>
                                                        <option></option>
                                                        @foreach($departments as $department)
                                                        <option value="{{ $department->id }}" >{{ $department->department_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>
                                            </div>
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
                                                            data-placeholder="Select an option">
                                                        <option></option>
                                                        @foreach($designations as $designation)
                                                            <option value="{{ $designation->id }}" >{{ $designation->name }}</option>
                                                        @endforeach
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
                                                            name="employee_type" id="employee_type" data-control="select2"
                                                            data-placeholder="Select an option">
                                                        <option></option>
                                                        <option value="Full Time">Full Time</option>
                                                        <option value="Contracted">Contracted</option>
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>
                                            </div>
                                        </div>

                                        <!--begin::Input group-->
                                        <div class="row mb-7 d-none" id="contract_div">
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
                                                           value=""/>
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
                                                           value=""/>
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
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <!--end::Form-->
                                    </div>

                                    <div class="tab-pane fade" id="re_tab_bank_details"
                                         role="tabpanel">
                                        <!--begin::Input group-->
                                        <div class="row mb-7 justify-content-center">
                                            <div class="col-lg-12 col-sm-6 col-md-6 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Bank Name</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="bank_name" id="bank_name" value=""/>
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
                                                           name="account_title" id="account_title" value=""/>
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
                                                               name="account_number" id="account_number" value=""/>
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
                                                           name="iban" id="iban" value=""/>
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
                                                           name="swift_code" id="swift_code" value=""/>
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
                                                           name="sort_code" id="sort_code" value=""/>
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
                                                        <option value="PKR" >PKR</option>
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="tab-pane fade" id="re_tab_salary"
                                         role="tabpanel">
                                        <div class="row mb-7 justify-content-center">
                                            <div class="col-lg-4 col-sm-4 col-md-4 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="required">Basic Salary</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="basic_salary" id="basic_salary" value=""/>
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
                                                            <option></option>
                                                            <option value="Weekly">Weekly</option>
                                                            <option value="Monthly" selected>Monthly</option>
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
                                                        <div class="form-check form-check-custom form-check-solid mt-10">
                                                            <input class="form-check-input" type="checkbox" value="1"
                                                                   id="taxable" name="taxable" />
                                                            <label class="form-check-label" for="taxable">
                                                                Salary is Taxable
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="row mb-7 d-none" id="tax_row">
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
                                                            data-placeholder="Select an option">
                                                        @foreach($taxes as $tax)
                                                        <option></option>
                                                        <option value="{{$tax->id}}">{{$tax->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="re_tab_leave_policy" role="tabpanel">
                                        <!--begin::Form-->
                                        <!--begin::Input group-->
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6 col-md-6 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Leave Policy</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select class="form-select form-control form-control-solid"
                                                            name="leave_policy" id="leave_policy" data-control="select2"
                                                            data-placeholder="Select an option">
                                                        @foreach($leavePolicy as $policy)
                                                        <option></option>
                                                        <option value="{{$policy->id}}" >{{$policy->policy_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>
                                            </div>

                                        </div>

                                        <!--end::Form-->
                                    </div>

                                    <div class="tab-pane fade" id="re_tab_user_settings"
                                         role="tabpanel">
                                        <div class="row mb-7">
                                            <div class="col-lg-6 col-sm-6 col-md-6 mb-3">
                                                <!--begin::Input group-->
                                                <div class="row">
                                                    <div class="fv-row">
                                                        <div class="form-check form-check-custom form-check-solid mt-10">
                                                            <input class="form-check-input" type="checkbox" value="1"
                                                                   id="create_user" name="create_user" />
                                                            <label class="form-check-label" for="create_user">
                                                                Create User for this Employee
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <!--begin::Input group-->
                                        <div class="row mb-7 d-none" id="user_details_div">
                                            <div class="col-lg-4 col-sm-4 col-md-4 mb-3">
                                                <!--begin::Input group-->
                                                    <div class="fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-bold form-label">
                                                            <span class="required">Email Address</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="email" name="user_email" id="user_email" class="form-control form-control-solid" disabled style="cursor: not-allowed">
                                                    </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-4 col-md-4 mb-3">
                                                <!--begin::Input group-->
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Password </span> <i class="fas fa-exclamation-circle fs-7" data-bs-toggle="tooltip" title="Leave empty if you want to send user a link to set up password"></i>
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="password" name="password" id="password" class="form-control form-control-solid">
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="re_tab_team" role="tabpanel">
                                        <!--begin::Form-->
                                        <!--begin::Input group-->
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6 col-md-6 mb-3">
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span class="">Team</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select class="form-select form-control form-control-solid"
                                                            name="team" id="team" data-control="select2"
                                                            data-placeholder="Select an option">
                                                        <option></option>
                                                        @foreach($teams as $team)
                                                            <option value="{{ $team->id }}" >{{ $team->team_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>
                                            </div>

                                        </div>

                                        <!--end::Form-->
                                    </div>
                                    <!--begin::Actions-->
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
                                    <!--end::Actions-->
                                </div>
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
    <script src="{{ asset("static/js/custom/apps/hrm/add_employees.js") }}"></script>
    <script>
        $("#taxable").change(function(){
            if(this.checked){
                $("#tax_row").removeClass("d-none");
            }else{
                $("#tax_row").addClass("d-none");
            }
        })
    </script>
    <script>
        $("#create_user").change(function(){
            if(this.checked){
                $("#user_details_div").removeClass("d-none");
            }else{
                $("#user_details_div").addClass("d-none");
            }
        })
    </script>
    <script>
        $("#employee_type").change(function(){
            var selected_type = $("#employee_type").find(":selected").val();
            if(selected_type === "Contracted"){
                $("#contract_div").removeClass("d-none");
            }else{
                $("#contract_div").addClass("d-none");
            }
        })
    </script>

    <script>

        $(document).ready(function() {
            $('#company_email_address').on('keyup', function() {
                var email = $(this).val();
                $('#user_email').val(email);
            });
        });
    </script>
@endsection
