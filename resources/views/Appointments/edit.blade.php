@extends('layouts.app')
@push('css')
<link href="{{ asset('assets/css/booking.css') }}" rel="stylesheet">
@endpush
<?php
use Carbon\Carbon;
?>


@section('title', 'Appointments')

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
							<li class="breadcrumb-item active" aria-current="page">Edit Details</li>
						</ol>
					</nav>
				</div>
				<div class="ms-auto">
					
				</div>
			</div>
			<!--end breadcrumb-->
			<hr/>
			<div class="card border-top border-0 border-4 border-success">
				<div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Error!</strong> <br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
					<div class="p-4 border rounded">
						<form class="row g-3 needs-validation" action="{{ route('appointments.update',$appointment->id) }}" method="POST" enctype="multipart/form-data">
							@csrf
                            @method('PUT')
							<div class="col-md-6">
								<label for="validationCustom01" class="form-label">Visitor Name</label>
								<input type="text" name="name" class="form-control" value="{{$appointment->name}}">
							</div>
                            <div class="col-md-6">
								<label for="validationCustom01" class="form-label">Visitor Email</label> 
								<input type="text" name="email" class="form-control" value="{{$appointment->email }}">
							</div>
                            <div class="col-md-6">
								<label for="validationCustom01" class="form-label">Phone Number</label>
                                <input class="form-control" id="phone"  type="tel" name="phone_number" value="{{$appointment->phone_number}}">
							</div>
                            <div class="col-md-6">
								<label for="validationCustom01" class="form-label">ID/Passport</label>
                                <input class="form-control" type="id" name="id_number" value="{{$appointment->id_number }}">
							</div>
                            <div class="col-md-6">
								<label for="validationCustom01" class="form-label">Department</label>
                                <select class="form-control departmentname" id="department" name="department_id">
									<option selected disabled value="0">{{$appointment->department_id}}</option>
                                    @foreach($departments as $department )
										<option value="{{ $department->id }}">{{ $department->department_name }} </option>
									@endforeach			
								</select>
							</div>
                            <div class="col-md-6">
								<label for="validationCustom01" class="form-label">Host</label>
                                <select class="form-control departmentname" id="department" name="department_id">
									<option selected disabled value="0">{{$appointment->department_id}}</option>
                                    @foreach($employees as $employee )
										<option value="{{ $employee->id }}">{{ $employee->name }} </option>
									@endforeach			
								</select>
							</div>
                            <div class="col-md-6">
								<label for="validationCustom01" class="form-label">Expected Date</label>
                                <input class="form-control mydate" id="date" type="date" min="2010-04-01" max="2040-04-30" name="appointment_date" value="{{$appointment->appointment_date}}" >
							</div>
                            <div class="col-md-6">
								<label for="validationCustom01" class="form-label">Expected Time</label>
                                <input class="form-control" id="time" type="time" min="08:00" max="17:00" name="expected_time" onkeyup=enforceMinMax(this) value="{{$appointment->expected_time}}">
							</div>
                            <div class="form-btn">
                                <input type="hidden" name="hidden_id" value="{{$appointment->id}}">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="submit-btn btn-primary">Submit</button>
                            </div>
							
						</form>
					</div>
@endsection