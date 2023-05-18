@extends('hrmanagement::layouts.master')
@section('title', 'HR - Attendance')
@section('extra_style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main_content')

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">

                    <div class="card card-flush mb-2">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--start::Card Tool Bar-->
                            <div class="card-toolbar flex-row-fluid m-2">
                                <!--begin::Select2-->
                                <select class="form-select form-control form-control-solid"
                                        name="employee" id="employee" data-control="select2"
                                        data-placeholder="Select an option">
                                    @foreach($employees as $employ)
                                        <option value="{{$employ->id}}">{{$employ->first_name}}</option>
                                    @endforeach
                                </select>
                                <!--begin::Select2-->
                            </div>
                            <!--end::Card Tool Bar-->

                            <!--start::Card Tool Bar-->
                            <div class="card-toolbar flex-row-fluid m-2">
                                <!--begin::Select2-->
                                <select class="form-select form-control form-control-solid"
                                        name="department" id="department" data-control="select2"
                                        data-placeholder="Select an option">
                                    <option class="department">Department</option>
                                    <option value="Pakistan">Pakistan</option>
                                </select>
                                <!--begin::Select2-->
                            </div>
                            <!--end::Card Tool Bar-->

                            <!--start::Card Tool Bar-->
                            <div class="card-toolbar flex-row-fluid m-2">
                                <!--begin::Select2-->
                                <select class="form-select form-control form-control-solid"
                                        name="month" id="month" data-control="select2"
                                        data-placeholder="Select an option">
                                    <option value="month">Month</option>
                                    <option value="Pakistan">Pakistan</option>
                                </select>
                                <!--begin::Select2-->
                            </div>
                            <!--end::Card Tool Bar-->

                            <!--start::Card Tool Bar-->
                            <div class="card-toolbar flex-row-fluid m-2">
                                <!--begin::Select2-->
                                <select class="form-select form-control form-control-solid"
                                        name="year" id="year" data-control="select2"
                                        data-placeholder="Select an option">
                                    <option value="year">Year</option>
                                    <option value="Pakistan">2023</option>
                                </select>
                                <!--begin::Select2-->
                            </div>
                            <!--end::Card Tool Bar-->

                            <!--start::Card Tool Bar-->
                            <div class="card-toolbar flex-row-fluid justify-content-end">
                                <!--begin::Radio group-->
                                <div class="btn-group w-50 w-lg-50" data-kt-buttons="true"
                                     data-kt-buttons-target="[data-kt-button]">
                                    <!--begin::Radio-->
                                    <label
                                        class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-primary active"
                                        data-kt-button="true" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Summary">
                                        <a href="#">
                                            <!--begin::Input-->
                                            <input class="btn-check" type="radio" name="method" value="1"
                                                   checked="checked"/>
                                            <!--end::Input-->
                                            <i class="bi bi-list fs-1 text-dark"></i>
                                        </a>
                                    </label>
                                    <!--end::Radio-->

                                    <!--begin::Radio-->
                                    <label
                                        class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-primary"
                                        data-kt-button="true" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Attendance by employee">
                                        <a href="#">
                                            <!--begin::Input-->
                                            <input class="btn-check" type="radio" name="method" value="2"/>
                                            <!--end::Input-->
                                            <i class="bi bi-person fs-1 text-dark"></i>
                                        </a>
                                    </label>
                                    <!--end::Radio-->

                                </div>
                                <!--end::Radio group-->
                            </div>
                            <!--end::Card Tool Bar-->
                        </div>
                        <!--end::Card header-->
                    </div>

                    <!--begin::Card-->
                    <div class="card card-flush">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <div class="d-flex align-items-center position-relative my-1 me-5">
                                <span class="m-1"><i class="bi bi-check-circle-fill text-primary"></i> Present</span>
                                <span class="m-1"><i class="bi bi-x-circle-fill text-danger"></i> Absent</span>
                                <span class="m-1"><i class="bi bi-star-fill text-info"></i>On Leave</span>
                                <span class="m-1"><i class="bi bi-star-half text-primary"></i> Half Day</span>
                                <span class="m-1"><i class="bi bi-star-fill text-success"></i> Holiday</span>
                                <span class="m-1"><i class="bi bi-info-circle-fill text-warning"></i> Late</span>
                                <span class="m-1"><i class="bi bi-question-circle text-primary"></i> Not Marked</span>
                            </div>
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->

                                <!--end::Search-->
                            </div>
                            <!--end::Card title-->
                            <!--start::Card Tool Bar-->
                            @can("add_attendence")

                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#re_mark_attendance_modal">Mark Attendance
                                </button>
                            </div>

                            @endcan
                            <!--end::Card Tool Bar-->
                        </div>
                        <!--end::Card header-->
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <table class="table  align-middle table-row-dashed fs-6  mb-0" id="re_attendance_table">
                                <!--begin::Table head-->
                                <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Employee</th>
                                     @for ($day = 1; $day <= $Days; $day++)
                                        <th class="min-w-30px">{{ $day }}</th>
                                    @endfor
                                    {{--                                    <th class="min-w-50px">Total</th>--}}
                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                @foreach($emp_Attendances as $employee)
                                    <tr>
                                        <!--Emp Personal Details-->
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
                                                   class="text-gray-800 text-hover-primary mb-1">{{ $employee['emp_name'] }}</a>
                                            </div>
                                            <!--begin::User details-->
                                        </td>
                                        <!--Attendance Loop-->
                                        @foreach($employee['attendance_data'] as $attendance)
                                            <!--If not exists show cross -->
                                            @if(!$attendance['id'])
                                                <td>
                                                    <a data-bs-toggle="modal"
                                                       data-bs-target="#re_mark_attendance_modal">
                                                        <i class="bi bi-question-circle text-primary"></i>
                                                    </a>
                                                </td>
                                            @else
                                                <!--status based checks-->
                                                @if($attendance['status']=='P')

                                                    <td>
                                                        <a onclick="editAttendance('{{ $attendance['id'] }}')"><i
                                                                class="bi bi-check-circle-fill text-primary"></i></a>
                                                    </td>
                                                @elseif($attendance['status']=='A')
                                                    <td>
                                                        <a onclick="editAttendance('{{ $attendance['id'] }}')"><i
                                                                class="bi bi-x-circle-fill text-danger"></i></a></td>
                                                @elseif($attendance['status']=='L')
                                                    <td>
                                                        <a onclick="editAttendance('{{ $attendance['id'] }}')"><i
                                                                class="bi bi-info-circle-fill text-warning"></i></a>
                                                    </td>
                                                @elseif($attendance['status']=='HD')
                                                    <td>
                                                        <a onclick="editAttendance('{{ $attendance['id'] }}')"><i
                                                                class="bi bi-star-half text-primary"></i></a></td>
                                                @elseif($attendance['status']=='OL')
                                                    <td>
                                                        <a onclick="editAttendance('{{ $attendance['id'] }}')"><i
                                                                class="bi bi-star-fill text-info"></i></a></td>
                                                @endif
                                            @endif
                                        @endforeach
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
    <div class="modal fade" tabindex="-1" id="re_mark_attendance_modal">
        <div class="modal-dialog">
            <div class="modal-content" id="re_mark_attendance_block_target">


                <div class="modal-header">
                    <h5 class="modal-title">Mark Attendance</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <span class="svg-icon svg-icon-3x"><i class="bi bi-x"></i> </span>
                    </div>
                    <!--end::Close-->
                </div>


                <form id="re_add_attendance_form" name="re_add_attendance_form" method="post"
                      class="form"
                      action="{{ route("hr_attendance_add") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3 justify-content-center">
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label ">
                                    <span class="">Departments <i class="fas fa-exclamation-circle fs-7"
                                                                  data-bs-toggle="tooltip"
                                                                  title="Filter employees based on department"></i></span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="form-select form-control form-control-solid"
                                        name="departments" id="departments" data-control="select2"
                                        data-placeholder="Select an option" data-allow-clear="true">
                                    <option></option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->department_name}}</option>
                                    @endforeach
                                </select>
                                <!--begin::Select2-->
                                <span class="text-danger d-none" id="dpt_no_employee">This department don't have any employees</span>
                            </div>
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="required">Employees</span> <i class="fas fa-exclamation-circle fs-7"
                                                                               data-bs-toggle="tooltip"
                                                                               title="Remove department filter to see all employees"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="form-select form-control form-control-solid"
                                        name="employees[]" id="employees" data-control="select2"
                                        data-placeholder="Select an option" multiple>

                                    <option value=""></option>
                                    <option value="all">All</option>
                                    @foreach($employees as $employee)
                                        <option
                                            value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-3">
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
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="required">Status</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="form-select form-control form-control-solid"
                                        name="status" id="status" data-control="select2"
                                        data-placeholder="Select an option">
                                    <option></option>
                                    <option value="P">Present</option>
                                    <option value="A">Absent</option>
                                    <option value="L">Late</option>
                                    <option value="HD">Half Day</option>
                                    <option value="OL">On Leave</option>
                                </select>
                                <!--begin::Select2-->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <!--begin::Actions-->
                        <button id="re_add_attendance_submit" type="submit"
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
@endsection

