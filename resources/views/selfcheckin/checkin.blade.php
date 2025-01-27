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
<ul id="progressbar" class="checkin">
    <li class="active" id="details"><strong>Details</strong></li>
    <li id="info"><strong>Confirm</strong></li>
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
                                        <h2 class="fs-title">Appointment Number:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 1 - 3</h2>
                                    </div>
                                </div>
                                <label class="fieldlabels">Search Number Or Scan QR Code:</label>
                                @livewire('appointment-search-bar')
                            </div>
                            <input type="button" name="next" class="next action-button" value="Checkin"/>
                            <br>
                            <div>
                            <a href="{{ route('selfcheckin.appointment') }}" class="checkappointment">Don't have an appointment?</a>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                    
                            <div class="form-card finish">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Confirm Details:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 2 - 3</h2>
                                    </div>
                                </div>
                                <br><br>
                                <h2 class="success-text text-center"><strong></strong>Visitor Details</h2>
                                <br>
                                <div class="row justify-content-center">
                                    <h5 class="text-center">Visitor Name: Faith Muthoni</h5>
                                    <h5 class="text-center">Host Name: Newton Muraya</h5>
                                    <h5 class="text-center">Host Department: ICT Department</h5>
                                </div>
                                <br><br>
                            </div>                           
                            </div>
                            <input type="button" name="next" class="next action-button" value="Confirm"/>
                            <input type="button" name="previous" class="previous action-button-previous" value="Reject"/>
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
                                <h2 class="success-text text-center"><strong>SUCCESSFUL CHECKIN !</strong></h2>
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
    @pushOnce('scripts')
    <script type="text/javascript">
        var path = "{{ route('selfcheckin.searchappointment') }}";
  
  $('#appno').typeahead({
          source: function (query, process) {
              return $.get(path, {
                  query: query
              }, function (data) {
                  return process(data);
              });
          }
      });
    </script>

    @endpushOnce