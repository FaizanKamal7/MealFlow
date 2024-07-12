@extends('layouts.admin_master')
@section('title', 'Settings')

@section("extra_style")
<style>
    /* Style for the vertical separator */
    .vertical-separator {
        border-left: 1px solid;
        padding-left: 3%;
    }
</style>

@endsection

@section('main_content')


<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">

        <h1 class="fs-lg-2x  pb-7 px-2">Settings </h1>
        <div class="col-lg-12 ">
            <!--begin::Engage widget 8-->

            <!--begin::Body-->

            <!--begin::Row-->
            <div class="card card-flush">

                <div class="row">
                    <div class="col-lg-3  d-flex flex-row py-10 justify-content-center d-flex   ">

                        <!-- Tabs -->
                        <ul class="nav nav-tabs nav-pills flex-row border-0 flex-md-column me-5 mb-3 mb-md-0 fs-6 ">
                            <!-- Tab 1 -->
                            <li class="nav-item me-0 mb-md-3  ">
                                <a class="nav-link active btn btn-flex btn-active-light-success" data-bs-toggle="tab"
                                    href="#kt_vtab_pane_4" style="border-radius: 5rem;">
                                    <!-- Tab 1 content -->
                                    <span class="svg-icon svg-icon-2">
                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen018.svg-->
                                        <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                    fill="currentColor" />
                                            </svg></span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="d-flex flex-column align-items-start">
                                        <span class="fs-4 fw-bolder">Locations</span>
                                        <span class="fs-7">Description</span>
                                    </span>
                                </a>
                            </li>
                            <!-- Tab 2 -->
                            <li class="nav-item me-0 mb-md-3">
                                <a class="nav-link btn btn-flex btn-active-light-info" data-bs-toggle="tab"
                                    href="#kt_vtab_pane_5" style="border-radius: 5rem;">
                                    <!-- Tab 2 content -->
                                    <span class="svg-icon svg-icon-2">
                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen003.svg-->
                                        <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M13.0079 2.6L15.7079 7.2L21.0079 8.4C21.9079 8.6 22.3079 9.7 21.7079 10.4L18.1079 14.4L18.6079 19.8C18.7079 20.7 17.7079 21.4 16.9079 21L12.0079 18.8L7.10785 21C6.20785 21.4 5.30786 20.7 5.40786 19.8L5.90786 14.4L2.30785 10.4C1.70785 9.7 2.00786 8.6 3.00786 8.4L8.30785 7.2L11.0079 2.6C11.3079 1.8 12.5079 1.8 13.0079 2.6Z"
                                                    fill="currentColor" />
                                            </svg></span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="d-flex flex-column align-items-center">
                                        <span class="fs-4 fw-bolder">Locations</span>
                                        <span class="fs-7">Description</span>
                                    </span>
                                </a>
                            </li>
                            <!-- Tab 3 -->
                            <li class="nav-item  me-0 mb-md-3">
                                <a class="nav-link btn btn-flex btn-active-light-danger" data-bs-toggle="tab"
                                    href="#kt_vtab_pane_6" style="border-radius: 5rem;">
                                    <!-- Tab 3 content -->
                                    <span class="svg-icon svg-icon-2">
                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen017.svg-->
                                        <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M5 8.04999L11.8 11.95V19.85L5 15.85V8.04999Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M20.1 6.65L12.3 2.15C12 1.95 11.6 1.95 11.3 2.15L3.5 6.65C3.2 6.85 3 7.15 3 7.45V16.45C3 16.75 3.2 17.15 3.5 17.25L11.3 21.75C11.5 21.85 11.6 21.85 11.8 21.85C12 21.85 12.1 21.85 12.3 21.75L20.1 17.25C20.4 17.05 20.6 16.75 20.6 16.45V7.45C20.6 7.15 20.4 6.75 20.1 6.65ZM5 15.85V7.95L11.8 4.05L18.6 7.95L11.8 11.95V19.85L5 15.85Z"
                                                    fill="currentColor" />
                                            </svg></span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="d-flex flex-column align-items-start">
                                        <span class="fs-4 fw-bolder">Link 3</span>
                                        <span class="fs-7">Description</span>
                                    </span>
                                </a>
                            </li>
                        </ul>

                    </div>




                    <div class="col-lg-9 vertical-separator  border-secondary  ">
                        <!-- Content -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_vtab_pane_4">

                                <!--begin::Category-->
                                <div class=" ">
                                    <h1 class="fs-5 pt-7 ">Available location </h1>
                                    <!--begin::Card header-->
                                    <div class="card-header  border-0 align-items-center py-5">

                                        <div class="">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="">
                                                        <div class="badge badge-light-primary fw-bolder px-4 py-3">CSV
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <a href="">
                                                        <div class="badge badge-light-primary fw-bolder px-4 py-3">PDA
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <a href="">
                                                        <div class="badge badge-light-primary fw-bolder px-4 py-3">PQMS
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <a href="">
                                                        <div class="badge badge-light-primary fw-bolder px-4 py-3">Color
                                                            Visibility</div>
                                                    </a>
                                                </div>

                                            </div>


                                        </div>
                                        <span id="dataTableLengthInfo"></span>
                                        <span id="pageLengthInfo"></span>


                                        <input type="text" data-kt_ecommerce_category_table-filter="search"
                                            class="form-control form-control-solid w-250px ps-14"
                                            placeholder="Search Category" id="searchInput"   />
                                        <!--begin::Card title-->
                                        <div class="card-title">


                                        </div>
                                        <!--end::Card title-->

                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body  border-0 pt-0">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5"
                                            id="kt_ecommerce_category_table">
                                            <!--begin::Table head-->
                                            <thead>
                                                <!--begin::Table row-->
                                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="w-10px pe-2">
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                data-kt-check="true"
                                                                data-kt-check-target="#kt_ecommerce_category_table .form-check-input"
                                                                value="1" />
                                                        </div>
                                                    </th>
                                                    <th class="min-w-125px">Cities (State, Country)</th>
                                                    <th class="text-end min-w-100px">Actions</th>
                                                </tr>
                                                <!--end::Table row-->
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody class="fw-bold text-gray-600">
                                                @foreach($cities as $city)


                                                <tr>


                                                    <!--begin::Checkbox-->
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox" value="1" />
                                                        </div>
                                                    </td>
                                                    <!--end::Checkbox-->

                                                    <td class="d-flex align-items-center">
                                                        <!--begin:: Avatar -->
                                                        <div
                                                            class="symbol symbol-circle symbol-50px overflow-hidden me-3">

                                                            <div class="symbol-label">
                                                                {{$city->state->country->emoji}}
                                                                {{-- <img src={{$country->emoji}}
                                                                class="w-100"
                                                                /> --}}
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
                                                    <!--end::Name=-->
                                                    <td>
                                                        <!--begin::Action=-->
                                                        <button type="submit" style="border:none;background: none; ">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" fill-rule="evenodd"
                                                                        clip-rule="evenodd"
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
                                                    <!--end::Action=-->
                                                </tr>

                                                <!--begin::Table row-->


                                                @endforeach
                                                <!--end::Table row-->
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                        {{-- {{ $cities->links() }} --}}
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Category-->

                            </div>

                            <div class="tab-pane fade" id="kt_vtab_pane_6">

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!--end::Row-->

            <!--end::Body-->

            <!--end::Engage widget 8-->
        </div>


        <!--end::Row-->
        <!--begin::Row-->

        <!--end::Row-->


        <!--begin::Modals-->


        <!--end::Modals-->
    </div>
    <!--end::Container-->
