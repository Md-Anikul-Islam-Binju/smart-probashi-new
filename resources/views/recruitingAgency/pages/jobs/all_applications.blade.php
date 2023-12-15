@extends('layouts.recruitingAgency.master')
@section('content')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid">
            <div class="row align-items-center">
                <div class="col-4">
                    <a href="#" class="btn btn-primary">
                        <i class="ki-duotone ki-left"></i>Back</a>
                </div>
                <div class="col-4 text-center">
                    <h1 class="text-dark fw-bold my-1 fs-3">All Applications</h1>
                </div>
                <div class="col-4 text-end">
					<a id="all_applications" href="#" class="btn btn-secondary font-weight-normal mr-2 export_btn">
						<i class="la la-file-excel"></i> Exports </a>
				</div>
            </div>
        </div>
    </div>

	<div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card card-custom">
				<div class="card-body">
					<div class="post-search-panel">
						<div class="row mb-4">
							<div class="col-12 col-xxl-7 col-md-6 mb-md-0 mb-8">
								<div class="filter">
									<span>Filter by</span>
								</div>
								<div class="dropdown custom_filter">
									<a href="#" class="btn btn-outline-secondary filter_button dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Filter by <i class="fas fa-align-center icon-xs text-end color_117D7C"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-lg custom-filter" >
										<form class="px-8 py-8" >
											<div class="form-group">
												<label class="d-block" for="kt_select2_2">
													<strong>Job Type</strong>
												</label>
                                                <select id="job_type" name="job_type" class="form-control">
                                                    <option value="">All job type</option>
                                                    <option value="attested">Attested Job</option>
                                                    <option value="skill_search">Skill Search</option>
                                                </select>
											</div>
											<div class="form-group">
												<label class="d-block" for="kt_select2_1">
													<strong>Jobs</strong>
												</label>
                                                <input name="employee_name" id="employee_name" class="form-control">
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="d-block" for="kt_select2_3">
															<strong>Status</strong>
														</label>
                                                        <select id="status" name="status" class="form-control">
                                                            <option value="">All Status</option>
                                                            <option value="1">Shortlisted</option>
                                                            <option value="2">Selected</option>
                                                            <option value="3">Rejected</option>
                                                        </select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group ">
														<label class="d-block" for="kt_select2_3">
															<strong>BMET Registration Status</strong>
														</label>
														<select id="" name="" class="form-control">
															<option value="">Select Status</option>
															<option value="Yes">Yes</option>
															<option value="No">No</option>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="d-block" for="kt_select2_3">
															<strong>Gender</strong>
														</label>
                                                        <select id="gender" name="gender" class="form-control">
                                                            <option value="">Select Gender</option>
                                                            <option value="1">Male</option>
                                                            <option value="2">Female</option>
                                                        </select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="d-block" for="kt_select2_3">
															<strong>Passport Status</strong>
														</label>
														<select id="sortby_passport" name="sortby_passport" class="form-control">
															<option value="">Select Status</option>
															<option value="Yes">Yes</option>
															<option value="No">No</option>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group ">
														<label class="d-block" for="kt_select2_3">
															<strong>Min age</strong>
														</label>
														<input type="text" id="min_age" name="min_age" class="form-control" placeholder="Min age">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="d-block" for="kt_select2_3">
															<strong>Max age</strong>
														</label>
														<input type="text" id="max_age" name="max_age" class="form-control" placeholder="Max age">
													</div>
												</div>
											</div>
{{--											<div class="form-group">--}}
{{--												<label class="d-block" for="kt_select2_3">--}}
{{--													<strong>Pages</strong>--}}
{{--												</label>--}}
{{--												<select id="row_selection_choice" name="row_selection_choice" class="form-control">--}}
{{--													<option value="apply_only_this_page">Apply only this page</option>--}}
{{--													<option value="all_across_all_pages">All Across all pages</option>--}}
{{--												</select>--}}
{{--											</div>--}}
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="d-block" for="kt_select2_3">
															<strong>Work Experience</strong>
														</label>
                                                        <select name="skill_type" id="skill_type" class="form-control">
                                                            <option value="">Select All</option>
                                                            <option value="skilled">Skilled</option>
                                                            <option value="professional">Professional</option>
                                                        </select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="d-block" for="kt_select2_3">
															<strong>Country Experience</strong>
														</label>
														<select name="worked_country_before" id="worked_country_before" class="form-control">
															<option value="">Select All</option>
															<option value="Yes">Yes</option>
															<option value="No">No</option>
														</select>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group ">
														<label class="d-block" for="kt_select2_3">
															<strong>Document</strong>
														</label>
														<div class="row ml-1">
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="0" name="request_documents">
																<label class="form-check-label"> Passport </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="1" name="request_documents">
																<label class="form-check-label"> Visa </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="2" name="request_documents">
																<label class="form-check-label"> Vaccine Certificate </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="3" name="request_documents">
																<label class="form-check-label"> Job Permit </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="4" name="request_documents">
																<label class="form-check-label"> Insurance </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="5" name="request_documents">
																<label class="form-check-label"> NID </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="6" name="request_documents">
																<label class="form-check-label"> Experience Certificate </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="7" name="request_documents">
																<label class="form-check-label"> Training Certificate </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="8" name="request_documents">
																<label class="form-check-label"> Other </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="9" name="request_documents">
																<label class="form-check-label"> Profile Picture </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="10" name="request_documents">
																<label class="form-check-label"> BMET Card </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="11" name="request_documents">
																<label class="form-check-label"> PDO Certificate </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="12" name="request_documents">
																<label class="form-check-label"> PDO Enrollment Card </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="13" name="request_documents">
																<label class="form-check-label"> BMET Clearance Card </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="14" name="request_documents">
																<label class="form-check-label"> returnee_document </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="15" name="request_documents">
																<label class="form-check-label"> Bank Document </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="16" name="request_documents">
																<label class="form-check-label"> Work Permit </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="17" name="request_documents">
																<label class="form-check-label"> NOC </label>
															</div>
															<div class="form-check col-md-4">
																<input class="form-check-input rd_checkbox" type="checkbox" value="18" name="request_documents">
																<label class="form-check-label"> Medical Certificate </label>
															</div>
														</div>
													</div>
												</div>
											</div>
											<button type="submit" class="btn btn-primary btn-block" id="filter_submit">Submit</button>
										</form>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-xxl-5">
								<div class="mt-6">
									<button type="button" id="shortlistApplications" disabled="disabled" class="btn buttons btn-sm mr-1 shortlist_btn">Shortlist</button>
									<button type="button" id="selectApplications" disabled="disabled" class="btn  buttons btn-sm mr-1 select_btn">Select</button>
									<button type="button" id="rejectApplications" disabled="disabled" class="btn  buttons btn-sm mr-1 reject_btn">Reject</button>
									<button type="button" id="sendMessages" disabled="disabled" data-toggle="modal" data-target="#send_message_all" class="btn buttons btn-sm mr-1 msg_btn">Message</button>
								</div>
							</div>
						</div>
					</div>
					<div class="allapp_summery p-2 my-3 shadow" id="job_info">
						@if($jobs!=null)
                        <div class="row">
							<div class="col-md-4 border-right">
								<div class="allappitem py-8 pl-2">
									<div class="row">
										<div class="col-xxl-2">
											<img src="https://moewoe.amiprobashi.com/public/img/cleaner.png" alt="">
										</div>
										<div class="col-xxl-10">
											<h6 id="employer_name">
												<strong>{{ $jobs->employee_name }}</strong>
											</h6>
											<p class="mb-0" id="job_title_info">
												<strong>{{ $jobs->jobCategory->job_category_name }}(Attested), {{ $jobs->country->country_name }}</strong>
											</p>
											<p>
												<b>No of the post: </b>
												<span id="no_of_post_info">{{$jobs->no_of_post}}</span>
											</p>

										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 border-right d-md-flex align-items-center">
								<div class="allappitem mt-5">
									<ul class="list-unstyled">

										<li>
											<b>Skill Type: </b>
											<span id="skill_info">{{ ucfirst(strtolower($jobs->sector)) }}</span>
										</li>
										<li>
											<b>Gender Type: </b>
                                            @if($jobs->gender==1)
                                                Male
                                            @elseif($jobs->gender==2)
                                                Female
                                            @else
                                                Both
                                            @endif
										</li>
										<li>
											<b>Age range: </b>
											<span id="age_info">{{$jobs->min_age}} - {{$jobs->max_age}}</span>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-md-3 border-right d-md-flex align-items-center">
								<div class="allappitem mt-5">
									<ul class="list-unstyled">
										<li>
											<b>Salary and Benefits </b>
										</li>
										<li>
											<b>Salary: </b>
											<span id="salary_info">{{$jobs->salary_amount}} /{{$jobs->salary_per}} </span>
										</li>
										<li>
											<b>Contract tenure (in years): </b>
											<span id="tenor_info">{{$jobs->contract_tenure}}</span>
										</li>
										<li>
											<b>Deadline: </b>
											<span id="deadline_info">{{ \Carbon\Carbon::parse($jobs->application_deadline)->format('d F Y') }}</span>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-md-3 d-md-flex align-items-center">
								<div class="allappitem mt-5">
									<ul class="list-unstyled">
										<li>
											<b>Date of Posting: </b>
											<span id="posting_date_info">01 Oct 2023</span>
										</li>
										<li>
											<b>Applicants: </b>
											<span id="total_application_info">{{$jobs->attached_jobs_count}}</span>
										</li>
										<li>
											<b>Short Listed: </b>
											<span id="shortlis_application_info">{{$jobs->attached_jobs_count -  ($jobs->no_of_post - $jobs->no_of_post_already_finished)}}</span>
										</li>
										<li>
											<b>Selected: </b>
											<span id="select_application_info">{{$jobs->no_of_post - $jobs->no_of_post_already_finished}}</span>
										</li>
										<li>
											<b>Remaining: </b>
											<span id="remaining_application_info">{{$jobs->no_of_post_already_finished}}</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
                            @endif



					</div>
					<div id="dataTableWrapper" style="width:100%" class="dataTableParentHidden">
						<!--begin: Datatable-->
						<div class="table-responsive">
							<div id="job_application_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
								<div class="row">
									<div class="col-sm-12 col-md-6">
										<div class="dataTables_length" id="job_application_length">
											<label>Show <select name="job_application_length" aria-controls="job_application" class="custom-select custom-select-sm form-control form-control-sm">
													<option value="25">25 rows</option>
													<option value="50">50 rows</option>
													<option value="100">100 rows</option>
												</select> entries </label>
										</div>
									</div>
									<div class="col-sm-12 col-md-6">
										<div id="job_application_filter" class="dataTables_filter">
											<label>Search: <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="job_application">
											</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<table class="table training_table table-hover dataTable no-footer dt-checkboxes-select" id="job_application" style="margin-top: 13px !important; width: 1332px;" role="grid" aria-describedby="job_application_info">
											<thead>
												<tr role="row">
													<th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all" rowspan="1" colspan="1" style="width: 14px;" data-col="0">
														<input type="checkbox" autocomplete="off">
													</th>
													<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 175px;">Name</th>
													<th class="text-center sorting_disabled" rowspan="1" colspan="1" style="width: 125px;">Age</th>
													<th class="text-center sorting_disabled" rowspan="1" colspan="1" style="width: 125px;">BMET no</th>
													<th class="text-center sorting_disabled" rowspan="1" colspan="1" style="width: 74px;">Passport no</th>
													<th class="sorting_disabled text-left" rowspan="1" colspan="1" style="width: 177px;">Mobile no</th>
													<th class="text-center sorting_disabled" rowspan="1" colspan="1" style="width: 150px;">Applied at</th>
													<th class="text-center sorting_disabled" rowspan="1" colspan="1" style="width: 198px;">Status</th>
													<th class="text-center sorting_disabled" rowspan="1" colspan="1" style="width: 51px;">Actions</th>
												</tr>
											</thead>
											<tbody>
                                            @if($jobs!=null)
												@foreach($jobs->attachedJobs as $attachedJobData)
                                                  <tr role="row" class="odd">
													<td class=" dt-checkboxes-cell">
														<input type="checkbox" class="dt-checkboxes" autocomplete="off">
													</td>
													<td>{{$attachedJobData->passportInfo->full_name}}</td>
                                                      <td class="text-center">
                                                          @php
                                                              $birthdate = $attachedJobData->passportInfo->dob;
                                                              $birthdate = \Carbon\Carbon::parse($birthdate);
                                                              $age = $birthdate->age;
                                                          @endphp
                                                          {{ $age }} years
                                                      </td>
													<td class=" text-center">No</td>
													<td class=" text-center">{{$attachedJobData->passportInfo->passport_no}}</td>
													<td class=" text-left">{{$attachedJobData->passportInfo->phone}}</td>
													<td class=" text-center">{{ \Carbon\Carbon::parse($attachedJobData->created_at)->format('d F Y') }}</span></td>
													<td class=" text-center">
														<span class="badge allappbtn-purple">
                                                             @if($attachedJobData->status==1)
                                                                  Shortlisted
                                                             @elseif($attachedJobData->status==2)
                                                                  Selected
                                                             @endif
                                                        </span>
													</td>
													<td class="text-center">
														<div class="btn-group dropstart action_button_wrapper">
															<button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
																<i class="fa-solid fa-angles-down"></i>
															</button>
															<ul class="dropdown-menu action_dropdown_menu">
																<li>
																	<a class="dropdown-item" href="{{route('recruiting-agency.bmet.registration.details',$attachedJobData->passportInfo->id)}}"><i class="fa-solid fa-eye"></i> View </a>
																</li>
															</ul>
														</div>
													</td>
												</tr>
                                                @endforeach
                                                @endif
											</tbody>
										</table>
										<div id="job_application_processing" class="dataTables_processing card" style="display: none;">Processing...</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-5">
										<div class="dataTables_info" id="job_application_info" role="status" aria-live="polite">Showing 1 to 1 of 1 entries</div>
									</div>
									<div class="col-sm-12 col-md-7">
										<div class="dataTables_paginate paging_simple_numbers" id="job_application_paginate">
											<ul class="pagination">
												<li class="paginate_button page-item previous disabled" id="job_application_previous">
													<a href="#" aria-controls="job_application" data-dt-idx="0" tabindex="0" class="page-link">
														<i class="ki ki-arrow-back"></i>
													</a>
												</li>
												<li class="paginate_button page-item active">
													<a href="#" aria-controls="job_application" data-dt-idx="1" tabindex="0" class="page-link">1</a>
												</li>
												<li class="paginate_button page-item next disabled" id="job_application_next">
													<a href="#" aria-controls="job_application" data-dt-idx="2" tabindex="0" class="page-link">
														<i class="ki ki-arrow-next"></i>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--end: Datatable-->
					</div>
				</div>
			</div>
        </div>
    </div>

@endsection
