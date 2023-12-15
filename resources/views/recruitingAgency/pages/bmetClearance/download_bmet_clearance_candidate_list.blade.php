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
                    <h1 class="text-dark fw-bold my-1 fs-3">Download BMET Clearance</h1>
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
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Passport No.</th>
                                            <th class="text-center">Registration ID.</th>
                                            <th width="150" class="text-center">Job</th>
                                            <th width="180" class="text-center">Applied Date</th>
                                            <th width="180" class="text-center">Clearance Date</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($clearance->candidateClearances as $clearanceData)
                                            <tr>
                                                <td class="text-center">{{$clearanceData->passportInfo->full_name}}</td>
                                                <td class="text-center">
                                                    {{$clearanceData->passportInfo->passport_no}}
                                                </td>
                                                <td class="text-center">
                                                    {{$clearanceData->passportInfo->verificationInfo->bmet_verification_registration_no}}
                                                </td>

                                                <td class="text-center">
                                                    {{$clearanceData->job->jobCategory->job_category_name}}
                                                </td>
                                                <td class="text-center">
                                                    {{ $clearanceData->created_at->format('d F Y') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $clearance->dg_date }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group dropstart action_button_wrapper">
                                                        <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-angles-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu action_dropdown_menu">
                                                            <li>
                                                                <a class="dropdown-item" target="_blank" href="{{route('recruiting-agency.print.candidate.applications',$clearanceData->id)}}"><i class="fa-solid fa-eye"></i> Card Print </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{route('recruiting-agency.download.candidate.card',$clearanceData->id)}}"><i class="fa-solid fa-download"></i> Download Card </a>
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
