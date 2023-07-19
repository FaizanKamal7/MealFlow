@extends('layouts.admin_master')
@section('title', 'Delivery Slot')


@section('main_content')
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <div class="container">
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header mt-6">

                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <h3 class="modal-title">Delivery Slots</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->

                        <hr>
                        {{-- <form method="GET" action="{{ route('activate_city_areas') }}">
                            @csrf
                            <input type="text" class="form-control" placeholder="name@example.com" />
                            <input type="text" class="form-control form-control-solid" placeholder="name@example.com" />
                            <input type="text" class="form-control form-control-transparent"
                                placeholder="name@example.com" />
                            <br><br>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Activate Locations</button>
                        </form> --}}
                        <!--begin::Card body-->
                        <div class="card-body pt-5">
                            <!--begin::Form-->
                            <form id="kt_ecommerce_settings_general_form" class="form"
                                action="{{route('add_delivery_slots')}}">
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <!--begin::Col-->
                                    <div class="col-lg-4">
                                        <label class="form-label required">Country</label>

                                        <!--begin::Input group-->
                                        <select id="country" class="form-select form-select-solid" name="country"
                                            data-control="select2" data-placeholder="Select an option"
                                            data-allow-clear="true" onchange="fetchStates()">

                                            <option value="">Select country</option>
                                            @if ($countries->count())
                                            @foreach ($countries as $country)
                                            <option value={{$country['id']}}>{{$country['name']}}</option>
                                            @endforeach
                                            @else
                                            <option value="">Countries not available</option>
                                            @endif
                                        </select>
                                        <!--end::Input group-->

                                    </div>
                                    <!--end::Input group-->
                                    <!--end::Col-->
                                    <div class="col-xl-4">
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label required">State</label>
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
                                            <label class="form-label required">City</label>
                                            <!--end::Label-->

                                            <select id="city" class="form-select form-select-lg form-select-solid"
                                                data-control="select2" data-placeholder="Choose City" name="city"
                                                data-allow-clear="true" multiple="multiple">
                                            </select>
                                            <!--hidden text field-->
                                            <input type="hidden" id="cities" name="cities" />
                                        </div>
                                    </div>
                                    <!--end::Col-->

                                </div>


                                <!--begin::Separator-->
                                <div class="separator mb-6"></div>



                                <!--begin::Repeater-->
                                <div id="kt_docs_repeater_basic">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="delivery_slots_list">
                                            <div data-repeater-item>
                                                <div class="form-group row">
                                                    <!--begin::Col-->
                                                    <div class="col-md-5">
                                                        <div class="fv-row mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mt-3">
                                                                <span class="required">Start time</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7"
                                                                    data-bs-toggle="tooltip"
                                                                    title="Enter start time"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="text" class="form-control form-control-solid"
                                                                name="start_time" value="" />
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--begin::Col-->
                                                    <div class="col-md-5">
                                                        <div class="fv-row mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mt-3">
                                                                <span class="required">End time</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7"
                                                                    data-bs-toggle="tooltip" title="Enter end time"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="text" class="form-control form-control-solid"
                                                                name="end_time" value="" />
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <a href="javascript:;" data-repeater-delete
                                                            class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                            <i class="bi bi-trash3">Delete</i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Form group-->

                                    <!--begin::Form group-->
                                    <div class="form-group mt-5">
                                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                            <i class="ki-duotone ki-plus fs-3"></i>
                                            Add Delivery Slot
                                        </a>
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <!--end::Repeater-->

                                <!--begin::Action buttons-->
                                <div class="d-flex justify-content-end">
                                    <!--begin::Button-->
                                    <button type="reset" data-kt-contacts-type="cancel"
                                        class="btn btn-light me-3">Cancel</button>
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Save</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Action buttons-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Card body-->





                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra_scripts')
<script src="{{ asset('static/js/custom/settings/delivery-slots/delivery_slots.js')}}"></script>
<script src="{{ asset('static/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script src="{{ asset('static/plugins/custom/utilities/multiselect-dropdown.js')}}"></script>

<script>
    $(document).ready(function(){
        $('#city').change(function(){
            var selectedCities = $(this).val();

            if (selectedCities.includes('all')) {
                selectedCities = [];
                $(this).find('option').each(function() {
                    if ($(this).val() != 'all') {
                        selectedCities.push($(this).val());
                    }
                });

                // Select all options in the dropdown, except 'all'
                $(this).val(selectedCities).trigger('change');
            }

            // Update hidden field
            $('#cities').val(selectedCities.join(','));
        });
    });
</script>

@endsection