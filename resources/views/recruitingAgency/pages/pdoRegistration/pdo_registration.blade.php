@extends('layouts.recruitingAgency.master')
@section('content')
    <style>
        .bmet_reg_button_style {
            color: #fff;
        }
        .previous_btn_style:hover > a {
            color: #fff;
        }
        .stepper-item.active {
            background-color: #009ef724 !important;
        }
        .stepper-item.active .stepper-title {
            color: #009ef7 !important;
        }

        #mailingAddressWrapper {
            display: none;
        }


        .float-right {
            float: right!important;
        }
        .date_qr b {
            color: #464e5f;
        }
        #btnEnrollmentDownload,
        #btnEnrollmentPrint,
        #id_payment_other {
            background-color: #009ef7;
            width: 130px;
            color: #fff;
            border: 1px solid #009ef7;
            padding: 0.65rem 1rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.42rem;
            margin-right: 5px;
            transition: all 0.3s ease-in-out;
        }
        #btnEnrollmentPrint {
            background-color: #e5eaee;
            color: #464e5f;
        }
        #btnEnrollmentPrint:hover {
            background-color: #d6d6e0;
        }
        #btnEnrollmentDownload:hover,
        #id_payment_other:hover {
            background-color: #0063b1;
            border-color: #0063b1;
        }
        /* Image */
        .custom-file {
            width: 100%;
            position: relative;
            display: inline-block;
            width: 100%;
            height: calc(1.5em + 1.3rem + 2px);
            margin-bottom: 0;
        }
        .custom-file-input {
            position: relative;
            z-index: 2;
            width: 100%;
            height: calc(1.5em + 1.3rem + 2px);
            margin: 0;
            opacity: 0;
        }
        .form-group label {
            font-size: 1rem;
            font-weight: 400;
            color: #464e5f;
        }
        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .custom-file-label {
            text-align: left;
        }
        .custom-file-input:lang(en)~.custom-file-label::after {
            content: "Browse";
        }
        .custom-file-label:after {
            float: left;
        }
        .custom-file-label {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1;
            height: calc(1.5em + 1.3rem + 2px);
            padding: .65rem 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #464e5f;
            background-color: #fff;
            border: 1px solid #e5eaee;
            border-radius: .42rem;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .custom-file-label::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            z-index: 3;
            display: block;
            height: calc(1.5em + 1.3rem);
            padding: .65rem 1rem;
            line-height: 1.5;
            color: #464e5f;
            content: "Browse";
            background-color: #f3f6f9;
            border-left: inherit;
            border-radius: 0 .42rem .42rem 0;
        }
    </style>
    <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-4">
                    </div>
                    <div class="col-4 text-center">
                        <h1 class="text-dark fw-bold my-1 fs-3">New PDO Registration</h1>
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
        </div>

        @php
            $id = request()->segment(4);
            $pdoCandidate = \App\Models\RecruitingAgency\PdoCandidateRegistration::where('id', $id)->first();
        @endphp
        <div class="post d-flex flex-column-fluid">
           <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="stepper stepper-links d-flex flex-column">
                            <div class="mx-auto w-100">
                                <div class="stepper-nav mb-5">

                                    <a href="{{ route('recruiting-agency.pdo.registration', ['id' => $id,'type' => 'personal-info']) }}" class="stepper-item step_active_style" data-kt-stepper-element="nav">
                                        <h3 class="stepper-title">
                                            Personal Information
                                        </h3>
                                    </a>

                                    @if($pdoCandidate ? ($pdoCandidate->step_no==1 || $pdoCandidate->step_no==2 || $pdoCandidate->step_no==3 || $pdoCandidate->step_no==4):'')
                                    <a href="{{ route('recruiting-agency.pdo.registration', ['id' => $id,'type' => 'batch-info']) }}" class="stepper-item step_active_style" data-kt-stepper-element="nav">
                                        <h3 class="stepper-title">
                                            Batch Information
                                        </h3>
                                    </a>
                                    @else
                                    <a  class="stepper-item" data-kt-stepper-element="nav">
                                        <h3 class="stepper-title">
                                            Batch Information
                                        </h3>
                                    </a>
                                    @endif

                                    @if($pdoCandidate ?($pdoCandidate->step_no==2 || $pdoCandidate->step_no==3 || $pdoCandidate->step_no==4):'')
                                    <a href="{{ route('recruiting-agency.pdo.registration', ['id' => $id,'type' => 'payment-info']) }}" class="stepper-item step_active_style" data-kt-stepper-element="nav">
                                        <h3 class="stepper-title">
                                            Payment Information
                                        </h3>
                                    </a>
                                    @else
                                    <a  class="stepper-item" data-kt-stepper-element="nav">
                                        <h3 class="stepper-title">
                                            Payment Information
                                        </h3>
                                    </a>
                                    @endif

                                    @if($pdoCandidate? ($pdoCandidate->step_no==3 || $pdoCandidate->step_no==4):'')
                                    <a href="{{ route('recruiting-agency.pdo.registration', ['id' => $id,'type' => 'upload-photo']) }}" class="stepper-item step_active_style" data-kt-stepper-element="nav">
                                        <h3 class="stepper-title">
                                            Upload Photo
                                        </h3>
                                    </a>
                                    @else
                                    <a class="stepper-item" data-kt-stepper-element="nav">
                                        <h3 class="stepper-title">
                                            Upload Photo
                                        </h3>
                                    </a>
                                    @endif

                                    @if($pdoCandidate? $pdoCandidate->step_no==4:'')
                                    <a href="{{ route('recruiting-agency.pdo.registration', ['id' => $id,'type' => 'enrollment-card']) }}" class="stepper-item step_active_style" data-kt-stepper-element="nav">
                                        <h3 class="stepper-title">
                                            Enrollment Card
                                        </h3>
                                    </a>
                                    @else
                                    <a  class="stepper-item" data-kt-stepper-element="nav">
                                        <h3 class="stepper-title">
                                            Enrollment Card
                                        </h3>
                                    </a>
                                    @endif
                                </div>

                                <div class="tab-content mx-auto w-100" id="kt_create_account_form">
                                    <div class="tab-pane fade {{ $type === 'personal-info' ? 'in active show' : '' }}" id="tab-1st">
                                        <div class="w-100">
                                            <form method="post" action="{{ route('recruiting-agency.pdo.registration', ['id' => $id, 'type' => 'personal-info']) }}" enctype="multipart/form-data" >
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="passportNumber">Passport no<span style="color: red;">*</span></label>
                                                        <input type="text" placeholder="Enter your passport number" id="passport_no" name="passport_no"  required="required" minlength="9" maxlength="9" value="{{ old('passport_no', $pdoInfo->passport_no ?? '') }}" class="form-control bg-transparent @error('passport_no') is-invalid @enderror" />
                                                        @error('passport_no')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="gender">Gender <span style="color: red;">*</span></label>
                                                        <select id="gender" name="gender" required="required" class="form-select bg-transparent @error('gender') is-invalid @enderror">
                                                            <option value="1" {{ (isset($pdoInfo) && $pdoInfo->gender == 1) ? 'selected' : '' }}>Male</option>
                                                            <option value="2" {{ (isset($pdoInfo) && $pdoInfo->gender == 2) ? 'selected' : '' }}>Female</option>
                                                        </select>
                                                        @error('gender')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="passportNumber">Name<span style="color: red;">*</span></label>
                                                        <input type="text" placeholder="Enter your name" id="full_name" name="full_name" value="{{ old('full_name', $pdoInfo->full_name ?? '') }}"   class="form-control bg-transparent @error('full_name') is-invalid @enderror" />
                                                        @error('full_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="gender">Religion <span style="color: red;">*</span></label>
                                                        <select id="religion_id" name="religion_id" required="required" class="form-select bg-transparent @error('religion_id') is-invalid @enderror" >
                                                            <option>Select You Religion</option>
                                                            @foreach($religion as $religionData)
                                                                <option value="{{ $religionData->id }}" {{ old('religion_id', isset($pdoInfo) ? $pdoInfo->religion_id : '') == $religionData->id ? 'selected' : '' }}>
                                                                    {{ $religionData->religion_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('religion_id')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label>Father Name<span style="color: red;">*</span></label>
                                                        <input type="text" placeholder="Enter your father name" id="fathers_name" name="fathers_name" value="{{ old('fathers_name', $pdoInfo->fathers_name ?? '') }}"  class="form-control bg-transparent @error('fathers_name') is-invalid @enderror" />
                                                        @error('fathers_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="mobileNumber">NID <span style="color: red;">*</span></label>
                                                        <input type="text" placeholder="Enter your nid" name="nid_no"  required="required"  id="nid_no" value="{{ old('nid_no', $pdoInfo->nid_no ?? '') }}"  class="form-control bg-transparent @error('nid_no') is-invalid @enderror" />
                                                        @error('nid_no')
                                                        <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label>Mother Name<span style="color: red;">*</span></label>
                                                        <input type="text" placeholder="Enter your mother name" id="mothers_name" name="mothers_name" value="{{ old('mothers_name', $pdoInfo->mothers_name ?? '') }}"  class="form-control bg-transparent @error('mothers_name') is-invalid @enderror" />
                                                        @error('mothers_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="mobileNumber">Phone <span style="color: red;">*</span></label>
                                                        <input type="text" placeholder="Enter your phone" name="phone"  required="required"  id="phone" value="{{ old('phone', $pdoInfo->phone ?? '') }}"   class="form-control bg-transparent @error('phone') is-invalid @enderror" />
                                                        @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label>Date of birth<span style="color: red;">*</span></label>
                                                        <input type="date" placeholder="Enter your Date of birth" id="dob" name="dob" value="{{ old('dob', $pdoInfo->dob ?? '') }}" class="form-control bg-transparent @error('dob') is-invalid @enderror" />
                                                        @error('dob')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="email">Email <span style="color: red;">*</span></label>
                                                        <input type="text" placeholder="Enter your email" name="email"  required="required"  id="email" value="{{ old('dob', $pdoInfo->email ?? '') }}"   class="form-control bg-transparent @error('phone') is-invalid @enderror" />
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <input hidden="" type="text" id="passport_info_id" name="passport_info_id" />
                                                </div>

                                                <div class="row">
                                                    <div class="d-flex flex-stack justify-content-end pt-15">
                                                        <div>
                                                            <a href="{{ route('recruiting-agency.pdo.registration', ['id' => $id,'type' => 'personal-info']) }}">
                                                                <button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
                                                                    Next <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i>
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade {{ $type === 'batch-info' ? 'in active show' : '' }}" id="tab-1st">
                                        <div class="w-100">
                                            <form method="post" action="{{ route('recruiting-agency.pdo.registration', ['id' => $id, 'type' => 'batch-info']) }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="row">
                                                            <div class="col-12 mb-4">
                                                                <label>Ttc<span style="color: red;">*</span></label>
                                                                <select name="training_center_id" id="trainingCenterSelect" required="required" class="form-select bg-transparent" data-hide-search="true">
                                                                    <option value="">Select</option>
                                                                    @foreach($ttc as $trainingCenter)
                                                                        <option value="{{ $trainingCenter->id }}" {{ old('training_center_id', isset($pdoInfo) ? $pdoInfo->training_center_id : '') == $trainingCenter->id ? 'selected' : '' }}>
                                                                            {{ $trainingCenter->trainingCenterByUser->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12  mb-4">
                                                                <label for="currency_id">Country <span style="color: red;">*</span></label>
                                                                <select id="currency_id" name="currency_id" required="required" class="form-select bg-transparent @error('currency_id') is-invalid @enderror" data-hide-search="true">
                                                                    <option value="">Select</option>
                                                                    @foreach($currency as $currencyData)
                                                                        <option value="{{ $currencyData->id }}" {{ old('currency_id', isset($pdoInfo) ? $pdoInfo->currency_id : '') == $currencyData->id ? 'selected' : '' }}>
                                                                            {{ $currencyData->country_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('currency_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                   <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-12 mb-4">
                                                                <label>Schedule <span style="color: red;">*</span></label>
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Batch Number</th>
                                                                        <th>Date Range</th>
                                                                        <th>Class Time</th>
                                                                        <th>PDO Type</th>
                                                                        <th>Available</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="scheduleTableBody">
                                                                    <!-- Schedule data will be populated here dynamically with radio buttons -->
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="row">
                                                            <div class="col-12 mb-4">
                                                                <div id="calendar"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-stack pt-15">
                                                    <div class="mr-2">
                                                        <a href="{{ route('recruiting-agency.pdo.registration', ['id' => $id,'type' => 'personal-info']) }}">
                                                            <button type="button" class="btn btn-lg btn-light-primary me-3 previous_btn_style">
                                                                <i class="ki-outline ki-arrow-left fs-4 me-1"></i> Back
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a class="bmet_reg_button_style" href="{{ route('recruiting-agency.pdo.registration', ['id' => $id,'type' => 'payment-info']) }}">
                                                            <button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
                                                                Next <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade {{ $type === 'payment-info' ? 'in active show' : '' }}" id="tab-1st">
                                        <div class="w-100">
                                            <form method="post" action="{{ route('recruiting-agency.pdo.registration', ['id' => $id, 'type' => 'payment-info']) }}" enctype="multipart/form-data" >
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12 col-xl-12 col-lg-12 wrap-tree">
                                                        <div class="card card-custom ">
                                                                <div class="card-body row text-dark">
                                                                    <div class="col-sm-5 col-xl-5 col-lg-5 mb-3 pt-10 pl-10">
                                                                        <h6>
                                                                            <u>Personal Information</u>
                                                                        </h6>
                                                                        <div style="text-align: left; padding-bottom: 30px;" id="batch_info">
                                                                            <b>Name</b>: <span id="span_first_name">{{$pdoInfo ? $pdoInfo->full_name :''}}</span>
                                                                            <br>
                                                                            <b>Passport Number</b>: <span id="span_passport_number">{{$pdoInfo ? $pdoInfo->passport_no:''}}</span>
                                                                        </div>
                                                                        <h6>
                                                                            <u>Batch Information</u>
                                                                        </h6>
                                                                        <div style="text-align: left;" id="batch_info">
                                                                            <b>Batch Number</b>: <span id="spnBatchNumber">{{$pdoInfo ? ($pdoInfo->trainingSchedule? $pdoInfo->trainingSchedule->batch_no:''):''}}</span>
                                                                            <br>
                                                                            <b>Date Range</b>:
                                                                            <span id="spnDateRange">
                                                                                {{ $pdoInfo && $pdoInfo->trainingSchedule ?
                                                                                    \Carbon\Carbon::parse($pdoInfo->trainingSchedule->training_start_date)->format('d-M-Y') : '' }}
                                                                                to
                                                                                {{ $pdoInfo && $pdoInfo->trainingSchedule ?
                                                                                    \Carbon\Carbon::parse($pdoInfo->trainingSchedule->training_end_date)->format('d-M-Y') : '' }}
                                                                            </span>
                                                                            <br>
                                                                            <b>Class Time</b>:
                                                                            <span id="spnClassTime">
                                                                                @php
                                                                                    $startTime = $pdoInfo ? ($pdoInfo->trainingSchedule ? $pdoInfo->trainingSchedule->training_start_time : '') : '';
                                                                                    $endTime = $pdoInfo ? ($pdoInfo->trainingSchedule ? $pdoInfo->trainingSchedule->training_end_time : '') : '';
                                                                                @endphp

                                                                                @if (!empty($startTime) && !empty($endTime))
                                                                                    {{ date("h:i A", strtotime($startTime)) }} to {{ date("h:i A", strtotime($endTime)) }}
                                                                                @else
                                                                                    Time information not available
                                                                                @endif
                                                                            </span>
                                                                            <br>
                                                                            <b>PDO Type</b>:
                                                                            <span id="spnPdotype">
                                                                                @if($pdoInfo && $pdoInfo->trainingSchedule)
                                                                                    @if($pdoInfo->trainingSchedule->pdo_type==1)
                                                                                        General Category
                                                                                    @elseif($pdoInfo->trainingSchedule->pdo_type==2)
                                                                                        VIP Category
                                                                                    @elseif($pdoInfo->trainingSchedule->pdo_type==2)
                                                                                        Others Category
                                                                                    @endif
                                                                                @endif
                                                                            </span>
                                                                            <br>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-7 col-xl-7 col-lg-7 mb-3" style="text-align: center; padding: 30px;">
                                                                        @if($pdoInfo ? $pdoInfo->payment_status == 0:'' || $pdoInfo==null)
                                                                        <div>
                                                                            <span style="padding-bottom: 10px;">To complete your registration please pay BDT 300</span>
                                                                            <br>
                                                                            <br>
                                                                            <div class="btn-group col-sm-8 col-xl-8 col-lg-8" role="group" aria-label="Basic example">
                                                                                <a class="btn mr-10 btn-lg" href="{{route('recruiting-agency.pdo.registration.payment',$pdoInfo?$pdoInfo->id:'')}}" style="padding: 18px 50px;" id="id_payment_other" payment_url="/pdo/ra/ssl-payment/2040199/">Online Payment </a>
                                                                            </div>
                                                                        </div>
                                                                        @else
                                                                        <div class="col-sm-8 col-xl-8 col-lg-8 mt-6" style="margin: 0 auto;">
                                                                            <input type="hidden" name="csrfmiddlewaretoken" value="">
                                                                            <div class="form-row ">
                                                                                <div class="form-group col-md-4 mb-0">
                                                                                    <div id="div_id_amount" class="form-group">
                                                                                        <p>Payment successfully completed</p>
                                                                                        <div>
                                                                                            <input type="text" name="amount" value="300" readonly="" class="textinput textInput form-control" required="" id="id_amount">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-md-4 mb-0">
                                                                                    <input type="hidden" name="payment_id" id="id_payment_id">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                            <div class="d-flex flex-stack pt-15">
                                                                <div class="mr-2">
                                                                    <a href="{{ route('recruiting-agency.pdo.registration', ['id' => $id,'type' => 'batch-info']) }}">
                                                                        <button type="button" class="btn btn-lg btn-light-primary me-3 previous_btn_style">
                                                                            <i class="ki-outline ki-arrow-left fs-4 me-1"></i> Back
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                                @if($pdoInfo ? $pdoInfo->payment_status == 1:'')
                                                                <div>
                                                                    <a class="bmet_reg_button_style" href="{{ route('recruiting-agency.pdo.registration', ['id' => $id,'type' => 'upload-photo']) }}">
                                                                        <button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
                                                                            Next <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i>
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade {{ $type === 'upload-photo' ? 'in active show' : '' }}" id="tab-1st">
                                        <div class="w-100">
                                            <form method="post" action="{{ route('recruiting-agency.pdo.registration', ['id' => $id, 'type' => 'upload-photo']) }}" enctype="multipart/form-data" >
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12 col-xl-12 col-lg-12 wrap-tree">
                                                        <div class="card card-custom ">

                                                                <div class="card-body row text-dark">
                                                                    <div class="col-sm-12 col-xl-12 col-lg-12 mb-3" style="text-align: center; padding: 30px;">
                                                                        <div class="col-sm-4 col-xl-4 col-lg-4 mt-6" style="margin: 0 auto;">
                                                                            <input type="hidden" name="csrfmiddlewaretoken" value="">
                                                                            <div class="form-row text-center">
                                                                                <div class="form-group col-md-10 mb-0" style="margin: 0 auto">
                                                                                    <div id="div_id_image_file" class="form-group">
                                                                                        <label for="id_image_file" class=""></label>
                                                                                        <div class=" mb-2">
                                                                                            <div class="form-control custom-file" style="border:0">
                                                                                                <input type="file" name="photo" class="custom-file-input" id="id_image_file">
                                                                                                <label class="custom-file-label text-truncate" for="id_image_file">---</label>
                                                                                            </div>
                                                                                            <small id="hint_id_image_file" class="form-text text-muted">Please upload photo from your machine </small>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-row ">
                                                                                    <div class="col-md ">
                                                                                        <div id="div_id_uploaded_photo" class="form-group">
                                                                                            <label for="id_uploaded_photo" class=""></label>
                                                                                            @if($pdoInfo? $pdoInfo->photo:'')
                                                                                                <img src="{{ asset('storage/'.($pdoInfo? $pdoInfo->photo: '')) }}" height="100px" width="100px">
                                                                                            @else
                                                                                            <div>
                                                                                                <img id="id_uploaded_photo" height="100px" width="100px">
                                                                                            </div>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <div class="d-flex flex-stack pt-15">
                                                                <div class="mr-2">
                                                                    <a href="{{ route('recruiting-agency.pdo.registration', ['id' => $id,'type' => 'payment-info']) }}">
                                                                        <button type="button" class="btn btn-lg btn-light-primary me-3 previous_btn_style">
                                                                            <i class="ki-outline ki-arrow-left fs-4 me-1"></i> Back
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                                <div>
                                                                    <a class="bmet_reg_button_style" href="{{ route('recruiting-agency.pdo.registration', ['id' => $id,'type' => 'enrollment-card']) }}">
                                                                        <button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
                                                                            Next <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i>
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade {{ $type === 'enrollment-card' ? 'in active show' : '' }}" id="tab-1st">
                                        <div class="w-100">
                                            <form method="post" action="#" enctype="multipart/form-data" >
                                                @csrf
                                                <div id="divEnrollment" class="card border-light-card mb-3">
                                                    <div class="card-body row">
                                                        <div class="col-sm-12 col-xl-12 col-lg-12 mb-3">
                                                            <div style="width: 485px; margin: auto;">
                                                                <div style="background-color: #009ef7; color: white; padding: 10px;" class="top">
                                                                    @if($pdoInfo? $pdoInfo->photo:'')
                                                                    <img class="float-right" draggable="false" src="{{ asset('storage/'.($pdoInfo? $pdoInfo->photo: '')) }}" alt="Student Image" style="width:70px;height:75px;">
                                                                    @endif

                                                                    Government of the People's Republic of Bangladesh<br>
                                                                    Technical Training Centre, Faridpur
                                                                    Brammankanda P.O. Sreeaungon Upazilla-FaridpurSadar Dist- Faridpur
                                                                    None
                                                                    <p> Phone: 063162534 </p>
                                                                </div>
                                                                <div style="background-color: #F1F5F5;" class="date_qr">
                                                                    <div style="text-align: center; padding-top: 5px; font-size: 16px;">
                                                                        <b>PDO Enrollment card</b>
                                                                    </div>
                                                                    <div style="width: 100%; text-align: center;">

                                                                    </div>
                                                                    <div class="border-light-card " style="padding-bottom: 30px;">

                                                                        <div style="width: 435px; border: 1px solid #b5b0b0; margin: auto; padding: 24px; border-radius: 10px;">

                                                                            <div class="d-flex">
                                                                                <div style="width: 140px; padding-left: 12px;">
                                                                                    <b>Name:</b>
                                                                                </div>
                                                                                <div style="text-align: left; padding-left: 12px;">
                                                                                    {{$pdoInfo ? $pdoInfo->full_name :''}}
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <div class="d-flex">
                                                                                <div style="width: 140px; padding-left: 12px;">
                                                                                    <b>Father's Name:</b>
                                                                                </div>
                                                                                <div style="text-align: left; padding-left: 12px;">
                                                                                    {{$pdoInfo ? $pdoInfo->fathers_name :''}}
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <div class="d-flex">
                                                                                <div style="width: 140px; padding-left: 12px;">
                                                                                    <b>Mother's Name:</b>
                                                                                </div>
                                                                                <div style="text-align: left; padding-left: 12px;">
                                                                                    {{$pdoInfo ? $pdoInfo->mothers_name :''}}
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <div class="d-flex">
                                                                                <div style="width: 140px; padding-left: 12px;">
                                                                                    <b>Passport No:</b>
                                                                                </div>
                                                                                <div style="text-align: left; padding-left: 12px;">
                                                                                    {{$pdoInfo ? $pdoInfo->passport_no :''}}
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <div class="d-flex">
                                                                                <div style="width: 140px; padding-left: 12px;">
                                                                                    <b>Country:</b>
                                                                                </div>
                                                                                <div style="text-align: left; padding-left: 12px;">
                                                                                    {{$pdoInfo ? ($pdoInfo->currency? $pdoInfo->currency->	country_name:''):''}}
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <div class="d-flex">
                                                                                <div style="width: 140px; padding-left: 12px;">
                                                                                    <b>Batch No:</b>
                                                                                </div>
                                                                                <div style="text-align: left; padding-left: 12px;">
                                                                                    {{$pdoInfo ? ($pdoInfo->trainingSchedule? $pdoInfo->trainingSchedule->batch_no:''):''}}
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <div class="d-flex">
                                                                                <div style="width: 140px; padding-left: 12px;">
                                                                                    <b>Room No:</b>
                                                                                </div>
                                                                                <div style="text-align: left; padding-left: 12px;">
                                                                                    {{$pdoInfo ? ($pdoInfo->trainingSchedule? $pdoInfo->trainingSchedule->room_no:''):''}}
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <div class="d-flex">
                                                                                <div style="width: 140px; padding-left: 12px;">
                                                                                    <b>Roll No:</b>
                                                                                </div>
                                                                                <div style="text-align: left; padding-left: 12px;">
                                                                                    {{$pdoInfo ? $pdoInfo->roll_no :''}}
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <div class="d-flex">
                                                                                <div style="width: 140px; padding-left: 12px;">
                                                                                    <b>Class Date:</b>
                                                                                </div>
                                                                                <div style="text-align: left; padding-left: 12px;">
                                                                                    {{ $pdoInfo && $pdoInfo->trainingSchedule ?
                                                                                    \Carbon\Carbon::parse($pdoInfo->trainingSchedule->training_start_date)->format('d-M-Y') : '' }}
                                                                                    to
                                                                                    {{ $pdoInfo && $pdoInfo->trainingSchedule ?
                                                                                    \Carbon\Carbon::parse($pdoInfo->trainingSchedule->training_end_date)->format('d-M-Y') : '' }}
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <div class="d-flex">
                                                                                <div style="width: 140px; padding-left: 12px;">
                                                                                    <b>Class Time:</b>
                                                                                </div>
                                                                                <div style="text-align: left; padding-left: 12px;">
                                                                                    @php
                                                                                        $startTime = $pdoInfo ? ($pdoInfo->trainingSchedule ? $pdoInfo->trainingSchedule->training_start_time : '') : '';
                                                                                        $endTime = $pdoInfo ? ($pdoInfo->trainingSchedule ? $pdoInfo->trainingSchedule->training_end_time : '') : '';
                                                                                    @endphp

                                                                                    @if (!empty($startTime) && !empty($endTime))
                                                                                        {{ date("h:i A", strtotime($startTime)) }} to {{ date("h:i A", strtotime($endTime)) }}
                                                                                    @else

                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <div class="d-flex">
                                                                                <div style="width: 140px; padding-left: 12px;">
                                                                                    <b>Phone No:</b>
                                                                                </div>
                                                                                <div style="text-align: left; padding-left: 12px;">
                                                                                    {{$pdoInfo ? $pdoInfo->phone :''}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row" style="margin: auto; text-align: center; justify-content: center; padding-bottom: 20px;">
                                                                        <button type="button" class="btn" id="btnEnrollmentDownload">Download
                                                                        </button>
                                                                        <button type="button" class="btn" onclick="window.print()" id="btnEnrollmentPrint">Print
                                                                        </button>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Include FullCalendar CSS and JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet">
<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
{{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', function () {--}}
{{--            var calendarEl = document.getElementById('calendar');--}}
{{--            var calendar = new FullCalendar.Calendar(calendarEl, {--}}
{{--                initialView: 'dayGridMonth',--}}
{{--                events: []--}}
{{--            });--}}
{{--            calendar.render();--}}
{{--            $('#trainingCenterSelect').change(function () {--}}
{{--                var selectedTtcId = $(this).val();--}}
{{--                $.ajax({--}}
{{--                    url: '/recruiting-agency/get-schedule/' + selectedTtcId,--}}
{{--                    type: 'GET',--}}
{{--                    success: function (data) {--}}
{{--                        updateCalendarWithSchedules(data, calendar);--}}
{{--                        updateScheduleTable(data);--}}
{{--                    },--}}
{{--                    error: function () {--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--            function updateCalendarWithSchedules(schedules, calendar) {--}}
{{--                calendar.getEvents().forEach(function (event) {--}}
{{--                    event.remove();--}}
{{--                });--}}
{{--                schedules.forEach(function (schedule) {--}}
{{--                    var event = {--}}
{{--                        id: schedule.id,--}}
{{--                        title: schedule.batch_no,--}}
{{--                        start: schedule.training_start_date + 'T' + schedule.training_start_time,--}}
{{--                        color: '#3498db'--}}
{{--                    };--}}
{{--                    calendar.addEvent(event);--}}
{{--                });--}}
{{--            }--}}
{{--            function updateScheduleTable(schedules) {--}}
{{--                var tableBody = $('#scheduleTableBody');--}}
{{--                tableBody.empty();--}}
{{--                schedules.forEach(function (schedule) {--}}
{{--                    var dateRange = schedule.training_start_date + ' to ' + schedule.training_end_date;--}}
{{--                    var timeRange = formatTime(schedule.training_start_time) + ' to ' + formatTime(schedule.training_end_time);--}}

{{--                    var row = '<tr>' +--}}
{{--                        '<td>' + schedule.batch_no + '</td>' +--}}
{{--                        '<td>' + dateRange + '</td>' +--}}
{{--                        '<td>' + timeRange + '</td>' +--}}
{{--                        '<td>' + getPDODescription(schedule.pdo_type) + '</td>' +--}}
{{--                        '<td>' + schedule.available_sit + '</td>' +--}}
{{--                        '<td><input type="radio" name="training_schedule_id" value="' + schedule.id + '"></td>' +--}}
{{--                        '</tr>';--}}

{{--                    tableBody.append(row);--}}
{{--                });--}}
{{--                var radioButtons = '';--}}
{{--                schedules.forEach(function (schedule) {--}}
{{--                    radioButtons += '<label><input type="radio" name="selectedSchedule" value="' + schedule.id + '">' + schedule.batch_no + '</label><br>';--}}
{{--                });--}}
{{--                $('#radioButtonsContainer').html(radioButtons);--}}
{{--            }--}}
{{--            function formatTime(time) {--}}
{{--                var parts = time.split(':');--}}
{{--                var hour = parseInt(parts[0]);--}}
{{--                var minute = parts[1];--}}
{{--                var period = hour >= 12 ? 'PM' : 'AM';--}}

{{--                if (hour > 12) {--}}
{{--                    hour -= 12;--}}
{{--                } else if (hour === 0) {--}}
{{--                    hour = 12;--}}
{{--                }--}}

{{--                return hour + ':' + minute + ' ' + period;--}}
{{--            }--}}
{{--            function getPDODescription(pdoType) {--}}
{{--                switch (pdoType) {--}}
{{--                    case 1:--}}
{{--                        return 'General Category';--}}
{{--                    case 2:--}}
{{--                        return 'VIP Category';--}}
{{--                    case 3:--}}
{{--                        return 'Others Category';--}}
{{--                    default:--}}
{{--                        return 'Unknown';--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: []
        });
        calendar.render();
        var selectedTtcId = null;
        var schedules = []; // Initialize schedules array

        $('#trainingCenterSelect').change(function () {
            selectedTtcId = $(this).val();
            schedules = []; // Clear the schedules array when TTC changes
            updateScheduleTable([]);
            $.ajax({
                url: '/recruiting-agency/get-schedule/' + selectedTtcId,
                type: 'GET',
                success: function (data) {
                    schedules = data; // Store schedules globally
                    updateCalendarWithSchedules(data, calendar);
                },
                error: function () {
                }
            });
        });

        function updateCalendarWithSchedules(schedules, calendar) {
            calendar.getEvents().forEach(function (event) {
                event.remove();
            });
            schedules.forEach(function (schedule) {
                var event = {
                    id: schedule.id,
                    //title: schedule.batch_no,
                    start: schedule.training_start_date + 'T' + schedule.training_start_time,
                    color: '#3498db'
                };
                calendar.addEvent(event);
            });
        }

        calendar.on('eventClick', function (info) {
            var clickedDate = info.event.start.toISOString().split('T')[0];
            var filteredSchedules = filterSchedulesByDate(clickedDate);
            updateScheduleTable(filteredSchedules);
        });

        function filterSchedulesByDate(date) {
            return schedules.filter(function (schedule) {
                return schedule.training_start_date === date;
            });
        }

        function updateScheduleTable(schedules) {
            var tableBody = $('#scheduleTableBody');
            tableBody.empty();
            schedules.forEach(function (schedule) {
                var dateRange = schedule.training_start_date + ' to ' + schedule.training_end_date;
                var timeRange = formatTime(schedule.training_start_time) + ' to ' + formatTime(schedule.training_end_time);

                var row = '<tr>' +
                    '<td>' + schedule.batch_no + '</td>' +
                    '<td>' + dateRange + '</td>' +
                    '<td>' + timeRange + '</td>' +
                    '<td>' + getPDODescription(schedule.pdo_type) + '</td>' +
                    '<td>' + schedule.available_sit + '</td>' +
                    '<td><input type="radio" name="training_schedule_id" value="' + schedule.id + '"></td>' +
                    '</tr>';

                tableBody.append(row);
            });
        }

        function formatTime(time) {
            var parts = time.split(':');
            var hour = parseInt(parts[0]);
            var minute = parts[1];
            var period = hour >= 12 ? 'PM' : 'AM';

            if (hour > 12) {
                hour -= 12;
            } else if (hour === 0) {
                hour = 12;
            }

            return hour + ':' + minute + ' ' + period;
        }

        function getPDODescription(pdoType) {
            switch (pdoType) {
                case 1:
                    return 'General Category';
                case 2:
                    return 'VIP Category';
                case 3:
                    return 'Others Category';
                default:
                    return 'Unknown';
            }
        }
    });


</script>
    <script>
        $(document).ready(function () {
            $('#passport_no').on('input', function () {
                var passportNumber = $(this).val();
                if (passportNumber) {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route("recruiting-agency.passport.details") }}',
                        data: { passport_no: passportNumber },
                        success: function (data) {
                            // Autofill the form fields with data received from the server.
                            $('#full_name').val(data.full_name);
                            var personalInfo = data.personal_info
                            if (personalInfo) {
                                $('#fathers_name').val(personalInfo.fathers_name);
                                $('#mothers_name').val(personalInfo.mothers_name);
                                $('#religion_id').val(personalInfo.religion_id);
                            }
                            $('#nid_no').val(data.nid_no);
                            $('#phone').val(data.phone);
                            $('#passport_info_id').val(data.id);
                            $('#dob').val(data.dob);
                            $('#gender').val(data.gender);
                        },
                    });
                }
            });
        });
    </script>

    <script>
        id_image_file.onchange = evt => {
            const [file] = id_image_file.files
            if (file) {
                id_uploaded_photo.src = URL.createObjectURL(file)
            }
        }
    </script>




@endsection
