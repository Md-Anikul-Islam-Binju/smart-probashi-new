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
                    <h1 class="text-dark fw-bold my-1 fs-3">Application History</h1>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card card-custom gutter-b mb-5">
                <div class="card-body p-0 py-5 px-3">
                    <div class="table-responsive complete_application_table">
                        <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-hover training_table dataTable no-footer dtr-inline" id="kt_datatable">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Application ID</th>
                                            <th class="text-center">Application Date</th>
                                            <th class="text-center">Clearance Type</th>
                                            <th class="text-center">Country</th>
                                            <th class="text-center">Employer Name</th>
                                            <th class="text-center">Application Status</th>
                                            <th width="150" class="text-center">Source</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($jobUnderCandidateHistory as $jobUnderCandidateHistoryData)
                                            <tr>
                                                <td class="text-center">
                                                    {{$jobUnderCandidateHistoryData? $jobUnderCandidateHistoryData->clearance->application_no: ''}}
                                                </td>
                                                <td class="text-center">
                                                    {{ $jobUnderCandidateHistoryData? $jobUnderCandidateHistoryData->clearance->created_at->diffForHumans(): '' }}
                                                </td>
                                                <td class="text-center">
                                                    @if($jobUnderCandidateHistoryData? $jobUnderCandidateHistoryData->clearance->clearance_type == 'individual': '')
                                                        Individual
                                                    @elseif($jobUnderCandidateHistoryData? $jobUnderCandidateHistoryData->clearance->clearance_type == 'group': '')
                                                        Group
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{$jobUnderCandidateHistoryData? $jobUnderCandidateHistoryData->jobManagement->country->country_name: ''}}
                                                </td>

                                                <td class="text-center">
                                                    {{$jobUnderCandidateHistoryData? $jobUnderCandidateHistoryData->jobManagement->employee_name: ''}}
                                                </td>

                                                <td class="text-center">
                                                    @if($jobUnderCandidateHistoryData->clearance->section_approved_status == 1 &&
                                                        $jobUnderCandidateHistoryData->clearance->translator_approved_status == 1 &&
                                                        $jobUnderCandidateHistoryData->clearance->ad_approved_status == 1 &&
                                                        $jobUnderCandidateHistoryData->clearance->dd_approved_status == 1 &&
                                                        $jobUnderCandidateHistoryData->clearance->d_approved_status == 1 &&
                                                        $jobUnderCandidateHistoryData->clearance->adg_approved_status == 1 &&
                                                        $jobUnderCandidateHistoryData->clearance->dg_approved_status == 1 )
                                                        <span class="badge badge-success">Approved</span>
                                                        @else
                                                        <span class="badge badge-danger">Pending</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{$jobUnderCandidateHistoryData? $jobUnderCandidateHistoryData->recruitingAgency->name: ''}}
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group dropstart action_button_wrapper">
                                                        <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-angles-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu action_dropdown_menu">
                                                            <li>
                                                                <a class="dropdown-item" href="{{route('recruiting-agency.application.history.step',$jobUnderCandidateHistoryData->id)}}"><i class="fa-solid fa-eye"></i> View </a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
