<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Employee;
use App\Models\Office;
use App\Models\Court;
use App\Models\Appointment;
use App\Models\Badge;
use App\Models\User;

use DataTables;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function visitors()
    {
        $visitors = Visitor::with(['employee', 'badge'])->get();
        $employees = Employee::all();
        $appointments = Appointment::all();
        $departments = DB::table('departments')->orderBy('department_name', 'ASC')->get();
        $offices = Office::all();
        $badges = Badge::all();
    
        return view('reports.visitors', compact('visitors', 'employees', 'departments', 'offices', 'badges'));
    }
}
