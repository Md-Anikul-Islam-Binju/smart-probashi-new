@extends('layouts.recruitingAgency.master')
@section('content')

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
                    <li class="breadcrumb-item text-muted">My Databank</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card card-custom">
                <div class="card-body">
                    <div class="post-search-panel">
                        <div class="row mb-4">
                            <div class="col-12 col-md-5 mb-md-0 mb-8">
                                <div class="filter">
                                    <span>Filter by</span>
                                </div>
                                <div class="dropdown custom_filter">
                                    <a href="#" class="btn btn-outline-secondary filter_button dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Filter by <i class="fas fa-align-center icon-xs text-end color_117D7C"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-lg custom-filter" style="width: 100%">
                                        <form  class="px-8 py-8">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="d-block" for="kt_select2_3">
                                                            <strong>BMET Status</strong>
                                                        </label>
                                                        <select id="approve_status" name="approve_status" class="form-control">
                                                            <option value="1">Yes</option>
                                                            <option value="2">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block" id="filter_submit">Filter</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive job_list_table">
                        <div id="posts_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-hover training_table dataTable no-footer dtr-inline" style="margin: 13px 0px !important;" id="kt_datatable" role="grid" aria-describedby="posts_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 135px;">Full Name</th>
                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 63px;">Age</th>
                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 115px;">BMET No</th>
                                            <th class="sorting_disabled text-left" rowspan="1" colspan="1" style="width: 262px;">Passport</th>
                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 225px;">Mobile No</th>
                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 108px;">Source</th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 46px;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($myDataBank as $key=>$myDataBankData)
                                            <tr role="row">
                                                <td tabindex="0" data-kt-ecommerce-product-filter="job_category_name">
                                                    <a href="{{route('recruiting-agency.bmet.registration.details',$myDataBankData->id)}}">
                                                        {{$myDataBankData->full_name}}
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('recruiting-agency.bmet.registration.details',$myDataBankData->id)}}">
                                                        @php
                                                            $dob = \Carbon\Carbon::parse($myDataBankData->dob);
                                                            $currentDate = \Carbon\Carbon::now();
                                                            $age = $dob->diffInYears($currentDate);
                                                        @endphp
                                                        {{ $age }} Years
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('recruiting-agency.bmet.registration.details',$myDataBankData->id)}}">

                                                    </a>
                                                </td>
                                                <td class="text-left">
                                                    <a href="{{route('recruiting-agency.bmet.registration.details',$myDataBankData->id)}}">
                                                        {{$myDataBankData->passport_no}}
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('recruiting-agency.bmet.registration.details',$myDataBankData->id)}}">
                                                        {{$myDataBankData->phone}}
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('recruiting-agency.bmet.registration.details',$myDataBankData->id)}}">
                                                        BMET Registration
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="btn-group dropstart action_button_wrapper">
                                                        <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-angles-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu action_dropdown_menu">
                                                            <li>
                                                                <a class="dropdown-item" href="{{route('recruiting-agency.bmet.registration.details',$myDataBankData->id)}}"><i class="fa-solid fa-eye"></i> View </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" data-bs-toggle="modal" href="#assign_job_modal" role="button" onclick="setPassportId({{ $myDataBankData->id }})">Attached to a Job</a>
                                                            </li>
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

    <div class="modal fade" id="assign_job_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <form action="{{route('recruiting-agency.job.attached')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="modal-title mb-3">Assign Job</h2>
                                <input type="hidden" name="passport_info_id" value="#">
                                <input hidden="" id="job_assign_user" name="job_id">
                                <input type="hidden" name="passport_info_id" id="passport_info_id" value="#">
                                <input id="job_assign" name="job_category_name" required placeholder='Select your data' class='form-control cursor-pointer'>
                                <div id="inputpikkerWrap">
                                    <table class="table small">
                                        <thead>
                                        <tr>
                                            <th>Job</th>
                                            <th>Country</th>
                                            <th>Application Date</th>
                                            <th>Employer Name</th>
                                            <th>Number Of Post</th>
                                            <th>Selected</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($jobs as $jobsData)
                                            <tr class='hover_style_apply'>
                                                <td>{{$jobsData->jobCategory? $jobsData->jobCategory->job_category_name:'N/A'}}</td>
                                                <td>{{$jobsData->country? $jobsData->country->country_name:'N/A'}}</td>
                                                <td>{{ \Carbon\Carbon::parse($jobsData->application_deadline)->format('d F Y') }}</td>
                                                <td>{{$jobsData->employee_name}}</td>
                                                <td>{{$jobsData->no_of_post}}</td>
                                                <td>{{($jobsData->no_of_post)-($jobsData->no_of_post_already_finished)}}</td>
                                                <td hidden="">{{$jobsData->id}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group mb-8">
                                    <div class="form-group gender">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="button">
                                                    <input name="status" value="1" required="required" type="radio" id="sortlist">
                                                    <label for="sortlist" class="btn">Sortlist</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="button">
                                                    <input name="status" value="2" required="required" type="radio" id="selected">
                                                    <label for="selected" class="btn">Selected</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-6">
                            <div class="col-md-12">
                                <div class="modal_btn d-flex justify-content-center">
                                    <button type="button" data-bs-dismiss="modal" class="submit_close me-2">Close</button>
                                    <button type="submit" class="submit_btn">Assign</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const inputBox = document.querySelector('#job_assign');
        const inputBoxUser = document.querySelector('#job_assign_user');
        const popupTable = document.querySelector('#inputpikkerWrap');
        const rows = popupTable.querySelectorAll('tbody tr');
        // Show the popup table when the input field is clicked or has focus
        inputBox.addEventListener('click', () => {
            popupTable.style.display = 'block';
        });
        // Hide the popup table when clicking outside of it
        document.addEventListener('click', (e) => {
            if (e.target !== inputBox && e.target !== popupTable) {
                popupTable.style.display = 'none';
            }
        });
        // Prevent the click event on the popup table from closing it
        popupTable.addEventListener('click', (e) => {
            e.stopPropagation();
        });
        // Add click event listeners to the table rows
        rows.forEach(row => {
            row.addEventListener('click', () => {
                const name = row.cells[0].textContent;
                const title = row.cells[6].textContent;
                inputBox.value = name;
                inputBoxUser.value = title;
                popupTable.style.display = 'none'; // Hide the table after selecting a row
            });
        });
        // Add input event listener for live search
        inputBox.addEventListener('input', () => {
            const searchTerm = inputBox.value.toLowerCase();
            // Create an array to store visible rows
            const visibleRows = [];
            rows.forEach(row => {
                const title = row.cells[0].textContent.toLowerCase();
                if (title.includes(searchTerm)) {
                    row.style.display = ''; // Show the row
                    visibleRows.push(row);
                } else {
                    row.style.display = 'none'; // Hide the row
                }
            });
            // Check if there are visible rows
            if (visibleRows.length === 0) {
                // No matching rows found, display "No data found!" message
                const noDataFoundRow = document.createElement('tr');
                const noDataFoundCell = document.createElement('td');
                noDataFoundCell.textContent = 'No results.';
                noDataFoundCell.colSpan = 6; // Set the colspan to match the number of columns
                noDataFoundRow.appendChild(noDataFoundCell);
                // Remove any existing "No data found!" rows
                const existingNoDataFoundRows = popupTable.querySelectorAll('.no-data-found');
                existingNoDataFoundRows.forEach(existingRow => {
                    existingRow.remove();
                });
                noDataFoundRow.classList.add('no-data-found'); // Add a class to identify the message row
                popupTable.querySelector('tbody').appendChild(noDataFoundRow);
            } else {
                // Remove any existing "No data found!" rows
                const existingNoDataFoundRows = popupTable.querySelectorAll('.no-data-found');
                existingNoDataFoundRows.forEach(existingRow => {
                    existingRow.remove();
                });
            }
            // Handle Enter key for selecting the first row
            inputBox.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' && visibleRows.length > 0) {

                    const firstVisibleRow = visibleRows[0];
                    console.log(firstVisibleRow.cells[0].textContent)
                    const jobHeading = firstVisibleRow.cells[0].textContent;
                    inputBox.value = jobHeading;
                    popupTable.style.display = 'none'; // Hide the table after selecting a row
                }
            });
        });
    </script>
    <script>
        function setPassportId(passportId) {
            document.getElementById('passport_info_id').value = passportId;
        }
    </script>

@endsection




