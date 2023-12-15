@extends('layouts.recruitingAgency.master')
@section('content')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
                <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3">Smart Probashi</h1>
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/" class="text-muted text-hover-primary">DASHBOARD</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Talent Pool Search</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid">
        <div class="container-fluid">
            <form method="GET" action="{{route('recruiting-agency.talent.skill.search.result')}}" enctype="multipart/form-data">
                @csrf
                <div class="card mb-2">
                    <div class="collapse show">
                        <div class="card-body border-top p-9">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Skills <span style="color: red;">*</span></label>
                                    <select  name="job_category_name" class="form-select bg-transparent" >
                                        <option value="">Select Skills</option>
                                        @foreach($jobCategories as $jobCategoriesData)
                                        <option value="{{$jobCategoriesData->job_category_name}}">{{$jobCategoriesData->job_category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Countries <span style="color: red;">*</span></label>
                                    <select  name="desired_currency_id" class="form-select bg-transparent">
                                        <option value="">Select Countries</option>
                                        @foreach($country as $countryData)
                                            <option value="{{$countryData->id}}">{{$countryData->country_name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Gender <span style="color: red;">*</span></label>
                                    <select  name="gender"  class="form-select bg-transparent @error('district_id') is-invalid @enderror" >
                                        <option value="">Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Education level <span style="color: red;">*</span></label>
                                    <select  name="education" class="form-select bg-transparent" >
                                        <option value="">Select Education level</option>
                                        @foreach($education as $educationData)
                                            <option value="{{$educationData->education_level_name}}">{{$educationData->education_level_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Max Age<span style="color: red">*</span></label>
                                    <input type="number" name="min_age" class="form-control" placeholder="Enter Max Age"/>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Min Age<span style="color: red">*</span></label>
                                    <input type="number" name="max_age" class="form-control" placeholder="Enter Min Age"/>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Employment status<span style="color: red;">*</span></label>
                                    <select  name="status" class="form-select bg-transparent " >
                                        <option value="">Select Employment status</option>
                                        <option value="2">YES</option>
                                        <option value="1">NO</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Passport status<span style="color: red;">*</span></label>
                                    <select  name="registration_status"  class="form-select bg-transparent" >
                                        <option value="">Select Passport status</option>
                                        <option value="1">YES</option>
                                        <option value="0">NO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex mt-5 justify-content-end">
                            <button type="submit" class="btn btn-primary me-2">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
