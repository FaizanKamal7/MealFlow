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


          <!--begin::Card title-->
          <div class="card-title">


          </div>
          <!--end::Card title-->
          <!--begin::Card toolbar-->




          <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body  border-0 pt-0">




          <!--begin::Table-->
          <table class="table align-middle table-row-dashed fs-6 gy-5" id="cities_table">
            <!--begin::Table head-->
            <thead>
              <!--begin::Table row-->
              <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                <th class="w-10px pe-2">
                  <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                      data-kt-check-target="#cities_table .form-check-input" value="1" />
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
              <form action="{{ route('extract_api_areas_of_city') }}" method="GET">
                @csrf
                <input type="hidden" name="city_name" value={{$city->name}}>
                <input type="hidden" name="city_id" value={{$city->id}}>
                <!--begin::Table row-->
                <tr>
                  <!--begin::Checkbox-->
                  <td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                      <input class="form-check-input" type="checkbox" value="1" />
                    </div>
                  </td>
                  <!--end::Checkbox-->
                  <!--begin::Category=-->
                  <!--begin::Name=-->
                  <td class="d-flex align-items-center">
                    <!--begin:: Avatar -->
                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                      <a href="#">
                        <div class="symbol-label">
                          {{$city->state->country->emoji}}
                          {{-- <img src={{$country->emoji}} class="w-100"
                          /> --}}
                        </div>
                      </a>
                    </div>
                    <!--end::Avatar-->
                    <!--begin::User details-->
                    <div class="d-flex flex-column">
                      <a href="#"
                        class="text-gray-800 text-hover-primary mb-1"><b>{{$city->name}}</b>&nbsp({{$city->state->name}},&nbsp{{$city->state->country->name}})
                      </a>
                    </div>
                    <!--begin::User details-->
                  </td>
                  <!--end::Name=-->
                  {{-- <td>
                    <div class="d-flex">
                      <!--begin::Thumbnail-->
                      <a href="../../demo1/dist/apps/ecommerce/catalog/edit-category.html" class="symbol symbol-50px">
                        <span class="symbol-label"
                          style="background-image:url(assets/media//stock/ecommerce/68.gif);"></span>
                      </a>
                      <!--end::Thumbnail-->
                      <div class="ms-5">
                        <!--begin::Title-->
                        <a href="../../demo1/dist/apps/ecommerce/catalog/edit-category.html"
                          class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1"
                          data-kt-ecommerce-category-filter="category_name">Computers</a>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7 fw-bolder">Our computers
                          and
                          tablets include all the big brands.</div>
                        <!--end::Description-->
                      </div>
                    </div>
                  </td> --}}
                  <!--end::Category=-->

                  <!--begin::Action=-->
                  <td class="text-end">
                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click"
                      data-kt-menu-placement="bottom-end">Actions
                      <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                      <span class="svg-icon svg-icon-5 m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                          <path
                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                            fill="currentColor" />
                        </svg>
                      </span>
                      <!--end::Svg Icon-->
                    </a>
                    <!--begin::Menu-->
                    <div
                      class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                      data-kt-menu="true">
                      <!--begin::Menu item-->
                      <div class="menu-item px-3">
                        <a href="../../demo1/dist/apps/ecommerce/catalog/add-category.html"
                          class="menu-link px-3">Edit</a>
                      </div>
                      <!--end::Menu item-->
                      <!--begin::Menu item-->
                      <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-kt-ecommerce-category-filter="delete_row">Delete</a>
                      </div>
                      <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                  </td>
                  <!--end::Action=-->
                </tr>
                @endforeach
                <!--end::Table row-->
            </tbody>
            <!--end::Table body-->
          </table>
          <!--end::Table-->
        </div>
        <!--end::Card body-->
      </div>
      <!--end::Category-->

    </div>
    <div class="tab-pane fade" id="kt_vtab_pane_5">

    </div>
    <div class="tab-pane fade" id="kt_vtab_pane_6">

    </div>
  </div>
</div>