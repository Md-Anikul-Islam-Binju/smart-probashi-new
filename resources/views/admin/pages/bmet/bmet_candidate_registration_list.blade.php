@extends('layouts.admin.master')
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
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
                <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3">Probashi Bondhu</h1>
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/" class="text-muted text-hover-primary">DASHBOARD</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">BMET Register Completed Candidate List</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                            <input type="text" id="search-passport" data-kt-ecommerce-product-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search BMET Candidate" />
                        </div>
                        <div id="kt_datatable_example_1_export" class="d-none"></div>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="">

                        <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th>S/N</th>
                            <th>Agency Information</th>
                            <th>Full Name</th>
                            <th>Phone No</th>
                            <th>Passport No</th>
                            <th>Payment</th>
                            <th>Verification status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        @foreach($passportInfos as $key=>$data)
                            @if($data->verificationInfo!=null)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    Name: {{$data->recruitingAgency? $data->recruitingAgency->name:'N/A'}}
                                    <br>
                                    Email: {{$data->recruitingAgency? $data->recruitingAgency->email:'N/A'}}
                                    <br>
                                    Phone: {{$data->recruitingAgency? $data->recruitingAgency->phone:'N/A'}}
                                </td>
                                <td>{{$data->full_name}}</td>
                                <td>{{$data->phone}}</td>
                                <td>{{$data->passport_no}}</td>
                                <td>
                                    @if($data->verificationInfo)
                                        @if($data->verificationInfo->payment_status == 1)
                                            <span class="badge badge-light-success">Paid</span>
                                        @elseif($data->verificationInfo->payment_status == 0)
                                            <span class="badge badge-light-warning">Not-Paid</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if($data->verificationInfo)
                                        @if($data->verificationInfo->registration_status == 1)
                                            <span class="badge badge-light-success">Verified</span>
                                        @elseif($data->verificationInfo->registration_status == 0)
                                            <span class="badge badge-light-warning">Not-Verified</span>
                                        @endif
                                    @endif
                                </td>


                                <td>
                                    <a href="{{route('admin.bmet.candidate.registered.details',$data->id)}}" class="btn btn-sm btn-primary">View</a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
