<div class="main-div-report">

    <div class="customer_detail_div mt-5">
        <div class="table customer_table">
            <div class="table-row top-row">
                <div class="cell">
                    <p>Customer Name</p>
                </div>
                <div class="cell">
                    <p>Code</p>
                </div>
                <div class="cell">
                    <p>Contact</p>
                </div>
                <div class="cell">
                    <p>Partner</p>
                </div>
                <div class="cell">
                    <p>Email</p>
                </div>
            </div>
            <div class="table-row bottom-row">
                @if ($user)
                    <div class="cell customer_name">
                        <h5 class="fw-bolder">{{ $user['name'] }}</h5>
                    </div>
                    <div class="cell">
                        <p class="fw-bolder">FR-2820</p>
                    </div>
                    <div class="cell">
                        <p class="fw-bolder">{{ $user['phone'] }}</p>
                    </div>
                    <div class="cell">
                        <p class="fw-bolder">Freshly</p>
                    </div>
                    <div class="cell">
                        <p class="fw-bolder">{{ $user['email'] }}</p>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <div class="bag_detail_div mt-5">
        <div class="table bag_table">
            <div class="table-row top-row-bag">
                <div class="fw-bold cell">
                    <p>Total Bags</p>
                </div>
                <div class="fw-bold cell">
                    <p>Paper Bags Delivered</p>
                </div>
                <div class="fw-bold cell">
                    <p>Cooler Bags Dispatched</p>
                </div>
                <div class="fw-bold cell">
                    <p>Cooler Bags Returned</p>
                </div>
                <div class="fw-bold cell">
                    <p>Cooler Bags with Client</p>
                </div>
            </div>
            <div class="table-row bottom-row-bag">
                <div class="cell">
                    <p class="fw-bolder">20</p>
                </div>
                <div class="cell">
                    <p class="fw-bolder">4</p>
                </div>
                <div class="cell">
                    <p class="fw-bolder">3</p>
                </div>
                <div class="cell">
                    <p class="fw-bolder">0</p>
                </div>
                <div class="cell">
                    <p class="fw-bolder">4</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-2 d-flex align-items-center print-div unassigned-second-div">
        <div class="me-3">
            <a class="btn csv-btn">CSV</a>
        </div>
        <div class="me-3">
            <a class="btn csv-btn">Print</a>
        </div>
        <div class="me-3">
            <a class="btn csv-btn">PDF</a>
        </div>
        <div class="column-select">
            <select class="form-select" id="columnVisibility" data-control="select2"
                data-placeholder="Column Visisbility" multiple>
            </select>
        </div>
    </div>

    <div class="mt-3 table-responsive bag-card">
        <table id="plan_table" class="table table-striped table-row-bordered gy-5 gs-7">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th class="w-150px">Plan ID</th>
                    <th class="w-150px">Start Date</th>
                    <th class="w-150px">End Date</th>
                    <th class="w-100px">Plan Days</th>
                    <th class="w-200px">Deliveries Details</th>
                    <th class="w-150px">Total Days</th>
                    <th class="w-100px">Status</th>
                    <th class="w-150px">Plan Details</th>
                    <th class="w-100px">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($customer_meal_plans)
                    @foreach ($customer_meal_plans as $meal_plans)
                        {{-- to be completed, loop on data --}}
                        <tr class="">
                            <td>
                                <div class="opacity-75">
                                    <b>{{ $meal_plans['id'] }}</b>
                                </div>
                            </td>
                            <td>
                                <div class="w-100px opacity-75">
                                    {{ $meal_plans['start_date'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-100px opacity-75">
                                    {{ $meal_plans['end_date'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-100px opacity-75">
                                    {{ $meal_plans['total_days'] }} Days
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    <p class="delivery_back delivery_blue opacity-75">Total Deliveries:
                                        <span> {{ $meal_plans['total_deliveries'] }}</span>
                                    </p>
                                    <p class="delivery_back delivery_yellow opacity-75">Pending:
                                        <span>{{ $meal_plans['pending'] }}</span>
                                    </p>
                                    <p class="delivery_back delivery_purple opacity-75">Freezed:
                                        {{-- <span>{{ $bag['delivery_details']['freezed'] }}</span> --}}
                                    </p>
                                    <p class="delivery_back delivery_pink opacity-75">Cancelled:
                                        {{-- <span>{{ $bag['delivery_details']['cancelled'] }}</span> --}}
                                    </p>
                                    <p class="delivery_back delivery_green opacity-75">Delivered:
                                        {{-- <span>{{ $bag['delivery_details']['delivered'] }}</span> --}}
                                    </p>

                                </div>
                            </td>
                            <td>
                                <div class="">
                                    <p class="day_back day_blue opacity-75">Total:
                                        <span>{{ $meal_plans['total_days'] }}</span>
                                    </p>
                                    <p class="day_back day_light opacity-75">Remaining:
                                        {{-- <span>{{ $bag['total_days']['remaining'] }}</span> --}}
                                    </p>
                                    <p class="day_back day_less opacity-75">Paused:
                                        {{-- <span>{{ $bag['total_days']['pause'] }}</span> --}}
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div
                                    class="opacity-75 {{ $meal_plans['status'] === 'active' ? 'active-class' : 'inactive-class' }}">
                                    {{ $meal_plans['status'] }}
                                </div>
                            </td>
                            <td>
                                <div class="w-150px opacity-75">
                                    {{-- {{ $meal_plans['plan_detail'] }} --}}
                                </div>
                            </td>
                            <td>
                                <div class="w-100px ms-5">
                                    <span class="d-block table-icon" onclick="">
                                        <x-iconsax-bul-edit-2 />
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script>
        // Livewire.on('dataLoaded', () => {
        //     // Reinitialize the select2 plugin
        //     $('#columnVisibility').select2({
        //         // Your select2 options here
        //     });
        // });

        $(document).ready(function() {
            // Get the table headers and populate the dropdown
            const tableHeaders = document.querySelectorAll(
                "#plan_table thead th"
            );
            const columnVisibilityDropdown =
                document.getElementById("columnVisibility");

            tableHeaders.forEach((header, index) => {
                const columnHeader = header.textContent.trim();
                const option = document.createElement("option");
                option.value = index;
                option.textContent = columnHeader;
                columnVisibilityDropdown.appendChild(option);
            });
        });

        // Handle column visibility
        $("#columnVisibility").change(function() {
            const selectedColumns = $(this).val();
            if (Array.isArray(selectedColumns)) {
                // Show all columns
                $("#plan_table th, #plan_table td").show();

                // Hide selected columns
                selectedColumns.forEach(function(index) {
                    $(
                        `#plan_table th:nth-child(${
                    parseInt(index) + 1
                }), #plan_table td:nth-child(${parseInt(index) + 1})`
                    ).hide();
                });
            } else {
                // Handle the case where selectedColumns is not an array
                console.error("selectedColumns is not an array.");
            }
        });
    </script>
@endpush
