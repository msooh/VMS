@extends('layouts.app')

@section('title', 'Badges')

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
							<li class="breadcrumb-item active" aria-current="page">Badge List</li>
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
					<div class="p-4 border rounded">
						<form class="row g-3 needs-validation" action="" method="post" novalidate>
							@csrf
							<div class="col-md-6">
								<label for="validationCustom01" class="form-label">Badge Number</label>
								<input type="number" class="form-control" id="validationCustom01" name="badge_number">
							</div>
							<div class="col-md-6">
							<select class="form-control" id="validationCustom04" name="court_id" required>
										<option selected disabled value="">Select Court... </option>
										@foreach($courts as $court )
											<option value="{{ $court->id }}">{{ $court->court_name }} </option>
										@endforeach
									</select>
							</div>
							<div class="col-6" style="padding-top: 30px;">
								<button class="btn btn-primary success" type="submit">Save</button>
							</div>
						</form>
					</div>
					<hr/>
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Badge Number</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							@foreach($badges as $badge)
								<tr>
									<td>{{ $badge->badge_number }}</td>
									<td>
										<div class="dropdown">
											<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
											</div>
											<div class="dropdown-menu dropdown-menu-end"> 
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
@endsection
	
@pushOnce('scripts')
	<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
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
