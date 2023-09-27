<form id="dynamicForm" action="{{route('store_delivery_slot_pricing_in_base_price')}}">
    <input type="hidden" id="cities" name="cities" value="{{ json_encode( $cities) }}">
    <input type="hidden" id="business_id" name="business_id" value={{$business_id}}>

    @if ($cities_delivery_slots)
    @foreach($cities_delivery_slots as $index => $cities_delivery_slot)
    <div class="row align-items-center justify-content-center">
        <h4>Delivery Slot: {{ $cities_delivery_slot[1] }} ({{ $cities_delivery_slot[2]['name'] }})</h4>
    </div>
    <input type="hidden" name="cities_delivery_slot[{{$index}}][is_same_price]" id="is_same_price_{{$index}}"
        value="true" />
    <input type="hidden" name="cities_delivery_slot[{{$index}}][delivery_slot_id]"
        value="{{$cities_delivery_slot[0]}}" />

    {{-- S A M E - P R I C E S - F O R - A L L - S E R V I C E S --}}
    <div id="same_pricing_id_{{$index}}" class="same-pricing-div">
        <div class="form-group row">
            <div class="col-xl-4 me-8">
                <label for="cities_delivery_slot[{{$index}}][price]">Delivery Slot Price</label>
                <input type="text" name="cities_delivery_slot[{{$index}}][price]" class="form-control"
                    placeholder="Price">
            </div>

            <div class="col-xl-4">
                <label for="cities_delivery_slot[{{$index}}][same_location_price]">Delivery Slot Price (Same
                    Location)</label>
                <input type="text" name="cities_delivery_slot[{{$index}}][same_loc_price]" class="form-control"
                    placeholder="Price">
            </div>
        </div>
    </div>
    {{-- D I F F E R E N T - P R I C E S - F O R - A L L - S E R V I C E S --}}
    <div id="diff_service_wise_pricing_id_{{ $index }}" style="display: none">

        <div class="form-group row">
            <div class="col-md-4">
                <label class="form-label">Delivery Price:</label>
                <input name="cities_delivery_slot[{{$index}}][delivery_price]" type="number"
                    class="form-control mb-2 mb-md-0" placeholder="Enter delivery price" value="" />
            </div>
            <div class="col-md-4">
                <label class="form-label">Bag Collection Price:</label>
                <input name="cities_delivery_slot[{{$index}}][bag_collection_price]" type="number"
                    class="form-control mb-2 mb-md-0" placeholder="Enter price of same location" value="" />
            </div>
            <div class="col-md-4">
                <label class="form-label">Cash Collection Price:</label>
                <input name="cities_delivery_slot[{{$index}}][cash_collection_price]" type="number"
                    class="form-control mb-2 mb-md-0" placeholder="Enter price of same location" value="" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label class="form-label">Delivery Price (Same Location): </label>
                <input name="cities_delivery_slot[{{$index}}][same_loc_delivery_price]" type="number"
                    class="form-control mb-2 mb-md-0" placeholder="Enter price" value="" />
            </div>
            <div class="col-md-4">
                <label class="form-label">Bag Collection Price (Same Location):</label>
                <input name="cities_delivery_slot[{{$index}}][same_loc_bag_collection_price]" type="number"
                    class="form-control mb-2 mb-md-0" placeholder="Enter price of same location" value="" />
            </div>
            <div class="col-md-4">
                <label class="form-label">Cash Collection Price (Same Location):</label>
                <input name="cities_delivery_slot[{{$index}}][same_loc_cash_collection_price]" type="number"
                    class="form-control mb-2 mb-md-0" placeholder="Enter price of same location" value="" />
            </div>
        </div>
        <br>

    </div>

    <p style="display: inline;">Above delivery slot pricing would be same for <b> delivery, bag
            collection and cash,
            collection</b> by default. </p>
    <button type="button" class="button-no-style" onclick="changePricingView({{ $index }})"><code> Click
            here</code></button>
    <p id="pricing_text_id_{{ $loop->index }}" style="display: inline;">
        to set different pricing for all services</p>
    <br><br>
    @endforeach
    {{-- <input type="hidden" id="delivery_slots" name="delivery_slots" value="{{ implode(',', $delivery_slots) }}">
    --}}

    <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary float-right">Submit
    </button>
    @endif
</form>


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
</script>
@endpush