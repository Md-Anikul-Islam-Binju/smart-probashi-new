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
                    <h1 class="text-dark fw-bold my-1 fs-3">Clearance Application View</h1>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>
    <div id="kt_content_container" class="container-fluid">
        <div class="card card-custom gutter-b mb-5">
            <div class="card-body p-0 py-5 px-3">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <ul class="nav nav-light-danger nav-bold nav-pills customTab_item">
                            <li class="nav-item">
                                <a data-bs-toggle="tab" href="#noteSheet" class="nav-link active">
                                    <img height="30px" src="{{ URL::to('assets/media/clearance/application_document.png') }}" alt="" class="mr-2"> Note Sheet </a>
                            </li>
                            <li class="nav-item">
                                <a data-bs-toggle="tab" href="#applications_summarys" class="nav-link">
                                    <img height="30px" src="{{ URL::to('assets/media/clearance/candidates.png') }}" alt="" class="mr-2"> Application Summary </a>
                            </li>
                            <li class="nav-item">
                                <a data-bs-toggle="tab" href="#caDocuments" class="nav-link">
                                    <img height="30px" src="{{ URL::to('assets/media/clearance/payment.png') }}" alt="" class="mr-2"> Documents </a>
                            </li>
                            <li class="nav-item">
                                <a data-bs-toggle="tab" href="#caRemarks" class="nav-link">
                                    <img height="30px" src="{{ URL::to('assets/media/clearance/payment.png') }}" alt="" class="mr-2"> Remarks </a>
                            </li>
                            <li class="nav-item">
                                <a data-bs-toggle="tab" href="#caApproval" class="nav-link">
                                    <img height="30px" src="{{ URL::to('assets/media/clearance/payment.png') }}" alt="" class="mr-2"> Approval </a>
                            </li>
                        </ul>
                        <div class="tab-content mt-10">
                            <div class="clearance_status">
                                <p href="#" class="me-2">
                                    {{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->country->country_name: ''}}
                                </p>
                                <p href="#" class="me-2">
                                    @if($jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->clearance->clearance_type == 'individual': '')
                                        Individual
                                    @elseif($jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->clearance->clearance_type == 'group': '')
                                        Group
                                    @endif
                                </p>
                                <p class="ms-2"> ID: {{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->clearance->application_no: ''}} </p>
                                <p class="ml-2">
                                    <span>Applied: {{ $jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->clearance->created_at->diffForHumans(): '' }}</span>
                                </p>
                            </div>
                            <div class="clearance_summery_new d-md-flex justify-content-center mt-4">
                                <div class="clearence_item">
                                    <div class="media">
                                        <img src="{{ URL::to('assets/media/clearance/1.png') }}" alt="..." class="align-self-center me-3" style="width: 30px;">
                                        <div class="media-body">
                                            <p>Employer name</p>
                                            <p>{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->employee_name: ''}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearence_item mx-md-4 mb-2 mb-md-0">
                                    <div class="media">
                                        <img src="{{ URL::to('assets/media/clearance/3.png') }}" alt="..." class="align-self-center me-3" style="width: 30px;">
                                        <div class="media-body">
                                            <p><span class="me-3">Foreign reference no</span><span>Date:  {{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->foreign_reference_date: ''}}</span></p>
                                            <p>{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->foreign_reference_no: ''}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearence_item mx-md-4 my-2 my-md-0">
                                    <div class="media">
                                        <img src="{{ URL::to('assets/media/clearance/4.png') }}" alt="..." class="align-self-center me-3" style="width: 30px;">
                                        <div class="media-body">
                                            <p><span class="me-3">Foreign reference no</span><span>Date:  {{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->ministry_reference_date: ''}}</span></p>
                                            <p>{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->ministry_reference_no: ''}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearence_item">
                                    <div class="media">
                                        <img src="{{ URL::to('assets/media/clearance/5.png') }}" alt="..." class="align-self-center me-3" style="width: 30px;">
                                        <div class="media-body">
                                            <p><span class="me-3">Foreign reference no</span><span>Date:</span></p>
                                            <p>{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->bmet_reference_no: ''}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show active" id="noteSheet" role="tabpanel">
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
                                                        <th class="text-center">Job</th>
                                                        <th class="text-center">PDO</th>
                                                        <th class="text-center">Visa No.</th>
                                                        <th class="text-center">BMET No.</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                   @foreach($jobUnderCandidateHistoryDetails->clearance->candidateClearances as $key => $jobUnderCandidateHistoryDetailData)
                                                    <tr>
                                                        <td class="text-center">{{$key+1}}</td>
                                                        <td class="text-center">{{$jobUnderCandidateHistoryDetailData->passportInfo->full_name}}</td>
                                                        <td class="text-center">{{$jobUnderCandidateHistoryDetailData->passportInfo->passport_no}}</td>
                                                        <td class="text-center">{{$jobUnderCandidateHistoryDetails->jobManagement->employee_name}}</td>
                                                        <td class="text-center">PDO</td>
                                                        <td class="text-center">{{$jobUnderCandidateHistoryDetailData->passportInfo->visaInfo->visa_no}}</td>
                                                        <td class="text-center">{{$jobUnderCandidateHistoryDetailData->passportInfo->verificationInfo->bmet_verification_registration_no}}</td>
                                                        <td class="text-center">
                                                            <span class="badge allappbtn-green">{{$jobUnderCandidateHistoryDetailData->passportInfo->verificationInfo->candidate_verify_status==1?'Approved':'Pending'}}</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group dropstart action_button_wrapper">
                                                                <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa-solid fa-angles-down"></i>
                                                                </button>
                                                                <ul class="dropdown-menu action_dropdown_menu">
                                                                    <li>
                                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#candidateOnlyView{{$jobUnderCandidateHistoryDetailData->id}}"><i class="fa-solid fa-eye"></i> View </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    {{-- Candidate Only View --}}
                                                    <div class="modal fade" tabindex="-1" id="candidateOnlyView{{$jobUnderCandidateHistoryDetailData->id}}">
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
                                                                                                <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->full_name}}</b>
                                                                                            </p>
                                                                                            <p class="np_small"> Mobile: <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->phone}}</b>
                                                                                            </p>
                                                                                            <p class="np_small"> Date of birth: <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->dob}}</b>
                                                                                            </p>
                                                                                            <p class="np_small"> Gender: <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->gender==1? 'Male':'Female'}}</b>
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
                                                                                    <p class="np_small"> Passport Number: <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->passport_no}}</b>
                                                                                    </p>
                                                                                    <p class="np_small"> Issue date: <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->passport_issue_date}}</b>
                                                                                    </p>
                                                                                    <p class="np_small"> Expiry date: <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->passport_expiry_date}}</b>
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
                                                                                        <p class="np_small"> PDO Certificate no: <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->pdoInfo->certificate_no}}</b>
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
                                                                                    <p class="np_small"> Registration ID : <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->verificationInfo->bmet_verification_registration_no}}</b>
                                                                                    </p>
                                                                                    <p class="np_small"> Biometric Status: <span>
                                                                                            {{$jobUnderCandidateHistoryDetailData->passportInfo->verificationInfo->biometric_status==1?'Verified':'Not Verified'}}
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
                                                                                    <p> {{$jobUnderCandidateHistoryDetails->jobManagement->jobCategory->job_category_name}} <br> {{$jobUnderCandidateHistoryDetails->jobManagement->employee_name}} </p>
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
                                                                                                    <label class="level_samll_font border-bottom mb-3"> Number: <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->visaInfo->visa_no}}</b>
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="npcontent_date">
                                                                                                    <label class="level_samll_font border-bottom mb-3"> Issue date: <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->visaInfo->visa_issue_date}}</b>
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="npcontent_date">
                                                                                                    <label class="level_samll_font border-bottom mb-3"> Ref No: <b> {{$jobUnderCandidateHistoryDetailData->passportInfo->visaInfo->attestation_ref_no}}</b>
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="npcontent_date">
                                                                                                    <label class="level_samll_font border-bottom mb-3"> Expiry date: <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->visaInfo->visa_expiry_date}}</b>
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="npcontent_date">
                                                                                                    <label class="level_samll_font mb-3"> Sticker Number: <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->visaInfo->sticker_no}}</b>
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
                                                                                                    <label class="level_samll_font border-bottom mb-3">Account holder: <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->bankInfo->account_holder_name}}</b>
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="npcontent_date">
                                                                                                    <label class="level_samll_font border-bottom mb-3">Account No: <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->bankInfo->account_number}}</b>
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="npcontent_date">
                                                                                                    <label class="level_samll_font border-bottom mb-3">Bank Name: <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->bankInfo->bank->name}}</b>
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
                                                                                                    <label class="level_samll_font border-bottom mb-3">Medical Center: <b>{{$jobUnderCandidateHistoryDetailData->passportInfo->medicalInfo->hospital->name}}</b>
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
                            </div>
                            <div class="tab-pane fade" id="applications_summarys" role="tabpanel">
                                <div class="row">
                                    <div class="col-xxl-10 offset-xxl-1 col-md-12">
                                        <div class="table-responsive">
                                            <table class="table training_table table-hover">
                                                <thead>
                                                <tr>
                                                    <th scope="col" width="15%" class="text-center">Job</th>
                                                    <th scope="col" class="text-center">Total Quota (as per demand letter)</th>
                                                    <th scope="col" class="text-center">Cleared Applicants</th>
                                                    <th scope="col" class="text-center">Current No. Of Applicants</th>
                                                    <th scope="col" class="text-center">Remaining Quota</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td class="text-left">{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->jobCategory->job_category_name: ''}}</td>

                                                    <td class="text-center">{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->no_of_post: ''}}</td>
                                                    <td class="text-center">{{($jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->no_of_post: '') - ($jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->no_of_post_already_finished: '')}}</td>
                                                    <td class="text-center">{{($jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->no_of_post: '') - ($jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->no_of_post_already_finished: '')}}</td>
                                                    <td class="text-center">{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->no_of_post_already_finished: ''}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-custom gutter-b pt-3 my-10">
                                    <div class="card-body">
                                        <ul class="d-md-flex d-block justify-content-center list-unstyled align-items-center">
                                            <li class="mx-md-10 mx-0 pb-2 pb-md-0">
                                                <img src="{{ asset('assets/media/clearance/docuemnt-icon.png') }}" alt="" style="width: 25px;">
                                                <b>Total PDO certificate holder:
                                                    {{($jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->no_of_post: '') - ($jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->no_of_post_already_finished: '')}}
                                                </b>
                                            </li>
                                            <li>
                                                <img src="{{ asset('assets/media/clearance/left-arrow.png') }}" alt="" style="width: 25px;">
                                                <b>Returnee: 0</b>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <h4 class="text-center font-weight-bold">Payment Summary</h4>
                                <div class="row mt-3">
                                    <div class="col-md-10 offset-md-1">
                                        <div class="text-center d-flex justify-content-center">
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
                                                @if($jobUnderCandidateHistoryDetails->clearance->candidateClearancePayment!=null)
                                                <tr>
                                                    <td>Advance tax</td>
                                                    <td class="text-center text-dark">{{$jobUnderCandidateHistoryDetails->clearance->candidateClearancePayment->advance_tax}}</td>
                                                    <td class="text-center text-dark">{{$jobUnderCandidateHistoryDetails->clearance->candidateClearancePayment->total_candidate_payment}}</td>
                                                    <td class="text-center text-dark">{{$jobUnderCandidateHistoryDetails->clearance->candidateClearancePayment->advance_tax * $jobUnderCandidateHistoryDetails->clearance->candidateClearancePayment->total_candidate_payment}} </td>
                                                </tr>
                                                <tr>
                                                    <td>Service charge</td>
                                                    <td class="text-center text-dark">{{$jobUnderCandidateHistoryDetails->clearance->candidateClearancePayment->service_charge}}</td>
                                                    <td class="text-center text-dark">{{$jobUnderCandidateHistoryDetails->clearance->candidateClearancePayment->total_candidate_payment}}</td>
                                                    <td class="text-center text-dark">{{$jobUnderCandidateHistoryDetails->clearance->candidateClearancePayment->service_charge * $jobUnderCandidateHistoryDetails->clearance->candidateClearancePayment->total_candidate_payment}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Welfare &amp; Insurance fee</td>
                                                    <td class="text-center text-dark">{{$jobUnderCandidateHistoryDetails->clearance->candidateClearancePayment->insurance_fee}}</td>
                                                    <td class="text-center text-dark">{{$jobUnderCandidateHistoryDetails->clearance->candidateClearancePayment->total_candidate_payment}}</td>
                                                    <td class="text-center text-dark">{{$jobUnderCandidateHistoryDetails->clearance->candidateClearancePayment->insurance_fee * $jobUnderCandidateHistoryDetails->clearance->candidateClearancePayment->total_candidate_payment}} </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="text-center text-dark">
                                                        <strong>Total</strong>
                                                    </td>
                                                    <td class="text-center">
                                                        <strong>{{$jobUnderCandidateHistoryDetails->clearance->candidateClearancePayment->total_candidate_payment}}</strong>
                                                    </td>
                                                    <td class="text-center text-dark">
                                                        <strong>{{$jobUnderCandidateHistoryDetails->clearance->candidateClearancePayment->total_payment}} TK</strong>
                                                    </td>
                                                </tr>
                                                @endif
                                                </tbody>
                                            </table>
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
                                        <div id="jobsAccordion_body" class="accordion-collapse collapse show" aria-labelledby="jobsAccordion_header" data-bs-parent="#jobsAccordion">
                                            <div class="accordion-body">
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
                                                                        <h5 class="mt-2 text-dark">{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->jobCategory->job_category_name: ''}}</h5>
                                                                        <p class="mt-2">{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->employee_name: ''}}</p>
                                                                        <p>{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->city_name: ''}}</p>
                                                                        <p></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 p-3 border-right d-flex align-items-center justify-content-around">
                                                                    <div class="job_summary_item">
                                                                        <p>
                                                                            <b class="text-dark">No of Post : </b>{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->no_of_post: ''}}
                                                                        </p>
                                                                        <p>
                                                                            <b class="text-dark">Skill type : </b>{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->skill_type: ''}}
                                                                        </p>
                                                                        <p>
                                                                            <b class="text-dark">Job type : </b>{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->job_type: ''}}
                                                                        </p>
                                                                        <p>
                                                                            <b class="text-dark">Gender type : </b>{{$jobUnderCandidateHistoryDetails? ($jobUnderCandidateHistoryDetails->jobManagement->gender==1 ?  'Male':'Female'):''}}
                                                                        </p>
                                                                        <p>
                                                                            <b class="text-dark">Age range : </b>{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->min_age: ''}} - {{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->max_age: ''}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 p-3 d-flex align-items-center justify-content-around">
                                                                    <div class="job_summary_item">
                                                                        <p>
                                                                            <b class="text-dark">Salary : </b> {{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->salary_amount: ''}} {{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->country->currency_name: ''}} {{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->salary_per: ''}}
                                                                        </p>
                                                                        <p>
                                                                            <b class="text-dark">Benefits : </b>
                                                                            {{ $jobUnderCandidateHistoryDetails ? ($jobUnderCandidateHistoryDetails->jobManagement->is_accommodation==1 ? 'Accommodation':'' ): 'N/A' }},
                                                                            {{ $jobUnderCandidateHistoryDetails ? ($jobUnderCandidateHistoryDetails->jobManagement->is_food==1 ? 'Food facility benefits':'' ): 'N/A' }},
                                                                            {{ $jobUnderCandidateHistoryDetails ? ($jobUnderCandidateHistoryDetails->jobManagement->is_transport==1 ? 'Transportation':'' ): 'N/A' }},
                                                                            {{ $jobUnderCandidateHistoryDetails ? ($jobUnderCandidateHistoryDetails->jobManagement->is_medical==1 ? 'Medical benefits':'' ): 'N/A' }},
                                                                            {{ $jobUnderCandidateHistoryDetails ? ($jobUnderCandidateHistoryDetails->jobManagement->is_visa==1 ? 'Visa':'' ): 'N/A' }},
                                                                            {{ $jobUnderCandidateHistoryDetails ? ($jobUnderCandidateHistoryDetails->jobManagement->is_insurance==1 ? 'Insurance premium':'' ): 'N/A' }},
                                                                            {{ $jobUnderCandidateHistoryDetails ? ($jobUnderCandidateHistoryDetails->jobManagement->is_one_way==1 ? 'Plane fare one way':'' ): 'N/A' }},
                                                                            {{ $jobUnderCandidateHistoryDetails ? ($jobUnderCandidateHistoryDetails->jobManagement->is_two_way==1 ? 'Plane fare two way':'' ): 'N/A' }},
                                                                            {{ $jobUnderCandidateHistoryDetails ? ($jobUnderCandidateHistoryDetails->jobManagement->is_other==1 ? 'Others':'' ): 'N/A' }}
                                                                        </p>
                                                                        <p>
                                                                            <b class="text-dark">Tenure : </b> {{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->contract_tenure: ''}}  Year
                                                                        </p>
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
                            <div class="tab-pane fade" id="caDocuments" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-3 col-xxl-3">
                                        <div class="modal-documents m-3">
                                            <div class="items d-flex align-items-center">
                                                <div class="left">
                                                    <img src="http://127.0.0.1:8000/assets/media/clearance/jpg.png" alt="" style="width: 70px;">
                                                </div>
                                                <div class="right ms-2">
                                                    <h5>Employment permit File</h5>
                                                    <div class="view-upload">
                                                        <a target="_blank" href="{{asset('storage/'.$jobUnderCandidateHistoryDetails->jobManagement->employment_permit_file)}}">View</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xxl-3">
                                        <div class="modal-documents m-3">
                                            <div class="items d-flex align-items-center">
                                                <div class="left">
                                                    <img src="http://127.0.0.1:8000/assets/media/clearance/jpg.png" alt="" style="width: 70px;">
                                                </div>
                                                <div class="right ms-2">
                                                    <h5>Demand Latter File</h5>
                                                    <div class="view-upload">
                                                        <a target="_blank" href="{{asset('storage/'.$jobUnderCandidateHistoryDetails->jobManagement->demand_latter_file)}}">View</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xxl-3">
                                        <div class="modal-documents m-3">
                                            <div class="items d-flex align-items-center">
                                                <div class="left">
                                                    <img src="http://127.0.0.1:8000/assets/media/clearance/jpg.png" alt="" style="width: 70px;">
                                                </div>
                                                <div class="right ms-2">
                                                    <h5>Work Agreement Filele</h5>
                                                    <div class="view-upload">
                                                        <a target="_blank" href="{{asset('storage/'.$jobUnderCandidateHistoryDetails->jobManagement->work_agreement_file)}}">View</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="caRemarks" role="tabpanel">

                            </div>
                            <div class="tab-pane fade" id="caApproval" role="tabpanel">
                                <div class="row">
                                    <div class="col-xxl-10 offset-xxl-1 col-md-12">
                                        <div class="table-responsive">
                                            <table class="table training_table table-hover">
                                                <thead>
                                                <tr>
                                                    <th scope="col" width="15%" class="text-center">Job</th>
                                                    <th scope="col" class="text-center">Total Quota (as per demand letter)</th>
                                                    <th scope="col" class="text-center">Cleared Applicants</th>
                                                    <th scope="col" class="text-center">Current No. Of Applicants</th>
                                                    <th scope="col" class="text-center">Remaining Quota</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td class="text-left">{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->jobCategory->job_category_name: ''}}</td>
                                                    <td class="text-center">{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->no_of_post: ''}}</td>
                                                    <td class="text-center">{{($jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->no_of_post: '') - ($jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->no_of_post_already_finished: '')}}</td>
                                                    <td class="text-center">{{($jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->no_of_post: '') - ($jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->no_of_post_already_finished: '')}}</td>
                                                    <td class="text-center">{{$jobUnderCandidateHistoryDetails? $jobUnderCandidateHistoryDetails->jobManagement->no_of_post_already_finished: ''}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


{{--                                <div class="card-body">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-12">--}}
{{--                                                <h2 class="text-center mb-5">Approval Log</h2>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="approval_new_design">--}}
{{--                                            <div class="approval_items_top">--}}
{{--                                                <ul>--}}
{{--                                                    <li>--}}
{{--                                                        <div class="top_img">--}}
{{--                                                            <img src="{{ asset('assets/media/clearance/approve_check.png') }}" alt="" class="top_images">--}}
{{--                                                            <img src="{{ asset('assets/media/clearance/right-arrow.png') }}" alt="" class="bottom_images">--}}
{{--                                                        </div>--}}
{{--                                                        <h4 class="mt-2">Section</h4>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <div class="top_img">--}}
{{--                                                            <img src="{{ asset('assets/media/clearance/approve_check.png') }}" alt="" class="top_images">--}}
{{--                                                            <img src="{{ asset('assets/media/clearance/right-arrow.png') }}" alt="" class="bottom_images">--}}
{{--                                                        </div>--}}
{{--                                                        <h4 class="mt-2">Translator</h4>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <div class="top_img">--}}
{{--                                                            <img src="{{ asset('assets/media/clearance/approve_check.png') }}" alt="" class="top_images">--}}
{{--                                                            <img src="{{ asset('assets/media/clearance/right-arrow.png') }}" alt="" class="bottom_images">--}}
{{--                                                        </div>--}}
{{--                                                        <h4 class="mt-2">AD</h4>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <div class="top_img">--}}
{{--                                                            <img src="{{ asset('assets/media/clearance/approve_check.png') }}" alt="" class="top_images">--}}
{{--                                                            <img src="{{ asset('assets/media/clearance/right-arrow.png') }}" alt="" class="bottom_images">--}}
{{--                                                        </div>--}}
{{--                                                        <h4 class="mt-2">DD</h4>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <div class="top_img">--}}
{{--                                                            <img src="{{ asset('assets/media/clearance/approve_check.png') }}" alt="" class="top_images">--}}
{{--                                                            <img src="{{ asset('assets/media/clearance/right-arrow.png') }}" alt="" class="bottom_images">--}}
{{--                                                        </div>--}}
{{--                                                        <h4 class="mt-2">D</h4>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <div class="top_img">--}}
{{--                                                            <img src="{{ asset('assets/media/clearance/approve_check.png') }}" alt="" class="top_images">--}}
{{--                                                            <img src="{{ asset('assets/media/clearance/right-arrow.png') }}" alt="" class="bottom_images">--}}
{{--                                                        </div>--}}
{{--                                                        <h4 class="mt-2">ADG</h4>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <div class="top_img">--}}
{{--                                                            <img src="{{ asset('assets/media/clearance/approve_check.png') }}" alt="" class="top_images">--}}
{{--                                                        </div>--}}
{{--                                                        <h4 class="mt-2">DG</h4>--}}
{{--                                                    </li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="approval_items_top">--}}
{{--                                                <ul class="approval_summery" style="display: block !important;">--}}
{{--                                                    <li class="d-flex justify-content-between w-100">--}}
{{--                                                        <p>D | Mohammad Mizanur Rahman Bhuiyan (Approved)</p>--}}
{{--                                                        <p class="p22">20 Oct 2023, 5:35 am</p>--}}
{{--                                                    </li>--}}
{{--                                                    <li class="d-flex justify-content-between w-100 li33">--}}
{{--                                                        <p>DD | MD. Sazzad Hossain Sarkar (Sent to Director)</p>--}}
{{--                                                        <p class="p22">19 Oct 2023, 8:53 pm</p>--}}
{{--                                                    </li>--}}
{{--                                                    <li class="d-flex justify-content-between w-100">--}}
{{--                                                        <p>AD | Chittra Dutta (Sent to DD)</p>--}}
{{--                                                        <p class="p22">19 Oct 2023, 7:44 pm</p>--}}
{{--                                                    </li>--}}
{{--                                                    <li class="d-flex justify-content-between w-100 li33">--}}
{{--                                                        <p>Section | Md. Joshim Uddin (Sent to AD)</p>--}}
{{--                                                        <p class="p22">19 Oct 2023, 7:34 pm</p>--}}
{{--                                                    </li>--}}
{{--                                                    <li class="d-flex justify-content-between w-100">--}}
{{--                                                        <p>Recruiting Agency | M.E.F Global-1963 (Sent to Section)</p>--}}
{{--                                                        <p class="p22">19 Oct 2023, 7:25 pm</p>--}}
{{--                                                    </li>--}}
{{--                                                    <li class="d-flex justify-content-between w-100 li33">--}}
{{--                                                        <p>Recruiting Agency | M.E.F Global-1963 (New)</p>--}}
{{--                                                        <p class="p22">19 Oct 2023, 6:55 pm</p>--}}
{{--                                                    </li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="apps_btnss text-center">--}}
{{--                                        <a>Application Status: Approved</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="tab-pane fade show active" id="applications_traking" role="tabpanel">
                                    <div class="documents_item ml-0 mr-0">
                                        <div class="approval_new_design">
                                            <div class="approval_items_top">
                                                <h2 class="text-center mb-10">Application Status</h2>
                                                <ul>
                                                    <li>
                                                        <div class="top_img">
                                                            @if($jobUnderCandidateHistoryDetails->clearance->section_approved_status==1)
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
                                                            @if($jobUnderCandidateHistoryDetails->clearance->translator_approved_status==1)
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
                                                            @if($jobUnderCandidateHistoryDetails->clearance->ad_approved_status==1)
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
                                                            @if($jobUnderCandidateHistoryDetails->clearance->dd_approved_status==1)
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
                                                            @if($jobUnderCandidateHistoryDetails->clearance->d_approved_status==1)
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
                                                            @if($jobUnderCandidateHistoryDetails->clearance->adg_approved_status==1)
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
                                                            @if($jobUnderCandidateHistoryDetails->clearance->dg_approved_status==1)
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
                                                                @if($jobUnderCandidateHistoryDetails->clearance->section_approved_status==1)
                                                                    <li class="d-flex justify-content-between w-100">
                                                                        <p>Section | {{$jobUnderCandidateHistoryDetails->clearance->section_name}} (Approved)</p>
                                                                        <p class="p22">{{$jobUnderCandidateHistoryDetails->clearance->section_date}}</p>
                                                                    </li>
                                                                @endif

                                                                @if($jobUnderCandidateHistoryDetails->clearance->translator_approved_status==1)
                                                                    <li class="d-flex justify-content-between w-100">
                                                                        <p>Translator | {{$jobUnderCandidateHistoryDetails->clearance->translator_name}} (Approved)</p>
                                                                        <p class="p22">{{$jobUnderCandidateHistoryDetails->clearance->translator_date}}</p>
                                                                    </li>
                                                                @endif

                                                                @if($jobUnderCandidateHistoryDetails->clearance->ad_approved_status==1)
                                                                    <li class="d-flex justify-content-between w-100">
                                                                        <p>AD | {{$jobUnderCandidateHistoryDetails->clearance->ad_name}} (Approved)</p>
                                                                        <p class="p22">{{$jobUnderCandidateHistoryDetails->clearance->ad_date}}</p>
                                                                    </li>
                                                                @endif

                                                                @if($jobUnderCandidateHistoryDetails->clearance->dd_approved_status==1)
                                                                    <li class="d-flex justify-content-between w-100">
                                                                        <p>DD | {{$jobUnderCandidateHistoryDetails->clearance->dd_name}} (Approved)</p>
                                                                        <p class="p22">{{$jobUnderCandidateHistoryDetails->clearance->dd_date}}</p>
                                                                    </li>
                                                                @endif

                                                                @if($jobUnderCandidateHistoryDetails->clearance->d_approved_status==1)
                                                                    <li class="d-flex justify-content-between w-100">
                                                                        <p>D | {{$jobUnderCandidateHistoryDetails->clearance->d_name}} (Approved)</p>
                                                                        <p class="p22">{{$jobUnderCandidateHistoryDetails->clearance->d_date}}</p>
                                                                    </li>
                                                                @endif

                                                                @if($jobUnderCandidateHistoryDetails->clearance->adg_approved_status==1)
                                                                    <li class="d-flex justify-content-between w-100">
                                                                        <p>ADG | {{$jobUnderCandidateHistoryDetails->clearance->adg_name}} (Approved)</p>
                                                                        <p class="p22">{{$jobUnderCandidateHistoryDetails->clearance->adg_date}}</p>
                                                                    </li>
                                                                @endif

                                                                @if($jobUnderCandidateHistoryDetails->clearance->dg_approved_status==1)
                                                                    <li class="d-flex justify-content-between w-100">
                                                                        <p>DG | {{$jobUnderCandidateHistoryDetails->clearance->dg_name}} (Approved)</p>
                                                                        <p class="p22">{{$jobUnderCandidateHistoryDetails->clearance->dg_date}}</p>
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


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
