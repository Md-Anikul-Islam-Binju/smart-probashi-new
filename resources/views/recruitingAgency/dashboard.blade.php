@extends('layouts.recruitingAgency.master')
@section('content')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
                <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3">
                    Recruiting Agency</h1>
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Ra Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card card-custom gutter-b mb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-6">
                            <div class="radash_item">
                                <a href="{{route('recruiting-agency.bmet.create')}}" class="d-flex">
                                    <img height="30px" src="{{ URL::to('assets/media/r_10.png') }}" alt="">
                                    <p class="ms-2">BMET Registration</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 mb-6">
                            <div class="radash_item">
                                <a href="{{route('recruiting-agency.pdo.candidate.registration.list')}}" class="d-flex">
                                    <img height="30px" src="{{ URL::to('assets/media/r_10.png') }}" alt="">
                                    <p class="ms-2">New PDO Application</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 mb-6">
                            <div class="radash_item">
                                <a href="{{route('recruiting-agency.bmet.clearance.new.application')}}" class="d-flex">
                                    <img height="30px" src="{{ URL::to('assets/media/r_10.png') }}" alt="">
                                    <p class="ms-2">New Clearance Application</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-6">
                            <div class="radash_item">
                                <a href="{{route('recruiting-agency.job.create')}}" class="d-flex">
                                    <img height="30px" src="{{ URL::to('assets/media/r_1.png') }}" alt="">
                                    <p class="ms-2">Post an Attested Job</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 mb-6">
                            <div class="radash_item">
                                <a href="{{route('recruiting-agency.skill.job.create')}}" class="d-flex">
                                    <img height="30px" src="{{ URL::to('assets/media/r_3.png') }}" alt="">
                                    <p class="ms-2">Post a Skill Search</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 mb-6">
                            <div class="radash_item">
                                <a href="{{route('recruiting-agency.my.data.bank')}}" class="d-flex">
                                    <img height="30px" src="{{ URL::to('assets/media/r_4.png') }}" alt="">
                                    <p class="ms-2">My Databank Search</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="text-center d-flex justify-content-center">
                            <h5 class="payment-status-ongoing">
                                <span>Pending Application</span>
                            </h5>
                        </div>
                        <div class="table-responsive payment_table">
                            <table class="table clearane_table">
                                <thead style="background: rgba(1, 158, 247, 0.2);">
                                <tr>
                                    <th class="text-center">Approved</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">
                                        <b>{{$clearanceCount}}</b>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Complete Application --}}
            <div class="card card-custom gutter-b mb-5">
                <div class="card-body p-0 py-5 px-3">
                    <h5 class="text-center">Complete Application</h5>
                    <div class="table-responsive complete_application_table">
                        <table class="table training_table table-hover">
                            <thead>
								<tr>
									<th class="text-center" style="padding-left: 10px !important;">Application ID</th>
									<th class="text-center">Recruting Agency</th>
									<th class="text-center">Clearance Type</th>
									<th class="text-center">Country</th>
									<th class="text-center">Employer Name</th>
									<th class="text-center">Applied Candidates</th>
									<th class="text-center">Application Date</th>
									<th class="text-center">Application Status</th>
									<th class="text-center">Source</th>
									<th class="text-center">Action</th>
								</tr>
                            </thead>
                            <tbody>
                            @foreach($clearance as $clearanceData)
                                <tr>
                                    <td class="text-center">{{$clearanceData->application_no}}</td>
                                    <td class="text-center">{{$clearanceData->recruitingAgency->name}}</td>
                                    <td class="text-center">
                                        @if($clearanceData->clearance_type == 'individual')
                                            Individual
                                        @elseif($clearanceData->clearance_type == 'group')
                                            Group
                                        @endif
                                    </td>
                                    <td class="text-center">{{$clearanceData->country->country_name}}</td>
                                    <td class="text-center">
                                        @if($clearanceData->jobClearances->isNotEmpty())
                                            @foreach($clearanceData->jobClearances as $jobClearance)
                                                {{$jobClearance->jobManagement->employee_name}},
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $clearanceData->candidateClearances->count() }}
                                    </td>
                                    <td class="text-center">
                                        {{ $clearanceData->created_at->diffForHumans() }}
                                    </td>
                                    <td class="text-center">Approved</td>

                                    <td class="text-center">
                                       RA
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group dropstart action_button_wrapper">
                                            <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-angles-down"></i>
                                            </button>
                                            <ul class="dropdown-menu action_dropdown_menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{route('recruiting-agency.ongoing.application.step',$clearanceData->id)}}"><i class="fa-solid fa-eye"></i> View </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Country wise jobs --}}
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-body p-0 py-5 px-3">
                    <h5 class="text-center">Country Wise Jobs</h5>
                    <div class="tab-content">
                        <div class="table-responsive">
                            <table class="table table-hover training_table" style="margin-top: 0px !important;">
                                <thead>
                                <tr>
                                    <th style="min-width: 250px;">
                                        <span class="text-light text-start">Job</span>
                                    </th>
                                    <th class="text-start">
                                        <span class="text-75 text-light">Job Type</span>
                                    </th>
                                    <th class="text-center">
                                        <span class="text-75 text-light">Country</span>
                                    </th>
                                    <th class="text-center">
                                        <span class="text-75 text-light">Post Date</span>
                                    </th>
                                    <th class="text-center" style="min-width: 120px;">
                                        <span class="text-75 text-light">Total Applications</span>
                                    </th>
                                    <th class="text-center" style="min-width: 100px;">
                                        <span class="text-75 text-light">Selected</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($jobs as $key=>$jobsData)
                                <tr>
                                    <td class="align-items-center" style="padding-left: 10px;">
                                        <a href="{{route('recruiting-agency.job.show',$jobsData->id)}}" class="text-dark-75 text-hover-primary mb-1">{{$jobsData->jobCategory? $jobsData->jobCategory->job_category_name:''}}</a>
                                    </td>
                                    <td class="align-items-center">
                                        <a href="{{route('recruiting-agency.job.show',$jobsData->id)}}" class="text-dark-75 text-hover-primary mb-1">Attested Job</a>
                                    </td>
                                    <td class="align-items-center">
                                        <div class="text-center">
                                            <a href="{{route('recruiting-agency.job.show',$jobsData->id)}}" class="text-dark-75 text-hover-primary mb-1">{{$jobsData->country? $jobsData->country->country_name:''}}</a>
                                        </div>
                                    </td>
                                    <td class="align-items-center">
                                        <div class="text-center">
                                            <a href="{{route('recruiting-agency.job.show',$jobsData->id)}}" class="text-dark-75 text-hover-primary mb-1">{{ date('M d, Y', strtotime($jobsData->created_at)) }}</a>
                                        </div>
                                    </td>
                                    <td class="align-center">
                                        <div class="text-center">
                                            <a href="{{route('recruiting-agency.job.show',$jobsData->id)}}" class="text-dark-75 text-hover-primary mb-1 font-size-lg">{{$jobsData->attached_jobs_count}}</a>
                                        </div>
                                    </td>
                                    <td class="align-center">
                                        <div class="text-center">
                                            <a href="{{route('recruiting-agency.job.show',$jobsData->id)}}" class="text-dark-75 text-hover-primary mb-1 font-size-lg">{{($jobsData->no_of_post)-($jobsData->no_of_post_already_finished	)}}</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
