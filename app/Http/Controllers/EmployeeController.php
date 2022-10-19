<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Office;
use App\Models\Court;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display the employee index page for the user.
     *
     */
    public function index()
    {
        $employees = Employee::with(['department', 'office', 'role'])->get();
        $departments = Department::all();
        return view('employees.index', compact('employees', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $offices = Office::all();
        $roles = Role::all();
        return view('employees._form', compact('departments','offices','roles'));
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->user()->id;
        $data['updated_by'] = auth()->user()->id;
        
        /*if($request->file('avatar')):
            $fileName = time().$request->file('avatar')->getClientOriginalName();
            $path = $request->file('avatar')->storeAs('avatars', $fileName, 'public');
            $data['avatar'] = '/storage/'.$path;
        endif;*/

        Employee::create($data);

        return redirect()->back();
    }

    public function show($id)
    {
    }
}
