@extends('selfcheckin.base')
<div class="container-fluid">
    <div class="container">
        <div class="header">
            <img src="{{ asset('assets/images/logo.png') }}">
        </div>
        <div class="homebuttons">
            <button type="button" class="btn btn-success"><span><a href="{{ route('selfcheckin.checkin') }}">Check In</a></span></button>
            <button type="button" class="btn btn-success"><span><a href="{{ route('selfcheckin.appointment') }}">Check Out</a></span></button>
            <button type="button" class="btn btn-success"><span><a href="{{ route('selfcheckin.appointment') }}">Book Appointment</a></span></button>
            <button type="button" class="btn btn-success"><span><a href="{{ route('selfcheckin.appointment') }}">Been Here Before</a></span></button>
        </div> 
    </div>
</div>