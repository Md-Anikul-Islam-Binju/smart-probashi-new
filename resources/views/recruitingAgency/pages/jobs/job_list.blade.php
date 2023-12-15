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
                    <li class="breadcrumb-item text-muted">Job</li>
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
										<form action="{{route('recruiting-agency.job.list')}}" method="GET" class="px-8 py-8">
											<div class="form-group">
												<label class="d-block" for="kt_select2_2">
													<strong>Job Type</strong>
												</label>
												<select id="job_type" name="job_type" class="form-control">
                                                    <option value="">All job type</option>
                                                    <option value="attested" @if(request('job_type') == 'attested') selected @endif>Attested Job</option>
                                                    <option value="skill_search" @if(request('job_type') == 'skill_search') selected @endif>Skill Search</option>
												</select>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group ">
														<label class="d-block" for="kt_select2_3">
															<strong>Job Category</strong>
														</label>
														<select id="job_category" name="job_category" class="form-control">
                                                            <option value="">All job categories</option>
                                                            @foreach($jobCategories as $category)
                                                                <option value="{{ $category->id }}" @if(request('job_category') == $category->id) selected @endif>{{ $category->job_category_name }}</option>
                                                            @endforeach
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="d-block" for="kt_select2_3">
															<strong>Country</strong>
														</label>
														<select id="country" name="country" class="form-control">
                                                            <option value="">All Country</option>
                                                            @foreach($country as $countryData)
                                                                <option value="{{ $countryData->id }}" @if(request('country') == $countryData->id) selected @endif>{{ $countryData->country_name }}</option>
                                                            @endforeach
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="d-block" for="kt_select2_3">
															<strong>Approve Status</strong>
														</label>
														<select id="approve_status" name="approve_status" class="form-control">
															<option value="">All</option>
															<option value="0">Pending</option>
                                                            <option value="1">Publish</option>
															<option value="3">Approved</option>
														</select>
													</div>
												</div>
											</div>
											<button type="submit" class="btn btn-primary btn-block" id="filter_submit">Filter</button>
										</form>
									</div>
								</div>
							</div>
							<div class="col-md-7 mt-5">
								<div class="btn">
									<a class="btn_post_job" href="{{route('recruiting-agency.job.create')}}">Post a Job</a>
									<a class="btn_post_job" href="{{route('recruiting-agency.skill.job.create')}}">Post a Skill Search</a>
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
												<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 135px;">Job title</th>
												<th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 63px;">No of post</th>
												<th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 115px;">Salary</th>
												<th class="sorting_disabled text-left" rowspan="1" colspan="1" style="width: 262px;">Employer &amp; Job location</th>
												<th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 225px;">Foreign Ref. No.</th>
												<th class="sorting_disabled text-center" rowspan="1" colspan="1" style="width: 108px;">Application date</th>
												<th class="text-center sorting_disabled" rowspan="1" colspan="1" style="width: 65px;">Status</th>
												<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 90px;">Job Type</th>
												<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 46px;">Action</th>
											</tr>
										</thead>


                                        <tbody>
											@foreach($jobs as $key=>$jobsData)

                                               <tr role="row">

                                                       <td tabindex="0" data-kt-ecommerce-product-filter="job_category_name">
                                                           <a href="{{route('recruiting-agency.job.show',$jobsData->id)}}">
                                                               {{$jobsData->jobCategory? $jobsData->jobCategory->job_category_name:'N/A'}}
                                                           </a>
                                                       </td>


                                                   <td class="text-center">
                                                       <a href="{{route('recruiting-agency.job.show',$jobsData->id)}}">
                                                          {{$jobsData->no_of_post}}
                                                       </a>
                                                   </td>
                                                   <td class="text-center">
                                                       <a href="{{route('recruiting-agency.job.show',$jobsData->id)}}">
                                                           @if($jobsData->job_type == 'attested')
                                                               {{$jobsData->salary_amount}} / Hour
                                                           @else
                                                                  N/A
                                                           @endif
                                                       </a>
                                                   </td>
                                                   <td class="text-left">
                                                       <a href="{{route('recruiting-agency.job.show',$jobsData->id)}}">
                                                           {{$jobsData->country? $jobsData->country->country_name:'N/A'}}
                                                       </a>
                                                   </td>
                                                   <td class="text-center">
                                                       <a href="{{route('recruiting-agency.job.show',$jobsData->id)}}">
                                                           @if($jobsData->job_type == 'attested')
                                                               {{$jobsData->foreign_reference_no}}
                                                           @else
                                                               N/A
                                                           @endif
                                                       </a>
                                                   </td>
                                                   <td class="text-center">{{ \Carbon\Carbon::parse($jobsData->created_at)->format('d F Y') }}</td>
                                                   <td class="text-center">
                                                       @if($jobsData->status == 0)
                                                           <div class="badge badge-light-danger">Pending</div><br>
                                                           <div class="badge badge-light-danger">Unpublished</div>
                                                       @elseif($jobsData->status == 1 || $jobsData->status == 2)
                                                           <div class="badge badge-light-danger">Pending</div><br>
                                                           <div class="badge badge-light-success">Published</div>
                                                       @elseif($jobsData->status == 3)
                                                           <div class="badge badge-light-success">Approved</div>
                                                       @endif
                                                   </td>
                                                   <td>
                                                       <a href="{{route('recruiting-agency.job.show',$jobsData->id)}}">
                                                           @if($jobsData->job_type == 'attested')
                                                               Attested Job
                                                           @else
                                                               Skill Search
                                                           @endif
                                                       </a>
                                                   </td>
                                                   <td>
                                                       <div class="btn-group dropstart action_button_wrapper">
                                                           <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                               <i class="fa-solid fa-angles-down"></i>
                                                           </button>
                                                           <ul class="dropdown-menu action_dropdown_menu">
                                                               @if($jobsData->status == 0)
                                                                   <li>
                                                                       <a class="dropdown-item" href="{{route('recruiting-agency.job.edit',$jobsData->id)}}"><i class="fa-solid fa-eye"></i> Edit </a>
                                                                   </li>
                                                               @endif
                                                               <li>
                                                                   <a class="dropdown-item" href="{{route('recruiting-agency.job.show',$jobsData->id)}}"><i class="fa-solid fa-eye"></i> View </a>
                                                               </li>

                                                               @if($jobsData->status == 0)
                                                                   <li>
                                                                       <a class="dropdown-item" href="{{route('recruiting-agency.job.published',$jobsData->id)}}"><i class="fa-solid fa-thumbs-up"></i>Published</a>
                                                                   </li>
                                                               @elseif($jobsData->status == 1 || $jobsData->status == 2)
                                                                   <li>
                                                                       <a class="dropdown-item" href="{{route('recruiting-agency.job.unpublished',$jobsData->id)}}"><i class="fa-solid fa-thumbs-down"></i>Unpublished</a>
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




