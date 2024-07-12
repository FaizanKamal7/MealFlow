@extends('layouts.admin_master')
@section('title', 'Settings')
@section('extra_style')
    <link href="{{ asset('static/css/city_location_activation.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('main_content')

    <div class="container">
        <div class="card card-flush area-selection-card">
            <!--begin::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0 mt-6">
                <h3 class="modal-title">Area Selection</h3>
                <div class="d-flex align-items-center gap-5 city_details mt-8">
                    <div class="first-div">
                        <p>City</p>
                        <p>State</p>
                        <p>Country</p>
                    </div>
                    <div class="second-div">
                        <p>{{ $city->name }}</p>
                        <p>{{ $city->state->name }}</p>
                        <p>{{ $city->state->country->name }}</p>
                    </div>
                </div>
                <hr
                    style="background: radial-gradient(50% 50% at 50% 50%, #432C2C 0%, rgba(80, 28, 28, 0) 100%);
                ">

                <div id="selectedCheckboxes" class="d-flex flex-wrap mt-6"></div>

                <!--begin::Close-->
                {{-- <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div> --}}
                <!--end::Close-->
                @if (count((array) $areas))
                    <div class="select-area">
                        <p>Select the areas of city you want to active</p>
                    </div>
                @endif

                <form class="location-form" method="GET" action="{{ route('activate_city_areas') }}">
                    <input type="hidden" name="city_id" value={{ $selected_city_id }}>

                    @if (count((array) $areas))
                        {{-- <input class="form-check-input" type="checkbox" onClick="toggle(this)" /> Select All<br /> --}}
                        <div class="select-div">
                            <input class="form-check-input me-4" type="checkbox" onClick="toggleAll(this)" />
                            <span class="fw-bold">Select All</span>
                        </div>
                        <br />

                        {{-- <hr> --}}
                        @csrf

                        <div class="all-options">
                            @foreach ($areas as $area)
                                <div class="checkbox-div">
                                    <input class="form-check-input me-4" type="checkbox" name="areas[]"
                                        value="{{ json_encode($area) }}" id="checkbox_{{ $area['geonameId'] }}">
                                    <span>{{ $area['name'] }}</span>
                                    <br />

                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                            @endforeach
                        </div>


                        <br><br>
                        <button type="submit" class="btn proceed-btn">Proceed with selected area</button>
                        <button type="button" class="btn back-btn" data-bs-dismiss="modal">Back</button>
                    @else
                        <b>No areas extracted from API for selected city</b> <br><br>
                        <button type="submit" class="btn proceed-btn">Proceed with activating entire city </button>
                    @endif
                </form>



            </div>
        </div>
    </div>
@endsection

@section('extra_scripts')
    <script src="{{ asset('static/js/custom/authentication/sign-in/general.js') }}"></script>
    <script src="{{ asset('static/js/custom/settings/locations/activate_location.js') }}"></script>
    <script>
        function toggleAll(source) {
            $('input[type="checkbox"]').prop('checked', source.checked);
            selectedCheckboxes = [];

            if (source.checked) {
                // Add all checkboxes to selectedCheckboxes array
                $('input[type="checkbox"]').each(function() {
                    selectedCheckboxes.push($(this).val());
                });
            }

            // Update the display of selected checkboxes
            // updateSelectedCheckboxes();
        }

        $(document).ready(function() {
            // Initialize an array to store selected checkbox values
            var selectedCheckboxes = [];
            // Function to update the selected checkboxes display
            function updateSelectedCheckboxes() {
                // Clear the previous content
                $('#selectedCheckboxes').empty();
                // Loop through the selectedCheckboxes array and display the selected values
                selectedCheckboxes.forEach(function(value) {
                    var parsedValue = JSON.parse(value);
                    var checkboxId = 'checkbox_' + parsedValue.geonameId;
                    $('#selectedCheckboxes').append('<p class="selected me-4">' + parsedValue.name +
                        ' <span class="deselect" data-checkbox-id="' + checkboxId + '">x</span></p>');
                });
                // Add click event handlers for deselecting
                $('.deselect').click(function() {
                    var valueToRemove = $(this).parent().text().trim().slice(0, -2);
                    // console.log(valueToRemove)
                    var geonameIdToRemove = $(this).data('checkbox-id');
                    // console.log('geonameIdToRemove:', geonameIdToRemove);

                    var index = -1
                    selectedCheckboxes.forEach(function(jsonString, i) {
                        var parsedValue = JSON.parse(jsonString);
                        // console.log(parsedValue)
                        if (parsedValue.name === valueToRemove) {
                            index = i;
                        }
                    });

                    if (index !== -1) {
                        var removedItem = selectedCheckboxes.splice(index, 1)[0];
                        $('[id="' + geonameIdToRemove + '"]').prop('checked', false);
                        updateSelectedCheckboxes();
                    }
                });
            }
            // Add a change event handler to checkboxes
            $('input[type="checkbox"]').change(function() {
                var checkboxValue = $(this).val();
                // console.log(checkboxValue)

                if ($(this).is(':checked')) {
                    // Add to the selectedCheckboxes array if checked
                    selectedCheckboxes.push(checkboxValue);
                } else {
                    // Remove from the selectedCheckboxes array if unchecked
                    var index = selectedCheckboxes.indexOf(checkboxValue);
                    if (index !== -1) {
                        selectedCheckboxes.splice(index, 1);
                    }
                }
                // Update the display of selected checkboxes
                updateSelectedCheckboxes();
            });

        });
    </script>

@endsection
