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
                    <li class="breadcrumb-item text-muted">Job Details</li>
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
                        <h3 class="fw-bold m-0">General Information</h3>
                        <div class="right">
                            @if($job->status==2)
                                <span class="badge badge-warning">Already Transfer Foreign Ministry</span>
                            @elseif($job->status==1)
                                <span class="badge badge-danger">Not Transfer Foreign Ministry</span>
                            @elseif($job->status==3)
                                <span class="badge badge-success">Approved</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="collapse show">
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">City</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                     {{$job->city_name}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Country</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    {{$job->country? $job->country->country_name:'N/A'}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">No. of the post</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{$job->no_of_post}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Job Category</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{$job->jobCategory? $job->jobCategory->job_category_name:'N/A'}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Bmet Reference No</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{$job->bmet_reference_no}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Application deadline</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{ \Carbon\Carbon::parse($job->application_deadline)->format('d M Y') }}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Salary</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{$job->salary_amount}}/monthly
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Skill Type</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{$job->skill_type}}
                                </span>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Foreign Reference No</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{$job->foreign_reference_no}}
                                </span>
                            </div>


                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Age Range</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{$job->min_age}} - {{$job->max_age}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Contract tenure</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{$job->contract_tenure}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Gender</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    @if($job->gender==1)
                                        Male
                                    @elseif($job->gender==2)
                                        Female
                                    @else
                                        Both
                                    @endif
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Ministry Reference No</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{$job->ministry_reference_no}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Personal Info -->
            <div class="card mb-2">
                <div class="card-header border-0 cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Personal Info</h3>
                    </div>
                </div>
                <div class="collapse show">
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Requirements</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                     {{$job->requirements_details}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Status</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    {{$job->status==0?'Unpublished':'Published'}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Conditions</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{$job->condition_details}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Charge and additional cost</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{$job->additional_details}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Other benefits</label>
                                <span class="form-control form-control-lg form-control-solid">
                                     {{$job->benefits_details}}
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact Info -->
            @if($job->job_type == 'attested')
                <div class="card mb-2">
                    <div class="card-header border-0 cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Documents</h3>
                        </div>
                    </div>
                    <div class="collapse show">
                        <div class="card-body border-top p-9">
                            <div class="row">
                                <div class="col-md-4 border-right">
                                    <ul class="list-unstyled">
                                        <li class="my-4 border-bottom pb-3 font-size-lg d-flex justify-content-between align-items-center">
                                            <strong>Employment permit:</strong>
                                            <a target="_blank" href="{{asset('storage/'.$job->employment_permit_file)}}">
                                                <img id="employement_letter_img" style="width: 60px" src="{{asset('assets/media/svg/files/pdf.svg')}}" alt="">
                                            </a>
                                        </li>
                                        <li class="my-4 border-bottom pb-3 font-size-lg d-flex justify-content-between align-items-center">
                                            <strong>Demand Letter:</strong>
                                            <a target="_blank" href="{{asset('storage/'.$job->demand_latter_file)}}">
                                                <img id="employement_letter_img" style="width: 60px" src="{{asset('assets/media/svg/files/doc.svg')}}" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4 border-right">
                                    <ul class="list-unstyled">
                                        <li class="my-4 border-bottom pb-3 font-size-lg d-flex justify-content-between align-items-center">
                                            <strong>Work Agreement:</strong>
                                            <a target="_blank" href="{{asset('storage/'.$job->work_agreement_file)}}">
                                                <img id="employement_letter_img" style="width: 60px" src="{{asset('assets/media/svg/files/doc.svg')}}" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-4 border-right">
                                    <ul class="list-unstyled">
                                        <li class="my-4 border-bottom pb-3 font-size-lg d-flex justify-content-between align-items-center">
                                            <strong>Other Document:</strong>
                                            <a target="_blank" href="{{asset('storage/'.$job->other_file)}}">
                                                <img id="employement_letter_img" style="width: 60px" src="{{asset('assets/media/svg/files/doc.svg')}}" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
            @else

            @endif




            @if($job->status==1)
            <div class="text-center">
                <a class="btn btn-success" href="{{route('admin.job.transfer',$job->id)}}">Transfer to Foreign Ministry</a>
            </div>
            @endif
        </div>
    </div>
@endsection
