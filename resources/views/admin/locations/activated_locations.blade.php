@extends('layouts.admin_master')
@section('title', 'Activated Locations')

@section('extra_style')
<link href="{{ asset('static/plugins/custom/datatables/datatables.bundle.css')}} rel=" stylesheet" type="text/css/">
@endsection
@section('main_content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <div class="container">
            <div class="card card-flush">
                <!--begin::Card header-->
                <!--begin::Card header-->
                <div class="card-header mt-6">

                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <h3 class="modal-title">Activated Locations</h3>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--start::Card Tool Bar-->
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <a href="">
                            <button class="btn btn-primary">
                                Activate Location
                            </button>
                        </a>

                        <!--end::Card Tool Bar-->
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">


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



                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('extra_scripts')
<script src="{{ asset('static/plugins/custom/documentation/general/datatables/datatables.bundle.js')}}"></script>
{{-- <script src="{{ asset('static/js/custom/documentation/general/datatables/subtable.js')}}"></script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const expandRows = document.querySelectorAll('.expand-row');
        expandRows.forEach(row => {
            row.addEventListener('click', function() {
                const hiddenRow = row.nextElementSibling;
                hiddenRow.classList.toggle('hidden-row');
            });
        });
    });


    
    $("#kt_datatable_responsive_2").DataTable({
	responsive: {
		details: {
			type: "column",
			target: -1
		}
	},
	columnDefs: [
		{
			className: "dtr-control dtr-control-last",
			orderable: false,
			targets:   -1
		},
		{
			// The `data` parameter refers to the data for the cell (defined by the
			// `data` option, which defaults to the column being worked with, in
			// this case `data: 0`.
			"render": function ( data, type, row ) {
				var index = KTUtil.getRandomInt(1, 7);

				return data + "<span class=\"ms-2 badge badge-light-" + status[index]["state"] + " fw-bold\">" + status[index]["title"] + "</span>";
			},
			"targets": 1
		}
	]
});
</script>
@endsection