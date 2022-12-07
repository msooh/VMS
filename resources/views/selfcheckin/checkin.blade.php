@extends('selfcheckin.base')

@section('title', 'Checkin')

@section('content')
<div class="container-fluid checkin">
<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0 p-0">
							<li class="breadcrumb-item"><a href="{{ route('selfcheckin.index') }}"><i class="fa-solid fa-angle-left"></i><i class="fa-solid fa-house"></i></a>
							</li>

						</ol>
					</nav>
<h2 id="heading">Checkin</h2>
<!-- progressbar -->
<ul id="progressbar">
                        
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
                                        <h2 class="fs-title">Appointment Number:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 1 - 2</h2>
                                    </div>
                                </div>
                                <label class="fieldlabels">Enter your Appointment Number:</label>
                                <input id="appointment" type="" name="appointment_number">
                            </div>
                            <input type="button" name="next" class="next action-button" value="Submit"/>
                        </fieldset>
                        <fieldset>
                            <div class="form-card finish">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Finish:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 2 - 2</h2>
                                    </div>
                                </div>
                                <br><br>
                                <h2 class="success-text text-center"><strong>SUCCESS !</strong></h2>
                                <h2 class="text-center"id="success"></h2>
                                <br>
                                <div class="row justify-content-center">
                                    <h5 class="text-center">Badge number: 505</h5>
                                    <img src="https://chart.googleapis.com/chart?cht=qr&chl=Hello+World&chs=160x160&chld=L|0" class="qr-code img-thumbnail img-responsive" />
                                </div>
                                <br><br>
                                <div class="row justify-content-center">
                                    <div class="col-7 text-center">
                                        <h5 class="purple-text text-center">Enjoy your visit!</h5>
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