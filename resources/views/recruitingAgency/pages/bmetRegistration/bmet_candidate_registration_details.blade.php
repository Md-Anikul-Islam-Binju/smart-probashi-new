@extends('layouts.recruitingAgency.master')
@section('content')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid">
            <div class="row align-items-center">
                <div class="col-4">
                    <a href="{{route('recruiting-agency.bmet.candidate.registration.list')}}" class="btn btn-primary">
                        <i class="ki-duotone ki-left"></i> Back</a>
                </div>
                <div class="col-4 text-center">
                    <h1 class="text-dark fw-bold my-1 fs-3">Candidate Profile</h1>
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
                                    <li>
                                        <a class="nav-link active" data-bs-toggle="tab" href="#personal_infos">
                                            <i class="far fa-file-alt"></i>
                                            Personal Infos
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-bs-toggle="tab" href="#jobs">
                                            <i class="fas fa-user-graduate"></i>
                                            Jobs
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-bs-toggle="tab" href="#documents">
                                            <i class="far fa-address-book"></i>
                                            Documents
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-bs-toggle="tab" href="#remarks">
                                            <i class="far fa-file-alt"></i>
                                            Remarks
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-bs-toggle="tab" href="#resume">
                                            <i class="far fa-file-alt"></i>
                                            Resume
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-bs-toggle="tab" href="#chat">
                                            <i class="far fa-file-alt"></i>
                                            Chat
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="bmet_short_info_top row px-3 py-1 mb-7">
                                <div class="col-4 border-end">
                                    <p><b>Name:</b> {{$passportDetailsInfos->full_name}}</p>
                                    <p><b>Mobile:</b> {{$passportDetailsInfos->phone}}</p>
                                </div>
                                <div class="col-8">
                                    <ul class="list-unstyled d-flex mb-0">
                                        <li class="me-3">
															<span class="text-nowrap">
																<img src="https://moewoe.amiprobashi.com/public/img/cross.png" alt="" style="width: 15px;">
																BMET
															</span>
                                        </li>
                                        <li class="me-3">
															<span class="text-nowrap">
																<img src="https://moewoe.amiprobashi.com/public/img/cross.png" alt="" style="width: 15px;">
																PDO
															</span>
                                        </li>
                                        <li class="me-3">
															<span class="text-nowrap">
																<img src="https://moewoe.amiprobashi.com/public/img/cross.png" alt="" style="width: 15px;">
																PASSPORT
															</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="personal_infos" role="tabpanel">
                                    <div class="accordion" id="candidate_profile_infos">
                                        <!-- Passport Information -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="passport_info_header">
                                                <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#passport_info_body" aria-expanded="true" aria-controls="passport_info_body">
                                                    Passport Info
                                                </button>
                                            </h2>
                                            <div id="passport_info_body" class="accordion-collapse collapse show" aria-labelledby="passport_info_header" data-bs-parent="#candidate_profile_infos">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Passport Number:</strong> {{$passportDetailsInfos->passport_no}}
                                                                </li>
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Father Name:</strong> {{$passportDetailsInfos->fathers_name}}
                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Nationality:</strong> Bangladesh
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Passport Issue Date:</strong> {{$passportDetailsInfos->passport_issue_date}}
                                                                </li>
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Mother Name:</strong> {{$passportDetailsInfos->mothers_name}}
                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>NID:</strong> {{$passportDetailsInfos->nid_no}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Passport Expiry Date:</strong>  {{$passportDetailsInfos->passport_expiry_date}}
                                                                </li>
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Date of Birth:</strong> {{$passportDetailsInfos->dob}}
                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Gender: </strong>{{$passportDetailsInfos->gender==1 ? "Male" : "Female"}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Personal -->
                                        @if($passportDetailsInfos->personalInfo)
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
                                                                    <strong>Father Name:</strong> {{$passportDetailsInfos->personalInfo ? $passportDetailsInfos->personalInfo->fathers_name : ''}}
                                                                </li>
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Religion:</strong> {{$passportDetailsInfos->personalInfo->religion ? $passportDetailsInfos->personalInfo->religion->religion_name : ''}}
                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Weight:</strong> {{$passportDetailsInfos->personalInfo ? $passportDetailsInfos->personalInfo->mothers_name : ''}}
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Mother Name:</strong> {{$passportDetailsInfos->personalInfo ? $passportDetailsInfos->personalInfo->weight : ''}} weight
                                                                </li>
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Spouse's Name:</strong> {{$passportDetailsInfos->personalInfo ? $passportDetailsInfos->personalInfo->spouse_name : ''}}
                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Height:</strong> {{$passportDetailsInfos->personalInfo ? $passportDetailsInfos->personalInfo->height_inch : ''}} height
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Marital Status:</strong> {{$passportDetailsInfos->personalInfo->marital_status==1 ? 'Married' : 'Unmarried'}}
                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Inch:</strong>  {{$passportDetailsInfos->personalInfo ? $passportDetailsInfos->personalInfo->height_inch : ''}} inch
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif



                                        <!-- Contact Information -->
                                        @if($passportDetailsInfos->contactInfo)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="contact_info_header">
                                                <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contact_info_body" aria-expanded="false" aria-controls="contact_info_body">
                                                    Contact Information
                                                </button>
                                            </h2>
                                            <div id="contact_info_body" class="accordion-collapse collapse" aria-labelledby="contact_info_header" data-bs-parent="#candidate_profile_infos">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Permanent District:</strong>  {{$passportDetailsInfos->contactInfo->permanentDistrict? $passportDetailsInfos->contactInfo->permanentDistrict->district_name_en : 'N/A'}}
                                                                </li>
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Permanent Village:</strong> {{$passportDetailsInfos->contactInfo->permanent_village?$passportDetailsInfos->contactInfo->permanent_village : 'N/A'}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Permanent Upazilla:</strong>  {{$passportDetailsInfos->contactInfo->permanentUpazila? $passportDetailsInfos->contactInfo->permanentUpazila->upazila_name_en : 'N/A'}}
                                                                </li>
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Permanent House:</strong> {{ $passportDetailsInfos->contactInfo->permanent_house? $passportDetailsInfos->contactInfo->permanent_house : 'N/A'}}
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Permanent Union:</strong> {{$passportDetailsInfos->contactInfo->permanent_union?$passportDetailsInfos->contactInfo->permanent_union : 'N/A'}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Mailing District:</strong>  {{$passportDetailsInfos->contactInfo->mailingDistrict? $passportDetailsInfos->contactInfo->mailingDistrict->district_name_en : 'N/A'}}
                                                                </li>
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Mailing Village:</strong> {{$passportDetailsInfos->contactInfo->mailing_village?$passportDetailsInfos->contactInfo->mailing_village : 'N/A'}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Mailing Upazilla:</strong> {{$passportDetailsInfos->contactInfo->mailingUpazila? $passportDetailsInfos->contactInfo->mailingUpazila->upazila_name_en : 'N/A'}}
                                                                </li>
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Mailing House:</strong> {{ $passportDetailsInfos->contactInfo->mailing_house? $passportDetailsInfos->contactInfo->mailing_house : 'N/A'}}
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Mailing Union:</strong> {{$passportDetailsInfos->contactInfo->mailing_union?$passportDetailsInfos->contactInfo->mailing_union : 'N/A'}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        @endif

                                        <!-- Nominee Information -->
                                        @if($passportDetailsInfos->nomineeInfo)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="nominee_info_header">
                                                <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#nominee_info_body" aria-expanded="false" aria-controls="nominee_info_body">
                                                    Nominee Details
                                                </button>
                                            </h2>
                                            <div id="nominee_info_body" class="accordion-collapse collapse" aria-labelledby="nominee_info_header" data-bs-parent="#candidate_profile_infos">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Nominee Name:</strong> {{$passportDetailsInfos->nomineeInfo->nominee_name ? $passportDetailsInfos->nomineeInfo->nominee_name : 'N/A'}}
                                                                </li>
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Nominee Father Name:</strong> {{$passportDetailsInfos->nomineeInfo->nominee_fathers_name ? $passportDetailsInfos->nomineeInfo->nominee_fathers_name : 'N/A'}}
                                                                </li>
                                                                <li class="my-4  border-bottom pb-3 font-size-lg">
{{--                                                                    <strong>Nominee Upazilla:</strong>  {{$passportDetailsInfos->nomineeInfo->nomineeUpazila ? $passportDetailsInfos->nomineeInfo->nomineeUpazila->upazila_name_en : 'N/A'}}--}}
                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Nominee House:</strong>  {{$passportDetailsInfos->nomineeInfo->nominee_house ? $passportDetailsInfos->nomineeInfo->nominee_house : 'N/A'}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Nominee Phone:</strong> {{$passportDetailsInfos->nomineeInfo->nominee_phone ? $passportDetailsInfos->nomineeInfo->nominee_phone : 'N/A'}}
                                                                </li>
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Nominee Mother Name:</strong> {{$passportDetailsInfos->nomineeInfo->nominee_mothers_name ? $passportDetailsInfos->nomineeInfo->nominee_mothers_name : 'N/A'}}
                                                                </li>
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Nominee Word/Union:</strong>  {{$passportDetailsInfos->nomineeInfo->nominee_union ? $passportDetailsInfos->nomineeInfo->nominee_union : 'N/A'}}
                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Nominee Relation:</strong>  {{$passportDetailsInfos->nomineeInfo->relation ? $passportDetailsInfos->nomineeInfo->relation->relation_name : 'N/A'}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Nominee NID:</strong> {{$passportDetailsInfos->nomineeInfo->nominee_nid ? $passportDetailsInfos->nomineeInfo->nominee_nid : 'N/A'}}
                                                                </li>
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
{{--                                                                    <strong>Nominee District:</strong> {{$passportDetailsInfos->nomineeInfo->nomineeDistrict->name ? $passportDetailsInfos->nomineeInfo->nomineeDistrict->name : 'N/A'}}--}}
                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Nominee village:</strong> {{$passportDetailsInfos->nomineeInfo->nominee_village ? $passportDetailsInfos->nomineeInfo->nominee_village : 'N/A'}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Emergency Contact details -->
                                        @if($passportDetailsInfos->contactInfo)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="emergency_contact_info_header">
                                                <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#emergency_contact_info_body" aria-expanded="false" aria-controls="emergency_contact_info_body">
                                                    Emergency Contact details
                                                </button>
                                            </h2>
                                            <div id="emergency_contact_info_body" class="accordion-collapse collapse" aria-labelledby="emergency_contact_info_header" data-bs-parent="#candidate_profile_infos">

                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Name:</strong> {{$passportDetailsInfos->contactInfo->emergency_contact_person_name ? $passportDetailsInfos->contactInfo->emergency_contact_person_name:'N/A'}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Mobile Number:</strong> {{$passportDetailsInfos->contactInfo->emergency_contact_person_phone ? $passportDetailsInfos->contactInfo->emergency_contact_person_phone	:'N/A'}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Relation:</strong> {{$passportDetailsInfos->contactInfo->relation ? $passportDetailsInfos->contactInfo->relation->relation_name	:'N/A'}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Education -->
                                        @if($passportDetailsInfos->qualificationInfo)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="education_info_header">
                                                <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#education_info_body" aria-expanded="false" aria-controls="education_info_body">
                                                    Education
                                                </button>
                                            </h2>
                                            <div id="education_info_body" class="accordion-collapse collapse" aria-labelledby="education_info_header" data-bs-parent="#candidate_profile_infos">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 border-bottom pb-3 font-size-lg">
                                                                    <strong>Institute:</strong> {{$passportDetailsInfos->qualificationInfo->institute ? $passportDetailsInfos->qualificationInfo->institute:'N/A'}}
                                                                </li>
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Passing Year:</strong> {{$passportDetailsInfos->qualificationInfo->passing_year ? $passportDetailsInfos->qualificationInfo->passing_year:'N/A'}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Subject:</strong> {{$passportDetailsInfos->qualificationInfo->subject ? $passportDetailsInfos->qualificationInfo->subject:'N/A'}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 pb-3 font-size-lg">
                                                                    <strong>Grade:</strong> {{$passportDetailsInfos->qualificationInfo->grade ? $passportDetailsInfos->qualificationInfo->grade:'N/A'}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Language -->
                                        @if($passportDetailsInfos->qualificationInfo)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="language_info_header">
                                                <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#language_info_body" aria-expanded="false" aria-controls="language_info_body">
                                                    Language
                                                </button>
                                            </h2>
                                            <div id="language_info_body" class="accordion-collapse collapse" aria-labelledby="language_info_header" data-bs-parent="#candidate_profile_infos">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-4 border-right">
                                                            <ul class="list-unstyled">
                                                                <li class="my-4 pb-3 font-size-lg">

                                                                    <strong>Language Name:
                                                                        @if($passportDetailsInfos?->qualificationInfo?->language)
                                                                            @php
                                                                                $languages = array_column(json_decode($passportDetailsInfos?->qualificationInfo?->language,true),'lang_name');
                                                                            @endphp
                                                                            {{implode(',',$languages)}}
                                                                        @else
                                                                            N/A
                                                                        @endif
                                                                    </strong>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="jobs" role="tabpanel">
                                    <a class="attached_btn" data-bs-toggle="modal" href="#assign_job_modal" role="button">Attached to a Job</a>
                                    <div class="accordion" id="candidate_profile_infos">
                                        <!-- Applied Jobs Information -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="applied_jobs_info_header">
                                                <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#applied_jobs_info_body" aria-expanded="true" aria-controls="applied_jobs_info_body">
                                                    Applied Jobs
                                                </button>
                                            </h2>
                                            <div id="applied_jobs_info_body" class="accordion-collapse collapse show" aria-labelledby="applied_jobs_info_header" data-bs-parent="#candidate_profile_infos">
                                                <div class="accordion-body">
                                                    <div class="table-responsive">
                                                        <table class='table table-bordered'>
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">Job Name</th>
                                                                <th scope="col">Applied Date</th>
                                                                <th scope="col">Status</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @foreach($passportDetailsInfos->jobAttached ?? $passportDetailsInfos->jobAttached as $jobAttachedData)
                                                            <tr>
                                                                <td>{{$jobAttachedData->job_category_name}}</td>
                                                                <td>{{ \Carbon\Carbon::parse($jobAttachedData->created_at)->format('d F Y') }}</td>
                                                                <td>
                                                                    @if($jobAttachedData->status == 2)
                                                                    <span class="badge bg-success">Selected</span>
                                                                    @elseif($jobAttachedData->status == 1)
                                                                    <span class="badge bg-warning">Shortlisted</span>
                                                                    @endif
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


                                <div class="tab-pane fade" id="documents" role="tabpanel">
                                    documents
                                </div>
                                <div class="tab-pane fade" id="remarks" role="tabpanel">
                                    remarks
                                </div>
                                <div class="tab-pane fade" id="resume" role="tabpanel">
                                    resume
                                </div>
                                <div class="tab-pane fade" id="chat" role="tabpanel">
                                    chat
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">

                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Assign Job Modal -->
    <div class="modal fade" id="assign_job_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">


                    <form action="{{route('recruiting-agency.job.attached')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="modal-title mb-3">Assign Job</h2>
                                <input type="hidden" name="passport_info_id" value="{{$passportDetailsInfos->id}}">
                                <input hidden="" id="job_assign_user" name="job_id">
                                <input id="job_assign" name="job_category_name" required placeholder='Select your data' class='form-control cursor-pointer'>
                                <div id="inputpikkerWrap">
                                    <table class="table small">
                                        <thead>
                                            <tr>
                                                <th>Job</th>
                                                <th>Country</th>
                                                <th>Application Date</th>
                                                <th>Employer Name</th>
                                                <th>Number Of Post</th>
                                                <th>Selected</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($jobs as $jobsData)
                                            <tr class='hover_style_apply'>
                                                <td>{{$jobsData->jobCategory? $jobsData->jobCategory->job_category_name:'N/A'}}</td>
                                                <td>{{$jobsData->country? $jobsData->country->country_name:'N/A'}}</td>
                                                <td>{{ \Carbon\Carbon::parse($jobsData->application_deadline)->format('d F Y') }}</td>
                                                <td>{{$jobsData->employee_name}}</td>
                                                <td>{{$jobsData->no_of_post}}</td>
                                                <td>{{($jobsData->no_of_post)-($jobsData->no_of_post_already_finished)}}</td>
                                                <td hidden="">{{$jobsData->id}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group mb-8">
                                    <div class="form-group gender">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="button">
                                                    <input name="status" value="1" required="required" type="radio" id="sortlist">
                                                    <label for="sortlist" class="btn">Sortlist</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="button">
                                                    <input name="status" value="2" required="required" type="radio" id="selected">
                                                    <label for="selected" class="btn">Selected</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-6">
                            <div class="col-md-12">
                                <div class="modal_btn d-flex justify-content-center">
                                    <button type="button" data-bs-dismiss="modal" class="submit_close me-2">Close</button>
                                    <button type="submit" class="submit_btn">Assign</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const inputBox = document.querySelector('#job_assign');
        const inputBoxUser = document.querySelector('#job_assign_user');
        const popupTable = document.querySelector('#inputpikkerWrap');
        const rows = popupTable.querySelectorAll('tbody tr');

        // Show the popup table when the input field is clicked or has focus
        inputBox.addEventListener('click', () => {
            popupTable.style.display = 'block';
        });

        // Hide the popup table when clicking outside of it
        document.addEventListener('click', (e) => {
            if (e.target !== inputBox && e.target !== popupTable) {
                popupTable.style.display = 'none';
            }
        });

        // Prevent the click event on the popup table from closing it
        popupTable.addEventListener('click', (e) => {
            e.stopPropagation();
        });

        // Add click event listeners to the table rows
        rows.forEach(row => {
            row.addEventListener('click', () => {
                const name = row.cells[0].textContent;
                const title = row.cells[6].textContent;
                inputBox.value = name;
                inputBoxUser.value = title;
                popupTable.style.display = 'none'; // Hide the table after selecting a row
            });
        });

        // Add input event listener for live search
        inputBox.addEventListener('input', () => {
            const searchTerm = inputBox.value.toLowerCase();

            // Create an array to store visible rows
            const visibleRows = [];

            rows.forEach(row => {
                const title = row.cells[0].textContent.toLowerCase();
                if (title.includes(searchTerm)) {
                    row.style.display = ''; // Show the row
                    visibleRows.push(row);
                } else {
                    row.style.display = 'none'; // Hide the row
                }
            });

            // Check if there are visible rows
            if (visibleRows.length === 0) {
                // No matching rows found, display "No data found!" message
                const noDataFoundRow = document.createElement('tr');
                const noDataFoundCell = document.createElement('td');
                noDataFoundCell.textContent = 'No results.';
                noDataFoundCell.colSpan = 6; // Set the colspan to match the number of columns
                noDataFoundRow.appendChild(noDataFoundCell);

                // Remove any existing "No data found!" rows
                const existingNoDataFoundRows = popupTable.querySelectorAll('.no-data-found');
                existingNoDataFoundRows.forEach(existingRow => {
                    existingRow.remove();
                });

                noDataFoundRow.classList.add('no-data-found'); // Add a class to identify the message row
                popupTable.querySelector('tbody').appendChild(noDataFoundRow);
            } else {
                // Remove any existing "No data found!" rows
                const existingNoDataFoundRows = popupTable.querySelectorAll('.no-data-found');
                existingNoDataFoundRows.forEach(existingRow => {
                    existingRow.remove();
                });
            }

            // Handle Enter key for selecting the first row
            inputBox.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' && visibleRows.length > 0) {

                    const firstVisibleRow = visibleRows[0];
                    console.log(firstVisibleRow.cells[0].textContent)
                    const jobHeading = firstVisibleRow.cells[0].textContent;
                    inputBox.value = jobHeading;
                    popupTable.style.display = 'none'; // Hide the table after selecting a row
                }
            });
        });
    </script>
@endsection
