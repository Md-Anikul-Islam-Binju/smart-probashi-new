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
                    <h1 class="text-dark fw-bold my-1 fs-3">BMET Clearance</h1>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card card-custom gutter-b mb-5">
                <div class="card-body p-0 py-5 px-3">
                    <div class="row">
                        <div class="col-md-8 offset-md-2 text-center">
                            <a data-bs-toggle="modal" data-bs-target="#newClearenceApplicationModal" data-bs-toggle="modal" href="#" class="new_bmet_clearance_btn">Start new BMET Clearance Application</a>
                        </div>

                    </div>
                    <div class="post-search-panel">
                        <div class="row mb-4">
                            <div class="col-12 col-md-5 mb-md-0 mb-8">
                                <div class="filter">
                                    <span>Filter by</span>
                                </div>
                                <div class="dropdown custom_filter">
                                    <a href="#" class="btn btn-outline-secondary filter_button dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Filter by <i class="fas fa-align-center icon-xs text-end color_117D7C"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-lg custom-filter" style="width: 100%">
                                        <form class="px-8 py-8">
                                            <div class="form-group">
                                                <select id="job_type" name="job_type" class="form-control">
                                                    <option value="">Clearance Type</option>
                                                    <option value="">One Stop Clearance</option>
                                                    <option value="">Individual(1-24)</option>
                                                    <option value="">Group Clearance</option>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <select id="approve_status" name="approve_status" class="form-control">
                                                            <option value="">Please Select a country</option>
                                                            <option value="0">Bangladesh</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block" id="filter_submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-center p-5">Draft Clearance Application</h3>
                    <div class="table-responsive complete_application_table">
                        <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-hover training_table dataTable no-footer dtr-inline" id="kt_datatable">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Application ID</th>
                                            <th class="text-center">Country</th>
                                            <th class="text-center">Employer Name</th>
                                            <th class="text-center">Clearance Type</th>
                                            <th class="text-center">No. of Jobs</th>
                                            <th class="text-center">Users Type and Names</th>
                                            <th class="text-center">Total Posts</th>
                                            <th width="150" class="text-center">Total Draft Candidates</th>
                                            <th width="180" class="text-center">Completed Candidates Information</th>
                                            <th class="text-center">Application Start Date</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($clearance as $clearanceData)
                                        <tr>
                                            <td class="text-center">{{$clearanceData->application_no}}</td>
                                            <td class="text-center">{{$clearanceData->country->country_name}}</td>
                                            <td class="text-center">
                                                @if($clearanceData->jobClearances->isNotEmpty())
                                                    @foreach($clearanceData->jobClearances as $jobClearance)
                                                        {{$jobClearance->jobManagement->employee_name}},
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($clearanceData->clearance_type == 'individual')
                                                    Individual
                                                @elseif($clearanceData->clearance_type == 'group')
                                                    Group
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($clearanceData->jobClearances->isNotEmpty())
                                                    {{$clearanceData->jobClearances->count('jobManagement.id')}}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td class="text-center">{{$clearanceData->recruitingAgency->name}}</td>
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
                                                {{ $clearanceData->candidateClearances->count() }}
                                            </td>
                                            <td class="text-center">
                                                {{ $clearanceData->created_at->diffForHumans() }}
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group dropstart action_button_wrapper">
                                                    <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-angles-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu action_dropdown_menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{route('recruiting-agency.bmet.clearance.application.step',$clearanceData->id)}}"><i class="fa-solid fa-eye"></i> Continue </a>
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
    {{-- New BMET Clearance Application Modal --}}
    <div class="modal fade" tabindex="-1" id="newClearenceApplicationModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header row">
                    <div class="col-10 offset-1 text-center">
                        <h5 class="modal-title custom_modal_title">
                            New BMET Clearance Application
                        </h5>
                    </div>
                    <div class="col-12 col-md-1 text-right">
                        <a href="#" data-bs-dismiss="modal" aria-label="Close" class="text-right pt-3 pr-3">
                            <img src="{{ URL::to('assets/media/close.png') }}" alt="Close" style="height: 20px; margin-top: -25px; margin-right: -20px;">
                        </a>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{route('recruiting-agency.bmet.clearance.new.application.info.store')}}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <select name="country_id" class="form-select" data-dropdown-parent="#newClearenceApplicationModal" data-control="select2" tabindex="-1" data-placeholder="Please Select a country">
                                <option>Please Select a country</option>
                                @foreach($country as $countryData)
                                <option value="{{$countryData->id}}">{{$countryData->country_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <select name="clearance_type" class="form-control" id="clearanceType" onchange="toggleGroup()">
                                <option value=""> Select clearance type </option>
                                <option value="individual">Individual (1-24)</option>
{{--                                <option value="group">Group</option>--}}
                            </select>
                        </div>
                        <div id="group" style="display:none;">
                            <div class="form-group mb-3">
                                <select name="foreign_ref_no" class="form-select" data-dropdown-parent="#newClearenceApplicationModal" data-control="select2" tabindex="-1" data-placeholder="Select foreign ref no">

                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <input type="date" name="foreign_ref_date" placeholder="Foreign Reference Date" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control bg-transparent" type="text" name="ministry_ref_no" placeholder="Ministry Reference No" autocomplete="off">
                            </div>
                            <div class="form-group mb-3">
                                <input type="date" name="ministry_ref_date" placeholder="Ministry Reference Date" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <input  class="form-control bg-transparent" type="text" name="bmet_reference_no" placeholder="BMET Reference No" autocomplete="off">
                            </div>
                            <div class="form-group mb-3">
                                <input type="date" name="bmet_reference_date" placeholder="BMET Reference Date" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary">Close</button>
                            <button class="btn px-5 btn-position mr-5 btn-primary"> Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleGroup() {
            var clearanceType = document.getElementById('clearanceType');
            var groupDiv = document.getElementById('group');

            if (clearanceType.value === 'Group') {
                groupDiv.style.display = 'block';
            } else {
                groupDiv.style.display = 'none';
            }
        }
        // File Upload
        function uploadFile(inputId) {
            document.getElementById(inputId).click();
        }
        document.getElementById('job-proof-1-0').addEventListener('change', function (event) {
            handleFileSelect(event, 'file-info-job-proof-1-0');
        });
        document.getElementById('employment-contract-1-1').addEventListener('change', function (event) {
            handleFileSelect(event, 'file-info-employment-contract-1-1');
        });
        document.getElementById('bhc-mail-1-2').addEventListener('change', function (event) {
            handleFileSelect(event, 'file-info-bhc-mail-1-2');
        });
        function handleFileSelect(event, fileInfoId) {
            const selectedFile = event.target.files[0];
            const fileInfoElement = document.getElementById(fileInfoId);

            if (selectedFile) {
                fileInfoElement.textContent = selectedFile.name;
            } else {
                fileInfoElement.textContent = '';
            }
        }
    </script>
@endsection
