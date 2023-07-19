@extends('layouts.admin_master')
@section('title', 'Settings')

@section('main_content')




<!--begin::Content-->
<div class="post d-flex flex-column-fluid" id="kt_post">
  <!--begin::Container-->
  <div id="kt_content_container" class="container-fluid">
    <div class="d-flex flex-column flex-lg-row">


      <!--begin::Content-->
      <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
        <!--begin::Card-->
        <div class="card card-flush">
          <!--begin::Card header-->
          <div class="card-header mt-6">

            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
              <!--begin::Table-->
              <!--begin::Table-->
              <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="re_employees_table">
                <!--begin::Table head-->
                <thead>
                  <!--begin::Table row-->
                  <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
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


                    <tr>

                      <!--begin::Name=-->
                      <td class="d-flex align-items-center">
                        <!--begin:: Avatar -->
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                          <a href="#">
                            <div class="symbol-label">
                              {{$city->state->country->emoji}}
                              {{-- <img src={{$country->emoji}} class="w-100" /> --}}
                            </div>
                          </a>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::User details-->
                        <div class="d-flex flex-column">
                          <a href="#" class="text-gray-800 text-hover-primary mb-1"><b>{{$city->name}}</b>&nbsp({{$city->state->name}},&nbsp{{$city->state->country->name}})
                          </a>
                        </div>
                        <!--begin::User details-->
                      </td>
                      <!--end::Name=-->

                      <!--begin::Action=-->
                      <td class="text-end">
                        <button type="submit" style="border:none;background: none; ">
                          <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                          <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="currentColor" />
                              <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="currentColor" />
                              <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="currentColor" />
                            </svg>
                          </span>
                          <!--end::Svg Icon-->
                        </button>

                        <!--begin::Update-->
                        {{-- <a type="button" onclick="activate_location('{{$city->name}}','{{$city->id}}')"
                        data-bs-toggle="modal" data-bs-target="#activate_location_modal"> --}}
                        <a type="button" onclick="activate_location('{{$city->name}}','{{$city->id}}')">
                          <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                          <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="currentColor" />
                              <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="currentColor" />
                              <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="currentColor" />
                            </svg>
                          </span>
                          <!--end::Svg Icon-->
                        </a>
                        <!--end::Update-->


                      </td>
                      <!--end::Action=-->

                    </tr>
                  </form>
                  @endforeach
                </tbody>
                <!--end::Table body-->
              </table>
              <!--end::Table-->
              <!--end::Table-->
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
  <!--end::Content-->
</div>
<!--begin:: Edit Modal-->
<div class="modal fade" tabindex="-1" id="activate_location_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Area Selection</h3>

        <!--begin::Close-->
        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
          <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
        </div>
        <!--end::Close-->
      </div>

      <div class="modal-body">
        <p><strong>ID:</strong> <span id="cityId"></span></p>

        <p>Select the areas of cities</p>
        <input class="form-check-input" type="checkbox" onClick="toggle(this)" /> Toggle All<br />
        <hr>
        <input class="form-check-input" type="checkbox" name="foo" value="bar1"> Bar
        <input class="form-check-input" type="checkbox" name="foo" value="bar2"> Bar 2
        <input class="form-check-input" type="checkbox" name="foo" value="bar3"> Bar 3
        <input class="form-check-input" type="checkbox" name="foo" value="bar4"> Bar 4


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>


      </div>
    </div>
  </div>
</div>
<!--end::Edit Modal-->
@endsection

@section('extra_scripts')
<script src="{{ asset('static/js/custom/authentication/sign-in/general.js')}}"></script>
<script src="{{ asset('static/js/custom/settings/locations/activate_location.js') }}"></script>

@endsection