@section('extra_scripts')
    <script src="{{ asset("static/js/custom/apps/hrm/add_attendance.js") }}"></script>
    <script>
        $("#re_attendance_table").DataTable({
            "scrollX": true
        });
    </script>


    <script>
        // Format options
        var optionFormat = function (item) {
            if (!item.id) {
                return item.text;
            }
            var span = document.createElement('span');
            var imgUrl = item.element.getAttribute('data-kt-select2-user');
            var template = '';
            template += '<img src="' + imgUrl + '" class="rounded-circle h-20px me-2" alt="image"/>';
            template += item.text;
            span.innerHTML = template;
            return $(span);
        }
        // Init Select2 --- more info: https://select2.org/
        // $('#employees').select2({
        //     templateSelection: optionFormat,
        //     templateResult: optionFormat
        // });
    </script>

    <script>
        // Format options
        const Format = (item) => {
            if (!item.id) {
                return item.text;
            }

            var span = document.createElement('span');
            var template = '';

            template += '<div class="d-flex align-items-center">';
            template += '<img src="' + item.element.getAttribute('data-kt-rich-content-icon') + '" class="rounded-circle h-40px me-3" alt="' + item.text + '"/>';
            template += '<div class="d-flex flex-column">'
            template += '<span class="fs-4 fw-bolder lh-1">' + item.text + '</span>';
            template += '<span class="text-muted fs-5">' + item.element.getAttribute('data-kt-rich-content-subcontent') + '</span>';
            template += '</div>';
            template += '</div>';

            span.innerHTML = template;

            return $(span);
        }

        // Init Select2 --- more info: https://select2.org/
        $('#kt_docs_select2_rich_content').select2({
            placeholder: "Select an option",
            minimumResultsForSearch: Infinity,
            templateSelection: optionFormat,
            templateResult: optionFormat
        });
    </script>

@endsection
