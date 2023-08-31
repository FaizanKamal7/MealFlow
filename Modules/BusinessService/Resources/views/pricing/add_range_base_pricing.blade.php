@extends('layouts.admin_master')
@section('title', 'Base Pricing')


@section('main_content')
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
                        <h3 class="modal-title">Add Range Based Pricing</h3>
                        <p>Add pricing based on total number of daily deliveries </p>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->

                        <hr>

                        <!--begin::Card body-->
                        <div class="card-body pt-5">

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
                                            onchange="fetchCitiesWithMultiSelectOption()">
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
                                            data-control="select2" onchange="getRangePricing()"
                                            data-placeholder="Choose City" name="city" data-allow-clear="true"
                                            multiple="multiple">
                                        </select>
                                        <!--hidden text field-->
                                        <input type="hidden" id="cities" name="cities" />
                                    </div>
                                </div>
                                <!--end::Col-->

                            </div>



                            <!--begin::Separator-->
                            <div class="separator mb-6">

                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-check">
                                        <input class="form-check-input" name="radiogroup" type="radio" value="base"
                                            id="r1" checked />
                                        <label for="r1" class="form-check-label">
                                            Set BASE pricing (Applicable for all new businesses)
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <div class="col-xl-6">
                                    <div class="form-check">
                                        <input class="form-check-input" name="radiogroup" type="radio" value="non_base"
                                            id="r2" />
                                        <label for="r2" class="form-check-label">
                                            Set for specific business
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="m-2" id="inputField" style="display:none;">
                                <label class="form-label required">Businesses</label>

                                <!--begin::Input group-->
                                <select id="business" class="form-select form-select-solid" data-control="select2"
                                    data-placeholder="Select an option" data-allow-clear="true"
                                    onchange="getRangePricing()">

                                    <option value="">Select business</option>
                                    @if ($businesses->count())
                                    @foreach ($businesses as $business)
                                    <option value="{{$business['id']}}">{{$business['name']}}</option>
                                    @endforeach
                                    @else
                                    <option value="">Businesses not available</option>
                                    @endif
                                </select>
                                <!--end::Input group-->
                            </div>

                            <div id="range-pricing-component-id" style="display: none">
                                @livewire('businessservice::range-pricing-component')
                            </div>

                            <div id="no-range-pricing" class="text-center" style="display: none">
                                <br><br>
                                <p><i>No Range Pricings Available for Selected Region. Please <a
                                            href="{{route('add_new_delivery_slots')}}">add delivery slots</a> for this
                                        region before adding price</i></p>
                            </div>






                        </div>
                        <!--end::Card body-->
                        <div id="form_id" style="display: none;">
                            <form id="dynamic_form" action="{{route('store_delivery_slot_pricing_in_base_price')}}">
                                <!-- Dynamic content will be added here -->
                            </form>
                            <br>
                            <!--begin::Action buttons-->
                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <button type="reset" data-kt-contacts-type="cancel"
                                    class="btn btn-light me-3">Cancel</button>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="submit" form="dynamic_form" data-kt-contacts-type="submit"
                                    class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                            <!--end::Action buttons-->
                        </div>

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
<script src="{{ asset('static/js/custom/core/locations.js')}}"></script>


<script>
    function getRangePricing() {
        var cities = document.getElementById("cities").value;
        var range_pricing_component = document.getElementById("range-pricing-component-id");
        var business_id = document.getElementById("business").value;
        var no_range_pricing = document.getElementById("no-range-pricing");

        // Split the cities into an array
        var selectedCities = cities.split(',');

        // Remove any empty values from the array
        selectedCities = selectedCities.filter(city => city !== "");

        // Convert the array back to a comma-separated string
        cities = selectedCities.join(',');

        var base_url = "/businessservice/pricing/get-base-range-pricing";
        var business_url = "/businessservice/pricing/get-business-range-pricing";
        
        $.ajax({
            url: business_id == "" ? base_url : business_url,
            dataType: "json",
            data: business_id == "" ? { cities: cities, business_id: business_id } : { cities: cities },
            success: function(city_pricings) {
                console.log("TYPE");
                console.log(typeof city_pricings);  

                range_pricing_component.style.display = "block";
                var component_id = document.querySelector('#range-pricing-component-id [wire\\:id]').getAttribute('wire:id');
                var component = Livewire.find(component_id);
                component.set('available_base_range_pricings',city_pricings);
                component.set('cities', cities.split(',')); 
                component.set('business_id', business_id); 
            },
            error: function(errors) {
                console.log(errors);
            }
        });
    }


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

    document.getElementsByName('radiogroup').forEach((elem) => {
        elem.addEventListener('change', (e) => {
            if (e.target.value === 'non_base') {
                document.getElementById('inputField').style.display = 'block';
            } else {
                document.getElementById('inputField').style.display = 'none';
            }
        });
    });

</script>

@endsection