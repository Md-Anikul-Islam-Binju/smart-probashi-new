@extends('layouts.recruitingAgency.master')
@section('content')
    <!-- Toaster Messages -->
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
        <div id="kt_toolbar_container" class="container-fluid">
            <div class="row align-items-center">
                <div class="col-4">
                    <a href="{{url()->previous()}}" class="btn btn-primary">
                        <i class="ki-duotone ki-left"></i>Back</a>
                </div>
                <div class="col-4 text-center">
                    <h1 class="text-dark fw-bold my-1 fs-3">New BMET Registration</h1>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>

    <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card card-custom">
                <div class="card-body">
                    <div class="card-header align-items-start py-5 gap-2 gap-md-5">
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <a href="{{route('recruiting-agency.bmet.create')}}" class="btn bmet_reg_btn mb-8">New BMET Registration</a>
                        </div>
                    </div>
                    <div class="table-responsive job_list_table">
                        <div id="posts_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-hover training_table dataTable no-footer dtr-inline" style="margin: 13px 0px !important;" id="kt_datatable" role="grid" aria-describedby="posts_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 135px;">S/N</th>
                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 63px;">Full Name</th>
                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 115px;">Mobile No</th>
                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 262px;">Passport No</th>
                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 225px;">Registration status</th>
                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 108px;">Verification status</th>
                                            <th class="text-center sorting_disabled" rowspan="1" colspan="1" style="width: 65px;">Payment Status</th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 46px;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($passportInfos as $key=>$data)
                                            <tr role="row">
                                                <td tabindex="0" data-kt-ecommerce-product-filter="job_category_name">
                                                    {{$key+1}}
                                                </td>
                                                <td class="text-center">
                                                    {{$data->full_name}}
                                                </td>
                                                <td class="text-center">
                                                    {{$data->phone}}
                                                </td>
                                                <td class="text-center">
                                                    {{$data->passport_no}}
                                                </td>
                                                <td class="text-center">
                                                    @if($data->verificationInfo)
                                                        @if($data->verificationInfo->registration_status == 1)
                                                            <span class="badge badge-light-success">Verified</span>
                                                        @elseif($data->verificationInfo->registration_status == 0)
                                                            <span class="badge badge-light-warning">Not-Verified</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-light-danger">Not-Complete</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($data->verificationInfo)
                                                        @if($data->verificationInfo->candidate_verify_status == 1)
                                                            <span class="badge badge-light-success">Verified</span>
                                                        @elseif($data->verificationInfo->candidate_verify_status == 0)
                                                            <span class="badge badge-light-warning">Not-Verified</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-light-danger">Not-Complete</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($data->verificationInfo)
                                                        @if($data->verificationInfo->payment_status == 1)
                                                            <span class="badge badge-light-success">Paid</span>
                                                        @elseif($data->verificationInfo->payment_status == 0)
                                                            <span class="badge badge-light-warning">Non-Paid</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-light-danger">Not-Complete</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group dropstart action_button_wrapper">
                                                        <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-angles-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu action_dropdown_menu">
                                                            @if(($data?->verificationInfo?$data->verificationInfo->registration_status == 0:'') || ($data->verificationInfo?$data->verificationInfo->candidate_verify_status == 0:'') || $data->verificationInfo==null)
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('recruiting-agency.bmet.create', ['expat_id'=>$data->id]) }}"><i class="fa-solid fa-eye"></i> Edit </a>
                                                                </li>
                                                            @endif

                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('recruiting-agency.bmet.registration.details',$data->id) }}"><i class="fa-solid fa-eye"></i> View </a>
                                                            </li>

                                                            @if(($data?->verificationInfo?$data?->verificationInfo->payment_status == 1:'') && ($data?->verificationInfo?$data?->verificationInfo->candidate_verify_status == 1:'') && ($data?->verificationInfo?$data->verificationInfo->registration_status == 1:''))
                                                                <li>
                                                                    <a class="dropdown-item" href="#"><i class="fa-solid fa-eye"></i> Print BMET No </a>
                                                                </li>
                                                            @elseif($data?->verificationInfo && $data?->verificationInfo?->payment_status == 0)
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('recruiting-agency.registration.payment',['id'=>$data?->verificationInfo->passport_info_id]) }}">
                                                                        <i class="fa-solid fa-eye"></i> Payment
                                                                    </a>
                                                                </li>
                                                            @endif
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

