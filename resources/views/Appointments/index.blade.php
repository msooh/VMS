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
							<li class="breadcrumb-item active" aria-current="page">Appointments</li>
						</ol>
					</nav>
				</div>
				@if ($message = Session::get('success'))
					<div class="alert alert-success">
						<p>{{ $message }}</p>
					</div>
				@endif
				<div class="ms-auto">
				<div class="float-md-end">
                            <div class="header-rightside">
                                <ul class="list-inline header-top">
                                    <li class="hidden-xs"><a href="#" class="new-appointment" data-bs-toggle="modal" data-bs-target="#new-appointment">+ New Appointment</a></li>
                                    
                                </ul>
                            </div>
                        </div>
					
				</div>
			</div>
			<!--end breadcrumb-->
			
			<hr/>
			<div class="card border-top border-0 border-4 border-success">
				<div class="card-body">
					<div class="table-responsive">
						<table id="appointmentTable" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Appointment Number</th>
                                    <th>Visitor Name</th>
                                    <th>Phone Number</th>
                                    <th>ID Number</th>
                                    <th>Date</th>
                                    <th>Expected Time</th>
                                    <th>Host</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($appointments as $appointment)
								<tr>
									<td>{{ $appointment->app_no }}</td>
									<td>{{ $appointment->visitor->visitor_name }}</td>
									<td>{{ $appointment->visitor->visitor_phone_number }}</td>
									<td>{{ $appointment->visitor->visitor_id_number }}</td>
									<td class="editable" data-id="{{ $appointment->id }}" data-field="appointment_date">{{ $appointment->appointment_date }}</td>
                                    <td>{{ $appointment->expected_time}}</td>
                                    <td>{{ $appointment->employee->name }}</td>
									<td>{{ $appointment->department->department_name }}</td>
									@if($appointment->appointment_status =='Pending')
									<td><span class="badge bg-info">Pending</span></td>
									@elseif(($appointment->appointment_status =='Approved'))
									<td><span class="badge bg-success">Approved</span></td>
									@elseif(($appointment->appointment_status =='CheckedIn'))
									<td><span class="badge bg-warning">Checked In</span></td>
									@else
									@if($appointment->expected_date < date('Y-m-d'))
									<td><span class="badge bg-danger">Expired</span></td>
									@endif
									@endif
									@if($appointment->appointment_status =='Pending')
									<td>
										<div class="dropdown">
											<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
											</div>
											<div class="dropdown-menu dropdown-menu-end"> 
												<a class="dropdown-item" href="#" class="approve" data-bs-toggle="modal" data-bs-target="#show{{$appointment->id}}">View</a>
												<a class="dropdown-item" href="#" class="approve" data-bs-toggle="modal" data-bs-target="#approve{{$appointment->id}}">Approve</a>
												<a class="dropdown-item" href="#" class="reject" data-bs-toggle="modal" data-bs-target="#editAppointmentDateModal{{$appointment->id}}">Reschedule</a>
																						
											</div>
										</div>
									</td>
									<!--View Modal-->
									<div class="modal fade" id="show{{$appointment->id}}" tabindex="-1" aria-labelledby="approveLabel{{$appointment->id}}" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="approveLabel{{$appointment->id}}">{{$appointment->name}}'s Details</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
										<form action="{{ route('appointments.show', $appointment->id) }}" method="post" enctype="multipart/form-data"> 
										@csrf
											<div class="modal-body">
											 {{$appointment->name}}
											</div>
											<div class="row">
												<div class="col-6">
												<label class="col-sm-2 col-label-form"><b>Email</b></label>
													
												</div>
												<div class="col-6">
														{{ $appointment->email }}
													</div>
											</div>
											<div class="row">
												<div class="col-6">
												<label class="col-sm-2 col-label-form"><b>ID Number</b></label>
													
												</div>
												<div class="col-6">
														{{ $appointment->id_number }}
													</div>
											</div>
											<div class="row">
												<div class="col-6">
												<label class="col-sm-2 col-label-form"><b>Appointment Number</b></label>
													
												</div>
												<div class="col-6">
														{{ $appointment->app_no }}
													</div>
											</div>
											<div class="modal-footer">
												<div class="form-btn">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
													<button type="submit" class="submit btn btn-primary">Confirm</button>
												</div>
											</div>
										</form>	
										</div>
										</div>
									</div>
									<!--Approve Modal-->
									<div class="modal fade" id="approve{{$appointment->id}}" tabindex="-1" aria-labelledby="approveLabel{{$appointment->id}}" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="approveLabel{{$appointment->id}}">Approve Appointment</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
										<form action="{{ route('appointments.approve', $appointment->id) }}" method="post" enctype="multipart/form-data"> 
										@csrf
											<div class="modal-body">
											Are you sure you want to accept {{$appointment->name}}'s Appointment?
											</div>
											<div class="modal-footer">
												<div class="form-btn">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
													<button type="submit" class="submit btn btn-primary">Confirm</button>
												</div>
											</div>
										</form>	
										</div>
										</div>
									</div>
									<!-- Edit Appointment Date Modal -->
									<div class="modal fade" id="editAppointmentDateModal{{$appointment->id}}" tabindex="-1" aria-labelledby="editAppointmentDateModalLabel{{$appointment->id}}" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="editAppointmentDateModalLabel{{$appointment->id}}">Edit Appointment Date</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<form id="editAppointmentDateForm" action="{{ route('appointments.date', $appointment->id) }}" method="POST">
											@csrf
											@method('PUT')
											<div class="mb-3">
												<label for="appointment_date" class="form-label">Appointment Date</label>
												<input type="date" class="form-control" id="appointment_date" name="appointment_date">
											</div>
											<button type="submit" class="btn btn-primary">Save changes</button>
											</form>
										</div>
										</div>
									</div>
									</div>

									<!--Reject Modal-->
									<div class="modal fade" id="reject{{$appointment->id}}" tabindex="-1" aria-labelledby="rejectLabel{{$appointment->id}}" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="rejectLabel{{$appointment->id}}">Reject Appointment</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
										<form action="{{ route('appointments.reject', $appointment->id) }}" method="post" enctype="multipart/form-data"> 
										@csrf
											<div class="modal-body">
											Are you sure you want to reject {{$appointment->name}}'s appointment?
											</div>
											<div class="modal-footer">
												<div class="form-btn">
									 				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
													<button type="submit" class="submit btn btn-primary">Confirm</button>
												</div>
											</div>
										</form>	
										</div>
										</div>
									</div>
									@elseif($appointment->appointment_status =='Approved')
									@if($appointment->appointment_date == \Carbon\Carbon::today()->toDateString())
									<td>
										<div class="dropdown">
											<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
											</div>
											<div class="dropdown-menu dropdown-menu-end"> 
											<a class="dropdown-item" href="#" class="checkin" data-bs-toggle="modal" data-bs-target="#checkin{{$appointment->id}}">Check In</a>
												<a class="dropdown-item" href="#">View</a>
												<a class="dropdown-item" href="#">Edit</a>
												<a class="dropdown-item" href="#" class="reject" data-bs-toggle="modal" data-bs-target="#editAppointmentDateModal{{$appointment->id}}">Reschedule</a>
											</div>
										</div>
									</td>
									<!--Checkin Modal-->

								<div class="modal fade" id="checkin{{$appointment->id}}" tabindex="-1" aria-labelledby="checkinLabel{{$appointment->id}}" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="checkinLabel{{$appointment->id}}">CheckIn {{$appointment->visitor->visitor_name}}</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
										<form class="needs-validation" action="{{ route('appointments.checkin', $appointment->id) }}" method="post" enctype="multipart/form-data"> 
										@csrf
											
											<div class="col-md-10"> 
											<label for="validationCustom01" class="form-label">Assign Badge</label>
												<select class="form-control" id="validationCustom04" name="badge_id" required>
													<option selected disabled value="">Choose badge... </option>
													@foreach($badges as $badge )
													@if($badge->badge_status =='unassigned')
														<option value="{{ $badge->id }}">{{ $badge->badge_number }} </option>
													@endif
													@endforeach
												</select>
												</div> 
													
											<div class="row"> 
											</div>
							
											<div class="modal-footer">
												<div class="form-btn">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
													<button type="submit" class="submit-btn btn-primary">Checkin</button>
												</div>
											</div>
										</form>	
										</div>
										</div>
									</div>
									<!--end of checkin modal-->
									<!-- Edit Appointment Modal-->
									<div class="modal fade" id="edit{{$appointment->id}}" tabindex="-1" aria-labelledby="editLabel{{$appointment->id}}" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="editLabel{{$appointment->id}}">{{$appointment->name}}</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
										<form class="needs-validation" action="{{ route('appointments.update', $appointment->id) }}" method="post" enctype="multipart/form-data"> 
										@csrf
										@method('PUT')
											<div class="modal-body">
											<div class="row"> 
												<label class="col-sm-2">Visitor Name</label>
												<div class="col-sm-10">
													<input type="text" name="name" class="form-control" value="{{$appointment->name}}">
												</div>
											</div>
											<div class="row"> 
												<label class="col-sm-2">Visitor Email</label>
												<div class="col-sm-10">
													<input type="text" name="email" class="form-control" value="{{$appointment->email }}">
												</div>
											</div>
											</div>
											<div class="modal-footer">
												<div class="form-btn">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
													<button type="submit" class="submit-btn btn-primary">Submit</button>
												</div>
											</div>
										</form>	
										</div>
										</div>
									</div>

									<!--end of edit modal-->
									@else
									<td>
										<div class="dropdown">
											<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
											</div>
											<div class="dropdown-menu dropdown-menu-end"> 
												<a class="dropdown-item" href="{{ route('appointments.show') }}">View</a>
												<a class="dropdown-item" href="#" class="edit" data-bs-toggle="modal" data-bs-target="#edit{{$appointment->id}}" >Edit</a> 
											</div>
										</div>
									</td>
									<!-- Edit Appointment Modal-->
									<div class="modal fade" id="edit{{$appointment->id}}" tabindex="-1" aria-labelledby="editLabel{{$appointment->id}}" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="editLabel{{$appointment->id}}">{{$appointment->name}}</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
										<form class="needs-validation" action="{{ route('appointments.update', $appointment->id) }}" method="post" enctype="multipart/form-data"> 
										@csrf
										@method('PUT')
											<div class="modal-body">
											<div class="col-md-12">
												<label for="validationCustom01" class="form-label">Visitor Name</label>
												<input type="text" name="visitor_name" id="name" class="form-control {{ $errors->has('visitor_name') ? 'is-invalid' : '' }}" value="{{$appointment->visitor->visitor_name}}" required>
													@if ($errors->has('visitor_name'))
														<div class="invalid-feedback">{{ $errors->first('visitor_name') }}</div>
													@endif
											</div>
											<div class="col-md-12">
												<label for="validationCustom01" class="form-label">Visitor Email</label> 
												<input type="text" name="visitor_email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{$appointment->visitor->visitor_email}}" required>
													@if ($errors->has('visitor_email'))
														<div class="invalid-feedback">{{ $errors->first('visitor_email') }}</div>
													@endif
											</div>
											<div class="col-md-12">
												<label for="validationCustom01" class="form-label">Phone Number</label>
												<input type="tel" name="visitor_phone_number" id="phone" class="form-control {{ $errors->has('visitor_phone_number') ? 'is-invalid' : '' }}" value="{{$appointment->visitor->visitor_phone_number}}" required>
													@if ($errors->has('visitor_phone_number'))
														<div class="invalid-feedback">{{ $errors->first('visitor_phone_number') }}</div>
													@endif
											</div>
											<div class="col-md-12">
												<label for="validationCustom01" class="form-label">ID/Passport</label>
												<input type="id" name="visitor_id_number" class="form-control {{ $errors->has('visitor_id_number') ? 'is-invalid' : '' }}" value="{{$appointment->id_number}}" required>
													@if ($errors->has('visitor_id_number'))
														<div class="invalid-feedback">{{ $errors->first('visitor_id_number') }}</div>
													@endif
											</div>
											<div class="col-md-12">
												<label for="validationCustom01" class="form-label">Department</label>
												<select class="form-control departmentname {{ $errors->has('department_id') ? 'is-invalid' : '' }}" id="department" name="department_id" value="{{ $appointment->department->department_name }}">
													<option selected disabled value="0">{{$appointment->department->department_name}}</option>
													@foreach($departments as $department )
														<option value="{{ $department->id }}">{{ $department->department_name }} </option>
													@endforeach			
												</select>
												@if ($errors->has('department_id'))
														<div class="invalid-feedback">{{ $errors->first('department_id') }}</div>
													@endif
											</div>
											<div class="col-md-12">
												<label for="validationCustom01" class="form-label">Host</label>
												<select class="form-control employee {{ $errors->has('employee_id') ? 'is-invalid' : '' }}" id="employee" name="employee_id" value="{{$appointment->employee->name}}">
													@foreach($employees as $employee )
														<option value="{{ $employee->id }}">{{ $employee->name }} </option>
													@endforeach			
												</select>
												@if ($errors->has('employee_id'))
														<div class="invalid-feedback">{{ $errors->first('employee_id') }}</div>
													@endif
												
											</div>
											<div class="col-md-12">
												<label for="validationCustom01" class="form-label">Expected Date</label>
												<input class="form-control mydate {{ $errors->has('appointment_date') ? 'is-invalid' : '' }}" id="date" type="date" min="2010-04-01" max="2040-04-30" name="appointment_date" value="{{$appointment->appointment_date}}" Required>
													@if ($errors->has('appointment_date'))
														<div class="invalid-feedback">{{ $errors->first('appointment_date') }}</div>
													@endif
												
											</div>
											<div class="col-md-12">
												<label for="validationCustom01" class="form-label">Expected Time</label>
												<input class="form-control {{ $errors->has('expected_time') ? 'is-invalid' : '' }}" id="time" type="time" min="08:00" max="17:00" name="expected_time" onkeyup=enforceMinMax(this) value="{{$appointment->expected_time}}">
												@if ($errors->has('expected_time'))
														<div class="invalid-feedback">{{ $errors->first('expected_time') }}</div>
												@endif
											</div>
											<div class="modal-footer">
												<div class="form-btn">
													<input type="hidden" name="hidden_id" value="{{$appointment->id}}">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
													<button type="submit" class="submit-btn btn-primary">Submit</button>
												</div>
											</div>
										</form>	
										</div>
										</div>
									</div>

									<!--end of edit modal-->
									@endif
									@else
									<td>
										<div class="dropdown">
											<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
											</div>
											<div class="dropdown-menu dropdown-menu-end"> 
												<a class="dropdown-item" href="{{ route('appointments.show') }}">View</a>
											</div>
										</div>
									</td>
									
									@endif
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<!--end page wrapper -->
	<!-- Modal -->
    <div id="new-appointment" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="booking-form"> 
                    <div class="form-header"> 
					<button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                        <h1>New Appointment</h1> 
						
                    </div> 
                    <form class="row g-3 needs-validation" action="{{ route('appointments.store') }}" method="post" enctype="multipart/form-data" novalidate> 
                        @csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group"> 
									<input type="text" name="visitor_name" class="form-control" placeholder="Full Name" />
									<span class="form-label">Name</span>
									@if($errors->has('visitor_name'))
										<span class="text-danger">{{ $errors->first('visitor_name') }}</span>
									@endif

								</div>
							</div>
                        
                        </div> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <input class="form-control" type="email" id="validationCustom04" name="visitor_email" placeholder="Enter Email Address"> 
                                    <span class="form-label">Email</span>
									@if($errors->has('visitor_email'))
										<span class="text-danger">{{ $errors->first('visitor_email') }}</span>
									@endif
                                </div>
                            </div>
                        </div>
						<div class="row">
							<div class="col-md-7">
                                <div class="form-group"> 
									
									<input class="form-control" id="phone"  type="tel" name="visitor_phone_number" required >        
									<span id="valid-msg" class="hide"></span>
									<span id="error-msg" class="hide"></span>
									<span class="form-label">Phone</span>
									@if($errors->has('visitor_phone_number'))
										<span class="text-danger">{{ $errors->first('visitor_phone_number') }}</span>
									@endif
                                </div>
                        	</div>
							<div class="col-md-5">
								<div class="form-group"> 
                                	<input class="form-control" type="id" name="visitor_id_number" placeholder="ID/Passport">
										<span class="form-label">ID Number</span>
										@if($errors->has('visitor_id_number'))
										<span class="text-danger">{{ $errors->first('visitor_id_number') }}</span>
									@endif
                            	</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-7">
								<div class="form-group">
									<select class="form-control departmentname" id="department" name="department_id" required>
										<option selected disabled value="0">Select Department... </option>
										@foreach($departments as $department )
											<option value="{{ $department->id }}">{{ $department->department_name }} </option>
										@endforeach
									</select>
									@if($errors->has('department_id'))
										<span class="text-danger">{{ $errors->first('department_id') }}</span>
									@endif
								</div>	
                            </div>
							<div class="col-md-5">
								<div class="form-group">
									<select class="form-control" id="staff" name="employee_id" required>
									<option value="" selected disabled>Choose Host...</option>
									@foreach($employees as $employee )
											<option value="{{ $employee->id }}">{{ $employee->name }} </option>
										@endforeach
									</select>
									@if($errors->has('employee_id'))
										<span class="text-danger">{{ $errors->first('employee_id') }}</span>
									@endif
								</div>
                            </div>

						</div>
						<div class="row">
							<div class="col-md-7">
                                <div class="form-group"> 
									<input class="form-control mydate" id="date" type="date" min="2010-04-01" max="2040-04-30" name="appointment_date" required >        
									<span class="form-label">Date</span>
									@if($errors->has('appointment_date'))
										<span class="text-danger">{{ $errors->first('appointment_date') }}</span>
									@endif
                                </div>
                        	</div>
							<div class="col-md-5">
								<div class="form-group"> 
                                	<input class="form-control" id="time" type="time" min="08:00" max="17:00" name="expected_time" onkeyup=enforceMinMax(this) placeholder="Expected Time">
										<span class="form-label">Time</span>
										@if($errors->has('expected_time'))
										<span class="text-danger">{{ $errors->first('expected_time') }}</span>
									@endif
                            	</div>
							</div>
						</div>
						<div class="col-md-12">
							<select class="form-control" id="validationCustom04" name="visit_reason" required>
								<option selected disabled value="">Reason Of Visit</option>
									@foreach($visitReasons as $reason)
										<option value="{{ $reason }}">{{ $reason }}</option>
									@endforeach
							</select>
						</div>
							
                                <div class="form-btn">
                                    <button class="submit-btn">Book Now</button>
                                </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
	 
