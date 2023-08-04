@extends('layouts.admin_master')
@section('title', 'Settings')

@section('main_content')

<div class="container">
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header mt-6">

            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <h3 class="modal-title">Area Selection</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
                <p>Select the areas of city you want to active</p>
                <input class="form-check-input" type="checkbox" onClick="toggle(this)" /> Select All<br />
                <hr>
                <form method="GET" action="{{ route('activate_city_areas') }}">
                    @csrf
                    <input type="hidden" name="city_id" value={{$selected_city_id}}>

                    @foreach ($areas as $area)
                    <input class="form-check-input" type="checkbox" name="areas[]" value="{{ json_encode($area) }}">
                    {{$area['name']}}
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @endforeach

                    <br><br>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Activate Locations</button>
                </form>





            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_scripts')
<script src="{{ asset('static/js/custom/authentication/sign-in/general.js')}}"></script>
<script src="{{ asset('static/js/custom/settings/locations/activate_location.js') }}"></script>

@endsection