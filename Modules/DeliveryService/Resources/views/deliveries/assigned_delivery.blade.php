@extends('businessservice::layouts.master')
@section('title', 'Assigned Deliveries')

@section('extra_style')
    {{-- <link href="{{ asset('static/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css/"> --}}
@endsection
@section('main_content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <div class="container">
                <div class="">
                    <!--begin::Card header-->
                    <div class="d-flex mt-2 align-items-center pricing-header justify-content-between">
                        <div class="activate-service">
                            <h1 class="fs-lg-2x ">Assigned Deliveries</h1>
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
                                    class="form-control form-control-solid w-200px ps-20 location-dropdown"
                                    placeholder="Search" value="{{ request()->query('query') }}" />
                                {{-- </form> --}}
                            </div>
                            <!--end::Search-->
                            <div class="d-flex align-items-center position-relative me-3">
                                <input class="form-control w-250px" placeholder="Select a date range"
                                    id="kt_datepicker_7" />
                                <span class="svg-icon svg-icon-1 position-absolute location-icon"
                                    style="right: 6%; cursor:pointer" id="calendar_icon">
                                    <x-iconsax-bul-calendar />
                                </span>
                            </div>
                        </div>
                        <!--end::Card title-->

                    </div>
                    <div class="d-flex mt-2 align-items-center justify-content-between unassigned-second-div">
                        <div class="d-flex align-items-center print-div">
                            <div class="me-3">
                                <a class="btn csv-btn">CSV</a>
                            </div>
                            <div class="me-3">
                                <a class="btn csv-btn">Print</a>
                            </div>
                            <div class="column-select">
                                <select class="form-select" id="columnVisibility" data-control="select2"
                                    data-placeholder="Column Visisbility" multiple>
                                </select>
                            </div>

                        </div>
                        <div class="d-flex align-items-center detail-div">
                            <div class="me-3">
                                <select class="form-select" data-control="select2" data-placeholder="Select Partner">
                                    <option></option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                </select>
                            </div>
                            <div class="me-3">
                                <select class="form-select" data-control="select2" data-placeholder="Select Emirate">
                                    <option></option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                </select>
                            </div>
                            <div class="">
                                <select class="form-select" data-control="select2" data-placeholder="Select Time Slot">
                                    <option></option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                </select>
                            </div>
                            <div class="">
                                <a class="btn text-white activate-btn" style="height: 38px !important ">Show Details</a>
                            </div>

                        </div>

                    </div>

                    <div class="align-items-center justify-content-between mt-3 select-option-div unassigned-second-div"
                        style="display: none;">
                        <div class="driver-div">
                            <select id="driverSelect" class="form-select" data-control="select2"
                                data-placeholder="Select Driver" data-allow-clear="true" onchange="handleDriverSelection()">
                                <option></option>
                                <option value="1">Driver 1</option>
                                <option value="2">Driver 2</option>
                            </select>
                        </div>
                        <div class="d-flex align-items-center assign-div">
                            <div class="me-3">
                                <a id="assignButton" class="btn csv-btn disabled">Assign</a>
                            </div>
                            <div class="me-3">
                                <a id="autoAssignButton" class="btn csv-btn">Auto-Assign</a>
                            </div>
                            <div class="me-3">
                                <a class="btn csv-btn">Reschedule</a>
                            </div>
                            <div class="me-3">
                                <a class="btn csv-btn cancel" onclick="uncheckAllCheckboxes()">Cancel</a>
                            </div>
                            <div class="me-3">
                                <a class="btn csv-btn">Delete</a>
                            </div>
                            <div class="">
                                <a class="btn csv-btn">Print Label with Logo</a>
                            </div>

                        </div>
                    </div>

                    <div class="mt-3 table-responsive location-card">
                        <table id="unassigned_table" class="table table-striped table-row-bordered gy-5 gs-7">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th class=""><input class="form-check-input" type="checkbox" value=""></th>
                                    <th class="">Sr. No</th>
                                    <th class="w-150px">Order ID</th>
                                    <th class="w-150px">Customers</th>
                                    <th class="w-150px">Driver</th>
                                    <th class="w-100px">Plan ID</th>
                                    <th class="w-150px">Delivery Address</th>
                                    <th class="w-100px">Notes</th>
                                    <th class="w-150px">Time Slot</th>
                                    <th class="w-150px">Partner</th>
                                    <th class="w-100px">Created At</th>
                                    <th class="w-150px">Uplaoded By</th>
                                    <th class="w-100px">Pickup Location</th>
                                    <th class="w-100px">Product Type</th>
                                    <th>Notification</th>
                                    <th>Payment</th>
                                    <th>Company Delivery Id</th>
                                    <th>Google Link</th>
                                    <th class="min-w-1px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // Generate and use dummy data
                                    $dummyData = [
                                        [
                                            'order_id' => 1600515,
                                            'suggested_driver' => 'SIKANDAR 971505636932',
                                            'plan_id' => 18114,
                                            'customer' => 'Laura del Castro 971507146924',
                                            'delivery_address' => 'Bloom Towers - Tower B JVC District 10 B Dubai 2009, Dubai(JVC)',
                                            'notes' => 'dont bell',
                                            'time' => '26-09-2023 Dubai,(6AM-9AM)',
                                            'partner' => 'BASILIGO RESTAURANT LLC 971545180219',
                                            'created_at' => '2023-05-05 11:45:15',
                                            'upload_by' => 'basiligo@thelogx.com',
                                            'pickup' => 'Office Location',
                                            'type' => 'Food/Liquid',
                                            'notification' => 'Yes',
                                            'payment' => 0,
                                            'company_id' => '',
                                            'google_add' => 'none',
                                        ],
                                        [
                                            'order_id' => 1600516,
                                            'suggested_driver' => 'AHMAD 971563871287',
                                            'plan_id' => 18114,
                                            'customer' => 'Laura del Castro 971507146924',
                                            'delivery_address' => 'Bloom Towers - Tower B JVC District 10 B Dubai 2009, Dubai(JVC)',
                                            'notes' => 'Don t ring the bell',
                                            'time' => '26-09-2023 Dubai,(6AM-9AM)',
                                            'partner' => 'BASILIGO RESTAURANT LLC 971545180219',
                                            'created_at' => '2023-05-05 11:45:15',
                                            'upload_by' => 'basiligo@thelogx.com',
                                            'pickup' => 'Office Location',
                                            'type' => 'Food/Liquid',
                                            'notification' => 'Yes',
                                            'payment' => 0,
                                            'company_id' => '',
                                            'google_add' => 'none',
                                        ],
                                        [
                                            'order_id' => 1600517,
                                            'suggested_driver' => 'AHMAD 971563871287',
                                            'plan_id' => 18115,
                                            'customer' => 'Laura del Castro 971507146924',
                                            'delivery_address' => 'Eastern Mangroves Promenade 2 Abu dhabi 515, Abu dhabi(Eastern Mangrove)',
                                            'notes' => 'dont bell',
                                            'time' => '26-09-2023 Dubai,(6AM-9AM)',
                                            'partner' => 'BASILIGO RESTAURANT LLC 971545180219',
                                            'created_at' => '2023-05-05 11:45:15',
                                            'upload_by' => 'basiligo@thelogx.com',
                                            'pickup' => 'Office Location',
                                            'type' => 'Food/Liquid',
                                            'notification' => 'Yes',
                                            'payment' => 0,
                                            'company_id' => '',
                                            'google_add' => 'none',
                                        ],
                                        [
                                            'order_id' => 1600518,
                                            'suggested_driver' => 'SIKANDAR 971505636932',
                                            'plan_id' => 18114,
                                            'customer' => 'Laura del Castro 971507146924',
                                            'delivery_address' => 'Bloom Towers - Tower B JVC District 10 B Dubai 2009, Dubai(JVC)',
                                            'notes' => 'dont bell',
                                            'time' => '26-09-2023 Dubai,(6AM-9AM)',
                                            'partner' => 'BASILIGO RESTAURANT LLC 971545180219',
                                            'created_at' => '2023-05-05 11:45:15',
                                            'upload_by' => 'basiligo@thelogx.com',
                                            'pickup' => 'Office Location',
                                            'type' => 'Food/Liquid',
                                            'notification' => 'Yes',
                                            'payment' => 0,
                                            'company_id' => '',
                                            'google_add' => 'none',
                                        ],
                                        [
                                            'order_id' => 1600519,
                                            'suggested_driver' => 'AHMAD 971563871287',
                                            'plan_id' => 18114,
                                            'customer' => 'Laura del Castro 971507146924',
                                            'delivery_address' => 'Bloom Towers - Tower B JVC District 10 B Dubai 2009, Dubai(JVC)',
                                            'notes' => 'Don t ring the bell',
                                            'time' => '26-09-2023 Dubai,(6AM-9AM)',
                                            'partner' => 'BASILIGO RESTAURANT LLC 971545180219',
                                            'created_at' => '2023-05-05 11:45:15',
                                            'upload_by' => 'basiligo@thelogx.com',
                                            'pickup' => 'Office Location',
                                            'type' => 'Food/Liquid',
                                            'notification' => 'Yes',
                                            'payment' => 0,
                                            'company_id' => '',
                                            'google_add' => 'none',
                                        ],
                                        [
                                            'order_id' => 1600521,
                                            'suggested_driver' => 'SIKANDAR 971505636932',
                                            'plan_id' => 18114,
                                            'customer' => 'Laura del Castro 971507146924',
                                            'delivery_address' => 'Bloom Towers - Tower B JVC District 10 B Dubai 2009, Dubai(JVC)',
                                            'notes' => 'dont bell',
                                            'time' => '26-09-2023 Dubai,(6AM-9AM)',
                                            'partner' => 'BASILIGO RESTAURANT LLC 971545180219',
                                            'created_at' => '2023-05-05 11:45:15',
                                            'upload_by' => 'basiligo@thelogx.com',
                                            'pickup' => 'Office Location',
                                            'type' => 'Food/Liquid',
                                            'notification' => 'Yes',
                                            'payment' => 0,
                                            'company_id' => '',
                                            'google_add' => 'none',
                                        ],
                                        [
                                            'order_id' => 1600522,
                                            'suggested_driver' => 'AHMAD 971563871287',
                                            'plan_id' => 18114,
                                            'customer' => 'Laura del Castro 971507146924',
                                            'delivery_address' => 'Bloom Towers - Tower B JVC District 10 B Dubai 2009, Dubai(JVC)',
                                            'notes' => 'Don t ring the bell',
                                            'time' => '26-09-2023 Dubai,(6AM-9AM)',
                                            'partner' => 'BASILIGO RESTAURANT LLC 971545180219',
                                            'created_at' => '2023-05-05 11:45:15',
                                            'upload_by' => 'basiligo@thelogx.com',
                                            'pickup' => 'Office Location',
                                            'type' => 'Food/Liquid',
                                            'notification' => 'Yes',
                                            'payment' => 0,
                                            'company_id' => '',
                                            'google_add' => 'none',
                                        ],
                                    ];
                                @endphp

                                @foreach ($dummyData as $delivery)
                                    <tr class="">
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                value="{{ $delivery['order_id'] }}"
                                                id="checkbox-{{ $delivery['order_id'] }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-50px">
                                                <b>{{ $loop->iteration }}</b>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-100px">
                                                <b>{{ $delivery['order_id'] }}</b>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-150px">
                                                {{ $delivery['customer'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-150px">
                                                {{ $delivery['suggested_driver'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-100px">
                                                {{ $delivery['plan_id'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-150px">
                                                {{ $delivery['delivery_address'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-100px">
                                                {{ $delivery['notes'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-150px">
                                                {{ $delivery['time'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-150px">
                                                {{ $delivery['partner'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-150px">
                                                {{ $delivery['created_at'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-150px">
                                                {{ $delivery['upload_by'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-150px">
                                                {{ $delivery['pickup'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-100px">
                                                {{ $delivery['type'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-100px">
                                                {{ $delivery['notification'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-100px">
                                                {{ $delivery['payment'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-150px">
                                                {{ $delivery['company_id'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-150px">
                                                {{ $delivery['google_add'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="table-icon" onclick="">
                                                    <x-iconsax-bul-edit-2 /> </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- end table div --}}
                    <div class="mt-6">
                        <ul class="pagination ">
                            <li class="page-item previous disabled"><a href="#" class="page-link"><i
                                        class="previous"></i></a>
                            </li>
                            <li class="page-item "><a href="#" class="page-link">1</a></li>
                            <li class="page-item active"><a href="#" class="page-link">2</a></li>
                            <li class="page-item "><a href="#" class="page-link">3</a></li>
                            <li class="page-item "><a href="#" class="page-link">4</a></li>
                            <li class="page-item "><a href="#" class="page-link">5</a></li>
                            <li class="page-item "><a href="#" class="page-link">6</a></li>
                            <li class="page-item next"><a href="#" class="page-link"><i class="next"></i></a>
                            </li>
                        </ul>
                    </div>


                </div>
            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection

@section('extra_scripts')
    <script>
        // assign button
        document.addEventListener("DOMContentLoaded", function() {
            // Get references to the "Assign" button and the driver selection dropdown
            const assignButton = document.getElementById("assignButton");
            const driverSelect = document.getElementById("driverSelect");
            // Add a click event listener to the "Assign" button
            assignButton.addEventListener("click", function() {
                // Get all the checked checkboxes
                const checkboxes = document.querySelectorAll('input.form-check-input:checked');
                // Get the selected driver's information
                const selectedDriverId = driverSelect.value;
                const selectedDriverName = driverSelect.options[driverSelect.selectedIndex].text;
                // Create an array to store the selected row data with the driver information
                const selectedRowsData = [];
                // Iterate through the checked checkboxes
                checkboxes.forEach(function(checkbox) {
                    // Get the closest <tr> element (the parent row) for each checked checkbox
                    const row = checkbox.closest("tr");
                    // Collect the data from the row's cells (td elements)
                    const rowData = Array.from(row.querySelectorAll("td")).map(function(cell) {
                        return cell.textContent.trim();
                    });
                    // Add the driver information to the row's data
                    rowData.push({
                        driverId: selectedDriverId,
                        driverName: selectedDriverName,
                    });
                    // Add the rowData array to the selectedRowsData array
                    selectedRowsData.push(rowData);
                });
                // Prepare the data to be sent to the backend (you can customize this as needed)
                const dataToSend = {
                    selectedRows: selectedRowsData,
                    // Add other details here as needed
                };
                console.log('hehe', dataToSend)
                // Send an AJAX request to the backend (you need to specify the backend endpoint)
            });
        });

        function handleDriverSelection() {
            // Get the selected driver value
            const selectedDriverValue = document.getElementById("driverSelect").value;
            const assignButton = document.getElementById("assignButton");
            if (driverSelect.value !== "") {
                // Remove the "disabled" class from the "Assign" button
                assignButton.classList.remove("disabled");
                // Enable the button for interaction by removing the style attribute
                assignButton.removeAttribute("style");
            } else {
                // Add the "disabled" class to the "Assign" button if no driver is selected
                assignButton.classList.add("disabled");
                // Disable the button for interaction by setting the style attribute
                assignButton.style.pointerEvents = "none";
            }
        }

        // auto assign button
        document.addEventListener("DOMContentLoaded", function() {
            // Get a reference to the "Auto Assign" button
            const autoAssignButton = document.getElementById("autoAssignButton");
            // Add a click event listener to the button
            autoAssignButton.addEventListener("click", function() {
                // Get all the checked checkboxes
                const checkboxes = document.querySelectorAll('input.form-check-input:checked');
                // Create an array to store the selected checkbox values
                const selectedRowData = [];
                // Iterate through the checked checkboxes
                checkboxes.forEach(function(checkbox) {
                    // Get the closest <tr> element (the parent row) for each checked checkbox
                    const row = checkbox.closest("tr");
                    // Collect the data from the row's cells (td elements)
                    const rowData = Array.from(row.querySelectorAll("td")).map(function(cell) {
                        return cell.textContent.trim();
                    });
                    // Add the rowData array to the selectedRowData array
                    selectedRowData.push(rowData);
                });
                // Prepare the data to be sent to the backend (you can customize this as needed)
                const dataToSend = {
                    selectedRows: selectedRowData,
                    // Add other details here as needed
                };
                console.log('Selected Rows Data', dataToSend);

                // Send an AJAX request to the backend (you need to specify the backend endpoint)
                // You can use libraries like Axios or the native fetch API for this
                // Example using fetch:
                // fetch('/your-backend-endpoint', {
                //         method: 'POST',
                //         headers: {
                //             'Content-Type': 'application/json',
                //         },
                //         body: JSON.stringify(dataToSend),
                //     })
                //     .then(response => {
                //         if (response.ok) {
                //             // Handle success, e.g., show a success message
                //             alert("Selected checkboxes have been sent to the backend.");
                //         } else {
                //             // Handle errors, e.g., display an error message
                //             alert("An error occurred while sending data to the backend.");
                //         }
                //     })
                //     .catch(error => {
                //         // Handle network errors
                //         console.error("Network error:", error);
                //     });
            });
        })

        $(document).ready(function() {
            $("#kt_datepicker_7").flatpickr({
                altInput: true,
                altFormat: "j M Y", // Use "j M Y" for the format "12 Sept 2023"
                dateFormat: "Y-m-d",
                mode: "range"
            });

            // Get the table headers and populate the dropdown
            const tableHeaders = document.querySelectorAll('#unassigned_table thead th');
            const columnVisibilityDropdown = document.getElementById('columnVisibility');

            tableHeaders.forEach((header, index) => {
                const columnHeader = header.textContent.trim();
                const option = document.createElement('option');
                option.value = index;
                option.textContent = columnHeader;
                columnVisibilityDropdown.appendChild(option);
            });
            handleCheckboxSelection();
        });

        // Handle column visibility
        $('#columnVisibility').change(function() {
            const selectedColumns = $(this).val();
            if (Array.isArray(selectedColumns)) {
                // Show all columns
                $('#unassigned_table th, #unassigned_table td').show();

                // Hide selected columns
                selectedColumns.forEach(function(index) {
                    $(`#unassigned_table th:nth-child(${parseInt(index) + 1}), #unassigned_table td:nth-child(${parseInt(index) + 1})`)
                        .hide();
                });
            } else {
                // Handle the case where selectedColumns is not an array
                console.error("selectedColumns is not an array.");
            }
        });

        function handleCheckboxSelection() {
            const checkboxes = document.querySelectorAll('.form-check-input');
            const selectOptionDiv = document.querySelector('.select-option-div');

            checkboxes.forEach((checkbox) => {
                checkbox.addEventListener('change', function() {
                    const selectedCheckboxes = Array.from(checkboxes).filter((cb) => cb.checked);
                    if (selectedCheckboxes.length > 0) {
                        selectOptionDiv.style.display = 'flex'; // Show the select-option-div
                    } else {
                        selectOptionDiv.style.display = 'none'; // Hide the select-option-div
                    }
                });
            });
        }

        function uncheckAllCheckboxes() {
            const checkboxes = document.querySelectorAll('input.form-check-input:checked');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
            //hiding div
            const selectOptionDiv = document.querySelector('.select-option-div');
            selectOptionDiv.style.display = 'none';
        }
    </script>
@endsection
