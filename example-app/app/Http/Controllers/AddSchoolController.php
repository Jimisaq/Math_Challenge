<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class AddSchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::all();
        return view('addschool',compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        //
    }

    public function storeSchool(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255',
            'representative_email' => 'required|email|max:255',
            'representative_name' => 'required|string|max:255',
        ]);

        School::create([
            'school_name' => $request->school_name,
            'district' => $request->district,
            'registration_number' => $request->registration_number,
            'representative_email' => $request->representative_email,
            'representative_name' => $request->representative_name,
        ]);



        return back()->with('success', 'School details uploaded successfully!');
    }
}
