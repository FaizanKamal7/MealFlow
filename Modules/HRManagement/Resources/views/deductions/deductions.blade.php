@extends('hrmanagement::layouts.master')
@section('title', 'HR - Deductions')

@section('main_content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">

                    <!--begin::Card-->
                    <div class="card card-flush">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">

                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                Deductions
                                <!--end::Search-->
                            </div>
                            <!--end::Card title-->
                            <!--start::Card Tool Bar-->

                            @can("add_deduction")
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#re_add_deduction_modal">Add New
                                </button>
                            </div>

                            @endcan
                            <!--end::Card Tool Bar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <table class="table border gy-5 gs-7" id="re_deduction_table">
                                <!--begin::Table head-->
                                <thead class="bg-light-dark">
                                <!--begin::Table row-->
                                <tr class="text-start fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px">Employee</th>
                                    <th class="min-w-100px">Date</th>
                                    <th class="min-w-50px">Amount</th>
                                    <th class="min-w-100px">Description</th>
                                    <th class="min-w-150px">Status</th>
                                    <th class="min-w-150px">Deducted</th>
                                    <th class="min-w-100px">Action</th>
                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                @foreach($deductions as $deduction)
                                    <tr>
                                        <td class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="#">
                                                    <div class="symbol-label">
                                                        <img src="{{asset('media/avators/300-1.jpg')}}" alt="Emma Smith"
                                                             class="w-100"/>
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                <a href="#"
                                                   class="text-gray-800 text-hover-primary mb-1">{{$deduction->employee->first_name}} {{$deduction->employee->last_name}}</a>
                                                <span>{{$deduction->employee->company_email_address}}</span>
                                            </div>
                                            <!--begin::User details-->
                                        </td>
                                        <td>{{ $deduction->date }}</td>
                                        <td>{{ $deduction->amount }}</td>
                                        <td>{{ $deduction->description }}</td>
                                        <td>
                                            <select class="form-select  form-select-transparent deduction-status"
                                                    aria-label="Select example" id="{{$deduction->id}}-status">
                                                <option value="Approved" @if($deduction->status=="Approved") selected @endif><a >Approved</a></option>
                                                <option value="Pending" @if($deduction->status=="Pending") selected @endif><a >Pending</a></option>
                                                <option value="Rejected" @if($deduction->status=="Rejected") selected @endif><a >Rejected</a></option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select  form-select-transparent deduction-deduction"
                                                    aria-label="Select example" id="{{$deduction->id}}-deduction">
                                                <option value="0" @if($deduction->deducted==0) selected @endif><a>Pending</a></option>
                                                <option value="1" @if($deduction->deducted==1) selected @endif><a>Deducted</a></option>
                                               </select>
                                        </td>

                                        <td>
                                            <!--begin::Edit-->
                                            @can("edit_deduction")

                                            <a onclick="editDeduction('{{ $deduction->id }}','{{ $deduction->employee_id }}')"
                                               class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                               data-bs-toggle="tooltip" title="Edit">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <span class="svg-icon svg-icon-3">
																<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none">
<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
      d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z"
      fill="currentColor"/>
<path
    d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z"
    fill="currentColor"/>
<path
    d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z"
    fill="currentColor"/>
</svg>
															</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            @endcan
                                            <!--end::Edit-->
                                            <!--begin::Delete-->

                                            @can("delete_deduction")
                                            <button id="delete_deduction_btn_{{ $deduction->id }}"
                                                    onclick="deleteDeduction('{{ $deduction->id }}')"
                                                    class="btn btn-icon btn-active-light-danger w-30px h-30px"
                                                    data-bs-toggle="tooltip" title="Delete">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <span class="svg-icon svg-icon-3">
																<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none">
<path
    d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
    fill="currentColor"/>
<path opacity="0.5"
      d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
      fill="currentColor"/>
<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"/>
</svg>
															</span>
                                                <!--end::Svg Icon-->
                                            </button>
                                            @endcan
                                            <!--end::Delete-->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->

                </div>
                <!--end::Content-->
            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

    <!--begin:: Add Modal-->
    <div class="modal fade" tabindex="-1" id="re_add_deduction_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Deduction</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <span class="svg-icon svg-icon-3x"><i class="bi bi-x"></i> </span>
                    </div>
                    <!--end::Close-->
                </div>
                <form id="re_add_deduction_form" name="re_add_deduction_form" method="post"
                      class="form"
                      action="{{route("hr_deduction_add")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3 justify-content-center">
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label ">
                                    <span class="required">Employee</span>
                                </label>
                                <!--end::Label-->
                                <div class="border rounded">
                                    <select id="employee" class="form-select form-select-solid" name="employee"
                                            data-placeholder="Select an option">
                                        @foreach($employees as $employ)
                                            <option></option>
                                            <option value="{{$employ->id}}"
                                                    data-kt-rich-content-subcontent="{{$employ->company_email_address}}"
                                                    data-kt-rich-content-icon="{{asset('media/avators/300-1.jpg')}}">
                                                {{$employ->first_name}} {{$employ->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!--begin::Select2-->
                            </div>
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="required">Date</span>
                                </label>
                                <!--end::Label-->
                                <input type="date" class="form-control form-control-solid" name="date" id="date">
                            </div>
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="required">Amount</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid" name="amount" id="amount">
                            </div>
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="">Description</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea class="form-control form-control-solid" name="description"
                                          id="description"></textarea>
                                <!--end::Input-->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <!--begin::Actions-->
                        <button id="re_add_deduction_submit" type="submit"
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
        </div>
    </div>
    <!--end::Add Modal-->
    <!--begin::Edit Modal-->
    <div class="modal fade" tabindex="-1" id="re_edit_deduction_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Deduction</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <span class="svg-icon svg-icon-3x"><i class="bi bi-x"></i> </span>
                    </div>
                    <!--end::Close-->
                </div>
                <form id="re_edit_deduction_form" name="re_edit_deduction_form" method="post"
                      class="form"
                      action="{{route('hr_deduction_update')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3 justify-content-center">
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label ">
                                    <span class="required">Employee</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <div class="border rounded">
                                    <select id="edit_employee" class="form-select form-select-solid" name="employee"
                                            data-placeholder="Select an option" disabled>

                                    </select>
                                </div>
                                <!--begin::Select2-->
                            </div>
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="required">Date</span>
                                </label>
                                <!--end::Label-->
                                <input type="date" class="form-control form-control-solid" name="date" id="edit_date">
                            </div>
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="">Amount</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid" name="amount"
                                       id="edit_amount">
                                <input type="text" class="form-control form-control-solid" name="id" id="id" required
                                       hidden>
                            </div>
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="">Description</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea class="form-control form-control-solid" name="description"
                                          id="edit_description"></textarea>
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-3">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="true" name="deducted"
                                           id="deducted"/>
                                    <label class="form-check-label" for="deducted">
                                        Deducted
                                    </label>
                                </div>

                            </div>
                            <div class="fv-row mb-3">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="true" name="status"
                                           id="status"/>
                                    <label class="form-check-label" for="status">
                                        Approved
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <!--begin::Actions-->
                        <button id="re_edit_deduction_submit" type="submit"
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
        </div>
    </div>
    <!--end::Edit Modal-->
@endsection

@section('extra_scripts')
    <script src="{{ asset("static/js/custom/apps/hrm/add_deduction.js") }}"></script>
    <script>
        $("#re_deduction_table").DataTable({
            "scrollX": true
        });
    </script>
@endsection
