@extends('fleetservice::layouts.master')
@section('title', ' Driver Timeline')

@section('extra_style')
@endsection

@section('main_content')

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->

            <!--begin::Row-->
            <div class="row gy-5 g-xl-8 d-flex justify-content-center">

                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Tables Widget 9-->
                    <!--begin::List widget 10-->
                    <div class="card card-flush ">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-gray-800">Driver History</span>
                                <span class="text-gray-400 mt-1 fw-bold fs-6">59 Active Dilevery</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle='tooltip'
                                    data-bs-dismiss='click' data-bs-custom-class="tooltip-dark"
                                    title="Logistics App is coming soon">View All</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Nav-->

                            <!--end::Nav-->
                            <!--begin::Tab Content-->
                            <div class="">
                                <!--begin::Tap pane-->
                                <div class="" id="kt_list_widget_10_tab_1">
                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-sm-center pb-15">
                                            <!--begin::Symbol-->
                                            <div class="me-7 mb-4">
                                                <div
                                                    class="symbol symbol-100px symbol-lg-100px symbol-fixed position-relative">
                                                    <img src="{{ asset('static/media/avatars/300-7.jpg') }}"
                                                        alt="image" />
                                                    <div
                                                        class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                                <div class="flex-grow-1 ">
                                                    <span class="text-gray-800 fw-bolder d-block fs-6">{{$driver->employee->first_name}}</span>
                                                    <a href="#" class="text-gray-400 fs-1x fw-bold">#{{$driver->employee->personal_phone_number}}</a>
													<span href="#"
													class="text-gray-400 fs-1x d-block fw-bold">{{$driver->employee->personal_email_address}}</span>
                                                    <span href="#"
                                                        class="text-gray-400 fs-1x d-block fw-bold">{{$driver->employee->city}},{{$driver->employee->country}} </span>
                                                  

                                                </div>

                                            </div>
											@if(!$driver->logs->first()->check_out_time)

                                            <div class="me-2 mb-4 ps-10">
                                                <div
                                                    class="symbol symbol-100px symbol-lg-150px symbol-fixed position-relative">
                                                    <img src="{{ asset('static/media\Fleet\images-2.jpg') }}" class=""
                                                        alt="" />
                                                </div>
                                            </div>
                                            
									

                                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                                <div class="flex-grow-1 me-2">

                                                    <a href="#" class="text-gray-400 fs-1x fw-bold">{{ucfirst($driver->logs->first()->vehicle->vehicleModel->make)}} {{ucfirst($driver->logs->first()->vehicle->vehicleModel->model)}}</a>
                                                    <a href="#" class="text-gray-400 fs-1x fw-bold">{{$driver->logs->first()->vehicle->registration_number}}</a>



                                                </div>

                                            </div>
											@endif





                                            <!--end::Section-->
                                        </div>
                                        <div class=" d-flex justify-content-center mb-7 ">
                                            <div class=" me-2">
                                                <span class="text-gray-500 fw-bolder fs-1x">60 km\h -> 51.3 km\h </span>
                                                <span class="text-gray-500 fw-bolder fs-1x ps-">.58 mins</span>

                                            </div>
                                        </div>

                
                                        <!--end::Wrapper-->
                                        <!--begin::Timeline-->
                                        <div class="timeline-label">
											@php
											$logCount = count($driver->logs);
											$showMore = $logCount > 1;
											@endphp
                                            @foreach ($driver->logs->take(1) as $log)
												{{-- ---FOR CHECK IN  --}}

												@if (!$log->check_out_time)
												<div class="timeline-item mb-15">


													<!--begin::Label-->
													<div class="timeline-label fw-bolder text-gray-800 fs-6 ">{{ \Carbon\Carbon::parse($log->check_in_time)->format('j-M-Y') }}</div>
													<!--end::Label-->
													<!--begin::Badge-->
													<div class="timeline-badge">
														<i class="fa fa-genderless text-warning fs-1"></i>
													</div>
													<div class="timeline-content d-flex">
                                                        <span class="fw-bolder text-gray-800 ps-3">{{ \Carbon\Carbon::parse($log->check_in_time)->format('H:i:s')}}</span>
                                                        <div class="fw-mormal timeline-content text-muted ps-3"></div>
										
                                                        <span
                                                            class="badge badge-lg badge-light-success fw-bolder " data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-custom-class="tooltip-dark" title="Model : AGZ5161<br>Registration N0 : JAKSHSA67<br>Owner : Ali Ahmed <br>Engine :1817CC Turbo">Vehicle :{{$log->vehicle->registration_number}}</span>

                                                    </div>
													<!--end::Badge-->
													<!--begin::Text-->
													<!--end::Text-->
												</div>
												
												@else

                                                <!--begin::Item-->
                                                <div class="timeline-item mb-15 mt-5">
                                                    <!--begin::Label-->
                                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">{{ \Carbon\Carbon::parse($log->check_in_time)->format('j-M-Y') }}</div>
                                                    <!--end::Label-->
                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge">
                                                        <i class="fa fa-genderless text-success fs-1"></i>
                                                    </div>
                                                    <!--end::Badge-->
                                                    <!--begin::Content-->
                                                    <div class="timeline-content d-flex">
                                                        <span class="fw-bolder text-gray-800 ps-3">{{ \Carbon\Carbon::parse($log->check_in_time)->format('H:i:s')}}</span>
                                                        <div class="fw-mormal timeline-content text-muted ps-3"></div>
                                                        <span
                                                            class="badge badge-lg badge-light-success fw-bolder" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-custom-class="tooltip-dark" title="Model : AGZ5161<br>Registration N0 : JAKSHSA67<br>Owner : Ali Ahmed <br>Engine :1817CC Turbo">Vehicle :{{$log->vehicle->registration_number}}</span>

                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Item-->
												{{-- ---FOR CHECK OUT  --}}
                                                <!--begin::Item-->
                                                <div class="timeline-item mb-15">
                                                    <!--begin::Label-->
                                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">{{ \Carbon\Carbon::parse($log->check_out_time)->format('j-M-Y')}}</div>
                                                    <!--end::Label-->
                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge">
                                                        <i class="fa fa-genderless text-danger fs-1"></i>
                                                    </div>
                                                    <!--end::Badge-->
                                                    <!--begin::Desc-->
                                                    <div class="timeline-content fw-bolder text-gray-800 ps-3">{{ \Carbon\Carbon::parse($log->check_out_time)->format('H:i:s') }}
														
                                                    </div>
                                                    <span class="badge badge-lg badge-light-danger fw-bolder ">Vehicle :{{$log->vehicle->registration_number}}</span>

                                                    <!--end::Desc-->
                                                </div>

												@endif
                                                <!--end::Item-->
                                            @endforeach
												{{-- --------SHOW MORE BUTTON  --}}
											@if($showMore)
                                            <div class="d-flex flex-stack fs-4 pb-3">
                                                <div class="fw-bolder rotate collapsible" id="viewMoreButton" data-bs-toggle="collapse" href="#kt_customer_view_details" role="button" aria-expanded="true" aria-controls="kt_customer_view_details">View More 
                                                    <span class="ms-2 rotate-180">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </div>
                                                
                                            </div>
											{{-- <button id="viewMoreButton" class="btn btn-primary mt-3">View More</button> --}}
											<div id="hiddenLogs" style="display: none;">
												@foreach ($driver->logs->slice(1) as $log)
												{{-- ---FOR CHECK IN  --}}

												@if (!$log->check_out_time)
												<div class="timeline-item mb-15">


													<!--begin::Label-->
													<div class="timeline-label fw-bolder text-gray-800 fs-6 ">{{ \Carbon\Carbon::parse($log->check_in_time)->format('j-M-Y') }}</div>
													<!--end::Label-->
													<!--begin::Badge-->
													<div class="timeline-badge">
														<i class="fa fa-genderless text-warning fs-1"></i>
													</div>
													<div class="timeline-content d-flex">
                                                        <span class="fw-bolder text-gray-800 ps-3">{{ \Carbon\Carbon::parse($log->check_in_time)->format('H:i:s')}}</span>
                                                        <div class="fw-mormal timeline-content text-muted ps-3"></div>
                                                        <span
                                                            class="badge badge-lg badge-light-success fw-bolder " data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-custom-class="tooltip-dark" title="Model : AGZ5161<br>Registration N0 : JAKSHSA67<br>Owner : Ali Ahmed <br>Engine :1817CC Turbo">Vehicle :{{$log->vehicle->registration_number}}</span>

                                                    </div>
													<!--end::Badge-->
													<!--begin::Text-->
													<!--end::Text-->
												</div>
												@else

                                                <!--begin::Item-->
                                                <div class="timeline-item mb-15 mt-5">
                                                    <!--begin::Label-->
                                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">{{ \Carbon\Carbon::parse($log->check_in_time)->format('j-M-Y') }}</div>
                                                    <!--end::Label-->
                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge">
                                                        <i class="fa fa-genderless text-success fs-1"></i>
                                                    </div>
                                                    <!--end::Badge-->
                                                    <!--begin::Content-->
                                                    <div class="timeline-content d-flex">
                                                        <span class="fw-bolder text-gray-800 ps-3">{{ \Carbon\Carbon::parse($log->check_in_time)->format('H:i:s')}}</span>
                                                        <div class="fw-mormal timeline-content text-muted ps-3"></div>
                                                        <span
                                                            class="badge badge-lg badge-light-success fw-bolder " data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-custom-class="tooltip-dark" title="Model : AGZ5161<br>Registration N0 : JAKSHSA67<br>Owner : Ali Ahmed <br>Engine :1817CC Turbo">Vehicle :{{$log->vehicle->registration_number}}</span>

                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Item-->
												{{-- ---FOR CHECK OUT  --}}
                                                <!--begin::Item-->
                                                <div class="timeline-item mb-15">
                                                    <!--begin::Label-->
                                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">{{ \Carbon\Carbon::parse($log->check_out_time)->format('j-M-Y')}}</div>
                                                    <!--end::Label-->
                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge">
                                                        <i class="fa fa-genderless text-danger fs-1"></i>
                                                    </div>
                                                    <!--end::Badge-->
                                                    <!--begin::Desc-->
                                                    <div class="timeline-content fw-bolder text-gray-800 ps-3">{{ \Carbon\Carbon::parse($log->check_out_time)->format('H:i:s') }}
														
                                                    </div>
                                                    <span class="badge badge-lg badge-light-danger fw-bolder ">Vehicle :{{$log->vehicle->registration_number}}</span>

                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Item-->
												@endif
                                            @endforeach
											</div>
											@endif



                                        </div>
                                    </div>
                                    <!--end::Item-->

                                </div>
                                <!--end::Tap pane-->

                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end: Card Body-->
                    </div>

                </div>
                <!--end::Col-->


            </div>

        </div>
        <!--end::Container-->
    </div>



    <!--end::Post-->
@endsection

@section('extra_scripts')
<script src="{{ asset('static/js/custom/apps/ecommerce/sales/listing.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('viewMoreButton').addEventListener('click', function() {
        document.getElementById('hiddenLogs').style.display = 'block';
        this.style.display = 'none';
    });
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
		return new bootstrap.Tooltip(tooltipTriggerEl)
	})
</script>

@endsection
