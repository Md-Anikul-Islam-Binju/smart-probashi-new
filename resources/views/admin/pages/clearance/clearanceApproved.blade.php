@extends('layouts.admin.master')
@section('content')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid">
            <div class="row align-items-center">
                <div class="col-4">
                    <a href="#" class="btn btn-primary">
                        <i class="ki-duotone ki-left"></i>Back</a>
                </div>
                <div class="col-4 text-center">
                    <h1 class="text-dark fw-bold my-1 fs-3">Sign Application</h1>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>

<div class="container-fluid" id="kt_content_container">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="clearance_summery_new d-md-flex justify-content-center mt-4">
                <div class="clearence_item">
                    <div class="media">
                        <img src="{{ URL::to('assets/media/clearance/1.png') }}" alt="..." class="align-self-center mr-3" style="width: 30px;">
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
                        <img src="{{ URL::to('assets/media/clearance/country.png') }}" alt="..." class="align-self-center mr-3" style="width: 30px;">
                        <div class="media-body">
                            <p>
                                <span class="mr-3">Country</span>
                            </p>
                            <p>{{$clearance->country->country_name}}</p>
                        </div>
                    </div>
                </div>
                <div class="clearence_item mx-md-4 my-2 my-md-0">
                    <div class="media">
                        <img src="{{ URL::to('assets/media/clearance/3.png') }}" alt="..." class="align-self-center mr-3" style="width: 30px;">
                        <div class="media-body">
                            <p>
                                <span class="mr-3">Application Id</span>
                            </p>
                            <p>{{$clearance->application_no}}</p>
                        </div>
                    </div>
                </div>
                <div class="clearence_item">
                    <div class="media">
                        <div class="media-body">
                            <p>
                                <span class="mr-3">Application Date</span>
                            </p>
                            <p>{{ \Carbon\Carbon::parse($clearance->created_at)->format('j M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

         <form action="{{route('admin.clearance.sign.update',$clearance->id)}}" method="post" enctype="multipart/form-data">
             @csrf
            <div>
                <div class="approval_box_design mb-4">
                    <h2>Section</h2>
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Name</label>
                                <input type="text" name="section_name" value="{{$clearance->section_name}}" class="form-control bg-transparent" placeholder="Enter your name">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-check mt-7 form-check-lg">
                                <input class="form-check-input" type="checkbox" id="section_approved_status" value="1"  name="section_approved_status"  {{ $clearance->section_approved_status == 1 ? 'checked' : '' }} />
                                <label class="form-check-label ms-2" style="font-size: 18px;" for="flexCheckboxLg">
                                    Approval Status
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Signature</label>
                                <input type="file" name="section_sign" class="form-control bg-transparent">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Date</label>
                                <input type="date" name="section_date" value="{{ \Carbon\Carbon::parse($clearance->section_date)->format('Y-m-d') }}" class="form-control bg-transparent">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="approval_box_design mb-4">
                    <h2>Translator</h2>
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Name</label>
                                <input type="text" name="translator_name" value="{{$clearance->translator_name}}" class="form-control bg-transparent" placeholder="Enter your name">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-check mt-7 form-check-lg">
                                <input class="form-check-input" type="checkbox" id="translator_approved_status" value="1"  name="translator_approved_status"  {{ $clearance->translator_approved_status == 1 ? 'checked' : '' }} />
                                <label class="form-check-label ms-2" style="font-size: 18px;" for="flexCheckboxLg">
                                    Approval Status
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Signature</label>
                                <input type="file" name="translator_sign" class="form-control bg-transparent">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Date</label>
                                <input type="date" name="translator_date" value="{{ \Carbon\Carbon::parse($clearance->translator_date)->format('Y-m-d') }}" class="form-control bg-transparent">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="approval_box_design mb-4">
                    <h2>AD</h2>
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Name</label>
                                <input type="text" name="ad_name"  value="{{$clearance->ad_name}}"  class="form-control bg-transparent" placeholder="Enter your name">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-check mt-7 form-check-lg">
                                <input class="form-check-input" type="checkbox" id="ad_approved_status" value="1"  name="ad_approved_status"  {{ $clearance->ad_approved_status == 1 ? 'checked' : '' }} />
                                <label class="form-check-label ms-2" style="font-size: 18px;" for="flexCheckboxLg">
                                    Approval Status
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Signature</label>
                                <input type="file" name="ad_sign" class="form-control bg-transparent">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Date</label>
                                <input type="date" name="ad_date"  value="{{ \Carbon\Carbon::parse($clearance->ad_date)->format('Y-m-d') }}"  class="form-control bg-transparent">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="approval_box_design mb-4">
                    <h2>DD</h2>
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Name</label>
                                <input type="text" name="dd_name"  value="{{$clearance->dd_name}}" class="form-control bg-transparent" placeholder="Enter your name">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-check mt-7 form-check-lg">
                                <input class="form-check-input" type="checkbox" id="dd_approved_status" value="1"  name="dd_approved_status"  {{ $clearance->dd_approved_status == 1 ? 'checked' : '' }} />
                                <label class="form-check-label ms-2" style="font-size: 18px;" for="flexCheckboxLg">
                                    Approval Status
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Signature</label>
                                <input type="file" name="dd_sign"  class="form-control bg-transparent">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Date</label>
                                <input type="date" name="dd_date" value="{{ \Carbon\Carbon::parse($clearance->dd_date)->format('Y-m-d') }}" class="form-control bg-transparent">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="approval_box_design mb-4">
                    <h2>D</h2>
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Name</label>
                                <input type="text" name="d_name" value="{{$clearance->d_name}}" class="form-control bg-transparent" placeholder="Enter your name">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-check mt-7 form-check-lg">
                                <input class="form-check-input" type="checkbox" id="d_approved_status" value="1"  name="d_approved_status"  {{ $clearance->d_approved_status == 1 ? 'checked' : '' }} />
                                <label class="form-check-label ms-2" style="font-size: 18px;" for="flexCheckboxLg">
                                    Approval Status
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Signature</label>
                                <input type="file" name="d_sign" class="form-control bg-transparent">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Date</label>
                                <input type="date" name="d_date" value="{{ \Carbon\Carbon::parse($clearance->d_date)->format('Y-m-d') }}" class="form-control bg-transparent">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="approval_box_design mb-4">
                    <h2>ADG</h2>
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Name</label>
                                <input type="text" name="adg_name" value="{{$clearance->adg_name}}" class="form-control bg-transparent" placeholder="Enter your name">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-check mt-7 form-check-lg">
                                <input class="form-check-input" type="checkbox" id="adg_approved_status" value="1"  name="adg_approved_status"  {{ $clearance->adg_approved_status == 1 ? 'checked' : '' }} />
                                <label class="form-check-label ms-2" style="font-size: 18px;" for="flexCheckboxLg">
                                    Approval Status
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Signature</label>
                                <input type="file" name="adg_sign" class="form-control bg-transparent">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Date</label>
                                <input type="date" name="adg_date" value="{{ \Carbon\Carbon::parse($clearance->adg_date)->format('Y-m-d') }}" class="form-control bg-transparent">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="approval_box_design mb-4">
                    <h2>DG</h2>
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Name</label>
                                <input type="text" name="dg_name" value="{{$clearance->dg_name}}" class="form-control bg-transparent" placeholder="Enter your name">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-check mt-7 form-check-lg">
                                <input class="form-check-input" type="checkbox" id="dg_approved_status" value="1"  name="dg_approved_status"  {{ $clearance->dg_approved_status == 1 ? 'checked' : '' }} />
                                <label class="form-check-label ms-2" style="font-size: 18px;" for="flexCheckboxLg">
                                    Approval Status
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Signature</label>
                                <input type="file" name="dg_sign" class="form-control bg-transparent">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label style="font-size: 14px;">Date</label>
                                <input type="date" name="dg_date" value="{{ \Carbon\Carbon::parse($clearance->dg_date)->format('Y-m-d') }}" class="form-control bg-transparent">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="d-flex justify-content-end w-100">
                 <button type="submit" class="btn px-5 btn-position mr-5 btn-primary"> Update  Sign Application</button>
             </div>
         </form>

        </div>
    </div>
</div>


@endsection
