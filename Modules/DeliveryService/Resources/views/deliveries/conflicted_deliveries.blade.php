@extends('businessservice::layouts.master')
@section('title', 'Conflicted Deliveries')

@section('extra_style')
@endsection
@section('main_content')
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                <!--begin::form card-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Title-->
                            <h2>Conflicted Deliveries</h2>
                            <!--end::Title-->
                            <p>All the valid deliveries are uploaded successfuly. please review the conflicted
                                deliveries and update accorrdingly </p>
                        </div>

                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">

                        <br>


                        {{--
                        @foreach ($conflicted_deliveries as $conflicted_delivery)
                        <div class="bg-light-danger text-danger">{{$conflicted_delivery['conflict']}} for customer
                            {{$conflicted_delivery['db_customer']->user->name}}</div>

                        <!--begin::Input group-->
                        <div class="form-floating">
                            <input class="form-control is-invalid" id="wrong_address"
                                value={{$conflicted_delivery['passed_address']}} />
                            <label for="wrong_address">Wrong address</label>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="form-floating mb-7">
                            <input class="form-control is-valid" id="right_address"
                                value={{$conflicted_delivery['customer_db_address']->address}} />
                            <label for="right_address"> Existing Address </label>
                        </div>
                        <!--end::Input group-->

                        @livewire('deliveryservice::edit-delivery-feild', [
                        'model' => '\\Modules\\BusinessService\\Entities\\CustomerAddress.php',
                        'entity' => $conflicted_delivery['customer_db_address'],
                        'field' => $conflicted_delivery['passed_address'],
                        'key' => $conflicted_delivery['customer_db_address']->id
                        ])

                        @endforeach --}}
                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th>Delivery Record</th>
                                    <th class="min-w-125px">Conflict</th>
                                    <th>Conflicted Record</th>
                                    <th>Existing Record</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody class="fw-bold text-gray-600">
                                @foreach($conflicted_deliveries as $key => $conflicted_delivery)
                                <form method="post" class="form" action="{{ route('upload_deliveries_by_form')}}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <tr>
                                        <td>
                                            Name: <b> {{ $conflicted_delivery['db_customer']->user->name }} </b><br>
                                            Phone: <b>{{ $conflicted_delivery['db_customer']->user->phone }}</b> <br>
                                        </td>
                                        <td>
                                            {{ $conflicted_delivery['conflict'] }}
                                        </td>
                                        <td>
                                            <a href="" class="update" data-name="name" data-type="text"
                                                data-pk="{{ $conflicted_delivery['customer_db_address']->id }}"
                                                data-title="Enter name">{{$conflicted_delivery['passed_address'] }}</a>
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input" name="address_{{$key}}" type="radio"
                                                    value="" id="flexRadioChecked" checked="checked" />
                                            </div>
                                        </td>
                                        <td>
                                            <p data-name="email" data-type="text"
                                                data-pk="{{ $conflicted_delivery['customer_db_address']->id }}"
                                                data-title="Enter email">{{
                                                $conflicted_delivery['customer_db_address']->address
                                                }}</p>
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input" name="address_{{$key}}" type="radio"
                                                    value="" id="flexRadioDefault" />
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger">
                                                <i class="bi bi-trash3-fill fs-4 me-2">Delete</i>
                                            </a>

                                        </td>
                                    </tr>
                                </form>
                                @endforeach
                            </tbody>
                        </table>
                        <p>{{$conflicted_delivery['customer_db_address']->address}}</p>
                        <!--begin::Actions-->

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::form card-->
            </div>
        </div>

    </div>
    <!--end::Container-->
</div>
<!--end::Post-->


@endsection

@section('extra_scripts')
{{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.1.2/dist/alpine.js" defer></script> --}}
{{--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
--}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

{{--
<link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css"
    rel="stylesheet" /> --}}

<script>
    $.fn.poshytip={defaults:null}
</script>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js">
</script>


<script type="text/javascript">
    $.fn.editable.defaults.mode = 'inline';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    }); 

    $('.update').editable({
           url: "{{ route('users.update') }}",
           type: 'text',
           pk: 1,
           name: 'name',
           title: 'Enter name'
    });




</script>
@endsection