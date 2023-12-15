@extends('layouts.recruitingAgency.master')
@section('content')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
                <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3">Smart Probashi</h1>
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/" class="text-muted text-hover-primary">DASHBOARD</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">New Candidate Registration</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid">
        <div class="container-fluid">
            <form method="post" action="{{route('recruiting-agency.new.candidate.register.info.store')}}" enctype="multipart/form-data">
                @csrf
                <!-- Personal Info -->
                <div class="card mb-2">
                    <div class="card-header border-0 cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Personal Info</h3>
                        </div>
                    </div>
                    <div class="collapse show">
                        <div class="card-body border-top p-9">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Mobile Number<span style="color: red">*</span></label>
                                       <input type="number" name="phone" class="form-control" placeholder="Enter Your Phone Number" required/>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Mother Name<span style="color: red">*</span></label>
                                    <input type="text" name="mothers_name" class="form-control" placeholder="Enter Your Mother Name" required/>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Gender <span style="color: red;">*</span></label>
                                    <select  name="gender" required="required" class="form-select bg-transparent @error('district_id') is-invalid @enderror" >
                                        <option value="">Select Religion</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Passport Number<span style="color: red;">*</span></label>
                                    <input type="text" name="passport_no" id="passport_no" class="form-control" placeholder="Enter Your Passport Number" maxlength="9" required/>

                                    <div id="passport_error" style="color: red;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Full Name<span style="color: red">*</span></label>
                                    <input type="text" name="full_name" class="form-control" placeholder="Enter Your Full Name" required/>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Date of Birth<span style="color: red">*</span></label>
                                    <input type="date" name="dob" class="form-control"/>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Religion <span style="color: red;">*</span></label>
                                    <select  name="religion_id" required="required" class="form-select bg-transparent @error('district_id') is-invalid @enderror" >
                                        <option value="">Select Religion</option>
                                        @foreach($religion as $religionData)
                                            <option value="{{$religionData->id}}">{{$religionData->religion_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Father's Name</label>
                                    <input type="text" name="fathers_name" class="form-control" placeholder="Enter Your Father's Name" required/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Birth District <span style="color: red;">*</span></label>
                                    <select  name="district_id" required="required" class="form-select bg-transparent @error('district_id') is-invalid @enderror" >
                                        <option value="">Select Birth District </option>
                                        @foreach($district as $districtData)
                                            <option value="{{$districtData->id}}">{{$districtData->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">National ID<span style="color: red;">*</span></label>
                                    <input type="text" name="nid_no" class="form-control" placeholder="Enter Your National ID" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="card mb-2">
                    <div class="card-header border-0 cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Contact Information</h3>
                        </div>
                    </div>
                    <div class="collapse show">
                        <div class="card-body border-top p-9">

                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">District <span style="color: red;">*</span></label>
                                    <select  name="permanent_district_id" id="districtSelect" required="required" class="form-select bg-transparent @error('district_id') is-invalid @enderror" >
                                        <option value="">Select District</option>
                                        @foreach($district as $districtData)
                                            <option value="{{$districtData->id}}">{{$districtData->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Upazila/Thana <span style="color: red;">*</span></label>
                                    <select  name="permanent_upazilla_id" required="required" id="upazilaSelect" class="form-select bg-transparent @error('district_id') is-invalid @enderror" >
                                        <option value="">Select Upazila</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Union/Word *</label>
                                    <input type="text" name="permanent_union" class="form-control" placeholder="Enter Your Union/Word" required/>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Area *</label>
                                    <input type="text" name="permanent_village" class="form-control" placeholder="Enter Your Area/">
                                </div>
                            </div><br>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="hideMailingAddress" name="same_as" value="1">
                                        <b class="form-check-label" for="hideMailingAddress" style="color: black">
                                            Mailing address is the same
                                        </b>
                                    </div>
                                </div>
                            </div>
                            <!-- Add an id attribute to the second portion -->
                            <div id="mailingAddressPortion" class="row">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <label class="col-form-label fw-semibold fs-6">Present District <span style="color: red;">*</span></label>
                                        <select  name="mailing_district_id"  id="districtSelectForMailingAddress"  class="form-select bg-transparent @error('district_id') is-invalid @enderror" >
                                            <option value="">Select District</option>
                                            @foreach($district as $districtData)
                                                <option value="{{$districtData->id}}">{{$districtData->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="col-form-label fw-semibold fs-6">Present Upazila/Thana <span style="color: red;">*</span></label>
                                        <select  name="mailing_upazilla_id"  id="upazilaSelectForMailingAddress" class="form-select bg-transparent @error('district_id') is-invalid @enderror" >
                                            <option value="">Select Upazila/Thana</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="col-form-label fw-semibold fs-6">Present Union/Word *</label>
                                        <input type="text" name="mailing_union" class="form-control" placeholder="Enter Your Union/Word"/>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="col-form-label fw-semibold fs-6">Present Area *</label>
                                        <input type="text" name="mailing_village" class="form-control" placeholder="Enter Your Present Area"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Last Educational Information -->
                <div class="card mb-2">
                    <div class="card-header border-0 cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Last Educational Information </h3>
                        </div>
                    </div>
                    <div class="collapse show">
                        <div class="card-body border-top p-9">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Education Level <span style="color: red;">*</span></label>
                                    <select  name="education[level]" required="required" class="form-select bg-transparent" >
                                        <option value="">Select Education Level</option>
                                        @foreach($educationLevel as $educationLevelData)
                                            <option value="{{$educationLevelData->id}}">{{$educationLevelData->education_level_name	}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Subject</label>
                                    <input type="text" name="education[subject]" class="form-control" placeholder="Enter Your Subject" required/>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Board/University <span style="color: red;">*</span></label>
                                    <select  name="education[board]" required="required" class="form-select bg-transparent" >
                                        <option value="">Select Board/University</option>
                                        @foreach($board as $boardData)
                                            <option value="{{$boardData->id}}">{{$boardData->board_name	}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Institute</label>
                                    <input type="text" name="education[institute]" class="form-control" placeholder="Enter Your Institute" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Passing Year <span style="color: red;">*</span></label>
                                    <select  name="education[passing_year]" required="required" class="form-select bg-transparent" >
                                        <option value="">Select Passing Year</option>
                                        @for ($i = 1990; $i <= 2050; $i++)
                                            <option value="{{ $i }}">
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="col-form-label fw-semibold fs-6">Result</label>
                                    <input type="text" name="education[grade]" class="form-control" placeholder="Enter Your Result" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Last Educational Information -->
                <div class="card mb-2">
                    <div class="card-header border-0 cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Language</h3>
                        </div>
                    </div>
                    <div class="collapse show">
                        <div class="card-body border-top p-9">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="col-form-label fw-semibold fs-6"> Language<span style="color: red;">*</span></label>
                                    <select  name="language[lang_name]" required="required" class="form-select bg-transparent" >
                                        <option value="">Select Language</option>
                                        @foreach($language as $languageData)
                                            <option value="{{$languageData->language_name}}">{{$languageData->language_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="col-form-label fw-semibold fs-6"> Oral Skill<span style="color: red;">*</span></label>
                                    <select name="language[oral]" class="form-select bg-transparent" data-hide-search="true">
                                        <option value="Good">Good</option>
                                        <option value="Native">Native</option>
                                        <option value="Workable">Workable</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="col-form-label fw-semibold fs-6"> Writing Skill<span style="color: red;">*</span></label>
                                    <select name="language[writing]" class="form-select bg-transparent" data-hide-search="true">
                                        <option value="Good">Good</option>
                                        <option value="Native">Native</option>
                                        <option value="Workable">Workable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upload your photo -->
                <div class="card mb-2">
                    <div class="card-header border-0 cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Upload your photo</h3>
                        </div>
                    </div>
                    <div class="collapse show">
                        <div class="card-body border-top p-9">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label class="col-form-label fw-semibold fs-6">Upload your passport</label>
                                    <input type="file" name="passport_image" class="form-control"/>
                                </div>
{{--                                <div class="col-12 col-md-6">--}}
{{--                                    <label class="col-form-label fw-semibold fs-6">Upload your photo</label>--}}
{{--                                    <input type="file" name="" class="form-control"/>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Attachment -->
                <div class="card mb-2">
                    <div class="card-header border-0 cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Job Attachment</h3>
                        </div>
                    </div>
                    <div class="collapse show">
                        <div class="card-body border-top p-9">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input hidden="" id="job_assign_user" name="job_id">
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
                                            @foreach($job as $jobsData)
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
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex mt-5 justify-content-end">
                           <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const districtSelect = document.getElementById('districtSelect');
        const upazilaSelect = document.getElementById('upazilaSelect');
        districtSelect.addEventListener('change', () => {
            const districtId = districtSelect.value;
            // Clear upazila dropdown
            upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
            if (districtId !== '') {
                fetch(`/recruiting-agency/get-upazilas/${districtId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(upazila => {
                            const option = document.createElement('option');
                            option.value = upazila.id;
                            option.textContent = upazila.upazila_name_en;
                            upazilaSelect.appendChild(option);
                        });
                    });
            }
        });
    </script>

    {{--for mailing address--}}
    <script>
        const districtSelectForMailingAddress = document.getElementById('districtSelectForMailingAddress');
        const upazilaSelectForMailingAddress = document.getElementById('upazilaSelectForMailingAddress');
        districtSelectForMailingAddress.addEventListener('change', () => {
            const districtId = districtSelectForMailingAddress.value;
            // Clear upazila dropdown
            upazilaSelectForMailingAddress.innerHTML = '<option value="">Select Upazila</option>';
            if (districtId !== '') {
                fetch(`/recruiting-agency/get-upazilas/${districtId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(upazila => {
                            const option = document.createElement('option');
                            option.value = upazila.id;
                            option.textContent = upazila.upazila_name_en;
                            upazilaSelectForMailingAddress.appendChild(option);
                        });
                    });
            }
        });
    </script>
    <script>
        var passportInput = document.getElementById('passport_no');
        var errorDiv = document.getElementById('passport_error');
        passportInput.addEventListener('input', function () {
            var passportNumber = passportInput.value;
            if (passportNumber.length === 9) {
                errorDiv.textContent = '';
            } else {
                errorDiv.textContent = 'Passport number must be 9 characters long.';
            }
        });
    </script>
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
        document.addEventListener("DOMContentLoaded", function() {
            // Get the checkbox and the mailing address portion
            var checkbox = document.getElementById('hideMailingAddress');
            var mailingAddressPortion = document.getElementById('mailingAddressPortion');

            // Hide/show the mailing address portion based on checkbox state
            function toggleMailingAddress() {
                mailingAddressPortion.style.display = checkbox.checked ? 'none' : 'block';
            }

            // Attach an event listener to the checkbox
            checkbox.addEventListener('change', function() {
                toggleMailingAddress();

                // Send a value to the backend when the checkbox is checked
                var valueToSend = checkbox.checked ? 'hidden' : 'visible';
                // You can use AJAX or any other method to send the value to the backend
                console.log('Sending value to backend: ' + valueToSend);
            });

            // Initialize the visibility based on the initial state of the checkbox
            toggleMailingAddress();
        });
    </script>

@endsection
