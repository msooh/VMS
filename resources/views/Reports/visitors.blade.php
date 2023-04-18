@extends('layouts.app')
@push('css')
<link href="{{ asset('assets/css/booking.css') }}" rel="stylesheet">
@endpush

@section('title', 'Visitors Report')

@section('content')
	<!--start page wrapper -->
	<div class="page-wrapper">
		<div class="page-content">
			<!--breadcrumb-->
			<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
				<div class="ps-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0 p-0">
							<li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Visitors Report</li>
						</ol>
					</nav>
				</div>
				
			</div>
			<!--end breadcrumb-->
			<div class="containerreport">
		<div class="table-report">
            <div class="row" id="filter">
                <div class="col-md-1">
                    <label for="startdate" class="form-label">Start Date:</label>
                </div>
                <div class="col-md-4">
                <input type="date" class="form-control mb-3" id="start-date" placeholder="Start date">
                </div>
                <div class="col-md-1">
                    <label for="enddate" class="form-label">End Date:</label>
                </div>
                <div class="col-md-4">
                    <input type="date" class="form-control mb-3" id="end-date" placeholder="End date">
                </div>
            </div>
            <div class="row" id="filter">
                <div class="col-sm-1">
                    <label for="office" class="form-label">Filter by Department:</label>
                </div>
                <div class="col-md-4">
                    <select id="office" class="form-select">
                        <option value="">All Departments</option>
                            @foreach($offices as $office )
                                <option value="{{ $office->id }}">{{ $office->office_name }} </option>
                            @endforeach
                        
                    </select>
                </div>
                <div class="col-sm-1">
                    <label for="host" class="form-label">Filter by Staff:</label>
                </div>
                <div class="col-md-4">
                    <select id="host" class="form-select">
                        <option value="">All Staff</option>
                            @foreach($employees as $employee )
                                <option value="{{ $employee->id }}">{{ $employee->name }} </option>
                            @endforeach
                    </select>
                </div>
                
            </div>
            <div class="text-center">
                <button id="resetFilter" class="btn btn-secondary">Reset</button>
                <button id="applyFilter" class="btn btn-primary">Apply Filters</button>
            </div>
        
        <table id="report" class="table table-striped" style="width:100%">
        <thead class="table-dark">
            <tr>
            <th>Visitor Name</th>
            <th>Phone Number</th>
            <th>ID Number</th>
            <th>Host</th>
            <th>Office</th>
            <th>Badge</th>
            <th>Date In</th>
            <th>Time In</th>
            <th>Timeout</th>
            </tr>
        </thead>
        <tbody>
        @foreach($visitors as $visitor)
        <tr>
            
            <td>{{ $visitor->visitor_name }}</td>
            <td>{{ $visitor->visitor_phone_number }}</td>
            <td>{{ $visitor->visitor_id_number }}</td>
            <td>{{ $visitor->employee->name }}</td>
            @foreach($offices as $office)
            @if($office->id == $visitor->employee->office_id)
            <td>{{$office->office_name }}</td>
            <td>{{ $visitor->badge->badge_number }}</td>
            @endif
            @endforeach
            <td>{{ $visitor->visit_date }}</td>
            <td>{{ $visitor->time_in}}</td>
            <td>{{ $visitor->time_out}}</td>
@endforeach
        </tbody>
        <tfoot>
            <tr>
            <th>Visitor Name</th>
            <th>Phone Number</th>
            <th>ID Number</th>
            <th>Date In</th>
            <th>Time In</th>
            <th>Host</th>
            <th>Office</th>
            <th>Badge</th>
            <th>Timeout</th>
            </tr>
        </tfoot>
    </table>
					</div>
                    <div class="filterheader">
                        <h6>Filters:</h6>
                    </div>
				</div>
                </div>
	</div>
	<!--end page wrapper -->
	 
@endsection

@pushOnce('scripts')
  
	
@endpushOnce