</div>

<!--end::Post-->
@endsection



@section('extra_scripts')
<script src="{{ asset('static/js/custom/settings/settings_home.js') }}"></script>
<script>
    // $("#kt_ecommerce_category_table").DataTable({
	// 	"language": {
	// 		"lengthMenu": "Show _MENU_",
	// 	},
	// 	"dom": "<'row'" +
	// 		"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
	// 		"<'col-sm-6 d-flex align-items-center justify-content-start'f>" +
	// 		">" +
	// 		"<'row'" +
	// 		"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
	// 		"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
	// 		">" +

	// 		"<'table-responsive'tr>"


	// });


    // $('#searchInput').on('keyup', function() {
    //             var searchTerm = $(this).val();
    //             console.log(searchTerm);
    //             $.ajax({
    //                 url: "/core/settings/locations/search-city",
    //                 method: 'GET',
    //                 data: { search: searchTerm },
    //                 success: function(response) {
    //                     var tableBody = $('#kt_ecommerce_category_table tbody');
    //                     tableBody.empty();

    //                     response.forEach(function(city) {
    //                         var row = '<tr>' +
    //                             '<td></td>' +
    //                             '<td>' + city.name + '</td>' +
    //                             '<td>' + city.name + '</td>' +
    //                             '</tr>';

    //                         tableBody.append(row);
    //                     });
    //                 },
    //                 error: function(xhr, status, error) {
    //                     console.error(error);
    //                 }
    //             });
    //         });

</script>


@endsection