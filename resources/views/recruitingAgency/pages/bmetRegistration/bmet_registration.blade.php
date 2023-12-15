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
    	/*    Gender Select Design*/
        .gender .button {
            margin: 0 7px 0 0;
            width: 100%;
            height: 45px;
            position: relative;
            color: #b5b5c3;
            background-color: rgb(0 158 247 / 20%);
            border-radius: 4px;
            border-color: #f3f6f9;
        }
        .gender .button label, .gender .button input {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
        .gender .button input[type="radio"] {
            opacity: 0.011;
            z-index: 100;
            cursor: pointer;
        }
        .gender .button input[type="radio"]:checked + label {
            background-color: #009ef7 !important;
            border-radius: 4px;
            color: #fff;
        }
        .gender .button input[type="radio"]:checked + label i {
            color: #fff;
        }
        .gender .button label {
            z-index: 90;
            line-height: 1.8em;
        }
    </style>
    <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-4">
                        <a href="{{route('recruiting-agency.bmet.registration')}}" class="btn btn-primary">
                            <i class="ki-duotone ki-left"></i>Back</a>
                    </div>
                    <div class="col-4 text-center">
                        <h1 class="text-dark fw-bold my-1 fs-3">New BMET Registration</h1>
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
        </div>
        <div id="kt_content_container" class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="stepper stepper-links d-flex flex-column" id="kt_create_account_stepper">
                        <div class="stepper-nav mb-5">
                            <a href="#" class="stepper-item" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">
                                    Passport Info
                                </h3>
                            </a>
                            <a href="" class="stepper-item" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">
                                    Personal Info
                                </h3>
                            </a>
                            <a href="" class="stepper-item" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">
                                    Contact Info
                                </h3>
                            </a>
                            <a href="" class="stepper-item" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">
                                    Nominee Details
                                </h3>
                            </a>
                            <a href="" class="stepper-item" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">
                                    Qualification
                                </h3>
                            </a>
                            <a href="" class="stepper-item" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">
                                    Verify & Pay
                                </h3>
                            </a>
                        </div>


                        <div class="tab-content mx-auto w-100" id="kt_create_account_form">
                            <div class="tab-pane fade in active show" id="tab-1st">
                                <div class="w-100">
                                    <form method="post" action="" enctype="multipart/form-data" >
                                        @csrf

                                        <div class="row">
                                            <div class="col-12">
                                                <label class="picture" for="picture__input" tabIndex="0">
                                                    @if($passportInfo)
                                                        <img src="{{ asset('storage/'.$passportInfo->passport_image ?? '') }}" alt="" style="height: 250px;" class="img-fluid" id="picture__preview">
                                                    @else
                                                        <span class="picture__image"></span>
                                                    @endif
                                                </label>
                                                <input type="file" name="passport_image" id="picture__input" class="@error('passport_image') is-invalid @enderror">

                                                @error('passport_image')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="passportNumber">Passport no<span style="color: red;">*</span></label>
                                                <input type="text" placeholder="Enter your passport number" name="passport_no" value="{{ old('passport_no', $passportInfo->passport_no ?? '') }}" required="required" minlength="9" maxlength="9" id="passportNumber" autocomplete="off" class="form-control bg-transparent @error('passport_no') is-invalid @enderror" />

                                                @error('passport_no')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="mobileNumber">Mobile <span style="color: red;">*</span></label>
                                                <input type="text" placeholder="Enter your passport number" name="phone" value="{{ old('phone', $passportInfo->phone ?? '') }}" required="required" minlength="11" maxlength="11" id="mobileNumber" autocomplete="off" class="form-control bg-transparent @error('phone') is-invalid @enderror" />

                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="passport_issue_date">Passport issue date<span style="color: red;">*</span></label>
                                                <input type="date" name="passport_issue_date" value="{{ old('passport_issue_date', $passportInfo->passport_issue_date ?? '') }}" required="required" id="passport_issue_date" placeholder="Select Passport issue date" class="form-control bg-transparent  @error('passport_issue_date') is-invalid @enderror"/>

                                                @error('passport_issue_date')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="name">Full Name <span style="color: red;">*</span></label>
                                                <input type="text" placeholder="Enter your full name" name="full_name" value="{{ old('full_name', $passportInfo->full_name ?? '') }}" required="required" id="name" autocomplete="off" class="form-control bg-transparent @error('full_name') is-invalid @enderror" />

                                                @error('full_name')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="passport_expiry_date">Passport expiry date<span style="color: red;">*</span></label>
                                                <input type="date" name="passport_expiry_date" value="{{ old('passport_expiry_date', $passportInfo->passport_expiry_date ?? '') }}" required="required" id="passport_expiry_date" placeholder="Select Passport expiry date" class="form-control bg-transparent @error('passport_expiry_date') is-invalid @enderror" />

                                                @error('passport_expiry_date')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <div class="form-group">
                                                    <div class="form-group gender">
                                                        <label>Gender <span class="text-danger">*</span></label>
                                                        <div class="row @error('gender') is-invalid @enderror">
                                                            <div class="col-sm-6">
                                                                <div class="button">
                                                                    <input name="gender" value="1" {{ old('gender', optional($passportInfo)->gender) == 1 ? 'checked' : '' }} required="required" type="radio" id="male">
                                                                    <label for="male" class="btn">
                                                                        <i class="fas fa-mars"></i> Male </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="button">
                                                                    <input name="gender" value="2" {{ old('gender', optional($passportInfo)->gender) == 2 ? 'checked' : '' }} required="required" type="radio" id="female">
                                                                    <label for="female" class="btn">
                                                                        <i class="fas fa-venus"></i> Female </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @error('gender')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="date_of_birth">Date of birth<span style="color: red;">*</span></label>
                                                <input type="date" name="dob" value="{{ old('dob', $passportInfo->dob ?? '') }}" required="required" id="date_of_birth" placeholder="Date of birth" class="form-control bg-transparent @error('dob') is-invalid @enderror" />

                                                @error('dob')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="gender">Birth District <span style="color: red;">*</span></label>
                                                <select id="district_id" name="district_id" required="required" class="form-select bg-transparent @error('district_id') is-invalid @enderror" >
                                                    <option>Select your birth district</option>
                                                    <option selected value="{{$passportInfo->district_id ?? '' }}">{{$passportInfo->district->district_name_en ?? ''}}</option>
                                                    @foreach($districts as $districtData)
                                                        <option value="{{$districtData->id}}">{{$districtData->district_name_en}}</option>
                                                    @endforeach
                                                </select>

                                                @error('district_id')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="d-flex flex-stack justify-content-end pt-15">
                                                <div>
                                                    <a href="{{ route('recruiting-agency.bmet.registration', ['id' => $id,'type' => 'personal-info']) }}">
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

                            <div class="tab-pane fade " id="tab-2nd">
                                <div class="w-100">
                                    <form method="post" action=''>
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="fathers_name">Father's Name<span style="color: red;">*</span></label>
                                                <input type="text" placeholder="Enter your father's name" name="fathers_name" value="{{ old('fathers_name', $personalInfo->fathers_name ?? '') }}" required="required"  id="fathers_name" autocomplete="off" class="form-control bg-transparent  @error('fathers_name') is-invalid @enderror" />

                                                @error('fathers_name')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="mothers_name">Mother's Name <span style="color: red;">*</span></label>
                                                <input type="text" placeholder="Enter your mother's name" name="mothers_name" value="{{ old('mothers_name', $personalInfo->mothers_name ?? '') }}" required="required" id="mothers_name" autocomplete="off" class="form-control bg-transparent @error('mothers_name') is-invalid @enderror" />

                                                @error('mothers_name')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="marital_status">Marital Status <span style="color: red;">*</span></label>
                                                <select id="marital_status" name="marital_status" data-control="select2" required="required" class="form-select bg-transparent @error('marital_status') is-invalid @enderror" data-hide-search="true">
                                                    <option value="">Select</option>
                                                    <option value="1" {{ old('marital_status', isset($personalInfo) ? $personalInfo->marital_status : '') == '1' ? 'selected' : '' }}>Unmarried</option>
                                                    <option value="2" {{ old('marital_status', isset($personalInfo) ? $personalInfo->marital_status : '') == '2' ? 'selected' : '' }}>Married</option>
                                                </select>

                                                @error('marital_status')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="religion_status">Religion <span style="color: red;">*</span></label>
                                                <select id="religion_status" name="religion_id" required="required" class="form-select bg-transparent @error('religion_id') is-invalid @enderror" data-hide-search="true">
                                                    <option value="">Select</option>
                                                    @foreach($religion as $religionData)
                                                        <option value="{{ $religionData->id }}" {{ old('religion_id', isset($personalInfo) ? $personalInfo->religion_id : '') == $religionData->id ? 'selected' : '' }}>
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
                                                <label for="spouse_name">Spouse's Name</label>
                                                <input type="text" placeholder="Enter your spouse name" name="spouse_name" value="{{ old('spouse_name', $personalInfo->spouse_name ?? '') }}" id="spouse_name" class="form-control bg-transparent" @if(old('marital_status', $personalInfo->marital_status ?? '') == '2') disabled @endif />
                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <div class="row">
                                                    <div class="col-12 col-md-4">
                                                        <label>Height <span style="color: red;">*</span></label>
                                                        <select id="height_feet" name="height_feet" required="required" class="form-select bg-transparent @error('height_feet') is-invalid @enderror">
                                                            <option value="">Select</option>
                                                            @for ($i = 1; $i <= 10; $i++)
                                                                <option value="{{ $i }}" {{ old('height_feet', isset($personalInfo) ? $personalInfo->height_feet : '') == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>

                                                        @error('height_feet')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label>Inch</label>
                                                        <select id="height_inch" name="height_inch"  class="form-select bg-transparent">
                                                            <option selected value="{{$personalInfo->height_inch ?? ''}}">{{$personalInfo->height_inch ?? ''}}</option>
                                                            <option>Inch</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <label>Weight <span style="color: red;">*</span></label>
                                                        <select id="height_inch" name="weight" required="required" class="form-select bg-transparent @error('weight') is-invalid @enderror">
                                                            <option value="">Select</option>
                                                            @for ($i = 41; $i <= 150; $i++)
                                                                <option value="{{ $i }}" {{ old('weight', isset($personalInfo) ? $personalInfo->weight : '') == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>

                                                        @error('weight')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-stack pt-15">
                                            <div class="mr-2">
                                                <a href="">
                                                    <button type="button" class="btn btn-lg btn-light-primary me-3 previous_btn_style">
                                                        <i class="ki-outline ki-arrow-left fs-4 me-1"></i> Back
                                                    </button>
                                                </a>
                                            </div>
                                            <div>
                                                <a class="bmet_reg_button_style" href="">
                                                    <button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
                                                        Next <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i>
                                                    </button>
                                                </a>
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
    <script src="{{ asset('assets/js/bmetRegistration.js') }}"></script>
{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}

@endsection
