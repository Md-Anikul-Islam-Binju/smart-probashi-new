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
                    <li class="breadcrumb-item text-muted">BMET Register Details</li>
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
                        <h3 class="fw-bold m-0">Passport Info</h3>
                    </div>
                </div>
                <div class="collapse show">
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <div class="col-12">
                                <label class="picture" for="picture__input" tabIndex="0">
                                    <img src="{{ asset('storage/'.$passportDetailsInfos->passport_image ?? '') }}" alt="" style="height: 250px;" class="img-fluid" id="picture__preview">

                                </label>

                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Passport no</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">{{$passportDetailsInfos->passport_no}}</span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Mobile</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">{{$passportDetailsInfos->phone}}</span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Passport issue date</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{ \Carbon\Carbon::parse($passportDetailsInfos->passport_issue_date)->format('d M Y') }}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Passport expiry date</label>
                                <span class="form-control form-control-lg form-control-solid">
                                     {{ \Carbon\Carbon::parse($passportDetailsInfos->passport_expiry_date)->format('d M Y') }}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Full Name</label>
                                <span class="form-control form-control-lg form-control-solid">{{$passportDetailsInfos->full_name}}</span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Date of birth</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{ \Carbon\Carbon::parse($passportDetailsInfos->dob)->format('d M Y') }}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Birth District</label>
                                <span class="form-control form-control-lg form-control-solid">{{$passportDetailsInfos->district->name}}</span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Gender</label>
                                <span class="form-control form-control-lg form-control-solid">{{$passportDetailsInfos->gender?'Male':'Female'}}</span>
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
                                <label class="col-form-label fw-semibold fs-6">Father's Name</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    {{$passportDetailsInfos->personalInfo?  $passportDetailsInfos->personalInfo->fathers_name:'N/A'}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Mother's Name</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    {{$passportDetailsInfos->personalInfo?  $passportDetailsInfos->personalInfo->mothers_name	:'N/A'}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Spouse's Name</label>
                                <span class="form-control form-control-lg form-control-solid">
                                     {{$passportDetailsInfos->personalInfo?  ($passportDetailsInfos->personalInfo->marital_status==1?'Married':'Unmarried') :'N/A'}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Religion</label>
                                <span class="form-control form-control-lg form-control-solid">
                                     {{$passportDetailsInfos->personalInfo->religion ? $passportDetailsInfos->personalInfo->religion->religion_name : ''}}
                                </span>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label fw-semibold fs-6">Height</label>
                                        <span class="form-control form-control-lg form-control-solid">
                                           {{$passportDetailsInfos->personalInfo?  $passportDetailsInfos->personalInfo->height_feet	:'N/A'}}
                                        </span>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label fw-semibold fs-6">Inch</label>
                                        <span class="form-control form-control-lg form-control-solid">
                                            {{$passportDetailsInfos->personalInfo?  $passportDetailsInfos->personalInfo->height_inch	:'N/A'}}
                                        </span>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label fw-semibold fs-6">Weight</label>
                                        <span class="form-control form-control-lg form-control-solid">
                                               {{$passportDetailsInfos->personalInfo?  $passportDetailsInfos->personalInfo->weight	:'N/A'}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact Info -->
            <div class="card mb-2">
                <div class="card-header border-0 cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Contact Info</h3>
                    </div>
                </div>
                <div class="collapse show">
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">District</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                      {{$passportDetailsInfos->contactInfo->permanentDistrict ? $passportDetailsInfos->contactInfo->permanentDistrict->name	 : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Thana/Upazilla</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                      {{$passportDetailsInfos->contactInfo->permanentUpazila ? $passportDetailsInfos->contactInfo->permanentUpazila->upazila_name_en : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Word/Union</label>
                                <span class="form-control form-control-lg form-control-solid">
                                     {{$passportDetailsInfos->contactInfo ? $passportDetailsInfos->contactInfo->permanent_union : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Area/Village</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{$passportDetailsInfos->contactInfo ? $passportDetailsInfos->contactInfo->permanent_village : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">House name/no</label>
                                <span class="form-control form-control-lg form-control-solid">
                                      {{$passportDetailsInfos->contactInfo ? $passportDetailsInfos->contactInfo->permanent_house : ''}}
                                </span>
                            </div>
                        </div>
                        <div class="row py-8">
                            <h2 class="fs-4 bold">My mailing address is the same</h2>
                        </div>
                        <div class="row mb-6">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Birth District</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                      {{$passportDetailsInfos->contactInfo->mailingDistrict ? $passportDetailsInfos->contactInfo->mailingDistrict->name : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Thana/Upazilla</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                     {{$passportDetailsInfos->contactInfo->mailingUpazila ? $passportDetailsInfos->contactInfo->mailingUpazila->upazila_name_en : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Word/Union</label>
                                <span class="form-control form-control-lg form-control-solid">
                                      {{$passportDetailsInfos->contactInfo ? $passportDetailsInfos->contactInfo->mailing_union : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Area/Village</label>
                                <span class="form-control form-control-lg form-control-solid">
                                      {{$passportDetailsInfos->contactInfo ? $passportDetailsInfos->contactInfo->mailing_village : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">House name/no</label>
                                <span class="form-control form-control-lg form-control-solid">
                                      {{$passportDetailsInfos->contactInfo ? $passportDetailsInfos->contactInfo->mailing_house : ''}}
                                </span>
                            </div>
                        </div>
                        <div class="row py-8">
                            <h2 class="fs-4 bold">Emergency Contact</h2>
                        </div>
                        <div class="row mb-6">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Name</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                     {{$passportDetailsInfos->contactInfo ? $passportDetailsInfos->contactInfo->emergency_contact_person_name : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Relationship</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                      {{$passportDetailsInfos->contactInfo->relation ? $passportDetailsInfos->contactInfo->relation->relation_name : ''}}
                                </span>
                            </div>
                            <div class="col-6 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Mobile Number</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                       {{$passportDetailsInfos->contactInfo ? $passportDetailsInfos->contactInfo->emergency_contact_person_phone : ''}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Nominee Details -->
            <div class="card mb-2">
                <div class="card-header border-0 cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Nominee Details</h3>
                    </div>
                </div>
                <div class="collapse show">
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Relation with nominee</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                         {{$passportDetailsInfos->nomineeInfo->relation ? $passportDetailsInfos->nomineeInfo->relation->relation_name : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Nominee Name</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                     {{$passportDetailsInfos->nomineeInfo ? $passportDetailsInfos->nomineeInfo->nominee_name : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Nominee's national id</label>
                                <span class="form-control form-control-lg form-control-solid">
                                       {{$passportDetailsInfos->nomineeInfo ? $passportDetailsInfos->nomineeInfo->nominee_nid : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Nominee's mobile numbe</label>
                                <span class="form-control form-control-lg form-control-solid">
                                       {{$passportDetailsInfos->nomineeInfo ? $passportDetailsInfos->nomineeInfo->nominee_phone : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Nominee's father's name</label>
                                <span class="form-control form-control-lg form-control-solid">
                                      {{$passportDetailsInfos->nomineeInfo ? $passportDetailsInfos->nomineeInfo->nominee_fathers_name : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Nominee's mother's nam</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{$passportDetailsInfos->nomineeInfo ? $passportDetailsInfos->nomineeInfo->nominee_mothers_name : ''}}
                                </span>
                            </div>
                        </div>
                        <div class="row py-8">
                            <h2 class="fs-4 bold">My mailing address is the same</h2>
                        </div>
                        <div class="row mb-6">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Birth District</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                      {{$passportDetailsInfos->nomineeInfo->nomineeDistrict ? $passportDetailsInfos->nomineeInfo->nomineeDistrict->name : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Thana/Upazilla</label>
                                <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                      {{$passportDetailsInfos->nomineeInfo->nomineeUpazila ? $passportDetailsInfos->nomineeInfo->nomineeUpazila->upazila_name_en : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Word/Union</label>
                                <span class="form-control form-control-lg form-control-solid">
                                      {{$passportDetailsInfos->nomineeInfo ? $passportDetailsInfos->nomineeInfo->nominee_union : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Area/Village</label>
                                <span class="form-control form-control-lg form-control-solid">
                                      {{$passportDetailsInfos->nomineeInfo ? $passportDetailsInfos->nomineeInfo->nominee_village : ''}}
                                </span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">House name/no</label>
                                <span class="form-control form-control-lg form-control-solid">
                                    {{$passportDetailsInfos->nomineeInfo ? $passportDetailsInfos->nomineeInfo->nominee_house : ''}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Qualification -->
            <div class="card mb-2">
                <div class="card-header border-0 cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Qualification</h3>
                    </div>
                </div>
                <div class="collapse show">
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Education level</label>
                                @php
                                    $educationLevel = json_decode($passportDetailsInfos->qualificationInfo->education, true);
                                @endphp
                                @if ($educationLevel)
                                    <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    @foreach($educationLevel as $index => $educationLevelData)
                                            {{$educationLevelData['level']}}
                                            @if ($index < count($educationLevel) - 1)
                                                , {{-- Add a comma if it's not the last language --}}
                                            @endif
                                        @endforeach
                                </span>
                                @else
                                    <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                   No Education data available.
                                </span>
                                @endif
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Passing Year</label>
                                @php
                                    $educationLevelPassing = json_decode($passportDetailsInfos->qualificationInfo->education, true);
                                @endphp
                                @if ($educationLevelPassing)
                                    <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    @foreach($educationLevelPassing as $index => $educationLevelPassingData)
                                            {{$educationLevelPassingData['passing_year']}}
                                            @if ($index < count($educationLevelPassing) - 1)
                                                , {{-- Add a comma if it's not the last language --}}
                                            @endif
                                        @endforeach
                                </span>
                                @else
                                    <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                   No Passing Year data available.
                                </span>
                                @endif
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Institute/School</label>
                                @php
                                    $educationInstitute = json_decode($passportDetailsInfos->qualificationInfo->education, true);
                                @endphp
                                @if ($educationInstitute)
                                    <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    @foreach($educationInstitute as $index => $educationInstituteData)
                                            {{$educationInstituteData['institute']}}
                                            @if ($index < count($educationInstitute) - 1)
                                                , {{-- Add a comma if it's not the last language --}}
                                            @endif
                                        @endforeach
                                </span>
                                @else
                                    <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                   No Passing Year data available.
                                </span>
                                @endif
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Board</label>
                                @php
                                    $educationBoard = json_decode($passportDetailsInfos->qualificationInfo->education, true);
                                @endphp
                                @if ($educationBoard)
                                    <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    @foreach($educationBoard as $index => $educationBoardData)
                                            {{$educationBoardData['board']}}
                                            @if ($index < count($educationBoard) - 1)
                                                , {{-- Add a comma if it's not the last language --}}
                                            @endif
                                        @endforeach
                                </span>
                                @else
                                    <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                   No Passing Year data available.
                                </span>
                                @endif
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Subject</label>
                                @php
                                    $educationSubject = json_decode($passportDetailsInfos->qualificationInfo->education, true);
                                @endphp
                                @if ($educationSubject)
                                    <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    @foreach($educationSubject as $index => $educationSubjectData)
                                            {{$educationSubjectData['subject']}}
                                            @if ($index < count($educationSubject) - 1)
                                                , {{-- Add a comma if it's not the last language --}}
                                            @endif
                                        @endforeach
                                </span>
                                @else
                                    <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                   No Passing Year data available.
                                </span>
                                @endif
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Grade/Division</label>
                                @php
                                    $educationGrade = json_decode($passportDetailsInfos->qualificationInfo->education, true);
                                @endphp
                                @if ($educationGrade)
                                    <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    @foreach($educationGrade as $index => $educationGradeData)
                                            {{$educationGradeData['grade']}}
                                            @if ($index < count($educationGrade) - 1)
                                                , {{-- Add a comma if it's not the last language --}}
                                            @endif
                                        @endforeach
                                </span>
                                @else
                                    <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                   No Passing Year data available.
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row py-8">
                            <h2 class="fs-4 bold">Languages</h2>
                        </div>
                        <div class="row mb-6">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label fw-semibold fs-6">Language Name</label>
                                @php
                                    $languages = json_decode($passportDetailsInfos->qualificationInfo->language, true);
                                @endphp

                                @if ($languages)
                                    <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                        @foreach($languages as $index => $language)
                                            {{$language['lang_name']}}
                                            @if ($index < count($languages) - 1)
                                                , {{-- Add a comma if it's not the last language --}}
                                            @endif
                                        @endforeach
                                    </span>
                                @else
                                    <span class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                       No language data available.
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Action Button -->
            <div class="row">
                <div class="col-12">
                    <div class="d-flex mt-5 justify-content-center">
                        @if($passportDetailsInfos->verificationInfo->registration_status == 1)
                            <a href="{{route('admin.candidate.registered.verification.not.approved',$passportDetailsInfos->id)}}" class="btn btn-danger me-2 px-6">Reject</a>
                        @else
                            <a href="{{route('admin.candidate.registered.verification.approved',$passportDetailsInfos->id)}}" class="btn btn-primary me-2 px-6">Approve</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
