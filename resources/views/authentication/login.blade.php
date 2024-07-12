@extends('layouts.others_master')
@section('title', 'Login')
<x-auth-session-status class="mb-4" :status="session('status')" />

@section('main_content')

    @if ($errors->any())
        <p class="alert {{ Session::get('alert-class') }}">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </p>
    @endif

    <!--begin::Root-->
    <div class="bg-login">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex margin-div">
            <!--begin::Aside-->
            <div class="d-flex justify-content-center align-items-center positon-xl-relative rounded-lg side-div">
                <div class="big-img">
                    <img alt="bigImage" class="img-big" src="{{ asset('static/media/login-side.png') }}" />
                </div>
                <!--begin::Wrapper-->
                <!--end::Wrapper-->
            </div>
            <!--end::Aside-->
            <!--begin::Body-->
            <div class="login-div">
                <!--begin::Content-->
                <div class="big-img" style="width: max-content;  margin: 0 auto;">
                    <img alt="bigImage" style="height: 170px;" class=""
                        src="{{ asset('static/media/lightLogo.png') }}" />
                </div>
                <!--begin::Wrapper-->
                <div class="mx-10">
                    <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST"
                        action="{{ route('login') }}">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-5">
                            <!--begin::Title-->
                            <h1 class="text-dark login-text">Login</h1>
                            <!--end::Title-->
                        </div>
                        <!--begin::Heading-->
                        @if (Session::has('error'))
                            <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('error') }}</p>
                        @endif
                        <!--begin::Input group-->
                        <div class="fv-row mb-2">
                            <!--begin::Label-->
                            <label for="login" class="login-text form-label required fs-6 fw-bolder text-dark">Email/Phone</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" type="text" id="login"
                                name="email_or_phone" autocomplete="off" placeholder="Email/Phone" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-2">
                            <!--begin::Wrapper-->
                            <div class="mb-2">
                                <!--begin::Label-->
                                <label class="login-text form-label required fw-bolder text-dark fs-6 mb-0">Password</label>
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
                                    <span
                                        class="login-text ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                    <a class="login-text underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
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
                            <button type="submit" id="kt_sign_in_submit"
                                class="submit_btn btn btn-primary btn-lg  w-100 mb-5">
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
