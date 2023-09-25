@extends('layouts.admin_master')
@section('title', 'Activated Locations')

@section('extra_style')
    {{-- <link href="{{ asset('static/plugins/custom/datatables/datatables.bundle.css') }} rel=" stylesheet type="text/css/"> --}}
@endsection
@section('main_content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="container">
                <div class="">
                    {{-- location-card --}}
                    <!--begin::Card header-->
                    <!--begin::Card header-->
                    <div class="d-flex mt-2 align-items-center pricing-header justify-content-between">
                        <div class="activate-service">
                            <h1 class="fs-lg-2x ">Activated Locations</h1>
                        </div>
                        <!--begin::Card title-->
                        <div class="card-title d-flex align-items-center">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative me-3">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6 location-icon" id="searchIcon">
                                    <x-iconsax-lin-search-normal-1 />
                                </span>
                                {{-- <form action="{{ route('city_search') }}" method="GET" id="searchForm"> --}}
                                <input type="text" name="query" id="myInput"
                                    data-kt-permissions-table-filter="search"
                                    class="form-control form-control-solid w-150px ps-20 location-dropdown"
                                    placeholder="Search" value="{{ request()->query('query') }}" />
                                {{-- </form> --}}
                            </div>
                            <!--end::Search-->
                            <div class="me-3">
                                <select class="form-select location-dropdown" data-control="select2" data-placeholder="All">
                                    <option></option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                </select>
                            </div>
                            <div>
                                <select class="form-select location-dropdown" data-control="select2"
                                    data-placeholder="Export">
                                    <option></option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                </select>
                            </div>
                            <div class="me-3">
                                <a class="btn text-white activate-btn">Go to activate locations</a>
                            </div>
                        </div>
                        <!--end::Card title-->

                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="">
                        <div class="accordion accordion-light accordion-svg-icon mt-3" id="accordion_location">
                            @foreach ($countries as $country)
                                <div class="accordion-item location-item ">
                                    <h2 class="accordion-header location-headers" id="heading{{ $country->id }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseCountry{{ $country->id }}" aria-expanded="true"
                                            aria-controls="collapseCountry{{ $country->id }}"
                                            onclick="toggleAccordionBorder('heading{{ $country->id }}')">

                                            {{ $country->name }}
                                        </button>
                                        <span class="trash" onclick="deleteCountry({{ $country->id }})">
                                            <x-iconsax-bul-trash />
                                        </span>
                                    </h2>
                                    <div id="collapseCountry{{ $country->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $country->id }}">
                                        @foreach ($country->states as $state)
                                            <div class="accordion-item location-item mt-2">
                                                <h2 class="accordion-header state-header location-headers"
                                                    id="headingState{{ $state->id }}">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseState{{ $state->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapseState{{ $state->id }}"
                                                        onclick="toggleAccordionState('headingState{{ $state->id }}')">
                                                        {{ $state->name }}
                                                    </button>
                                                    <span class="trash">
                                                        <x-iconsax-bul-trash />
                                                    </span>
                                                </h2>
                                                <div id="collapseState{{ $state->id }}"
                                                    class="accordion-collapse collapse"
                                                    aria-labelledby="headingState{{ $state->id }}">
                                                    @foreach ($state->cities as $city)
                                                        <div class="accordion-item location-item mt-2">
                                                            <h2 class="accordion-header city-header location-headers "
                                                                id="headingCity{{ $city->id }}">
                                                                <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#collapseCity{{ $city->id }}"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapseCity{{ $city->id }}"
                                                                    onclick="toggleAccordioncity('headingCity{{ $city->id }}')">

                                                                    {{ $city->name }}
                                                                </button>
                                                            </h2>
                                                            <div id="collapseCity{{ $city->id }}"
                                                                class="accordion-collapse collapse area-div"
                                                                aria-labelledby="headingCity{{ $city->id }}">
                                                                @php
                                                                    $areaIndex = 1;
                                                                @endphp
                                                                <h2 class="activated_areas">Activated Areas </h2>
                                                                <hr />
                                                                <ol class="area-ol" type="1">
                                                                    @foreach ($city->areas as $area)
                                                                        <li class="area-li"><span>
                                                                                {{ $area->name }}</span></li>
                                                                        @php
                                                                            $areaIndex++;
                                                                        @endphp
                                                                    @endforeach
                                                                </ol>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- <div class="card-body pt-0">


                        @if ($countries)

                            <table class="table border gy-5 gs-7">
                                <thead class="bg-light-dark">
                                    <tr class="text-start fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-1px">Country</th>
                                        <th class="min-w-1px">States</th>
                                        <th class="min-w-1px">Cities</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600">
                                    @foreach ($countries as $country)
                                        <tr class="expand-row">
                                            <td>{{ $country->name }}</td>
                                            <td>
                                                @foreach ($country->states as $state)
                                                    {{ $state->name }}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($country->states as $state)
                                                    @foreach ($state->cities as $city)
                                                        {{ $city->name }}<br>
                                                    @endforeach
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr class="hidden-row">
                                            <td colspan="3">
                                                <ul>
                                                    @foreach ($country->states as $state)
                                                        @foreach ($state->cities as $city)
                                                            @foreach ($city->areas as $area)
                                                                <li>{{ $area->name }}</li>
                                                            @endforeach
                                                        @endforeach
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <br>
                            <p>No delivery Slot Wise Pricing available. Daily Range wise pricing available. </p>
                            <button class="btn btn-secondary"> View Daily Delivery Count Wise Pricing </button>

                        @endif



                    </div> --}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extra_scripts')
    <script src="{{ asset('static/plugins/custom/documentation/general/datatables/datatables.bundle.js') }}"></script>
    {{-- <script src="{{ asset('static/js/custom/documentation/general/datatables/subtable.js')}}"></script> --}}
    <script>
        //to delete activated countries areas
        function deleteCountry(countryID) {
            console.log(countryID)
        }

        function toggleAccordionBorder(headerId) {
            // Remove the class from all accordion headers
            const allAccordionHeaders = document.querySelectorAll('.accordion-header');
            allAccordionHeaders.forEach(header => {
                console.log(header)
                header.classList.remove('active-accordion');
            });
            // Add the class to the clicked accordion header
            const clickedHeader = document.getElementById(headerId);
            if (clickedHeader) {
                const button = clickedHeader.querySelector('.accordion-button');
                if (button) {
                    if (button.classList.contains('collapsed')) {
                        clickedHeader.classList.remove('active-accordion');
                    } else {
                        clickedHeader.classList.add('active-accordion');
                    }
                }
            }
        }

        function toggleAccordionState(headerId) {
            // Remove the class from all accordion headers
            const allAccordionHeaders = document.querySelectorAll('.state-header');
            allAccordionHeaders.forEach(header => {
                header.classList.remove('active-state');
            });
            // Add the class to the clicked accordion header
            const clickedHeader = document.getElementById(headerId);
            if (clickedHeader) {
                const button = clickedHeader.querySelector('.accordion-button');
                if (button) {
                    if (button.classList.contains('collapsed')) {
                        clickedHeader.classList.remove('active-state');
                    } else {
                        clickedHeader.classList.add('active-state');
                    }
                }
            }
        }

        function toggleAccordioncity(headerId) {
            // Remove the class from all accordion headers
            const allAccordionHeaders = document.querySelectorAll('.city-header');
            allAccordionHeaders.forEach(header => {
                header.classList.remove('active-city');
            });
            // Add the class to the clicked accordion header
            const clickedHeader = document.getElementById(headerId);
            if (clickedHeader) {
                const button = clickedHeader.querySelector('.accordion-button');
                if (button) {
                    if (button.classList.contains('collapsed')) {
                        clickedHeader.classList.remove('active-city');
                    } else {
                        clickedHeader.classList.add('active-city');
                    }
                }
            }
        }
    </script>
@endsection
