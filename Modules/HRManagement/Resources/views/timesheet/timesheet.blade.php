@extends('hrmanagement::layouts.master')
@section('title', 'HR - timesheets')

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
                                Timesheets
                                <!--end::Search-->
                            </div>

                            <!--end::Card title-->
                            <!--start::Card Tool Bar-->
                            @can("view_timesheet")
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#re_add_timesheet_modal">Add New
                                </button>
                            </div>
                            @endcan
                            <!--end::Card Tool Bar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <table class="table border gy-5 gs-7" id="re_timesheet_table">
                                <!--begin::Table head-->
                                <thead class="bg-light-dark">
                                <!--begin::Table row-->
                                <tr class="text-start fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Employee</th>
                                    <th class="min-w-1px">Timesheet Title</th>
                                    <th class="min-w-1px">Hours Worked</th>
                                    <th class="min-w-1px">Date</th>
                                    <th class="min-w-1px">Description</th>
                                    <th class="min-w-1px">Status</th>
                                    <th class="min-w-1px">Action</th>
                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                @foreach($timesheets as $timesheet)
                                    <tr>
                                        <td class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="#">
                                                    <div class="symbol-label">
                                                        <img src="{{asset('media/avators/300-1.jpg')}}" alt="Emma Smith" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$timesheet->employee->first_name}}  {{$timesheet->employee->last_name}}</a>
                                                <span>{{$timesheet->employee->company_email_address}}</span>
                                            </div>
                                            <!--begin::User details-->
                                        </td>
                                        <td>{{$timesheet->sheet_title}}</td>
                                        <td>{{$timesheet->hours_worked}}</td>
                                        <td>{{$timesheet->date}}</td>
                                        <td>{{$timesheet->description}}</td>
                                        <td>{{$timesheet->status}}</td>
                                        <td>
                                            <!--begin::Edit-->
                                            @can("edit_timesheet")
                                            <a onclick="editTimesheet('{{ $timesheet->id }}')"
                                               class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                               data-bs-toggle="tooltip" title="Edit">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <span class="svg-icon svg-icon-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
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
                                            @can("delete_timesheet")
                                            <a id="delete_timesheet_btn_{{ $timesheet->id }}"
                                               onclick="deleteTimesheet('{{ $timesheet->id }}')"
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
                                            </a>
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

    <!--begin::Add Modal-->
    @can("add_timesheet")
    <div class="modal fade" tabindex="-1" id="re_add_timesheet_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Timesheet</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <span class="svg-icon svg-icon-3x"><i class="bi bi-x"></i> </span>
                    </div>
                    <!--end::Close-->
                </div>
                <form id="re_add_timesheet_form" name="re_add_timesheet_form" method="post"
                      class="form"
                      action="{{ route("hr_timesheets_store") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3 justify-content-center">
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="required">Employee</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="form-select form-control form-control-solid"
                                        name="employee" id="employee" data-control="select2"
                                        data-placeholder="Select an option">
                                    <option></option>
                                    @foreach($employees as $employee)
                                        <option
                                            value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                                    @endforeach
                                </select>
                                <!--begin::Select2-->
                            </div>

                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="required">Timesheet Title</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid" name="sheet_title"
                                       id="sheet_title">
                            </div>
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="required">Hours Worked</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid" name="hours_worked"
                                       id="hours_worked">
                            </div>
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="required">Date</span>
                                </label>
                                <!--end::Label-->
                                <input type="date" class="form-control form-control-solid" name="date"
                                       id="date">
                            </div>
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="">Description</span>
                                </label>
                                <textarea class="form-control form-control-solid" rows="2" name="description"
                                          id="description"></textarea>
                            </div>
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="">Status</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="form-select form-control form-control-solid"
                                        name="status" id="status" data-control="select2"
                                        data-placeholder="Select an option">
                                    <option value="" selected></option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                                <!--begin::Select2-->
                            </div>


                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <!--begin::Actions-->
                        <button id="re_add_timesheet_submit" type="submit"
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
    @endcan
    <!--end::Add Modal-->

    <!--begin::Add Modal-->
    @can("update_timesheet")
    <div class="modal fade" tabindex="-1" id="re_edit_timesheet_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Timesheet</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <span class="svg-icon svg-icon-3x"><i class="bi bi-x"></i> </span>
                    </div>
                    <!--end::Close-->
                </div>
                <form id="re_edit_timesheet_form" name="re_add_timesheet_form" method="post"
                      class="form"
                      action="{{route('hr_timesheets_update')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control form-control-solid" name="id" id="id" required hidden>
                    <div class="modal-body">
                        <div class="row mb-3 justify-content-center">
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="required">Employee</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="form-select form-control form-control-solid"
                                        name="edit_employee" id="edit_employee" data-control="select2"
                                        data-placeholder="Select an option">
                                    <option></option>
                                    @foreach($employees as $employee)
                                        <option
                                            value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                                    @endforeach
                                </select>
                                <!--begin::Select2-->
                            </div>

                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="required">Timesheet Title</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid" name="edit_sheet_title"
                                       id="edit_sheet_title">
                            </div>
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="required">Hours Worked</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid" name="edit_hours_worked"
                                       id="edit_hours_worked">
                            </div>
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="required">Date</span>
                                </label>
                                <!--end::Label-->
                                <input type="date" class="form-control form-control-solid" name="edit_date"
                                       id="edit_date">
                            </div>
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="">Description</span>
                                </label>
                                <textarea class="form-control form-control-solid" rows="2" name="edit_description"
                                          id="edit_description"></textarea>
                            </div>
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="">Status</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="form-select form-control form-control-solid"
                                        name="edit_status" id="edit_status" data-control="select2"
                                        data-placeholder="Select an option">
                                    <!--Getting my Ajax function -->
                                </select>
                                <!--begin::Select2-->
                            </div>


                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <!--begin::Actions-->
                        <button id="re_edit_timesheet_submit" type="submit"
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
    @endcan
    <!--end::Add Modal-->
@endsection

@section('extra_scripts')
    <script src="{{ asset("static/js/custom/apps/hrm/add_timesheet.js") }}"></script>
    <script src="{{ asset("static/js/custom/apps/hrm/edit_timesheet.js") }}"></script>
    <script>
        $("#re_timesheet_table").DataTable({
            "scrollX": true
        });
    </script>

@endsection
