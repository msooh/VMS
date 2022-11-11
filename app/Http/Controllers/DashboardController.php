<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Visitor;

class DashboardController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
    }
     /**
     * Display the visitor index page.
     *
     */
    public function index()
    {
        $visitors = Visitor::count();
        $appointments = Appointment::count();
        $checkin = Visitor::where('visitor_status', 'In')->count();
        $checkout = Visitor::where('visitor_status', 'Out')->count();
        return view('dashboard', compact('visitors', 'appointments', 'checkin', 'checkout'));

    }
    
}
