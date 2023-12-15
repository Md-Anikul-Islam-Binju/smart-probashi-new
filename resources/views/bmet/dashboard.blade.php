@extends('layouts.bmet.master')
@section('content')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
                <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3">
                    BMET</h1>
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="col-12 col-sm-6 col-md-3">
				<div class="card card-flush admin_card_style">
					<div class="card-header">
						<div class="card-title d-flex flex-column">
							<span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">69</span>
							<span class="text-white opacity-100 pt-1 fw-semibold fs-2">Total BMET Registration List</span>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection
