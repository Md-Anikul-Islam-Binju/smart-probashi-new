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
                    <h1 class="text-dark fw-bold my-1 fs-3">Quota Remaining</h1>
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
                                            <th class="text-center">Clearance Type</th>
                                            <th class="text-center">Country</th>
                                            <th class="text-center">Employer Name</th>
                                            <th class="text-center">No. of Posts</th>
                                            <th width="150" class="text-center">Approved</th>
                                            <th width="150" class="text-center">Quota Remaining</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($clearance as $clearanceData)
                                            <tr>
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
                                                    @if($clearanceData->jobClearances->isNotEmpty())
                                                        {{$clearanceData->jobClearances->sum('jobManagement.no_of_post')}}
                                                    @else
                                                        0
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    {{ $clearanceData->candidateClearances->count() }}
                                                </td>

                                                <td class="text-center">
                                                    @if($clearanceData->jobClearances->isNotEmpty())
                                                        {{$clearanceData->jobClearances->sum('jobManagement.no_of_post')- $clearanceData->candidateClearances->count() }}
                                                    @else
                                                        0
                                                    @endif
                                                </td>


                                                <td class="text-center">
                                                    <div class="btn-group dropstart action_button_wrapper">
                                                        <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-angles-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu action_dropdown_menu">
                                                            <li>
                                                                <a class="dropdown-item" href="#"><i class="fa-solid fa-eye"></i> View </a>
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
