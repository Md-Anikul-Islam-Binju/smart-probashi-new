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
                    <li class="breadcrumb-item text-muted">TTC Schedule Create</li>
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
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalFormDataSave" class="btn btn-primary">Create New Schedule</a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="">

                        <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th>S/N</th>
                            <th>Technical Training Center Name</th>
                            <th>Batch Number</th>
                            <th>Date Range</th>
                            <th>Class Time</th>
                            <th>PDO Type</th>
                            <th>Number Of Seats</th>
                            <th>Room No</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        @foreach($ttcSchedules as $key=>$data)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$data->trainingCenter->trainingCenterByUser->name}}</td>
                                <td>{{$data->batch_no}}</td>
                                <td>{{ date('Y-m-d', strtotime($data->training_start_date)) }} to {{ date('Y-m-d', strtotime($data->training_end_date)) }}</td>
                                <td>{{ date('h:i A', strtotime($data->training_start_time)) }} to {{ date('h:i A', strtotime($data->training_end_time)) }}</td>
                                <td>
                                    @if($data->pdo_type == 1)
                                        <div>General Category</div>
                                    @elseif($data->pdo_type == 2)
                                        <div>VIP Category</div>
                                    @else
                                        <div>Others Category</div>
                                    @endif
                                </td>
                                <td>{{$data->number_of_seats}}</td>
                                <td>{{$data->room_no}}</td>
                                <td>
                                    @if($data->status==1)
                                        <div class="badge badge-light-success">Active</div>
                                    @else
                                        <div class="badge badge-light-danger">Inactive</div>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalFormDataEdit{{$data->id}}">Edit</button>
{{--
                                    <a href="{{route('admin.ttc.delete',$data->id)}}" class="btn btn-danger btn-sm delete-division" data-bs-toggle="modal" data-bs-target="#deleteModal{{$data->id}}" data-category-id="{{$data->id}}">Delete</a>
--}}
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
                                            <form action="{{route('admin.ttc.schedule.update', $data->id)}}" method="post" class="form">
                                                @csrf
                                                @method('PUT')


                                                <div class="mb-13 text-center">
                                                    <h1 id="editModalLabel{{$data->id}}" class="mb-3">Update TTC Schedule</h1>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 col-md-12 mb-12">
                                                        <label for="training_id">TTC<span style="color: red;">*</span></label>
                                                        <select name="training_id" id="training_id" data-control="select2" class="form-select bg-transparent" data-hide-search="true">
                                                            <option selected value="{{ $data->trainingCenter->id }}">{{ $data->trainingCenter->trainingCenterByUser->name }}</option>
                                                            @foreach($ttc as $ttcData)
                                                                <option value="{{ $ttcData->id }}">{{ $ttcData->trainingCenterByUser->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="training_start_date">Training Start Date <span style="color: red;">*</span></label>
                                                        <input type="date" name="training_start_date"  value="{{ old('training_start_date', $data->training_start_date) }}" required autocomplete="off" class="form-control bg-transparent" />
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="training_end_date">Training End Date <span style="color: red;">*</span></label>
                                                        <input type="date" name="training_end_date" value="{{ old('training_end_date', $data->training_end_date) }}" required autocomplete="off" class="form-control bg-transparent" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="training_start_time">Training Start Time <span style="color: red;">*</span></label>
                                                        <input type="time" name="training_start_time" value="{{ old('training_start_time', $data->training_start_time) }}" required autocomplete="off" class="form-control bg-transparent" />
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="training_end_time">Training End Time <span style="color: red;">*</span></label>
                                                        <input type="time" name="training_end_time" value="{{ old('training_end_time', $data->training_end_time) }}" required autocomplete="off" class="form-control bg-transparent" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="pdo_type">PDO Type <span style="color: red;">*</span></label>
                                                        <select id="pdo_type" name="pdo_type" required data-control="select2" class="form-select bg-transparent" data-hide-search="true">
                                                            <option value="" disabled>Select TTC</option>
                                                            <option value="1" {{ $data['pdo_type'] == 1 ? 'selected' : '' }}>General Category</option>
                                                            <option value="2" {{ $data['pdo_type'] == 2 ? 'selected' : '' }}>VIP Category</option>
                                                            <option value="3" {{ $data['pdo_type'] == 3 ? 'selected' : '' }}>Others Category</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="number_of_seats">Number Of Seats <span style="color: red;">*</span></label>
                                                        <input type="number" min="1" name="number_of_seats" value="{{ old('number_of_seats', $data->number_of_seats) }}" required autocomplete="off" class="form-control bg-transparent" />
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="training_fees">Training Fees <span style="color: red;">*</span></label>
                                                        <input type="text" min="1" name="training_fees" placeholder="Enter your training fees(00.00)" value="{{ old('training_fees', $data->training_fees) }}" required autocomplete="off" class="form-control bg-transparent" />
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="training_fees">Room No <span style="color: red;">*</span></label>
                                                        <input type="text" name="room_no" placeholder="Enter room no" value="{{ old('room_no', $data->room_no) }}" required autocomplete="off" class="form-control bg-transparent" />
                                                    </div>
                                                </div>
                                                <div class="row">
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

                           {{-- <!-- TTC Delete Confirmation Modal -->
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
--}}
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


  <!-- TTC Schedule create Modal -->
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
                                            <form action="{{route('admin.ttc.schedule.store')}}" method="post" class="form" id="create-form" enctype="multipart/form-data">
                                                @csrf

                                                <div class="mb-14 text-center">
                                                    <h1 class="mb-3">TTC Schedule Create</h1>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-12 mb-12">
                                                        <label for="user_id">TTC<span style="color: red;">*</span></label>
                                                        <select name="training_id" id="training_id" data-control="select2" class="form-select bg-transparent" data-hide-search="true">
                                                            <option value="">Select TTC</option>
                                                            @foreach($ttc as $ttcData)
                                                                <option value="{{ $ttcData->id }}">{{ $ttcData->trainingCenterByUser->name }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="training_start_date">Training Start Date <span style="color: red;">*</span></label>
                                                        <input type="date" name="training_start_date" required autocomplete="off" class="form-control bg-transparent" />
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="training_end_date">Training End Date <span style="color: red;">*</span></label>
                                                        <input type="date" name="training_end_date" required autocomplete="off" class="form-control bg-transparent" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="training_start_time">Training Start Time <span style="color: red;">*</span></label>
                                                        <input type="time" name="training_start_time" required autocomplete="off" class="form-control bg-transparent" />
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="training_end_time">Training End Time <span style="color: red;">*</span></label>
                                                        <input type="time" name="training_end_time" required autocomplete="off" class="form-control bg-transparent" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="pdo_type">PDO Type <span style="color: red;">*</span></label>
                                                        <select id="pdo_type" name="pdo_type" required data-control="select2" class="form-select bg-transparent" data-hide-search="true">
                                                            <option disabled>Select TTC</option>
                                                            <option value="1">General Category</option>
                                                            <option value="2">VIP Category</option>
                                                            <option value="3">Others Category</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="number_of_seats">Number Of Seats <span style="color: red;">*</span></label>
                                                        <input type="number" min="1" name="number_of_seats" required autocomplete="off" class="form-control bg-transparent" />
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="training_fees">Training Fees <span style="color: red;">*</span></label>
                                                        <input type="text" min="1" name="training_fees" placeholder="Enter training fees(00.00) " required autocomplete="off" class="form-control bg-transparent" />
                                                    </div>

                                                    <div class="col-12 col-md-6 mb-4">
                                                        <label for="training_fees">Room No <span style="color: red;">*</span></label>
                                                        <input type="text" min="1" name="room_no" placeholder="Enter room no " required autocomplete="off" class="form-control bg-transparent" />
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

@endsection
