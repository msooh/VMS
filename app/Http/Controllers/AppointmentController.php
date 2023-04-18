<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;
use App\Models\Appointment;
use App\Models\Visitor;
use App\Models\Visit;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Court;
use App\Models\Badge;
use DataTables;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
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
        $appointments = Appointment::with(['visitor', 'employee', 'department'])->get();
        $employees = DB::table('employees')->orderBy('name', 'ASC')->get();
        $departments = DB::table('departments')->orderBy('department_name', 'ASC')->get();
        $badges = Badge::all();
        $visitReasons = ['Meeting', 'Event', 'Consultation', 'Delivery', 'Other'];

    
        return view('appointments.index', compact( 'visitReasons', 'appointments', 'employees', 'departments', 'badges'));
    }
   

    public function getemployees(Request $request) {
        $data = Employee::select('name', 'id')->where('department_id', $request->id)->get();

        return response()->json($data);
       
    }
    public function getStaffByDepartment($departmentId)
    {
        $employee = Employee::where('department_id', $departmentId)->pluck('name', 'id');
        return response()->json($employee);
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'visitor_name' => 'required|string',
        'visitor_email' => 'required|email|unique:visitors',
        'visitor_id_number' => 'required|unique:visitors',
        'visitor_phone_number' => 'required|string',
        'department_id' => 'required',
        'employee_id' => 'required',
        'appointment_date' => 'required',
        'expected_time' => 'required',
        
    ]);
    $visitor = Visitor::create([
        'visitor_name' => $validatedData['visitor_name'],
        'visitor_email' => $validatedData['visitor_email'],
        'visitor_id_number' => $validatedData['visitor_id_number'],
        'visitor_phone_number' => $validatedData['visitor_phone_number'],
        'created_by' => auth()->user()->id,
        'updated_by' => auth()->user()->id,
    ]);
        $id = UniqueIdGenerator::generate(['table' => 'appointments', 'field'=>'app_no', 'length' => 14, 'prefix' =>'APN-', 'suffix' =>date('ymd')]);
        $appointment = Appointment::create([
            'visitor_id' => $visitor->id,
            'department_id' => $request->department_id,
            'employee_id' => $request->employee_id,
            'appointment_date' => $request->appointment_date,
            'expected_time' => $request->expected_time,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
            'app_no' => $id,
        ]);


        return redirect()->back()->with('success', 'Appointment successfully Added');
    }

    public function approve(int $id)
    {
        $appointments = Appointment::with(['employee', 'department'])->get();

        
        DB::table('appointments')
        ->where(['id' => $id])
         ->update(['appointment_status' => 'Approved']);

       

         return redirect()->back();

    }
    public function reject(int $id)
    {
        $appointments = Appointment::with(['employee', 'department'])->get();

        
        DB::table('appointments')
        ->where(['id' => $id])
         ->update(['appointment_status' => 'Rejected']);

       

         return redirect()->back();

    }
    public function checkin(Request $request, int $id)
    {
        $appointments = Appointment::with(['employee', 'department'])->get();
        // Validate the form data
        $request->validate([
            'badge_id' => 'required',
        ]);

        // Find the appointment
        $appointment = Appointment::with('visitor')->findOrFail($id);
        $number = UniqueIdGenerator::generate(['table' => 'visits', 'field'=>'visit_no', 'length' => 14, 'prefix' =>'VST-', 'suffix' =>date('ymd')]);
        // Create a new visit instance with the form data from the appointment
        $visit = Visit::create([
            'visitor_id' => $appointment->visitor_id,
            'department_id' => $appointment->department_id,
            'employee_id' => $appointment->employee_id,
            'badge_id' => $request->badge_id,
            'visit_reason' => $appointment->visit_reason,
            'appointment_id' => $appointment->id,
            'visit_date' => Carbon::now()->tz('Africa/Nairobi')->toDateTimeString(),
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
            'visit_no' => $number,
        ]);

        DB::table('appointments')
        ->where(['id' => $id])
         ->update(['appointment_status' => 'CheckedIn']);

        // Redirect back to the appointments index view with a success message
        return redirect()->route('appointments.index')->with('success', 'Visitor has been checked in.');

    }
    
    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        $employees = DB::table('employees')->orderBy('name', 'ASC')->get();
        $departments = DB::table('departments')->orderBy('department_name', 'ASC')->get();
        return view('appointments.edit', compact('appointment', 'employees', 'departments'));
    }
    public function update(Request $request, Appointment $appointment){
        
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'id_number' => 'required',
            'department_id' => 'required',
            'employee_id' => 'required',
            'appointment_date' => 'required',
            'expected_time' => 'required',
            
        ]);
        $appointment->update($validated);
        
        return redirect()->route('appointments.index')->with('success', 'Details successfully updated');

    }
    public function date(Request $request, $id)
    {
        // Find the appointment
        $appointment = Appointment::findOrFail($id);

        // Update the appointment date field
        $appointment->{$request->input('field')} = $request->input('value');

        // Save the appointment
        $appointment->save();

        // Return success response
        return response()->json('Appointment date updated successfully');
    }

    
 
}
