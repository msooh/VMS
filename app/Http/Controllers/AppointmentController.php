<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;
use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Court;
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
        $appointments = Appointment::with(['employee', 'department'])->get();
        $employees = DB::table('employees')->orderBy('name', 'ASC')->get();
        $departments = DB::table('departments')->orderBy('department_name', 'ASC')->get();

    
        return view('appointments.index', compact('appointments', 'employees', 'departments'));
    }
   

    public function getemployees(Request $request) {
        $data = Employee::select('name', 'id')->where('department_id', $request->id)->get();

        return response()->json($data);
       
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
        $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'id_number' => 'required',
        'phone_number' => 'required',
        'department_id' => 'required',
        'employee_id' => 'required',
        'appointment_date' => 'required',
        'expected_time' => 'required',
        
    ]);
        $id = UniqueIdGenerator::generate(['table' => 'appointments', 'field'=>'app_no', 'length' => 14, 'prefix' =>'APN-', 'suffix' =>date('ymd')]);

         
        $data = $request->all();
        $data['app_no'] = $id;
        $data['created_by'] = auth()->user()->id;
        $data['updated_by'] = auth()->user()->id;

        Appointment::create($data);

        return redirect()->back();
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
    
 
}
