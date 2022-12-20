<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;
use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Court;
use App\Models\Visitor;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SelfcheckinController extends Controller
{
    public function index()
    {
        return view('selfcheckin.index');
    }

    public function appointment()
    {   $employees = DB::table('employees')->orderBy('name', 'ASC')->get();
        $departments = DB::table('departments')->orderBy('department_name', 'ASC')->get();
        return view('selfcheckin.appointment', compact('departments', 'employees'));
    }

    public function getemployees(Request $request) {
        $data = Employee::select('name', 'id')->where('department_id', $request->id)->get();

        return response()->json($data);
       
    }
    public function checkin()
    {
        $appointments = DB::table('appointments')->get();

        return view('selfcheckin.checkin', compact('appointments'));

    }

    public function checkout()
    {
        $badges = DB::table('badges')->get();

        return view('selfcheckin.checkout', compact('badges'));

    }

    public function return()
    {
        $visitors = DB::table('visitors')->orderBy('visitor_name', 'ASC')->get();

        return view('selfcheckin.return_visitor', compact('visitors'));

    }
    public function searchappointment(Request $request)
    {
        $data = Appointment::where('app_no', 'LIKE', '%'. $request->get('query'). '%')
                    ->get();
     
        return response()->json($data);
    }

}
