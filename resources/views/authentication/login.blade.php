@extends('layouts.others_master')
@section('title', 'Login')

@section('main_content')


    <!--begin::Root-->
    {{-- <div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative m-3 rounded-lg"
            style="background-color: #D3D7E7">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                <!--begin::Content-->
                <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                    <!--begin::Logo-->
                    <a href="#" class="py-9 mb-5">
                        <img alt="Logo" src="{{ asset('static/media\logos\logo_dark_horizontal.png')}}"
                            class="h-90px" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #000000;">Welcome to NIXUS</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <p class="fw-bold fs-2" style="color: #000000;">One stop solution
                        <br />for all your logistics needs
                    </p>
                    <!--end::Description-->
                </div>
                <!--end::Content-->
                <!--begin::Illustration-->
                <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                    style="background-image: url({{ asset('static/media/illustrations/sketchy-1/13.png') }})"></div>
                <!--end::Illustration-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid py-10">

            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="post"
                        action="{{ route('login_user') }}">
                        @csrf
                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Sign In</h1>
                            <!--end::Title-->
                        </div>

                        <!--begin::Heading-->
                        @if (Session::has('error'))
                        <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('error') }}</p>
                        @endif
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" type="text" name="email"
                                autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack mb-2">
                                <!--begin::Label-->
                                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                <!--end::Label-->
                                <!--begin::Link-->
                                <a href="../../demo1/dist/authentication/layouts/basic/password-reset.html"
                                    class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
                                <!--end::Link-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                name="password" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label">Continue</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Submit button-->
                        </div>
                        <!--end::Actions-->
                    </form>

                    <div class="text-center">
                        <br>OR <br><br>
                        <a href="{{route('business_onboarding')}}"> <button class="btn btn-lg btn-secondary w-100 mb-5">
                                <span class="indicator-label">Register your business now!</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </a>
                    </div>
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                <!--begin::Links-->
                <div class="d-flex flex-center fw-bold fs-6">
                    <a href="#" class="text-muted text-hover-primary px-2" target="_blank">About</a>
                    <a href="#" class="text-muted text-hover-primary px-2" target="_blank">Support</a>
                    <a href="#" class="text-muted text-hover-primary px-2" target="_blank">Purchase</a>
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div> --}}
    <!--end::Root-->

    <div class="bg">
        <div class="main">
            <div class="side-img">
                <div class="logo">
                    <!--begin::Logo-->
                    <a href="#">
                        <img alt="Logo" src="{{ asset('static/media\logos\logo_white_verticle.png') }}" />
                    </a>
                    <!--end::Logo-->
                </div>
                <div class="welcome">
                    <h1 class="fw-bolder fs-2qx pb-5 pb-md-10">Welcome to NIXUS</h1>
                    <!--begin::Description-->
                    <p class="fw-bold fs-2">One stop solution
                        <br />for all your logistics needs
                    </p>
                </div>
                {{-- style="background-image: url({{ asset('static/media/Isolation_Mode.png') }})" --}}
                <div class="big-img">
                    <img alt="bigImage" class="img-big" src="{{ asset('static/media/Isolation_Mode.png') }}" />

                </div>
            </div>
            <div class="login">
                <div class="login-form">
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="post"
                        action="{{ route('login_user') }}">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Login</h1>
                            <!--end::Title-->
                        </div>

                        <!--begin::Heading-->
                        @if (Session::has('error'))
                            <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('error') }}</p>
                        @endif
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <label for="email"
                                class="user-label required form-label fs-6 fw-bolder text-dark">Email</label>
                            <input type="email" name="email" autocomplete="off"
                                class="user-input form-control form-control-solid" placeholder="Email" />
                        </div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Wrapper-->
                            <div class="mb-10">
                                <label for="password"
                                    class="user-label required form-label fw-bolder text-dark fs-6">Password</label>
                                <input type="password" name="password" autocomplete="off"
                                    class="user-input form-control form-control-solid" placeholder="Password" />
                            </div>
                            <a href="../../demo1/dist/authentication/layouts/basic/password-reset.html"
                                class="forgot fs-6 fw-bolder">Forgot Password ?</a>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" id="kt_sign_in_submit" class="submit_btn btn btn-lg w-100 mb-5">
                                <span class="indicator-label">Continue</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Submit button-->
                        </div>
                        <!--end::Actions-->
                    </form>

                </div>
                <div class="dont">
                    <p class="p-dont">
                        Don’t have an account? <a href="{{ route('business_onboarding') }}">
                            <span class="link-primary"> Register</span> </p>
                    </a>


                </div>

            </div>
        </div>

    </div>



@endsection

@section('extra_scripts')
    <script src="{{ asset('static/js/custom/authentication/sign-in/general.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#kt_docs_repeater_basic').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
        });
    </script>
@endsection
