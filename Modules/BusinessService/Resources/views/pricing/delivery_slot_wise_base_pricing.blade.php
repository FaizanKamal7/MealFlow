@extends('layouts.admin_master')
@section('title', 'Business Pricing')

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
						<h3 class="modal-title">Base Pricing Info (Delivery Slot Wise)</h3>
						<!--end::Search-->
					</div>
					<!--end::Card title-->
					<!--start::Card Tool Bar-->
					<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
						<a href="{{route('add_delivery_slot_base_pricing')}}">
							<button class="btn btn-primary">
								Add Delivery Slot Price
							</button>
						</a>

						<!--end::Card Tool Bar-->
					</div>
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body pt-0">


					@if ($delivery_slot_pricings)

					<!--begin::Table-->
					<table class="table border gy-5 gs-7" id="re_team_table">
						<!--begin::Table head-->
						<thead class="bg-light-dark">
							<!--begin::Table row-->
							<tr class="text-start fw-bolder fs-7 text-uppercase gs-0">
								<th class="min-w-125px">City</th>
								<th class="min-w-1px">Delivery Slot</th>
								<th class="min-w-1px">Delivery Price <br>(Same Location)</th>
								<th class="min-w-1px">Bag Collection Price <br>(Same Location)</th>
								<th class="min-w-1px">Cash Collection Price <br>(Same Location)</th>
								<th class="min-w-1px">Added on </th>
								<th class="min-w-1px">Action</th>
							</tr>
							<!--end::Table row-->
						</thead>
						<!--end::Table head-->
						<!--begin::Table body-->
						<tbody class="fw-bold text-gray-600">

							@foreach ($delivery_slot_pricings as $pricing)
							<tr>
								<td>{{$pricing->city->name}}, ({{$pricing->city->state->name}},
									{{$pricing->city->state->country->name}})</td>
								<td>{{ $pricing->delivery_slot_id ? ($pricing->deliverySlot->start_time . ' - ' .
									$pricing->deliverySlot->end_time) : "" }}</td>

								<td>{{$pricing->delivery_price}} ({{$pricing->same_loc_delivery_price}})</td>
								<td>{{$pricing->bag_collection_price}} ({{$pricing->same_loc_bag_collection_price}})
								</td>
								<td>{{$pricing->cash_collection_price}} ({{$pricing->same_loc_cash_collection_price}})
								</td>
								<td>{{$pricing->created_at}} </td>
								<td>
									<!--begin::Members-->
									<a href="" class="btn btn-icon btn-active-light-success w-30px h-30px"
										data-bs-toggle="tooltip" title="Team Members">
										<!--begin::Svg Icon | path: assets/media/icons/duotune/communication/com014.svg-->
										<span class="svg-icon svg-icon-3"><svg xmlns="http://www.w3.org/2000/svg"
												width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path
													d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z"
													fill="currentColor" />
												<rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2"
													fill="currentColor" />
												<path
													d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z"
													fill="currentColor" />
												<rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3"
													fill="currentColor" />
											</svg>
										</span>
										<!--end::Svg Icon-->
									</a>
									<!--end::Members-->
									<!--begin::Edit-->

									<a onclick="" class="btn btn-icon btn-active-light-primary w-30px h-30px"
										data-bs-toggle="tooltip" title="Edit">
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
									</a>
									<!--end::Edit-->
									<!--begin::Delete-->
									<a id="" onclick="" class="btn btn-icon btn-active-light-danger w-30px h-30px"
										data-bs-toggle="tooltip" title="Delete">
										<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
										<span class="svg-icon svg-icon-3">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
												viewBox="0 0 24 24" fill="none">
												<path
													d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
													fill="currentColor" />
												<path opacity="0.5"
													d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
													fill="currentColor" />
												<path opacity="0.5"
													d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
													fill="currentColor" />
											</svg>
										</span>
										<!--end::Svg Icon-->
									</a>
									<!--end::Delete-->
								</td>
							</tr>
							@endforeach


							<!--end::Table body-->
					</table>
					<!--end::Table-->

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