<?php

namespace App\Http\Controllers;

use Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;
use App\Notifications\Newvisitor;

use App\Models\Visit;
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

class VisitorController extends Controller
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
        $visits = Visit::with(['visitor', 'employee', 'badge'])->get();
        $employees = Employee::all();
        $appointments = Appointment::all();
        $departments = DB::table('departments')->orderBy('department_name', 'ASC')->get();
        $offices = Office::all();
        $badges = Badge::all();
        $visitReasons = ['Meeting', 'Event', 'Consultation', 'Delivery', 'Other'];
    
        return view('visitors.index', compact('visits', 'employees', 'departments', 'offices', 'badges', 'visitReasons'));
    }

    public function getoffices(Request $request) {
        $data = Office::select('office_name', 'id')->where('department_id', $request->id)->get();

        return response()->json($data);
       
    }
    public function getemployees(Request $request) {
        $data = Employee::select('name', 'id')->where('office_id', $request->id)->get();

        return response()->json($data);
       
    }
    
    public function getEmployeesByDepartment(Request $request)
{
    $departmentId = $request->get('department_id');
    $employees = Employee::whereHas('office', function($query) use ($departmentId) {
        $query->where('department_id', $departmentId);
    })->get();
    return response()->json($employees);
}




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\Request  $request
     * @return \Illuminate\Http\Response
     */
    
        // Create a new visitor record
        
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'visitor_name' => 'required|string',
            'visitor_email' => 'required|email|unique:visitors',
            'visitor_id_number' => 'required|unique:visitors',
            'visitor_phone_number' => 'required|string',
            'department_id' => 'required',
           
        ]);

    
        $visitor = Visitor::create([
            'visitor_name' => $validatedData['visitor_name'],
            'visitor_email' => $validatedData['visitor_email'],
            'visitor_id_number' => $validatedData['visitor_id_number'],
            'visitor_phone_number' => $validatedData['visitor_phone_number'],
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);
       
        $id = UniqueIdGenerator::generate(['table' => 'visits', 'field'=>'visit_no', 'length' => 14, 'prefix' =>'VST-', 'suffix' =>date('ymd')]);
        $visitReasons = ['Official', 'Non-official'];
        $visit = Visit::create([
            'visitor_id' => $visitor->id,
            'department_id' => $request->department_id,
            'employee_id' => $request->employee_id,
            'badge_id' => $request->badge_id,
            'visit_reason' => $request->visit_reason,
            'visit_date' => Carbon::now()->tz('Africa/Nairobi')->toDateTimeString(),
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
            'visit_no' => $id,
        ]);

    

        $visit = Badge::select('badge_number', 'id')
        ->where('id', $request->badge_id)
         ->update([ 'badge_status' => 'assigned']);

        

        return redirect()->back()->with('success', 'Visitor checked in successfully.')->with(compact('visitReasons'));
    }

    public function notify()
    {
        $user = User::first();
   
        $details = [
            'greeting' => 'Hi '.$user->name.',',
            'body' => 'You have a visitor.',
            'actionURL' => 'Click for more info',
            'thanks' => 'Thank you',
        ];
  
        Notification::send($user, new NewVisitor($details));
   
        dd('Notification sent!');

    }
    public function checkout(int $id)
    {
        $visits = Visit::with(['employee', 'badge'])->get();
        $date = Carbon::now()->tz('Africa/Nairobi');
        $badges = Badge::all();

        
        DB::table('visits')
        ->where(['id' => $id])
         ->update(['time_out' => $date->toDateTimeString(), 'visitor_status' => 'Out']);
         foreach ($visits as $visit){
            DB::table('badges')
            ->where(['id' => $visit->badge_id ])
            ->update([ 'badge_status' => 'unassigned']);

         }  

         return redirect()->back();

    }
    public function show(int $id)
    {
        $visits = Visitor::with(['visitor', 'employee', 'badge'])->get();
        $employees = Employee::all();
        $appointments = Appointment::all();
        $departments = Department::all();
        $offices = Office::all();
        $badges = Badge::all();


         return redirect()->back();

    }
 


    }

