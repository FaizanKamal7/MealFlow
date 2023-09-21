@extends('businessservice::layouts.master')
@section('title', 'Conflicted Deliveries')

@section('extra_style')
{{--
<link href="{{ asset('static/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css/">--}}
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
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">

                        <br>
                        <form id="re_add_bulk_form" name="re_add_bulk_form" method="post" class="form"
                            action="{{ route('upload_deliveries_by_form')}}" enctype="multipart/form-data">
                            @csrf

                            <!--begin::Table-->
                            <table class="table border gy-5 gs-7 table-responsive" id="re_bulk_table">
                                <!--begin::Table head-->
                                <thead class="bg-light-dark">
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-600 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px">Customer</th>
                                        <th class="min-w-125px">Delivery Address</th>
                                        <th class="min-w-125px">Delivery Slot</th>
                                        <th class="min-w-125px">Item Type</th>
                                        <th class="min-w-125px">Instructions</th>
                                        <th class="min-w-125px">Notes</th>
                                        <th class="min-w-125px">COD Amount</th>
                                        <th class="text-center min-w-100px">Actions</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">

                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                            @foreach ($conflicted_deliveries as $conflicted_delivery)
                            <p>{{$conflicted_delivery['conflict']}}</p>
                            @endforeach
                            <!--begin::Actions-->
                            <button id="re_add_bulk_submit" type="submit" class="btn btn-primary float-end">
                                <span class="indicator-label">
                                    Save Changes
                                </span>
                                <span class="indicator-progress">
                                    Please wait... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
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
<script>

</script>
@endsection