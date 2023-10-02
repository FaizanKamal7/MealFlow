@extends('layouts.admin_master')
@section('title', ' Driver Detail')

@section('extra_style')
@endsection

@section('main_content')

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Navbar-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                        <!--begin: Pic-->
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="{{ asset('static/media/avatars/300-7.jpg') }}" alt="image" />
                                <div
                                    class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px">
                                </div>
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{ $driver->employee->first_name }}
                                            {{ $driver->employee->last_name }}</a>
                                        <a href="#">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z"
                                                        fill="#00A3FF" />
                                                    <path class="permanent"
                                                        d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z"
                                                        fill="white" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->{{ $driver->employee->designation->name }}
                                        </a>
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->{{ $driver->employee->city }},{{ $driver->employee->country }}
                                        </a>
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->{{ $driver->employee->personal_email_address }}
                                        </a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->

                            </div>
                            <!--end::Title-->
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <!--begin::Stats-->
                                    <div class="d-flex flex-wrap">
                                        <!--begin::Stat-->
                                        <div
                                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="13" y="6" width="13"
                                                            height="2" rx="1" transform="rotate(90 13 6)"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <div class="fs-2 fw-bolder" data-kt-countup="true"
                                                    data-kt-countup-value="{{ $driver->employee->employeeSalary }}"
                                                    data-kt-countup-prefix="$">0</div>
                                            </div>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <div class="fw-bold fs-6 text-gray-400">Salary</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                        <!--begin::Stat-->
                                        <div
                                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                                <span class="svg-icon svg-icon-3 svg-icon-danger me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="11" y="18"
                                                            width="13" height="2" rx="1"
                                                            transform="rotate(-90 11 18)" fill="currentColor" />
                                                        <path
                                                            d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <div class="fs-2 fw-bolder" data-kt-countup="true"
                                                    data-kt-countup-value="75">0</div>
                                            </div>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <div class="fw-bold fs-6 text-gray-400">Deliveries</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                        <!--begin::Stat-->
                                        <div
                                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="13" y="6"
                                                            width="13" height="2" rx="1"
                                                            transform="rotate(90 13 6)" fill="currentColor" />
                                                        <path
                                                            d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <div class="fs-2 fw-bolder" data-kt-countup="true"
                                                    data-kt-countup-value="60" data-kt-countup-prefix="%">0</div>
                                            </div>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <div class="fw-bold fs-6 text-gray-400">Performance</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Wrapper-->

                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 active"
                                href="Driver_Detail">Overview</a>
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5"
                                href="{{ route('fleet_view_driver_timeline', ['driver_id' => $driver->id]) }}">Logs</a>
                        </li>
                        <!--end::Nav item-->
                    </ul>
                    <!--begin::Navs-->
                </div>
            </div>
            <!--end::Navbar-->

            <div class="card mb-5 mb-lg-10" id="kt_profile_details_view">
                <!--begin::Card header-->
                <div class=" card-header">
                    <!--begin::Heading-->
                    <div class="card-title">
                        <h3>Profile Details</h3>
                    </div>
                    <!--end::Heading-->
                    <a href="#" class="btn btn-primary align-self-center" data-bs-toggle="modal"
                        data-bs-target="#update_driver_data">Edit Profile</a>

                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-0">
                    <!--begin::Table wrapper-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                            <!--begin::Thead-->
                            <!--end::Thead-->
                            <!--begin::Tbody-->
                            <tbody class="fw-6 fw-bold text-gray-600">

                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600">Full Name</a>
                                    </td>
                                    <td>
                                        <span
                                            class=" fs-7 fw-bolder text text-gray-800">{{ $driver->employee->first_name }}
                                            {{ $driver->employee->last_name }}</span>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600">License Number</a>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800">
                                            {{ $driver->license_number }}</span>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600">License Document</a>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800">
                                            {{ $driver->license_Document ? $driver->license_Document : 'Not Available' }}</span>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600">License Expiry Date</a>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800">
                                            {{ $driver->license_expiry_date }}</span>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600">Contact Phone </a>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800">
                                            {{ $driver->employee->personal_phone_number }}</span>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600">Areas</a>
                                    </td>
                                    <td>
                                        @foreach ($driver->areas as $area)
                                            <span class="badge badge-primary">
                                                {{ $area->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600">Experience</a>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800">
                                            5 Years</span>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>




                            </tbody>
                            <!--end::Tbody-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table wrapper-->
                </div>
                <!--end::Card body-->
            </div>



            <div class="card mb-5 mb-lg-10" id="kt_profile_details_view">
                <!--begin::Card header-->
                <div class=" card-header">
                    <!--begin::Heading-->
                    <div class="card-title">
                        <h3>Employee Details</h3>
                    </div>
                    <!--end::Heading-->

                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-0">
                    <!--begin::Table wrapper-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                            <!--begin::Thead-->
                            <!--end::Thead-->
                            <!--begin::Tbody-->
                            <tbody class="fw-6 fw-bold text-gray-600">

                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600">Full Name</a>
                                    </td>
                                    <td>
                                        <span
                                            class=" fs-7 fw-bolder text text-gray-800">{{ $driver->employee->first_name }}
                                            {{ $driver->employee->last_name }}</span>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600">Email Address</a>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800">
                                            {{ $driver->employee->personal_email_address }} </span>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600">Compony Email <Address></Address></a>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800">
                                            {{ $driver->employee->company_email_address }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600">City</a>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800">

                                            {{ $driver->employee->city }} </span>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600"> Personal Phone Number </a>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800">

                                            {{ $driver->employee->personal_phone_number }} </span>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600">Country</a>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800">

                                            {{ $driver->employee->country }} </span>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600">Martial status </a>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800">

                                            {{ $driver->employee->marital_status }} </span>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600">Hire Date </a>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800">

                                            {{ $driver->employee->hire_date }} </span>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600">probation period Start </a>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800">

                                            {{ $driver->employee->probation_period_start }} </span>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <a class="text-hover-primary text-gray-600">Contract Start Date</a>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800">

                                            {{ $driver->employee->contract_start_date }} </span>
                                    </td>
                                    <td>
                                        <span class=" fs-7 fw-bolder text text-gray-800"></span>
                                    </td>

                                </tr>







                            </tbody>
                            <!--end::Tbody-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table wrapper-->
                </div>
                <!--end::Card body-->
            </div>


        </div>
        <!--end::Container-->
    </div>


    <div class="modal fade" id="update_driver_data" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-750px ">
            <!--begin::Modal content-->
            <div class="modal-content rounded  ">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Heading-->
                <div class="my-1 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Edit Driver Detail</h1>
                    <!--end::Title-->

                </div>
                <!--end::Heading-->

                <!--begin::Modal body-->
                <div class="modal-body  pt-0 ">
                    <!--begin:Form-->
                    <form class="form" action="{{ route('fleet_update_driver_detail', ['driver_id' => $driver]) }}"
                        id="KTModalDriver_form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Modal header-->

                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body py-10 px-lg-13">
                            <!--begin::Scroll-->
                            <div class="scroll-y me-n7 pe-7" id="KTModalDriver_scroll"
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#KTModalDriver_header"
                                data-kt-scroll-wrappers="#KTModalDriver_scroll" data-kt-scroll-offset="300px">
                                <!--begin::Notice-->
                                <!--begin::Notice-->

                                <!--end::Notice-->
                                <!--end::Notice-->
                                <!--begin::Input group-->

                                <div class="row g-9 mb-10">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">license Number</span>
                                        </label>
                                        <!--end::Label-->
                                        <input type="text" class="form-control form-control-solid"
                                            placeholder="Enter license Number" name="license_number"
                                            value=" {{ old('license_number')? old('license_number'): $driver->license_number }}" />
                                        @error('license_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">license Document</span>
                                        </label>
                                        <!--end::Label-->
                                        <input type="file" class="form-control form-control-solid"
                                            placeholder="Enter license Document" name="license_Document" value="{{ old('license_Document')? old('license_Document'): $driver->license_document }}"/>
                                        @error('license_Document')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row g-9 mb-10">

                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-bold mb-2">license Start Date</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">
                                            <!--begin::Datepicker-->
                                            <input class="form-control form-control-solid ps-12"
                                                placeholder="Select a date" name="license_issue_Date"
                                                type="date" value="{{ old('license_issue_Date')? old('license_issue_Date'): $driver->license_issue_date }}" />
                                            <!--end::Datepicker-->
                                        </div>
                                        @error('license_issue_Date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <!--end::Input-->
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-bold mb-2">license Expiry Date</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">

                                            <!--begin::Datepicker-->
                                            <input class="form-control form-control-solid ps-12"
                                                placeholder="Select a date" name="license_expiry_Date"
                                                type="date" value="{{ old('license_expiry_Date')? old('license_expiry_Date'): $driver->license_expiry_date }}" />
                                            <!--end::Datepicker-->
                                        </div>
                                        @error('license_expiry_Date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <!--end::Input-->
                                    </div>
                                    {{-- <div class="col-md-6 fv-row">
									<!--begin::Label-->
									<label class="d-flex align-items-center fs-6 fw-bold mb-2">
										<span class="required">Experience</span>
									</label>
									<!--end::Label-->
									<input type="text" class="form-control form-control-solid" placeholder="Enter Experience " name="KTModalDriver_Experience" />
								</div> --}}

                                </div>
                                <div class="d-flex flex-stack mb-3">
                                    <!--begin::Label-->
                                    <div class="me-5">
                                        <span>
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input mx-4" type="checkbox" name="is_available"
                                                    {{ $driver->is_available ? 'checked' : '' }} /><span
                                                    class="fs-6 fw-bold">Is Available</span>

                                            </label>
                                            @error('is_available')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Switch-->

                                    <!--end::Switch-->
                                </div>
                                <div class="col-md-12 fv-row">
                                    <label for="" class="form-label">Driver Areas</label>
                                    <select class="form-select form-select-lg form-select-solid" data-control="select2"
                                        data-placeholder="Select an option" data-allow-clear="true" multiple="multiple"
                                        id="driver_areas[]" name="driver_areas[]">
                                        @php
                                            // $driver->areas =explode(',', $driver->areas);
                                        @endphp
                                        <option></option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}" >{{ $area->name }} -
                                                {{-- {{ $area->city->name }} --}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>
                            <!--end::Scroll-->
                        </div>
                        <!--end::Modal body-->
                        <!--begin::Modal footer-->
                        <div class="modal-footer flex-center" style="padding: 1.5rem !important;">
                            <!--begin::Button-->
                            <button type="reset" id="KTModalDriver_cancel" class="btn btn-light me-3">Discard</button>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="KTModalDriver_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                        <!--end::Modal footer-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
        </div>
    </div>

    <!--end::Post-->

@endsection

@section('extra_scripts')
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                // Show the modal when there are validation errors
                $('#update_driver_data').modal('show');

            });
        </script>
    @endif

@endsection
