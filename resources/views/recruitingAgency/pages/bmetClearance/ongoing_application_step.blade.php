@extends('layouts.recruitingAgency.master')
@section('content')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid">
            <div class="row align-items-center">
                <div class="col-4">
                    <a href="#" class="btn btn-primary">
                        <i class="ki-duotone ki-left"></i>Back</a>
                </div>
                <div class="col-4 text-center">
                    <h1 class="text-dark fw-bold my-1 fs-3">Ongoing BMET Clearance</h1>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>

    <div class="card card-custom gutter-b">
        <div class="card-body">
            <ul class="nav nav-light-danger nav-bold nav-pills customTab_item">
                <li class="nav-item">
                    <a data-bs-toggle="tab" href="#applications_traking" class="nav-link active">
                        <img height="30px" src="{{ URL::to('assets/media/clearance/application_document.png') }}" alt="" class="mr-2"> Application Tracking </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="tab" href="#applications_summary" class="nav-link">
                        <img height="30px" src="{{ URL::to('assets/media/clearance/candidates.png') }}" alt="" class="mr-2"> Note Sheet </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="tab" href="#applications_documents_" class="nav-link">
                        <img height="30px" src="{{ URL::to('assets/media/clearance/payment.png') }}" alt="" class="mr-2"> Documents </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="tab" href="#payment_history" class="nav-link">
                        <img height="30px" src="{{ URL::to('assets/media/clearance/payment.png') }}" alt="" class="mr-2"> Payment History </a>
                </li>
            </ul>

            <div class="tab-content mt-10">
                <div class="clearance_state">
                    <p href="#">D Approved</p>
                </div>
                <div class="clearance_summery_new d-md-flex justify-content-center mt-4">
                    <div class="clearence_item">
                        <div class="media">
                            <img src="{{ URL::to('assets/media/clearance/1.png') }}" alt="..." class="align-self-center mr-3" style="width: 30px;">
                            <div class="media-body">
                                <p>Clearance Type</p>
                                <p>
                                    <span>
                                        @if($clearance->clearance_type == 'individual')
                                            Individual (1-24)
                                        @elseif($clearance->clearance_type == 'group')
                                            Group
                                        @endif
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="clearence_item mx-md-4 mb-2 mb-md-0">
                        <div class="media">
                            <img src="{{ URL::to('assets/media/clearance/country.png') }}" alt="..." class="align-self-center mr-3" style="width: 30px;">
                            <div class="media-body">
                                <p>
                                    <span class="mr-3">Country</span>
                                </p>
                                <p>{{$clearance->country->country_name}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="clearence_item mx-md-4 my-2 my-md-0">
                        <div class="media">
                            <img src="{{ URL::to('assets/media/clearance/3.png') }}" alt="..." class="align-self-center mr-3" style="width: 30px;">
                            <div class="media-body">
                                <p>
                                    <span class="mr-3">Application Id</span>
                                </p>
                                <p>{{$clearance->application_no}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="clearence_item">
                        <div class="media">
                            <div class="media-body">
                                <p>
                                    <span class="mr-3">Application Date</span>
                                </p>
                                <p>{{ \Carbon\Carbon::parse($clearance->created_at)->format('j M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade show active" id="applications_traking" role="tabpanel">
                    <div class="documents_item ml-0 mr-0">
                        <div class="approval_new_design">
                            <div class="approval_items_top">
                                <h2 class="text-center mb-10">Application Status</h2>
                                <ul>
                                    <li>
                                        <div class="top_img">
                                            @if($clearance->section_approved_status==1)
                                            <img src="{{ asset('assets/media/clearance/approve_check.png') }}" alt="" class="top_images">
                                            @else
                                            <img src="{{ asset('assets/media/clearance/not_approve_check.png') }}" alt="" class="top_images">
                                            @endif
                                            <img src="{{ asset('assets/media/clearance/right-arrow.png') }}" alt="" class="bottom_images">
                                        </div>
                                        <h4 class="mt-2">Section</h4>
                                    </li>
                                    <li>
                                        <div class="top_img">
                                            @if($clearance->translator_approved_status==1)
                                                <img src="{{ asset('assets/media/clearance/approve_check.png') }}" alt="" class="top_images">
                                            @else
                                                <img src="{{ asset('assets/media/clearance/not_approve_check.png') }}" alt="" class="top_images">
                                            @endif
                                                <img src="{{ asset('assets/media/clearance/right-arrow.png') }}" alt="" class="bottom_images">
                                        </div>
                                        <h4 class="mt-2">Translator</h4>
                                    </li>
                                    <li>
                                        <div class="top_img">
                                            @if($clearance->ad_approved_status==1)
                                                <img src="{{ asset('assets/media/clearance/approve_check.png') }}" alt="" class="top_images">
                                            @else
                                                <img src="{{ asset('assets/media/clearance/not_approve_check.png') }}" alt="" class="top_images">
                                            @endif
                                                <img src="{{ asset('assets/media/clearance/right-arrow.png') }}" alt="" class="bottom_images">
                                        </div>
                                        <h4 class="mt-2">AD</h4>
                                    </li>
                                    <li>
                                        <div class="top_img">
                                            @if($clearance->dd_approved_status==1)
                                                <img src="{{ asset('assets/media/clearance/approve_check.png') }}" alt="" class="top_images">
                                            @else
                                                <img src="{{ asset('assets/media/clearance/not_approve_check.png') }}" alt="" class="top_images">
                                            @endif
                                                <img src="{{ asset('assets/media/clearance/right-arrow.png') }}" alt="" class="bottom_images">
                                        </div>
                                        <h4 class="mt-2">DD</h4>
                                    </li>
                                    <li>
                                        <div class="top_img">
                                            @if($clearance->d_approved_status==1)
                                                <img src="{{ asset('assets/media/clearance/approve_check.png') }}" alt="" class="top_images">
                                            @else
                                                <img src="{{ asset('assets/media/clearance/not_approve_check.png') }}" alt="" class="top_images">
                                            @endif
                                                <img src="{{ asset('assets/media/clearance/right-arrow.png') }}" alt="" class="bottom_images">
                                        </div>
                                        <h4 class="mt-2">D</h4>
                                    </li>
                                    <li>
                                        <div class="top_img">
                                            @if($clearance->adg_approved_status==1)
                                                <img src="{{ asset('assets/media/clearance/approve_check.png') }}" alt="" class="top_images">
                                            @else
                                                <img src="{{ asset('assets/media/clearance/not_approve_check.png') }}" alt="" class="top_images">
                                            @endif
                                                <img src="{{ asset('assets/media/clearance/right-arrow.png') }}" alt="" class="bottom_images">
                                        </div>
                                        <h4 class="mt-2">ADG</h4>
                                    </li>
                                    <li>
                                        <div class="top_img">
                                            @if($clearance->dg_approved_status==1)
                                                <img src="{{ asset('assets/media/clearance/approve_check.png') }}" alt="" class="top_images">
                                            @else
                                                <img src="{{ asset('assets/media/clearance/not_approve_check.png') }}" alt="" class="top_images">
                                            @endif
                                        </div>
                                        <h4 class="mt-2">DG</h4>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="text-center mb-5">Approval Log</h2>
                                    <div class="approval_new_design">
                                        <div class="approval_items_top">
                                            <ul class="approval_summery" style="display: block !important;">
                                                @if($clearance->section_approved_status==1)
                                                <li class="d-flex justify-content-between w-100">
                                                    <p>Section | {{$clearance->section_name}} (Approved)</p>
                                                    <p class="p22">{{$clearance->section_date}}</p>
                                                </li>
                                                @endif

                                                @if($clearance->translator_approved_status==1)
                                                    <li class="d-flex justify-content-between w-100">
                                                        <p>Translator | {{$clearance->translator_name}} (Approved)</p>
                                                        <p class="p22">{{$clearance->translator_date}}</p>
                                                    </li>
                                                @endif

                                                @if($clearance->ad_approved_status==1)
                                                    <li class="d-flex justify-content-between w-100">
                                                        <p>AD | {{$clearance->ad_name}} (Approved)</p>
                                                        <p class="p22">{{$clearance->ad_date}}</p>
                                                    </li>
                                                @endif

                                                @if($clearance->dd_approved_status==1)
                                                    <li class="d-flex justify-content-between w-100">
                                                        <p>DD | {{$clearance->dd_name}} (Approved)</p>
                                                        <p class="p22">{{$clearance->dd_date}}</p>
                                                    </li>
                                                @endif

                                                @if($clearance->d_approved_status==1)
                                                        <li class="d-flex justify-content-between w-100">
                                                            <p>D | {{$clearance->d_name}} (Approved)</p>
                                                            <p class="p22">{{$clearance->d_date}}</p>
                                                        </li>
                                                @endif

                                                @if($clearance->adg_approved_status==1)
                                                    <li class="d-flex justify-content-between w-100">
                                                        <p>ADG | {{$clearance->adg_name}} (Approved)</p>
                                                        <p class="p22">{{$clearance->adg_date}}</p>
                                                    </li>
                                                @endif

                                                @if($clearance->dg_approved_status==1)
                                                    <li class="d-flex justify-content-between w-100">
                                                        <p>DG | {{$clearance->dg_name}} (Approved)</p>
                                                        <p class="p22">{{$clearance->dg_date}}</p>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="applications_summary" role="tabpanel">
                    <div class="table-responsive complete_application_table">
                        <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-hover training_table dataTable no-footer dtr-inline" id="candidate_datatable">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Sl</th>
                                            <th class="text-center">Name Of Candidate</th>
                                            <th class="text-center">Passport No</th>
                                            <th class="text-center">PDO Certificate</th>
                                            <th class="text-center">Visa Number</th>
                                            <th class="text-center">Job</th>
                                            <th class="text-center">Visa</th>
                                            <th class="text-center">Application Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($clearance->candidateClearances as $key=>$clearanceCandidateData)
                                        <tr>
                                            <td class="text-center">{{$key+1}}</td>
                                            <td class="text-center">{{$clearanceCandidateData? $clearanceCandidateData->passportInfo->full_name:''}}</td>
                                            <td class="text-center">{{$clearanceCandidateData? $clearanceCandidateData->passportInfo->passport_no:''}}</td>
                                            <td class="text-center">{{$clearanceCandidateData? $clearanceCandidateData->passportInfo->pdoInfo->certificate_no:''}}</td>
                                            <td class="text-center">{{$clearanceCandidateData? $clearanceCandidateData->passportInfo->visaInfo->visa_no:''}}</td>
                                            <td class="text-center">{{$clearanceCandidateData? $clearanceCandidateData->job->jobCategory->job_category_name:''}} ({{$clearanceCandidateData? $clearanceCandidateData->job->employee_name:''}})</td>
                                            <td class="text-center">
                                                @if($clearanceCandidateData ? $clearanceCandidateData->passportInfo->visaInfo->status==1:'')
                                                    <img src="{{ asset('assets/media/ok.png') }}">
                                                @else
                                                    <img src="{{ asset('assets/media/close.png') }}">
                                                @endif
                                            </td>
                                            <td class="text-center">Approved</td>
                                            <td class="text-center">
                                                <div class="btn-group dropstart action_button_wrapper">
                                                    <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-angles-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu action_dropdown_menu">
                                                        <li>
                                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#candidateOnlyView{{$clearanceCandidateData->id}}"><i class="fa-solid fa-eye"></i> View </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- Candidate Only View --}}
                                        <div class="modal fade" tabindex="-1" id="candidateOnlyView{{$clearanceCandidateData->id}}">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable main-modal-back">
                                                <div class="modal-content">
                                                    <a href="#" data-bs-dismiss="modal" aria-label="Close" class="text-end pt-3 pe-3">
                                                        <img src="{{ URL::to('assets/media/close.png') }}" alt="Close" style="height: 20px;">
                                                    </a>
                                                    <div class="modal-body">
                                                        <div class="new_profile_box">
                                                            <div class="new_profile_top">
                                                                <div class="row">
                                                                    <div class="col-md-4 border-right">
                                                                        <div class="np_content_1 d-flex">
                                                                            <div class="np_left">
                                                                                <img alt="" src="{{ asset('assets/media/avatars/blank.png') }}" draggable="false" style="width: 75px; margin-right: 15px; border-radius: 5px;">
                                                                                <div class="mt-2">
                                                                                    <span class="status_success btn-disabled">Approved</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="np_right">
                                                                                <p>
                                                                                    <b>{{$clearanceCandidateData->passportInfo->full_name}}</b>
                                                                                </p>
                                                                                <p class="np_small"> Mobile: <b>{{$clearanceCandidateData->passportInfo->phone}}</b>
                                                                                </p>
                                                                                <p class="np_small"> Date of birth: <b>{{$clearanceCandidateData->passportInfo->dob}}</b>
                                                                                </p>
                                                                                <p class="np_small"> Gender: <b>{{$clearanceCandidateData->passportInfo->gender==1? 'Male':'Female'}}</b>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 border-right">
                                                                                    <span>
                                                                                        <p>
                                                                                            <b>
                                                                                                <a data-toggle="modal" data-target="#iframeModal" href="#" class="master_search_top_button d-block">Passport</a>
                                                                                            </b>
                                                                                        </p>
                                                                                    </span>
                                                                        <p class="np_small"> Passport Number: <b>{{$clearanceCandidateData->passportInfo->passport_no}}</b>
                                                                        </p>
                                                                        <p class="np_small"> Issue date: <b>{{$clearanceCandidateData->passportInfo->passport_issue_date}}</b>
                                                                        </p>
                                                                        <p class="np_small"> Expiry date: <b>{{$clearanceCandidateData->passportInfo->passport_expiry_date}}</b>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-2 border-right">
                                                                                    <span>
                                                                                        <span>
                                                                                            <p>
                                                                                                <b>
                                                                                                    <a data-toggle="modal" data-target="#iframeModal" href="#" class="master_search_top_button d-block">PDO</a>
                                                                                                </b>
                                                                                            </p>
                                                                                        </span>
                                                                                        <p class="np_small"> PDO Certificate no: <b>{{$clearanceCandidateData->passportInfo->pdoInfo->certificate_no}}</b>
                                                                                        </p>
                                                                                    </span>
                                                                    </div>
                                                                    <div class="col-md-2 border-right">
                                                                                    <span>
                                                                                        <p>
                                                                                            <b>
                                                                                                <a data-toggle="modal" data-target="#iframeModal" href="#" class="master_search_top_button d-block">BMET Registration</a>
                                                                                            </b>
                                                                                        </p>
                                                                                    </span>
                                                                        <p class="np_small"> Registration ID : <b>{{$clearanceCandidateData->passportInfo->verificationInfo->bmet_verification_registration_no}}</b>
                                                                        </p>
                                                                        <p class="np_small"> Biometric Status: <span>
                                                                                            {{$clearanceCandidateData->passportInfo->verificationInfo->biometric_status==1?'Verified':'Not Verified'}}
                                                                                    </span>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                                    <span>
                                                                                        <p>
                                                                                            <b>
                                                                                                <a data-toggle="modal" data-target="#iframeModal" href="#" class="master_search_top_button d-block"> Employment Info</a>
                                                                                            </b>
                                                                                        </p>
                                                                                    </span>
                                                                        <p> {{$clearanceCandidateData->job->jobCategory->job_category_name}} <br> {{$clearanceCandidateData->job->employee_name}} </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{--                                                                        <div class="new_profile_bottom mt-5">--}}
                                                            {{--                                                                            <div class="row">--}}
                                                            {{--                                                                                <div class="col-md-2">--}}
                                                            {{--                                                                                    <div class="npb_item">--}}
                                                            {{--                                                                                        <div class="media">--}}
                                                            {{--                                                                                            <img src="{{ asset('assets/media/clearance/jpg.png') }}" alt="..." class="me-3" style="width: 40px;">--}}
                                                            {{--                                                                                            <div class="media-body">--}}
                                                            {{--                                                                                                <p class="mt-0" style="font-size: 10px; margin-bottom: 5px;">--}}
                                                            {{--                                                                                                    <b>Visa <br> Documents </b>--}}
                                                            {{--                                                                                                </p>--}}
                                                            {{--                                                                                                <span>--}}
                                                            {{--                                                                                                    <a href="#" data-toggle="modal" data-target="#iframeModal" class="btn_view">View</a>--}}
                                                            {{--                                                                                                </span>--}}
                                                            {{--                                                                                            </div>--}}
                                                            {{--                                                                                        </div>--}}
                                                            {{--                                                                                    </div>--}}
                                                            {{--                                                                                </div>--}}
                                                            {{--                                                                                <div class="col-md-2">--}}
                                                            {{--                                                                                    <div class="npb_item">--}}
                                                            {{--                                                                                        <div class="media">--}}
                                                            {{--                                                                                            <img src="{{ asset('assets/media/clearance/jpg.png') }}" alt="..." class="me-3" style="width: 40px;">--}}
                                                            {{--                                                                                            <div class="media-body">--}}
                                                            {{--                                                                                                <p class="mt-0" style="font-size: 10px; margin-bottom: 5px;">--}}
                                                            {{--                                                                                                    <b>Medical <br> Clearance </b>--}}
                                                            {{--                                                                                                    <span>--}}
                                                            {{--                                                                                                       <a href="#" data-toggle="modal" data-target="#iframeModal" class="btn_view">View</a>--}}
                                                            {{--                                                                                                    </span>--}}
                                                            {{--                                                                                                </p>--}}
                                                            {{--                                                                                            </div>--}}
                                                            {{--                                                                                        </div>--}}
                                                            {{--                                                                                    </div>--}}
                                                            {{--                                                                                </div>--}}
                                                            {{--                                                                                <div class="col-md-2">--}}
                                                            {{--                                                                                    <div class="npb_item">--}}
                                                            {{--                                                                                        <div class="media">--}}
                                                            {{--                                                                                            <img src="{{ asset('assets/media/clearance/jpg.png') }}" alt="..." class="me-3" style="width: 40px;">--}}
                                                            {{--                                                                                            <div class="media-body">--}}
                                                            {{--                                                                                                <p class="mt-0" style="font-size: 10px; margin-bottom: 5px;">--}}
                                                            {{--                                                                                                    <b>Employment <br> Contract </b>--}}
                                                            {{--                                                                                                    <span>--}}
                                                            {{--                                                                                                      <a href="#" data-toggle="modal" data-target="#iframeModal" class="btn_view">View</a>--}}
                                                            {{--                                                                                                    </span>--}}

                                                            {{--                                                                                                </p>--}}
                                                            {{--                                                                                            </div>--}}
                                                            {{--                                                                                        </div>--}}
                                                            {{--                                                                                    </div>--}}
                                                            {{--                                                                                </div>--}}
                                                            {{--                                                                                <div class="col-md-2">--}}
                                                            {{--                                                                                    <div class="npb_item">--}}
                                                            {{--                                                                                        <div class="media">--}}
                                                            {{--                                                                                            <img src="{{ asset('assets/media/clearance/jpg.png') }}" alt="..." class="me-3" style="width: 40px;">--}}
                                                            {{--                                                                                            <div class="media-body">--}}
                                                            {{--                                                                                                <p class="mt-0" style="font-size: 10px; margin-bottom: 5px;">--}}
                                                            {{--                                                                                                    <b>Proof of <br> bank account </b>--}}
                                                            {{--                                                                                                    <span>--}}
                                                            {{--                                                                                                       <a href="#" data-toggle="modal" data-target="#iframeModal" class="btn_view">View</a>--}}
                                                            {{--                                                                                                    </span>--}}
                                                            {{--                                                                                                </p>--}}
                                                            {{--                                                                                            </div>--}}
                                                            {{--                                                                                        </div>--}}
                                                            {{--                                                                                    </div>--}}
                                                            {{--                                                                                </div>--}}
                                                            {{--                                                                            </div>--}}
                                                            {{--                                                                        </div>--}}
                                                            <div class="new_profile_middle my-5">
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <div class="npm_left custom_height_item">
                                                                            <div class="row">
                                                                                <div class="col-md-12 pr-0" style="padding-right: 0px !important;">
                                                                                    <div class="npcontent_date">
                                                                                        <label class="level_samll_font border-bottom mb-3"> Number: <b>{{$clearanceCandidateData->passportInfo->visaInfo->visa_no}}</b>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="npcontent_date">
                                                                                        <label class="level_samll_font border-bottom mb-3"> Issue date: <b>{{$clearanceCandidateData->passportInfo->visaInfo->visa_issue_date}}</b>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="npcontent_date">
                                                                                        <label class="level_samll_font border-bottom mb-3"> Ref No: <b> {{$clearanceCandidateData->passportInfo->visaInfo->attestation_ref_no}}</b>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="npcontent_date">
                                                                                        <label class="level_samll_font border-bottom mb-3"> Expiry date: <b>{{$clearanceCandidateData->passportInfo->visaInfo->visa_expiry_date}}</b>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="npcontent_date">
                                                                                        <label class="level_samll_font mb-3"> Sticker Number: <b>{{$clearanceCandidateData->passportInfo->visaInfo->sticker_no}}</b>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 custom_padding_modal_item my-md-0 my-3">
                                                                        <div class="npm_left custom_height_item">
                                                                            <h5 style="color: #009ef7;"> Bank Account Info </h5>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="npcontent_date">
                                                                                        <label class="level_samll_font border-bottom mb-3">Account holder: <b>{{$clearanceCandidateData->passportInfo->bankInfo->account_holder_name}}</b>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="npcontent_date">
                                                                                        <label class="level_samll_font border-bottom mb-3">Account No: <b>{{$clearanceCandidateData->passportInfo->bankInfo->account_number}}</b>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="npcontent_date">
                                                                                        <label class="level_samll_font border-bottom mb-3">Bank Name: <b>{{$clearanceCandidateData->passportInfo->bankInfo->bank->name}}</b>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 custom_padding_modal_item">
                                                                        <div class="npm_left custom_height_item">
                                                                            <h5 style="color: #009ef7;">Medical</h5>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="npcontent_date">
                                                                                        <label class="level_samll_font border-bottom mb-3">Medical Center: <b>{{$clearanceCandidateData->passportInfo->medicalInfo->hospital->name}}</b>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="footer_btn_items w-100 d-md-flex d-block justify-content-between">
                                                            <div class="footer_btn_item"></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="jobsAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="jobsAccordion_header">
                                <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#jobsAccordion_body" aria-expanded="true" aria-controls="jobsAccordion_body">
                                    Jobs
                                </button>
                            </h2>


                            <div id="jobsAccordion_body" class="accordion-collapse collapse" aria-labelledby="jobsAccordion_header" data-bs-parent="#jobsAccordion">
                                @foreach($clearance->jobClearances as $jobClearancesData)
                                   <div class="job_summary">
                                            <div>
                                                <div>
                                                    <div class="row mt-5 ml-5">
                                                        <div class="col-md-2 p-3 border-right d-flex align-items-center justify-content-around">
                                                            <div class="job_summary_item">
                                                                <img src="{{ URL::to('assets/media/clearance/cleaner.png') }}" alt="" style="width: 80px; height: 80px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 p-3 border-right d-flex align-items-center justify-content-around">
                                                            <div class="job_summary_item">
                                                                <h5 class="mt-2 text-dark">{{$jobClearancesData? $jobClearancesData->jobManagement->jobCategory->job_category_name:'N/A'}}</h5>
                                                                <p class="mt-2">{{$jobClearancesData? $jobClearancesData->jobManagement->employee_name:'N/A'}}</p>
                                                                <p>{{$jobClearancesData? $jobClearancesData->jobManagement->employer_address:'N/A'}}</p>
                                                                <p></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 p-3 border-right d-flex align-items-center justify-content-around">
                                                            <div class="job_summary_item">
                                                                <p>
                                                                    <b class="text-dark">No of Post : </b>{{$jobClearancesData? $jobClearancesData->jobManagement->no_of_post_already_finished:'N/A'}}
                                                                </p>
                                                                <p>
                                                                    <b class="text-dark">Skill type : </b>{{ $jobClearancesData ? ucfirst($jobClearancesData->jobManagement->skill_type) : 'N/A' }}
                                                                </p>
                                                                <p>
                                                                    <b class="text-dark">Job type : </b>{{ $jobClearancesData ? ucfirst($jobClearancesData->jobManagement->job_type) : 'N/A' }}
                                                                </p>
                                                                <p>
                                                                    <b class="text-dark">Gender type : </b>{{ $jobClearancesData ? ($jobClearancesData->jobManagement->gender==1?'Male':'Female') : 'N/A' }}
                                                                </p>
                                                                <p>
                                                                    <b class="text-dark">Age range : </b>{{ $jobClearancesData ? $jobClearancesData->jobManagement->min_age : 'N/A' }} - {{ $jobClearancesData ? $jobClearancesData->jobManagement->max_age : 'N/A' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 p-3 d-flex align-items-center justify-content-around">
                                                            <div class="job_summary_item">
                                                                <p>
                                                                    <b class="text-dark">Salary : </b>{{ $jobClearancesData ? $jobClearancesData->jobManagement->salary_amount : 'N/A' }} {{ $jobClearancesData ? $jobClearancesData->jobManagement->country->currency_name : 'N/A' }} {{ $jobClearancesData ? ucfirst($jobClearancesData->jobManagement->salary_per) : 'N/A' }}
                                                                </p>
                                                                <p>
                                                                    <b class="text-dark">Benefits : </b>
                                                                    {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_accommodation==1 ? 'Accommodation':'' ): 'N/A' }},
                                                                    {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_food==1 ? 'Food facility benefits':'' ): 'N/A' }},
                                                                    {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_transport==1 ? 'Transportation':'' ): 'N/A' }},
                                                                    {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_medical==1 ? 'Medical benefits':'' ): 'N/A' }},
                                                                    {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_visa==1 ? 'Visa':'' ): 'N/A' }},
                                                                    {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_insurance==1 ? 'Insurance premium':'' ): 'N/A' }},
                                                                    {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_one_way==1 ? 'Plane fare one way':'' ): 'N/A' }},
                                                                    {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_two_way==1 ? 'Plane fare two way':'' ): 'N/A' }},
                                                                    {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_other==1 ? 'Others':'' ): 'N/A' }}

                                                                </p>
                                                                <p>
                                                                    <b class="text-dark">Tenure : </b> {{ $jobClearancesData ? $jobClearancesData->jobManagement->contract_tenure : 'N/A' }} Year
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex justify-content-around mt-3">
                                                            <div class="candidate">Candidate Added: {{$jobClearancesData->jobManagement->no_of_post  - $jobClearancesData->jobManagement->no_of_post_already_finished}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="applications_documents_" role="tabpanel">
                    <div class="accordion" id="generalDocuments">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="generalDocuments_header">
                                <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#generalDocuments_body" aria-expanded="true" aria-controls="generalDocuments_body">
                                    General Documents
                                </button>
                            </h2>
                            <div id="generalDocuments_body" class="accordion-collapse collapse show" aria-labelledby="generalDocuments_header" data-bs-parent="#generalDocuments">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-3 col-xxl-3">
                                            <div>
                                                <div>
                                                    <div class="modal-documents m-3">
                                                        <div class="items d-flex align-items-center">
                                                            <div class="left">
                                                                <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                            </div>
                                                            <div class="right ms-2">
                                                                <h5>Employment Contract</h5>
                                                                <div class="view-upload">
                                                                    <a target="_blank" href="https://moewoe.amiprobashi.com/s3-file?path=documents/ra/clearance/35457_38cbc5666966507d8c682326db200b62.pdf">View</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xxl-3">
                                            <div>
                                                <div>
                                                    <div class="modal-documents m-3">
                                                        <div class="items d-flex align-items-center">
                                                            <div class="left">
                                                                <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                            </div>
                                                            <div class="right ms-2">
                                                                <h5>Job Proof</h5>
                                                                <div class="view-upload">
                                                                    <a target="_blank" href="https://moewoe.amiprobashi.com/s3-file?path=documents/ra/clearance/35457_38cbc5666966507d8c682326db200b62.pdf">View</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xxl-3">
                                            <div>
                                                <div>
                                                    <div class="modal-documents m-3">
                                                        <div class="items d-flex align-items-center">
                                                            <div class="left">
                                                                <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                            </div>
                                                            <div class="right ms-2">
                                                                <h5>Mail From BHC</h5>
                                                                <div class="view-upload">
                                                                    <a target="_blank" href="https://moewoe.amiprobashi.com/s3-file?path=documents/ra/clearance/35457_38cbc5666966507d8c682326db200b62.pdf">View</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($clearance->jobClearances as $jobClearancesDataShow)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="general_documents_header{{$jobClearancesDataShow->id}}">
                                    <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#general_documents_body{{$jobClearancesDataShow->id}}" aria-expanded="true" aria-controls="general_documents_body{{$jobClearancesDataShow->id}}">
                                        {{$jobClearancesDataShow? $jobClearancesDataShow->jobManagement->jobCategory->job_category_name:''}} | No of Post: {{$jobClearancesDataShow? $jobClearancesDataShow->jobManagement->no_of_post:''}} | Salary / Month: {{$jobClearancesDataShow? $jobClearancesDataShow->jobManagement->salary_amount:''}}
                                    </button>
                                </h2>
                                <div id="general_documents_body{{$jobClearancesDataShow->id}}" class="accordion-collapse collapse" aria-labelledby="general_documents_header{{$jobClearancesDataShow->id}}" data-bs-parent="#general_documents_infos{{$jobClearancesDataShow->id}}">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-3 col-xxl-3">
                                                <div>
                                                    <div>
                                                        <div class="modal-documents m-3">
                                                            <div class="items d-flex align-items-center">
                                                                <div class="left">
                                                                    <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                                </div>
                                                                <div class="right ms-2">
                                                                    <h5>Employment Contract</h5>
                                                                    <div class="view-upload">
                                                                        <a target="_blank" href="{{asset('storage/'.$jobClearancesDataShow->jobManagement->work_agreement_file)}}">View</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-xxl-3">
                                                <div>
                                                    <div>
                                                        <div class="modal-documents m-3">
                                                            <div class="items d-flex align-items-center">
                                                                <div class="left">
                                                                    <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                                </div>
                                                                <div class="right ms-2">
                                                                    <h5>Job Proof</h5>
                                                                    <div class="view-upload">
                                                                        <a target="_blank" href="{{asset('storage/'.$jobClearancesDataShow->jobManagement->employment_permit_file)}}">View</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-xxl-3">
                                                <div>
                                                    <div>
                                                        <div class="modal-documents m-3">
                                                            <div class="items d-flex align-items-center">
                                                                <div class="left">
                                                                    <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                                </div>
                                                                <div class="right ms-2">
                                                                    <h5>Mail From BHC</h5>
                                                                    <div class="view-upload">
                                                                        <a target="_blank" href="{{asset('storage/'.$jobClearancesDataShow->jobManagement->other_file)}}">View</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="payment_history" role="tabpanel">
                    <div class="d-flex justify-content-center">
                        <div class="d-flex justify-content-center flex-column text-center">
									<span>
										<img src="{{ asset('assets/media/clearance/payment_done.png') }}" alt="..." class="align-self-center mr-3" style="width: 90px;">
										<p>
											<b>Payment Done</b>
										</p>
									</span>
                            <p>Your application has been created successfully.</p>
{{--                            <div class="d-flex justify-content-center">--}}
{{--                                <div>--}}
{{--                                    <a target="_blank" href="#" class="btn btn-primary me-2">--}}
{{--                                        <img src="{{ asset('assets/media/clearance/view.png') }}" alt=""> Invoice </a>--}}
{{--                                    <a target="_blank" href="#" class="btn btn-primary me-2">--}}
{{--                                        <img src="{{ asset('assets/media/clearance/payments.png') }}" alt=""> Download Challan </a>--}}
{{--                                </div>--}}
{{--                                <a target="_blank" href="#" class="btn btn-primary">Downlaod Top Sheet</a>--}}
{{--                            </div>--}}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-10 offset-md-1">
                            <div class="text-center d-flex justify-content-center">
                                <p class="payment-status-ongoing">
                                    <span style="font-weight: bold;">Payment Summary</span>
                                    <span class="payment-status ml-2">
												<span>Payment Status: </span>
                                                @if($clearance->candidateClearancePayment!=null)
                                                    @if($clearance->candidateClearancePayment->payment_status==1)
                                                        <span class="paystatus">paid</span>
                                                    @else
                                                        <span class="paystatus">unpaid</span>
                                                    @endif
                                                @endif
											</span>
                                </p>
                            </div>
                            <div class="table-responsive payment_table">
                                <table class="table clearane_table">
                                    <thead style="background: rgba(1, 158, 247, 0.2);">
                                    <tr>
                                        <th scope="col" class="text-dark">Fees</th>
                                        <th scope="col" class="text-center text-dark">Amount (Per person)</th>
                                        <th scope="col" class="text-center text-dark">Number of Candidates</th>
                                        <th scope="col" class="text-center text-dark">Total Tk</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($clearance->candidateClearancePayment!=null))
                                    <tr>
                                        <td>Advance tax</td>
                                        <td class="text-center text-dark">{{$clearance->candidateClearancePayment->advance_tax}}</td>
                                        <td class="text-center text-dark">{{$clearance->candidateClearancePayment->total_candidate_payment}}</td>
                                        <td class="text-center text-dark">{{$clearance->candidateClearancePayment->advance_tax * $clearance->candidateClearancePayment->total_candidate_payment}} </td>
                                    </tr>
                                    <tr>
                                        <td>Service charge</td>
                                        <td class="text-center text-dark">{{$clearance->candidateClearancePayment->service_charge}}</td>
                                        <td class="text-center text-dark">{{$clearance->candidateClearancePayment->total_candidate_payment}}</td>
                                        <td class="text-center text-dark">{{$clearance->candidateClearancePayment->service_charge * $clearance->candidateClearancePayment->total_candidate_payment}}</td>
                                    </tr>
                                    <tr>
                                        <td>Welfare &amp; Insurance fee</td>
                                        <td class="text-center text-dark">{{$clearance->candidateClearancePayment->insurance_fee}}</td>
                                        <td class="text-center text-dark">{{$clearance->candidateClearancePayment->total_candidate_payment}}</td>
                                        <td class="text-center text-dark">{{$clearance->candidateClearancePayment->insurance_fee * $clearance->candidateClearancePayment->total_candidate_payment}} </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center text-dark">
                                            <strong>Total</strong>
                                        </td>
                                        <td class="text-center">
                                            <strong>{{$clearance->candidateClearancePayment->total_candidate_payment}}</strong>
                                        </td>
                                        <td class="text-center text-dark">
                                            <strong>{{$clearance->candidateClearancePayment->total_payment}} TK</strong>
                                        </td>
                                    </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
