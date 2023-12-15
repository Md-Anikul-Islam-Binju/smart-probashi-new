
<div class="aside-logo flex-column-auto" id="kt_aside_logo">
    <a href="#">
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
                <a class="menu-link" href="{{ route('foreign-ministry.dashboard') }}">
					<span class="menu-icon">
						<i class="ki-outline ki-element-11 fs-2"></i>
					</span>
                    <span class="menu-title">Dashboards</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('foreign-ministry.job.management')}}">
                   <span class="menu-icon">
                        <i class="ki-outline ki-user-edit fs-2"></i>
                   </span>
                    <span class="menu-title">Job Management</span>
                </a>
            </div>
        </div>
    </div>

</div>

<div class="aside-footer flex-column-auto pb-7 px-5" id="kt_aside_footer">
    <p class="btn btn-custom btn-primary w-100">
        <span class="btn-label">Powered By</span>
        <img src="{{ asset('assets/media/logos/logo.png') }}" class="h-35px ms-5" alt="">
    </p>
</div>
