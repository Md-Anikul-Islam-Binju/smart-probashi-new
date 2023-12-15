@extends('layouts.admin.master')
@section('content')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
                <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3">Probashi Bondhu</h1>
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/" class="text-muted text-hover-primary">DASHBOARD</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Recruiting Agency</li>
                </ul>
            </div>
        </div>
    </div>



    <div class="post d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Recruiting Agency Information</h3>
                    </div>
                </div>
                <div class="collapse show">
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <div class="col-12 col-md-6">
                                <label class="col-form-label fw-semibold fs-6">Recruiting Agency Portal</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    @if($recruitingAgency->recruitingAgencyInfo->recruiting_agency_portal_access == 1)
                                        Bangladeshi Recruiting Agency
                                    @elseif($recruitingAgency->recruitingAgencyInfo->recruiting_agency_portal_access == 2)
                                        Foreign Recruiting Agency
                                    @endif
                                </span>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="col-form-label fw-semibold fs-6">Organization Name & License No</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">{{ $recruitingAgency->recruitingAgencyInfo->organization->name_en }} - {{ $recruitingAgency->recruitingAgencyInfo->organization->recruiting_license_no }}</span>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="col-form-label fw-semibold fs-6">Contact Name</label>
                                <span class="form-control form-control-lg form-control-solid">{{ $recruitingAgency->name }}</span>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="col-form-label fw-semibold fs-6">Designation</label>
                                <span class="form-control form-control-lg form-control-solid">{{ $recruitingAgency->recruitingAgencyInfo->designation }}</span>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="col-form-label fw-semibold fs-6">Email</label>
                                <span class="form-control form-control-lg form-control-solid">{{ $recruitingAgency->email }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4 mb-3">
                                <div class="documents_wrapper px-5 py-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="mb-5">Trade License</h4>
                                        <a href="{{asset('storage/'.$recruitingAgency->recruitingAgencyInfo->trade_license)}}" target="_blank">View</a>
                                    </div>
                                    <img src="{{ asset('assets/media/svg/files/pdf.svg') }}" class="img-fluid" style="height: 100px;" alt="">
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-3">
                                <div class="documents_wrapper px-5 py-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="mb-5">Recruiting License</h4>
                                        <a href="{{asset('storage/'.$recruitingAgency->recruitingAgencyInfo->recruiting_license)}}" target="_blank">View</a>
                                    </div>
                                    <img src="{{ asset('assets/media/svg/files/pdf.svg') }}" class="img-fluid" style="height: 100px;" alt="">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="documents_wrapper px-5 py-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="mb-5">Business Card</h4>
                                        <a href="{{asset('storage/'.$recruitingAgency->recruitingAgencyInfo->business_card)}}" target="_blank">View</a>
                                    </div>
                                    <img src="{{ asset('assets/media/svg/files/pdf.svg') }}" class="img-fluid" style="height: 100px;" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
