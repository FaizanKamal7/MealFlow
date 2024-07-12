@extends('businessservice::layouts.master')

@section('main_content')

<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Row-->
        <h1 class="fs-lg-2x  pb-7 px-2">Business Management</h1>
        <div class="alert alert-primary">
            <div class="row gy-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-1 mb-xl-10">
                    <!--begin::Icon-->
                    <span class="svg-icon svg-icon-2hx svg-icon-primary me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                        </svg>
                    </span>
                    <!--end::Icon-->

                </div>
                <div class="col-xl-10 d-flex flex-column">
                    <!--begin::Title-->
                    <h4 class="mb-1 text-dark">You account is under process. </h4>
                    <!--end::Title-->
                    <!--begin::Content-->
                    <span>You will get notified once NIXUS team send you contract file. It usually takes 2 working days.
                        In the mean time you can add branches if your operating somewhere else as well </span>
                    <!--end::Content-->
                </div>

            </div>
        </div>





    </div>
    <!--end::Container-->
</div>
<!--end::Alert-->
@endsection