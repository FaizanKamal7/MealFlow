@extends('businessservice::layouts.master')
@section('title', 'Upload Deliveries')

@section('extra_style')
    
<link href="{{ asset('static/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css/">
@endsection
@section('main_content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                    <!--begin::form card-->
                    <div class="card card-flush">
                        <!--begin::Card header-->
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Title-->
                                <h2>Unassign Deliveries</h2>
                                <!--end::Title-->
                            </div>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <form method="POST" action="{{ route('assigned_delivery_to_driver') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <select name="driver_id" class="form-control">
                                            <option value="">Select Driver</option>
                                            @foreach ($drivers as $driver)
                                                <option value="{{ $driver->id }}">{{ $driver->employee->first_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Assign Driver</button>
                                    </div>
                                </div>
                            
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Suggested Driver</th>
                                            <th>Address</th>
                                            <th>Time Slot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($deliveries as $delivery)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="delivery_ids[]" value="{{ $delivery->id }}">
                                                </td>
                                                <td>
                                                    @foreach($delivery->suggested_drivers as $driver)
                                                        {{ $driver->employee->first_name }}<br>
                                                    @endforeach
                                                </td>
                                                <td>{{ $delivery->customerAddress->address }}</td>
                                                <td>{{ $delivery->deliverySlot->city->name }} {{ $delivery->deliverySlot->start_time }}-{{ $delivery->deliverySlot->end_time }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::form card-->
                </div>
            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->


@endsection

@section('extra_scripts')
 <script src="{{ asset('static/plugins/custom/documentation/general/datatables/datatables.bundle.js')}}"></script>
 <script src="{{ asset('static/js/custom/documentation/general/datatables/subtable.js')}}"></script> 
   
<script>
    // Add an event listener for form submission
    document.querySelector('form').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission
        
        // Get all checked checkboxes
        const checkboxes = document.querySelectorAll('input[name="delivery_ids[]"]:checked');
        
        // Create an array to store the selected delivery IDs
        const selectedDeliveryIds = Array.from(checkboxes).map(checkbox => checkbox.value);

        // Add the selected delivery IDs as a hidden field in the form
        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = 'selected_delivery_ids';
        hiddenField.value = selectedDeliveryIds.join(',');

        // Append the hidden field to the form
        this.appendChild(hiddenField);

        // Now, you can submit the form with the selected delivery IDs
        this.submit();
    });



</script>

@endsection
