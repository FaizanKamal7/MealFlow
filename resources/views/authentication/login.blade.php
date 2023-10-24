@extends('layouts.others_master')
@section('title', 'Login')
<x-auth-session-status class="mb-4" :status="session('status')" />

@section('main_content')


<!--begin::Root-->
<div class="d-flex flex-column flex-root bg-login">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid margin-div">
        <!--begin::Aside-->
        <div class="d-flex flex-column flex-lg-row-auto w-xl-500px positon-xl-relative rounded-lg side-div">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column position-xl-fixed w-xl-500px ">
                <!--begin::Content-->
                <div class="d-flex flex-row-fluid flex-column p-10">
                    <!--begin::Logo-->
                    <a href="#" class="pb-9">
                        <img alt="Logo" src="{{ asset('static/media\logos\logo_white_verticle.png') }}"
                            class="h-90px" />
                    </a>
                    <!--end::Logo-->
                    <div class="welcome mt-xxl-16">

                        <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #00426e">Welcome to NIXUS</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <p class="fw-bold fs-2" style="color: #00426e;">One stop solution
                            <br />for all your logistics needs
                        </p>
                    </div>
                    <!--begin::Title-->
                    <!--end::Description-->
                </div>
                <!--end::Content-->
                <!--begin::Illustration-->
                {{-- <div
                    class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-290px"
                    style="background-image: url({{ asset('static/media/Isolation_Mode.png') }})">
                </div> --}}
                <div class="big-img">
                    <img alt="bigImage" class="h-xxl-300px img-big"
                        src="{{ asset('static/media/Isolation_Mode.png') }}" />

                </div>
                <!--end::Illustration-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid login-div">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST"
                        action="{{ route('login') }}">
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
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label required fs-6 fw-bolder text-dark">Email</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" type="text" id="email"
                                name="email" autocomplete="off" placeholder="Email" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Wrapper-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label required fw-bolder text-dark fs-6 mb-0">Password</label>
                                <!--end::Label-->
                                <!--begin::Link-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid" type="password"
                                    name="password" id="password" autocomplete="off" placeholder="Password" />
                                <!--end::Input-->
                            </div>
                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox"
                                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                        name="remember">
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me')
                                        }}</span>
                                </label>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                                @endif


                            </div>
                            <!--end::Link-->
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" id="kt_sign_in_submit" class="submit_btn btn btn-lg  w-100 mb-5">
                                {{ __('Log in') }}
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Submit button-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <div class="dont">
                        <p class="p-dont">
                            Don’t have an account? <a href="{{ route('business_onboarding') }}">
                                <span class="link-primary"> Register</span> </p>
                        </a>


                    </div>
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            {{-- <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                <!--begin::Links-->
                <div class="d-flex flex-center fw-bold fs-6">
                    <a href="#" class="text-muted text-hover-primary px-2" target="_blank">About</a>
                    <a href="#" class="text-muted text-hover-primary px-2" target="_blank">Support</a>
                    <a href="#" class="text-muted text-hover-primary px-2" target="_blank">Purchase</a>
                </div>
                <!--end::Links-->
            </div> --}}
            <!--end::Footer-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->

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