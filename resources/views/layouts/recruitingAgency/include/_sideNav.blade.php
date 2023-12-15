<!--begin::Brand-->
<div class="aside-logo flex-column-auto" id="kt_aside_logo">
    <a href="{{ route('recruiting-agency.dashboard') }}">
        <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}" class="h-60px logo" />
    </a>
    <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle me-n2" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
        <i class="ki-outline ki-double-left fs-1 rotate-180"></i>
    </div>
</div>
<div class="aside-menu flex-column-fluid">
    <div class="hover-scroll-overlay-y my-2 py-2" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
            <div class="menu-item">
                <a class="menu-link" href="{{ route('recruiting-agency.dashboard') }}">
									<span class="menu-icon">
										<i class="ki-outline ki-element-11 fs-2"></i>
									</span>
                    <span class="menu-title">Dashboards</span>
                </a>
            </div>


            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
								<span class="menu-link">
									<span class="menu-icon">
										<i class="ki-outline ki-check fs-2hx"></i>
									</span>
									<span class="menu-title">BMET  Clearance</span>
									<span class="menu-arrow"></span>
								</span>

                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('recruiting-agency.bmet.clearance.new.application')}}">
											<span class="menu-icon">
												<i class="ki-outline ki-check fs-2"></i>
											</span>
                            <span class="menu-title">New Applications</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('recruiting-agency.ongoing.application')}}">
											<span class="menu-icon">
												<i class="ki-outline ki-check fs-2"></i>
											</span>
                            <span class="menu-title">Ongoing Applications</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('recruiting-agency.quota.remaining')}}">
											<span class="menu-icon">
												<i class="ki-outline ki-check fs-2"></i>
											</span>
                            <span class="menu-title">Quota Remaining</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('recruiting-agency.download.applications')}}">
											<span class="menu-icon">
												<i class="ki-outline ki-check fs-2"></i>
											</span>
                            <span class="menu-title">Download BMET Clearance</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('recruiting-agency.application.history')}}">
											<span class="menu-icon">
												<i class="ki-outline ki-check fs-2"></i>
											</span>
                            <span class="menu-title">Application History</span>
                        </a>
                    </div>
                </div>
            </div>


            <!-- BMET Registration -->
            <div class="menu-item">
                <a class="menu-link" href="{{route('recruiting-agency.bmet.candidate.registration.list')}}">

									<span class="menu-icon">
										<i class="ki-outline ki-element-plus fs-2"></i>
									</span>
                    <span class="menu-title">BMET Registration</span>
                </a>
            </div>


            <!-- PDO -->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
									<span class="menu-icon">
                                        <i class="fa-solid fa-layer-group fs-2"></i>
									</span>
									<span class="menu-title">PDO</span>
									<span class="menu-arrow"></span>
								</span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('recruiting-agency.pdo.candidate.registration.list')}}">
											<span class="menu-icon">
												<i class="ki-outline ki-user fs-2"></i>

											</span>
                            <span class="menu-title">PDO Registration</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('recruiting-agency.pdo.candidate.card.download.list')}}">
											<span class="menu-icon">
												<i class="ki-outline ki-user fs-2"></i>
											</span>
                            <span class="menu-title">Download Certificate</span>
                        </a>
                    </div>
                </div>
            </div>



            <!-- Job Management -->
            <div class="menu-item">
                <a class="menu-link" href="{{route('recruiting-agency.job.list')}}">
									<span class="menu-icon">
										<i class="ki-outline ki-calendar-8 fs-2"></i>
									</span>
                    <span class="menu-title">Job Management</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{route('recruiting-agency.all.job.applications')}}">
									<span class="menu-icon">
										<i class="ki-outline ki-calendar-8 fs-2"></i>
									</span>
                    <span class="menu-title">Select Candidates</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('recruiting-agency.recruitment.permission.malaysia')}}">
									<span class="menu-icon">
										<i class="ki-outline ki-calendar-8 fs-2"></i>
									</span>
                    <span class="menu-title">Recruitment Permission</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('recruiting-agency.all.application.by.register.candidate')}}">
									<span class="menu-icon">
										<i class="ki-outline ki-calendar-8 fs-2"></i>
									</span>
                    <span class="menu-title">All Application</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('recruiting-agency.new.candidate.register')}}">
									<span class="menu-icon">
										<i class="ki-outline ki-calendar-8 fs-2"></i>
									</span>
                    <span class="menu-title">New Candidate Registration</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('recruiting-agency.my.data.bank')}}">
									<span class="menu-icon">
										<i class="ki-outline ki-calendar-8 fs-2"></i>
									</span>
                    <span class="menu-title">My Databank</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{route('recruiting-agency.talent.skill.search')}}">
									<span class="menu-icon">
										<i class="ki-outline ki-calendar-8 fs-2"></i>
									</span>
                    <span class="menu-title">Talent Pool Search</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{route('recruiting-agency.malaysia.candidate.search')}}">
									<span class="menu-icon">
										<i class="ki-outline ki-calendar-8 fs-2"></i>
									</span>
                    <span class="menu-title">Malaysia Candidate Search</span>
                </a>
            </div>







            {{--            <div class="menu-item">--}}
{{--                <a class="menu-link" href="#">--}}
{{--									<span class="menu-icon">--}}
{{--										<i class="ki-outline ki-calendar-8 fs-2"></i>--}}
{{--									</span>--}}
{{--                    <span class="menu-title">Select Candidates</span>--}}
{{--                </a>--}}
{{--            </div>--}}


{{--            <div class="menu-item">--}}
{{--                <a class="menu-link" href="#">--}}
{{--									<span class="menu-icon">--}}
{{--										<i class="ki-outline ki-calendar-8 fs-2"></i>--}}
{{--									</span>--}}
{{--                    <span class="menu-title">Recruitment Permission</span>--}}
{{--                </a>--}}
{{--            </div>--}}


{{--            <div class="menu-item">--}}
{{--                <a class="menu-link" href="#">--}}
{{--									<span class="menu-icon">--}}
{{--										<i class="ki-outline ki-calendar-8 fs-2"></i>--}}
{{--									</span>--}}
{{--                    <span class="menu-title">New Candidate Registration</span>--}}
{{--                </a>--}}
{{--            </div>--}}

{{--            <div class="menu-item">--}}
{{--                <a class="menu-link" href="#">--}}
{{--									<span class="menu-icon">--}}
{{--										<i class="ki-outline ki-calendar-8 fs-2"></i>--}}
{{--									</span>--}}
{{--                    <span class="menu-title">My Databank</span>--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>

    </div>
</div>
<!--end::Aside menu-->
<!--begin::Footer-->
<div class="aside-footer flex-column-auto pb-7 px-5" id="kt_aside_footer">
    <p class="btn btn-custom btn-primary w-100">
        <span class="btn-label">Powered By</span>
        <img src="{{ asset('assets/media/logos/logo.png') }}" class="h-35px ms-5" alt="">
    </p>
</div>
<!--end::Footer-->
