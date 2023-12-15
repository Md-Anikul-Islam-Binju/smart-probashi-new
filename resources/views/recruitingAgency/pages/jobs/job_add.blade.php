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
                    <form id="multi-step-form" action="{{route('recruiting-agency.job.store')}}" method="post" enctype='multipart/form-data'>
                        @csrf
                        <ul id="jobManagment_step_tabs">
                            <li class="active">Job Information</li>
                            <li>Salary and benefits</li>
                            <li>Documents upload</li>
                            <li>General requirements</li>
                        </ul>

                        <!-- Step 1: Name and Phone -->
                        <div id="step-1" class="step">
                            <div class="card">
                                <div class="stepper stepper-links d-flex flex-column">
                                    <div class="mx-auto w-100">
                                        <div class="current">
                                            <div class="w-100">
                                                <div class="row">
                                                    <div class="col-12 col-md-4 mb-4">
                                                        <label for="category">Category <span style="color: red;">*</span></label>
                                                        <select class="form-select" name="category_id" data-control="select2" data-placeholder="Select job category">
                                                            <option>Select Category</option>
                                                            @foreach($categories as $categoriesData)
                                                            <option value="{{$categoriesData->id}}">{{$categoriesData->job_category_name}}</option>
                                                            @endforeach
                                                        </select>
														<span id="categoryIdError" class="error-text"></span>
                                                    </div>
                                                    <div class="col-12 col-md-4 mb-4">
                                                        <label for="industry_sector">Industry/Sector</label>
                                                        <select class="form-select" name="sector" data-control="select2" data-hide-search="true" data-placeholder="Select Industry/Sector">
                                                            <option></option>
                                                            <option value="general">General</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-4 mb-4">
                                                        <label for="industry_sector">No of the post / Quantity <span style="color: red;">*</span></label>
                                                        <input class="form-control bg-transparent" type="text" name="no_of_post" placeholder="Please enter number of post"/>
														<span id="no_of_post_error" class="error-text"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-3 mb-4">
                                                        <label for="employee_name">Employer Name <span style="color: red;">*</span></label>
                                                        <input class="form-control bg-transparent" type="text" name="employee_name" placeholder="Please enter Employer Name"/>
														<span id="employee_name_error" class="error-text"></span>
                                                    </div>
                                                    <div class="col-12 col-md-3 mb-4">
                                                        <label for="country_id">Country <span style="color: red;">*</span></label>
                                                        <select name="country_id" data-control="select2" class="form-select bg-transparent">
                                                            @foreach($countries as $countriesData)
                                                            <option value="{{$countriesData->id}}">{{$countriesData->country_name}}</option>
                                                            @endforeach
                                                        </select>
														<span id="country_id_error" class="error-text"></span>
                                                    </div>
                                                    <div class="col-12 col-md-3 mb-4">
                                                        <label for="phone">City</label>
                                                        <input class="form-control bg-transparent" type="text" name="city_name" placeholder="Please enter city Name"/>
                                                    </div>

                                                    <div class="col-12 col-md-3 mb-4">
                                                        <label for="phone">Bmet Reference No</label>
                                                        <input class="form-control bg-transparent" type="text" name="bmet_reference_no" placeholder="Please enter Bmet Reference No"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-3 mb-4">
                                                        <label for="phone">Foreign Reference No</label>
                                                        <input class="form-control bg-transparent" type="text" name="foreign_reference_no" placeholder="Please enter Foreign Reference No"/>
                                                    </div>
                                                    <div class="col-12 col-md-3 mb-4">
                                                        <label for="division_id">Foreign Reference Date</label>
                                                        <input class="form-control bg-transparent" type="date" name="foreign_reference_date" placeholder="Please enter Foreign Reference No"/>
                                                    </div>
                                                    <div class="col-12 col-md-3 mb-4">
                                                        <label for="phone">Ministry Reference No</label>
                                                        <input class="form-control bg-transparent" type="text" name="ministry_reference_no" placeholder="Please enter Ministry Reference No"/>
                                                    </div>

                                                    <div class="col-12 col-md-3 mb-4">
                                                        <label for="phone">Ministry Reference Date</label>
                                                        <input class="form-control bg-transparent" type="date" name="ministry_reference_date" placeholder="Please enter Ministry Reference Date"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="skill_type">Skill type <span style="color: red;">*</span></label>
                                                        <select name="skill_type" data-control="select2" class="form-select bg-transparent" data-hide-search="true">
                                                            <option value="general">General</option>
                                                            <option value="skilled">Skilled</option>
                                                            <option value="unskilled">Unskilled</option>
                                                            <option value="professional">Professional</option>
                                                        </select>
														<span id="skill_type_error" class="error-text"></span>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <label for="gender">Gender type <span style="color: red;">*</span></label>
                                                                <select name="gender" data-control="select2" class="form-select bg-transparent" data-hide-search="true">
                                                                    <option value="1">Male</option>
                                                                    <option value="2">Female</option>
                                                                    <option value="3">Others
                                                                    </option>
                                                                </select>
																<span id="gender_error" class="error-text"></span>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <label for="upazilla_id">Age range</label>
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control bg-transparent" name="min_age" min="18" max="70" placeholder="min" value="18">
                                                                    <input type="number" class="form-control bg-transparent" name="max_age" min="18" max="70" placeholder="max" value="30">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="district_id">Description <span style="color: red;">*</span></label>
                                                        <textarea class="form-control bg-transparent" id="description" name="description_en" rows="3" autocomplete="off" spellcheck="false"></textarea>
														<span id="description_en_error" class="error-text"></span>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="district_id">Description (Bangla) <span style="color: red;">*</span></label>
                                                        <textarea class="form-control bg-transparent" id="description" name="description_bn" rows="3" autocomplete="off" spellcheck="false"></textarea>
														<p id="description_bn_error" class="error-text"></p>
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
                                                            <button type="button" onclick="validateStep(1)" class="btn btn-lg btn-primary">
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
                        <div id="step-2" class="step" style="display: none;">
                            <div class="card">
                                <div class="stepper stepper-links d-flex flex-column">
                                    <div class="mx-auto w-100">
                                        <div class="current">
                                            <div class="w-100">
                                                <div class="row">
                                                    <div class="col-12 col-md-4 mb-4">
                                                        <label for="salary_amount">Salary <span style="color: red;">*</span></label>
                                                        <input class="form-control bg-transparent" type="text" name="salary_amount" placeholder="Please enter salary amount"/>
														<span id="salary_amount_error" class="error-text"></span>
                                                    </div>
                                                    <div class="col-12 col-md-4 mb-4">
                                                        <label for="currency">Currency type <span style="color: red;">*</span></label>
                                                        <select class="form-select" name="currency_id" data-control="select2" data-placeholder="Select Currency type">
                                                            <option>Select Currency</option>
                                                            @foreach($countries as $countriesData)
                                                                <option value="{{$countriesData->id}}">{{$countriesData->currency_name}}</option>
                                                            @endforeach
                                                        </select>
														<span id="currency_id_error" class="error-text"></span>
                                                    </div>
                                                    <div class="col-12 col-md-4 mb-4">
                                                        <label for="salary_per">Salary per <span style="color: red;">*</span></label>
                                                        <select class="form-select" name="salary_per" data-control="select2" data-hide-search="true" data-placeholder="Select time period">
                                                            <option></option>
                                                            <option value="month">Month</option>
                                                            <option value="year">Year</option>
                                                            <option value="hour">Hour</option>
                                                            <option value="day">Day</option>
                                                        </select>
														<span id="salary_per_error" class="error-text"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label>Other benefits provided by employer </label>
                                                    <div class="form-group row">
                                                        <div class="col-lg-4">
                                                            <input type="checkbox" id="is_accommodation" value="1" name="is_accommodation">
                                                            <label for="is_accommodation">Accommodation</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input type="checkbox" id="is_food" value="1" name="is_food">
                                                            <label for="is_food">Kitchen/Food facility</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input type="checkbox" id="is_transport" value="1" name="is_transport">
                                                            <label for="is_transport">Transportation</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input type="checkbox" id="is_medical" value="1" name="is_medical">
                                                            <label for="is_medical">Medical benefits</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input type="checkbox" id="is_visa" value="1" name="is_visa">
                                                            <label for="is_visa">Visa</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input type="checkbox" id="is_insurance" value="1" name="is_insurance">
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
                                                            <button type="button" onclick="validateStep(2)" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
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
                        <div id="step-3" class="step" style="display: none;">
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
                                                                        <h6 class="">Employment permit <span style="color: red;">*</span></h6>
                                                                        <div class="file-input-container">
                                                                            <input type="file" name="employment_permit_file" class="job_documents_file_upload" id="fileInput">
                                                                        </div>
																		<span id="employment_permit_file_error" class="error-text"></span>
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
                                                            <button type="button" onclick="validateStep(3)" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
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
                        <div id="step-4" class="step" style="display: none;">
                            <div class="card">
                                <div class="stepper stepper-links d-flex flex-column">
                                    <div class="mx-auto w-100">
                                        <div class="current">
                                            <div class="w-100">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="industry_sector">Contract tenure (in years) <span style="color: red;">*</span></label>
                                                        <input class="form-control bg-transparent" type="text" name="contract_tenure" placeholder="Please enter Contract tenure in number e.g: 30"/>
														<span id="contract_tenure_error" class="error-text"></span>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="industry_sector">Probation <span style="color: red;">*</span></label>
                                                        <select class="form-select" name="probation_period" data-hide-search="true" data-placeholder="Not Applicable">
                                                            <option>Select Probation Period</option>
                                                            <option value="3">3 Months</option>
                                                            <option value="4">4 Months</option>
                                                            <option value="6">6 Months</option>
                                                            <option value="9">9 Months</option>
                                                            <option value="12">12 Months</option>
                                                        </select>
														<span id="probation_period_error" class="error-text"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="district_id">Requirements:</label>
                                                        <textarea class="form-control bg-transparent" id="description" name="requirements_details" rows="2" autocomplete="off" spellcheck="false"></textarea>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="district_id">Other benefits:</label>
                                                        <textarea class="form-control bg-transparent" id="description" name="benefits_details" rows="2" autocomplete="off" spellcheck="false"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="district_id">Conditions:</label>
                                                        <textarea class="form-control bg-transparent" id="description" name="condition_details" rows="2" autocomplete="off" spellcheck="false"></textarea>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="district_id">Charge and additional cost:</label>
                                                        <textarea class="form-control bg-transparent" id="description" name="additional_details" rows="2" autocomplete="off" spellcheck="false"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="division_id">Application deadline</label>
                                                        <input class="form-control bg-transparent" type="date" name="application_deadline" />
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="division_id">Employer deadline</label>
                                                        <input class="form-control bg-transparent" type="date" name="employer_deadline" />
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
@endsection
