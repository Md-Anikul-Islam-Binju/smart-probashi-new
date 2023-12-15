@extends('layouts.admin.master')
@section('content')
    <style>
        .file_icon_style,
        .file_icon_style_xmark{
            text-align: center;
        }
        .file_icon_style i {
            color: #84cf8c;
        }
        .file_icon_style_xmark i {
            color: #ff0000;
        }
        .file_icon_style i,
        .file_icon_style_xmark i {
            font-size: 20px;
        }
    </style>
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
                    <li class="breadcrumb-item text-muted">All Recruiting Agency</li>
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
                            <input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search Product" />
                        </div>
                        <div id="kt_datatable_example_1_export" class="d-none"></div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="">

                        <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Recruiting Agency Portal</th>
                            <th>Designation</th>
                            <th>Organization</th>
                            <th>Trade License</th>
                            <th>Recruiting License</th>
                            <th>Business Card</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        @foreach($allRecruitingAgency as $key=>$data)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->phone}}</td>
                                <td>
                                    @if($data->recruitingAgencyInfo->recruiting_agency_portal_access==1)
                                        Bangladeshi Recruiting Agency
                                    @elseif($data->recruitingAgencyInfo->recruiting_agency_portal_access==2)
                                        Foreign Recruiting Agency
                                    @endif
                                </td>
                                <td>{{$data->recruitingAgencyInfo->designation}}</td>
                                <td>{{$data->recruitingAgencyInfo->organization->name_en}}</td>
                                <td>
                                    @if($data->recruitingAgencyInfo->trade_license != null)
                                        <div class="file_icon_style">
                                            <i class="fa-solid fa-check"></i>
                                        </div>
                                    @else
                                        <div class="file_icon_style_xmark">
                                            <i class="fa-solid fa-xmark"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if($data->recruitingAgencyInfo->recruiting_license != null)
                                        <div class="file_icon_style">
                                            <i class="fa-solid fa-check"></i>
                                        </div>
                                    @else
                                        <div class="file_icon_style_xmark">
                                            <i class="fa-solid fa-xmark"></i>
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    @if($data->recruitingAgencyInfo->business_card != null)
                                        <div class="file_icon_style">
                                            <i class="fa-solid fa-check"></i>
                                        </div>
                                    @else
                                        <div class="file_icon_style_xmark">
                                            <i class="fa-solid fa-xmark"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if( $data->active_status == 1)
                                        <span class="badge badge-success">Approved</span>
                                    @elseif( $data->active_status == 0)
                                        <span class="badge badge-info">Pending</span>
                                    @else
                                        <span class="badge badge-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    @if( $data->active_status == 0)
                                        <a href="{{route('admin.agency.reject',$data->id)}}" class="btn btn-sm btn-danger" title="reject"><i class="fa fa-thumbs-down"></i></a>
                                        <a href="{{route('admin.agency.approved',$data->id)}}" class="btn btn-sm btn-success" title="approved"><i class="fa fa-thumbs-up"></i></a>
                                    @elseif( $data->active_status == 1)
                                        <a href="{{route('admin.agency.reject',$data->id)}}" class="btn btn-sm btn-danger" title="reject"><i class="fa fa-thumbs-down"></i></a>
                                    @elseif( $data->active_status == 2)
                                        <a href="{{route('admin.agency.approved',$data->id)}}" class="btn btn-sm btn-success" title="approved"><i class="fa fa-thumbs-up"></i></a>
                                    @endif
                                        <a href="{{ Route('admin.recruiting.agency.show', $data->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
