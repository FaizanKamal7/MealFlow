@extends('layouts.admin_master')
@section('title', 'Settings')

@section('extra_style')
<link href="{{ 'static/plugins/custom/datatables/datatables.bundle.css' }}" rel="stylesheet" type="text/css" />
@endsection

@section('main_content')
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">

        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid ms-lg-7 ms-xl-5 ">

                <!--begin::Card-->
                <div class="card card-flush location-card">
                    <!--begin::Card header-->
                    <div class="card-header mt-6 align-items-center location-header">
                        <div class="activate-service">
                            <h1 class="fs-lg-2x ">Activate Your Service Locations </h1>
                        </div>
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative me-5">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6 location-icon" id="searchIcon">
                                    <x-iconsax-lin-search-normal-1 />
                                </span>
                                <form action="{{ route('city_search') }}" method="GET" id="searchForm">
                                    <input type="text" name="query" id="myInput"
                                        data-kt-permissions-table-filter="search"
                                        class="form-control form-control-solid w-200px ps-15 location-dropdown"
                                        placeholder="Search city name..." value="{{ request()->query('query') }}" />
                                </form>
                            </div>
                            <!--end::Search-->
                            <div class="me-5">
                                <select class="form-select location-dropdown" data-control="select2"
                                    data-placeholder="All">
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
                        </div>
                        <!--end::Card title-->

                    </div>
<<<<<<< Updated upstream
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 table-responsive location-card-body">
                        <div id="page-loader" style="display: none;">
                            <span class="spinner-border text-primary" role="status">
                            </span>
                            <div class="text-primary">Loading...</div>
                        </div>
                        @include('includes.location_table')
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
    </div>
    <!--end::Container-->
=======
                    <!--end::Card title-->

                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">

                    <table id="city-table" class="table table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800">
                                <th></th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities as $city)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td class="d-flex align-items-center">
                                    <!--begin:: Avatar -->
                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">

                                        <div class="symbol-label">
                                            {{$city->state->country->emoji}}

                                        </div>

                                    </div>
                                    <!--end::Avatar-->

                                    <!--begin::User details-->
                                    <div class="d-flex flex-column">
                                        <a href="{{ route('extract_api_areas_of_city', ['city_name' => $city->name, 'city_id' => $city->id]) }}"
                                            class="text-gray-800 text-hover-primary mb-1"><b>{{$city->name}}</b>&nbsp({{$city->state->name}},&nbsp{{$city->state->country->name}})
                                        </a>
                                    </div>
                                    <!--begin::User details-->
                                </td>
                                <td>
                                    <!--begin::Action=-->
                                    <button type="submit" style="border:none;background: none; ">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                </td>

                            </tr>
                            @endforeach


                        </tbody>
                    </table>


                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0 table-responsive location-card-body">
                    <div id="page-loader" style="display: none;">
                        <span class="spinner-border text-primary" role="status">
                        </span>
                        <div class="text-primary">Loading...</div>
                    </div>
                    @include('includes.location_table')
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content-->
    </div>
</div>
<!--end::Container-->
<!--end::Card header-->
<!--begin::Card body-->
<div class="card-body pt-0 table-responsive location-card-body">
    <div id="page-loader" style="display: none;">
        <span class="spinner-border text-primary" role="status">
        </span>
        <div class="text-primary">Loading...</div>
    </div>
    @include('includes.location_table')
</div>
<!--end::Card body-->
</div>
<!--end::Card-->
</div>
<!--end::Content-->
</div>
</div>
<!--end::Container-->
>>>>>>> Stashed changes
</div>
<!--end::Post-->

@endsection

