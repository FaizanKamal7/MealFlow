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

                        </div>

                    </div>
                    <!--begin::Alert-->
                    <div class="alert alert-primary d-flex align-items-center p-5">
                        <!--begin::Icon-->
                        <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span
                                class="path2"></span></i>
                        <!--end::Icon-->

                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column">
                            <!--begin::Title-->
                            <h4 class="mb-1 text-dark">Valid Delivery Records Added</h4>
                            <!--end::Title-->

                            <!--begin::Content-->
                            <span>But there are some conflicted deliveries. Please review the conflicted
                                deliveries and update accorrdingly</span>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Alert-->
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
                        <form method="post" class="form" action="{{ route('upload_conflicted_deliveries')}}"
                            enctype="multipart/form-data">
                            @csrf
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
                                    <input type="hidden" name="delivery_data_{{$key}}"
                                        value= {{json_encode($conflicted_delivery['passed_delivery_data'])}}>
                                    <tr>
                                        <td>
                                            Name: <b> {{ $conflicted_delivery['db_customer']->user->name }} </b><br>
                                            Phone: <b>{{ $conflicted_delivery['db_customer']->user->phone }}</b>
                                            <br>
                                        </td>
                                        <td>
                                            {{ $conflicted_delivery['conflict'] }}
                                        </td>
                                        <td>
                                            <a href="" class="update" data-name="passed_address" data-type="text"
                                                data-pk="{{ $conflicted_delivery['customer_db_address']->id }}"
                                                data-title="Enter name">{{$conflicted_delivery['passed_address'] }}</a>
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input" name="address_{{$key}}" type="radio"
                                                    value={{$conflicted_delivery['passed_address'] }}
                                                    id="flexRadioChecked" checked="checked" />
                                            </div>
                                        </td>
                                        <td>
                                            <p>{{ $conflicted_delivery['customer_db_address']->address }}</p>
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input" name="address_{{$key}}" type="radio"
                                                    value={{ $conflicted_delivery['customer_db_address']}}
                                                    id="flexRadioDefault" />
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger  delete-row">
                                                <i class="bi bi-trash3-fill fs-4 me-2">Delete</i>
                                            </a>
                                            {{-- <button type="button" class="btn btn-danger delete-row">
                                                <i class="bi bi-trash3-fill fs-4 me-2">Delete</i>
                                            </button> --}}


                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--begin::Actions-->
                            <a href="#">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-file-earmark-arrow-up fs-4 me-2"></i>
                                    Upload Deliveries
                                </button>
                            </a>
                        </form>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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


    
    $(document).ready(function () {
        $(".delete-row").on("click", function (e) {
            e.preventDefault();

            // Get the row element
            var row = $(this).closest("tr");

            Swal.fire({
                html: "Are you sure you want to delete this row?",
                icon: "warning",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-secondary",
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    // Get the index of the row
                    var index = row.index();

                    // Remove the row from the HTML table
                    row.remove();

                    // Remove the item from the $conflicted_deliveries array
                    if (index !== -1) {
                        $conflicted_deliveries.splice(index, 1);
                    }

             
                }
            });
        });
    });





</script>
@endsection