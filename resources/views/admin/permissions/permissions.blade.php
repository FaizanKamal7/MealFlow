@extends('layouts.admin_master')
@section('title', 'Permissions')

@section('main_content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
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
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                              height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                              fill="currentColor"/>
														<path
                                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                            fill="currentColor"/>
													</svg>
												</span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-permissions-table-filter="search"
                                   class="form-control form-control-solid w-250px ps-15"
                                   placeholder="Search Permissions"/>
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        @can("add_permission")
                            <!--begin::Button-->
                            <button type="button" class="btn btn-light-primary" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_add_permission">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon svg-icon-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
													<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5"
                                                          fill="currentColor"/>
													<rect x="10.8891" y="17.8033" width="12" height="2" rx="1"
                                                          transform="rotate(-90 10.8891 17.8033)" fill="currentColor"/>
													<rect x="6.01041" y="10.9247" width="12" height="2" rx="1"
                                                          fill="currentColor"/>
												</svg>
											</span>
                                <!--end::Svg Icon-->Add Permission
                            </button>
                            <!--end::Button-->
                        @endcan
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
                        <!--begin::Table head-->
                        <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Name</th>
                            <th class="min-w-250px">Assigned to</th>
                            <th class="min-w-125px">Created Date</th>
                            <th class="text-end min-w-100px">Actions</th>
                        </tr>
                        <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                        @foreach($permissions as $permission)
                            <tr>
                                <!--begin::Name=-->
                                <td>{{ $permission->name }} <span
                                        class="badge badge-light-primary fs-7 m-1">{{ $permission->codename }}</span>
                                </td>
                                <!--end::Name=-->
                                <!--begin::Assigned to=-->
                                <td>
                                    @foreach($permission->permissionRoles as $role)
                                        <a href="#"
                                           class="badge badge-light-success fs-7 m-1"> {{ $role->role->role_name }}</a>
                                    @endforeach
                                </td>
                                <!--end::Assigned to=-->
                                <!--begin::Created Date-->
                                <td>{{ $permission->created_at }}</td>
                                <!--end::Created Date-->
                                <!--begin::Action=-->
                                <td class="text-end">
                                    @can("update_permission")
                                        <!--begin::Update-->
                                        <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
                                                onclick="edit_permission('{{ $permission->id }}')"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal_update_permission">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                            <span class="svg-icon svg-icon-3">
																<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none">
																	<path
                                                                        d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z"
                                                                        fill="currentColor"/>
																	<path opacity="0.3"
                                                                          d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z"
                                                                          fill="currentColor"/>
																</svg>
															</span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--end::Update-->
                                    @endcan

                                    @can("delete_permission")
                                        <!--begin::Delete-->
                                        <a href="{{ route("permissions_delete", ["permission_id"=>$permission->id]) }}"
                                           class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                           data-kt-permissions-table-filter="delete_row">
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
																	<path opacity="0.5"
                                                                          d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                                          fill="currentColor"/>
																</svg>
															</span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        <!--end::Delete-->
                                    @endcan
                                </td>
                                <!--end::Action=-->
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


            <!--begin::Modals-->
            @can("add_permission")
                <!--begin::Modal - Add permissions-->
                <div class="modal fade" id="kt_modal_add_permission" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bolder">Add a Permission</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                     data-kt-permissions-modal-action="close">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                    <span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                                                  rx="1" transform="rotate(-45 6 17.3137)"
                                                                  fill="currentColor"/>
															<rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                                  transform="rotate(45 7.41422 6)" fill="currentColor"/>
														</svg>
													</span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <!--begin::Form-->
                                <form id="kt_modal_add_permission_form" method="post" class="form"
                                      action="{{ route("permissions_store") }}">
                                    @csrf
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <span class="required">Application Model</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                               data-bs-trigger="hover" data-bs-html="true"
                                               data-bs-content="Permission names is required to be unique."></i>
                                        </label>
                                        <!--end::Label-->
                                        <select class="form-select" data-control="select2"
                                                data-placeholder="Select an option" name="application_model">
                                            <option></option>
                                            @foreach($application_models as $model)
                                                <option value="{{ $model->id }}">{{ $model->model_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <span class="required">Permission Name</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                               data-bs-trigger="hover" data-bs-html="true"
                                               data-bs-content="Permission names is required to be unique."></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid"
                                               placeholder="Enter a permission name"
                                               name="permission_name"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <span class="required">Permission Codename</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                               data-bs-trigger="hover" data-bs-html="true"
                                               data-bs-content="Permission codename is required to be unique."></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid"
                                               placeholder="Enter a permission codename"
                                               name="permission_codename"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Checkbox-->
                                        <label class="form-check form-check-custom form-check-solid me-9">
                                            <input class="form-check-input" type="checkbox" name="permission_status"
                                                   id="kt_permissions_status" checked/>
                                            <span class="form-check-label"
                                                  for="kt_permissions_status">Active ?</span>
                                        </label>
                                        <!--end::Checkbox-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                                data-kt-permissions-modal-action="cancel">Discard
                                        </button>
                                        <button type="submit" class="btn btn-primary"
                                                data-kt-permissions-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
															<span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
                <!--end::Modal - Add permissions-->
            @endcan


            @can("update_permission")
                <!--begin::Modal - Update permissions-->
                <div class="modal fade" id="kt_modal_update_permission" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bolder">Update Permission</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                     data-kt-permissions-modal-action="close">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                    <span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                                                  rx="1" transform="rotate(-45 6 17.3137)"
                                                                  fill="currentColor"/>
															<rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                                  transform="rotate(45 7.41422 6)" fill="currentColor"/>
														</svg>
													</span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <!--begin::Notice-->
                                <!--begin::Notice-->
                                <div
                                    class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                  rx="10" fill="currentColor"/>
															<rect x="11" y="14" width="7" height="2" rx="1"
                                                                  transform="rotate(-90 11 14)" fill="currentColor"/>
															<rect x="11" y="17" width="2" height="2" rx="1"
                                                                  transform="rotate(-90 11 17)" fill="currentColor"/>
														</svg>
													</span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <!--begin::Content-->
                                        <div class="fw-bold">
                                            <div class="fs-6 text-gray-700">
                                                <strong class="me-1">Warning!</strong>By editing the permission name,
                                                you
                                                might break the system permissions functionality. Please ensure you're
                                                absolutely certain before proceeding.
                                            </div>
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Notice-->
                                <!--end::Notice-->
                                <!--begin::Form-->
                                <form id="kt_modal_update_permission_form" method="post" class="form"
                                      action="{{ route("permissions_update") }}">
                                    @csrf
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <span class="required">Application Model</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                               data-bs-trigger="hover" data-bs-html="true"
                                               data-bs-content="Permission names is required to be unique."></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--end::Label-->
                                        <select class="form-select" data-control="select2"
                                                data-placeholder="Select an option" name="application_model_update">
                                            <option></option>
                                            @foreach($application_models as $model)
                                                <option value="{{ $model->id }}">{{ $model->model_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <span class="required">Permission Name</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                               data-bs-trigger="hover" data-bs-html="true"
                                               data-bs-content="Permission names is required to be unique."></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid"
                                               placeholder="Enter a permission name" id="permission_name_update"
                                               name="permission_name"/>
                                        <input class="form-control form-control-solid" id="permission_id"
                                               name="permission_id" hidden/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <span class="required">Permission Codename</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                               data-bs-trigger="hover" data-bs-html="true"
                                               data-bs-content="Permission codename is required to be unique."></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid"
                                               placeholder="Enter a permission codename"
                                               name="permission_codename" id="permission_codename_update"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Checkbox-->
                                        <label class="form-check form-check-custom form-check-solid me-9">
                                            <input class="form-check-input" type="checkbox"
                                                   name="permission_status_update"
                                                   id="kt_permissions_status_update"/>
                                            <span class="form-check-label"
                                                  for="kt_permissions_status_update">Active ?</span>
                                        </label>
                                        <!--end::Checkbox-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                                data-kt-permissions-modal-action="cancel">Discard
                                        </button>
                                        <button type="submit" class="btn btn-primary"
                                                data-kt-permissions-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
															<span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
                <!--end::Modal - Update permissions-->
            @endcan
            <!--end::Modals-->


        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection

@section('extra_scripts')
    <script src="{{ asset('static/js/custom/apps/user-management/permissions/list.js')}}"></script>
    <script src="{{ asset('static/js/custom/apps/user-management/permissions/add-permission.js')}}"></script>
    <script src="{{ asset('static/js/custom/apps/user-management/permissions/update-permission.js')}}"></script>




    <script>
        var target = document.querySelector("#kt_post");

        var blockUI = new KTBlockUI(target, {
            message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Loading...</div>',
        });


        var _token = $("input[name='_token']").val();
        function edit_permission(permission_id) {

            blockUI.block();
            $.ajax({
                url: "{{ route('fetch_permission') }}",
                type: "POST",
                data: {
                    _token: _token,
                    permission_id: permission_id
                },
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {

                        $("#permission_name_update").val(data.permission.name);
                        $("#permission_codename_update").val(data.permission.codename);
                        $("#permission_id").val(data.permission.id);
                        if (data.permission.is_active) {
                            $("#kt_permissions_status_update").attr("checked", 'checked');
                        }
                        blockUI.release();
                    } else {
                        blockUI.release();
                    }
                }
            });
        }
    </script>
@endsection
