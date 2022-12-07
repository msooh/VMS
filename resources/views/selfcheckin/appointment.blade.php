@extends('selfcheckin.base')

@section('title', 'Appointments')

@section('content')
<div class="container-fluid appointment">
<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0 p-0">
							<li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa-solid fa-angle-left"></i><i class="fa-solid fa-house"></i></a>
							</li>

						</ol>
					</nav>
<h2 id="heading">Book Appointment</h2>
<!-- progressbar -->
<ul id="progressbar">
                            <li class="active" id="details"><strong>Details</strong></li>
                            <li id="host"><strong>Host</strong></li>
                            <li id="date"><strong>Date</strong></li>
                            <li id="confirm"><strong>Finish</strong></li>
                        </ul>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <br>
        <div class="row justify-content-center">
            <div class="col-10 col-sm-9 col-md-9 col-lg-9 col-xl-6 text-center">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    
    
                    <form id="msform">
                    @csrf
                        <!-- fieldsets -->
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Personal Information:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 1 - 4</h2>
                                    </div>
                                </div>
                                <label class="fieldlabels">Full Name: *</label>
                                <input type="text" name="name" placeholder="Full Name" required/>
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                                <label class="fieldlabels">Email: *</label>
                                <input type="email" name="email" placeholder="Email Address" required/>
                                @if($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                                <label class="fieldlabels">ID/Passport: *</label>
                                <input type="password" name="id_number" placeholder="ID/Passport" required>
                                @if($errors->has('id_number'))
                                    <span class="text-danger">{{ $errors->first('id_number') }}</span>
                                @endif
                                <label class="fieldlabels">Phone Number: *</label>
                                <input type="tel" id="phoneno" name="phone_number" placeholder="Phone Number" required/>
                                <span id="valid-msg" class="hide"></span>
								<span id="error-msg" class="hide"></span>
                                @if($errors->has('phone_number'))
                                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                @endif
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next"/>
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Who is your host?:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 2 - 4</h2>
                                    </div>
                                </div>
                                
							    
                                        <label class="fieldlabels">Select Host:</label>
                                        <select name="department_id" id="department" class=" host departmentname">
                                        <option selected disabled value="0">Select Department... </option>
                                        @foreach($departments as $department )
                                            <option value="{{ $department->id }}">{{ $department->department_name }} </option>
                                        @endforeach
                                        </select>
                                   
                                   
                                        <label class="fieldlabels">Select Host:</label>
                                        <select name="employee_id" id="employee" class="host">
                                        <option selected disabled value="0">Select Host... </option>
                                        @foreach($employees as $employee )
                                            <option value="{{ $employee->id }}">{{ $employee->name }} </option>
                                        @endforeach
                                        </select>
                                                                     
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next"/>
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Appointment Date:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 3 - 4</h2>
                                    </div>
                                </div>
                                <label class="fieldlabels">Select Date:</label>
                                <input id="date" type="date" min="2010-04-01" max="2040-04-30" name="appointment_date">
                                <label class="fieldlabels">Select Time:</label>
                                <input id="time" type="time" min="08:00" max="17:00" name="expected_time">
                            </div>
                            <input type="button" name="next" class="next action-button" value="Submit"/>
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        </fieldset>
                        <fieldset>
                            <div class="form-card finish">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Finish:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 4 - 4</h2>
                                    </div>
                                </div>
                                <br><br>
                                <h2 class="success-text text-center"><strong>SUCCESS !</strong></h2>
                                <h2 class="text-center"id="success"></h2>
                                <br>
                                <div class="row justify-content-center">
                                    
                                </div>
                                <br><br>
                                <div class="row justify-content-center">
                                    <div class="col-7 text-center">
                                        <h5 class="purple-text text-center">Appointment Booked Successfully</h5>
                                    </div>
                                </div>
                            </div>
                        </fieldset>                     
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @pushOnce('scripts')
    <script type="text/javascript">
 $(document).ready(function() {
	$(document).on('change', '.departmentname', function(){
		$('#employee').empty().append('<option value="null">-Select Host-</option>');
		var department_id=$(this).val();
	 	var div = $(this).parent();
	 	
			$.ajax({
					type:'get',
					url:'{!!URL::to('getemployees')!!}',
					data: {'id':department_id},
					success:function(data){
						
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