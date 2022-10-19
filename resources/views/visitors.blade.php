@extends('dashboard')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/booking.css') }}">
@endpush

@section('content')

                <div class="row">
                    <header>
                        <div class="col-md-4 g-0"> 
                            <div class="search hidden-xs hidden-sm">
                                <input type="text" placeholder="Search" id="search">
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-4 g-0">
                            <div class="header-rightside">  
                                <ul class="list-inline header-top">
                                    <li class="hidden-xs"><a href="#" class="new-visitor" data-bs-toggle="modal" data-bs-target="#new-visitor">Add Visitor</a></li>

                                </ul>
                            </div>
                        </div>
                    </header>
                </div>
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
	            @endif

            <div class="row row-no-gutters">
                <div class="user-dashboard">
                    <div class="col-md-7 col-sm-7 col-xs-6">
                        <h1>Today's Visitors</h1>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-6 gutter">

                        <div class="visitors">
                            <h2>Filter By</h2>
                            <div class="btn-group">
                                <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span>Date:</span>
                                </button>
                                <div class="dropdown-menu">
                                    <input class="form-control" type="date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped" id="visitors_table">
                            <thead class="thead-inverse">
                                <tr>
                                        <th>Visitor Name</th>
                                        <th>Country Code</th>
                                        <th>Phone Number</th>
                                        <th>ID Number</th>
                                        <th>Date In</th>
                                        <th>Time In</th>
                                        <th>Host </th>
                                        <th>Office</th>
                                        <th>Timeout</th>
                                        <th>Status</th>
                                        <th>Action</th>>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($visitors as $visitor)
                                <tr>
                                    <td>{{$visitor ['visitor_name']}}</td>
                                    <td>{{$visitor ['visitor_country_code']}}</td>
                                    <td>{{$visitor ['visitor_phone_number']}}</td>
                                    <td>{{$visitor ['visitor_id_number']}}</td>
                                    <td>{{$visitor ['visit_date']}}</td>
                                    <td>{{$visitor ['time_in']}}</td>
                                    <td>{{$visitor ['userName']}}</td>
                                    <td>{{$visitor ['badgeNumber']}}</td>
                                    <td>{{$visitor ['time_out']}}</td>
                                    <td>{{$visitor ['visitor_status']}}</td>

                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
             </div>
            </div>
        </div>

    <!-- Modal -->
    <div id="new-visitor" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="booking-form"> 
                    <div class="form-header"> 
                        <h1>New Check In</h1> 
                    </div> 
                    <form method="POST" action="{{ route('visitor.add_validation') }}"> 
                        @csrf
                        <div class="form-group"> 
                        <input type="text" name="visitor_name" class="form-control" placeholder="Visitor Name" />
                        <span class="form-label">Name</span>
		        		@if($errors->has('visitor_name'))
		        			<span class="text-danger">{{ $errors->first('visitor_name') }}</span>
		        		@endif
                             
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
                        <div class="col-md-6">
                                <div class="form-group"> 
                                    <input class="form-control" type="tel" name="visitor_country_code" placeholder="Enter Country Code">
                                        <span class="form-label">Country Code</span>
                                        @if($errors->has('visitor_country_code'))
		        			                <span class="text-danger">{{ $errors->first('visitor_country_code') }}</span>
		        		                @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <input class="form-control" type="tel" name="visitor_phone_number" placeholder="Enter Phone Number">
                                        <span class="form-label">Phone</span>
                                        @if($errors->has('visitor_phone_number'))
		        			                <span class="text-danger">{{ $errors->first('visitor_phone_number') }}</span>
		        		                @endif
                                </div>
                            </div>
                        </div>
                             <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <input class="form-control" type="id" name="visitor_id_number" placeholder="Enter ID Number">
                                            <span class="form-label">ID Number</span>
                                            @if($errors->has('visitor_id_number'))
		        			                <span class="text-danger">{{ $errors->first('visitor_id_number') }}</span>
		        		                    @endif
                                    </div>
                                </div>
                                <div class="col-md-6"> 
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
                                        <div class="form-group"> 
                                        <select id="user_id" class="form-control" required>
                                            @foreach ($userList as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                                <span class="select-arrow"></span>
                                                <span class="form-label">Host</span> 
                                        </div> 
                                    </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <select id="badge_id" class="form-control" required>
                                                @foreach ($badgeList as $item)
                                                    <option value="{{$item->id}}">{{$item->badge_number}}</option>
                                                @endforeach
                                        </select>
                                                <span class="select-arrow"></span>
                                                    <span class="form-label">Badge</span> 
                                            </div> 
                                        </div>
                                </div>-->
                                <div class="form-btn">
                                    <button class="submit-btn">Book Now</button>
                                </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
   <!--Badge Modal-->

   <div class="modal fade" id="badge" tabindex="-1" aria-labelledby="badgeLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="badgeLabel">Assign Badge</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <select class="form-control" required>
                        <option value="" selected hidden>Assign Badge</option> 
                            <option>1</option> 
                            <option>2</option> 
                            <option>3</option> 
                    </select> 
                </div> 
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Confirm</button>
        </div>
      </div>
    </div>
  </div>
    <!--Checkout Modal-->

  <div class="modal fade" id="checkout" tabindex="-1" aria-labelledby="checkoutLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="checkoutLabel">Checkout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to checkout visitor?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Checkout</button>
        </div>
      </div>
    </div>
  </div>
  <!--<script>

    $(document).ready(function(){

        var table = $('#visitors_table').DataTable({

            processing:true,
            serverSide:true,
            ajax:"{{ route('visitors.fetchall') }}",
            columns:[
                {
                    data:'visitor_name',
                    name: 'visitor_name'
                }
                {
                    data: 'visitor_email',
                    name: 'visitor_email'
                }
                {
                    data: 'visitor_id_number',
                    name: 'visitor_id_number'
                }
                {
                    data: 'visitor_country_code',
                    name: 'visitor_country_code'
                }
                {
                    data: 'visitor_phone_number',
                    name: 'visitor_phone_number'
                }
                {
                    data: 'visit_date',
                    name: 'visit_date'
                }
                {
                    data:'time_in',
                    name: 'time_in'
                }
                {
                    data: 'time_out',
                    name: 'time_out'
                }
                {
                    data:'visitor_status',
                    name: 'visitor_status'
                }
                {
                    data: 'action',
                    name: 'action',
                    orderable:false
                }
            ]
        });
    });
  </script>-->


@endsection