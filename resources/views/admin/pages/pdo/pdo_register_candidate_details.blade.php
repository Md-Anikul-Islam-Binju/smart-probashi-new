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
                    <li class="breadcrumb-item text-muted">PDO Register Details</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="post d-flex flex-column-fluid">
        <div class="container-fluid">
            <!-- Passport Info -->
            <div class="card mb-2">
                <div class="card-header border-0 cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Personal Information</h3>
                    </div>
                </div>
                <div class="collapse show">
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <div class="col-12">
                                <label class="picture" for="picture__input" tabIndex="0">
                                    @if($pdoInfo? $pdoInfo->photo:'')
                                        <img src="{{ asset('storage/'.($pdoInfo? $pdoInfo->photo: '')) }}" height="100px" width="100px">
                                    @else
                                        <div>
                                            <img id="id_uploaded_photo" height="100px" width="100px">
                                        </div>
                                    @endif
                                </label>

                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Passport no</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">{{$pdoInfo->passport_no}}</span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Mobile</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">{{$pdoInfo->phone}}</span>
                            </div>


                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Full Name</label>
                                <span class="form-control form-control-lg form-control-solid">{{$pdoInfo->full_name}}</span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Date of birth</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{ \Carbon\Carbon::parse($pdoInfo->dob)->format('d M Y') }}
                                </span>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Father's Name</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    {{$pdoInfo?  $pdoInfo->fathers_name:'N/A'}}
                                </span>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Mother Name</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    {{$pdoInfo?  $pdoInfo->mothers_name:'N/A'}}
                                </span>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Gender</label>
                                <span class="form-control form-control-lg form-control-solid">{{$pdoInfo->gender?'Male':'Female'}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header border-0 cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Batch Information</h3>
                    </div>
                </div>
                <div class="collapse show">
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">TTC</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                      {{$pdoInfo ? ($pdoInfo->trainingCenter? $pdoInfo->trainingCenter->trainingCenterByUser->name:''):''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Batch Number</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                     {{$pdoInfo ? ($pdoInfo->trainingSchedule? $pdoInfo->trainingSchedule->batch_no:''):''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Date Range</label>
                                <span class="form-control form-control-lg form-control-solid">
                                        {{ $pdoInfo && $pdoInfo->trainingSchedule ?
                                            \Carbon\Carbon::parse($pdoInfo->trainingSchedule->training_start_date)->format('d-M-Y') : '' }}
                                        to
                                        {{ $pdoInfo && $pdoInfo->trainingSchedule ?
                                            \Carbon\Carbon::parse($pdoInfo->trainingSchedule->training_end_date)->format('d-M-Y') : '' }}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Class Time</label>
                                <span class="form-control form-control-lg form-control-solid">
                                     @php
                                         $startTime = $pdoInfo ? ($pdoInfo->trainingSchedule ? $pdoInfo->trainingSchedule->training_start_time : '') : '';
                                         $endTime = $pdoInfo ? ($pdoInfo->trainingSchedule ? $pdoInfo->trainingSchedule->training_end_time : '') : '';
                                     @endphp

                                    @if (!empty($startTime) && !empty($endTime))
                                        {{ date("h:i A", strtotime($startTime)) }} to {{ date("h:i A", strtotime($endTime)) }}
                                    @else
                                        Time information not available
                                    @endif
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">PDO Type</label>
                                <span class="form-control form-control-lg form-control-solid">
                                      @if($pdoInfo && $pdoInfo->trainingSchedule)
                                        @if($pdoInfo->trainingSchedule->pdo_type==1)
                                            General Category
                                        @elseif($pdoInfo->trainingSchedule->pdo_type==2)
                                            VIP Category
                                        @elseif($pdoInfo->trainingSchedule->pdo_type==2)
                                            Others Category
                                        @endif
                                    @endif
                                </span>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Payment Status</label>
                                <span class="form-control form-control-lg form-control-solid">

                                        @if($pdoInfo? $pdoInfo->payment_status==1:'')
                                            Paid
                                        @elseif($pdoInfo? $pdoInfo->payment_status==1:'')
                                            Not-paid
                                        @endif

                                </span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

            <!-- Action Button -->
            <div class="row">
                <div class="col-12">
                    <div class="d-flex mt-5 justify-content-center">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex mt-5 justify-content-center">
                                    @if($pdoInfo->approval_status == 1)
                                        <a href="{{route('admin.pdo.candidate.registered.verification.not.approved',$pdoInfo->id)}}" class="btn btn-danger me-2 px-6">Reject</a>
                                    @else
                                        <a href="{{route('admin.pdo.candidate.registered.verification.approved',$pdoInfo->id)}}" class="btn btn-primary me-2 px-6">Approve</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
