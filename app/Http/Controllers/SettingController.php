<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\Court;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display the Court index page for the user.
     *
     */
    public function indexCourt()
    {
        $courts = Court::all();
        return view('settings.court', compact('courts'));
    }
    /**
     * Display the role index page for the user.
     *
     */
    public function indexRole()
    {
        $roles = Role::all();
        return view('settings.role', compact('roles'));
    }

    /**
     * Display the department index page for the user.
     *
     */
    public function indexDepartment()
    {
        $departments = Department::all();
        return view('settings.department', compact('departments'));
    }
    public function storeCourt(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->user()->id;
        $data['updated_by'] = auth()->user()->id;
        Court::create($data);

        return redirect()->back();
    }

    public function storeRole(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->user()->id;
        $data['updated_by'] = auth()->user()->id;
        Role::create($data);

        return redirect()->back();
    }

    public function storeDepartment(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->user()->id;
        $data['updated_by'] = auth()->user()->id;
        Department::create($data);

        return redirect()->back();
    }
}
