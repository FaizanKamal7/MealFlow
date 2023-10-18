<!--begin::Aside menu-->

<div class="aside-menu flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
        data-kt-scroll-offset="0" style="    --scrollbar-space: 1px !important;">
        <!--begin::Menu-->
        <div class="separator"></div>
        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
            <div class="menu-item">
                <div class="menu-content pt-5 pb-2">
                    <span class="menu-section text-dark text-uppercase fs-8 ls-1">MAIN</span>
                </div>
            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <a href="{{ route('admin_dashboard') }}">
                    <span class="menu-link">

                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon side-icon svg-icon-2">
                                <x-iconsax-bul-element-3 />
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title mx-5">Dashboard </span>
                    </span>
                </a>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <a href="{{ route('viewWallet') }}">
                    <span class="menu-link">

                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon side-icon svg-icon-2">
                                <x-iconsax-bol-wallet-3 />
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title mx-5">Wallet </span>
                    </span>
                </a>
            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                        <span class="svg-icon side-icon svg-icon-2">
                            <x-iconsax-bol-home-trend-up />
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title mx-5">Business Management</span>
                    <span class="menu-arrow"></span>

                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg" style="display: none; overflow: hidden;">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('business_home') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('permissions_view') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Branches</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('delivery_slot_wise_base_pricing') }}">
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
                        <span class="svg-icon side-icon svg-icon-2">
                            <x-iconsax-bol-user />
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title mx-5">User Management</span>
                    <span class="menu-arrow"></span>

                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('permissions_view') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Permissions</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('roles_view') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Roles</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('users_view') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Users</span>
                        </a>
                    </div>


                </div>
            </div>
            <div class="separator"></div>


            <div class="menu-item">
                <div class="menu-content pt-5 pb-2">
                    <span class="menu-section text-dark text-uppercase fs-8 ls-1">OPERATIONS</span>
                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class=" menu-link">
                    <span class="svg-icon side-icon svg-icon-muted svg-icon-2">
                        <x-iconsax-bol-box />
                    </span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-5">Deliveries</span>
                    <span class="menu-arrow"></span>
                </span>

                <div class="menu-sub menu-sub-accordion menu-active-bg">

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('upload_deliveries') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Upload Deliveries</span>
                        </a>
                    </div>


                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('unassigned_deliveries') }}">

                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Unassigned Deliveries</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('view_assigned_deliveries') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Assigned Deliveries</span>
                        </a>
                    </div>


                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('view_completed_deliveries') }}">
                            <span class=" menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Completed Deliveries</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Completed Deliveries (CS)</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">API Paused Deliveries</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Cancelled Deliveries</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Rescheduled Deliveries</span>
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

                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Deleted Deliveries</span>
                        </a>
                    </div>



                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Delivery Insights</span>
                        </a>
                    </div>

                </div>

            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon side-icon svg-icon-muted svg-icon-2">
                        <x-iconsax-bol-bag-2 />
                    </span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-5">Bag Collections</span>
                    <span class="menu-arrow"></span>
                </span>

                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('upload_bags_collection') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Upload Bag Collection</span>
                        </a>
                    </div>
                </div>

                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('unassigned_bags_collection') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Unassigned Bag Collections</span>
                        </a>
                    </div>
                </div>

                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('assigned_bags_collection') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Assigned Bag Collections</span>
                        </a>
                    </div>
                </div>

                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('completed_bags_collection') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Completed Bag Collections</span>
                        </a>
                    </div>
                </div>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('cancelled_bags_collection') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Cancelled Bag Collections</span>
                        </a>
                    </div>
                </div>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('deleted_bags_collection') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Deleted Bag Collections</span>
                        </a>
                    </div>
                </div>
            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class=" menu-link">
                    <span class="svg-icon side-icon svg-icon-muted svg-icon-2">
                        <x-iconsax-bol-box />
                    </span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-5">Bag Pickup</span>
                    <span class="menu-arrow"></span>
                </span>

                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('unassigned_bags_pickup') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Unassigned Bag Pickups (Delivery Wise)</span>
                        </a>
                    </div>
                </div>

                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('assigned_bags_pickup') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Unassigned Bag Pickups (Partner Wise)</span>
                        </a>
                    </div>
                </div>

                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('assigned_bags_pickup') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Assigned Bag Pickups</span>
                        </a>
                    </div>
                </div>

                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('completed_bags_pickup') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Collected Bag Pickups</span>
                        </a>
                    </div>
                </div>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('unassigned_bags_pickup') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Requested Cancel</span>
                        </a>
                    </div>
                </div>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('unassigned_bags_pickup') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Cancelled Bag Pickups</span>
                        </a>
                    </div>
                </div>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('unassigned_bags_pickup') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Report Bag Pickups</span>
                        </a>
                    </div>
                </div>

            </div>


            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class=" menu-link">
                    <span class="svg-icon side-icon svg-icon-muted svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z"
                                fill="currentColor" />
                            <path opacity="0.3"
                                d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z"
                                fill="currentColor" />
                        </svg></span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-5">Bag tracking</span>
                    <span class="menu-arrow"></span>
                </span>

                <div class="menu-sub menu-sub-accordion menu-active-bg">

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('add_new_bag') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Add bag</span>
                        </a>
                    </div>


                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('view_all_bags') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">View bag</span>
                        </a>
                    </div>




                </div>

            </div>


            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon side-icon svg-icon-muted svg-icon-2">
                        <x-iconsax-bol-moneys />
                    </span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-5">Cash Collections</span>
                    {{-- <span class="menu-arrow"></span> --}}
                </span>

            </div>


            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                        <span class="svg-icon side-icon svg-icon-muted svg-icon-2">
                            <x-iconsax-bol-ship />
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title mx-5">Fleet Managment</span>
                    <span class="menu-arrow"></span>

                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title"> Setup </span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('view_vehicle_types') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">vehicles type</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('view_vehicle_models') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">vehicles Model</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="menu-item">

                        <a class="menu-link" href="{{ route('fleet_dashboard') }}">

                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Fleet Dashboard</span>
                        </a>
                    </div>

                    {{-- <div class="menu-item">
                        <a class="menu-link" href="Fleet_detail">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Fleet Detail</span>
                        </a>
                    </div> --}}

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('fleet_vehicle_add') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Add New Fleet</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('fleet_view_drivers') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Drivers</span>
                        </a>
                    </div>

                    <div class="menu-item">

                        <a class="menu-link" href="{{ route('fleet_vehicle') }}">

                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">View Fleet</span>
                        </a>
                    </div>

                    <div class="menu-item">

                        <a class="menu-link" href="{{ route('fleet_vehicle_timeline') }}">

                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Vehicle Timeline</span>
                        </a>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Mentainence</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">


                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('fleet_fuel') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">vehicles Fuel</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('fleet_maintenance') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">vehicles Mentainence</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="menu-sub menu-sub-accordion menu-active-bg" style="display: none; overflow: hidden;">
                    <div class="menu-item">
                        <a class="menu-link" href="/Fleet">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Fleet Dashboard</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="Fleet_detail">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Fleet Detail</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="add_Fleet">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Add Fleet</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="Driver">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Drivers</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="ViewFleet">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">View Fleet</span>
                        </a>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Mentainence</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">

                            <div class="menu-item">
                                <a class="menu-link" href="vehicles_types">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">vehicles type</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="vehicles_types">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">vehicles Make</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="vehicles_types">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">vehicles Model</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="vehicles_Fuels">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">vehicles Fuel</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="vehicles_mentainance">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">vehicles Mentainence</span>
                                </a>
                            </div>


                        </div>
                    </div>

                </div>
            </div>

            <div class="separator"></div>
            <div class="menu-item">
                <div class="menu-content pt-5 pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Partners</span>
                </div>
            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon side-icon svg-icon-muted svg-icon-2">
                        <x-iconsax-bol-password-check />
                    </span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-5">Partners</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('business_new_requests') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">New Businesses Requests</span>
                        </a>
                    </div>


                </div>
                <div class="menu-sub menu-sub-accordion menu-active-bg">

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('get_all_businesses') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">All Businesses</span>
                        </a>
                    </div>


                </div>
                <div class="menu-sub menu-sub-accordion menu-active-bg">

                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                        <span class="svg-icon side-icon svg-icon-muted svg-icon-2"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                    fill="currentColor" />
                                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('view_all_customers') }}">
                                {{-- <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span> --}}
                                <span class="menu-title">Customers</span>
                            </a>
                        </div>


                </div>

            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon side-icon svg-icon-muted svg-icon-2">
                        <x-iconsax-bul-shield-cross />
                    </span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-5">Cancelled</span>

                </span>

            </div>
            {{-- <div class="separator"></div> --}}

            <div class="menu-item">
                <div class="menu-content pt-5 pb-2">
                    <span class="menu-section text-dark text-uppercase fs-8 ls-1">HRM</span>
                </div>
            </div>
            <div class="separator"></div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/communication/come013.svg-->
                        <span class="svg-icon side-icon svg-icon-2">
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
                    <span class="menu-title mx-5">HR Management</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">HR Setup</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hr_departments') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Departments</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hr_designations') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Designations</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hr_events') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Events</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hr_awards') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Awards</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hr_appreciations') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Appreciations</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hr_taxes') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Taxes</span>
                                </a>
                            </div>



                        </div>
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title mx-5">Employees</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">


                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hr_employees') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Employees</span>
                                </a>
                            </div>


                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hr_salaries') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Employee Salaries</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hr_timesheets') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Timesheets</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hr_overtimes') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Overtimes</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hr_deductions') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Deductions</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hr_expense_reclaims') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Expense Reclaims</span>
                                </a>
                            </div>


                        </div>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('hr_teams') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title mx-5">Teams</span>
                        </a>
                    </div>


                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Time Off</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hr_attendance') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Attendance</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hr_leave_applications') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Leave Applications</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hr_leave_types') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Leave Types</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('leave_policy') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Leave Policies</span>
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="separator"></div>

            <div class="menu-item">
                <div class="menu-content pt-5 pb-2">
                    <span class="menu-section text-dark text-uppercase fs-8 ls-1">TEAM</span>
                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon side-icon svg-icon-muted svg-icon-2">
                        <x-iconsax-bol-buliding />
                    </span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-5">Indoor Team</span>
                    {{-- <span class="menu-arrow"></span> --}}
                </span>

            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon side-icon svg-icon-muted svg-icon-2">
                        <x-iconsax-bul-buildings-2 />
                    </span>
                    <span class="menu-title mx-5">Outdoor Team</span>
                    {{-- <span class="menu-arrow"></span> --}}
                </span>

            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon side-icon svg-icon-muted svg-icon-2">
                        <x-iconsax-bul-shop />
                    </span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-5">Storekeeper</span>
                    {{-- <span class="menu-arrow"></span> --}}
                </span>

            </div>

            <div class="separator"></div>


            {{-- <div class="menu-item">
                <div class="menu-content pt-5 pb-2">
                    <span class="menu-section text-dark text-uppercase fs-8 ls-1">MEAL
                        PLANNER</span>
                </div>
            </div> --}}

            <div class="menu-item">
                <div class="menu-content pt-5 pb-2">
                    <span class="menu-section text-dark text-uppercase fs-8 ls-1">SETTINGS</span>
                </div>
            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    {{-- <span class="menu-icon"> --}}
                        <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                        <span class="svg-icon side-icon svg-icon-2">
                            <x-iconsax-bol-picture-frame />
                        </span>
                        <!--end::Svg Icon-->
                        {{--
                    </span> --}}
                    <span class="menu-title mx-5">Locations</span>
                    <span class="menu-arrow"></span>

                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('activate_locations_view') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Activate Locations</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('activated_locations_view') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Activated Locations</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('business_home') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Active Countries</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('permissions_view') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Active States</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('roles_view') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Active Cities</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('roles_view') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Active Areas</span>
                        </a>
                    </div>
                </div>
            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                    <span class="svg-icon side-icon svg-icon-2">
                        <x-iconsax-bol-dollar-square />
                    </span>
                    <!--end::Svg Icon-->
                    <span class="menu-title mx-5">Pricing Info</span>
                    <span class="menu-arrow"></span>

                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg" style="overflow: hidden;">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('delivery_slot_wise_base_pricing') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Pricing (Delivery Slot Wise)</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('range_base_pricing') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Pricing (Daily Range Wise)</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('delivery_slot_wise_base_pricing') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Partner Pricing </span>
                        </a>
                    </div>

                </div>
            </div>



            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <a href="{{ route('get_all_delivery_slots') }}">

                    <span class="menu-link">

                        <span class="svg-icon side-icon svg-icon-muted svg-icon-1x">
                            <x-iconsax-bol-convert-3d-cube />
                        </span>
                        <!--end::Svg Icon-->
                        <span class="menu-title mx-5">Delivery Slots</span>

                    </span>
                </a>

            </div>


            <div class="menu-item">
                <a class="menu-link" href="#">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: assets/media/icons/duotune/art/art005.svg-->
                        <span class="svg-icon side-icon svg-icon-2 text-black-50">
                            <x-iconsax-bul-setting />
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title mx-5">System Settings</span>
                    {{-- @can('settings') --}}
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('settings') }}">
                            {{-- <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span> --}}
                            {{-- <span class="menu-title">Settings</span> --}}
                        </a>
                    </div>
                    {{-- @endcan --}}

                </a>
            </div>

        </div>
        <div class="d-flex justify-content-center">
            <a href="https://www.nixus.tech/" class="btn btn-custom btn-warning w-100" data-bs-toggle="tooltip"
                data-bs-trigger="hover" data-bs-dismiss-="click" title="visit Nixus.com" style="border: 0.5px solid rgba(0, 83, 138, 0.12);
                box-shadow: 0px 4px 24px 0px rgba(0, 83, 138, 0.3) !important;
                background: rgba(0, 66, 110, 1);
                border-radius: 6px;
                width: 200px !important;">
                <span class="btn-label">Visit Nixus.com</span>
                <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg') }}-->
                {{-- <span class="svg-icon side-icon btn-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3"
                            d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z"
                            fill="currentColor" />
                        <rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor" />
                        <rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor" />
                        <rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor" />
                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
                    </svg>
                </span> --}}
                <!--end::Svg Icon-->
            </a>
        </div>

    </div>


