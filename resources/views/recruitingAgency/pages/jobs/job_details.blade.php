@extends('layouts.recruitingAgency.master')
@section('content')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid">
            <div class="row align-items-center">
                <div class="col-4">
                    <a href="#" class="btn btn-primary">
                        <i class="ki-duotone ki-left"></i> Back</a>
                </div>
                <div class="col-4 text-center">
                    <h1 class="text-dark fw-bold my-1 fs-3">Job Details</h1>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>

    <div class="post d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-5">
                                <ul class="nav nav-tabs bmet_view_data_tab_style">
                                    @php
                                        $url = URL::current();
                                        $segments = explode('/', $url);
                                        $id = end($segments);
                                    @endphp
                                    <li>
                                        <a class="nav-link active" data-bs-toggle="tab" href="#personal_infos">
                                            <i class="far fa-file-alt"></i>
                                            Job Information
                                        </a>
                                    </li>

                                    <li>
                                        <a class="nav-link" href="{{ route('recruiting-agency.all.applications',['id'=>$id]) }}">
                                            <i class="fas fa-user-graduate"></i>
                                            All Applications
                                        </a>
                                    </li>

                                    <li>
                                        <a class="nav-link" href="{{ route('recruiting-agency.shortlisted.applications',['id'=>$id]) }}">
                                            <i class="far fa-address-book"></i>
                                            Shortlisted
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{ route('recruiting-agency.selected.applications',['id'=>$id]) }}">
                                            <i class="far fa-file-alt"></i>
                                            Selected
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-bs-toggle="tab" href="#resume">
                                            <i class="far fa-file-alt"></i>
                                            Visa Reported
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-bs-toggle="tab" href="#chat">
                                            <i class="far fa-file-alt"></i>
                                            Conversations
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-12 col-md-9">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="personal_infos" role="tabpanel">
                                    <div class="accordion" id="candidate_profile_infos">
                                        <!-- General Information -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="passport_info_header">
                                                <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#passport_info_body" aria-expanded="true" aria-controls="passport_info_body">
                                                    General Information
                                                </button>
                                            </h2>
                                            <div id="passport_info_body" class="accordion-collapse collapse show" aria-labelledby="passport_info_header" data-bs-parent="#candidate_profile_infos">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>City:</strong> {{$job->city_name}}
                                                                </li>
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Country:</strong> {{$job->country? $job->country->country_name:'N/A'}}
                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>No. of the post:</strong> {{$job->no_of_post}}
                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Job Category:</strong> {{$job->jobCategory? $job->jobCategory->job_category_name:'N/A'}}
                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Bmet Reference No:</strong> {{$job->bmet_reference_no}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Application deadline:</strong> {{ \Carbon\Carbon::parse($job->application_deadline)->format('d F Y') }}
                                                                </li>
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Salary:</strong>
                                                                    @if($job->job_type == 'attested')
                                                                        {{$job->salary_amount}}/monthly
                                                                    @else
                                                                        N/A
                                                                    @endif

                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Skill Type:</strong> {{$job->skill_type}}
                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Foreign Reference No:</strong>  {{$job->foreign_reference_no}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Age Range:</strong> {{$job->min_age}} - {{$job->max_age}}
                                                                </li>
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Contract tenure:</strong>  {{$job->contract_tenure}}
                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Gender: </strong>
                                                                    @if($job->gender==1)
                                                                        Male
                                                                    @elseif($job->gender==2)
                                                                        Female
                                                                    @else
                                                                        Both
                                                                    @endif
                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Ministry Reference No: </strong>{{$job->ministry_reference_no}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Requirements and benefits -->
                                         <div class="accordion-item">
                                                <h2 class="accordion-header" id="experience_info_header">
                                                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#experience_info_body" aria-expanded="false" aria-controls="experience_info_body">
                                                        Personal Information
                                                    </button>
                                                </h2>
                                                <div id="experience_info_body" class="accordion-collapse collapse" aria-labelledby="experience_info_header" data-bs-parent="#candidate_profile_infos">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-md-4 border-right">
                                                                <ul class="list-unstyled">
                                                                    <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                        <strong>Requirements:</strong> {{$job->requirements_details}}
                                                                    </li>
                                                                    <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                        <strong>Status:</strong> {{$job->status==0?'Unpublished':'Published'}}
                                                                    </li>

                                                                </ul>
                                                            </div>

                                                            <div class="col-md-4 border-right">
                                                                <ul class="list-unstyled">
                                                                    <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                        <strong>Conditions:</strong> {{$job->condition_details}}
                                                                    </li>
                                                                    <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                        <strong>Charge and additional cost:</strong>  {{$job->additional_details}}
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            <div class="col-md-4 border-right">
                                                                <ul class="list-unstyled">
                                                                    <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                        <strong>Other benefits:</strong> {{$job->benefits_details}}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- Documents -->
                                        <div class="accordion-item">
                                                <h2 class="accordion-header" id="contact_info_header">
                                                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contact_info_body" aria-expanded="false" aria-controls="contact_info_body">
                                                        Documents
                                                    </button>
                                                </h2>
                                                <div id="contact_info_body" class="accordion-collapse collapse" aria-labelledby="contact_info_header" data-bs-parent="#candidate_profile_infos">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-md-4 border-right">
                                                                <ul class="list-unstyled">
                                                                    <li class="my-4 border-bottom pb-3 font-size-lg d-flex justify-content-between align-items-center">
                                                                        <strong>Employment permit:</strong>
                                                                        @if($job->job_type == 'attested')
                                                                            <a target="_blank" href="{{asset('storage/'.$job->employment_permit_file)}}">
                                                                                <img id="employement_letter_img" style="width: 60px" src="{{asset('assets/media/svg/files/pdf.svg')}}" alt="">
                                                                            </a>
                                                                        @else
                                                                            N/A
                                                                        @endif
                                                                    </li>
                                                                    <li class="my-4 border-bottom pb-3 font-size-lg d-flex justify-content-between align-items-center">
                                                                        <strong>Demand Letter:</strong>
                                                                        @if($job->job_type == 'attested')
                                                                            <a target="_blank" href="{{asset('storage/'.$job->demand_latter_file)}}">
                                                                                <img id="employement_letter_img" style="width: 60px" src="{{asset('assets/media/svg/files/doc.svg')}}" alt="">
                                                                            </a>
                                                                        @else
                                                                            N/A
                                                                        @endif

                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4 border-right">
                                                                <ul class="list-unstyled">
                                                                    <li class="my-4 border-bottom pb-3 font-size-lg d-flex justify-content-between align-items-center">
                                                                        <strong>Work Agreement:</strong>
                                                                        @if($job->job_type == 'attested')
                                                                            <a target="_blank" href="{{asset('storage/'.$job->work_agreement_file)}}">
                                                                                <img id="employement_letter_img" style="width: 60px" src="{{asset('assets/media/svg/files/doc.svg')}}" alt="">
                                                                            </a>
                                                                        @else
                                                                            N/A
                                                                        @endif

                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            <div class="col-md-4 border-right">
                                                                <ul class="list-unstyled">
                                                                    <li class="my-4 border-bottom pb-3 font-size-lg d-flex justify-content-between align-items-center">
                                                                        <strong>Other Document:</strong>
                                                                        @if($job->job_type == 'attested')
                                                                            <a target="_blank" href="{{asset('storage/'.$job->other_file)}}">
                                                                                <img id="employement_letter_img" style="width: 60px" src="{{asset('assets/media/svg/files/doc.svg')}}" alt="">
                                                                            </a>
                                                                        @else
                                                                            N/A
                                                                        @endif

                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                    </div>
                                </div>




                                <div class="tab-pane fade" id="resume" role="tabpanel">
                                    <div class="accordion" id="candidate_profile_infos">
                                        <!-- General Information -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="passport_info_header">
                                                <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#passport_info_body" aria-expanded="true" aria-controls="passport_info_body">
                                                    Report Information
                                                </button>
                                            </h2>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="chat" role="tabpanel">
                                    <div class="accordion" id="candidate_profile_infos">
                                        <!-- General Information -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="passport_info_header">
                                                <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#passport_info_body" aria-expanded="true" aria-controls="passport_info_body">
                                                    Conversations
                                                </button>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="col-12 col-md-3">
							<ul class="list-unstyled mt-0">
								<li>
									<a href="#" class="btn5 font-size-lg text-center font-weight-bold my-2 py-3 my-md-0 d-block">Edit</a>
								</li>
							</ul>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