@section('extra_scripts')
<script src="{{ asset('static/js/custom/settings/settings_home.js') }}"></script>
<script src="{{ asset('static/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    $(document).ready(function() {
            const searchForm = document.getElementById('searchForm');
            const myInput = document.getElementById('myInput');

            // Create a debounced function that submits the form
            const submitFormDebounced = debounce(function() {
                searchForm.submit();
            }, 1000); // Change 1000 to the desired delay in milliseconds (1 second in this example)

            // Listen for input events and trigger form submission after a delay
            myInput.addEventListener('input', function() {
                submitFormDebounced();
            });

            function debounce(func, delay) {
                let timeout;
                return function() {
                    const context = this;
                    const args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        func.apply(context, args);
                    }, delay);
                };
            }


        });

        // function fetch_data(page) {
        //     $.ajax({
        //         url: "{{ route('table-data', ['page' => '']) }}" + page,
        //         // url: "/core/settings/locations/table-data/" + page, // Include the page number
        //         // url: "/table-data/" + page, // Use the correct URL
        //         success: function(data) {
        //             console.log(data)
        //             $('#location_table').html(data);
        //             hideLoading();
        //             updatePaginationLinks(page);
        //         },
        //         error: function(xhr, status, error) {
        //             // Handle errors if needed
        //             console.log(error, status, xhr);
        //             hideLoading();
        //             alert(error)
        //         }
        //     })
        // }
        // function updatePaginationLinks(activePage) {
        //     // Remove the active class from all pagination links
        //     $('.page-link').parent('li').removeClass('active');
        //     // Add the active class to the current page link
        //     $('.page-link[href*="page=' + activePage + '"]').parent('li').addClass('active');
        // }

        // function showPaginator() {
        //     // Show the paginator container
        //     $('.paginator-div').show();
        // }

        // function hidePaginator() {
        //     // Hide the paginator container
        //     $('.paginator-div').hide();
        // }


        // function showLoading() {
        //     $('#page-loader').show();
        //     // Get the div element by its ID
        //     var myDiv = document.getElementById("page-loader");
        //     // Change the display property to "flex"
        //     myDiv.style.display = "flex";

        // }

        // function hideLoading() {
        //     $('#page-loader').hide();
        // }

        // var typingTimer; // Timer identifier
        // var doneTypingInterval = 1000; // Time in milliseconds (1 second)

        // function delayedFilterTable() {
        //     clearTimeout(typingTimer); // Clear the previous timer

        //     typingTimer = setTimeout(function() {
        //         var input = document.getElementById("myInput");
        //         var filter = input.value.trim(); // Trim to remove leading/trailing spaces

        //         if (filter == '') {
        //             // showPaginator();
        //             // var pageItems = $('.pagination li');

        //             // // Add the "active" class to the first <li> element
        //             // pageItems.eq(1).addClass('active');

        //             // // Remove the "active" class from all other <li> elements
        //             // pageItems.slice(2).removeClass('active');
        //             // updatePaginationLinks(2)

        //         } else {
        //             // If there is a search term, hide the paginator
        //             // hidePaginator();
        //         }
        //         filterTable(); // Execute the filterTable function after the delay
        //     }, doneTypingInterval);
        // }


        //function for searching in backend data using ajax and showing it in data table 
        // function filterTable() {
        //     showLoading();
        //     var input, filter;
        //     input = document.getElementById("myInput"); // Replace with the actual ID of your search input
        //     filter = input.value;
        //     $.ajax({
        //         type: "GET",
        //         url: "{{ route('city_search') }}", // Use the named route for searching
        //         data: {
        //             query: filter
        //         },
        //         success: function(response) {
        //             // Update the table with the received paginated search results
        //             $("#location_table").html(response);
        //             hideLoading();

        //             // hidePaginator();
        //         },
        //         error: function() {
        //             hideLoading();
        //             alert("An error occurred while searching.");
        //         }
        //     });
        // }

        // function myFunction() {
        //     var input, filter, table, tr, td, i, txtValue;
        //     input = document.getElementById("myInput");
        //     filter = input.value.toUpperCase();
        //     table = document.getElementById("location_table");
        //     tr = table.getElementsByTagName("tr");

        //     for (i = 0; i < tr.length; i++) {
        //         td = tr[i].getElementsByTagName("td")[0]; // get first column (Cities column)
        //         if (td) {
        //             txtValue = td.textContent || td.innerText; // get text within the first column
        //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
        //                 tr[i].style.display = "";
        //             } else {
        //                 tr[i].style.display = "none";
        //             }
        //         }
        //     }
        // }



        // var status = {
        //     1: {
        //         "title": "Pending",
        //         "state": "primary"
        //     },
        //     2: {
        //         "title": "Delivered",
        //         "state": "danger"
        //     },
        //     3: {
        //         "title": "Canceled",
        //         "state": "primary"
        //     },
        //     4: {
        //         "title": "Success",
        //         "state": "success"
        //     },
        //     5: {
        //         "title": "Info",
        //         "state": "info"
        //     },
        //     6: {
        //         "title": "Danger",
        //         "state": "danger"
        //     },
        //     7: {
        //         "title": "Warning",
        //         "state": "warning"
        //     },
        // };

        // $("#city-table").DataTable({
        //     "fixedHeader": {
        //         "header": true,
        //         "headerOffset": 5
        //     },
        //     "columnDefs": [{
        //         // The `data` parameter refers to the data for the cell (defined by the
        //         // `data` option, which defaults to the column being worked with, in
        //         // this case `data: 0`.
        //         "render": function(data, type, row) {
        //             var index = KTUtil.getRandomInt(1, 7);

        //             return data + '<span class="ms-2 badge badge-light-' + status[index]['state'] +
        //                 ' fw-bold">' + status[index]['title'] + '</span>';
        //         },
        //         "targets": 1
        //     }]
        // });
</script>
@endsection
<!--end::Category-->