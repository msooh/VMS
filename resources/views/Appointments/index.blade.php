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
						<table id="example" class="table table-striped table-bordered" style="width:100%">
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
									<td>{{ $appointment->name }}</td>
									<td>{{ $appointment->phone_number }}</td>
									<td>{{ $appointment->id_number }}</td>
                                    <td>{{ $appointment->appointment_date }}</td>
                                    <td>{{ $appointment->expected_time}}</td>
                                    <td>{{ $appointment->employee->name }}</td>
									<td>{{ $appointment->department->department_name }}</td>
									@if($appointment->appointment_status =='Pending')
									<td><span class="badge bg-info">Pending</span></td>
									@elseif(($appointment->appointment_status =='Approved'))
									<td><span class="badge bg-success">Approved</span></td>
									@else
									<td><span class="badge bg-danger">Rejected</span></td>
									@endif
									@if($appointment->appointment_status =='Pending')
									<td>
										<div class="dropdown">
											<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
											</div>
											<div class="dropdown-menu dropdown-menu-end"> 
												<a class="dropdown-item" href="#" class="approve" data-bs-toggle="modal" data-bs-target="#approve{{$appointment->id}}">Approve</a>
												<a class="dropdown-item" href="#" class="reject" data-bs-toggle="modal" data-bs-target="#reject{{$appointment->id}}">Reject</a>
												<a class="dropdown-item" href="javascript:;">Delete</a>											
											</div>
										</div>
									</td>
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
												<a class="dropdown-item" href="javascript:;">Delete</a>
											</div>
										</div>
									</td>
									<!--Checkout Modal-->

								<div class="modal fade" id="checkin{{$appointment->id}}" tabindex="-1" aria-labelledby="checkinLabel{{$appointment->id}}" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="checkinLabel{{$appointment->id}}">CheckIn</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
										<form action="{{ route('visitors.store', $appointment->id) }}" method="post" enctype="multipart/form-data"> 
										@csrf
											<div class="modal-body">
											Are you sure you want to checkin {{$appointment->name}}?
											</div>
											<div class="modal-footer">
												<div class="form-btn">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
													<button type="submit" class="submit btn btn-primary">Checkin</button>
												</div>
											</div>
										</form>	
										</div>
										</div>
									</div>
									@else
									<td>
										<div class="dropdown">
											<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
											</div>
											<div class="dropdown-menu dropdown-menu-end"> 
												<a class="dropdown-item" href="#">View</a>
												<a class="dropdown-item" href="#">Edit</a>
												<a class="dropdown-item" href="javascript:;">Delete</a>
											</div>
										</div>
									</td>
									@endif
									@else
									<td>
										<div class="dropdown">
											<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
											</div>
											<div class="dropdown-menu dropdown-menu-end"> 
												<a class="dropdown-item" href="#">View</a>
												<a class="dropdown-item" href="javascript:;">Delete</a>
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
									<input type="text" name="name" class="form-control" placeholder="Full Name" />
									<span class="form-label">Name</span>
									@if($errors->has('name'))
										<span class="text-danger">{{ $errors->first('name') }}</span>
									@endif

								</div>
							</div>
                        
                        </div> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <input class="form-control" type="email" id="validationCustom04" name="email" placeholder="Enter Email Address"> 
                                    <span class="form-label">Email</span>
									@if($errors->has('email'))
										<span class="text-danger">{{ $errors->first('email') }}</span>
									@endif
                                </div>
                            </div>
                        </div>
						<div class="row">
							<div class="col-md-7">
                                <div class="form-group"> 
									
									<input class="form-control" id="phone"  type="tel" name="phone_number" required >        
									<span id="valid-msg" class="hide"></span>
									<span id="error-msg" class="hide"></span>
									<span class="form-label">Phone</span>
									@if($errors->has('phone_number'))
										<span class="text-danger">{{ $errors->first('phone_number') }}</span>
									@endif
                                </div>
                        	</div>
							<div class="col-md-5">
								<div class="form-group"> 
                                	<input class="form-control" type="id" name="id_number" placeholder="ID/Passport">
										<span class="form-label">ID Number</span>
										@if($errors->has('id_number'))
										<span class="text-danger">{{ $errors->first('id_number') }}</span>
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
									<select class="form-control" id="employee" name="employee_id" required>
									<option value="0" selected disabled>Choose Host...</option>
										
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
	<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js') }}"></script>
	@if (count($errors) > 0)
    <script>
        $( document ).ready(function() {
            $('#new-appointment').modal('show');
        });
    </script>
	@endif
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
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

<script type="text/javascript">
 $(document).ready(function() {
	$(document).on('change', '.departmentname', function(){
		$('#employee').empty().append('<option value="null">-Select Host-</option>');
		//console.log("change");
		var department_id=$(this).val();
	 	var div = $(this).parent();
	 	
			$.ajax({
					type:'get',
					url:'{!!URL::to('getemployees')!!}',
					data: {'id':department_id},
					success:function(data){
						//console.log('success');
						//console.log(data);
						//console.log(data.length);
						
						for (var i = 0; i <= data.length-1; i++) { 
                		$('#employee').append('<option value="' + data[i].id + '">' + data[i].name + '</option>'); 
            }
						
					},
					error:function(){

					}
			});
	});	 
       
    });
</script>

<script>
	$(document).ready(function() {
		$('#date').bootstrapMaterialDateTimePicker({
			format: 'DD-MM-YYYY',
    		weekStart: 1,
			time: false,
			clearButton: true,
			minDate : new Date(),
			disabledDates: [new Date()],
}); 
		  } );

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