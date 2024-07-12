@extends('hrmanagement::layouts.master')
@section('title', 'HR - Add New Expense Reclaims')

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
                                <h2>Add New Expense Reclaim</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">

                            <!--begin::Form-->
                            <form id="re_add_expense_reclaim_form" name="re_add_expense_reclaim_form" method="post"
                                  class="form"
                                  action="{{route('hr_expense_reclaims_add')}}" enctype="multipart/form-data">
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
                                                    data-placeholder="Select an option">
                                                @foreach($employees as $employee)
                                                <option selected></option>
                                                <option value="{{$employee->id}}" >{{$employee->first_name}} {{$employee->last_name}}</option>
                                                @endforeach
                                            </select>
                                            <!--begin::Select2-->
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 col-md-6 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="required">Title</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                   name="title" id="title" value=""/>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="">Category</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select2-->
                                            <select class="form-select form-control form-control-solid"
                                                    name="category" id="category" data-control="select2"
                                                    data-placeholder="Select an option">
                                                <option></option>
                                                <option value="Food and Drink">Food and Drink</option>
                                                <option value="Transportation">Transportation</option>
                                                <option value="Lodging">Lodging</option>
                                                <option value="Entertainment">Entertainment</option>
                                                <option value="Office Supplies">Office Supplies</option>
                                                <option value="Equipment and Tools">Equipment and Tools</option>
                                                <option value="Marketing and Advertising">Marketing and Advertising</option>
                                                <option value="Travel Expenses">Travel Expenses</option>
                                                <option value="Insurance and Taxes">Insurance and Taxes</option>
                                                <option value="Professional Services">Professional Services</option>
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
                                                <span class="required">Currency</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select2-->
                                            <select class="form-select form-control form-control-solid"
                                                    name="currency" id="currency" data-control="select2"
                                                    data-placeholder="Select an option">
                                                <option selected></option>
                                                <option value="PKR" >PKR</option>
                                                <option value="USD">USD</option>
                                            </select>
                                            <!--begin::Select2-->
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="required">Exchange Rate</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                   name="exchange_rate" id="exchange_rate"
                                                   />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="col-lg-2 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="required">Amount</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                   name="amount" id="amount"
                                                   value=""/>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="col-lg-2 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="required">Total Amount</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                   name="total_amount" id="total_amount"
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
                                                <span class="required">Purchase Date</span>
                                            </label>
                                            <!--end::Label-->
                                            <input type="date" class="form-control form-control-solid"
                                                   name="purchase_date" id="purchase_date">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label ">
                                                <span class="">Counter Party (Purchased From)</span>
                                            </label>
                                            <!--end::Label-->
                                            <input type="text" class="form-control form-control-solid"
                                                   name="purchase_from" id="purchase_from">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label ">
                                                <span class="">Invoice</span>
                                            </label>
                                            <!--end::Label-->
                                            <input type="file" class="form-control form-control-solid" name="invoice"
                                                   id="invoice">
                                        </div>
                                    </div>
                                </div>

                                <!--begin::Input group-->
                                <div class="row mb-7 justify-content-center">
                                    <div class="col-lg-4 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="">Entry Date</span>
                                            </label>
                                            <!--end::Label-->
                                            <input type="date" class="form-control form-control-solid"
                                                   name="purchase_date" id="purchase_date">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="">Resolution Date <i class="fas fa-exclamation-circle fs-7"
                                                                                  data-bs-toggle="tooltip"
                                                                                  title="Leave blank if not resolved."></i></span>
                                            </label>
                                            <!--end::Label-->
                                            <input type="date" class="form-control form-control-solid"
                                                   name="resolution_date" id="resolution_date">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label">
                                                <span class="">Notes</span>
                                            </label>
                                            <!--end::Label-->
                                            <textarea class="form-control form-control-solid" name="notes"
                                                      id="notes"></textarea>
                                        </div>
                                    </div>

                                </div>

                                <!--begin::Actions-->
                                <button id="re_add_expense_reclaim_submit" type="submit"
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
    <script src="{{ asset("static/js/custom/apps/hrm/add_expense_reclaim.js") }}"></script>

@endsection
