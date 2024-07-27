<?php

namespace App\Http\Controllers;

use App\Models\SchoolRepresentative;
use Illuminate\Http\Request;
use App\Models\School;

   class SchoolController extends Controller
   {


    public function create()
       {
           $schools=School::all();
           return view('/uploadschools', ['schools' => $schools]);

       }

       public function store(Request $request)
       {
           $request->validate([
               'school_name' => 'required|string|max:255',
               'district' => 'required|string|max:255',
               'registration_number' => 'required|string|max:255',
               'representative_email' => 'required|email|max:255',
               'representative_name' => 'required|string|max:255',
               'password' => 'required|string|min:6',
           ]);

           // Create School
           $school = School::create([
               'school_name' => $request->school_name,
               'district' => $request->district,
               'registration_number' => $request->registration_number,
           ]);

           // Create School Representative
           $representative = SchoolRepresentative::create([
               'school_reg_no' => $school->registration_number,
               'name' => $request->representative_name,
               'email' => $request->representative_email,
               'password' => hash('sha256', $request->password),
           ]);

           // Log school creation
           \Log::info('School created: ', $school->toArray());

           // Log representative creation
           \Log::info('School Representative created: ', $representative->toArray());

           return back()->with('success', 'School details uploaded successfully!');
       }
   }
