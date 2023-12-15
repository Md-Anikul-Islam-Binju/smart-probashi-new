@extends('layouts.recruitingAgency.master')
@section('content')
    <style>
        /* Add your CSS styles here */
        #step-tabs {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        #step-tabs li {
            flex: 1;
            text-align: center;
            padding: 20px 40px;
            border: 1px solid #f3f6f9;
            background-color: #f3f6f9;
            color: #80808f;
            font-size: 1.25rem;
            font-weight: 700;
            border-radius: 10px;
        }

        #step-tabs li.active {
            background-color: #009ef724;
            color: #009ef7;
            cursor: pointer;
        }

    </style>


    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid">
            <div class="row align-items-center">
                <div class="col-4">
                    <a href="#" class="btn btn-primary">
                        <i class="ki-duotone ki-left"></i>Back</a>
                </div>
                <div class="col-4 text-center">
                    <h1 class="text-dark fw-bold my-1 fs-3">New Job</h1>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>

    <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form id="multi-step-form" action="{{route('recruiting-agency.job.update',$job->id)}}" method="post" enctype='multipart/form-data'>
                        @csrf
                        <ul id="step-tabs">
                            <li class="active">Job Information</li>
                            <li>Salary and benefits</li>
                            <li>Documents upload</li>
                            <li>General requirements</li>
                        </ul>

                        <!-- Step 1: Name and Phone -->
                        <div id="step-1">
                            <div class="card">
                                <div class="stepper stepper-links d-flex flex-column">
                                    <div class="mx-auto w-100">
                                        <div class="current">
                                            <div class="w-100">
                                                <div class="row">
                                                    <div class="col-12 col-md-4 mb-4">
                                                        <label for="category">Category <span style="color: red;">*</span></label>
                                                        <select class="form-select" name="category_id" data-control="select2" data-placeholder="Select job category">
                                                            <option value="{{$job->category_id}}">{{$job->jobCategory?$job->jobCategory->job_category_name:''}}</option>
                                                            @foreach($categories as $categoriesData)
                                                                <option value="{{$categoriesData->id}}">{{$categoriesData->job_category_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-4 mb-4">
                                                        <label for="industry_sector">Industry/Sector</label>
                                                        <select class="form-select" name="sector" data-control="select2" data-hide-search="true" data-placeholder="Select Industry/Sector">
                                                            <option value="{{$job->sector}}">{{ ucfirst(strtolower($job->sector)) }}</option>
                                                            <option value="general">General</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-4 mb-4">
                                                        <label for="industry_sector">No of the post / Quantity</label>
                                                        <input class="form-control bg-transparent" type="text" name="no_of_post" value="{{$job->no_of_post}}" placeholder="Please enter number of post"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-3 mb-4">
                                                        <label for="phone">Employer Name <span style="color: red;">*</span></label>
                                                        <input class="form-control bg-transparent" type="text" name="employee_name" value="{{$job->employee_name}}" placeholder="Please enter Employer Name"/>
                                                    </div>
                                                    <div class="col-12 col-md-3 mb-4">
                                                        <label for="division_id">Country <span style="color: red;">*</span></label>
                                                        <select name="country_id" data-control="select2" class="form-select bg-transparent">
                                                            <option value="{{$job->country_id}}">{{$job->country?$job->country->country_name:''}}</option>
                                                            @foreach($countries as $countriesData)
                                                                <option value="{{$countriesData->id}}">{{$countriesData->country_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-3 mb-4">
                                                        <label for="phone">City</label>
                                                        <input class="form-control bg-transparent" type="text" name="city_name" value="{{$job->city_name}}" placeholder="Please enter city Name"/>
                                                    </div>

                                                    <div class="col-12 col-md-3 mb-4">
                                                        <label for="phone">Bmet Reference No</label>
                                                        <input class="form-control bg-transparent" type="text" name="bmet_reference_no" value="{{$job->bmet_reference_no}}" placeholder="Please enter Bmet Reference No"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-3 mb-4">
                                                        <label for="phone">Foreign Reference No</label>
                                                        <input class="form-control bg-transparent" type="text" name="foreign_reference_no" value="{{$job->foreign_reference_no}}" placeholder="Please enter Foreign Reference No"/>
                                                    </div>
                                                    <div class="col-12 col-md-3 mb-4">
                                                        <label for="division_id">Foreign Reference Date</label>
                                                        <input class="form-control bg-transparent" type="date" name="foreign_reference_date" value="{{$job->foreign_reference_date}}" placeholder="Please enter Foreign Reference No"/>
                                                    </div>
                                                    <div class="col-12 col-md-3 mb-4">
                                                        <label for="phone">Ministry Reference No</label>
                                                        <input class="form-control bg-transparent" type="text" name="ministry_reference_no" value="{{$job->ministry_reference_no}}" placeholder="Please enter Ministry Reference No"/>
                                                    </div>

                                                    <div class="col-12 col-md-3 mb-4">
                                                        <label for="phone">Ministry Reference Date</label>
                                                        <input class="form-control bg-transparent" type="date" name="ministry_reference_date" value="{{$job->ministry_reference_date}}" placeholder="Please enter Ministry Reference Date"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="district_id">Skill type <span style="color: red;">*</span></label>
                                                        <select name="skill_type" data-control="select2" class="form-select bg-transparent" data-hide-search="true">
                                                            <option value="{{$job->skill_type}}">{{ ucfirst(strtolower($job->skill_type)) }}</option>
                                                            <option value="general">General</option>
                                                            <option value="skilled">Skilled</option>
                                                            <option value="unskilled">Unskilled</option>
                                                            <option value="professional">Professional</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <label for="gender">Gender type <span style="color: red;">*</span></label>
                                                                <select name="gender" data-control="select2" class="form-select bg-transparent" data-hide-search="true">


                                                                    @if($job->gender==1)
                                                                        <option selected value="{{$job->gender}}">Male</option>
                                                                    @elseif($job->gender==2)
                                                                        <option selected value="{{$job->gender}}">Female</option>
                                                                    @else
                                                                        <option selected value="{{$job->gender}}">Both</option>
                                                                    @endif

                                                                    <option value="1">Male</option>
                                                                    <option value="2">Female</option>
                                                                    <option value="3">Both</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <label for="upazilla_id">Age range <span style="color: red;">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control bg-transparent" name="min_age" min="18" max="70" placeholder="min" value="{{$job->min_age}}">
                                                                    <input type="number" class="form-control bg-transparent" name="max_age" min="18" max="70" placeholder="max" value="{{$job->max_age}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="district_id">Description <span style="color: red;">*</span></label>
                                                        <textarea class="form-control bg-transparent" id="description" name="description_en" rows="3" required="" autocomplete="off" spellcheck="false">{{$job->description_en}}</textarea>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="district_id">Description (Bangla) <span style="color: red;">*</span></label>
                                                        <textarea class="form-control bg-transparent" id="description" name="description_bn" rows="3" required="" autocomplete="off" spellcheck="false">{{$job->description_bn}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="d-flex flex-stack pt-15">
                                                        <div class="mr-2">
                                                            <button type="button" onclick="prevStep(1)" class="btn d-none btn-lg btn-light-primary me-3 previous_btn_style">
                                                                <i class="ki-outline ki-arrow-left fs-4 me-1"></i> Previous
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <button type="button" onclick="nextStep(1)" class="btn btn-lg btn-primary">
                                                                Next <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Address and Age -->
                        <div id="step-2" style="display: none;">
                            <div class="card">
                                <div class="stepper stepper-links d-flex flex-column">
                                    <div class="mx-auto w-100">
                                        <div class="current">
                                            <div class="w-100">
                                                <div class="row">
                                                    <div class="col-12 col-md-4 mb-4">
                                                        <label for="industry_sector">Salary <span style="color: red;">*</span></label>
                                                        <input class="form-control bg-transparent" type="text" name="salary_amount"  value="{{$job->salary_amount}}" placeholder="Please enter salary amount"/>
                                                    </div>
                                                    <div class="col-12 col-md-4 mb-4">
                                                        <label for="currency">Currency type <span style="color: red;">*</span></label>
                                                        <select class="form-select" name="currency_id" data-control="select2" data-placeholder="Select Currency type">
                                                            <option value="{{$job->currency_id}}">{{$job->country->currency_name}}</option>
                                                            @foreach($countries as $countriesData)
                                                                <option value="{{$countriesData->id}}">{{$countriesData->currency_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-4 mb-4">
                                                        <label for="industry_sector">Salary per <span style="color: red;">*</span></label>
                                                        <select class="form-select" name="salary_per" data-control="select2" data-hide-search="true" data-placeholder="Select time period">
                                                            <option value="{{$job->salary_per}}">{{ ucfirst(strtolower($job->salary_per)) }}</option>
                                                            <option value="month">Month</option>
                                                            <option value="year">Year</option>
                                                            <option value="hour">Hour</option>
                                                            <option value="day">Day</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label>Other benefits provided by employer </label>
                                                    <div class="form-group row">
                                                        <div class="col-lg-4">
                                                            <input type="checkbox" id="is_accommodation" value="1"  name="is_accommodation"  {{ $job->is_accommodation == 1 ? 'checked' : '' }}>
                                                            <label for="is_accommodation">Accommodation</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input type="checkbox" id="is_food" value="1" name="is_food"  {{ $job->is_food == 1 ? 'checked' : '' }}>
                                                            <label for="is_food">Kitchen/Food facility</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input type="checkbox" id="is_transport" value="1" name="is_transport" {{ $job->is_transport == 1 ? 'checked' : '' }}>
                                                            <label for="is_transport">Transportation</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input type="checkbox" id="is_medical" value="1" name="is_medical" {{ $job->is_medical == 1 ? 'checked' : '' }}>
                                                            <label for="is_medical">Medical benefits</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input type="checkbox" id="is_visa" value="1" name="is_visa" {{ $job->is_visa == 1 ? 'checked' : '' }}>
                                                            <label for="is_visa">Visa</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input type="checkbox" id="is_insurance" value="1" name="is_insurance" {{ $job->is_insurance == 1 ? 'checked' : '' }}>
                                                            <label for="is_insurance">Insurance premium</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="d-flex flex-stack pt-15">
                                                        <div class="mr-2">
                                                            <button type="button" onclick="prevStep(2)" class="btn btn-lg btn-light-primary me-3 previous_btn_style">
                                                                <i class="ki-outline ki-arrow-left fs-4 me-1"></i> Previous
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <button type="button" onclick="nextStep(2)" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
                                                                Next <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Status and NID -->
                        <div id="step-3" style="display: none;">
                            <div class="card">
                                <div class="stepper stepper-links d-flex flex-column">
                                    <div class="mx-auto w-100">
                                        <div class="current">
                                            <div class="w-100">
                                                <div class="row">
                                                    <div class="col-xxl-4 col-md-6 mb-5" id="employement_letter_div">
                                                        <div class="itemPost d-flex justify-content-between p-5 ">
                                                            <div class="leftItem">
                                                                <div class="con_item d-flex">
                                                                    <img style="width: 60px" src="https://moewoe.amiprobashi.com/public/img/icon/2.png" alt="">
                                                                    <div class="conDesc ms-3">
                                                                        <h6 class="">Employment permit</h6>
                                                                        <div class="file-input-container">
                                                                            <input type="file" name="employment_permit_file" class="job_documents_file_upload" id="fileInput">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="rightItem">
                                                                <img id="employement_letter_img" style="width: 60px" src="{{asset('assets/media/svg/files/pdf.svg')}}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-4 col-md-6 mb-5" id="demand_letter_div">
                                                        <div class="itemPost d-flex justify-content-between p-5">
                                                            <div class="leftItem">
                                                                <div class="con_item d-flex">
                                                                    <img style="width: 60px" src="https://moewoe.amiprobashi.com/public/img/icon/2.png" alt="">
                                                                    <div class="conDesc ms-3">
                                                                        <h6 class="">Demand Letter</h6>
                                                                        <div class="file-input-container">
                                                                            <input type="file" name="demand_latter_file" class="job_documents_file_upload" id="fileInput">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="rightItem">
                                                                <img id="demand_letter_img" style="width: 60px" src="{{asset('assets/media/svg/files/doc.svg')}}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-4 col-md-6 mb-5" id="work_agreement_div">
                                                        <div class="itemPost d-flex justify-content-between p-5">
                                                            <div class="leftItem">
                                                                <div class="con_item d-flex">
                                                                    <img style="width: 60px" src="https://moewoe.amiprobashi.com/public/img/icon/4.png" alt="">
                                                                    <div class="conDesc ms-3">
                                                                        <h6 class="">Work Agreement</h6>
                                                                        <div class="file-input-container">
                                                                            <input type="file" name="work_agreement_file" class="job_documents_file_upload" id="fileInput">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="rightItem">
                                                                <img id="work_agreement_img" style="width: 60px" src="{{asset('assets/media/svg/files/doc.svg')}}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-4 col-md-6 mb-5" id="others_div">
                                                        <div class="itemPost d-flex justify-content-between p-5">
                                                            <div class="leftItem">
                                                                <div class="con_item d-flex">
                                                                    <img style="width: 60px" src="https://moewoe.amiprobashi.com/public/img/icon/4.png" alt="">
                                                                    <div class="conDesc ms-3">
                                                                        <h6 class="">Other Documents</h6>
                                                                        <div class="file-input-container">
                                                                            <input type="file" name="other_file" class="job_documents_file_upload" id="fileInput">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="rightItem">
                                                                <img id="others_img" style="width: 60px" src="{{asset('assets/media/svg/files/doc.svg')}}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="d-flex flex-stack pt-15">
                                                        <div class="mr-2">
                                                            <button type="button" onclick="prevStep(3)" class="btn btn-lg btn-light-primary me-3 previous_btn_style">
                                                                <i class="ki-outline ki-arrow-left fs-4 me-1"></i> Previous
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <button type="button" onclick="nextStep(3)" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
                                                                Next <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Additional Step -->
                        <div id="step-4" style="display: none;">
                            <div class="card">
                                <div class="stepper stepper-links d-flex flex-column">
                                    <div class="mx-auto w-100">
                                        <div class="current">
                                            <div class="w-100">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="industry_sector">Contract tenure (in years) <span style="color: red;">*</span></label>
                                                        <input class="form-control bg-transparent" type="text" name="contract_tenure" value="{{$job->contract_tenure}}" placeholder="Please enter Contract tenure in number e.g: 30"/>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="industry_sector">Probation <span style="color: red;">*</span></label>
                                                        <select class="form-select" name="probation_period" data-hide-search="true" data-placeholder="Not Applicable">
                                                            <option value="{{$job->probation_period}}">{{$job->probation_period}} Months</option>
                                                            <option value="3">3 Months</option>
                                                            <option value="4">4 Months</option>
                                                            <option value="6">6 Months</option>
                                                            <option value="9">9 Months</option>
                                                            <option value="12">12 Months</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="district_id">Requirements:</label>
                                                        <textarea class="form-control bg-transparent" id="description" name="requirements_details" rows="2" required="" autocomplete="off" spellcheck="false">{{$job->requirements_details}}
                                                        </textarea>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="district_id">Other benefits:</label>
                                                        <textarea class="form-control bg-transparent" id="description" name="benefits_details" rows="2" required="" autocomplete="off" spellcheck="false">{{$job->benefits_details}}
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="district_id">Conditions:</label>
                                                        <textarea class="form-control bg-transparent" id="description" name="condition_details" rows="2" required="" autocomplete="off" spellcheck="false">{{$job->condition_details}}
                                                        </textarea>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="district_id">Charge and additional cost:</label>
                                                        <textarea class="form-control bg-transparent" id="description" name="additional_details" rows="2" required="" autocomplete="off" spellcheck="false">{{$job->additional_details}}
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="division_id">Application deadline</label>
                                                        <input class="form-control bg-transparent" type="date" name="application_deadline" value="{{$job->application_deadline}}" />
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="division_id">Employer deadline</label>
                                                        <input class="form-control bg-transparent" type="date" name="employer_deadline" value="{{$job->employer_deadline}}" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="d-flex flex-stack pt-15">
                                                        <div class="mr-2">
                                                            <button type="button" onclick="prevStep(4)" class="btn btn-lg btn-light-primary me-3 previous_btn_style">
                                                                <i class="ki-outline ki-arrow-left fs-4 me-1"></i> Previous
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
                                                                Submit
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Wrapper-->
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



    <script>


        function nextStep(step) {
            var currentStep = document.getElementById('step-' + step);
            var nextStep = document.getElementById('step-' + (step + 1));
            var currentTab = document.querySelectorAll('#step-tabs li')[step - 1];
            var nextTab = document.querySelectorAll('#step-tabs li')[step];

            if (currentStep && nextStep) {
                currentStep.style.display = 'none';
                nextStep.style.display = 'block';
                currentTab.classList.remove('active');
                nextTab.classList.add('active');
            }
        }

        function prevStep(step) {
            var currentStep = document.getElementById('step-' + step);
            var prevStep = document.getElementById('step-' + (step - 1));
            var currentTab = document.querySelectorAll('#step-tabs li')[step - 1];
            var prevTab = document.querySelectorAll('#step-tabs li')[step - 2];

            if (currentStep && prevStep) {
                currentStep.style.display = 'none';
                prevStep.style.display = 'block';
                currentTab.classList.remove('active');
                prevTab.classList.add('active');
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const stepTabs = document.querySelectorAll("#step-tabs li");
            const nextButton = document.getElementById("next-button");
            let currentStep = 0;

            nextButton.addEventListener("click", function () {
                stepTabs[currentStep].classList.remove("active");
                currentStep++;

                if (currentStep >= stepTabs.length) {
                    currentStep = 0; // Reset to the first step
                }

                stepTabs[currentStep].classList.add("active");
            });
        });

    </script>

@endsection