@endsection

@pushOnce('scripts')
	<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/intl-tel-input/js/intlTelInput.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/intl-tel-input/js/utils.js') }}"></script>
	<script src="{{ asset('assets/plugins/intl-tel-input/js/intlTelInput-jquery.min.js') }}"></script>
	<script>
    $('#edit').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '#',
            data: $('#edit').serialize(),
            success: function(data) {
                // handle success response
                // reload modal
                $('#myModal').modal('hide');
                $('#myModal').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // handle error response
                // display error message
                $('#errorMessage').html(jqXHR.responseJSON.message);
            }
        });
    });
</script>
	@if (count($errors) > 0)
    <script>
        $( document ).ready(function() {
            $('#new-appointment').modal('show');
        });
    </script>
	@endif

	<script>
   
	var input = document.querySelector("#phone"),
	errorMsg = document.querySelector("#error-msg"),
    validMsg = document.querySelector("#valid-msg");

// The index maps to the error code returned from getValidationError 
var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];


// initialise plugin
var iti = window.intlTelInput(input, {
	separateDialCode: true,
	preferredCountries:["ke"],
  	hiddenInput: "full",
  utilsScript: "{{ asset('assets/plugins/intl-tel-input/js/utils.js') }}"
});


var reset = function() {
  input.classList.remove("error");
  errorMsg.innerHTML = "";
  errorMsg.classList.add("hide");
  validMsg.classList.add("hide");
};

