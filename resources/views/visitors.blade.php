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
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Country Code</th>
                                        <th>Phone Number</th>
                                        <th>Identification</th>
                                        <th>Date In</th>
                                        <th>Time In</th>
                                        <th>Office</th>
                                        <th>Timeout</th>
                                        <th>Status</th>
                                        <th>Checkout</th>>
                                </tr>
                            </thead>
                            <tbody>
                              

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
                    <form> 
                        <div class="form-group"> 
                            <input class="form-control" type="text" placeholder="Visitor Name">
                             <span class="form-label">Name</span>
                        </div> 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <input class="form-control" type="email" placeholder="Enter Email Address"> 
                                    <span class="form-label">Email</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <input class="form-control" type="tel" placeholder="Enter Phone Number">
                                        <span class="form-label">Phone</span>
                                </div>
                            </div>
                        </div>
                             <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <input class="form-control" type="id" placeholder="Enter ID Number">
                                            <span class="form-label">ID Number</span>
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group"> 
                                        <input class="form-control" type="date" required> 
                                        <span class="form-label">Check In</span>
                                    </div> 
                                </div> 
                                </div>
                                <div class="row">
                                     <div class="col-md-6">
                                        <div class="form-group"> 
                                            <select class="form-control" required> 
                                                <option value="" selected hidden>Host</option>
                                                    <option>Newton Muraya</option>
                                                    <option>Moses Waweru</option>
                                                    <option>Faith Muthoni</option> 
                                                    </select>
                                                     <span class="select-arrow"></span>
                                                      <span class="form-label">Host</span> 
                                                    </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="form-control" required>
                                                    <option value="" selected hidden>Assign Badge</option> 
                                                        <option>1</option> 
                                                        <option>2</option> 
                                                        <option>3</option> 
                                                </select> 
                                                <span class="select-arrow"></span>
                                                    <span class="form-label">Badge</span> 
                                            </div> 
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
  <script>

    $(document).ready(function(){

        var table = $('#visitors_table').DataTable({

            processing:true,
            serverSide:true,
            ajax:"{{ route('visitors.fetchall') }}",
            columns:[
                {
                    data:'visitor_fname',
                    name: 'visitor_fname'
                }
                {
                    data: 'visitor_lname',
                    name: 'visitor_lname'
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
  </script>


@endsection