<div>
    {{-- TODO: Handle if range already exist --}}

    <form id="base_range_pricing_form" class="form" method="post" enctype="multipart/form-data"
        action="{{route('store_delivery_slots_of_city_in_base_price')}}">
        @csrf
        <!--hidden text field-->
        <input type="hidden" id="cities" name="cities" value={{json_encode($cities)}} />
        <input type="hidden" id="business_id" name="business_id" value={{$business_id}}>

        <!--begin::Repeater-->
        <div id="kt_docs_repeater_basic">
            <!--begin::Form group-->
            <div class="form-group">
                <div data-repeater-list="range_pricing_list">
                    @if ($available_base_range_pricings)
                    @foreach ($available_base_range_pricings as $available_base_range_pricing)
                    <div data-repeater-item>
                        <div>
                            <input type="hidden" name="is_same_price" id="is_same_price_{{ $loop->index }}"
                                value="true" />
                            <input type="hidden" name="available_base_range_pricing_id"
                                value={{$available_base_range_pricing['id']}} />


                            {{-- S A M E - P R I C E S - F O R - A L L - S E R V I C E S --}}
                            <div id="same_pricing_id_{{ $loop->index }}"
                                style="display: {{ $available_base_range_pricing['is_same_for_all_services'] == 1 ? 'block' : 'none' }}">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <h5>Daily delivery count range and price </h5>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="form-label">Min Range:</label>
                                        <input name="min_range" type="number" class="form-control mb-2 mb-md-0"
                                            placeholder="Enter min range"
                                            value={{$available_base_range_pricing['min_range']}} />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Max Range:</label>
                                        <input name="max_range" type="number" class="form-control mb-2 mb-md-0"
                                            placeholder="{{$available_base_range_pricing['max_range']}}"
                                            value={{$available_base_range_pricing['max_range']}} />
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="form-label">Price per delivery:</label>
                                        <input name="price" type="number" class="form-control mb-2 mb-md-0"
                                            placeholder="Enter price"
                                            value={{$available_base_range_pricing['delivery_price']}} />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Price per delivery (Same location):</label>
                                        <input name="same_loc_price" type="number" class="form-control mb-2 mb-md-0"
                                            placeholder="Enter price of same location"
                                            value={{$available_base_range_pricing['same_loc_delivery_price']}} />
                                    </div>
                                </div>
                                <br>

                            </div>

                            {{-- D I F F E R E N T - P R I C E S - F O R - A L L - S E R V I C E S --}}
                            <div id="diff_service_wise_pricing_id_{{ $loop->index }}"
                                style="display: {{ $available_base_range_pricing['is_same_for_all_services'] == 1 ? 'none' : 'block' }}">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <h5>Daily delivery count range and price</h5>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="form-label">Min Range:</label>
                                        <input name="min_range" type="number" class="form-control mb-2 mb-md-0"
                                            placeholder="Enter min range"
                                            value={{$available_base_range_pricing['min_range']}} />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Max Range:</label>
                                        <input name="max_range" type="number" class="form-control mb-2 mb-md-0"
                                            placeholder="{{$available_base_range_pricing['max_range']}}"
                                            value={{$available_base_range_pricing['max_range']}} />
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="form-label">Delivery Price:</label>
                                        <input name="delivery_price" type="number" class="form-control mb-2 mb-md-0"
                                            placeholder="Enter price"
                                            value={{$available_base_range_pricing['delivery_price']}} />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Bag Collection Price:</label>
                                        <input name="bag_collection_price" type="number"
                                            class="form-control mb-2 mb-md-0" placeholder="Enter price of same location"
                                            value={{$available_base_range_pricing['bag_collection_price']}} />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Cash Collection Price:</label>
                                        <input name="cash_collection_price" type="number"
                                            class="form-control mb-2 mb-md-0" placeholder="Enter price of same location"
                                            value={{$available_base_range_pricing['cash_collection_price']}} />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="form-label">Delivery Price (Same Location): </label>
                                        <input name="same_loc_delivery_price" type="number"
                                            class="form-control mb-2 mb-md-0" placeholder="Enter price"
                                            value={{$available_base_range_pricing['same_loc_delivery_price']}} />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Bag Collection Price (Same Location):</label>
                                        <input name="same_loc_bag_collection_price" type="number"
                                            class="form-control mb-2 mb-md-0" placeholder="Enter price of same location"
                                            value={{$available_base_range_pricing['same_loc_bag_collection_price']}} />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Cash Collection Price (Same Location):</label>
                                        <input name="same_loc_cash_collection_price" type="number"
                                            class="form-control mb-2 mb-md-0" placeholder="Enter price of same location"
                                            value={{$available_base_range_pricing['same_loc_cash_collection_price']}} />
                                    </div>
                                </div>
                                <br>

                            </div>
                            <br>
                            {{-- D E L E T E - B U T T O N --}}
                            <p style="display: inline;">Below Daily Range Pricing would be same for <b> delivery, bag
                                    collection and cash.
                                    collection.</b></p>
                            <button type="button" class="button-no-style"
                                onclick="changePricingView({{ $loop->index }})">Click
                                here</button>
                            <p id="pricing_text_id_{{ $loop->index }}" style="display: inline;">
                                to set same pricing for all services</p>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <a href="javascript:;" data-repeater-delete
                                        class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                        <i class="la la-trash-o"></i>Delete
                                    </a>
                                </div>
                            </div>
                            <br>
                            <div class="separator mb-6"></div>
                            <br>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div data-repeater-item>
                        <div>
                            <input type="hidden" name="is_same_price" id="is_same_price" value="true" />
                            {{-- S A M E - P R I C E S - F O R - A L L - S E R V I C E S --}}
                            <div id="same_pricing_id">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <h5>Daily delivery count range and price</h5>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="form-label">Min Range:</label>
                                        <input name="same_min_range" type="number" class="form-control mb-2 mb-md-0"
                                            placeholder="Enter min range" value="" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Max Range:</label>
                                        <input name="same_max_range" type="number" class="form-control mb-2 mb-md-0"
                                            placeholder="Enter max range" value="" />
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="form-label">Price per delivery:</label>
                                        <input name="price" type="number" class="form-control mb-2 mb-md-0"
                                            placeholder="Enter price" value="" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Price per delivery (Same location):</label>
                                        <input name="same_loc_price" type="number" class="form-control mb-2 mb-md-0"
                                            placeholder="Enter price of same location" value="" />
                                    </div>
                                </div>
                                <br>

                            </div>

                            {{-- D I F F E R E N T - P R I C E S - F O R - A L L - S E R V I C E S --}}
                            <div id="diff_service_wise_pricing_id" style="display: none">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <h5>Daily delivery count range and price</h5>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="form-label">Min Range:</label>
                                        <input name="min_range" type="number" class="form-control mb-2 mb-md-0"
                                            placeholder="Enter min range" value="" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Max Range:</label>
                                        <input name="max_range" type="number" class="form-control mb-2 mb-md-0"
                                            placeholder="Enter max range" value="" />
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="form-label">Delivery Price:</label>
                                        <input name="delivery_price" type="number" class="form-control mb-2 mb-md-0"
                                            placeholder="Enter price" value="" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Bag Collection Price:</label>
                                        <input name="bag_collection_price" type="number"
                                            class="form-control mb-2 mb-md-0" placeholder="Enter price of same location"
                                            value="" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Cash Collection Price:</label>
                                        <input name="cash_collection_price" type="number"
                                            class="form-control mb-2 mb-md-0" placeholder="Enter price of same location"
                                            value="" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="form-label">Delivery Price (Same Location): </label>
                                        <input name="same_loc_delivery_price" type="number"
                                            class="form-control mb-2 mb-md-0" placeholder="Enter price" value="" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Bag Collection Price (Same Location):</label>
                                        <input name="same_loc_bag_collection_price" type="number"
                                            class="form-control mb-2 mb-md-0" placeholder="Enter price of same location"
                                            value="" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Cash Collection Price (Same Location):</label>
                                        <input name="same_loc_cash_collection_price" type="number"
                                            class="form-control mb-2 mb-md-0" placeholder="Enter price of same location"
                                            value="" />
                                    </div>
                                </div>
                                <br>
                            </div>
                            <br>
                            {{-- D E L E T E - B U T T O N --}}
                            <p style="display: inline;">Below Daily Range Pricing would be same for <b> delivery, bag
                                    collection and cash.
                                    collection.</b></p>
                            <button type="button" class="button-no-style" onclick=" (this)">Click
                                here</button>
                            <p id="pricing_text_id_new" style="display: inline;">
                                to set same pricing for all services</p>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <a href="javascript:;" data-repeater-delete
                                        class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                        <i class="la la-trash-o"></i>Delete
                                    </a>
                                </div>
                            </div>
                            <br>
                            <div class="separator mb-6"></div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <!--end::Form group-->

            <!--begin::Form group-->
            <div class="form-group mt-5">
                <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                    <i class="la la-plus"></i>Add new Range
                </a>
            </div>
            <!--end::Form group-->
        </div>
        <br>
        <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary float-right">Submit
        </button>
    </form>



