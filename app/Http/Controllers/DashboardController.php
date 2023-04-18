<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Visitor;
use App\Models\Visit;

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
        $checkin = Visit::where('visitor_status', 'In')->count();
        $checkout = Visit::where('visitor_status', 'Out')->count();
        return view('dashboard', compact('visitors', 'appointments', 'checkin', 'checkout'));

    }
    
}
