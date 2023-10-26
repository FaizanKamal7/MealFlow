@extends('hrmanagement::layouts.master')
@section('title', 'HR - Appreciations')

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
                            <div class="d-flex align-items-center position-relative my-1 me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                            transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" data-kt-permissions-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-15"
                                    placeholder="Search Templates" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--start::Card Tool Bar-->

                        {{-- @can("add_appreciation") --}}

                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <a href="{{ route(" hr_appreciations_add") }}" class="btn btn-primary">New Appreciation</a>
                        </div>

                        {{-- @endcan --}}
                        <!--end::Card Tool Bar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table border gy-5 gs-7 table-striped" id="re_appreciation_table">
                            <!--begin::Table head-->
                            <thead class="bg-light-dark">
                                <!--begin::Table row-->
                                <tr class="text-start fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Employee</th>
                                    <th class="min-w-1px">Award</th>
                                    <th class="min-w-1px">Date</th>
                                    <th class="min-w-1px">Amount</th>
                                    <th class="min-w-1px">Picture</th>
                                    <th class="min-w-50px text-center">Actions</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600">
                                @foreach($appreciations as $appreciation)
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <!--begin:: Avatar -->
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="#">
                                                <div class="symbol-label">
                                                    <img src="{{asset('media/avators/300-1.jpg')}}" alt="Emma Smith"
                                                        class="w-100" />
                                                </div>
                                            </a>
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::User details-->
                                        <div class="d-flex flex-column">
                                            <a href="#"
                                                class="text-gray-800 text-hover-primary mb-1">{{$appreciation->employee->first_name
                                                ?? ""}} {{$appreciation->employee->last_name ?? ""}}</a>
                                            <span>{{$appreciation->employee->company_email_address ?? ""}}</span>
                                        </div>
                                        <!--begin::User details-->
                                    </td>

                                    <td>{{$appreciation->award->title ?? ""}}</td>
                                    <td>{{$appreciation->date}}</td>
                                    <td>{{$appreciation->amount}}</td>
                                    <td><a class="text-primary" href="{{ asset($appreciation->picture) }}"
                                            target="_blank">View</a></td>
                                    <td>
                                        <!--begin::Edit-->

                                        {{-- @can("edit_appreciation") --}}

                                        <a href="{{route('hr_appreciations_edit',['id' => $appreciation->id])}}"
                                            class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                            data-bs-toggle="tooltip" title="Edit">
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
                                        <!--begin::Delete-->
                                        {{-- @can("delete_appreciation") --}}

                                        <a id="delete_appreciation_btn_{{ $appreciation->id }}"
                                            onclick="deleteAppreciation('{{ $appreciation->id }}')"
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
                                        </a>

                                        {{-- @endcan --}}
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
@endsection

@section('extra_scripts')
<script src="{{ asset(" static/js/custom/apps/hrm/add_appreciation.js") }}"></script>
<script>
    $("#re_appreciation_table").DataTable({
            "scrollX": true
        });
</script>
@endsection