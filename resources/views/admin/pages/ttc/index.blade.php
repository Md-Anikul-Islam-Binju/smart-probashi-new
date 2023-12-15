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
                    <li class="breadcrumb-item text-muted">TTC Registration</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card card-flush">
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="">
                        <form action="{{route('admin.ttc')}}" method="GET" >
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label class="d-block" for="job_category">
                                            <strong>TTC</strong>
                                        </label>
                                        <select id="ttc_name" name="ttc_name" class="form-control">
                                            <option value="">All TTC</option>
                                            @foreach($ttcUsers as $ttcData)
                                                <option value="{{ $ttcData->trainingCenterByUser?$ttcData->trainingCenterByUser->id:'' }}" @if(request('ttc_name') == $ttcData->trainingCenterByUser?$ttcData->trainingCenterByUser->id:'') selected @endif>{{ $ttcData->trainingCenterByUser ? $ttcData->trainingCenterByUser->name:''}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 mt-3">
                                    <button type="submit" class="btn btn-primary" id="filter_submit">Filter</button>
                                </div>
                            </div>
                        </form>
                        <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>User Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        @foreach($ttc_users as $key=>$data)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->phone}}</td>
                                <td>{{$data->username}}</td>
                                <td>
                                    @if($data->status==1)
                                        <div class="badge badge-light-success">Active</div>
                                    @else
                                        <div class="badge badge-light-danger">Inactive</div>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalFormDataEdit{{$data->id}}">Edit</button>
                                    <a href="{{route('admin.ttc.delete',$data->id)}}" class="btn btn-danger btn-sm delete-division" data-bs-toggle="modal" data-bs-target="#deleteModal{{$data->id}}" data-category-id="{{$data->id}}">Delete</a>
                                </td>
                            </tr>

                            <!-- Edit Modal for TTC -->
                            <div class="modal fade" id="modalFormDataEdit{{$data->id}}" aria-labelledby="editModalLabel{{$data->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered mw-1000px">
                                    <div class="modal-content rounded">
                                        <div class="modal-header pb-0 border-0 justify-content-end">
                                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                <i class="ki-outline ki-cross fs-1"></i>
                                            </div>
                                        </div>
                                        <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                            <form action="{{route('admin.bmet.update', $data->id)}}" method="post" class="form">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-13 text-center">
                                                    <h1 id="editModalLabel{{$data->id}}" class="mb-3">Edit TTC Registration</h1>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="name">Name <span style="color: red;">*</span></label>
                                                        <input type="text" placeholder="Enter your name" name="name" value="{{$data->name}}" required class="form-control bg-transparent" />
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="email">Email <span style="color: red;">*</span></label>
                                                        <input type="email" placeholder="Enter your email" name="email" value="{{$data->email}}" required  class="form-control bg-transparent" />
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="phone">Phone <span style="color: red;">*</span></label>
                                                        <input class="form-control bg-transparent" name="phone" value="{{$data->phone}}" required placeholder="Enter Your phone"/>
                                                    </div>

                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-6 required">Status</label>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check me-5">
                                                                <input class="form-check-input" type="radio" value="1" id="Published" name="status"
                                                                 @if($data->status === 1) checked @endif>
                                                                <label class="form-check-label" for="Published">
                                                                    Active
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-custom form-check-danger form-check-solid">
                                                                <input class="form-check-input" type="radio" value="0" id="Unpublished" name="status"
                                                                @if($data->status === 0) checked @endif>
                                                                <label class="form-check-label" for="Unpublished">
                                                                    Inactive
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-10">
                                                    <div class="col-12 d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TTC Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteModal{{$data->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$data->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{$data->id}}">Delete TTC</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this TTC?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <a href="{{ route('admin.ttc.delete', $data->id) }}" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--TTC Add Modal--}}
    <div class="modal fade" id="modalFormDataSave" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-1000px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <div class="card mt-5">
                        <div class="card-body">
                            <div class="stepper stepper-links d-flex flex-column">
                                <div class="mx-auto w-100">
                                    <div class="current">
                                        <div class="w-100">
                                            <form action="{{route('admin.ttc.store')}}" method="post" class="form" id="create-form" enctype="multipart/form-data">
                                                @csrf

                                                <div class="mb-13 text-center">
                                                    <h1 class="mb-3">Add TTC Registration</h1>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="name">Name <span style="color: red;">*</span></label>
                                                        <input type="text" placeholder="Enter your name" name="name" required autocomplete="off" class="form-control bg-transparent" />
                                                        <span class="text-danger" id="name_error">{{ $errors->first('name') }}</span>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="email">Email <span style="color: red;">*</span></label>
                                                        <input type="email" placeholder="Enter your email" name="email" required autocomplete="off" class="form-control bg-transparent" />
                                                        <span class="text-danger" id="email_error">{{ $errors->first('email') }}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="phone">Phone <span style="color: red;">*</span></label>
                                                        <input class="form-control bg-transparent" name="phone" required placeholder="Enter Your phone"/>
                                                        <span class="text-danger" id="phone_error">{{ $errors->first('phone') }}</span>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="division_id">Division</label>
                                                        <select onchange="getDistricts(this.value)" name="division_id" id="division" data-control="select2" class="form-select bg-transparent" data-hide-search="true">
                                                            <option value="">Select Division</option>
                                                            @foreach($divisions as $division)
                                                                <option value="{{ $division->id }}">{{ $division->division_name_en }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <div id="districtContainer">
                                                            <label for="district_id">District</label>
                                                            <select  name="district_id" onchange="getUpazilas(this.value)" id="district" data-control="select2" class="form-select bg-transparent" data-hide-search="true">
                                                                <option value="">Select District</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <div id="upazilaContainer">
                                                            <label for="upazilla_id">Upazilla</label>
                                                            <select name="upazilla_id"  id="upazila" data-control="select2" class="form-select bg-transparent" data-hide-search="true">
                                                                <option value="">Select Upazilla</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 mb-4">
                                                        <label for="training_address">Training Address</label>
                                                        <input type="text" name="training_address" autocomplete="off" class="form-control bg-transparent" placeholder="Enter your training address" />
                                                    </div>
                                                </div>
                                                <div class="row mt-10">
                                                    <div class="col-12 d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    function getDistricts(divisionId) {
        if (divisionId) {
            document.getElementById('districtContainer').style.display = 'block';
            fetch(`/admin/get-districts/${divisionId}`)
                .then(response => response.json())
                .then(data => {
                    const districtSelect = document.getElementById('district');
                    districtSelect.innerHTML = '<option value="">Select District</option>';
                    data.forEach(district => {
                        districtSelect.innerHTML += `<option value="${district.id}">${district.district_name_en}</option>`;
                    });
                    document.getElementById('upazilaContainer').style.display = 'none';
                });
        } else {
            document.getElementById('districtContainer').style.display = 'none';
            document.getElementById('upazilaContainer').style.display = 'none';
        }
    }

    function getUpazilas(districtId) {
        if (districtId) {
            document.getElementById('upazilaContainer').style.display = 'block';
            fetch(`/admin/get-upazillas/${districtId}`)
                .then(response => response.json())
                .then(data => {
                    const upazilaSelect = document.getElementById('upazila');
                    upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
                    data.forEach(upazila => {
                        upazilaSelect.innerHTML += `<option value="${upazila.id}">${upazila.upazila_name_en}</option>`;
                    });
                });
        } else {
            document.getElementById('upazilaContainer').style.display = 'none';
        }
    }
</script>

@endsection
