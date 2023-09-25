@extends('layouts.admin_master')
@section('title', 'Base Pricing')


@section('main_content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <div class="container">
            <div class="">
            </div>










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
                                                data-control="select2" onchange="getDeliverySlots()"
                                                data-placeholder="Choose City" name="city" data-allow-clear="true"
                                                multiple="multiple">
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
                            <div class="separator mb-2"></div>

                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-check">
                                    <input class="form-check-input" name="radiogroup" type="radio" value="base" id="r1"
                                        checked />
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
                                onchange="getDeliverySlots()">

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

                        <!--end::Card body-->
                        <div id="delivery-slot-pricing-component-id" style="display: none">
                            @livewire('businessservice::delivery-slot-pricing-component' )
                        </div>

                        <div id="no-delivery-slot" class="text-center" style="display: none">
                            <br><br>
                            <p><i>No Delivery Slot Available for selected region. Please <a
                                        href="{{route('add_new_delivery_slots')}}">add delivery slots</a> for this
                                    region before adding price</i></p>
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
    function getDeliverySlots() {
        console.log("inside getDeliverySlots");
        var cities = document.getElementById("cities").value;
        var business_id = document.getElementById("business").value;
        var delivery_slot_pricing_component = document.getElementById("delivery-slot-pricing-component-id");
        var no_delivery_slot = document.getElementById("no-delivery-slot");
       
        var url = "/businessservice/pricing/get-delivery-slots-of-city-in-base-price";
            
            $.ajax({
                url: url,
                dataType: "json",
                data: { cities: cities },
                success: function(cities_delivery_slots) {
                  
                    city_pricings_arr = Object.values(cities_delivery_slots);
                    if (city_pricings_arr.length === 0) {
                        no_delivery_slot.style.display = "block"
                    } else {
                        delivery_slot_pricing_component.style.display = "block";
                    }
                    var componentId = document.querySelector('#delivery-slot-pricing-component-id [wire\\:id]').getAttribute('wire:id');
                    var component = Livewire.find(componentId);
                    component.set('cities_delivery_slots',cities_delivery_slots);
                    component.set('cities', cities.split(',')); 
                    component.set('business_id', business_id); 
                    
                    
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