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
                        <a href="" class="btn btn-primary">
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
                            <a href="{{route('recruiting-agency.bmet.create',['expat_id' => request('expat_id'), 'status' => 1])}}"
                               class="stepper-item {{session('tab')==1||empty(session('tab'))?'active':''}}"
                               data-kt-stepper-element="nav">
                                <h3 class="stepper-title">Passport Info</h3>
                            </a>
                            <a href="{{$data?route('recruiting-agency.bmet.create',['expat_id' => request('expat_id'), 'status' => 2]):'javascript:void(0)'}}"
                               class="stepper-item {{session('tab')==2?'active':''}}" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">Personal Info</h3>
                            </a>
                            <a href="{{$data?->personalInfo?route('recruiting-agency.bmet.create',['expat_id' => request('expat_id'), 'status' => 3]):'javascript:void(0)'}}"
                               class="stepper-item {{session('tab')==3?'active':''}}" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">Contact Info</h3>
                            </a>
                            <a href="{{$data?->contactInfo?route('recruiting-agency.bmet.create',['expat_id' => request('expat_id'), 'status' => 4]):'javascript:void(0)'}}"
                               class="stepper-item {{session('tab')==4?'active':''}}" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">Nominee Details</h3>
                            </a>
                            <a href="{{$data?->nomineeInfo?route('recruiting-agency.bmet.create',['expat_id' => request('expat_id'), 'status' => 5]):'javascript:void(0)'}}"
                               class="stepper-item {{session('tab')==5?'active':''}}" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">Qualification</h3>
                            </a>
                            <a href="{{$data?->qualificationInfo?route('recruiting-agency.bmet.create',['expat_id' => request('expat_id'), 'status' => 6]):'javascript:void(0)'}}"
                               class="stepper-item {{session('tab')==6?'active':''}}" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">Verify & Pay</h3>
                            </a>
                        </div>


                        <div class="tab-content mx-auto w-100" id="kt_create_account_form">
                            <div class="tab-pane fade {{session('tab')==1||empty(session('tab'))?'in active show':''}}"
                                 id="tab-1st">
                                <div class="w-100">
                                    <form method="post" action="{{route('recruiting-agency.passport.store')}}"
                                          enctype="multipart/form-data">@csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="picture" for="picture__input" tabIndex="0">
                                                    @if($data?->passport_image)
                                                        <img src="{{ asset('storage/'.$data?->passport_image ?? '') }}" alt="" style="height: 250px;" class="img-fluid" id="picture__preview">
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
                                                <label for="passportNumber">Passport no<span
                                                        style="color: red;">*</span></label>
                                                <input type="text" placeholder="Enter your passport number"
                                                       name="passport_no"
                                                       value="{{old('passport_no',$data?->passport_no)}}" minlength="9"
                                                       maxlength="9" id="passport_no" autocomplete="off"
                                                       class="form-control bg-transparent @error('passport_no') is-invalid @enderror"/>

                                                @error('passport_no')
                                                <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="mobileNumber">Mobile <span
                                                        style="color: red;">*</span></label>
                                                <input type="text" placeholder="015XX-XXX-XXX"
                                                       name="mobile" value="{{old('mobile',$data?->phone)}}"
                                                       minlength="11"
                                                       maxlength="11" id="phone" autocomplete="off"
                                                       class="form-control bg-transparent @error('mobile') is-invalid @enderror"/>

                                                @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="passport_issue_date">Passport issue date<span
                                                        style="color: red;">*</span></label>
                                                <input type="date"
                                                       value="{{old('passport_issue_date',$data?->passport_issue_date)}}"
                                                       name="passport_issue_date" id="passport_issue_date"
                                                       placeholder="Select Passport issue date"
                                                       class="form-control bg-transparent  @error('passport_issue_date') is-invalid @enderror"/>

                                                @error('passport_issue_date')
                                                <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="full_name">Full Name <span
                                                        style="color: red;">*</span></label>
                                                <input type="text" value="{{old('full_name',$data?->full_name)}}"
                                                       placeholder="Enter your full name" name="full_name"
                                                       id="full_name"
                                                       autocomplete="off"
                                                       class="form-control bg-transparent @error('full_name') is-invalid @enderror"/>

                                                @error('full_name')
                                                <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="passport_expiry_date">Passport expiry date<span
                                                        style="color: red;">*</span></label>
                                                <input type="date"
                                                       value="{{old('passport_expiry_date',$data?->passport_expiry_date)}}"
                                                       name="passport_expiry_date" id="passport_expiry_date"
                                                       placeholder="Select Passport expiry date"
                                                       class="form-control bg-transparent @error('passport_expiry_date') is-invalid @enderror"/>

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
                                                                    <input name="gender" value="1"
                                                                           {{old('gender',$data?->gender)=='1'?'checked':''}}  type="radio"
                                                                           id="male">
                                                                    <label for="male" class="btn"><i
                                                                            class="fas fa-mars"></i> Male </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="button">
                                                                    <input name="gender" value="2"
                                                                           {{old('gender',$data?->gender)=='2'?'checked':''}}  type="radio"
                                                                           id="female">
                                                                    <label for="female" class="btn"><i
                                                                            class="fas fa-venus"></i> Female
                                                                    </label>
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
                                                <label for="dob">Date of birth<span
                                                        style="color: red;">*</span></label>
                                                <input type="date" name="dob" id="dob"
                                                       value="{{old('dob',$data?->dob)}}"
                                                       placeholder="Date of birth"
                                                       class="form-control bg-transparent @error('dob') is-invalid @enderror"/>
                                                @error('dob')
                                                <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="gender">Birth District <span
                                                        style="color: red;">*</span></label>
                                                <label for="district_id"></label>
                                                <select id="district_id" name="district_id"
                                                        class="form-select bg-transparent @error('district_id') is-invalid @enderror">
                                                    <option>Select your birth district</option>
                                                    @foreach($districts as $district)
                                                        <option
                                                            value="{{$district->id}}" {{(int)old('district_id',$data?->district_id)===$district->id?'selected':''}}>{{$district->name}}</option>
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
                                                <button type="submit" class="btn btn-lg btn-primary"
                                                        data-kt-stepper-action="next">Next
                                                    <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane fade {{session('tab')==2?'in active show':''}}" id="tab-2nd">
                                <div class="w-100">
                                    <form method="post" action="{{route('recruiting-agency.personal.store')}}">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="expat_id" value="{{request('expat_id')}}">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="fathers_name">Father's Name<span
                                                        style="color: red;">*</span></label>
                                                <input type="text" placeholder="Enter your father's name"
                                                       name="fathers_name"
                                                       value="{{ old('fathers_name', $data?->personalInfo?->fathers_name) }}"
                                                       id="fathers_name" autocomplete="off"
                                                       class="form-control bg-transparent  @error('fathers_name') is-invalid @enderror"/>

                                                @error('fathers_name')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="mothers_name">Mother's Name <span
                                                        style="color: red;">*</span></label>
                                                <input type="text" placeholder="Enter your mother's name"
                                                       name="mothers_name"
                                                       value="{{ old('mothers_name', $data?->personalInfo?->mothers_name) }}"
                                                       id="mothers_name" autocomplete="off"
                                                       class="form-control bg-transparent @error('mothers_name') is-invalid @enderror"/>

                                                @error('mothers_name')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="marital_status">Marital Status <span
                                                        style="color: red;">*</span></label>
                                                <select id="marital_status" name="marital_status" data-control="select2"
                                                        class="form-select bg-transparent @error('marital_status') is-invalid @enderror"
                                                        data-hide-search="true">
                                                    <option value="">Select</option>
                                                    <option
                                                        value="1" {{old('marital_status',$data?->personalInfo?->marital_status)===1?'selected':''}}>
                                                        Unmarried
                                                    </option>
                                                    <option
                                                        value="2" {{old('marital_status',$data?->personalInfo?->marital_status)===2?'selected':''}}>
                                                        Married
                                                    </option>
                                                </select>

                                                @error('marital_status')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="religion_status">Religion <span style="color: red;">*</span></label>
                                                <select id="religion_status" name="religion_id"
                                                        class="form-select bg-transparent @error('religion_id') is-invalid @enderror"
                                                        data-hide-search="true">
                                                    <option value="">Select</option>
                                                    @foreach($religions as $religion)
                                                        <option
                                                            value="{{$religion->id}}" {{old('religion_id',$data?->personalInfo?->religion_id)===$religion->id?'selected':''}}>{{$religion->religion_name}}</option>
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
                                                <input type="text" placeholder="Enter your spouse name"
                                                       name="spouse_name"
                                                       {{$data?->personalInfo?->marital_status===1?'disabled':''}}
                                                       value="{{ old('spouse_name', $data?->personalInfo?->marital_status===2?$data->personalInfo?->spouse_name:'') }}"
                                                       id="spouse_name" class="form-control bg-transparent"/>
                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <div class="row">
                                                    <div class="col-12 col-md-4">
                                                        <label>Height <span style="color: red;">*</span></label>
                                                        <select id="height_feet" name="height_feet"
                                                                class="form-select bg-transparent @error('height_feet') is-invalid @enderror">
                                                            <option value="">Select</option>
                                                            @for ($i = 1; $i <= 10; $i++)
                                                                <option
                                                                    value="{{ $i }}" {{ old('height_feet', $data?->personalInfo?->height_feet) == $i ? 'selected' : '' }}>
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
                                                        <label for="height_inch">Inch</label>
                                                        <select id="height_inch" name="height_inch"
                                                                class="form-select bg-transparent">
                                                            <option value="">Inch</option>
                                                            @for($i = 1; $i<=12;$i++)
                                                                <option
                                                                    value="{{$i}}" {{old('height_inch',$data?->personalInfo?->height_inch)===$i?'selected':''}}>{{$i}}</option>
                                                            @endfor

                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <label>Weight <span style="color: red;">*</span></label>
                                                        <select id="height_inch" name="weight"
                                                                class="form-select bg-transparent @error('weight') is-invalid @enderror">
                                                            <option value="">Select</option>
                                                            @for ($i = 41; $i <= 150; $i++)
                                                                <option
                                                                    value="{{ $i }}" {{ old('weight', $data?->personalInfo?->weight) == $i ? 'selected' : '' }}>
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
                                                <a href="{{route('recruiting-agency.bmet.create',['expat_id' => request('expat_id'), 'status' => 1])}}">
                                                    <button type="button"
                                                            class="btn btn-lg btn-light-primary me-3 previous_btn_style">
                                                        <i class="ki-outline ki-arrow-left fs-4 me-1"></i> Back
                                                    </button>
                                                </a>
                                            </div>
                                            <div>
                                                <button type="submit"
                                                        class="btn btn-lg btn-primary bmet_reg_button_style"
                                                        data-kt-stepper-action="next">
                                                    Next <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade {{session('tab')==3?'in active show':''}}" id="tab-2nd">
                                <div class="w-100">
                                    <form action="{{route('recruiting-agency.contact.store')}}" method="post">@csrf
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="permanent_district_id">District <span
                                                        style="color: red;">*</span></label>
                                                <select name="permanent_district_id" id="districtSelect"
                                                        class="form-select bg-transparent @error('permanent_district_id') is-invalid @enderror">
                                                    <option value="">Select your district</option>
                                                    @foreach($districts as $district)
                                                        <option
                                                            value="{{ $district->id }}" {{ old('permanent_district_id', $data?->contactInfo?->permanent_district_id)==$district->id?'selected':'' }}>
                                                            {{ $district->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('permanent_district_id')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="">Thana/Upazila <span style="color: red;">*</span></label>
                                                @php
                                                    $upazilas = \DB::table('upazillas')->whereDistrictId($data?->contactInfo?->permanent_district_id)->get();
                                                @endphp
                                                <select name="permanent_upazilla_id" id="upazilaSelect"
                                                        class="form-select bg-transparent @error('permanent_upazilla_id') is-invalid @enderror">
                                                    <option value="">Select Upazila</option>
                                                    @foreach($upazilas as $upz)
                                                        <option
                                                            value="{{$upz->id}}" {{old('permanent_upazilla_id',$data?->contactInfo?->permanent_upazilla_id)==$upz->id?'selected':''}}>
                                                            {{$upz->upazila_name_en}}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('permanent_upazilla_id')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="">Word/Union <span style="color: red;">*</span></label>
                                                <input
                                                    class="form-control bg-transparent @error('permanent_union') is-invalid @enderror"
                                                    name="permanent_union"
                                                    value="{{ old('permanent_union', $data?->contactInfo?->permanent_union) }}"
                                                    id="permanent_union" placeholder="Enter your house name/no"/>
                                                @error('permanent_union')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="">Area/Village <span style="color: red;">*</span></label>
                                                <input
                                                    class="form-control bg-transparent @error('permanent_village') is-invalid @enderror"
                                                    name="permanent_village"
                                                    value="{{ old('permanent_village', $data?->contactInfo?->permanent_village) }}"
                                                    id="permanent_village" placeholder="Enter your house name/no"/>

                                                @error('permanent_village')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="">House name/no <span style="color: red;">*</span></label>
                                                <input
                                                    class="form-control bg-transparent @error('permanent_house') is-invalid @enderror"
                                                    name="permanent_house"
                                                    value="{{ old('permanent_house',$data?->contactInfo?->permanent_house) }}"
                                                    id="permanent_house" placeholder="Enter your house name/no"/>
                                                @error('permanent_house')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row py-12">
                                            <div class="col-12">
                                                <div class="form-check if-else-check">
                                                    <input class="form-check-input"
                                                           {{old('same_as',$data?->contactInfo?->same_as)==1?'checked':''}} name="same_as"
                                                           value="1"
                                                           type="checkbox" id="my_mailing_address"/>
                                                    <label class="form-check-label" for="my_mailing_address">
                                                        <h3>My mailing address is the same</h3>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="same_mailing_address_wrapper" id="mailingAddressWrapper">
                                            <div class="row">
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label for="">Birth District <span
                                                            style="color: red;">*</span></label>
                                                    <select name="mailing_district_id"
                                                            id="districtSelectForMailingAddress"
                                                            class="form-select bg-transparent @error('mailing_district_id') is-invalid @enderror">
                                                        <option value="">Select District</option>
                                                        @foreach($districts as $district)
                                                            <option
                                                                value="{{ $district->id }}" {{ old('mailing_district_id', $data?->contactInfo?->mailing_district_id) == $district->id ? 'selected' : '' }}>
                                                                {{ $district->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('mailing_district_id')
                                                    <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label for="">Thana/Upazilla <span
                                                            style="color: red;">*</span></label>
                                                    @php
                                                        $mailingUpazilas = \DB::table('upazillas')->whereDistrictId($data?->contactInfo?->mailing_district_id)->get();
                                                    @endphp
                                                    <select name="mailing_upazilla_id"
                                                            id="upazilaSelectForMailingAddress"
                                                            class="form-select bg-transparent @error('mailing_upazilla_id') is-invalid @enderror">
                                                        <option value="">Select Upazila</option>
                                                        @foreach($mailingUpazilas as $u)
                                                            <option
                                                                value="{{$u->id}}" {{old('mailing_upazilla_id',$data?->contactInfo?->mailing_upazilla_id)==$u->id?'selected':''}}>
                                                                {{$u->upazila_name_en}}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('mailing_upazilla_id')
                                                    <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label for="">Word/Union <span style="color: red;">*</span></label>
                                                    <input
                                                        class="form-control bg-transparent @error('mailing_union') is-invalid @enderror"
                                                        name="mailing_union"
                                                        value="{{ old('mailing_union', $data?->contactInfo?->mailing_union) }}"
                                                        id="mailing_union" placeholder="Enter your house name/no"/>

                                                    @error('mailing_union')
                                                    <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label for="">Area/Village <span
                                                            style="color: red;">*</span></label>
                                                    <input
                                                        class="form-control bg-transparent @error('mailing_village') is-invalid @enderror"
                                                        name="mailing_village"
                                                        value="{{ old('mailing_village', $data?->contactInfo?->mailing_village) }}"
                                                        id="mailing_village" placeholder="Enter your house name/no"/>

                                                    @error('mailing_village')
                                                    <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label for="">House name/no <span
                                                            style="color: red;">*</span></label>
                                                    <input
                                                        class="form-control bg-transparent @error('mailing_house') is-invalid @enderror"
                                                        name="mailing_house"
                                                        value="{{ old('mailing_house', $data?->contactInfo?->mailing_house) }}"
                                                        id="mailing_house" placeholder="Enter your house name/no"/>

                                                    @error('mailing_house')
                                                    <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-12">
                                            <div class="col-12">
                                                <h3>Emergency Contact</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="">Name <span style="color: red;">*</span></label>
                                                <input
                                                    class="form-control bg-transparent @error('emergency_contact_person_name') is-invalid @enderror"
                                                    name="emergency_contact_person_name"
                                                    value="{{ old('emergency_contact_person_name', $data?->contactInfo?->emergency_contact_person_name) }}"
                                                    id="" placeholder="Enter your name"/>

                                                @error('emergency_contact_person_name')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="relation_id">Relationship <span style="color: red;">*</span></label>
                                                        <select id="relation_id" name="relation_id"
                                                                class="form-select bg-transparent @error('relation_id') is-invalid @enderror">
                                                            <option value="">Select Relation</option>
                                                            @foreach($relation as $relationData)
                                                                <option
                                                                    value="{{ $relationData->id }}" {{ old('relation_id', $data?->contactInfo?->relation_id) == $relationData->id ? 'selected' : '' }}>
                                                                    {{ $relationData->relation_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        @error('relation_id')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="">Mobile Number <span
                                                                style="color: red;">*</span></label>
                                                        <input
                                                            class="form-control bg-transparent @error('emergency_contact_person_phone') is-invalid @enderror"
                                                            name="emergency_contact_person_phone"
                                                            value="{{ old('emergency_contact_person_phone',$data?->contactInfo?->emergency_contact_person_phone) }}"
                                                            minlength="11" maxlength="11" id=""
                                                            placeholder="Enter your number"/>

                                                        @error('emergency_contact_person_phone')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-stack pt-15">
                                                <div class="mr-2">
                                                    <a href="{{route('recruiting-agency.bmet.create',['expat_id' => request('expat_id'), 'status' => 2])}}">
                                                        <button type="button"
                                                                class="btn btn-lg btn-light-primary me-3 previous_btn_style">
                                                            <i class="ki-outline ki-arrow-left fs-4 me-1"></i> Back
                                                        </button>
                                                    </a>
                                                </div>
                                                <div>
                                                    <button type="submit"
                                                            class="btn btn-lg btn-primary bmet_reg_button_style"
                                                            data-kt-stepper-action="next">
                                                        Next
                                                        <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i>
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade {{session('tab')==4?'in active show':''}}">
                                <div class="w-100">
                                    <form action="{{route('recruiting-agency.nominee.store')}}" method="post">@csrf
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="nominee_relation_id">Relation with nominee <span
                                                        style="color: red;">*</span></label>
                                                <select id="nominee_relation_id" name="nominee_relation_id"
                                                        class="form-select bg-transparent @error('nominee_relation_id') is-invalid @enderror"
                                                        data-hide-search="true">
                                                    <option value="">Select Relation</option>
                                                    @foreach($relation as $relationData)
                                                        <option
                                                            value="{{ $relationData->id }}" {{ old('nominee_relation_id', $data?->nomineeInfo?->nominee_relation_id) == $relationData->id ? 'selected' : '' }}>
                                                            {{ $relationData->relation_name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('nominee_relation_id')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="">Nominee Name <span style="color: red;">*</span></label>
                                                <input
                                                    class="form-control bg-transparent @error('nominee_name') is-invalid @enderror"
                                                    name="nominee_name"
                                                    value="{{ old('nominee_name', $data?->nomineeInfo?->nominee_name) }}"
                                                    id="" placeholder="Enter Nominee Name"/>

                                                @error('nominee_name')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="">Nominee's national id</label>
                                                <input
                                                    class="form-control bg-transparent @error('nominee_nid') is-invalid @enderror"
                                                    name="nominee_nid"
                                                    value="{{ old('nominee_nid', $data?->nomineeInfo?->nominee_nid) }}"
                                                    minlength="10" maxlength="17" id=""
                                                    placeholder="Enter Nominee's national id (optional)"/>


                                                @error('nominee_nid')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="">Nominee's mobile number <span style="color: red;">*</span></label>
                                                <input
                                                    class="form-control bg-transparent @error('nominee_phone') is-invalid @enderror"
                                                    name="nominee_phone"
                                                    value="{{ old('nominee_phone', $data?->nomineeInfo?->nominee_phone) }}"
                                                    minlength="11" maxlength="11" id=""
                                                    placeholder="Enter Nominee's mobile number"/>

                                                @error('nominee_phone')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="">Nominee's father's name <span style="color: red;">*</span></label>
                                                <input
                                                    class="form-control bg-transparent @error('nominee_fathers_name') is-invalid @enderror"
                                                    name="nominee_fathers_name"
                                                    value="{{ old('nominee_fathers_name',$data?->nomineeInfo?->nominee_fathers_name) }}"
                                                    id="" placeholder="Enter Nominee's father's name"/>

                                                @error('nominee_fathers_name')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-6 mb-4">
                                                <label for="">Nominee's mother's name <span style="color: red;">*</span></label>
                                                <input
                                                    class="form-control bg-transparent @error('nominee_mothers_name') is-invalid @enderror"
                                                    name="nominee_mothers_name"
                                                    value="{{ old('nominee_mothers_name', $data?->nomineeInfo?->nominee_mothers_name) }}"
                                                    id="" placeholder="Enter Nominee's mother's name"/>

                                                @error('nominee_mothers_name')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row py-12">
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                           {{old('same_as',$data?->nomineeInfo?->same_as)==1?'checked':''}} name="same_as"
                                                           value="1" id="nominee_address_same"/>
                                                    <label class="form-check-label" for="nominee_address_same">
                                                        <h3>Nominee address is the same as my permanent address</h3>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="same_nominee_wrapper">
                                            <div class="row">
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label for="nominee_district_id">Birth District <span
                                                            style="color: red;">*</span></label>
                                                    <select name="nominee_district_id" id="districtSelectForNominee"
                                                            class="form-select bg-transparent @error('nominee_district_id') is-invalid @enderror">
                                                        <option value="">Select your birth district</option>
                                                        @foreach($districts as $district)
                                                            <option
                                                                value="{{ $district->id }}">{{ $district->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('nominee_district_id')
                                                    <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                      </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label for="">Thana/Upazila <span
                                                            style="color: red;">*</span></label>
                                                    <select name="nominee_upazilla_id" id="upazilaSelectForNominee"
                                                            class="form-select bg-transparent @error('nominee_upazilla_id') is-invalid @enderror">
                                                    <option value="">Select Upazila</option>
                                                    </select>
                                                    @error('nominee_upazilla_id')
                                                    <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                      </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label for="">Word/Union <span style="color: red;">*</span></label>
                                                    <input
                                                        class="form-control bg-transparent @error('nominee_union') is-invalid @enderror"
                                                        name="nominee_union"
                                                        value="{{$data?->nomineeInfo?->nominee_union}}" id=""
                                                        placeholder="Enter your house name/no"/>
                                                    @error('nominee_union')
                                                    <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                      </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label for="">Area/Village <span
                                                            style="color: red;">*</span></label>
                                                    <input
                                                        class="form-control bg-transparent @error('nominee_village') is-invalid @enderror"
                                                        name="nominee_village"
                                                        value="{{$data?->nomineeInfo?->nominee_village}}" id=""
                                                        placeholder="Enter your house name/no"/>
                                                    @error('nominee_village')
                                                    <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                      </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label for="">House name/no <span
                                                            style="color: red;">*</span></label>
                                                    <input
                                                        class="form-control bg-transparent @error('nominee_house') is-invalid @enderror"
                                                        name="nominee_house"
                                                        value="{{$data?->nomineeInfo?->nominee_house}}" id=""
                                                        placeholder="Enter your house name/no"/>
                                                    @error('nominee_house')
                                                    <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                      </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-stack pt-15">
                                            <div class="mr-2">
                                                <a href="{{route('recruiting-agency.bmet.create',['expat_id' => request('expat_id'), 'status' => 3])}}">
                                                    <button type="button"
                                                            class="btn btn-lg btn-light-primary me-3 previous_btn_style">
                                                        <i class="ki-outline ki-arrow-left fs-4 me-1"></i> Back
                                                    </button>
                                                </a>
                                            </div>
                                            <div>
                                                <button type="submit"
                                                        class="btn btn-lg btn-primary bmet_reg_button_style"
                                                        data-kt-stepper-action="next">
                                                    Next <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade {{session('tab')==5?'in active show':''}}" id="tab-5th">
                                <div class="w-100">
                                    <form action="{{route('recruiting-agency.education.store')}}" method="post">@csrf
                                        <h3 class="mt-5">Your Last Education Information</h3>
                                        <div class="mb-12"></div>
                                        <div id="form-container">
                                            <div class="education-information">
                                                @php
                                                       $eduList = isset($data->qualificationInfo)?json_decode($data->qualificationInfo?->education,true):[''];
                                                       $oldEducations = old('education', $eduList);
                                                       $oldCount = count($oldEducations);
                                                @endphp

                                                @for($index=0;$index<$oldCount;$index++)
                                                    <div class="row" id="education-{{$index}}">
                                                        @if($index > 0)
                                                            <div class="col-md-12">
                                                                <button type="button"
                                                                        class="btn btn-danger remove-education float-end"
                                                                        data-id="{{$index}}">
                                                                    Remove
                                                                </button>
                                                            </div>
                                                        @endif
                                                        <div class="col-md-6 mb-3">
                                                            <label for="" class="form-label">Education Level<span
                                                                    class="text-danger">*</span></label>
                                                            <select name="education[{{$index}}][level]" id=""
                                                                    class="form-select @error("education.$index.level") is-invalid @enderror">
                                                                <option value="">Choose</option>
                                                                @foreach($eduLevels as $educationLevelData)
                                                                    <option
                                                                        value="{{ $educationLevelData->education_level_name }}" {{old("education.$index.level",$data?->qualificationInfo?->education?$eduList[$index]['level']:'')==$educationLevelData->education_level_name?'selected':''}}>
                                                                        {{ $educationLevelData->education_level_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error("education.$index.level")
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="" class="form-label">Passing Year<span
                                                                    class="text-danger">*</span></label>
                                                            <select name="education[{{$index}}][passing_year]" id=""
                                                                    class="form-select @error("education.$index.passing_year") is-invalid @enderror">
                                                                <option value="">Select your Passing Year</option>
                                                                @for ($i = 1970; $i <= date('Y'); $i++)
                                                                    <option
                                                                        value="{{ $i }}" {{old("education.{$index}.passing_year",$data?->qualificationInfo?->education?$eduList[$index]['passing_year']:'')==$i?'selected':''}}>
                                                                        {{ $i }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                            @error("education.$index.passing_year")
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="" class="form-label">Institute/School<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="education[{{$index}}][institute]"
                                                                   value="{{old("education.{$index}.institute",$data?->qualificationInfo?->education?$eduList[$index]['institute']:'')}}" id=""
                                                                   placeholder="Enter Institute/School"
                                                                   class="form-control @error("education.$index.institute") is-invalid @enderror">
                                                            @error("education.$index.institute")
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="" class="form-label">Board</label>
                                                            <select name="education[{{$index}}][board]" id=""
                                                                    class="form-select @error("education.$index.board") is-invalid @enderror">
                                                                <option value="">Select board</option>
                                                                @foreach($boards as $board)
                                                                <option value="{{$board}}" {{old("education.{$index}.board",$data?->qualificationInfo?->education?$eduList[$index]['board']:'')==$i?'selected':''}}>{{$board}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error("education.$index.board")
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="" class="form-label">Subject</label>
                                                            <input type="text" name="education[{{$index}}][subject]"
                                                                   value="{{old("education.{$index}.subject",$data?->qualificationInfo?->education?$eduList[$index]['subject']:'')}}" id=""
                                                                   placeholder="Enter subject"
                                                                   class="form-control @error("education.$index.subject") is-invalid @enderror">
                                                            @error("education.$index.subject")
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="" class="form-label">Grade<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="education[{{$index}}][grade]"
                                                                   value="{{old("education.{$index}.grade",$data?->qualificationInfo?->education?$eduList[$index]['grade']:'')}}"
                                                                   placeholder="Enter Grade/Division" id=""
                                                                   class="form-control @error("education.$index.grade") is-invalid @enderror">
                                                            @error("education.$index.grade")
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>

                                            <div id="additional-education-container"></div>

                                            <!-- Button to add more education fields -->
                                            <button type="button" id="add-education" class="btn btn-primary float-end">
                                                Add More
                                            </button>

                                        </div>
                                        <div class="row mt-12">
                                            <div class="col-12">
                                                <h3>Languages</h3>
                                            </div>
                                        </div>
                                        <div class="mb-12"></div>
                                        <div class="same_mailing_address_wrapper">
                                            <div class="lang_wrapper">
                                                @php
                                                    $langList = isset($data->qualificationInfo)?json_decode($data?->qualificationInfo?->language,true):[''];

                                                    $oldLangues = old('language', $langList);
                                                    $langCount = count($oldLangues);
                                                @endphp
{{--                                                    {{$langList[0]['lang_name']}}--}}
                                               @for($i=0; $i < $langCount; $i++)
                                                    <div class="row">
                                                        @if($i > 0)
                                                            <div class="col-md-12">
                                                                <button type="button"
                                                                        class="btn btn-danger remove-language float-end"
                                                                        data-id="{{$i}}">
                                                                    Remove
                                                                </button>
                                                            </div>
                                                        @endif
                                                        <div class="col-12 col-md-4 mb-4">
                                                            <label for="">Language Name</label>
                                                            <select id="" name="language[{{$i}}][lang_name]" class="form-select  @error("language.$i.lang_name") is-invalid @enderror">
                                                                <option value="">Select your Language</option>
                                                                @foreach($languages as $langaugeData)
                                                                    <option value="{{$langaugeData->language_name}}" {{old("language.$i.lang_name",$data?->qualificationInfo?->language?$langList[$i]['lang_name']:'')==$langaugeData->language_name?'selected':''}}>{{$langaugeData->language_name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error("language.$i.lang_name")
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-12 col-md-4 mb-4">
                                                            <label for="oral">Oral Skill</label>
                                                            <select id="oral" name="language[{{$i}}][oral]" class="form-select bg-transparent  @error("language.$i.oral") is-invalid @enderror">
                                                                <option value="">Select your Skill</option>
                                                                @foreach(['Good','Native','Workable'] as $skill)
                                                                    <option value="{{$skill}}" {{old("language.$i.oral",$data?->qualificationInfo?->language?$langList[$i]['oral']:'')==$skill?'selected':''}}>{{$skill}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error("language.$i.oral")
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-12 col-md-4 mb-4">
                                                            <label for="writing">Writing Skill</label>
                                                            <select id="writing" name="language[{{$i}}][writing]" class="form-select  @error("language.$i.writing") is-invalid @enderror">
                                                                <option value="">Select your Skill</option>
                                                                @foreach(['Good','Native','Workable'] as $skill)
                                                                    <option value="{{$skill}}" {{old("language.$i.writing",$data?->qualificationInfo?->language?$langList[$i]['writing']:'')==$skill?'selected':''}}>{{$skill}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error("language.$i.writing")
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>
                                            <button type="button" id="add-language" class="btn btn-primary float-end">
                                                Add More
                                            </button>
                                            <br>
                                            <div class="mb-12"></div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label for="desired_currency_id">Desired Countries</label>
                                                    <select id="desired_currency_id" name="desired_currency_id[]"
                                                            data-control="select2" class="form-select bg-transparent"
                                                            data-control="select2" data-close-on-select="false"
                                                            data-placeholder="Select an option" data-allow-clear="true"
                                                            multiple="multiple">
                                                        <option value="2">Select Desired Countries</option>
                                                        @foreach($currencies as $currencyData)
                                                            <option value="{{$currencyData->id}}">{{$currencyData->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label for="preferred_job_category_id">Preferred Job</label>
                                                    <select id="preferred_job_category_id"
                                                            name="preferred_job_category_id[]" data-control="select2"
                                                            class="form-select bg-transparent" data-control="select2"
                                                            data-close-on-select="false"
                                                            data-placeholder="Select an option" data-allow-clear="true"
                                                            multiple="multiple">
                                                        <option value="2">Select Job Category</option>

                                                        @foreach($jobCategories as $jobCategoryData)
                                                            <option value="{{$jobCategoryData->id}}">{{$jobCategoryData->job_category_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-stack pt-15">
                                                <div class="mr-2">
                                                    <a href="{{route('recruiting-agency.bmet.create',['expat_id' => request('expat_id'), 'status' => 4])}}">
                                                        <button type="button"
                                                                class="btn btn-lg btn-light-primary me-3 previous_btn_style">
                                                            <i class="ki-outline ki-arrow-left fs-4 me-1"></i> Back
                                                        </button>
                                                    </a>
                                                </div>
                                                <div>
                                                    <button type="submit"
                                                            class="btn btn-lg btn-primary bmet_reg_button_style"
                                                            data-kt-stepper-action="next">
                                                        Next <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade {{session('tab')==6?'in active show':''}}">
                                <div class="w-100">
                                    <section class="approval_status_section_area">
                                        <div class="row py-10">
                                            <div class="col-6" style="border-right: 1px solid rgb(162, 163, 183);">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h4>Passport Verification Status</h4>
                                                    </div>
                                                    <div class="col-4 text-end">
                                                            @if($data?->verificationInfo?->candidate_verify_status == 1 ?? '')
                                                                <p class="font-weight-bold text-success">Verified <i class="far fa-check-circle" style="color: rgb(17, 125, 124);"></i></p>
                                                            @elseif($data?->verificationInfo?->candidate_verify_status == 0 ?? '')
                                                                <p class="font-weight-bold text-danger">Not Verified <i class="far fa-check-circle" style="color: rgb(17, 125, 124);"></i></p>
                                                            @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <p class="text-left">
                                                    <span>
                                                        <span>
                                                            Your passport verification is successful! Please make sure all your information is correct. Correcting information after payment will take a substantial amount of time. After verification, please make payment to complete
                                                            your BMET registration.
                                                        </span>
                                                    </span>
                                                </p>
                                                <p>
                                                    @if($data?->verificationInfo && $data?->verificationInfo?->payment_status == 0)
                                                        <a class="btn btn-success btn-sm" href="{{ route('recruiting-agency.registration.payment',['id'=>$data?->verificationInfo->passport_info_id]) }}">
                                                            <i class="fa-solid fa-eye"></i> Payment
                                                        </a>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </section>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/bmetRegistration.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#passport_no').on('input', function () {
                const passportNumber = $(this).val();
                if (passportNumber.length === 9) {
                    axios.post('{{route('recruiting-agency.passport.info')}}', {passport_no: passportNumber})
                        .then(function (response) {
                            if (response.status === 200) {
                                const info = response.data;
                                $('#male').prop('checked', info.gender === 1);
                                $('#female').prop('checked', info.gender === 2);
                                $('#passport_issue_date, #passport_expiry_date, #dob, #phone, #full_name, #district_id').each((index, element) => {
                                    const fieldId = $(element).attr('id');
                                    $(element).val(info[fieldId]);
                                });
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            });

            //Mailing District wise Upazila Populate
            const districtSelectForMailingAddress = $('#districtSelectForMailingAddress');
            const upazilaSelectForMailingAddress = $('#upazilaSelectForMailingAddress');

            districtSelectForMailingAddress.on('change', function () {
                const districtId = districtSelectForMailingAddress.val();
                upazilaSelectForMailingAddress.html('<option value="">Select Upazila</option>');
                if (districtId !== '') {
                    axios.get(`/recruiting-agency/get-upazilas/${districtId}`)
                        .then(response => {
                            const data = response.data;
                            data.forEach(upazila => {
                                const option = $('<option>');
                                option.val(upazila.id);
                                option.text(upazila.upazila_name_en);
                                upazilaSelectForMailingAddress.append(option);
                            });
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            });

        });

        $(document).ready(function () {
            const districtSelect = $('#districtSelect');
            const upazilaSelect = $('#upazilaSelect');
            districtSelect.on('change', function () {
                const districtId = districtSelect.val();
                upazilaSelect.empty().append($('<option value="">Select Upazila</option>'));
                if (districtId !== '') {
                    axios.get(`/recruiting-agency/get-upazilas/${districtId}`)
                        .then(function (response) {
                            const data = response.data;
                            data.forEach(function (upazila) {
                                const option = $('<option></option>')
                                    .attr('value', upazila.id)
                                    .text(upazila.upazila_name_en);
                                upazilaSelect.append(option);
                            });
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                }
            });


            const checkbox = $('#my_mailing_address');
            const mailingAddressWrapper = $('#mailingAddressWrapper');

            toggleMailingAddressFields(!checkbox.is(':checked'));

            // Add an event listener to the checkbox
            checkbox.on('change', function () {
                toggleMailingAddressFields(!this.checked);
            });

            function toggleMailingAddressFields(checked) {
                mailingAddressWrapper.css('display', checked ? 'block' : 'none');
            }

            //Nominee Same as
            const nomineeCheck = $('#nominee_address_same');
            const same_nominee_wrapper = $('.same_nominee_wrapper');

            nomineeWrapper(!nomineeCheck.is(':checked'));

            // Add an event listener to the checkbox
            nomineeCheck.on('change', function () {
                nomineeWrapper(!this.checked);
            });

            function nomineeWrapper(checked) {
                same_nominee_wrapper.css('display', checked ? 'block' : 'none');
            }
        });


        const districtSelectForNominee = document.getElementById('districtSelectForNominee');
        const upazilaSelectForNominee = document.getElementById('upazilaSelectForNominee');
        districtSelectForNominee.addEventListener('change', () => {
            const districtId = districtSelectForNominee.value;
            // Clear upazila dropdown
            upazilaSelectForNominee.innerHTML = '<option value="">Select Upazila</option>';
            if (districtId !== '') {
                fetch(`/recruiting-agency/get-upazilas/${districtId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(upazila => {
                            const option = document.createElement('option');
                            option.value = upazila.id;
                            option.textContent = upazila.upazila_name_en;
                            upazilaSelectForNominee.appendChild(option);
                        });
                    });
            }
        });


        $(document).ready(function () {
            let educationFieldCount = 0;

            $("#add-education").click(function () {
                educationFieldCount++;
                const newEducationField = `
                <div class="education-information" id="education-${educationFieldCount}">
                    <div class="row">
                    <div class="col-md-12">
<button type="button" class="btn btn-danger remove-education float-end" data-id="${educationFieldCount}">
                        Remove
                    </button>
</div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="" class="form-label">Education level <span style="color: red;">*</span></label>
                            <select id="" name="education[${educationFieldCount}][level]" class="form-select">
                                <option value="">Select your education level</option>
                                  @foreach($eduLevels as $educationLevelData)
                <option
                    value="{{ $educationLevelData->education_level_name }}" {{old("education.$index.level")==$educationLevelData->education_level_name?'selected':''}}>
                                                                        {{ $educationLevelData->education_level_name }}
                </option>
@endforeach
                </select>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="" class="form-label">Passing Year <span style="color: red;">*</span></label>
                <select id="" name="education[${educationFieldCount}][passing_year]" class="form-select">
                                <option value="">Select your Passing Year</option>
                                     @for ($i = 1970; $i <= date('Y'); $i++)
                <option value="{{ $i }}" {{old("education.{$index}.passing_year")==$i?'selected':''}}>              {{ $i }}
                </option>
@endfor
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <label for="" class="form-label">Institute/School <span style="color: red;">*</span></label>
                <input class="form-control" name="education[${educationFieldCount}][institute]" id="" placeholder="Enter Institute/School">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="" class="form-label">Board</label>
                            <select id="" name="education[${educationFieldCount}][board]" class="form-select">
                                <option value="">Select board</option>
                               @foreach($boards as $board)
                <option value="{{$board}}">{{$board}}</option>
                                                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="" class="form-label">Subject</label>
                            <input class="form-control" name="education[${educationFieldCount}][subject]" id="" placeholder="Enter subject">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="" class="form-label">Grade/Division <span style="color: red;">*</span></label>
                            <input class="form-control " name="education[${educationFieldCount}][grade]" id="" placeholder="Enter Grade/Division">
                        </div>
                    </div>

                </div>
            `;

                $("#additional-education-container").append(newEducationField);
            });

            // Delegate the click event to dynamically added elements
            $(document).on("click", ".remove-education", function () {
                const educationId = $(this).data("id");
                $("#education-" + educationId).remove();
            });
        });

        $(document).ready(function () {
            let langCount = 0;
            $('#add-language').click(function () {
                langCount++;
                const newLangField = `
                <div class="row" id="lang-${langCount}">
 <div class="col-md-12">
<button type="button" class="btn btn-danger remove-language float-end" data-id="${langCount}">
                        Remove
                    </button>
</div>
                                                    <div class="col-12 col-md-4 mb-4">
                                                        <label for="">Language Name</label>
                                                        <select id="" name="language[${langCount}][lang_name]" class="form-select">
                                                            <option value="">Select your Language</option>
                                                                                                                          <option value="English">English</option>
                                                                                                                            <option value="Bangla">Bangla</option>
                                                                                                                    </select>
                                                    </div>
                                                    <div class="col-12 col-md-4 mb-4">
                                                        <label for="oral">Oral Skill</label>
                                                        <select id="oral" name="language[${langCount}][oral]" class="form-select bg-transparent">
                                                            <option value="">Select your Skill</option>
                                                            <option value="Good">Good</option>
                                                            <option value="Native">Native</option>
                                                            <option value="Workable">Workable</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-4 mb-4">
                                                        <label for="writing">Writing Skill</label>
                                                        <select id="writing" name="language[${langCount}][writing]"  class="form-select bg-transparent">
                                                            <option value="">Select your Skill</option>
                                                            <option value="Good">Good</option>
                                                            <option value="Native">Native</option>
                                                            <option value="Workable">Workable</option>
                                                        </select>
</div>
                                                </div>`;

                $('.lang_wrapper').append(newLangField);
            });
            $(document).on("click", ".remove-language", function () {
                const langId = $(this).data("id");
                $("#lang-" + langId).remove();
            });
        })
    </script>

@endsection
