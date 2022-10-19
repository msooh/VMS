<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Visitor;

use App\Models\User;

use App\Models\Badge;

use DataTables;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    /*public function _construct()
    {
        $this->middleware('auth');
    }*/

    function index()
    {
        $data = Visitor::all();
        $userList = User::select('id', 'name')->get();
        $badgeList = Badge::select('id', 'badge_number')->get();
        $visitors = DB::table ('visitors')
                    ->select('visitors.*', 'users.name as userName', 'badges.badge_number as badgeNumber')
                    ->leftJoin('users', 'users.id', 'visitors.user_id')
                    ->leftJoin('badges', 'badges.id', 'visitors.badge_id')
                    ->get();

          
        return view('visitors', ['visitors' => $data], ['visitors' => $visitors],  compact ('userList', 'badgeList') );
    }

    function add_validation(Request $request)
    {
        $request->validate([
            'visitor_name'       =>  'required',
            'visitor_email'      =>  'required',
            'visitor_id_number'  =>  'required',
            'visitor_country_code'=> 'required',
            'visitor_phone_number'=> 'required',
            'visit_date'          => 'required',
            'time_in'             => 'required',
            'time_out'            => 'required',
          
        ]);

        //$data = $request->all();
        //$time_in = Carbon::now();

        Visitor::create([

            'visitor_name'          =>  request('visitor_name'),
            'visitor_email'         =>  request('visitor_email'),
            'visitor_id_number'     =>  request('visitor_id_number'),
            'visitor_country_code'  =>  request('visitor_country_code'),
            'visitor_phone_number'  =>  request('visitor_phone_number'),
            'visit_date'            =>  request('visit_date'),
            'time_in'               =>  date("H:i:s", strtotime(request('time_in'))),
            'time_out'              =>  date("H:i:s", strtotime(request('time_out'))),
        ]);

        return redirect('visitors')->with('success', 'New Vistor Added');
    }

    /*function index()
    {
        return view('visitors');
    }
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
}
