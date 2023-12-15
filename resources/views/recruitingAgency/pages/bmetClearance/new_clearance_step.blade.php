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
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <ul class="nav nav-light-danger nav-bold nav-pills customTab_item">
                        <li class="nav-item">
                            <a data-bs-toggle="tab" href="#job_details" class="nav-link active">
                                <img height="30px" src="{{ URL::to('assets/media/clearance/job_details.png') }}" alt="" class="mr-2"> Job Details </a>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="tab" href="#applications_documents" class="nav-link">
                                <img height="30px" src="{{ URL::to('assets/media/clearance/application_document.png') }}" alt="" class="mr-2"> Application Documents </a>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="tab" href="#draft_candidate" class="nav-link">
                                <img height="30px" src="{{ URL::to('assets/media/clearance/candidates.png') }}" alt="" class="mr-2"> Candidates </a>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="tab" href="#summary" class="nav-link">
                                <img height="30px" src="{{ URL::to('assets/media/clearance/summary.png') }}" alt="" class="mr-2"> Summary </a>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="tab" href="#payment" class="nav-link">
                                <img height="30px" src="{{ URL::to('assets/media/clearance/payment.png') }}" alt="" class="mr-2"> Payment </a>
                        </li>
                    </ul>
                    <div class="tab-content mt-10">
                        <div class="clearance_summery_new d-md-flex justify-content-center mt-4 mb-10">
                            <div class="clearence_item">
                                <div class="media">
                                    <img src="{{ URL::to('assets/media/clearance/1.png') }}" alt="..." class="align-self-center me-3" style="width: 30px;">
                                    <div class="media-body">
                                        <p>Clearance Type</p>
                                        <p>
                                            <span>
                                                @if($clearance->clearance_type == 'individual')
                                                    Individual (1-24)
                                                @elseif($clearance->clearance_type == 'group')
                                                    Group
                                                @endif
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="clearence_item mx-md-4 mb-2 mb-md-0">
                                <div class="media">
                                    <img src="{{ URL::to('assets/media/clearance/country.png') }}" alt="..." class="align-self-center me-3" style="width: 30px;">
                                    <div class="media-body">
                                        <p>
                                            <span class="me-3">Country</span>
                                        </p>
                                        <p>{{$clearance->country->country_name}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="clearence_item mx-md-4 my-2 my-md-0">
                                <div class="media">
                                    <img src="{{ URL::to('assets/media/clearance/3.png') }}" alt="..." class="align-self-center me-3" style="width: 30px;">
                                    <div class="media-body">
                                        <p>
                                            <span class="me-3">Application Id</span>
                                        </p>
                                        <p>{{$clearance->application_no}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="clearence_item">
                                <div class="media">
                                    <div class="media-body">
                                        <p>
                                            <span class="me-3">Application Date</span>
                                        </p>
                                        <p>{{ \Carbon\Carbon::parse($clearance->created_at)->format('j M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <div class="tab-pane fade show active" id="job_details" role="tabpanel">

                           @if($clearance->jobClearances->isEmpty())
                               <div class="row">
                                   <div class="col-md-12 mb-md-0 mb-2 btnAlignRight">
                                       <div class="btn btn-primary mx-2 my-5 font-weight-bold text-right customBtn">
                                           <a data-bs-toggle="modal" data-bs-target="#addFromJobPostModal" href="#" class="customBtnText">+ Pull from posted jobs</a>
                                       </div>
                                   </div>
                               </div>
                               <form action="{{route('recruiting-agency.bmet.clearance.application.step.job.clearance.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div>
                            <h4 class="mb-5">Employer Details:</h4>
                            <div class="row mb-8">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 11px;">Employer Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="employee_name" required placeholder="Please enter a employer name" class="form-control bg-transparent" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 11px;">City</label>
                                        <input type="text" name="city_name" placeholder="Please enter a city name" class="form-control bg-transparent">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 11px;">Employer Address</label>
                                        <input type="text" name="employer_address" placeholder="Please enter a employer address" class="form-control bg-transparent">
                                    </div>
                                </div>
                                <input type="text" name="clearance_id" value="{{$clearance->id}}" hidden="">
                            </div>
                            <h4 class="mb-5">Job Details</h4>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Visa Attestation Type <span class="text-danger">*</span>
                                        </label>
                                        <select id="job_type" required name="job_type" class="form-control bg-transparent">
                                            <option value="attested">Visa attested</option>
                                            <option value="skill_search">Visa non-attested</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Category <span class="text-danger">*</span>
                                        </label>
                                        <select id="category_id" required name="category_id" class="form-control select2 bg-transparent" style="width: 100%;">
                                            <option value="">Select a job category</option>
                                            @foreach($jobCategory as $jobCategoryData)
                                             <option value="{{$jobCategoryData->id}}">{{$jobCategoryData->job_category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 11px;">Working hour / per day</label>
                                        <input type="text" name="working_duration" placeholder="hours per day" class="form-control bg-transparent">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-size: 11px;">Working days</label>
                                                <input type="text" name="working_days" placeholder="Days" class="form-control bg-transparent">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select name="working_on" class="form-control bg-transparent mt-5">
                                                    <option value="month">Month</option>
                                                    <option value="week">Week</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Skill type <span class="text-danger">*</span>
                                        </label>
                                        <select id="skill_type" required name="skill_type" class="form-control bg-transparent">
                                            <option value="">Select skill type</option>
                                            <option value="general"> General </option>
                                            <option value="skilled"> Skilled </option>
                                            <option value="unskilled"> Unskilled </option>
                                            <option value="professional"> Professional </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 11px;">No. of post (as per demand letter) <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="no_of_post" required placeholder="Please enter number of post" class="form-control bg-transparent fz11">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-size: 11px;">Salary Amount <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="salary_amount" required placeholder="Salary Amount" class="form-control bg-transparent">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="fz11">Currency Type <span class="text-danger">*</span>
                                                </label>
                                                <select id="currency_id" required name="currency_id" class="form-control select2 bg-transparent" style="width: 100%;">
                                                    <option value=""> select currency</option>
                                                    @foreach($currency as $currencyData)
                                                      <option value="{{$currencyData->id}}">{{$currencyData->currency_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="fz11">Salary per <span class="text-danger">*</span>
                                        </label>
                                        <select name="salary_per" required class="form-control select2 bg-transparent" style="width: 100%;">
                                            <option value="">Please select</option>
                                            <option value="day"> Day </option>
                                            <option value="month"> Month </option>
                                            <option value="year"> Year </option>
                                            <option value="hourly"> Hourly </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Gender Type</label>
                                        <select name="gender" required class="form-control bg-transparent">
                                            <option value="">select gender</option>
                                            <option value="1"> Male </option>
                                            <option value="2"> Female </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-size: 11px;">Age range</label>
                                                <input type="text" name="min_age" placeholder="Min" class="form-control bg-transparent">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-size: 11px;"></label>
                                                <input type="text" name="max_age" placeholder="Max" class="form-control bg-transparent">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 11px;">Contract tenure (in years) <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="contract_tenure" required placeholder="Please enter the number ex: 30" class="form-control bg-transparent">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Probation</label>
                                        <select name="probation_period" class="form-control bg-transparent">
                                            <option value="">Please select Probation</option>
                                            <option value="0"> Not Applicable </option>
                                            <option value="3"> 3 Month </option>
                                            <option value="4"> 4 Month </option>
                                            <option value="6"> 6 Month </option>
                                            <option value="9"> 9 Month </option>
                                            <option value="12"> 12 Month </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <p class="mt-5">
                                        <b>Other benefits provided by employer</b>
                                    </p>
                                    <div class="d-flex">
                                        <div class="col-2">
                                            <div class="checkItem mb-8">
                                                <label class="checkbox checkbox-lg">
                                                    <input type="checkbox"  id="is_accommodation" value="1" name="is_accommodation">
                                                    <span style="width: 18px; height: 18px;"></span>
                                                    <b>Accommodation</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="checkItem mb-8">
                                                <label class="checkbox checkbox-lg">
                                                    <input type="checkbox"  id="is_visa" value="1" name="is_visa">
                                                    <span style="width: 18px; height: 18px;"></span>
                                                    <b>Visa</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="checkItem mb-8">
                                                <label class="checkbox checkbox-lg">
                                                    <input type="checkbox" id="is_food" value="1" name="is_food">
                                                    <span style="width: 18px; height: 18px;"></span>
                                                    <b>Kitchen/Food facility benefits</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="checkItem mb-8">
                                                <label class="checkbox checkbox-lg">
                                                    <input type="checkbox" id="is_one_way " value="1" name="is_one_way">
                                                    <span style="width: 18px; height: 18px;"></span>
                                                    <b>Plane fare one way</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="checkItem mb-8">
                                                <label class="checkbox checkbox-lg">
                                                    <input type="checkbox" id="is_other " value="1" name="is_other">
                                                    <span style="width: 18px; height: 18px;"></span>
                                                    <b>Others</b>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="col-2">
                                            <div class="checkItem mb-8">
                                                <label class="checkbox checkbox-lg">
                                                    <input type="checkbox" id="is_medical" value="1" name="is_medical">
                                                    <span style="width: 18px; height: 18px;"></span>
                                                    <b>Medical benefits</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="checkItem mb-8">
                                                <label class="checkbox checkbox-lg">
                                                    <input type="checkbox" id="is_insurance" value="1" name="is_insurance">
                                                    <span style="width: 18px; height: 18px;"></span>
                                                    <b>Insurance premium</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="checkItem mb-8">
                                                <label class="checkbox checkbox-lg">
                                                    <input type="checkbox" id="is_transport" value="1" name="is_transport">
                                                    <span style="width: 18px; height: 18px;"></span>
                                                    <b>Transportation</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="checkItem mb-8">
                                                <label class="checkbox checkbox-lg">
                                                    <input type="checkbox" id="is_two_way" value="1" name="is_two_way">
                                                    <span style="width: 18px; height: 18px;"></span>
                                                    <b>Plane fare two way</b>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4>Documents:</h4>
                            <div class="row">
                                <div class="col-md-3">
                                    <div>
                                        <div>
                                            <div class="modal-documents m-3">
                                                <div class="items d-flex align-items-center">
                                                    <div class="left">
                                                        <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                    </div>
                                                    <div class="right ms-2">
                                                        <h5>Job Proof</h5>
                                                        <div class="view-upload">
                                                            <div class="mt-2">
                                                                <div id="file-info-job-proof-1-0"></div>
                                                                <input name="employment_permit_file" id="job-proof-1-0" accept="image/*,application/pdf" type="file">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div>
                                        <div>
                                            <div class="modal-documents m-3">
                                                <div class="items d-flex align-items-center">
                                                    <div class="left">
                                                        <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                    </div>
                                                    <div class="right ms-2">
                                                        <h5>Employment Contract</h5>
                                                        <div class="view-upload">
                                                            <div class="mt-2">
                                                                <div id="file-info-employment-contract-1-1"></div>
                                                                <input  name="work_agreement_file"  id="employment-contract-1-1" accept="image/*,application/pdf" type="file">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div>
                                        <div>
                                            <div class="modal-documents m-3">
                                                <div class="items d-flex align-items-center">
                                                    <div class="left">
                                                        <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                    </div>
                                                    <div class="right ms-2">
                                                        <h5>Mail From BHC</h5>
                                                        <div class="view-upload">
                                                            <div class="mt-2">
                                                                <div id="file-info-bhc-mail-1-2"></div>
                                                                <input name="other_file" id="bhc-mail-1-2" accept="image/*,application/pdf" type="file">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between w-100 mt-20">
    {{--                                    <button class="btn px-5 btn-position mr-5 btn-primary" data-bs-toggle="modal" data-bs-target="#uploadJobWizeOtherDocument"> + Add more document</button>--}}
                                <button type="submit" class="btn px-5 btn-position mr-5 btn-primary"> Save &amp; Next</button>
                            </div>
                        </div>
                        </form>
                           @else
                               <div class="mb-5 d-flex justify-content-end">
                                   <button data-bs-toggle="modal" data-bs-target="#addJobsManuallyModal" class="btn btn-primary btn-lg">+ Add More Job </button>
                               </div>
                               @foreach($clearance->jobClearances as $jobClearancesData)
                                @if($jobClearancesData->jobManagement->no_of_post_already_finished !=0 )
                                <div class="job_summary">
                                   <div>
                                       <div>
                                           <div class="d-flex justify-content-end">
                                               <div>
                                                   <button data-bs-toggle="modal" data-bs-target="#editJobsManuallyModal{{$jobClearancesData->jobManagement->id}}" class="btn btn-info edit_sm_btn">
                                                       <i class="far fa-edit fa-xs"></i> Edit </button>
                                               </div>
                                               <div>
                                                   <a href="{{route('recruiting-agency.bmet.clearance.application.step.job.clearance.delete',$jobClearancesData->jobManagement->id)}}" data-bs-toggle="modal" data-bs-target="#removeJob{{$jobClearancesData->jobManagement->id}}">
                                                       <img src="{{ URL::to('assets/media/close.png') }}" alt="" style="width: 30px; height: 30px; cursor: pointer;">
                                                   </a>
                                               </div>
                                           </div>
                                           <div class="row mt-5 ml-5">
                                               <div class="col-md-2 p-3 border-right d-flex align-items-center justify-content-around">
                                                   <div class="job_summary_item">
                                                       <img src="{{ URL::to('assets/media/clearance/cleaner.png') }}" alt="" style="width: 80px; height: 80px;">
                                                   </div>
                                               </div>
                                               <div class="col-md-2 p-3 border-right d-flex align-items-center justify-content-around">
                                                   <div class="job_summary_item">
                                                       <h5 class="mt-2 text-dark">{{$jobClearancesData? $jobClearancesData->jobManagement->jobCategory->job_category_name:'N/A'}}</h5>
                                                       <p class="mt-2">{{$jobClearancesData? $jobClearancesData->jobManagement->employee_name:'N/A'}}</p>
                                                       <p>{{$jobClearancesData? $jobClearancesData->jobManagement->employer_address:'N/A'}}</p>
                                                       <p></p>
                                                   </div>
                                               </div>
                                               <div class="col-md-3 p-3 border-right d-flex align-items-center justify-content-around">
                                                   <div class="job_summary_item">
                                                       <p>
                                                           <b class="text-dark">No of Post : </b>{{$jobClearancesData? $jobClearancesData->jobManagement->no_of_post_already_finished:'N/A'}}
                                                       </p>
                                                       <p>
                                                           <b class="text-dark">Skill type : </b>{{ $jobClearancesData ? ucfirst($jobClearancesData->jobManagement->skill_type) : 'N/A' }}
                                                       </p>
                                                       <p>
                                                           <b class="text-dark">Job type : </b>{{ $jobClearancesData ? ucfirst($jobClearancesData->jobManagement->job_type) : 'N/A' }}
                                                       </p>
                                                       <p>
                                                           <b class="text-dark">Gender type : </b>{{ $jobClearancesData ? ($jobClearancesData->jobManagement->gender==1?'Male':'Female') : 'N/A' }}
                                                       </p>
                                                       <p>
                                                           <b class="text-dark">Age range : </b>{{ $jobClearancesData ? $jobClearancesData->jobManagement->min_age : 'N/A' }} - {{ $jobClearancesData ? $jobClearancesData->jobManagement->max_age : 'N/A' }}
                                                       </p>
                                                   </div>
                                               </div>
                                               <div class="col-md-4 p-3 d-flex align-items-center justify-content-around">
                                                   <div class="job_summary_item">
                                                       <p>
                                                           <b class="text-dark">Salary : </b>{{ $jobClearancesData ? $jobClearancesData->jobManagement->salary_amount : 'N/A' }} {{ $jobClearancesData ? $jobClearancesData->jobManagement->country->currency_name : 'N/A' }} {{ $jobClearancesData ? ucfirst($jobClearancesData->jobManagement->salary_per) : 'N/A' }}
                                                       </p>
                                                       <p>
                                                           <b class="text-dark">Benefits : </b>
                                                           {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_accommodation==1 ? 'Accommodation':'' ): 'N/A' }},
                                                           {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_food==1 ? 'Food facility benefits':'' ): 'N/A' }},
                                                           {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_transport==1 ? 'Transportation':'' ): 'N/A' }},
                                                           {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_medical==1 ? 'Medical benefits':'' ): 'N/A' }},
                                                           {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_visa==1 ? 'Visa':'' ): 'N/A' }},
                                                           {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_insurance==1 ? 'Insurance premium':'' ): 'N/A' }},
                                                           {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_one_way==1 ? 'Plane fare one way':'' ): 'N/A' }},
                                                           {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_two_way==1 ? 'Plane fare two way':'' ): 'N/A' }},
                                                           {{ $jobClearancesData ? ($jobClearancesData->jobManagement->is_other==1 ? 'Others':'' ): 'N/A' }}

                                                       </p>
                                                       <p>
                                                           <b class="text-dark">Tenure : </b> {{ $jobClearancesData ? $jobClearancesData->jobManagement->contract_tenure : 'N/A' }} Year
                                                       </p>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="d-flex justify-content-between">
                                               <div class="d-flex justify-content-around mt-3">
                                                   <div class="candidate">Candidate Added: {{$jobClearancesData->jobManagement->no_of_post  - $jobClearancesData->jobManagement->no_of_post_already_finished}}</div>
                                               </div>
                                               <div class="mt-3">
                                                   <button data-bs-toggle="modal" data-bs-target="#add_candidate_modal_under_job" class="btn btn-primary btn-lg">+ Add Candidate </button>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               @endif


                               {{-- Edit Job Details --}}
                               <div class="modal fade" tabindex="-1" id="editJobsManuallyModal{{$jobClearancesData->jobManagement->id}}">
                                   <div class="modal-dialog modal-dialog-centered modal-xl">
                                       <div class="modal-content">
                                           <form action="{{route('recruiting-agency.bmet.clearance.application.step.job.clearance.update',$jobClearancesData->jobManagement->id)}}" method="post" enctype="multipart/form-data">
                                               @csrf
                                               @method('PUT')
                                               <div class="modal-header row">
                                                   <div class="col-10 offset-1 text-center">
                                                       <h5 class="modal-title custom_modal_title">
                                                           Edit Job Details
                                                       </h5>
                                                   </div>
                                                   <div class="col-12 col-md-1 text-right">
                                                       <a href="#" data-bs-dismiss="modal" aria-label="Close" class="text-right pt-3 pr-3">
                                                           <img src="{{ URL::to('assets/media/close.png') }}" alt="Close" style="height: 20px; margin-top: -25px; margin-right: -20px;">
                                                       </a>
                                                   </div>
                                               </div>
                                               <div class="modal-body">
                                                   <div>
                                                       <h4 class="mb-5">Employer Details:</h4>
                                                       <div class="row mb-8">
                                                           <div class="col-md-3">
                                                               <div class="form-group">
                                                                   <label style="font-size: 11px;">Employer Name <span class="text-danger">*</span>
                                                                   </label>
                                                                   <input type="text" name="employee_name" value="{{$jobClearancesData->jobManagement->employee_name}}" placeholder="Please enter a employer name" class="form-control bg-transparent">
                                                               </div>
                                                           </div>
                                                           <div class="col-md-3">
                                                               <div class="form-group">
                                                                   <label style="font-size: 11px;">City</label>
                                                                   <input type="text" name="city_name" value="{{$jobClearancesData->jobManagement->city_name}}" placeholder="Please enter a city name" class="form-control bg-transparent">
                                                               </div>
                                                           </div>
                                                           <div class="col-md-6">
                                                               <div class="form-group">
                                                                   <label style="font-size: 11px;">Employer Address</label>
                                                                   <input type="text" name="employer_address" value="{{$jobClearancesData->jobManagement->employer_address}}" placeholder="Please enter a employer address" class="form-control bg-transparent">
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <h4 class="mb-5">Job Details</h4>
                                                       <div class="row">
                                                           <div class="col-md-3">
                                                               <div class="form-group">
                                                                   <label>Visa Attestation Type <span class="text-danger">*</span>
                                                                   </label>
                                                                   <select id="job_type" name="job_type" class="form-control bg-transparent">
                                                                       @if($jobClearancesData->jobManagement->job_type == 'attested')
                                                                           <option value="attested" selected>Visa attested</option>
                                                                       @elseif($jobClearancesData->jobManagement->job_type == 'skill_search')
                                                                           <option value="skill_search" selected>Visa non-attested</option>
                                                                       @endif
                                                                       <option value="attested">Visa attested</option>
                                                                       <option value="non_attested">Visa non-attested</option>
                                                                   </select>
                                                               </div>
                                                           </div>
                                                           <div class="col-md-3">
                                                               <div class="form-group">
                                                                   <label>Category <span class="text-danger">*</span>
                                                                   </label>
                                                                   <select id="category_id" name="category_id" class="form-control select2" style="width: 100%;">
                                                                       <option value="{{$jobClearancesData->jobManagement->jobCategory->id}}">
                                                                           {{$jobClearancesData->jobManagement->jobCategory->job_category_name}}
                                                                       </option>
                                                                       @foreach($jobCategory as $jobCategoryData)
                                                                           <option value="{{$jobCategoryData->id}}">{{$jobCategoryData->job_category_name}}</option>
                                                                       @endforeach
                                                                   </select>
                                                               </div>
                                                           </div>
                                                           <div class="col-md-3">
                                                               <div class="form-group">
                                                                   <label style="font-size: 11px;">Working hour / per day</label>
                                                                   <input type="text" name="working_duration" value="{{$jobClearancesData->jobManagement->working_duration}}" placeholder="hours per day" class="form-control bg-transparent">
                                                               </div>
                                                           </div>
                                                           <div class="col-md-3">
                                                               <div class="row">
                                                                   <div class="col-md-6">
                                                                       <div class="form-group">
                                                                           <label style="font-size: 11px;">Working days</label>
                                                                           <input type="text" name="working_days" value="{{$jobClearancesData->jobManagement->working_days}}" placeholder="Days" class="form-control bg-transparent">
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-md-6">
                                                                       <div class="form-group">
                                                                           <select name="working_on" class="form-control bg-transparent mt-5">
                                                                               @if($jobClearancesData->jobManagement->working_on == 'month')
                                                                                   <option value="month" selected>Month</option>
                                                                               @elseif($jobClearancesData->jobManagement->working_on == 'week')
                                                                                   <option value="week" selected>Week</option>
                                                                               @endif
                                                                               <option value="month">Month</option>
                                                                               <option value="week">Week</option>
                                                                           </select>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="row my-3">
                                                           <div class="col-md-3">
                                                               <div class="form-group">
                                                                   <label>Skill type <span class="text-danger">*</span>
                                                                   </label>
                                                                   <select id="skill_type" name="skill_type" class="form-control bg-transparent">
                                                                       @if($jobClearancesData->jobManagement->skill_type == 'general')
                                                                           <option value="general" selected>General</option>
                                                                       @elseif($jobClearancesData->jobManagement->skill_type == 'skilled')
                                                                           <option value="skilled" selected>Skilled</option>
                                                                       @elseif($jobClearancesData->jobManagement->skill_type == 'unskilled')
                                                                           <option value="unskilled" selected>Unskilled</option>
                                                                       @elseif($jobClearancesData->jobManagement->skill_type == 'professional')
                                                                           <option value="professional" selected>Professional</option>
                                                                       @endif
                                                                       <option value="general"> General </option>
                                                                       <option value="skilled"> Skilled </option>
                                                                       <option value="unskilled"> Unskilled </option>
                                                                       <option value="professional"> Professional </option>
                                                                   </select>
                                                               </div>
                                                           </div>
                                                           <div class="col-md-3">
                                                               <div class="form-group">
                                                                   <label style="font-size: 11px;">No. of post (as per demand letter) <span class="text-danger">*</span>
                                                                   </label>
                                                                   <input type="text" name="no_of_post" value="{{$jobClearancesData->jobManagement->no_of_post}}" placeholder="Please enter number of post" class="form-control bg-transparent fz11">
                                                               </div>
                                                           </div>
                                                           <div class="col-md-3">
                                                               <div class="row">
                                                                   <div class="col-md-6">
                                                                       <div class="form-group">
                                                                           <label style="font-size: 11px;">amount <span class="text-danger">*</span>
                                                                           </label>
                                                                           <input type="text" name="salary_amount" value="{{$jobClearancesData->jobManagement->salary_amount}}" placeholder="Salary Amount" class="form-control bg-transparent">
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-md-6">
                                                                       <div class="form-group">
                                                                           <label class="fz11">Currency Type <span class="text-danger">*</span>
                                                                           </label>
                                                                           <select id="currency_id" name="currency_id" class="form-control select2 bg-transparent" style="width: 100%;">
                                                                               <option value="{{$jobClearancesData->jobManagement->country->id}}">
                                                                                   {{$jobClearancesData->jobManagement->country->currency_name}}
                                                                               </option>
                                                                               @foreach($currency as $currencyData)
                                                                                   <option value="{{$currencyData->id}}">{{$currencyData->currency_name}}</option>
                                                                               @endforeach
                                                                           </select>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                           <div class="col-md-3">
                                                               <div class="form-group">
                                                                   <label class="fz11">Salary per <span class="text-danger">*</span>
                                                                   </label>
                                                                   <select name="salary_per" class="form-control select2 bg-transparent" style="width: 100%;">
                                                                       @if($jobClearancesData->jobManagement->salary_per == 'day')
                                                                           <option value="day" selected>Day</option>
                                                                       @elseif($jobClearancesData->jobManagement->salary_per == 'month')
                                                                           <option value="month" selected>Month</option>
                                                                       @elseif($jobClearancesData->jobManagement->salary_per == 'Year')
                                                                           <option value="year" selected>Year</option>
                                                                       @elseif($jobClearancesData->jobManagement->salary_per == 'hourly')
                                                                           <option value="hourly" selected>Hourly</option>
                                                                       @endif
                                                                       <option value="day"> Day </option>
                                                                       <option value="month"> Month </option>
                                                                       <option value="year"> Year </option>
                                                                       <option value="hourly"> Hourly </option>
                                                                   </select>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="row">
                                                           <div class="col-md-3">
                                                               <div class="form-group">
                                                                   <label>Gender Type</label>
                                                                   <select name="gender" class="form-control bg-transparent">
                                                                       <option value="{{$jobClearancesData->jobManagement->gender}}">
                                                                           {{$jobClearancesData->jobManagement->gender==1?'Male':'Female'}}
                                                                       </option>
                                                                       <option value="1"> Male </option>
                                                                       <option value="2"> Female </option>
                                                                   </select>
                                                               </div>
                                                           </div>
                                                           <div class="col-md-3">
                                                               <div class="row">
                                                                   <div class="col-md-6">
                                                                       <div class="form-group">
                                                                           <label style="font-size: 11px;">Age range</label>
                                                                           <input type="text" name="min_age" value="{{$jobClearancesData->jobManagement->min_age}}" placeholder="Min" class="form-control bg-transparent">
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-md-6">
                                                                       <div class="form-group">
                                                                           <label style="font-size: 11px;"></label>
                                                                           <input type="text" name="max_age" value="{{$jobClearancesData->jobManagement->max_age}}" placeholder="Max" class="form-control bg-transparent">
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                           <div class="col-md-3">
                                                               <div class="form-group">
                                                                   <label style="font-size: 11px;">Contract tenure (in years) <span class="text-danger">*</span>
                                                                   </label>
                                                                   <input type="text" name="contract_tenure" value="{{$jobClearancesData->jobManagement->contract_tenure}}" placeholder="Please enter the number ex: 30" class="form-control bg-transparent">
                                                               </div>
                                                           </div>
                                                           <div class="col-md-3">
                                                               <div class="form-group">
                                                                   <label>Probation</label>
                                                                   <select name="probation_period" class="form-control bg-transparent">
                                                                       @if($jobClearancesData->jobManagement->probation_period == '0')
                                                                           <option value="0" selected>Not Applicable</option>
                                                                       @elseif($jobClearancesData->jobManagement->probation_period == '3')
                                                                           <option value="3" selected> 3 Month</option>
                                                                       @elseif($jobClearancesData->jobManagement->probation_period == '4')
                                                                           <option value="4" selected>4 Month</option>
                                                                       @elseif($jobClearancesData->jobManagement->probation_period == '6')
                                                                           <option value="6" selected>6 Month</option>
                                                                       @elseif($jobClearancesData->jobManagement->probation_period == '9')
                                                                           <option value="9" selected>9 Month</option>
                                                                       @elseif($jobClearancesData->jobManagement->probation_period == '12')
                                                                           <option value="12" selected> 12 Month</option>
                                                                       @endif
                                                                       <option value="0"> Not Applicable </option>
                                                                       <option value="3"> 3 Month </option>
                                                                       <option value="4"> 4 Month </option>
                                                                       <option value="6"> 6 Month </option>
                                                                       <option value="9"> 9 Month </option>
                                                                       <option value="12"> 12 Month </option>
                                                                   </select>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="row">
                                                           <p class="mt-5">
                                                               <b>Other benefits provided by employer</b>
                                                           </p>
                                                           <div class="form-group row">
                                                               <div class="col-lg-4">
                                                                   <input type="checkbox" id="is_accommodation" value="1"  name="is_accommodation"  {{ $jobClearancesData->jobManagement->is_accommodation == 1 ? 'checked' : '' }}>
                                                                   <label for="is_accommodation">Accommodation</label>
                                                               </div>
                                                               <div class="col-lg-4">
                                                                   <input type="checkbox" id="is_food" value="1" name="is_food"  {{ $jobClearancesData->jobManagement->is_food == 1 ? 'checked' : '' }}>
                                                                   <label for="is_food">Kitchen/Food facility</label>
                                                               </div>
                                                               <div class="col-lg-4">
                                                                   <input type="checkbox" id="is_transport" value="1" name="is_transport" {{ $jobClearancesData->jobManagement->is_transport == 1 ? 'checked' : '' }}>
                                                                   <label for="is_transport">Transportation</label>
                                                               </div>
                                                               <div class="col-lg-4">
                                                                   <input type="checkbox" id="is_medical" value="1" name="is_medical" {{ $jobClearancesData->jobManagement->is_medical == 1 ? 'checked' : '' }}>
                                                                   <label for="is_medical">Medical benefits</label>
                                                               </div>
                                                               <div class="col-lg-4">
                                                                   <input type="checkbox" id="is_visa" value="1" name="is_visa" {{ $jobClearancesData->jobManagement->is_visa == 1 ? 'checked' : '' }}>
                                                                   <label for="is_visa">Visa</label>
                                                               </div>
                                                               <div class="col-lg-4">
                                                                   <input type="checkbox" id="is_insurance" value="1" name="is_insurance" {{ $jobClearancesData->jobManagement->is_insurance == 1 ? 'checked' : '' }}>
                                                                   <label for="is_insurance">Insurance premium</label>
                                                               </div>

                                                               <div class="col-lg-4">
                                                                   <input type="checkbox" id="is_one_way" value="1" name="is_one_way" {{ $jobClearancesData->jobManagement->is_one_way == 1 ? 'checked' : '' }}>
                                                                   <label for="is_one_way">Plane fare one way</label>
                                                               </div>
                                                               <div class="col-lg-4">
                                                                   <input type="checkbox" id="is_two_way" value="1" name="is_two_way" {{ $jobClearancesData->jobManagement->is_two_way == 1 ? 'checked' : '' }}>
                                                                   <label for="is_two_way">Plane fare two way</label>
                                                               </div>
                                                               <div class="col-lg-4">
                                                                   <input type="checkbox" id="is_other" value="1" name="is_other" {{ $jobClearancesData->jobManagement->is_other == 1 ? 'checked' : '' }}>
                                                                   <label for="is_other">Others</label>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <h3 class="mt-3">Documents</h3>
                                                   <div class="row">
                                                       <div class="col-md-3 col-xxl-3">
                                                           <div>
                                                               <div>
                                                                   <div class="modal-documents m-3">
                                                                       <div class="items d-flex align-items-center">
                                                                           <div class="left">
                                                                               <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                                           </div>
                                                                           <div class="right ms-2">
                                                                               <h5>Employment Contract</h5>
                                                                               <div class="view-upload">
                                                                                   <a target="_blank" href="{{asset('storage/'.$jobClearancesData->jobManagement->work_agreement_file)}}">
                                                                                       View
                                                                                   </a>
                                                                                   <div class="mt-2">
                                                                                       <input name="work_agreement_file" accept="image/*,application/pdf" type="file">
                                                                                   </div>
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-3 col-xxl-3">
                                                           <div>
                                                               <div>
                                                                   <div class="modal-documents m-3">
                                                                       <div class="items d-flex align-items-center">
                                                                           <div class="left">
                                                                               <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                                           </div>
                                                                           <div class="right ms-2">
                                                                               <h5>Job Proof</h5>
                                                                               <div class="view-upload">
                                                                                   <a target="_blank" href="{{asset('storage/'.$jobClearancesData->jobManagement->employment_permit_file)}}">
                                                                                       View
                                                                                   </a>
                                                                                   <div class="mt-2">
                                                                                       <input name="employment_permit_file" accept="image/*,application/pdf" type="file">
                                                                                   </div>
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-3 col-xxl-3">
                                                           <div>
                                                               <div>
                                                                   <div class="modal-documents m-3">
                                                                       <div class="items d-flex align-items-center">
                                                                           <div class="left">
                                                                               <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                                           </div>
                                                                           <div class="right ms-2">
                                                                               <h5>Mail From BHC</h5>
                                                                               <div class="view-upload">
                                                                                   <a target="_blank" href="{{asset('storage/'.$jobClearancesData->jobManagement->other_file)}}">
                                                                                       View
                                                                                   </a>
                                                                                   <div class="mt-2">
                                                                                       <input name="other_file" accept="image/*,application/pdf" type="file">
                                                                                   </div>
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="modal-footer">
                                                   <div class="d-flex justify-content-end w-100">
                                                       <button type="submit" class="btn px-5 btn-position mr-5 btn-primary"> Update Job</button>
                                                   </div>
                                               </div>
                                           </form>
                                       </div>
                                   </div>
                               </div>

                               {{-- Remove job Modal --}}
                               <div class="modal fade" tabindex="-1" id="removeJob{{$jobClearancesData->jobManagement->id}}">
                                   <div class="modal-dialog modal-dialog-centered">
                                       <div class="modal-content">
                                           <div class="modal-header row">
                                               <div class="col-10 offset-1 text-center">
                                                   <h5 class="modal-title custom_modal_title">
                                                       Remove Clearance Job!
                                                   </h5>
                                               </div>
                                               <div class="col-12 col-md-1 text-right">
                                                   <a href="#" data-bs-dismiss="modal" aria-label="Close" class="text-right pt-3 pr-3">
                                                       <img src="{{ URL::to('assets/media/close.png') }}" alt="Close" style="height: 20px; margin-top: -25px; margin-right: -20px;">
                                                   </a>
                                               </div>
                                           </div>
                                           <div class="modal-body">
                                               <div class="text-center">Are you sure, you want to remove job?</div>
                                           </div>
                                           <div class="modal-footer">
                                               <a href="{{route('recruiting-agency.bmet.clearance.application.step.job.clearance.delete',$jobClearancesData->jobManagement->id)}}" class="btn px-5 btn-position mr-5 btn-danger"> Remove Job</a>
                                               <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary">Close</button>
                                           </div>
                                       </div>
                                   </div>
                               </div>

                               {{-- Add New Candidate Modal --}}
                               <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="add_candidate_modal_under_job">
                                       <div class="modal-dialog modal-dialog-centered modal-xl">
                                           <div class="modal-content">
                                               <div class="modal-header row">
                                                   <div class="col-10 offset-1 text-center">
                                                       <h5 class="modal-title custom_modal_title">
                                                           Add New Candidate
                                                       </h5>
                                                   </div>
                                                   <div class="col-12 col-md-1 text-right">
                                                       <a href="#" data-bs-dismiss="modal" aria-label="Close" class="text-right pt-3 pr-3">
                                                           <img src="{{ URL::to('assets/media/close.png') }}" alt="Close" style="height: 20px; margin-top: -25px; margin-right: -20px;">
                                                       </a>
                                                   </div>
                                               </div>

                                               <div class="modal-body">
                                                   <div class="row mb-10">
                                                       <div class="col-md-8">
                                                           <div class="form-group">
                                                               <label>Passport Number</label>
                                                                   <div class="input-group">
                                                                       <input type="text" placeholder="Enter your passport number" id="passport_no" name="passport_no"  required="required" minlength="9" maxlength="9" class="form-control bg-transparent" />
                                                                       <div class="input-group-append">
                                                                            <span>
                                                                                <button class="btn px-5 btn-position mr-5 btn-primary"> Search</button>
                                                                            </span>
                                                                       </div>
                                                                   </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="new_profile_box">
                                                       <div class="new_profile_top">
                                                           <div class="row">
                                                               <div class="col-md-4 border-right">
                                                                   <div class="np_content_1 d-flex">
                                                                       <div class="np_left">
                                                                           <div class="image-input image-input-empty" data-kt-image-input="true">
                                                                               <div class="image-input-wrapper w-100px h-100px"></div>
                                                                               <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                                      data-kt-image-input-action="change"
                                                                                      data-bs-toggle="tooltip"
                                                                                      data-bs-dismiss="click">
                                                                                   <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>
                                                                                   <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                                                   <input type="hidden" name="avatar_remove" />
                                                                               </label>
                                                                           </div>
                                                                       </div>
                                                                       <div class="np_right ms-5">
                                                                           <h5 class="text-light"></h5>
                                                                           <p class="name_data">Name: <b><span class="not-found-text"></span></b></p>
                                                                           <p class="phone_data">Phone: <b><span class="not-found-text"></span></b></p>
                                                                           <p class="dob_data">Date of birth: <b><span class="not-found-text"></span></b></p>
                                                                           <p class="gender_data">Gender: <b><span class="not-found-text"></span></b></p>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                               <div class="col-md-3 border-right">
                                                                   <p>
                                                                       <b>
                                                                           <a href="#" class="master_search_top_button d-flex justify-content-between">
                                                                               <span>Passport</span>
                                                                               <img src="{{ URL::to('assets/media/clearance/pink-link.png') }}" alt="">
                                                                           </a>
                                                                       </b>
                                                                   </p>
                                                                   <p class="passport_number_data">Passport Number: <b><span class="not-found-text"></span></b></p>
                                                                   <p class="passport_issue_data">Issue date: <b><span class="not-found-text"></span></b></p>
                                                                   <p class="passport_expiry_data">Expiry date: <b><span class="not-found-text"></span></b></p>
                                                               </div>

                                                               <div class="col-md-2 border-right">
                                                                   <p>
                                                                       <b>
                                                                           <a href="#" class="master_search_top_button d-flex justify-content-between">
                                                                               <span>PDO</span>
                                                                               <img src="{{ URL::to('assets/media/clearance/pink-link.png') }}" alt="">
                                                                           </a>
                                                                       </b>
                                                                   </p>
                                                                   <p class="certificate_no_data">Certificate No: <b><span class="not-found-text"></span></b></p>
                                                                   <p class="ttc_data">TTC Name: <b><span class="not-found-text"></span></b></p>
                                                               </div>

                                                               <div class="col-md-3 border-right">
                                                                   <p>
                                                                       <b>
                                                                           <a href="#" class="master_search_top_button d-flex justify-content-between">
                                                                               <span>BMET Registration</span>
                                                                               <img src="{{ URL::to('assets/media/clearance/pink-link.png') }}" alt="">
                                                                           </a>
                                                                       </b>
                                                                   </p>
                                                                   <p class="certificate_verification_data">Registration ID: <b><span class="not-found-text"></span></b></p>
                                                                   <p class="biometric_data">Biometric Status: <b><span class="not-found-text"></span></b></p>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <form action="{{route('recruiting-agency.bmet.candidate.clearance.application.step.store')}}" method="post" enctype="multipart/form-data">
                                                           @csrf
                                                           <div class="new_profile_middle my-5">
                                                               <div class="row">
                                                                   <div class="col-md-6">
                                                                       <div class="npm_left">
                                                                           <h5 style="color: rgb(17, 125, 124);">Visa Information</h5>
                                                                           <div class="row">
                                                                               <div class="col-md-4">
                                                                                   <div class="form-group">
                                                                                       <label>Visa number</label>
                                                                                       <input type="text" name="visa_no" aria-describedby="visa_no" placeholder="Enter your visa number" required="required" class="form-control bg-transparent">
                                                                                   </div>

                                                                                   <div class="form-group">
                                                                                       <label>Visa Issue date</label>
                                                                                       <input type="date" name="visa_issue_date" aria-describedby="visa_issue_date" placeholder="Enter your visa number " required="required" class="form-control bg-transparent" autocomplete="off">
                                                                                   </div>
                                                                               </div>
                                                                               <div class="col-md-4">
                                                                                   <div class="form-group">
                                                                                       <label>Sticker No.</label>
                                                                                       <input type="text" name="sticker_no" aria-describedby="sticker_no" placeholder="visa sticker No." class="form-control bg-transparent">
                                                                                   </div>

                                                                                   <div class="form-group">
                                                                                       <label>Visa Expiry date</label>
                                                                                       <input type="date" name="visa_expiry_date" aria-describedby="sticker_no" placeholder="visa sticker No." class="form-control bg-transparent">
                                                                                   </div>

                                                                                   <!---->
                                                                               </div>
                                                                               <div class="col-md-4">
                                                                                   <div class="form-group">
                                                                                       <label>Visa Ref No.</label>
                                                                                       <input type="text" name="visa_reference_no" aria-describedby="visa_advice_no" placeholder="visa ref No." class="form-control bg-transparent">
                                                                                       <!---->
                                                                                   </div>
                                                                                   <div class="form-group">
                                                                                       <label>Sponsor ID </label>
                                                                                       <input type="text" name="sponsor_id" placeholder="Enter your sponsor id" class="form-control">
                                                                                       <!---->
                                                                                   </div>
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-md-4 my-3 my-md-0">
                                                                       <div class="npm_left">
                                                                           <h5 style="color: rgb(17, 125, 124);">Bank Account Info</h5>
                                                                           <div class="row">
                                                                               <div class="col-md-6">
                                                                                   <div class="form-group">
                                                                                       <label>Account holder</label>
                                                                                       <input type="text" name="account_holder_name" placeholder="account holders name" class="form-control bg-transparent">
                                                                                   </div>
                                                                                   <div class="form-group">
                                                                                       <label>Account No</label>
                                                                                       <input type="text" name="account_number" placeholder="account no" class="form-control bg-transparent">
                                                                                   </div>
                                                                               </div>
                                                                               <div class="col-md-6">
                                                                                   <div class="form-group">
                                                                                       <label>Bank Name</label>
                                                                                       <select name="bank_id" id="exampleFormControlSelect1" class="form-control">
                                                                                           <option value="">Select Bank name</option>
                                                                                           @foreach($banks as $bankData)
                                                                                           <option value="{{$bankData->id}}">{{$bankData->name}}</option>
                                                                                           @endforeach
                                                                                       </select>
                                                                                   </div>
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-md-2">
                                                                       <div class="npm_left">
                                                                           <h5 style="color: rgb(17, 125, 124);">Medical</h5>
                                                                           <div class="row">
                                                                               <div class="col-md-12">
                                                                                   <div class="form-group">
                                                                                       <label>Medical Center</label>
                                                                                       <select name="hospital_id" id="exampleFormControlSelect1" class="form-control">
                                                                                           <option value="">Select medical center</option>
                                                                                           @foreach($hospital as $hospitalData)
                                                                                               <option value="{{$hospitalData->id}}">{{$hospitalData->name}}</option>
                                                                                           @endforeach
                                                                                       </select>
                                                                                   </div>
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <div class="new_profile_bottom">
                                                               <div class="row">
                                                                   <div class="col-md-3">
                                                                       <div class="npb_item">
                                                                           <div class="media">
                                                                               <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="..." class="me-3" style="width: 50px;">
                                                                               <div class="media-body">
                                                                                   <a href="#" class="float-right">
                                                                                       <i class="fas fa-edit" style="color: rgb(17, 125, 124);"></i>
                                                                                   </a>
                                                                                   <p class="mt-0 mb-0">
                                                                                       <b>Visa <br> Documents </b>
                                                                                   </p>
                                                                                   <input type="file" name="visa_file" id="">
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-md-3">
                                                                       <div class="npb_item">
                                                                           <div class="media">
                                                                               <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="..." class="me-3" style="width: 50px;">
                                                                               <div class="media-body">
                                                                                   <a href="#" class="float-right">
                                                                                       <i class="fas fa-edit" style="color: rgb(17, 125, 124);"></i>
                                                                                   </a>
                                                                                   <p class="mt-0 mb-0">
                                                                                       <b>Employment <br> Contract </b>
                                                                                   </p>
                                                                                   <input type="file" name="employment_contract_file" id="">
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-md-3">
                                                                       <div class="npb_item">
                                                                           <div class="media">
                                                                               <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="..." class="me-3" style="width: 50px;">
                                                                               <div class="media-body">
                                                                                   <a href="#" class="float-right">
                                                                                       <i class="fas fa-edit" style="color: rgb(17, 125, 124);"></i>
                                                                                   </a>
                                                                                   <p class="mt-0 mb-0">
                                                                                       <b>Proof of Bank <br> Account </b>
                                                                                   </p>
                                                                                   <input type="file" name="proof_of_bank_account_file" id="">
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-md-3">
                                                                       <div class="npb_item">
                                                                           <div class="media">
                                                                               <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="..." class="me-3" style="width: 50px;">
                                                                               <div class="media-body">
                                                                                   <a href="#" class="float-right">
                                                                                       <i class="fas fa-edit" style="color: rgb(17, 125, 124);"></i>
                                                                                   </a>
                                                                                   <p class="mt-0 mb-0">
                                                                                       <b>Medical <br> Clearance </b>
                                                                                   </p>
                                                                                   <input type="file" name="medical_clearance_file" id="">
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div><br>
                                                           <!-- Hidden input fields for additional parameters -->
                                                           <input type="hidden" name="passport_info_id" id="passport_info" value="">
                                                           <input type="hidden" name="pdo_approval_status" id="pdo_approval" value="">
                                                           <input type="hidden" name="bmet_verification_registration_no" id="verification_registration_no" value="">
                                                           <input type="hidden" name="job_id" value="{{ $jobClearancesData ? $jobClearancesData->jobManagement->id : 'N/A' }}">
                                                           <input type="hidden" name="job_clearance_id" value="{{ $jobClearancesData ? $jobClearancesData->clearance_id : 'N/A' }}">
                                                           <div class="d-flex justify-content-end w-100">
                                                               <button type="submit" class="btn px-5 btn-position mr-5 btn-primary"> Candidate Clearance</button>
                                                           </div>
                                                       </form>
                                                   </div>
                                               </div>

                                           </div>
                                       </div>
                                   </div>
                               @endforeach
                           @endif
                       </div>

                        <div class="tab-pane fade" id="applications_documents" role="tabpanel">
                            <div class="accordion" id="general_documents_infos">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="general_documents_header">
                                        <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#general_documents_body" aria-expanded="true" aria-controls="general_documents_body">
                                            General Documents
                                        </button>
                                    </h2>
                                    <div id="general_documents_body" class="accordion-collapse collapse" aria-labelledby="general_documents_header" data-bs-parent="#general_documents_infos">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-3 col-xxl-3">
                                                    <div>
                                                        <div>
                                                            <div class="modal-documents m-3">
                                                                <div class="items d-flex align-items-center">
                                                                    <div class="left">
                                                                        <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                                    </div>
                                                                    <div class="right ms-2">
                                                                        <h5>Employment Contract</h5>
                                                                        <div class="view-upload">
                                                                            <a target="_blank" href="https://moewoe.amiprobashi.com/s3-file?path=documents/ra/clearance/35457_38cbc5666966507d8c682326db200b62.pdf">View</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-xxl-3">
                                                    <div>
                                                        <div>
                                                            <div class="modal-documents m-3">
                                                                <div class="items d-flex align-items-center">
                                                                    <div class="left">
                                                                        <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                                    </div>
                                                                    <div class="right ms-2">
                                                                        <h5>Job Proof</h5>
                                                                        <div class="view-upload">
                                                                            <a target="_blank" href="https://moewoe.amiprobashi.com/s3-file?path=documents/ra/clearance/35457_38cbc5666966507d8c682326db200b62.pdf">View</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-xxl-3">
                                                    <div>
                                                        <div>
                                                            <div class="modal-documents m-3">
                                                                <div class="items d-flex align-items-center">
                                                                    <div class="left">
                                                                        <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                                    </div>
                                                                    <div class="right ms-2">
                                                                        <h5>Mail From BHC</h5>
                                                                        <div class="view-upload">
                                                                            <a target="_blank" href="https://moewoe.amiprobashi.com/s3-file?path=documents/ra/clearance/35457_38cbc5666966507d8c682326db200b62.pdf">View</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($clearance->jobClearances as $jobClearancesDataShow)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="general_documents_header{{$jobClearancesDataShow->id}}">
                                            <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#general_documents_body{{$jobClearancesDataShow->id}}" aria-expanded="true" aria-controls="general_documents_body{{$jobClearancesDataShow->id}}">
                                                {{$jobClearancesDataShow? $jobClearancesDataShow->jobManagement->jobCategory->job_category_name:''}} | No of Post: {{$jobClearancesDataShow? $jobClearancesDataShow->jobManagement->no_of_post:''}} | Salary / Month: {{$jobClearancesDataShow? $jobClearancesDataShow->jobManagement->salary_amount:''}}
                                            </button>
                                        </h2>
                                        <div id="general_documents_body{{$jobClearancesDataShow->id}}" class="accordion-collapse collapse" aria-labelledby="general_documents_header{{$jobClearancesDataShow->id}}" data-bs-parent="#general_documents_infos{{$jobClearancesDataShow->id}}">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-3 col-xxl-3">
                                                        <div>
                                                            <div>
                                                                <div class="modal-documents m-3">
                                                                    <div class="items d-flex align-items-center">
                                                                        <div class="left">
                                                                            <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                                        </div>
                                                                        <div class="right ms-2">
                                                                            <h5>Employment Contract</h5>
                                                                            <div class="view-upload">
                                                                                <a target="_blank" href="{{asset('storage/'.$jobClearancesDataShow->jobManagement->work_agreement_file)}}">View</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-xxl-3">
                                                        <div>
                                                            <div>
                                                                <div class="modal-documents m-3">
                                                                    <div class="items d-flex align-items-center">
                                                                        <div class="left">
                                                                            <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                                        </div>
                                                                        <div class="right ms-2">
                                                                            <h5>Job Proof</h5>
                                                                            <div class="view-upload">
                                                                                <a target="_blank" href="{{asset('storage/'.$jobClearancesDataShow->jobManagement->employment_permit_file)}}">View</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-xxl-3">
                                                        <div>
                                                            <div>
                                                                <div class="modal-documents m-3">
                                                                    <div class="items d-flex align-items-center">
                                                                        <div class="left">
                                                                            <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                                        </div>
                                                                        <div class="right ms-2">
                                                                            <h5>Mail From BHC</h5>
                                                                            <div class="view-upload">
                                                                                <a target="_blank" href="{{asset('storage/'.$jobClearancesDataShow->jobManagement->other_file)}}">View</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="draft_candidate" role="tabpanel">
                            @if($clearance->jobClearances->count() > 0)
                            <div class="row">
                                <div class="col-12 col-md-4"></div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <button class="btn px-5 btn-position mr-5 btn-primary w-100" data-bs-toggle="modal" data-bs-target="#add_candidate_modal"> Add Candidate</button>
                                    </div>
                                </div>
{{--                                <div class="col-12 col-md-4">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <button class="btn px-5 btn-position mr-5 btn-primary w-100" data-bs-toggle="modal" data-bs-target="#add_bulk_candidate"> Add Bulk Candidates</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                {{-- Add New Candidate Modal --}}
                                <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="add_candidate_modal">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header row">
                                                <div class="col-10 offset-1 text-center">
                                                    <h5 class="modal-title custom_modal_title">
                                                        Add New Candidate
                                                    </h5>
                                                </div>
                                                <div class="col-12 col-md-1 text-right">
                                                    <a href="#" data-bs-dismiss="modal" aria-label="Close" class="text-right pt-3 pr-3">
                                                        <img src="{{ URL::to('assets/media/close.png') }}" alt="Close" style="height: 20px; margin-top: -25px; margin-right: -20px;">
                                                    </a>
                                                </div>
                                            </div>
                                            <form action="{{route('recruiting-agency.bmet.candidate.clearance.application.step.store')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row mb-10">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Passport Number</label>
                                                            <div class="input-group">
                                                                <input type="text" placeholder="Enter your passport number" id="passport_no_add" name="passport_no"  required="required" minlength="9" maxlength="9" class="form-control bg-transparent" />
                                                                <div class="input-group-append">
                                                                            <span>
                                                                                <button class="btn px-5 btn-position mr-5 btn-primary"> Search</button>
                                                                            </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label style="margin-bottom: 0px;">Attach to Job</label>
                                                            <select name="job_id" class="form-select" aria-label="Select to Job">
                                                                <option>Select to Job</option>

                                                                @foreach($clearance->jobClearances as $jobInfo)
                                                                <option value="{{$jobInfo->job_id}}">{{$jobInfo->jobManagement->jobCategory->job_category_name}}({{$jobInfo->jobManagement->employee_name}})</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="new_profile_box">
                                                    <div class="new_profile_top">
                                                        <div class="row">
                                                            <div class="col-md-4 border-right">
                                                                <div class="np_content_1 d-flex">
                                                                    <div class="np_left">
                                                                        <div class="image-input image-input-empty" data-kt-image-input="true">
                                                                            <div class="image-input-wrapper w-100px h-100px"></div>
                                                                            <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                                   data-kt-image-input-action="change"
                                                                                   data-bs-toggle="tooltip"
                                                                                   data-bs-dismiss="click">
                                                                                <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>
                                                                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                                                <input type="hidden" name="avatar_remove" />
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="np_right ms-5">
                                                                        <h5 class="text-light"></h5>
                                                                        <p class="name_data_add">Name: <b><span class="not-found-text"></span></b></p>
                                                                        <p class="phone_data_add">Phone: <b><span class="not-found-text"></span></b></p>
                                                                        <p class="dob_data_add">Date of birth: <b><span class="not-found-text"></span></b></p>
                                                                        <p class="gender_data_add">Gender: <b><span class="not-found-text"></span></b></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 border-right">
                                                                <p>
                                                                    <b>
                                                                        <a href="#" class="master_search_top_button d-flex justify-content-between">
                                                                            <span>Passport</span>
                                                                            <img src="{{ URL::to('assets/media/clearance/pink-link.png') }}" alt="">
                                                                        </a>
                                                                    </b>
                                                                </p>
                                                                <p class="passport_number_data_add">Passport Number: <b><span class="not-found-text"></span></b></p>
                                                                <p class="passport_issue_data_add">Issue date: <b><span class="not-found-text"></span></b></p>
                                                                <p class="passport_expiry_data_add">Expiry date: <b><span class="not-found-text"></span></b></p>
                                                            </div>

                                                            <div class="col-md-2 border-right">
                                                                <p>
                                                                    <b>
                                                                        <a href="#" class="master_search_top_button d-flex justify-content-between">
                                                                            <span>PDO</span>
                                                                            <img src="{{ URL::to('assets/media/clearance/pink-link.png') }}" alt="">
                                                                        </a>
                                                                    </b>
                                                                </p>
                                                                <p class="certificate_no_data_add">Certificate No: <b><span class="not-found-text"></span></b></p>
                                                                <p class="ttc_data_add">TTC Name: <b><span class="not-found-text"></span></b></p>
                                                            </div>

                                                            <div class="col-md-3 border-right">
                                                                <p>
                                                                    <b>
                                                                        <a href="#" class="master_search_top_button d-flex justify-content-between">
                                                                            <span>BMET Registration</span>
                                                                            <img src="{{ URL::to('assets/media/clearance/pink-link.png') }}" alt="">
                                                                        </a>
                                                                    </b>
                                                                </p>
                                                                <p class="certificate_verification_data_add">Registration ID: <b><span class="not-found-text"></span></b></p>
                                                                <p class="biometric_data_add">Biometric Status: <b><span class="not-found-text"></span></b></p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                        <div class="new_profile_middle my-5">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="npm_left">
                                                                        <h5 style="color: rgb(17, 125, 124);">Visa Information</h5>
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label>Visa number</label>
                                                                                    <input type="text" name="visa_no" aria-describedby="visa_no" placeholder="Enter your visa number" required="required" class="form-control bg-transparent">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label>Visa Issue date</label>
                                                                                    <input type="date" name="visa_issue_date" aria-describedby="visa_issue_date" placeholder="Enter your visa number " required="required" class="form-control bg-transparent" autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label>Sticker No.</label>
                                                                                    <input type="text" name="sticker_no" aria-describedby="sticker_no" placeholder="visa sticker No." class="form-control bg-transparent">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label>Visa Expiry date</label>
                                                                                    <input type="date" name="visa_expiry_date" aria-describedby="sticker_no" placeholder="visa sticker No." class="form-control bg-transparent">
                                                                                </div>

                                                                                <!---->
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label>Visa Ref No.</label>
                                                                                    <input type="text" name="visa_reference_no" aria-describedby="visa_advice_no" placeholder="visa ref No." class="form-control bg-transparent">
                                                                                    <!---->
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Sponsor ID </label>
                                                                                    <input type="text" name="sponsor_id" placeholder="Enter your sponsor id" class="form-control">
                                                                                    <!---->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 my-3 my-md-0">
                                                                    <div class="npm_left">
                                                                        <h5 style="color: rgb(17, 125, 124);">Bank Account Info</h5>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Account holder</label>
                                                                                    <input type="text" name="account_holder_name" placeholder="account holders name" class="form-control bg-transparent">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Account No</label>
                                                                                    <input type="text" name="account_number" placeholder="account no" class="form-control bg-transparent">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Bank Name</label>
                                                                                    <select name="bank_id" id="exampleFormControlSelect1" class="form-control">
                                                                                        <option value="">Select Bank name</option>
                                                                                        @foreach($banks as $bankData)
                                                                                            <option value="{{$bankData->id}}">{{$bankData->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="npm_left">
                                                                        <h5 style="color: rgb(17, 125, 124);">Medical</h5>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Medical Center</label>
                                                                                    <select name="hospital_id" id="exampleFormControlSelect1" class="form-control">
                                                                                        <option value="">Select medical center</option>
                                                                                        @foreach($hospital as $hospitalData)
                                                                                            <option value="{{$hospitalData->id}}">{{$hospitalData->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="new_profile_bottom">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="npb_item">
                                                                        <div class="media">
                                                                            <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="..." class="me-3" style="width: 50px;">
                                                                            <div class="media-body">
                                                                                <a href="#" class="float-right">
                                                                                    <i class="fas fa-edit" style="color: rgb(17, 125, 124);"></i>
                                                                                </a>
                                                                                <p class="mt-0 mb-0">
                                                                                    <b>Visa <br> Documents </b>
                                                                                </p>
                                                                                <input type="file" name="visa_file" id="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="npb_item">
                                                                        <div class="media">
                                                                            <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="..." class="me-3" style="width: 50px;">
                                                                            <div class="media-body">
                                                                                <a href="#" class="float-right">
                                                                                    <i class="fas fa-edit" style="color: rgb(17, 125, 124);"></i>
                                                                                </a>
                                                                                <p class="mt-0 mb-0">
                                                                                    <b>Employment <br> Contract </b>
                                                                                </p>
                                                                                <input type="file" name="employment_contract_file" id="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="npb_item">
                                                                        <div class="media">
                                                                            <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="..." class="me-3" style="width: 50px;">
                                                                            <div class="media-body">
                                                                                <a href="#" class="float-right">
                                                                                    <i class="fas fa-edit" style="color: rgb(17, 125, 124);"></i>
                                                                                </a>
                                                                                <p class="mt-0 mb-0">
                                                                                    <b>Proof of Bank <br> Account </b>
                                                                                </p>
                                                                                <input type="file" name="proof_of_bank_account_file" id="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="npb_item">
                                                                        <div class="media">
                                                                            <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="..." class="me-3" style="width: 50px;">
                                                                            <div class="media-body">
                                                                                <a href="#" class="float-right">
                                                                                    <i class="fas fa-edit" style="color: rgb(17, 125, 124);"></i>
                                                                                </a>
                                                                                <p class="mt-0 mb-0">
                                                                                    <b>Medical <br> Clearance </b>
                                                                                </p>
                                                                                <input type="file" name="medical_clearance_file" id="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><br>
                                                        <!-- Hidden input fields for additional parameters -->
                                                        <input type="hidden" name="passport_info_id" id="passport_info_add" value="">
                                                        <input type="hidden" name="pdo_approval_status" id="pdo_approval_add" value="">
                                                        <input type="hidden" name="bmet_verification_registration_no" id="verification_registration_no_add" value="">
                                                        <input type="hidden" name="job_clearance_id" value="{{$clearance->id}}">
                                                        <div class="d-flex justify-content-end w-100">
                                                            <button type="submit" class="btn px-5 btn-position mr-5 btn-primary"> Candidate Clearance</button>
                                                        </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                {{-- Add Bulk Candidates --}}
                                <div class="modal fade" tabindex="-1" id="add_bulk_candidate">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header row">
                                                <div class="col-10 offset-1 text-center">
                                                    <h5 class="modal-title custom_modal_title">
                                                        Candidates Search
                                                    </h5>
                                                </div>
                                                <div class="col-12 col-md-1 text-right">
                                                    <a href="#" data-bs-dismiss="modal" aria-label="Close" class="text-right pt-3 pr-3">
                                                        <img src="{{ URL::to('assets/media/close.png') }}" alt="Close" style="height: 20px; margin-top: -25px; margin-right: -20px;">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="table-responsive complete_application_table">
                                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-hover training_table dataTable no-footer dtr-inline" id="candidate_datatable">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Sl</th>
                                                    <th class="text-center">Full Name</th>
                                                    <th class="text-center">Passport No</th>
                                                    <th class="text-center">Visa No</th>
                                                    <th class="text-center">PDO Certificate</th>
                                                    <th class="text-center">BMET No</th>
                                                    <th class="text-center">Biometric Status</th>
                                                    <th class="text-center">Employment Contract</th>
                                                    <th class="text-center">Job</th>
                                                    <th class="text-center">Employer Name</th>
                                                    <th class="text-center">Completion Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($clearance->candidateClearances as $key=>$candidateClearancesData)
                                                <tr>
                                                    <td class="text-center">{{$key+1}}</td>
                                                    <td class="text-center">
                                                        {{$candidateClearancesData? $candidateClearancesData->passportInfo->full_name:''}}</td>
                                                    <td class="text-center">
                                                        {{$candidateClearancesData? $candidateClearancesData->passportInfo->passport_no:''}}</td>
                                                    </td>
                                                    <td class="text-center">
                                                        {{$candidateClearancesData? $candidateClearancesData->passportInfo->visaInfo->visa_no:''}}</td>
                                                    </td>
                                                    <td class="text-center">
                                                        @if($candidateClearancesData? $candidateClearancesData->passportInfo->pdoInfo->certificate_status==1:'')
                                                            <img src="{{ asset('assets/media/ok.png') }}">
                                                        @else
                                                            <img src="{{ asset('assets/media/close.png') }}">
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($candidateClearancesData? $candidateClearancesData->passportInfo->verificationInfo->bmet_verification_registration_no !=null : '')
                                                            <img src="{{ asset('assets/media/ok.png') }}">
                                                        @else
                                                            <img src="{{ asset('assets/media/close.png') }}">
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($candidateClearancesData? $candidateClearancesData->passportInfo->verificationInfo->biometric_status==1:'')
                                                            <img src="{{ asset('assets/media/ok.png') }}">
                                                        @else
                                                            <img src="{{ asset('assets/media/close.png') }}">
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($candidateClearancesData? $candidateClearancesData->application_no !=null:'')
                                                            <img src="{{ asset('assets/media/ok.png') }}">
                                                        @else
                                                            <img src="{{ asset('assets/media/close.png') }}">
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        {{$candidateClearancesData? $candidateClearancesData->job->jobCategory->job_category_name:''}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$candidateClearancesData? $candidateClearancesData->job->employee_name:''}}
                                                    </td>
                                                    <td class="text-center">
                                                        @if($candidateClearancesData? $candidateClearancesData->status==1:'')
                                                            <img src="{{ asset('assets/media/ok.png') }}">
                                                        @else
                                                            <img src="{{ asset('assets/media/close.png') }}">
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group dropstart action_button_wrapper">
                                                            <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa-solid fa-angles-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu action_dropdown_menu">
                                                                <li>
                                                                    <a class="dropdown-item" href="#"><i class="fa-solid fa-eye"></i> Continue </a>
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

                        <div class="tab-pane fade" id="summary" role="tabpanel">
                            <div class="info_bmet_clearence mt-5 mb-10">
                                <ul class="d-md-flex d-block justify-content-between">
                                    <li class="mb-md-0 mb-2">
                                        <i class="fas fa-check-circle"></i> 0 Candidates are Ready for BMET Clearance
                                    </li>
                                    <li>
                                        <i class="fas fa-times-circle text-danger"></i> 0 candidates have been left out due to incomplete information
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <i class="far fa-edit"></i> Go to draft candidates to complete the remaining candidates' information
                                    </li>
                                </ul>
                            </div>
                            <div class="search_filter_btn mt-5">
                                <p class="pt-2 text-center">
                                    <b>Candidates submitting for clearance</b>
                                </p>
                                <div class="row">
                                    <div class="col-xxl-6 offset-xxl-3 col-md-10 offset-md-1">
                                        <div class="table-responsive">
                                            <table class="table clearane_table">
                                                <thead style="background: rgba(17, 125, 124, 0.2);">
                                                <tr>
                                                    <th scope="col" class="text-center">Job</th>
                                                    <th scope="col" class="text-center">Employee quota (as per demand letter) </th>
                                                    <th scope="col" class="text-center">Remaining quota</th>
                                                    <th scope="col" class="text-center">Submitting candidates</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($clearance->jobClearances as $jobClearancesData)
                                                    <tr>
                                                        <td class="text-center">{{$jobClearancesData->jobManagement->jobCategory->job_category_name}}({{$jobClearancesData->jobManagement->employee_name}})</td>
                                                        <td class="text-center">{{$jobClearancesData->jobManagement->no_of_post}}</td>
                                                        <td class="text-center">{{$jobClearancesData->jobManagement->no_of_post_already_finished}}</td>
                                                        <td class="text-center">
                                                            {{$jobClearancesData->jobManagement->no_of_post  - $jobClearancesData->jobManagement->no_of_post_already_finished}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive complete_application_table">
                                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-hover training_table dataTable no-footer dtr-inline" id="summary_datatable">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Sl</th>
                                                    <th class="text-center">Name Of Candidates</th>
                                                    <th class="text-center">Passport No</th>
                                                    <th class="text-center">PDO certificate No</th>
                                                    <th class="text-center">Visa No</th>
                                                    <th class="text-center">Job</th>
                                                    <th class="text-center">Visa Type</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($clearance->candidateClearances as $key=>$clearanceCandidateData)
                                                <tr>
                                                    <td class="text-center">{{$key+1}}</td>
                                                    <td class="text-center">{{$clearanceCandidateData? $clearanceCandidateData->passportInfo->full_name:''}}</td>
                                                    <td class="text-center">{{$clearanceCandidateData? $clearanceCandidateData->passportInfo->passport_no:''}}</td>
                                                    <td class="text-center">{{$clearanceCandidateData? $clearanceCandidateData->passportInfo->pdoInfo->certificate_no:''}}</td>
                                                    <td class="text-center">{{$clearanceCandidateData? $clearanceCandidateData->passportInfo->visaInfo->visa_no:''}}</td>
                                                    <td class="text-center">{{$clearanceCandidateData? $clearanceCandidateData->job->jobCategory->job_category_name:''}}</td>
                                                    <td class="text-center">
                                                        @if($clearanceCandidateData ? $clearanceCandidateData->passportInfo->visaInfo->status==1:'')
                                                            <img src="{{ asset('assets/media/ok.png') }}">
                                                        @else
                                                            <img src="{{ asset('assets/media/close.png') }}">
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group dropstart action_button_wrapper">
                                                            <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa-solid fa-angles-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu action_dropdown_menu">
                                                                <li>
                                                                    <a class="dropdown-item" href="#"><i class="fa-solid fa-eye"></i> Continue </a>
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
                        <div class="tab-pane fade" id="payment" role="tabpanel">
                            <div class="row mb-10">
                                <div class="col-md-10 offset-md-1 border rounded pt-5">
                                    <div class="d-md-flex d-block justify-content-center">
                                        <div class="csp_item">
                                            <p>
                                                <img src="{{ URL::to('assets/media/clearance/csp_1.png') }}" alt="">
                                                <b>RA is submitting 0 candidates</b>
                                            </p>
                                        </div>
                                        <div class="csp_item px-0 px-md-5">
                                            <p>
                                                <img src="{{ URL::to('assets/media/clearance/csp_2.png') }}" alt="">
                                                <b>RA has previously paid for 0 unsuccessful candidates</b>
                                            </p>
                                        </div>
                                        <div class="csp_item">
                                            <p>
                                                <img src="{{ URL::to('assets/media/clearance/csp_3.png') }}" alt="">
                                                <b>Now RA is only paying for 0 candidates</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-danger">Please check the summary carefully to make payment</div>


                            @if($clearance->candidateClearancePayment === null || $clearance->candidateClearancePayment->count() === 0)
                                {{-- Add your content or actions here --}}
                                <div class="alert alert-danger text-center">
                                    <a style="color:#fff;" href="{{ route('recruiting-agency.clearance.payment', $clearance->id) }}">Payment</a>
                                </div>
                            @else
                                {{-- Add your content or actions here --}}
                                <div class="alert alert-success text-center">
                                    Payment already made!
                                </div>
                            @endif


                            <div class="text-center">
                                <div class="checkItem mb-8">
                                    <label class="checkbox checkbox-lg">
                                        <input type="checkbox" class="" value="">
                                        <span style="width: 18px; height: 18px;"></span>
                                        <b>I hereby acknowledge that the information provided in this application procedure is correct to the best of my knowledge and I believe that if the information provided is untrue or the documents are false, I may not be granted immigration clearance or if the information provided is false or incorrect.</b>
                                    </label>
                                </div>
                            </div>
                            <div class="table-responsive complete_application_table">
                                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-hover training_table dataTable no-footer dtr-inline" id="payment_datatable">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Sl</th>
                                                    <th class="text-center">Name Of Candidates</th>
                                                    <th class="text-center">Passport No</th>
                                                    <th class="text-center">PDO certificate No</th>
                                                    <th class="text-center">Visa No</th>
                                                    <th class="text-center">Job</th>
                                                    <th class="text-center">Visa Type</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($clearance->candidateClearances as $key=>$clearanceCandidateData)
                                                    <tr>
                                                        <td class="text-center">{{$key+1}}</td>
                                                        <td class="text-center">{{$clearanceCandidateData? $clearanceCandidateData->passportInfo->full_name:''}}</td>
                                                        <td class="text-center">{{$clearanceCandidateData? $clearanceCandidateData->passportInfo->passport_no:''}}</td>
                                                        <td class="text-center">{{$clearanceCandidateData? $clearanceCandidateData->passportInfo->pdoInfo->certificate_no:''}}</td>
                                                        <td class="text-center">{{$clearanceCandidateData? $clearanceCandidateData->passportInfo->visaInfo->visa_no:''}}</td>
                                                        <td class="text-center">{{$clearanceCandidateData? $clearanceCandidateData->job->jobCategory->job_category_name:''}}</td>
                                                        <td class="text-center">
                                                            @if($clearanceCandidateData ? $clearanceCandidateData->passportInfo->visaInfo->status==1:'')
                                                                <img src="{{ asset('assets/media/ok.png') }}">
                                                            @else
                                                                <img src="{{ asset('assets/media/close.png') }}">
                                                            @endif
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
                    <div class="form-group mb-3">
                        <select class="form-select" data-dropdown-parent="#newClearenceApplicationModal" data-control="select2" tabindex="-1" data-placeholder="Please Select a country">
                            <option>Please Select a country</option>
                            <option>Bangladesh</option>
                            <option>Malaysia</option>
                            <option>Qatar</option>
                            <option>Kuwait</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <select class="form-control" id="clearanceType" onchange="toggleGroup()">
                            <option value=""> Select clearance type </option>
                            <option value="Individual">Individual (1-24)</option>
                            <option value="Group">Group</option>
                        </select>
                    </div>
                    <div id="group" style="display:none;">
                        <div class="form-group mb-3">
                            <select class="form-select" data-dropdown-parent="#newClearenceApplicationModal" data-control="select2" tabindex="-1" data-placeholder="Select foreign ref no">
                                <option>Select foreign ref no</option>
                                <option>Bangladesh</option>
                                <option>Malaysia</option>
                                <option>Qatar</option>
                                <option>Kuwait</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <input type="date" name="foreign_ref_date" placeholder="Foreign Reference Date" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control bg-transparent" type="text" placeholder="Ministry Reference No" autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <input type="date" name="ministry_ref_date" placeholder="Ministry Reference Date" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control bg-transparent" type="text" placeholder="BMET Reference No" autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <input type="date" name="bmet_permission_date" placeholder="Date of BMET Reference No" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary">Close</button>
                        <button class="btn px-5 btn-position mr-5 btn-primary"> Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Add More Documents Modal --}}
    <div class="modal fade" tabindex="-1" id="uploadJobWizeOtherDocument">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header row">
                    <div class="col-10 offset-1 text-center">
                        <h5 class="modal-title custom_modal_title">
                            File Info
                        </h5>
                    </div>
                    <div class="col-12 col-md-1 text-right">
                        <a href="#" data-bs-dismiss="modal" aria-label="Close" class="text-right pt-3 pr-3">
                            <img src="{{ URL::to('assets/media/close.png') }}" alt="Close" style="height: 20px; margin-top: -25px; margin-right: -20px;">
                        </a>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-body border_none">
                        <div class="form-group row">
                            <label class="col-form-label text-right col-md-4">Document Name</label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Document Name" class="form-control">
                            </div>
                        </div>
                        <div class="upload_box text-center">
                            <br>
                            <input id="jobWizeOtherdocuemntInput1" accept="image/*,application/pdf" type="file">
                            <br>
                            <span>Supported file format: .jpg, .jpeg, .gif, .svg, .png, .pdf.Maximum file size: 4 MB</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary">Close</button>
                        <button class="btn px-5 btn-position mr-5 btn-primary"> Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ADD Job Details --}}
    <div class="modal fade" tabindex="-1" id="addJobsManuallyModal">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <form action="{{route('recruiting-agency.bmet.clearance.application.step.job.clearance.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header row">
                        <div class="col-10 offset-1 text-center">
                            <h5 class="modal-title custom_modal_title">
                                Add Job Details
                            </h5>
                        </div>
                        <div class="col-12 col-md-1 text-right">
                            <a href="#" data-bs-dismiss="modal" aria-label="Close" class="text-right pt-3 pr-3">
                                <img src="{{ URL::to('assets/media/close.png') }}" alt="Close" style="height: 20px; margin-top: -25px; margin-right: -20px;">
                            </a>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div>
                            <h4 class="mb-5">Employer Details:</h4>
                            <div class="row mb-8">
                                <div class="col-md-3">
                                    <input type="hidden" name="clearance_id" value="{{$clearance->id}}">
                                    <div class="form-group">
                                        <label style="font-size: 11px;">Employer Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="employee_name" placeholder="Please enter a employer name" class="form-control bg-transparent">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 11px;">City</label>
                                        <input type="text" name="city_name" placeholder="Please enter a city name" class="form-control bg-transparent">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 11px;">Employer Address</label>
                                        <input type="text" name="employer_address" placeholder="Please enter a employer address" class="form-control bg-transparent">
                                    </div>
                                </div>
                            </div>
                            <h4 class="mb-5">Job Details</h4>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Visa Attestation Type <span class="text-danger">*</span>
                                        </label>
                                        <select id="job_type" name="job_type" class="form-control bg-transparent">
                                            <option value="attested">Visa attested</option>
                                            <option value="non_attested">Visa non-attested</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Category <span class="text-danger">*</span>
                                        </label>
                                        <select id="category_id" name="category_id" class="form-control select2" style="width: 100%;">
                                            @foreach($jobCategory as $jobCategoryData)
                                                <option value="{{$jobCategoryData->id}}">{{$jobCategoryData->job_category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 11px;">Working hour / per day</label>
                                        <input type="text" name="working_duration"  placeholder="hours per day" class="form-control bg-transparent">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-size: 11px;">Working days</label>
                                                <input type="text" name="working_days" placeholder="Days" class="form-control bg-transparent">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select name="working_on" class="form-control bg-transparent mt-5">
                                                    <option value="month">Month</option>
                                                    <option value="week">Week</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Skill type <span class="text-danger">*</span>
                                        </label>
                                        <select id="skill_type" name="skill_type" class="form-control bg-transparent">
                                            <option value="general"> General </option>
                                            <option value="skilled"> Skilled </option>
                                            <option value="unskilled"> Unskilled </option>
                                            <option value="professional"> Professional </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 11px;">No. of post (as per demand letter) <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="no_of_post" placeholder="Please enter number of post" class="form-control bg-transparent fz11">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-size: 11px;">amount <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="salary_amount" placeholder="Salary Amount" class="form-control bg-transparent">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="fz11">Currency Type <span class="text-danger">*</span>
                                                </label>
                                                <select id="currency_id" name="currency_id" class="form-control select2 bg-transparent" style="width: 100%;">
                                                    @foreach($currency as $currencyData)
                                                        <option value="{{$currencyData->id}}">{{$currencyData->currency_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="fz11">Salary per <span class="text-danger">*</span>
                                        </label>
                                        <select name="salary_per" class="form-control select2 bg-transparent" style="width: 100%;">
                                            <option value="day"> Day </option>
                                            <option value="month"> Month </option>
                                            <option value="year"> Year </option>
                                            <option value="hourly"> Hourly </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Gender Type</label>
                                        <select name="gender" class="form-control bg-transparent">
                                            <option value="1"> Male </option>
                                            <option value="2"> Female </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-size: 11px;">Age range</label>
                                                <input type="text" name="min_age"  placeholder="Min" class="form-control bg-transparent">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-size: 11px;"></label>
                                                <input type="text" name="max_age"  placeholder="Max" class="form-control bg-transparent">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 11px;">Contract tenure (in years) <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="contract_tenure"  placeholder="Please enter the number ex: 30" class="form-control bg-transparent">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Probation</label>
                                        <select name="probation_period" class="form-control bg-transparent">
                                            <option value="0"> Not Applicable </option>
                                            <option value="3"> 3 Month </option>
                                            <option value="4"> 4 Month </option>
                                            <option value="6"> 6 Month </option>
                                            <option value="9"> 9 Month </option>
                                            <option value="12"> 12 Month </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <p class="mt-5">
                                    <b>Other benefits provided by employer</b>
                                </p>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <input type="checkbox" id="is_accommodation" value="1"  name="is_accommodation">
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

                                    <div class="col-lg-4">
                                        <input type="checkbox" id="is_one_way" value="1" name="is_one_way">
                                        <label for="is_one_way">Plane fare one way</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="checkbox" id="is_two_way" value="1" name="is_two_way">
                                        <label for="is_two_way">Plane fare two way</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="checkbox" id="is_other" value="1" name="is_other">
                                        <label for="is_other">Others</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <h3 class="mt-3">Documents</h3>
                        <div class="row">
                            <div class="col-md-3 col-xxl-3">
                                <div>
                                    <div>
                                        <div class="modal-documents m-3">
                                            <div class="items d-flex align-items-center">
                                                <div class="left">
                                                    <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                </div>
                                                <div class="right ms-2">
                                                    <h5>Employment Contract</h5>
                                                    <div class="view-upload">
                                                        <div class="mt-2">
                                                            <input name="work_agreement_file" accept="image/*,application/pdf" type="file">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xxl-3">
                                <div>
                                    <div>
                                        <div class="modal-documents m-3">
                                            <div class="items d-flex align-items-center">
                                                <div class="left">
                                                    <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                </div>
                                                <div class="right ms-2">
                                                    <h5>Job Proof</h5>
                                                    <div class="view-upload">
                                                        <div class="mt-2">
                                                            <input name="employment_permit_file" accept="image/*,application/pdf" type="file">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xxl-3">
                                <div>
                                    <div>
                                        <div class="modal-documents m-3">
                                            <div class="items d-flex align-items-center">
                                                <div class="left">
                                                    <img src="{{ URL::to('assets/media/clearance/jpg.png') }}" alt="" style="width: 70px;">
                                                </div>
                                                <div class="right ms-2">
                                                    <h5>Mail From BHC</h5>
                                                    <div class="view-upload">
                                                        <div class="mt-2">
                                                            <input name="other_file" accept="image/*,application/pdf" type="file">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-end w-100">
                            <button type="submit" class="btn px-5 btn-position mr-5 btn-primary"> Add Job</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="addFromJobPostModal">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <form action="{{ route('recruiting-agency.pull.job.store') }}" method="post" id="addJobsForm">
                    @csrf
                    <div class="modal-header row">
                        <div class="col-10 offset-1 text-center">
                            <h5 class="modal-title custom_modal_title">
                                Posted Job
                            </h5>
                        </div>
                        <div class="col-12 col-md-1 text-right">
                            <a href="#" data-bs-dismiss="modal" aria-label="Close" class="text-right pt-3 pr-3">
                                <img src="{{ URL::to('assets/media/close.png') }}" alt="Close" style="height: 20px; margin-top: -25px; margin-right: -20px;">
                            </a>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive complete_application_table">
                            <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-hover training_table dataTable no-footer dtr-inline" id="pullFormPostedJobs">
                                            <thead>
                                            <tr>
                                                <th class="text-center">
                                                    <input type="checkbox" id="selectAllPostedJobsInCheckbox" value="false">
                                                </th>
                                                <th class="text-center">Job</th>
                                                <th class="text-center">Country</th>
                                                <th class="text-center">Job Type</th>
                                                <th class="text-center">Employer</th>
                                                <th class="text-center">No. of Post</th>
                                                <th class="text-center">Posted Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($pullJobs as $key=>$pullJobData)
                                                <tr>
                                                    <td class="text-center">
                                                        <input type="checkbox" value="{{$pullJobData->id}}" class="rowCheckbox" data-user-id="{{ auth()->user()->id }}">
                                                    </td>
                                                    <td class="text-center">{{$pullJobData->jobCategory->job_category_name}}</td>
                                                    <td class="text-center">{{$pullJobData->country->country_name}}</td>
                                                    <td class="text-center">{{$pullJobData->job_type}}</td>
                                                    <td class="text-center">{{$pullJobData->employee_name}}</td>
                                                    <td class="text-center">{{$pullJobData->no_of_post_already_finished}}</td>
                                                    <td class="text-center">{{$pullJobData->created_at}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-center w-100">
                            <button type="button" class="btn px-5 btn-position mr-5 btn-primary" id="addJobsBtn"> Add Jobs</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    <script>
        $(document).ready(function () {
            $('#passport_no').on('input', function () {
                var passportNumber = $(this).val();
                if (passportNumber) {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route("recruiting-agency.passport.details.for.clearance") }}',
                        data: { passport_no: passportNumber },
                        success: function (data) {
                            // Clear previous not found messages
                            $('.not-found-text').text("");
                            console.log(data);
                            if (data.full_name) {
                                $('.name_data').html("Name: <b>" + data.full_name + "</b>");
                            } else {
                                $('.name_data').html("Name: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.phone) {
                                $('.phone_data').html("Phone: <b>" + data.phone + "</b>");
                            } else {
                                $('.phone_data').html("Phone: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.gender) {
                                var genderText = data.gender === 1 ? 'Male' : 'Female';
                                $('.gender_data').html("Gender: <b>" + genderText + "</b>");
                            } else {
                                $('.gender_data').html("Gender: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.dob) {
                                var dobDate = new Date(data.dob);
                                var options = { year: 'numeric', month: 'long', day: 'numeric' };
                                var formattedDob = dobDate.toLocaleDateString('en-US', options);
                                $('.dob_data').html("Date of birth: <b>" + formattedDob + "</b>");
                            } else {
                                $('.dob_data').html("Date of birth: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.passport_no) {
                                $('.passport_number_data').html("Passport Number: <b>" + data.passport_no + "</b>");
                            } else {
                                $('.passport_number_data').html("Passport Number: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.passport_issue_date) {
                                var issueDate = new Date(data.passport_issue_date);
                                var options = { year: 'numeric', month: 'long', day: 'numeric' };
                                var formattedDate = issueDate.toLocaleDateString('en-US', options);
                                $('.passport_issue_data').html("Issue date: <b>" + formattedDate + "</b>");
                            } else {
                                $('.passport_issue_data').html("Issue date: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.passport_expiry_date) {
                                var expiryDate = new Date(data.passport_expiry_date);
                                var options = { year: 'numeric', month: 'long', day: 'numeric' };
                                var formattedDate = expiryDate.toLocaleDateString('en-US', options);
                                $('.passport_expiry_data').html("Expiry date: <b>" + formattedDate + "</b>");
                            } else {
                                $('.passport_expiry_data').html("Expiry date: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.pdo_info && data.pdo_info.certificate_no) {
                                $('.certificate_no_data').html("Certificate No: <b>" + data.pdo_info.certificate_no + "</b>");
                            } else {
                                $('.certificate_no_data').html("Certificate No: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.pdo_info && data.pdo_info.training_center.training_center_by_user.name) {
                                $('.ttc_data').html("TTC Name: <b>" + data.pdo_info.training_center.training_center_by_user.name + "</b>");
                            } else {
                                $('.ttc_data').html("TTC Name: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.verification_info && data.verification_info.bmet_verification_registration_no) {
                                $('.certificate_verification_data').html("Registration ID: <b>" + data.verification_info.bmet_verification_registration_no + "</b>");
                            } else {
                                $('.certificate_verification_data').html("Registration ID: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.verification_info && data.verification_info.biometric_status) {
                                var biometricStatus = data.verification_info.biometric_status === 1 ? 'YES' : 'NO';
                                $('.biometric_data').html("Biometric Status: <b>" + biometricStatus + "</b>");
                            } else {
                                $('.biometric_data').html("Biometric Status: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }
                            // Set additional hidden input values
                            $('#passport_info').val(data.id);
                            $('#pdo_approval').val(data.pdo_info.approval_status);
                            $('#verification_registration_no').val(data.verification_info.bmet_verification_registration_no);

                        },
                        error: function () {
                            // Handle error case, e.g., display a not found message
                            $('.not-found-text').text("NOT FOUND!");
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#passport_no_add').on('input', function () {
                var passportNumber = $(this).val();
                if (passportNumber) {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route("recruiting-agency.passport.details.for.clearance.add.candidate") }}',
                        data: { passport_no: passportNumber },
                        success: function (data) {
                            // Clear previous not found messages
                            $('.not-found-text').text("");

                            console.log(data);

                            if (data.full_name) {
                                $('.name_data_add').html("Name: <b>" + data.full_name + "</b>");
                            } else {
                                $('.name_data_add').html("Name: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.phone) {
                                $('.phone_data_add').html("Phone: <b>" + data.phone + "</b>");
                            } else {
                                $('.phone_data_add').html("Phone: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.gender) {
                                var genderText = data.gender === 1 ? 'Male' : 'Female';
                                $('.gender_data_add').html("Gender: <b>" + genderText + "</b>");
                            } else {
                                $('.gender_data_add').html("Gender: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.dob) {
                                var dobDate = new Date(data.dob);
                                var options = { year: 'numeric', month: 'long', day: 'numeric' };
                                var formattedDob = dobDate.toLocaleDateString('en-US', options);
                                $('.dob_data_add').html("Date of birth: <b>" + formattedDob + "</b>");
                            } else {
                                $('.dob_data_add').html("Date of birth: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.passport_no) {
                                $('.passport_number_data_add').html("Passport Number: <b>" + data.passport_no + "</b>");
                            } else {
                                $('.passport_number_data_add').html("Passport Number: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.passport_issue_date) {
                                var issueDate = new Date(data.passport_issue_date);
                                var options = { year: 'numeric', month: 'long', day: 'numeric' };
                                var formattedDate = issueDate.toLocaleDateString('en-US', options);
                                $('.passport_issue_data_add').html("Issue date: <b>" + formattedDate + "</b>");
                            } else {
                                $('.passport_issue_data_add').html("Issue date: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.passport_expiry_date) {
                                var expiryDate = new Date(data.passport_expiry_date);
                                var options = { year: 'numeric', month: 'long', day: 'numeric' };
                                var formattedDate = expiryDate.toLocaleDateString('en-US', options);
                                $('.passport_expiry_data_add').html("Expiry date: <b>" + formattedDate + "</b>");
                            } else {
                                $('.passport_expiry_data_add').html("Expiry date: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.pdo_info && data.pdo_info.certificate_no) {
                                $('.certificate_no_data_add').html("Certificate No: <b>" + data.pdo_info.certificate_no + "</b>");
                            } else {
                                $('.certificate_no_data_add').html("Certificate No: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            if (data.pdo_info && data.pdo_info.training_center.training_center_by_user.name) {
                                $('.ttc_data_add').html("TTC Name: <b>" + data.pdo_info.training_center.training_center_by_user.name + "</b>");
                            } else {
                                $('.ttc_data_add').html("TTC Name: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }


                            if (data.verification_info && data.verification_info.bmet_verification_registration_no) {
                                $('.certificate_verification_data_add').html("Registration ID: <b>" + data.verification_info.bmet_verification_registration_no + "</b>");
                            } else {
                                $('.certificate_verification_data_add').html("Registration ID: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }



                            if (data.verification_info && data.verification_info.biometric_status) {
                                var biometricStatus = data.verification_info.biometric_status === 1 ? 'YES' : 'NO';
                                $('.biometric_data_add').html("Biometric Status: <b>" + biometricStatus + "</b>");
                            } else {
                                $('.biometric_data_add').html("Biometric Status: <b><span class='not-found-text'>NOT FOUND!</span></b>");
                            }

                            // Set additional hidden input values
                            $('#passport_info_add').val(data.id);
                            $('#pdo_approval_add').val(data.pdo_info.approval_status);
                            $('#verification_registration_no_add').val(data.verification_info.bmet_verification_registration_no);


                        },
                        error: function () {
                            // Handle error case, e.g., display a not found message
                            $('.not-found-text').text("NOT FOUND!");
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            let pullFormPostedJobs = $('#pullFormPostedJobs').DataTable();
            // Select All checkbox functionality
            $('#selectAllPostedJobsInCheckbox').on('change', function () {
                $('.rowCheckbox').prop('checked', $(this).prop('checked'));
            });

            // Individual row checkbox functionality
            $('.rowCheckbox').on('change', function () {
                if (!$(this).prop('checked')) {
                    $('#selectAllPostedJobsInCheckbox').prop('checked', false);
                } else {
                    // Check if all individual checkboxes are checked
                    if ($('.rowCheckbox:checked').length === $('.rowCheckbox').length) {
                        $('#selectAllPostedJobsInCheckbox').prop('checked', true);
                    }
                }
            });
        });
        $(document).ready(function () {
            let addBulkCandidate = $('#addBulkCandidate').DataTable();
            // Select All checkbox functionality
            $('#selectBulkCandidate').on('change', function () {
                $('.bulkRowCheckbox').prop('checked', $(this).prop('checked'));
            });

            // Individual row checkbox functionality
            $('.bulkRowCheckbox').on('change', function () {
                if (!$(this).prop('checked')) {
                    $('#selectBulkCandidate').prop('checked', false);
                } else {
                    // Check if all individual checkboxes are checked
                    if ($('.bulkRowCheckbox:checked').length === $('.bulkRowCheckbox').length) {
                        $('#selectBulkCandidate').prop('checked', true);
                    }
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            // Add Jobs button click event
            $('#addJobsBtn').on('click', function () {
                var selectedJobs = [];
                var clearanceId = {{ $clearance->id }}; // Assuming $clearance is available in the view
                // Loop through each selected checkbox
                $('.rowCheckbox:checked').each(function () {
                    var jobId = $(this).val();
                    var userId = $(this).data('user-id');
                    selectedJobs.push({ jobId: jobId, userId: userId });
                });
                // Disable the button and show loader
                $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Loading...');
                // Perform an AJAX request to send the selected jobs to the server
                $.ajax({
                    type: 'POST',
                    url: '{{ route("recruiting-agency.pull.job.store") }}',
                    data: { selectedJobs: selectedJobs, clearanceId: clearanceId, _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        // Re-enable the button and hide loader
                        $('#addJobsBtn').prop('disabled', false).html('Add Jobs');
                        // Handle the response from the server
                        if (response.success) {
                            $('#addFromJobPostModal').modal('hide');
                            setTimeout(function () {
                                window.location.href = '{{ route("recruiting-agency.bmet.clearance.application.step", ['id' => $clearance->id]) }}';
                            }, 1000); // Delay in milliseconds
                        } else {
                            // Show an error message (you may customize this part)
                            alert('Error adding jobs: ' + response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Re-enable the button and hide loader in case of an error
                        $('#addJobsBtn').prop('disabled', false).html('Add Jobs');
                        // Show an error message (you may customize this part)
                        alert('Error adding jobs: ' + error);
                    }
                });
            });
        });
    </script>
@endsection
