@extends('layouts.foreignMinistry.master')
@section('content')

    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif
    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif

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
                    <li class="breadcrumb-item text-muted">Board</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card card-flush">
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="">
                        <form action="{{ route('foreign-ministry.job.management') }}" method="GET" >
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label class="d-block" for="job_type">
                                            <strong>Job Type</strong>
                                        </label>
                                        <select id="job_type" name="job_type" class="form-control">
                                            <option value="">All job type</option>
                                            <option value="attested" @if(request('job_type') == 'attested') selected @endif>Attested Job</option>
                                            <option value="skill_search" @if(request('job_type') == 'skill_search') selected @endif>Skill Search</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label class="d-block" for="job_category">
                                            <strong>Job Category</strong>
                                        </label>
                                        <select id="job_category" name="job_category" class="form-control">

                                            <option value="">All job categories</option>
                                            @foreach($jobCategories as $category)
                                                <option value="{{ $category->id }}" @if(request('job_category') == $category->id) selected @endif>{{ $category->job_category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label class="d-block" for="job_category">
                                            <strong>Country</strong>
                                        </label>
                                        <select id="country" name="country" class="form-control">
                                            <option value="">All Country</option>
                                            @foreach($country as $countryData)
                                                <option value="{{ $countryData->id }}" @if(request('country') == $countryData->id) selected @endif>{{ $countryData->country_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 mt-3">
                                    <button type="submit" class="btn btn-primary" id="filter_submit">Filter</button>
                                </div>
                            </div>
                        </form>
                        <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th>S/N</th>
                            <th>Job Title</th>
                            <th>No Of Post</th>
                            <th>Salary</th>
                            <th>Job Location</th>
                            <th>Foreign Ref. No.</th>
                            <th>Application Date</th>
                            <th>Status</th>
                            <th>Job Type</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        @foreach($jobs as $key=>$jobsData)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$jobsData->jobCategory? $jobsData->jobCategory->job_category_name:'N/A'}}</td>
                                <td>{{$jobsData->no_of_post}}</td>
                                <td>{{$jobsData->salary_amount}}/Month</td>
                                <td>{{$jobsData->country? $jobsData->country->country_name:'N/A'}}</td>
                                <td>
                                    @if($jobsData->job_type == 'attested')
                                        {{$jobsData->foreign_reference_no}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($jobsData->application_deadline)->format('d F Y') }}</td>
                                <td>
                                    @if($jobsData->status == 0)
                                        <div class="badge badge-light-danger">Pending</div><br>
                                        <div class="badge badge-light-danger">Unpublished</div>
                                    @elseif($jobsData->status == 1 || $jobsData->status == 2)
                                        <div class="badge badge-light-danger">Pending</div><br>
                                        <div class="badge badge-light-success">Published</div>
                                    @elseif($jobsData->status == 3)
                                        <div class="badge badge-light-success">Approved</div>
                                    @endif
                                </td>
                                <td>
                                    @if($jobsData->job_type == 'attested')
                                        Attested Job
                                    @else
                                        Skill Search
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm"  href="{{route('foreign-ministry.job.details',$jobsData->id)}}">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
