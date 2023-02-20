@extends('layouts.admin_master')
@section('title', 'Roles')

@section('main_content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
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
                            <input type="text" data-kt-roles-table-filter="search"
                                   class="form-control form-control-solid w-250px ps-15"
                                   placeholder="Search roles"/>
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        @can("add_role")
                            <!--begin::Button-->
                            <button type="button" class="btn btn-light-primary" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_add_role">
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
                                <!--end::Svg Icon-->Add Role
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
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_roles_table">
                        <!--begin::Table head-->
                        <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Name</th>
                            <th class="min-w-250px">Permissions</th>
                            <th class="min-w-250px">Assigned to</th>
                            <th class="min-w-125px">Created Date</th>
                            <th class="text-end min-w-100px">Actions</th>
                        </tr>
                        <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                        @foreach($roles as $role)
                            <tr>
                                <!--begin::Name=-->
                                <td> {{ $role->role_name }}</td>
                                <!--end::Name=-->
                                <!--begin::Permissions=-->
                                <td>
                                    @foreach($role->rolePermissions as $permission)
                                        <a href="#"
                                           class="badge badge-light-primary fs-7 m-1">{{ $permission->permission->codename }}</a>
                                    @endforeach
                                </td>
                                <!--end::Permissions=-->
                                <!--begin::Assigned to=-->
                                <td>
                                    @if(count($role->roleUsers) > 0)
                                        @foreach($role->roleUsers as $user)
                                            <a href="#"
                                               class="badge badge-light-primary fs-7 m-1">{{ $user->user->name }} {{ empty($role->roleUsers) }}</a>
                                        @endforeach
                                    @else
                                        <a href="#"
                                           class=" fs-7 m-1">Not Assigned Yet</a>
                                    @endif
                                </td>
                                <!--end::Assigned to=-->
                                <!--begin::Created Date-->
                                <td>20 Dec 2022, 11:30 am</td>
                                <!--end::Created Date-->
                                <!--begin::Action=-->
                                <td class="text-end">
                                    @can("update_role")
                                        <!--begin::Update-->
                                        <a href="{{ route("role_edit", ["role_id"=>$role->id]) }}"
                                           class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
                                        >
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
                                        </a>
                                        <!--end::Update-->
                                    @endcan

                                    @can("delete_role")
                                        <!--begin::Delete-->
                                        <a href="{{ route("role_delete", ["role_id"=>$role->id]) }}"
                                           class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                           data-kt-roles-table-filter="delete_row">
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

            @can("add_role")
                <!--begin::Modal - Add role-->
                <div class="modal fade" id="kt_modal_add_role" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-950px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bolder">Add a Role</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                     data-kt-roles-modal-action="close">
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
                            <div class="modal-body scroll-y mx-lg-5 my-7">
                                <!--begin::Form-->
                                <form id="kt_modal_add_role_form" class="form" method="post"
                                      action="{{ route("role_store") }}">
                                    @csrf
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll"
                                         data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                         data-kt-scroll-max-height="auto"
                                         data-kt-scroll-dependencies="#kt_modal_add_role_header"
                                         data-kt-scroll-wrappers="#kt_modal_add_role_scroll"
                                         data-kt-scroll-offset="300px">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-bolder form-label mb-2">
                                                <span class="required">Role name</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid"
                                                   placeholder="Enter a role name"
                                                   name="role_name"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Permissions-->
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-bolder form-label mb-2">Role Permissions</label>
                                            <!--end::Label-->
                                            <!--begin::Table wrapper-->
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                    <!--begin::Table body-->
                                                    <tbody class="text-gray-600 fw-bold">
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <td class="text-gray-800">Administrator Access
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7"
                                                               data-bs-toggle="tooltip"
                                                               title="Allows a full access to the system"></i></td>
                                                        <td>
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-custom form-check-solid me-9">
                                                                <input class="form-check-input" type="checkbox" value=""
                                                                       id="kt_roles_select_all"/>
                                                                <span class="form-check-label"
                                                                      for="kt_roles_select_all">Select all</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </td>
                                                    </tr>
                                                    <!--end::Table row-->
                                                    @foreach($app_models as $model)
                                                        <!--begin::Table row-->
                                                        <tr>
                                                            <!--begin::Label-->
                                                            <td class="text-gray-800">{{ $model->model_name }} </td>
                                                            <!--end::Label-->
                                                            <!--begin::Options-->
                                                            <td>
                                                                <!--begin::Wrapper-->
                                                                <div class="d-flex">
                                                                    @foreach($model->permissions as $permission)
                                                                        <!--begin::Checkbox-->
                                                                        <label
                                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                            <input class="form-check-input"
                                                                                   type="checkbox"
                                                                                   value="{{ $permission->id }}"
                                                                                   name="permissions[]"/>
                                                                            <span
                                                                                class="form-check-label">{{ $permission->name }} </span>
                                                                        </label>
                                                                        <!--end::Checkbox-->
                                                                    @endforeach

                                                                </div>
                                                                <!--end::Wrapper-->
                                                            </td>
                                                            <!--end::Options-->
                                                        </tr>
                                                        <!--end::Table row-->
                                                    @endforeach

                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Table wrapper-->
                                        </div>
                                        <!--end::Permissions-->
                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                                data-kt-roles-modal-action="cancel">
                                            Discard
                                        </button>
                                        <button type="submit" class="btn btn-primary"
                                                data-kt-roles-modal-action="submit">
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
                <!--end::Modal - Add role-->
            @endcan


            @can("update_role")
                <!--begin::Modal - Update role-->
                <div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-750px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bolder">Update Role</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                     data-kt-roles-modal-action="close">
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
                            <div class="modal-body scroll-y mx-5 my-7">
                                <!--begin::Form-->
                                <form id="kt_modal_update_role_form" class="form" action="#">
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll"
                                         data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                         data-kt-scroll-max-height="auto"
                                         data-kt-scroll-dependencies="#kt_modal_update_role_header"
                                         data-kt-scroll-wrappers="#kt_modal_update_role_scroll"
                                         data-kt-scroll-offset="300px">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-bolder form-label mb-2">
                                                <span class="required">Role name</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid"
                                                   placeholder="Enter a role name"
                                                   name="role_name" id="role_name_update" value=""/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Permissions-->
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-bolder form-label mb-2">Role Permissions</label>
                                            <!--end::Label-->
                                            <!--begin::Table wrapper-->
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                    <!--begin::Table body-->
                                                    <tbody class="text-gray-600 fw-bold">
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <td class="text-gray-800">Administrator Access
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7"
                                                               data-bs-toggle="tooltip"
                                                               title="Allows a full access to the system"></i></td>
                                                        <td>
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                                <input class="form-check-input" type="checkbox" value=""
                                                                       id="kt_roles_select_all"/>
                                                                <span class="form-check-label"
                                                                      for="kt_roles_select_all">Select all</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </td>
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">User Management</td>
                                                        <!--end::Label-->
                                                        <!--begin::Input group-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="user_management_read"/>
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="user_management_write"/>
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="user_management_create"/>
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Input group-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">Content Management</td>
                                                        <!--end::Label-->
                                                        <!--begin::Input group-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="content_management_read"/>
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="content_management_write"/>
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="content_management_create"/>
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Input group-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">Financial Management</td>
                                                        <!--end::Label-->
                                                        <!--begin::Input group-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="financial_management_read"/>
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="financial_management_write"/>
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="financial_management_create"/>
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Input group-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">Reporting</td>
                                                        <!--end::Label-->
                                                        <!--begin::Input group-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="reporting_read"/>
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="reporting_write"/>
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="reporting_create"/>
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Input group-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">Payroll</td>
                                                        <!--end::Label-->
                                                        <!--begin::Input group-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="payroll_read"/>
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="payroll_write"/>
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="payroll_create"/>
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Input group-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">Disputes Management</td>
                                                        <!--end::Label-->
                                                        <!--begin::Input group-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="disputes_management_read"/>
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="disputes_management_write"/>
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="disputes_management_create"/>
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Input group-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">API Controls</td>
                                                        <!--end::Label-->
                                                        <!--begin::Input group-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="api_controls_read"/>
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="api_controls_write"/>
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="api_controls_create"/>
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Input group-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">Database Management</td>
                                                        <!--end::Label-->
                                                        <!--begin::Input group-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="database_management_read"/>
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="database_management_write"/>
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="database_management_create"/>
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Input group-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">Repository Management</td>
                                                        <!--end::Label-->
                                                        <!--begin::Input group-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="repository_management_read"/>
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="repository_management_write"/>
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value=""
                                                                           name="repository_management_create"/>
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Input group-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Table wrapper-->
                                        </div>
                                        <!--end::Permissions-->
                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                                data-kt-roles-modal-action="cancel">
                                            Discard
                                        </button>
                                        <button type="submit" class="btn btn-primary"
                                                data-kt-roles-modal-action="submit">
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
                <!--end::Modal - Update role-->
                @endcan
                    <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection

@section('extra_scripts')
    <script src="{{ asset('static/js/custom/apps/user-management/roles/list/add.js')}}"></script>
    <script src="{{ asset('static/js/custom/apps/user-management/roles/list/list.js')}}"></script>
    <script src="{{ asset('static/js/custom/apps/user-management/roles/list/update-role.js')}}"></script>

@endsection
