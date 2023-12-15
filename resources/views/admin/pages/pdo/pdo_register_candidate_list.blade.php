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
                    <li class="breadcrumb-item text-muted">PDO Candidate List</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card card-flush">
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="">
                        <form action="{{route('admin.pdo.register.candidate.list')}}" method="GET" >
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label class="d-block" for="job_category">
                                            <strong>TTC</strong>
                                        </label>
                                        <select id="ttc" name="ttc" class="form-control">
                                            <option value="">All TTC</option>
                                            @foreach($ttcUsers as $ttcData)
                                                <option value="{{ $ttcData->id }}" @if(request('ttc') == $ttcData->id) selected @endif>{{ $ttcData->trainingCenterByUser ? $ttcData->trainingCenterByUser->name:''}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label class="d-block" for="start_date">
                                            <strong>Start Date</strong>
                                            <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}" pattern="\d{4}-\d{2}-\d{2}">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label class="d-block" for="end_date">
                                            <strong>End Date</strong>
                                            <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}" pattern="\d{4}-\d{2}-\d{2}">
                                        </label>
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
                            <th>Agency Information</th>
                            <th>Name</th>
                            <th>Passport Number</th>
                            <th>TTC</th>
                            <th>Batch Number</th>
                            <th>Date Range</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        @foreach($pdo_candidates as $key=>$data)
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
                                <td>{{$data->passport_no}}</td>

                                <td>
                                    {{$data->trainingCenter ? $data->trainingCenter->trainingCenterByUser->name:''}}
                                </td>
                                <td>{{$data->trainingSchedule ? $data->trainingSchedule->batch_no:''}}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($data->trainingSchedule?$data->trainingSchedule->training_start_date:'')->format('d-M-Y') }}
                                    to
                                    {{ \Carbon\Carbon::parse($data->trainingSchedule?$data->trainingSchedule->training_end_date:'')->format('d-M-Y') }}
                                </td>
                                <td>
                                    @if($data->payment_status == 1)
                                        <div>Paid</div>
                                    @else
                                        <div>Pending</div>
                                    @endif
                                </td>
                                <td class="mt-2">
                                    <a href="{{route('admin.pdo.register.candidate.details',$data->id)}}" class="btn btn-sm btn-primary">View</a>
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
