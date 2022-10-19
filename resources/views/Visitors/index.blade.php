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
							<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Visitors</li>
						</ol>
					</nav>
				</div>
				
				<div class="ms-auto">
				<div class="float-md-end">
                            <div class="header-rightside">
                                <ul class="list-inline header-top">
                                    <li class="hidden-xs"><a href="#" class="new-visitor" data-bs-toggle="modal" data-bs-target="#new-visitor">Add Visitor</a></li>
                                    
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
                                    <th>Visitor Name</th>
                                    <th>Country Code</th>
                                    <th>Phone Number</th>
                                    <th>ID Number</th>
                                    <th>Date In</th>
                                    <th>Time In</th>
                                    <th>Host</th>
                                    <th>Office</th>
                                    <th>Timeout</th>
                                    <th>Status</th>
                                    <th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($visitors as $visitor)
								<tr>
									<td><img src="{{ asset($visitor->avatar) }}" width="50" height="50" class="rounded-circle" alt="" onerror="this.src='{{ asset('assets/images/visitors/passport.jpg') }}'"/></td>
									<td>{{ $visitor->visitor_name }}</td>
									<td>{{ $visitor->visitor_country_code }}</td>
									<td>{{ $visitor->visitor_phone_number }}</td>
									<td>{{ $visitor->visitor_id_number }}</td>
                                    <td>{{ $visitor->visit_date }}</td>
                                    <td>{{ $visitor->time_in}}</td>
                                    <td>{{ $visitor->employee->name }}</td>
									@foreach($offices as $office)
									@if($office->id == $visitor->employee->office_id)
									<td>{{$office->office_name }}</td>
									@endif
									@endforeach
									@if($visitor->visitor_status =='In')
									<td><span class="badge bg-success">In</span></td>
									@else
									<td><span class="badge bg-danger">Out</span></td>
									@endif
									<td>
										<div class="dropdown">
											<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
											</div>
											<div class="dropdown-menu dropdown-menu-end"> 
												<a class="dropdown-item" href="#">Check In</a>
                                                <a class="dropdown-item" href="#">Edit</a>
												<a class="dropdown-item" href="javascript:;">Delete</a>
											</div>
										</div>
									</td>
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
                        <h1>New Visitor</h1> 
                    </div> 
                    <form class="row g-3 needs-validation" action="{{ route('visitors.store') }}" method="post" enctype="multipart/form-data" novalidate> 
                        @csrf
						<!--<div class="col-md-6 input-group mb-3">
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
                                <input class="form-control" type="email" name="visitor_email" placeholder="Enter Email Address"> 
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
									<select class="form-control" id="validationCustom04" name="office_id" required>
										<option selected disabled value="">Choose Host... </option>
										@foreach($employees as $employee )
											<option value="{{ $employee->id }}">{{ $employee->name }} </option>
										@endforeach
									</select>
									<span class="select-arrow"></span>
                                </div>
                                <div class="col-md-5"> 
                                    <div class="form-group"> 
                                        <input class="form-control" type="date" name="visit_date" required> 
                                        <span class="form-label">Date</span>
                                        @if($errors->has('visit_date'))
		        			                <span class="text-danger">{{ $errors->first('visit_date') }}</span>
		        		                @endif
                                    </div> 
                                </div> 
                            </div>
                            <!--<div class="row">
                            <div class="col-md-6"> 
                                    <div class="form-group"> 
                                        <input class="form-control" type="time" name="time_in" required> 
                                        <span class="form-label">Time IN</span>
                                        @if($errors->has('time_in'))
		        			                <span class="text-danger">{{ $errors->first('time_in') }}</span>
		        		                @endif
                                    </div> 
                                </div> 
                                <div class="col-md-6"> 
                                    <div class="form-group"> 
                                        <input class="form-control" type="time" name="time_out" required> 
                                        <span class="form-label">Time Out</span>
                                        @if($errors->has('time_out'))
		        			                <span class="text-danger">{{ $errors->first('time_out') }}</span>
		        		                @endif
                                    </div> 
                                </div> 
                            </div>-->
							
                                <div class="row">
								<div class="col-md-6">
									
									
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
    var phone = window.intlTelInput(document.querySelector("#phone"), {
		separateDialCode: true,
		preferredCountries:["ke"],
		hiddenInput:"full",
     utilsScript:
  		 "{{ asset('assets/plugins/intl-tel-input/js/utils.js') }}",
	});

 	</script>
	
@endpushOnce