// on blur: validate
input.addEventListener('blur', function() {
  reset();
  var phone_number = iti.getNumber();
  if (input.value.trim()) {
    if (iti.isValidNumber()) {
      validMsg.classList.remove("hide");
	  document.getElementById('phone').value = phone_number;
	  return true;

    } else {
      input.classList.add("error");
      var errorCode = iti.getValidationError();
      errorMsg.innerHTML = errorMap[errorCode];
      errorMsg.classList.remove("hide");
    }
  }
});

// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);

$("form").submit(function() {
 var number = $("#phone").intlTelInput("getNumber");
});
</script>


<script>
	var today = new Date().toISOString().split('T')[0];
    $("#date").attr('min', today);

	const picker = document.getElementById('date');
	picker.addEventListener('input', function(e){
  	var day = new Date(this.value).getUTCDay();
	if([6,0].includes(day)){
    e.preventDefault();
    this.value = '';
    alert('Weekends not allowed');
	
  }
});
</script>


<script>
	const timeInput = document.getElementById("time");
	timeInput.value = '10:00';

	let previousValue = timeInput.value;

	timeInput.onchange = () => {
  	console.log(previousValue)
  	console.log(timeInput.value)
  
  if (timeInput.value < timeInput.min || timeInput.value > timeInput.max) {
    timeInput.value = previousValue;
	alert('Working hours is between 8:00 - 17:00');
  }
  
  previousValue = timeInput.value;
}
</script>

@endpushOnce