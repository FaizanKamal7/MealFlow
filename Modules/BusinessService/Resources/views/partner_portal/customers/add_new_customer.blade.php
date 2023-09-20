@extends('businessservice::layouts.master')

@section('main_content')

<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">

        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">

                <!--begin::Form-->
                <form class="my-auto pb-5" method="post" id="kt_create_account_form"
                    action="{{ route('store_new_customer') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <h2 class="fw-bolder">Add a Customer</h2>
                    <!--end::Modal title-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fs-6 fw-bold mb-2">Name</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" placeholder="" name="name"
                            placeholder="Enter Customer Name" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6 required">Email
                            Address</label>
                        <input class="form-control form-control-lg form-control-solid" placeholder="" name="email"
                            autocomplete="off" />
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row">
                        <div class="col-md-6 mb-5 fv-row" data-kt-password-meter="true">
                            <!--begin::Wrapper-->
                            <div class="mb-1">
                                <!--begin::Label-->
                                <label class="form-label fw-bolder text-dark fs-6 required">Password</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-5">
                                    <input class="form-control form-control-lg form-control-solid" type="password"
                                        placeholder="" name="password" autocomplete="off" />
                                    <span
                                        class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                        data-kt-password-meter-control="visibility">
                                        <i class="bi bi-eye-slash fs-2"></i>
                                        <i class="bi bi-eye fs-2 d-none"></i>
                                    </span>
                                </div>
                                <!--end::Input wrapper-->
                                <!--begin::Meter-->
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                    </div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                    </div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                    </div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px">
                                    </div>
                                </div>
                                <!--end::Meter-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Hint-->
                            <div class="text-muted">Use 8 or more characters with a mix of letters,
                                numbers &amp; symbols.</div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Input group-->
                        <div class="col-md-6 fv-row mb-5">
                            <label class="form-label fw-bolder text-dark fs-6 required">Confirm
                                Password</label>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                placeholder="" name="confirm_password" autocomplete="off" />
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label required">Phone Number</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input name="phone" class="form-control form-control-lg form-control-solid" type="numbers" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <label class="form-label required">Address (Business Main Branch
                            Address)</label>
                        <br>
                        <div class="form-group row" id="google_map_address_selection">
                            <input class="form-control form-control-lg form-control-solid" name="map_address"
                                id="search-location" type="text" placeholder="Enter you address here">
                            <br><br>
                            <!--begin::HINTS-->
                            <div class="alert alert-primary d-flex align-items-center p-5">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span
                                        class="path1"></span><span class="path2"></span></i>
                                <!--end::Icon-->


                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column">
                                    <!--begin::Title-->
                                    <h4 class="mb-1 text-dark">Hints</h4>
                                    <!--end::Title-->

                                    <!--begin::Content-->
                                    <li class="d-flex align-items-center py-2">
                                        <span class="bullet bullet-dot bg-primary me-5"></span><i> &nbsp
                                            You
                                            can your exact location don't
                                            show
                                            up in the search suggestions, search nearest location and
                                            drap
                                            and drop
                                            pic
                                            to your exact location.</i>

                                    </li>
                                    <li class="d-flex align-items-center py-2">
                                        <span class="bullet bullet-dot bg-primary me-5"></span>
                                        </span><i>
                                            &nbsp Use
                                            <code>CTRL + scroll</code>
                                            to zoom the map </i>
                                    </li>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::HINTS -->
                            <div id="address_map" style="height: 400px; width: 100%;"></div>
                            <input id="latitude" type="hidden" name="latitude">
                            <input id="longitude" type="hidden" name="longitude">

                        </div>

                        <br>
                        <div class="form-group row" id="dropdown_address_selection" style="display: none;">
                            <!--begin::Col-->
                            <div class="col-xl-4">
                                <label class="form-label">Country</label>

                                <!--begin::Input group-->
                                <select id="country" class="form-select form-select-solid address-country"
                                    name="country" data-control="select2" data-placeholder="Select an option"
                                    data-allow-clear="true" onchange="fetchStates()">

                                    <option value="">Select country</option>
                                    @if ($countries->count())
                                    @foreach ($countries as $country)
                                    <option value={{ $country['id'] }}>{{ $country['name'] }}
                                    </option>
                                    @endforeach
                                    @else
                                    <option value="">Countries not available</option>
                                    @endif
                                </select>
                                <!--end::Input group-->

                            </div>
                            <!--end::Col-->
                            <div class="col-xl-4">
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">State</label>
                                    <!--end::Label-->
                                    <select id="state" name="state" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="Choose" data-allow-clear="true"
                                        onchange="fetchCities()">
                                        <option value="">Select State</option>
                                    </select>
                                </div>
                            </div>
                            <!--begin::Col-->
                            <div class="col-xl-4">
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">City</label>
                                    <!--end::Label-->
                                    <select id="city" class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="Choose city" name="city" data-allow-clear="true"
                                        onchange="fetchAreas()">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-xl-5">
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Areas</label>
                                    <!--end::Label-->
                                    <select id="area" class="form-select form-select-lg form-select-solid"
                                        data-control="select2" data-placeholder="Choose Areas" name="area"
                                        data-allow-clear="true">
                                    </select>

                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-7">
                                <div class="fv-row mb-10">
                                    <label class="form-label">Street Address</label>
                                    <input name="address" class="form-control form-control-lg form-control-solid" />
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <p>You can also enter address manually<b>(Not recommended)</b>. If you want to
                            enter
                            location manually <a onclick="toggleLocationDiv()"><code>Click here</code></a>
                        </p>

                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack">
                            <!--begin::Label-->
                            <div class="me-5">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold">Notifications Enabled?</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div class="fs-7 fw-bold text-muted">Upon order completion send notification</div>
                                <!--end::Input-->
                            </div>
                            <!--end::Label-->
                            <!--begin::Switch-->
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input class="form-check-input" name="is_notifications_enabled" type="checkbox"
                                    value="1" checked="checked" />
                                <!--end::Input-->
                                <!--begin::Label-->
                                <span class="form-check-label fw-bold text-muted"
                                    for="kt_modal_add_customer_billing">Yes</span>
                                <!--end::Label-->
                            </label>
                            <!--end::Switch-->
                        </div>
                        <!--begin::Wrapper-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_add_customer_cancel" class="btn btn-light me-3">Discard</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" type="submit" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <!--end::Button-->


                </form>
                <!--end::Form-->



            </div>
            <!--end::Content-->
        </div>

    </div>
    <!--end::Container-->
</div>
<!--end::Post-->


</div>
<!--end::Container-->
</div>
<!--end::Alert-->

@endsection

@section('extra_scripts')

<script src="{{ asset('static/js/custom/core/locations.js') }}"></script>

@endsection