<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use App\Models\Visitor;

use App\Models\Employee;
use App\Models\Office;
use App\Models\Court;
use App\Models\Appointment;

use App\Models\Badge;

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
        $visitors = Visitor::with(['employee', 'badge'])->get();
        $employees = Employee::all();
        $appointments = Appointment::all();
        $departments = DB::table('departments')->orderBy('department_name', 'ASC')->get();
        $offices = Office::all();
        $badges = Badge::all();
    
        return view('visitors.index', compact('visitors', 'employees', 'departments', 'offices', 'badges'));
    }

    public function getoffices(Request $request) {
        $data = Office::select('office_name', 'id')->where('department_id', $request->id)->get();

        return response()->json($data);
       
    }
    public function getemployees(Request $request) {
        $data = Employee::select('name', 'id')->where('office_id', $request->id)->get();

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
        'visitor_name' => 'required',
        'visitor_email' => 'required|email',
        'visitor_id_number' => 'required|unique:visitors',
        'visitor_phone_number' => 'required',
        'department_id' => 'required',
        
    ]);
 
        $data = $request->all();
        $data['created_by'] = auth()->user()->id;
        $data['updated_by'] = auth()->user()->id;
        $data['visit_date'] = Carbon::today()->toDateString();
        $data['time_in'] = Carbon::now()->tz('Africa/Nairobi')->toTimeString();

        
        
        if($request->file('avatar')):
            $fileName = time().$request->file('avatar')->getClientOriginalName();
            $path = $request->file('avatar')->storeAs('avatars', $fileName, 'public');
            $data['avatar'] = '/storage/'.$path;
        endif;
    

        Visitor::create($data);
        $data = Badge::select('badge_number', 'id')
        ->where('id', $request->badge_id)
         ->update([ 'badge_status' => 'assigned']);

        return redirect()->back();
    }
    public function checkout(int $id)
    {
        $visitors = Visitor::with(['employee', 'badge'])->get();
        $date = Carbon::now()->tz('Africa/Nairobi');
        $badges = Badge::all();

        
        DB::table('visitors')
        ->where(['id' => $id])
         ->update(['time_out' => $date->toDateTimeString(), 'visitor_status' => 'Out']);
         foreach ($visitors as $visitor){
            DB::table('badges')
            ->where(['id' => $visitor->badge_id ])
            ->update([ 'badge_status' => 'unassigned']);

         }  

         return redirect()->back();

    }
 


    }

    /*
    function fetch_all(Request $request)
    {
        if($request->ajax())
        {
            $query = Visitor::join('users', 'user.id', '=', 'visitors.visitor_entry_by');

            if(Auth::user()->type == 'User')
            {
                $query->where('visitors.visitor_entry_by', '=', Auth::user()->id);
            }

            $data = $query->query->get(['visitors.visitor_fname', 'visitor_lname', 'visitor_email', 'visitor_id_number', 'visitor_country_code',  'visitor_phone_number', 'visit_date', 'time_in', 'time_out', 'visitor_status', 'users.name', 'visitors.id']);

            return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('visitor_status', function($row){
                if($row->visitor_status == 'In')
                {
                    return '<span class="badge bg-success">In</span>' ;
                }
                else
                {
                    return '<span class="badge bg-danger">Out</span>';

                }
            })
            ->escapeColumns('visitor_status')
            ->addcolumn('action', function($row){
                if($row->visitor_status == 'In')
                {
                    return '<a href="/visitor/view/' .$row->id. '" class="btn btn-info btn-sm">View</a>&nbsp;<a href="/visitor/edit/'.$row->id. '" class="btn btn-primary btn-sm">CheckIn</a>&nbsp;
                    <button type="button" class="btn btn-danger btn-sm delete" data-id="' .$row->id. '">Delete</button>
                    ';
                }
                else
                {
                    return '<a href="/visitor/view/' .$row->id. '" class="btn btn-info btn-sm">View</a>&nbsp;
                    <button type="button" class="btn btn-danger btn-sm delete" data-id="' .$row->id. '">Delete</button>
                    ';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }*/
