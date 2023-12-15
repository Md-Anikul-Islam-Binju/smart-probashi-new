<div class="aside-logo flex-column-auto" id="kt_aside_logo">
    <a href="{{ route('admin.dashboard') }}">
        <img alt="Smart Probashi" src="{{ asset('assets/media/logos/logo.png') }}" class="h-60px logo" />
    </a>
    <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle me-n2" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
        <i class="ki-outline ki-double-left fs-1 rotate-180"></i>
    </div>
</div>
{{-- Admin Side Navbar --}}
<div class="aside-menu flex-column-fluid">
    <div class="hover-scroll-overlay-y my-2 py-2" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
            <div class="menu-item">
                <a class="menu-link" href="{{ route('admin.dashboard') }}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-element-11 fs-2"></i>
                    </span>
                    <span class="menu-title">Dashboards</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.bmet')}}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-user fs-2"></i>
                    </span>
                    <span class="menu-title">BMET Panel Registration</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.bmet.candidate.registered.verification')}}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-user fs-2"></i>
                    </span>
                    <span class="menu-title">BMET Candidate Registration Verification</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.job.management')}}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-user fs-2"></i>
                    </span>
                    <span class="menu-title">Job Management</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.pdo.register.candidate.list')}}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-user fs-2"></i>
                    </span>
                    <span class="menu-title">PDO Management</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.clearance')}}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-user fs-2"></i>
                    </span>
                    <span class="menu-title">Clearance</span>
                </a>
            </div>



            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                         <i class="ki-outline ki-user fs-2"></i>
                    </span>
                    <span class="menu-title">Recruiting Agency</span>
                    <span class="menu-arrow"></span>
                    </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('admin.recruiting.agency.all')}}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-user fs-2"></i>
                            </span>
                            <span class="menu-title">All Recruiting Agency</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('admin.recruiting.agency.approved')}}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-user fs-2"></i>
                            </span>
                            <span class="menu-title">Approved Recruiting Agency</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('admin.recruiting.agency.pending')}}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-user fs-2"></i>
                            </span>
                            <span class="menu-title">Pending Recruiting Agency</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('admin.recruiting.agency.rejected')}}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-user fs-2"></i>
                            </span>
                            <span class="menu-title">Rejected Recruiting Agency</span>
                        </a>
                    </div>
                </div>
            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="ki-outline ki-user-square fs-2"></i>
                    </span>
                    <span class="menu-title">TTC</span>
                    <span class="menu-arrow"></span>
                    </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('admin.ttc') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-user fs-2"></i>
                            </span>
                            <span class="menu-title">All Technical Training Center</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('admin.ttc.schedule') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-user fs-2"></i>
                            </span>
                            <span class="menu-title">TTC schedule</span>
                        </a>
                    </div>
                </div>
            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="ki-outline ki-user-square fs-2"></i>
                    </span>
                    <span class="menu-title">Location</span>
                    <span class="menu-arrow"></span>
                    </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('admin.division') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-user fs-2"></i>
                            </span>
                            <span class="menu-title">Division</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('admin.district') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-user fs-2"></i>
                            </span>
                            <span class="menu-title">District</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('admin.upazila')}}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-user fs-2"></i>
                            </span>
                            <span class="menu-title">Upazilla</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.organization')}}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-element-plus fs-2"></i>
                    </span>
                    <span class="menu-title">Organization</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.religion')}}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-calendar-8 fs-2"></i>
                    </span>
                    <span class="menu-title">Religion</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.relation')}}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-calendar-8 fs-2"></i>
                    </span>
                    <span class="menu-title">Relation</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.job.category')}}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-calendar-8 fs-2"></i>
                    </span>
                    <span class="menu-title">Job Category</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.education.level')}}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-calendar-8 fs-2"></i>
                    </span>
                    <span class="menu-title">Education Level</span>
                </a>
            </div>
            <!-- Board -->
            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.board')}}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-calendar-8 fs-2"></i>
                    </span>
                    <span class="menu-title">Board</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.language')}}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-calendar-8 fs-2"></i>
                    </span>
                    <span class="menu-title">Language</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.currency')}}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-calendar-8 fs-2"></i>
                    </span>
                    <span class="menu-title">Currency</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.bank')}}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-calendar-8 fs-2"></i>
                    </span>
                    <span class="menu-title">Bank</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.hospital')}}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-calendar-8 fs-2"></i>
                    </span>
                    <span class="menu-title">Hospital</span>
                </a>
            </div>

        </div>
    </div>
</div>
{{-- Footer --}}
<div class="aside-footer flex-column-auto pb-7 px-5" id="kt_aside_footer">
    <p class="btn btn-custom btn-primary w-100">
        <span class="btn-label">Powered By</span>
        <img src="{{ asset('assets/media/logos/logo.png') }}" class="h-35px ms-5" alt="Smart Probashi">
    </p>
</div>

