@extends('layouts.app')
@section('title', 'Appointments')

@section('content')

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col col-md-6"><b>Appointment Details</b></div>
			<div class="col col-md-6">
				<a href="{{ route('appointments.index') }}" class="btn btn-primary btn-sm float-end">View All</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row mb-3">
			<label class="col-sm-2 col-label-form"><b>Appointment Name</b></label>
			<div class="col-sm-10">
				{{ $appointment->name }}
			</div>
		</div>
		<div class="row mb-3">
			<label class="col-sm-2 col-label-form"><b>Email</b></label>
			<div class="col-sm-10">
				{{ $appointment->email }}
			</div>
		</div>
		<div class="row mb-4">
			<label class="col-sm-2 col-label-form"><b>Appointment Number</b></label>
			<div class="col-sm-10">
				{{ $appointment->app_no }}
			</div>
		</div>
        <div class="row mb-4">
			<label class="col-sm-2 col-label-form"><b>Appointment Number</b></label>
			<div class="col-sm-6">
				{{ $appointment->id_number }}
			</div>
		</div>
        <div class="row mb-4">
			<label class="col-sm-2 col-label-form"><b>ID Number</b></label>
			<div class="col-sm-10">
				{{ $appointment->app_no }}
			</div>
		</div>
		<div class="row mb-4">
			<label class="col-sm-2 col-label-form"><b>Student Image</b></label>
			<div class="col-sm-10">
				<img src="" width="200" class="img-thumbnail" />
			</div>
		</div>
	</div>
</div>

@endsection('content')
