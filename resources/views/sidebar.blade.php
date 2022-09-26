@extends('base')
@section('content')
<div class="container-fluid dashboard">   
        <div class="row dashboard-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="navi">
                    <ul>
                        <li class="active"><a href="{% url 'visitors' %}"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Visitors</span></a></li>
                        <li><a href="{% url 'apps' %}"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Appointments</span></a></li>
                        <li><a href="{% url 'reportpage' %}"><i class="fa fa-file" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Reports</span></a></li>
                        <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Setting</span></a></li>
                    </ul>
                </div>
            </div>
             <div class="col-md-10 col-sm-11 display-table-cell v-align">
                @yield('content')
             </div>
        </div>

    </div>