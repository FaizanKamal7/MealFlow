<!--begin::Aside menu-->
<div class="aside-menu flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
        data-kt-scroll-offset="0">
        <!--begin::Menu-->
        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <a href="{{ route("admin_dashboard") }}">
                    <span class="menu-link">

                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Dashboard </span>
                    </span>
                </a>
            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                    fill="currentColor"></path>
                                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title">Business Management</span>
                    <span class="menu-arrow"></span>

                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg" style="display: none; overflow: hidden;">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route("business_home") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route("permissions_view") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Branches</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route("roles_view") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Pricing Info</span>
                        </a>
                    </div>




                </div>
            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                    fill="currentColor"></path>
                                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title">User Management</span>
                    <span class="menu-arrow"></span>

                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg" style="display: none; overflow: hidden;">
                    @can("view_permissions")
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route("permissions_view") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Permissions</span>
                        </a>
                    </div>
                    @endcan

                    @can("view_role")
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route("roles_view") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Roles</span>
                        </a>
                    </div>
                    @endcan

                    @can("view_users")
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route("users_view") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Users</span>
                        </a>
                    </div>

                    @endcan

                </div>
            </div>

            <div class="menu-item">
                <div class="menu-content pt-5 pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">OPERATIONS</span>
                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class=" menu-link">
                    <span class="svg-icon svg-icon-muted svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z"
                                fill="currentColor" />
                            <path opacity="0.3"
                                d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z"
                                fill="currentColor" />
                        </svg></span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-2">Deliveries</span>
                    <span class="menu-arrow"></span>
                </span>

                <div class="menu-sub menu-sub-accordion menu-active-bg">

                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">upload Deliveries</span>
                        </a>
                    </div>


                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Unassigned Deliveries</span>
                        </a>
                    </div>


                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Completed Deliveries</span>
                            <span class="menu-arrow"></span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Delayed Deliveries</span>
                        </a>
                    </div>

                </div>

            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-muted svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3"
                                d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                fill="currentColor" />
                            <path
                                d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                fill="currentColor" />
                        </svg></span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-2">Bag Collections</span>
                    <span class="menu-arrow"></span>
                </span>

            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-muted svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z"
                                fill="currentColor" />
                            <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z"
                                fill="currentColor" />
                            <path opacity="0.3"
                                d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z"
                                fill="currentColor" />
                        </svg></span>
                    <span class="menu-title mx-2">Bag Tracking</span>
                    <span class="menu-arrow"></span>
                </span>

            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-muted svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M20 19.725V18.725C20 18.125 19.6 17.725 19 17.725H5C4.4 17.725 4 18.125 4 18.725V19.725H3C2.4 19.725 2 20.125 2 20.725V21.725H22V20.725C22 20.125 21.6 19.725 21 19.725H20Z"
                                fill="currentColor" />
                            <path opacity="0.3"
                                d="M22 6.725V7.725C22 8.325 21.6 8.725 21 8.725H18C18.6 8.725 19 9.125 19 9.725C19 10.325 18.6 10.725 18 10.725V15.725C18.6 15.725 19 16.125 19 16.725V17.725H15V16.725C15 16.125 15.4 15.725 16 15.725V10.725C15.4 10.725 15 10.325 15 9.725C15 9.125 15.4 8.725 16 8.725H13C13.6 8.725 14 9.125 14 9.725C14 10.325 13.6 10.725 13 10.725V15.725C13.6 15.725 14 16.125 14 16.725V17.725H10V16.725C10 16.125 10.4 15.725 11 15.725V10.725C10.4 10.725 10 10.325 10 9.725C10 9.125 10.4 8.725 11 8.725H8C8.6 8.725 9 9.125 9 9.725C9 10.325 8.6 10.725 8 10.725V15.725C8.6 15.725 9 16.125 9 16.725V17.725H5V16.725C5 16.125 5.4 15.725 6 15.725V10.725C5.4 10.725 5 10.325 5 9.725C5 9.125 5.4 8.725 6 8.725H3C2.4 8.725 2 8.325 2 7.725V6.725L11 2.225C11.6 1.925 12.4 1.925 13.1 2.225L22 6.725ZM12 3.725C11.2 3.725 10.5 4.425 10.5 5.225C10.5 6.025 11.2 6.725 12 6.725C12.8 6.725 13.5 6.025 13.5 5.225C13.5 4.425 12.8 3.725 12 3.725Z"
                                fill="currentColor" />
                        </svg></span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-2">Cash Collections</span>
                    <span class="menu-arrow"></span>
                </span>

            </div>


            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-muted svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z"
                                fill="currentColor" />
                            <path opacity="0.3"
                                d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z"
                                fill="currentColor" />
                            <path opacity="0.3"
                                d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z"
                                fill="currentColor" />
                        </svg></span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-2">Fleet</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route("fleet_dashboard") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route("all_fleets") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Fleets</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route("add_fleet") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Add New</span>
                        </a>
                    </div>

                </div>

            </div>
            <div class="separator"></div>
            <div class="menu-item">
                <div class="menu-content pt-5 pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">ACCOUNTS</span>
                </div>
            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-muted svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z"
                                fill="currentColor" />
                            <path opacity="0.3"
                                d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z"
                                fill="currentColor" />
                            <path opacity="0.3"
                                d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z"
                                fill="currentColor" />
                        </svg></span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-2">Operations</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route("business_new_requests") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">New Businesses Requests</span>
                        </a>
                    </div>


                </div>

            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-muted svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                fill="currentColor" />
                            <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor" />
                        </svg></span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-2">Patners</span>

                </span>

            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-muted svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor" />
                            <path opacity="0.3"
                                d="M12 14.4L9.89999 16.5C9.69999 16.7 9.39999 16.8 9.19999 16.8C8.99999 16.8 8.7 16.7 8.5 16.5C8.1 16.1 8.1 15.5 8.5 15.1L10.6 13L12 14.4ZM13.4 13L15.5 10.9C15.9 10.5 15.9 9.90001 15.5 9.50001C15.1 9.10001 14.5 9.10001 14.1 9.50001L12 11.6L13.4 13Z"
                                fill="currentColor" />
                            <path
                                d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.2C9.7 3 10.2 3.20001 10.4 3.60001ZM13.4 13L15.5 10.9C15.9 10.5 15.9 9.9 15.5 9.5C15.1 9.1 14.5 9.1 14.1 9.5L12 11.6L9.89999 9.5C9.49999 9.1 8.9 9.1 8.5 9.5C8.1 9.9 8.1 10.5 8.5 10.9L10.6 13L8.5 15.1C8.1 15.5 8.1 16.1 8.5 16.5C8.7 16.7 9 16.8 9.2 16.8C9.4 16.8 9.69999 16.7 9.89999 16.5L12 14.4L14.1 16.5C14.3 16.7 14.6 16.8 14.8 16.8C15 16.8 15.3 16.7 15.5 16.5C15.9 16.1 15.9 15.5 15.5 15.1L13.4 13Z"
                                fill="currentColor" />
                        </svg></span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-2">Cancelled</span>
                    >
                </span>

            </div>
            <div class="separator"></div>

            <div class="menu-item">
                <div class="menu-content pt-5 pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">HRM</span>
                </div>
            </div>
            <div class="separator"></div>
            @can("view_hr")
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/communication/come013.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                    fill="currentColor"></path>
                                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title">HR Management</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg" style="display: none; overflow: hidden;">

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">HR Setup</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            @can("add_department")
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route("hr_departments") }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Departments</span>
                                </a>
                            </div>
                            @endcan

                            @can("view_designation")
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route("hr_designations") }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Designations</span>
                                </a>
                            </div>
                            @endcan

                            @can("view_events")
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route("hr_events") }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Events</span>
                                </a>
                            </div>
                            @endcan

                            @can("view_award")
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route("hr_awards") }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Awards</span>
                                </a>
                            </div>
                            @endcan

                            @can("view_appreciation")

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route("hr_appreciations") }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Appreciations</span>
                                </a>
                            </div>

                            @endcan

                            @can("view_taxes")
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route("hr_taxes") }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Taxes</span>
                                </a>
                            </div>
                            @endcan



                        </div>
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Employees</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">


                            @can("view_employee")
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route("hr_employees") }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Employees</span>
                                </a>
                            </div>
                            @endcan

                            @can("view_employee")
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route("hr_salaries") }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Employee Salaries</span>
                                </a>
                            </div>
                            @endcan

                            @can("view_timesheet")
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route("hr_timesheets") }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Timesheets</span>
                                </a>
                            </div>
                            @endcan

                            @can("view_overtime")
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route("hr_overtimes") }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Overtimes</span>
                                </a>
                            </div>
                            @endcan

                            @can("view_deduction")
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route("hr_deductions") }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Deductions</span>
                                </a>
                            </div>
                            @endcan

                            @can("view_expense_reclaim")
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route("hr_expense_reclaims") }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Expense Reclaims</span>
                                </a>
                            </div>
                            @endcan


                        </div>
                    </div>

                    @can("view_team")
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route("hr_teams") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Teams</span>
                        </a>
                    </div>
                    @endcan


                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Time Off</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">

                            @can("view_attendence")

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route("hr_attendance") }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Attendance</span>
                                </a>
                            </div>
                            @endcan

                            @can("view_leave_application")
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route("hr_leave_applications") }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Leave Applications</span>
                                </a>
                            </div>
                            @endcan

                            @can("view_leave_type")
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route("hr_leave_types") }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Leave Types</span>
                                </a>
                            </div>
                            @endcan

                            @can("view_leave_policy")
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route("leave_policy") }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Leave Policies</span>
                                </a>
                            </div>
                            @endcan

                        </div>
                    </div>

                </div>
            </div>
            @endcan
            <div class="separator"></div>
            <div class="menu-item">
                <div class="menu-content pt-5 pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">TEAM</span>
                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-muted svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z"
                                fill="currentColor" />
                            <rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="currentColor" />
                            <path
                                d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z"
                                fill="currentColor" />
                            <rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="currentColor" />
                        </svg></span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-2">Indoor Team</span>
                    <span class="menu-arrow"></span>
                </span>

            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-muted svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z"
                                fill="currentColor" />
                            <rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="currentColor" />
                            <path
                                d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z"
                                fill="currentColor" />
                            <rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="currentColor" />
                        </svg></span>
                    <span class="menu-title mx-2">Outdoor Team</span>
                    <span class="menu-arrow"></span>
                </span>

            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-muted svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z"
                                fill="currentColor" />
                            <rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="currentColor" />
                            <path
                                d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z"
                                fill="currentColor" />
                            <rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="currentColor" />
                        </svg></span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-2">Storekeeper</span>
                    <span class="menu-arrow"></span>
                </span>

            </div>

            <div class="separator"></div>


            <div class="menu-item">
                <div class="menu-content pt-5 pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">MEAL
                        PLANNER</span>
                </div>
            </div>

            <div class="menu-item">
                <div class="menu-content pt-5 pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">SETTINGS</span>
                </div>
            </div>


            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                    fill="currentColor"></path>
                                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title">Locations</span>
                    <span class="menu-arrow"></span>

                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg" style="display: none; overflow: hidden;">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route("business_home") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Active Countries</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route("permissions_view") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Active States</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route("roles_view") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Active Cities</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route("roles_view") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Active Areas</span>
                        </a>
                    </div>




                </div>
            </div>


            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <a href="{{ route('get_all_delivery_slots') }}">

                    <span class="menu-link">

                        <span class="svg-icon svg-icon-muted svg-icon-1x"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="15" viewBox="0 0 16 15" fill="none">
                                <rect y="6" width="16" height="3" rx="1.5" fill="currentColor" />
                                <rect opacity="0.3" y="12" width="8" height="3" rx="1.5" fill="currentColor" />
                                <rect opacity="0.3" width="12" height="3" rx="1.5" fill="currentColor" />
                            </svg></span>
                        <!--end::Svg Icon-->
                        <span class="menu-title mx-2">Delivery Slots</span>

                    </span>
                </a>

            </div>


            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">

                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-muted svg-icon-1x"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="15" viewBox="0 0 16 15" fill="none">
                            <rect y="6" width="16" height="3" rx="1.5" fill="currentColor" />
                            <rect opacity="0.3" y="12" width="8" height="3" rx="1.5" fill="currentColor" />
                            <rect opacity="0.3" width="12" height="3" rx="1.5" fill="currentColor" />
                        </svg></span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-2">Pricing Info</span>

                </span>


            </div>

            <div class="menu-item">
                <a class="menu-link" href="#">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: assets/media/icons/duotune/art/art005.svg-->
                        <span class="svg-icon svg-icon-2 text-black-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.3"
                                    d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                    fill="currentColor" />
                                <path
                                    d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title">System Settings</span>
                    {{-- @can("settings") --}}
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route("settings") }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Settings</span>
                        </a>
                    </div>
                    {{-- @endcan --}}

                </a>
            </div>

        </div>



    </div>


</div>
<!--end::Menu-->