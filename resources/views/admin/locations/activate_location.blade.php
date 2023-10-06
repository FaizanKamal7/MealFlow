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

                        <!--end::Search-->
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