</div>

@push('scripts')


<script>
    function changePricingView(index) {
        var same_pricing_div = document.getElementById('same_pricing_id_' + index);
        var diff_service_wise_pricing_div = document.getElementById('diff_service_wise_pricing_id_' + index);
        var btn_text = document.getElementById('pricing_text_id_' + index);
        var is_same_price = document.getElementById('is_same_price_' + index);
        

        console.log(diff_service_wise_pricing_div.style.display);
        if (diff_service_wise_pricing_div.style.display == 'none') {    
            btn_text.textContent = 'to set same pricing for all services';
            same_pricing_div.style.display = 'none';
            diff_service_wise_pricing_div.style.display = 'block';
            is_same_price.value = 'false';
            console.log("Inside is_same_price : " + is_same_price.value );
        } else {
            btn_text.textContent = 'to change the base pricing service wise';
            same_pricing_div.style.display = 'block';
            diff_service_wise_pricing_div.style.display = 'none';
            is_same_price.value = 'true';
            console.log("Inside is_same_price : " + is_same_price.value );
        }
    }

    function changeNewlyAddedPricingView(index) {
        var repeaterItem = index.closest('[data-repeater-item]');
        var same_pricing_div = repeaterItem.querySelector('#same_pricing_id');
        var diff_service_wise_pricing_div = repeaterItem.querySelector('#diff_service_wise_pricing_id');
        var btn_text = repeaterItem.querySelector('#pricing_text_id_new');
        var is_same_price = repeaterItem.querySelector('#is_same_price');

        if (diff_service_wise_pricing_div.style.display == 'none') {
            btn_text.textContent = 'to set same pricing for all services';
            same_pricing_div.style.display = 'none';
            diff_service_wise_pricing_div.style.display = 'block';
            is_same_price.value = 'false';
            console.log("NEW is_same_price : " + is_same_price.value );
        } else {
            btn_text.textContent = 'to change the base pricing service wise';
            same_pricing_div.style.display = 'block';
            diff_service_wise_pricing_div.style.display = 'none';
            is_same_price.value = 'true';
            console.log("NEW is_same_price : " + is_same_price.value );

        }
    }

    document.addEventListener('livewire:load', function () {
        var initRepeater = function() {
            $('#kt_docs_repeater_basic').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function () {
                    $(this).slideDown();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
        }
        initRepeater();
    });



</script>
@endpush