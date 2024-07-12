@extends('hrmanagement::layouts.master')
@section('title', 'HR - Events')

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
                            Events
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--start::Card Tool Bar-->
                        {{-- @can("add_events") --}}
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#re_add_event_modal">Add New
                            </button>
                        </div>
                        {{-- @endcan --}}
                        <!--end::Card Tool Bar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table border gy-5 gs-7 table-striped" id="re_event_table">
                            <!--begin::Table head-->
                            <thead class="bg-light-dark">
                                <!--begin::Table row-->
                                <tr class="text-start fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Title</th>
                                    <th class="min-w-1px">Venue</th>
                                    <th class="min-w-1px">Description</th>
                                    <th class="min-w-1px">Color</th>
                                    <th class="min-w-1px">Starting Time</th>
                                    <th class="min-w-1px">Ending Time</th>
                                    <th class="min-w-50px">Event Type</th>
                                    <th class="min-w-50px text-center">Action</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600">
                                @foreach($events as $event)
                                <tr>
                                    <td>{{$event->event_title}}</td>
                                    <td>{{$event->venue}}</td>
                                    <td>{{$event->description}}</td>
                                    <td><span class="text-white"
                                            style="background-color: {{$event->color}}">{{$event->color}}</span></td>
                                    <td>{{date('d-m-Y', strtotime($event->start_date_time))}}</td>
                                    <td>{{date('d-m-Y', strtotime($event->end_date_time))}}</td>
                                    <td>{{$event->type}}</td>
                                    <td class="text-center">
                                        <!--begin::Edit-->
                                        {{-- @can("edit_events") --}}
                                        <a href="#re_edit_event_modal" onclick="editEvent('{{ $event->id }}')"
                                            class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                            data-bs-toggle="modal" title="Edit">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        {{-- @endcan --}}
                                        <!--end::Edit-->
                                        <!--begin::Edit-->
                                        {{-- @can("delete_events") --}}
                                        <button id="delete_event_btn_{{$event->id}}"
                                            onclick="deleteEvent('{{ $event->id }}')"
                                            class="btn btn-icon btn-active-light-danger w-30px h-30px"
                                            data-bs-toggle="tooltip" title="Delete">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                        fill="currentColor" />
                                                    <path opacity="0.5"
                                                        d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                        fill="currentColor" />
                                                    <path opacity="0.5"
                                                        d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        {{-- @endcan --}}
                                        <!--end::Edit-->
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

<!--begin::Modal-->
{{-- @can("add_events") --}}
<div class="modal fade" tabindex="-1" id="re_add_event_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Event</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="svg-icon svg-icon-3x"><i class="bi bi-x"></i> </span>
                </div>
                <!--end::Close-->
            </div>
            <form id="re_add_event_form" name="re_add_event_form" method="post" class="form" action="{{route("
                hr_events_add")}}" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="row mb-3 justify-content-center">
                        <div class="fv-row mb-3">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label">
                                <span class="required">Title</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid" name="event_title"
                                id="event_title">
                        </div>

                        <div class="fv-row mb-3">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label ">
                                <span class="">Event Type</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Select2-->
                            <select class="form-select form-control form-control-solid" name="type" id="type"
                                data-control="select2" data-placeholder="Select an option">
                                <option></option>
                                <option value="Internal">Internal</option>
                                <option value="External">External</option>
                                <option value="Private">Private</option>
                                <option value="Open">Open</option>
                            </select>
                            <!--begin::Select2-->
                        </div>


                        <div class="fv-row mb-3">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label">
                                <span class="required">Venue</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid" name="venue" id="venue">
                        </div>
                        <div class="fv-row mb-3">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label">
                                <span class="required">Start Date Time</span>
                            </label>
                            <!--end::Label-->
                            <input type="datetime-local" class="form-control form-control-solid" name="start_date_time"
                                id="start_date_time">
                        </div>

                        <div class="fv-row mb-3">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label">
                                <span class="required">End Date Time</span>
                            </label>
                            <!--end::Label-->
                            <input type="datetime-local" class="form-control form-control-solid" name="end_date_time"
                                id="end_date_time">
                        </div>

                        <div class="fv-row mb-3">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label">
                                <span class="">Color<i class="fas fa-exclamation-circle ms-2 fs-7"
                                        data-bs-toggle="tooltip"
                                        title="Select color to distinguish event on calendar"></i></span>
                            </label>
                            <!--end::Label-->
                            <input type="color" class="form-control form-control-solid" name="color" id="color">
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
                    <button id="re_add_event_submit" type="submit" class="btn btn-primary float-end">
                        <span class="indicator-label">
                            Save Changes
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <!--end::Actions-->
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
{{-- @endcan --}}
<!--end::Modal-->

<!--start::Event Edit Modal-->
{{-- @can("update_events") --}}
<div class="modal fade" tabindex="-1" id="re_edit_event_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Event</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="svg-icon svg-icon-3x"><i class="bi bi-x"></i> </span>
                </div>
                <!--end::Close-->
            </div>
            <form id="re_edit_event_form" name="re_edit_event_form" method="post" class="form" action="{{route("
                hr_events_update")}}" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="row mb-3 justify-content-center">
                        <div class="fv-row mb-3">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label">
                                <span class="required">Title</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid" name="event_title"
                                id="edit_event_title">
                        </div>

                        <div class="fv-row mb-3">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label ">
                                <span class="">Event Type</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Select2-->
                            <select class="form-select form-control form-control-solid" name="type"
                                data-control="select2" data-placeholder="Select an option" id="edit_type">
                                <option value="Internal">Internal</option>
                                <option value="External">External</option>
                                <option value="Private">Private</option>
                                <option value="Open">Open</option>
                            </select>
                            <!--begin::Select2-->
                        </div>


                        <div class="fv-row mb-3">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label">
                                <span class="required">Venue</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid" name="venue" id="edit_venue">
                        </div>
                        <div class="fv-row mb-3">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label">
                                <span class="required">Start Date Time</span>
                            </label>
                            <!--end::Label-->
                            <input type="datetime-local" class="form-control form-control-solid" name="start_date_time"
                                id="edit_start_date_time">
                        </div>

                        <div class="fv-row mb-3">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label">
                                <span class="required">End Date Time</span>
                            </label>
                            <!--end::Label-->
                            <input type="datetime-local" class="form-control form-control-solid" name="end_date_time"
                                id="edit_end_date_time">
                        </div>

                        <div class="fv-row mb-3">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label">
                                <span class="">Color<i class="fas fa-exclamation-circle ms-2 fs-7"
                                        data-bs-toggle="tooltip"
                                        title="Select color to distinguish event on calendar"></i></span>
                            </label>
                            <!--end::Label-->
                            <input type="color" class="form-control form-control-solid" name="color" id="edit_color">
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
                        <input type="hidden" name="id" id="id">

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <!--begin::Actions-->
                    <button id="re_edit_event_submit" type="submit" class="btn btn-primary float-end">
                        <span class="indicator-label">
                            Save Changes
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <!--end::Actions-->
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
{{-- @endcan --}}
<!--end::Event Edit Modal-->
@endsection

@section('extra_scripts')
<script src="{{ asset(" static/js/custom/apps/hrm/add_event.js") }}"></script>
<script>
    $("#re_event_table").DataTable({
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
        $('#employees').select2({
            templateSelection: optionFormat,
            templateResult: optionFormat
        });
</script>
@endsection