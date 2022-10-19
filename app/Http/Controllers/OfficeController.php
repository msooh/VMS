<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\Office;

use App\Models\Department;

use App\Models\Court;

use App\Models\User; 

use DataTables;

class OfficeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = Office::with(['department', 'court',])->get();
        return view('offices.index', compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
       
        $departments = Department::all();
        $courts = Court::all();
        return view('offices._form', compact('departments','courts',));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->user()->id;
        $data['updated_by'] = auth()->user()->id;

        Office::create($data);

        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office $office)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        //
    }
}
