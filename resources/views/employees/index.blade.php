@extends('layouts.app')

@section('title', 'Employees')

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
							<li class="breadcrumb-item active" aria-current="page">Employee List</li>
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
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Name</th>
									<th>Est Number</th>
									<th>Phone Number</th>
									<th>Email</th>
									<th>Office</th>
									<th>Department</th>
									<th>Role</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($employees as $employee)
								<tr>
									<!--<td><img src="{{ asset($employee->avatar) }}" width="50" height="50" class="rounded-circle" alt="" onerror="this.src='{{ asset('assets/images/sites/beaverton.jpg') }}'"/></td>-->
									<td>{{ $employee->name }}</td>
									<td>{{ $employee->est_number }}</td>
									<td>{{ $employee->phno }}</td>
									<td>{{ $employee->email }}</td>
									<td>{{ $employee->office->office_name }}</td>
									@foreach($departments as $department)
									@if($department->id == $employee->office->department_id)
									<td>{{$department->department_name }}</td>
									@endif
									@endforeach
									<td>{{ $employee->role->name }}</td>
									<td>
										<div class="dropdown">
											<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
											</div>
											<div class="dropdown-menu dropdown-menu-end"> 
												<a class="dropdown-item" href="view-supervisor.html">View</a>
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
@endsection

@pushOnce('scripts')
	<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
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
@endpushOnce