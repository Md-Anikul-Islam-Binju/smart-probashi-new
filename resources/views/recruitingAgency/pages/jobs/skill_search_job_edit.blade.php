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
                    <h1 class="text-dark fw-bold my-1 fs-3">
                      skill search</h1>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>

    <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form id="multi-step-form" action="{{route('recruiting-agency.skill.job.update',$job->id)}}" method="post" enctype='multipart/form-data'>
                        @csrf
                        <div id="step-1" class="step">
                            <div class="card">
                                <div class="stepper stepper-links d-flex flex-column">
                                    <div class="mx-auto w-100">
                                        <div class="current">
                                            <div class="w-100">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="category">Category <span style="color: red;">*</span></label>
                                                        <select class="form-select" name="category_id" data-control="select2" data-placeholder="Select job category">
                                                            <option value="{{$job->category_id}}">{{$job->jobCategory?$job->jobCategory->job_category_name:''}}</option>
                                                            @foreach($categories as $categoriesData)
                                                                <option value="{{$categoriesData->id}}">{{$categoriesData->job_category_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span id="categoryIdError" class="error-text"></span>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label for="industry_sector">No of the post / Quantity <span style="color: red;">*</span></label>
                                                        <input class="form-control bg-transparent" type="text" name="no_of_post" value="{{$job->no_of_post}}" placeholder="Please enter number of post"/>
                                                        <span id="no_of_post_error" class="error-text"></span>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <label for="district_id">Description <span style="color: red;">*</span></label>
                                                        <textarea class="form-control bg-transparent" id="description" name="description_en" rows="3" required="" autocomplete="off" spellcheck="false">{{$job->description_en}}</textarea>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label for="district_id">Description (Bangla) <span style="color: red;">*</span></label>
                                                        <textarea class="form-control bg-transparent" id="description" name="description_bn" rows="3" required="" autocomplete="off" spellcheck="false">{{$job->description_bn}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 col-md-6 ">
                                                        <label for="country_id">Country <span style="color: red;">*</span></label>
                                                        <select name="country_id" data-control="select2" class="form-select bg-transparent">
                                                            <option value="{{$job->country_id}}">{{$job->country?$job->country->country_name:''}}</option>
                                                            @foreach($countries as $countriesData)
                                                                <option value="{{$countriesData->id}}">{{$countriesData->country_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span id="country_id_error" class="error-text"></span>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="phone">City</label>
                                                        <input class="form-control bg-transparent" type="text" name="city_name" value="{{$job->city_name}}" placeholder="Please enter city Name"/>
                                                    </div>
                                                </div>



                                                <div class="row">
                                                    <div class="d-flex flex-stack justify-content-end pt-1">
                                                        <button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
