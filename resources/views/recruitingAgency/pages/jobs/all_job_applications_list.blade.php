@extends('layouts.recruitingAgency.master')
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
                    <li class="breadcrumb-item text-muted">All Job</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card card-custom">
                <div class="card-body">
                    <div class="table-responsive job_list_table">
                        <div id="posts_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-hover training_table dataTable no-footer dtr-inline" style="margin: 13px 0px !important;" id="kt_datatable" role="grid" aria-describedby="posts_info">
                                        <thead>
                                        <tr role="row">
                                            <th style="min-width: 250px;">
                                                <span class="text-light text-start">Job</span>
                                            </th>
                                            <th class="text-start">
                                                <span class="text-75 text-light">Job Type</span>
                                            </th>
                                            <th class="text-center">
                                                <span class="text-75 text-light">Country</span>
                                            </th>
                                            <th class="text-center">
                                                <span class="text-75 text-light">Post Date</span>
                                            </th>
                                            <th class="text-center" style="min-width: 120px;">
                                                <span class="text-75 text-light">Total Applications</span>
                                            </th>
                                            <th class="text-center" style="min-width: 100px;">
                                                <span class="text-75 text-light">ShortListed</span>
                                            </th>
                                            <th class="text-center" style="min-width: 100px;">
                                                <span class="text-75 text-light">Selected</span>
                                            </th>
                                            <th class="text-center" style="min-width: 100px;">
                                                <span class="text-75 text-light">Action</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($jobs as $key=>$jobsData)
                                            <tr>
                                                <td class="align-items-center" style="padding-left: 10px;">
                                                    <a href="#" class="text-dark-75 text-hover-primary mb-1">{{$jobsData->jobCategory? $jobsData->jobCategory->job_category_name:''}}</a>
                                                </td>
                                                <td class="align-items-center">
                                                    <a href="#" class="text-dark-75 text-hover-primary mb-1">Attested Job</a>
                                                </td>
                                                <td class="align-items-center">
                                                    <div class="text-center">
                                                        <a href="#" class="text-dark-75 text-hover-primary mb-1">{{$jobsData->country? $jobsData->country->country_name:''}}</a>
                                                    </div>
                                                </td>
                                                <td class="align-items-center">
                                                    <div class="text-center">
                                                        <a href="#" class="text-dark-75 text-hover-primary mb-1">{{ date('M d, Y', strtotime($jobsData->created_at)) }}</a>
                                                    </div>
                                                </td>
                                                <td class="align-center">
                                                    <div class="text-center">
                                                        <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg">{{$jobsData->attached_jobs_count}}</a>
                                                    </div>
                                                </td>
                                                <td class="align-center">
                                                    <div class="text-center">
                                                        <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg">{{($jobsData->attached_jobs_count)-(($jobsData->no_of_post)-($jobsData->no_of_post_already_finished))}}</a>
                                                    </div>
                                                </td>
                                                <td class="align-center">
                                                    <div class="text-center">
                                                        <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg">{{($jobsData->no_of_post)-($jobsData->no_of_post_already_finished	)}}</a>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group dropstart action_button_wrapper">
                                                        <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-angles-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu action_dropdown_menu">
                                                            <li>
                                                                <a class="dropdown-item" href="{{route('recruiting-agency.all.applications',$jobsData->id)}}"><i class="fa-solid fa-eye"></i> View </a>
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




