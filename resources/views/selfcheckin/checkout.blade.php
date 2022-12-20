@extends('selfcheckin.base')

@section('title', 'Checkout')

@section('content')
<div class="container-fluid checkin">
<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0 p-0">
							<li class="breadcrumb-item"><a href="{{ route('selfcheckin.index') }}"><i class="fa-solid fa-angle-left"></i><i class="fa-solid fa-house"></i></a>
							</li>

						</ol>
					</nav>
<h2 id="heading">Checkout</h2>
<!-- progressbar -->
<ul id="progressbar" class="checkin">
    <li class="active" id="details"><strong>Details</strong></li>
    <li id="feedback"><strong>Feedback</strong></li>
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
                                        <h2 class="fs-title">Badge Number:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 1 - 3</h2>
                                    </div>
                                </div>
                                <label class="fieldlabels">Enter Number Or Scan QR Code:</label>
                                <input id="badge" type="text" name="badge_number">
                            </div>
                            <input type="button" name="next" class="next action-button" value="Checkout"/>
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                    
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Leave Feadback:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 2 - 3</h2>
                                    </div>
                                </div>
                                <label class="fieldlabels">Rate:</label>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <br><br>
                                <label class="fieldlabels">Leave Comment:</label>
                                <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
                            </div>                           
                            </div>
                            <input type="button" name="next" class="next action-button" value="Submit"/>
                            <input type="button" name="next" class="next action-button" style="background-color: #000" value="Skip"/>
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        </fieldset>
                        <fieldset>
                            <div class="form-card finish">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Finish:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 3 - 3</h2>
                                    </div>
                                </div>
                                <br><br>
                                <h2 class="success-text text-center"><strong>Checked out!</strong></h2>
                                <h2 class="text-center"id="success"></h2>
                                <br>
                                <div class="row justify-content-center">
                                    <h5 class="text-center">Faith Muthoni</h5>
                                    
                                </div>
                                <br><br>
                                <div class="row justify-content-center">
                                    <div class="col-7 text-center">
                                        <h5 class="purple-text text-center">Welcome Back!</h5>
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