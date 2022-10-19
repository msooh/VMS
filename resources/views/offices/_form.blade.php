@extends('layouts.app')

@section('title', 'Offices')

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
						<li class="breadcrumb-item active" aria-current="page">Offices</li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				
			</div>
		</div>
		<!--end breadcrumb-->
		<hr/>
		<div class="row">					
			<div class="col-xl-12 mx-auto">
				<div class="card border-top border-0 border-4 border-primary">
					<div class="card-body">
						<div class="p-4 border rounded">
							<form class="row g-3 needs-validation" method="post" action="{{ route('offices.store') }}" novalidate>
								@csrf
								<div class="col-md-6">
									<label for="validationCustom01" class="form-label">Office Name</label>
									<input type="text" class="form-control" id="validationCustom01" value="" name="office_name" required>
								</div>
								<div class="col-md-6">
									<label for="validationCustom05" class="form-label">Office Number</label>
									<input type="text" class="form-control" id="validationCustom05" name="office_number" required>
								</div>
								<div class="col-md-6">
									<label for="validationCustom04" class="form-label">Department</label>
									<select class="form-select" id="validationCustom04" name="department_id" required>
										<option selected disabled value="">Choose...</option>
										@foreach($departments as $department )
											<option value="{{ $department->id }}">{{ $department->department_name }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<label for="validationCustom04" class="form-label">Court</label>
									<select class="form-select" id="validationCustom04" name="court_id" required>
										<option selected disabled value="">Choose...</option>
										@foreach($courts as $court )
											<option value="{{ $court->id }}">{{ $court->court_name }}</option>
										@endforeach
									</select>
								</div>
								
								<div class="col-12">
									<button class="btn btn-primary success" type="submit">Save</button>
									<button class="btn btn-warning" type="reset">Clear</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end row-->
	</div>
</div>
<!--end page wrapper -->
@endsection

@pushOnce('scripts')
	<script src="{{ asset('assets/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
	<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
			'use strict'

			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.querySelectorAll('.needs-validation')

			// Loop over them and prevent submission
			Array.prototype.slice.call(forms)
				.forEach(function(form) {
					form.addEventListener('submit', function(event) {
						if (!form.checkValidity()) {
							event.preventDefault()
							event.stopPropagation()
						}

						form.classList.add('was-validated')
					}, false)
				})
		})()

		$(document).ready(function() {
			$('#inputGroupFile02').val('');
		});
	</script>
@endpushOnce