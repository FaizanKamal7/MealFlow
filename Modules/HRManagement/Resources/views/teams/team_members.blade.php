@extends('hrmanagement::layouts.master')
@section('title', 'HR - Team Members')

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
                                {{$team->team_name}} Team
                                <!--end::Search-->
                            </div>
                            <!--end::Card title-->
                            <!--start::Card Tool Bar-->
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#re_add_team_member_modal">Add New
                                </button>
                            </div>
                            <!--end::Card Tool Bar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <table class="table border gy-5 gs-7" id="re_team_member_table">
                                <!--begin::Table head-->
                                <thead class="bg-light-dark">
                                <!--begin::Table row-->
                                <tr class="text-start fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Name</th>
                                    <th class="min-w-125px">Action</th>
                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                @foreach($team_members as $team_member)
                                    <tr>
                                        <td>{{$team_member->employee->first_name}} {{$team_member->employee->last_name}}
                                            @if($team_member->is_leader)
                                                    <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen043.svg-->
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x"
                                                          data-bs-toggle="tooltip" title="This employee is team leader">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
</svg></span>
                                                    <!--end::Svg Icon-->
                                            @endif
                                        </td>

                                        <td>
                                            <!--begin::Delete-->
                                            <a id="delete_team_member_btn_{{ $team_member->id }}"
                                               onclick="deleteTeamMember('{{ $team_member->id }}','{{$team_member->team_id}}')"
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
                                            <!--end::Delete-->
                                            <!--begin::manager-->
                                            @if($team_members->contains('is_leader', true))
                                                @if($team_member->is_leader)
                                                    <a href="{{route('hr_team_members_remove_leader',['id'=>$team_member->team_id,"member_id"=>$team_member->id])}}"
                                                       class="btn btn-icon btn-active-light-danger w-30px h-30px"
                                                       data-bs-toggle="tooltip" title="Remove manager">
                                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr088.svg-->
                                                        <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none">
<rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)"
      fill="currentColor"/>
<rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor"/>
</svg></span>
                                                        <!--end::Svg Icon--></a>
                                                @else
                                                @endif
                                            @else
                                                <a href="{{route('hr_team_members_make_leader',['id'=>$team_member->team_id,"member_id"=>$team_member->id])}}"
                                                   class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                                   data-bs-toggle="tooltip" title="Make Manager">
                                                    <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr085.svg-->
                                                    <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
<path
    d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z"
    fill="currentColor"/>
</svg></span>
                                                    <!--end::Svg Icon-->
                                                </a>
                                            @endif
                                            <!--end::manager-->
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
    <div class="modal fade" tabindex="-1" id="re_add_team_member_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Member</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <span class="svg-icon svg-icon-3x"><i class="bi bi-x"></i> </span>
                    </div>
                    <!--end::Close-->
                </div>
                <form id="re_add_team_member_form" name="re_add_team_member_form" method="post"
                      class="form"
                      action="{{route('hr_team_members_store',['id'=>$team->id])}}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <div class="row mb-3 justify-content-center">
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label">
                                    <span class="required">Members</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="form-select form-control form-control-solid"
                                        name="team_member_members[]" id="team_member_members" data-control="select2"
                                        data-placeholder="Select an option" multiple>
                                    @foreach($employees as $employee)
                                        @foreach($team_members as $team_member)
                                            @if($team_member->employee_id !== $employee->id)
                                                <option
                                                    value="{{$employee->id}}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                                <!--begin::Select2-->
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <!--begin::Actions-->
                        <button id="re_add_team_member_submit" type="submit"
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


    <!--end::Modal-->
@endsection

@section('extra_scripts')
    <script src="{{ asset("static/js/custom/apps/hrm/add_team_member.js") }}"></script>
    <script>
        // $("#re_team_member_table").DataTable({
        //     "scrollX": true
        // });
    </script>

@endsection
