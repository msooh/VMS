<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Visitor;

use DataTables;

use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
    }

    function index()
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
    }
}