</div>
<!--end::Menu-->
<script>
    // function to make menu open when page refreshes or changes
    document.addEventListener("DOMContentLoaded", function() {
        // Check if a menu item is stored in session storage
        const selectedMenuItem = sessionStorage.getItem("selectedMenuItem");
        // If a menu item is stored, select it and expand its submenu
        if (selectedMenuItem) {
            const menuLink = document.querySelector(`a[href="${selectedMenuItem}"]`);
            if (menuLink) {
                // Expand the submenu (if applicable)
                const submenu = menuLink.closest(".menu-item.menu-accordion");
                if (submenu) {
                    submenu.classList.add("menu-item-open");
                }
                // Add "active" class to the selected menu item and its parent menu items
                menuLink.classList.add("active");
                // Open the parent menu items (if applicable)
                const parentMenus = menuLink.parents(".menu-item.menu-accordion");
                parentMenus.forEach((parentMenu) => {
                    parentMenu.classList.add("menu-item-open", "hover", "show"); // Add classes here
                });
            }
        }
        // Add click event listeners to menu items to store the selected item
        const menuItems = document.querySelectorAll(".menu-item.menu-accordion a");
        // console.log('menuityem', menuItems)
        menuItems.forEach((menuItem) => {
            menuItem.addEventListener("click", function() {
                const href = menuItem.getAttribute("href");
                // Store the selected menu item in session storage
                sessionStorage.setItem("selectedMenuItem", href);
            });
        });
    });
    // Helper function to get all parent menu items
    Element.prototype.parents = function(selector) {
        const parents = [];
        let currentElement = this;
        while (currentElement) {
            if (currentElement.matches(selector)) {
                parents.push(currentElement);
            }
            currentElement = currentElement.parentElement;
        }
        return parents;
    };
</script>