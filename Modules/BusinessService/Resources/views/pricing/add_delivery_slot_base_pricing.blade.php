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
                        <h3 class="modal-title">Add Base Pricing (Delivery slot wise)</h3>

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
                            <!--begin::Form-->
                            <form id="location_form" class="form" method="post">
                                @csrf

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
                                                data-control="select2" onchange="getDeliverySlots()" data-placeholder="Choose City"
                                                name="city" data-allow-clear="true" multiple="multiple">
                                            </select>
                                            <!--hidden text field-->
                                            <input type="hidden" id="cities" name="cities" />
                                        </div>
                                    </div>
                                    <!--end::Col-->

                                </div>

                            </form>
                            <!--end::Form-->
                            <!--begin::Separator-->
                            <div class="separator mb-6"></div>

                        </div>
                        <!--end::Card body-->
                        <div id="delivery-slot-pricing-component-id" style="display: none">
                            @livewire('businessservice::delivery-slot-pricing-component' )
                        </div>

                        {{-- <div id="form_id" style="display: none;">
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
                        </div> --}}

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

    function getDeliverySlots() {
        console.log("inside getDeliverySlots");
        var cities = document.getElementById("cities").value;
        var delivery_slot_pricing_component = document.getElementById("delivery-slot-pricing-component-id");
       
        var url = "/businessservice/pricing/get-delivery-slots-of-city-in-base-price";
            console.log(cities);
            $.ajax({
                url: url,
                dataType: "json",
                data: { cities: cities },
                success: function(cities_delivery_slots) {
                    city_pricings_arr = Object.values(cities_delivery_slots);
              
                    delivery_slot_pricing_component.style.display = "block";
                    var componentId = document.querySelector('#delivery-slot-pricing-component-id [wire\\:id]').getAttribute('wire:id');
                    var component = Livewire.find(componentId);
                    component.set('cities_delivery_slots',cities_delivery_slots);
                    component.set('cities', cities.split(',')); 
                    
                    // divForm.style.display = "block";

                    //  // assuming response is an array
                    // dynamicForm.innerHTML = '';  // clear existing content
                    // var input = document.createElement("input");
                    // input.setAttribute("type", "hidden");
                    // input.setAttribute("id", "cities");
                    // input.setAttribute("name", "cities");
                    // input.setAttribute("value", cities);  
                    // dynamicForm.appendChild(input);
                    // var delivery_slots = '';
                   
                    // // for each item in the response array, create an input field
                    // // for (let i = 0; i < response.length; i++) {
                    // response.forEach(function(item, i) {
                       
                    //     let row = document.createElement('div');
                    //     row.classList.add("row");
                    //     row.classList.add("align-items-center");
                    //     row.classList.add("justify-content-center");

                    //     let col1 = document.createElement('div');
                    //     col1.classList.add("col-xl-4");
                    //     let p = document.createElement('p');
                    //     p.textContent = item[1];  // replace with your text
                    //     col1.appendChild(p);


                    //     let col2 = document.createElement('div');
                    //     col2.classList.add("col-xl-3");
                    //     let label2 = document.createElement('label');
                    //     label2.for = 'price' + i;
                    //     label2.textContent = 'Delivery Slot Price';
                    //     let input2 = document.createElement('input');
                    //     input2.id = 'delivery_slot_price' + i;
                    //     input2.name = 'delivery_slot_price'+ i;
                    //     input2.type = 'text';
                    //     input2.classList.add("form-control");
                    //     input2.placeholder = 'Price';
                    //     col2.appendChild(label2);
                    //     col2.appendChild(input2);

                    //     let col3 = document.createElement('div');
                    //     col3.classList.add("col-xl-3");
                    //     let label3 = document.createElement('label');
                    //     label3.for = 'sameLocationPrice' + i;
                    //     label3.textContent = 'Delivery Slot Price (Same Location)';
                    //     let input3 = document.createElement('input');
                    //     input3.id = 'sameLocationPrice' + i;
                    //     input3.name = 'sameLocationPrice'+ i;
                    //     input3.type = 'text';
                    //     input3.classList.add("form-control");
                    //     input3.placeholder = 'Price';
                    //     col3.appendChild(label3);
                    //     col3.appendChild(input3);

                    //     row.appendChild(col1);
                    //     row.appendChild(col2);
                    //     row.appendChild(col3);
                    //     // Add the delivery slot to the 'cities' variable
                    //     delivery_slots += item[0] + ',';
                    //     dynamicForm.appendChild(row);
                    // });
                    // // Create a hidden input field for all the delivery slots
                    // var inputSlots = document.createElement("input");
                    // inputSlots.setAttribute("type", "hidden");
                    // inputSlots.setAttribute("id", "delivery_slots");
                    // inputSlots.setAttribute("name", "delivery_slots");
                    // inputSlots.setAttribute("value", delivery_slots);
                    // dynamicForm.appendChild(inputSlots);
                    
                },
                error: function(xhr) {
                    // Handle any errors that occur during the AJAX request
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

        // document.getElementById('city').addEventListener('change', function() {
        //     var inputValue = this.value;

        //     $.ajax({
        //         url: '/your-controller-route',
        //         type: 'POST',
        //         data: { input: inputValue },
        //         success: function(response) {
        //             // Handle the response from the controller
        //         },
        //         error: function(xhr) {
        //             // Handle any errors that occur during the AJAX request
        //         }
        //     });
        // });

    });


</script>

@endsection