<div class="main-div-meal">
    <div class="customer_detail_div mt-5">
        <div class="table customer_table">
            <div class="table-row top-row">
                <div class="cell">
                    <p>Plan Start date </p>
                </div>
                <div class="cell">
                    <p>Plan Expiry date </p>
                </div>
                <div class="cell">
                    <p>Total no. of plan days</p>
                </div>
                <div class="cell">
                    <p>Plan valid till</p>
                </div>
            </div>
            <div class="table-row bottom-row">
                <div class="cell customer_name">
                    <h5 class="fw-bolder">{{ substr($starting_date, 0, 10) }}</h5>
                </div>
                <div class="cell customer_name">
                    <h5 class="fw-bolder ">{{ substr($expiry_dates, 0, 10) }}</h5>
                </div>
                <div class="cell customer_name">
                    <h5 class="fw-bolder ">{{ $no_of_days }}</h5>
                </div>
                <div class="cell customer_name">
                    <h5 class="fw-bolder ">{{ substr($expiry_dates, 0, 10) }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="upload-meal-main-div">
        <form id="upload_meal_form" class="form" action="{{ route('upload_plan_delivery') }}" method="post">
            @csrf
            <input type="hidden" name="no_of_plan_days" value="{{ $no_of_days }}">
            <input type="hidden" name="starting_date" value="{{ $starting_date }}">
            <input type="hidden" name="expiry_date" value="{{ $expiry_dates }}">
            <input type="hidden" name="skip_days" value="{{ $skip_days }}">
            <input type="hidden" name="customer_id" value="{{ $customer_addresses[0]->customer_id }}">
            <input type="hidden" name="business_id" value="{{ $branches[0]->business_id }}">
            <input type="hidden" name="included_dates" value="{{ json_encode( $included_dates) }}">

            @foreach ($included_dates ?? [] as $i => $date)
            <div class="delievry-no d-flex ">
                <h4 class="delivery-heading upload-label">
                    Delivery # {{ $i + 1 }}
                </h4>
                <h6>{{ $date }}</h6>
            </div>
            <div class="form-element-div">
                {{-- <div class="form-group row mb-10">
                    <div class="col-md-4">
                        <label class="form-label upload-label">Delivery Address</label>
                        <select id="delivery_address_{{ $i }}" class="form-select meal-control"
                            placeholder="Current Address" name="delivery_address[]">
                            <option></option>
                            @foreach ($customer_addresses as $address)
                            <option value="{{ $address->id }}">
                                {{ $address->address }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label upload-label">Emirate & Area</label>
                        <select id="emirates_and_area{{ $i }}" class="form-select meal-control" data-control="select2"
                            data-placeholder="Dubai" name="emirates_and_area[]">
                            <option></option>
                            @foreach ($customer_addresses as $address)
                            <option value="{{ $address->id }}">
                                {{ $address->city->name }} ({{ $address->area->name }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label upload-label">Time Slot*</label>
                        <select id="time_slot{{ $i }}" class="form-select meal-control" data-control="select2"
                            data-placeholder="Dubai (2am -6 am)" name="time_slot[]">
                            <option></option>
                            @foreach ($address->city->deliverySlot as $slot)
                            <option value="{{ $slot->id }}">
                                {{ $slot->city->name }} ({{ $slot['start_time'] }} -
                                {{ $slot['end_time'] }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="form-element-div">
                    <div class="form-group row mb-10">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between">
                                <label class="form-label upload-label">Delivery Address</label>
                                <button id="copyAllAddresses"
                                    onclick="changeAllDeliveryAddress('delivery_address{{ $i }}')" type="button">Copy
                                    All</button>
                            </div>
                            <select id="delivery_address{{ $i }}" class="form-select meal-control"
                                placeholder="Current Address" name="delivery_address[]">
                                <option></option>
                                @foreach ($customer_addresses as $address)
                                <option value="{{ $address->id }}">
                                    {{ $address->address }}
                                </option>
                                @endforeach
                                {{-- <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option> --}}
                            </select>

                        </div>
                        <div class="col-md-4">
                            <label class="form-label upload-label">Emirate & Area</label>
                            <select id="emirates_and_area{{ $i }}" class="form-select meal-control"
                                data-control="select2" data-placeholder="Dubai" name="emirates_and_area[]">
                                <option></option>
                                @foreach ($customer_addresses as $address)
                                <option value="{{ $address->id }}">
                                    {{ $address->city->name }} ({{ $address->area->name }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label upload-label">Time Slot*</label>
                            <select id="time_slot{{ $i }}" class="form-select meal-control" data-control="select2"
                                data-placeholder="Dubai (2am -6 am)" name="time_slot[]">
                                <option></option>
                                @foreach ($address->city->deliverySlot as $slot)
                                <option value="{{ $slot->id }}">
                                    {{ $slot->city->name }} ({{ $slot['start_time'] }} -
                                    {{ $slot['end_time'] }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-10">
                        <div class="col-md-3">
                            <label class="form-label upload-label">Product Type</label>
                            <select id="product_type{{ $i }}" class="form-select meal-control" data-control="select2"
                                data-placeholder="Select" name="product_type[]">
                                <option></option>
                                @foreach ($product_type as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label upload-label">Company ID / Unique ID</label>
                            <input type="text" class="form-control  meal-control mb-2 mb-md-0" placeholder="UAE"
                                name="company_id[]" id="company_id{{ $i }}" autocomplete="off" />
                        </div>
                        <div class="col-md-3">
                            <label class="form-label upload-label">Delivery Amount</label>
                            <input id="delivery_amount{{ $i }}" type="text"
                                class="form-control  meal-control mb-2 mb-md-0" placeholder="AED"
                                name="delivery_amount[]" autocomplete="off" />
                        </div>
                        <div class="col-md-3">
                            <label class="form-label upload-label">Notification *</label>
                            <select class="form-select meal-control" data-control="select2" data-placeholder="Select"
                                name="notification[]" id="notification{{ $i }}">
                                <option></option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-10">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between">
                                <label class="form-label upload-label">Pickup Point</label>
                                <button id="copyAllAddresses" onclick="changeAllPickUpAddress('pickup_point{{ $i }}')"
                                    type="button">Copy
                                    All</button>
                            </div>
                            <select id="pickup_point{{ $i }}" class="form-select meal-control" data-control="select2"
                                data-placeholder="Select" name="pickup_point[]">
                                <option></option>
                                @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}">
                                    {{ $branch->address }}
                                </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-4">
                            <label class="form-label upload-label">Notes</label>
                            <input type="text" class="form-control  meal-control mb-2 mb-md-0"
                                placeholder="Additonal Notes" name="notes[]" id="notes{{ $i }}" autocomplete="off" />
                        </div>
                        <div class="col-md-4">
                            <label class="form-label upload-label">Google Link Address</label>
                            <input type="text" class="form-control  meal-control mb-2 mb-md-0"
                                placeholder="https://www.google.com/" name="google_link_address[]"
                                id="google_link_address{{ $i }}" autocomplete="off" />
                        </div>
                    </div>
                </div>
                @endforeach

                {{-- <button type="submit">Submit</button> --}}
                <hr style="background: radial-gradient(50% 50% at 50% 50%, #432C2C 0%, rgba(80, 28, 28, 0) 100%);">

                <div class="d-flex justify-content-end mt-8">
                    <!--begin::Button-->
                    <button type="reset" data-control="cancel" class="btn btn-light me-3">Cancel</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="meal_form_submit" class="btn text-white activate-btn ">
                        <span class="indicator-label ">Save Deliveries</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
        </form>

    </div>
</div>


@push('scripts')
<script>
    function changeAllDeliveryAddress(selectId) {
            var selectedAddress = $('#' + selectId).val();
            $('select[name="delivery_address[]"]').val(selectedAddress).trigger('change');
        }

        function changeAllPickUpAddress(selectId) {
            var selectePickUpdAddress = $('#' + selectId).val();
            $('select[name="pickup_point[]"]').val(selectePickUpdAddress).trigger('change');
        }
</script>
@endpush