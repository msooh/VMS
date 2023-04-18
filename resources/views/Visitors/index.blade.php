@extends('layouts.app')
@push('css')
<link href="{{ asset('assets/css/booking.css') }}" rel="stylesheet">
@endpush

@section('title', 'Visitors')

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
							<li class="breadcrumb-item active" aria-current="page">Visitors</li>
						</ol>
					</nav>
				</div>
				
				<div class="ms-auto">
				<div class="float-md-end">
                            <div class="header-rightside">
                                <ul class="list-inline header-top">
                                    <li class="hidden-xs"><a href="#" class="new-visitor" data-bs-toggle="modal" data-bs-target="#new-visitor">+ New Visitor</a></li>
                                    
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
									<th>Avatar</th>
									<th>Visit No.</th>
                                    <th>Visitor Name</th>
                                    <th>Phone Number</th>
                                    <th>ID Number</th>
                                    <th>Date In</th>
                                    <th>Host</th>
									<th>Extension</th>
                                    <th>Office</th>
									<th>Badge</th>
                                    <th>Timeout</th>
                                    <th>Status</th>
                                    <th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($visits as $visit)
								<tr>
									<td><img src="{{ asset($visit->visitor->avatar) }}" width="50" height="50" class="rounded-circle" alt="" onerror="this.src='{{ asset('assets/images/visitors/passport.jpg') }}'"/></td>
									<td>{{ $visit->visit_no }}</td>
									<td>{{ $visit->visitor->visitor_name }}</td>
									<td>{{ $visit->visitor->visitor_phone_number }}</td>
									<td>{{ $visit->visitor->visitor_id_number }}</td>
                                    <td>{{ $visit->visit_date }}</td>
                                    <td>{{ $visit->employee->name }}</td>
									<td>{{$visit->employee->extension }}</td>
									@foreach($offices as $office)
									@if($office->id == $visit->employee->office_id)
									<td>{{$office->office_name }}</td>
									<td>{{ $visit->badge->badge_number }}</td>
									@endif
									@endforeach
									<td>{{ $visit->time_out}}</td>
									@if($visit->visitor_status =='In')
									<td><span class="badge bg-success">In</span></td>
									@else
									<td><span class="badge bg-danger">Out</span></td>
									@endif
									<!--<td>
										<div class="dropdown">
											<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
											</div>
											<div class="dropdown-menu dropdown-menu-end"> 
												<a class="dropdown-item" href="#">Check Out</a>
                                                <a class="dropdown-item" href="#">Edit</a>
												<a class="dropdown-item" href="javascript:;">Delete</a>
											</div>
										</div>
									</td>-->
									@if($visit->visitor_status =='In')
									<td>
										<div class="dropdown">
											<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
											</div>
											<div class="dropdown-menu dropdown-menu-end"> 
												<a class="dropdown-item" href="#" class="checkout" data-bs-toggle="modal" data-bs-target="#checkout{{$visit->id}}">Check Out</a>
												<a class="dropdown-item" href="#" class="show" data-bs-toggle="modal" data-bs-target="#show{{$visit->id}}">View</a>
											</div>
										</div>
									</td>
									<!--Checkout Modal-->

								<div class="modal fade" id="checkout{{$visit->id}}" tabindex="-1" aria-labelledby="checkoutLabel{{$visit->id}}" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="checkoutLabel{{$visit->id}}">Checkout</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
										<form action="{{ route('visitors.checkout', $visit->id) }}" method="post" enctype="multipart/form-data"> 
										@csrf
											<div class="modal-body">
											Are you sure you want to checkout {{$visit->visitor->visitor_name}}?
											</div>
											<div class="modal-footer">
												<div class="form-btn">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
													<button type="submit" class="submit btn btn-primary">Checkout</button>
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
												<a class="dropdown-item" href="#" class="show" data-bs-toggle="modal" data-bs-target="#show{{$visit->id}}">View</a>
											</div>
										</div>
									</td>
									<!-- Show Visitor Modal-->
									<div class="modal fade" id="show{{$visit->id}}" tabindex="-1" aria-labelledby="showLabel{{$visit->id}}" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="showLabel{{$visit->id}}">{{$visit->visitor->visitor_name}}</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
										<form class="needs-validation" action="{{ route('visitors.show', $visit->id) }}" method="get" enctype="multipart/form-data"> 
										@csrf
										@method('GET')
											<div class="modal-body">
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
											<div class="row mb-3">
												<label class="col-sm-4 col-label-form"><b>Visit Number</b></label>
												<div class="col-sm-6" id="data">
													{{ $visit->visit_no }}
												</div>
											</div>
											<div class="row mb-3">
												<label class="col-sm-4 col-label-form"><b>Phone Number:</b></label>
												<div class="col-sm-6" id="data">
													{{ $visit->visitor->visitor_phone_number }}
												</div>
											</div>
											<div class="row mb-4">
												<label class="col-sm-4 col-label-form"><b>ID/Passport Number:</b></label>
												<div class="col-sm-6" id="data">
													{{ $visit->visitor->visitor_id_number }}
												</div>
											</div>
											<div class="row mb-4">
												<label class="col-sm-4 col-label-form"><b>Visit Date:</b></label>
												<div class="col-sm-6" id="data">
													{{$visit->visit_date }}
												</div>
											</div>
											<div class="row mb-4">
												<label class="col-sm-4 col-label-form"><b>Time Out:</b></label>
												<div class="col-sm-6" id="data">
												{{$visit->time_out}}
												</div>
											</div>
											<div class="row mb-4">
												<label class="col-sm-4 col-label-form"><b>Reason:</b></label>
												<div class="col-sm-6" id="data">
												{{$visit->visit_reason}}
												</div>
											</div>
											<div class="row mb-4">
												<label class="col-sm-4 col-label-form"><b>Office Name:</b></label>
												
												@foreach($offices as $office)
													@if($office->id == $visit->employee->office_id)
													<div class="col-sm-6" id="data">
													{{$office->office_name }}
													</div>
													@endif
													@endforeach
												
											</div>
											<div class="row mb-4">
												<label class="col-sm-4 col-label-form"><b>Host Name</b></label>
												<div class="col-sm-6" id="data">
												{{$visit->employee->name}}
												</div>
											</div>
											<div class="row mb-4">
												<label class="col-sm-4 col-label-form"><b>Badge</b></label>
												<div class="col-sm-6" id="data">
												{{ $visit->badge->badge_number }}
												</div>
											</div>
											<div class="modal-footer">
												<div class="form-btn">
													<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
												</div>
											</div>
										</form>	
										</div>
										</div>
									</div>

									<!--end of edit modal-->
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
    <div id="new-visitor" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="booking-form"> 
                    <div class="form-header"> 
					<button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                        <h1>New Visitor</h1> 
						
                    </div> 
                    <form class="row g-3 needs-validation" action="{{ route('visitors.store') }}" method="post" enctype="multipart/form-data" novalidate> 
                        @csrf
						<!--<div class="row">
						<div class="col-md-6 input-group mb-3">
							<input type="file" class="form-control" id="avatar" name="avatar">
							<label class="input-group-text" for="avatar">Upload</label>
						</div>
						</div>
						<div class="col-md-6 input-group mb-3">
							<input type="file" class="form-control" id="avatar" name="avatar">
							<label class="input-group-text" for="avatar">Upload</label>
						</div>--> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group"> 
									<input type="text" name="visitor_name" class="form-control" placeholder="Visitor Name" />
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
										<div class="invalid-feedback">Please provide a valid ID/Passport.</div>
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
									<select class="form-control" id="employee" name="employee_id">
            						<option value="">Select Employee</option>
									</select>
									@if($errors->has('employee_id'))
										<span class="text-danger">{{ $errors->first('employee_id') }}</span>
									@endif
									</select>
									</div>
                                </div>   

						</div>
                        <div class="row"> 
                                
                    	</div>
						<div class="row">
								<div class="col-md-6"> 
									<select class="form-control" id="validationCustom04" name="badge_id" required>
										<option selected disabled value="">Choose badge... </option>
										@foreach($badges as $badge )
										@if($badge->badge_status =='unassigned')
											<option value="{{ $badge->id }}">{{ $badge->badge_number }} </option>
										@endif
										@endforeach
									</select>
                                </div> 
								<div class="col-md-6">
								<select class="form-control" id="validationCustom04" name="visit_reason" required>
										<option selected disabled value="">Reason Of Visit</option>
											@foreach($visitReasons as $reason)
												<option value="{{ $reason }}">{{ $reason }}</option>
											@endforeach
									</select>
								</div>
							</div>
							
                                <div class="form-btn">
                                    <button class="submit-btn">Check In</button>
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
	<script src="{{ asset('assets/plugins/buttons/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/buttons/js/dataTables.buttons.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
	@if (count($errors) > 0)
    <script>
        $( document ).ready(function() {
            $('#new-visitor').modal('show');
        });
    </script>
@endif
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
  var visitor_phone_number = iti.getNumber();
  if (input.value.trim()) {
    if (iti.isValidNumber()) {
      validMsg.classList.remove("hide");
	  document.getElementById('phone').value = visitor_phone_number;
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
		var token = $('meta[name="csrf-token"]').attr('content');
	 	
			$.ajax({
					type:'get',
					url:'{!!URL::to('getemployees')!!}',
					data: {'id':department_id,
					'_token': token 
					},
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
	
@endpushOnce