@extends('layouts.admin.master')

@section('content')

    <!-- Toaster Messages -->
    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif


    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3">Account Settings</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="/" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">My Profile</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->

    <div class="post d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-header border-0 cursor-pointer">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Admin Profile Information</h3>
                            </div>
                        </div>
                        <div class="collapse show">
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Name</label>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-12 fv-row fv-plugins-icon-container">
                                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">{{ $user->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Username</label>
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <span class="form-control form-control-lg form-control-solid">{{ $user->username }}</span>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Phone</label>
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <span class="form-control form-control-lg form-control-solid">{{ $user->phone }}</span>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Email</label>
                                    <div class="col-lg-8 fv-row">
                                        <span class="form-control form-control-lg form-control-solid">{{ $user->email }}</span>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Registered</label>
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <span class="form-control form-control-lg form-control-solid">{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}</span>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Last Password Changed</label>
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <span class="form-control form-control-lg form-control-solid">{{ \Carbon\Carbon::parse($user->updated_at)->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header border-0 cursor-pointer">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Update Password</h3>
                            </div>
                        </div>
                        <div  class="collapse show">
                            <div class="card-body border-top p-9">
                                <div class="d-flex flex-wrap align-items-center mb-10">
                                    <div class="flex-row-fluid">
                                        <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('admin.change.password') }}" method="POST">
                                            @csrf

                                            <div class="row mb-1">
                                                <div class="col-12">
                                                    <div class="fv-row mb-0 fv-plugins-icon-container">
                                                        <label for="oldPassword" class="form-label fs-6 fw-bold mb-3">Password</label>
                                                        <input type="password" class="form-control password_show_hide form-control-lg form-control-solid @error('oldPassword') is-invalid @enderror" name="oldPassword" placeholder="Current Password">
                                                        <span class="fa fa-eye show_icon icon_one"></span>
                                                        @error('oldPassword')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <div class="fv-row mb-0 fv-plugins-icon-container">
                                                            <label for="password" class="form-label fs-6 fw-bold mb-3">New Password</label>
                                                            <input type="password" class="password_show_hide form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" name="password" placeholder="New Password">
                                                            <span class="fa fa-eye show_icon icon_tow"></span>
                                                            @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <div class="fv-row mb-0 fv-plugins-icon-container">
                                                            <label for="confirmPassword" class="form-label fs-6 fw-bold mb-3">Confirm New Password</label>
                                                            <input type="password" class="password_show_hide form-control form-control-lg form-control-solid @error('confirmPassword') is-invalid @enderror" name="confirmPassword" placeholder="Confirm New Password">
                                                            <span class="fa fa-eye show_icon icon_three"></span>
                                                            @error('confirmPassword')
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <p style="color: #f64e60; font-size: 16px; line-height: 26px; margin-top: 10px;">*Password contains at least one upper (A-Z) and lower case (a-z) alphabet and number(0-9) with a minimum length of 8 (eight) characters</p>
                                                <div class="d-flex">
                                                    <button type="submit" class="btn btn-primary me-2 px-6">Update Password</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const triggerPasswordOne = document.querySelector('.icon_one');
        const triggerPasswordTow = document.querySelector('.icon_tow');
        const triggerPasswordThree = document.querySelector('.icon_three');
        const showPassword = trigger => {
            trigger.addEventListener('click', () => {
                if(trigger.previousElementSibling.getAttribute('type') === 'password'){
                    trigger.previousElementSibling.setAttribute('type', 'text');
                    trigger.classList.remove('fa-eye');
                    trigger.classList.add('fa-eye-slash');
                }else if(trigger.previousElementSibling.getAttribute('type') === 'text'){
                    trigger.previousElementSibling.setAttribute('type', 'password');
                    trigger.classList.remove('fa-eye-slash');
                    trigger.classList.add('fa-eye');
                }
            });
        }

        showPassword(triggerPasswordOne);
        showPassword(triggerPasswordTow);
        showPassword(triggerPasswordThree);
    </script>

@endsection
