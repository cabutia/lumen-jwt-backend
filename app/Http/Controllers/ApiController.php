<?php

namespace App\Http\Controllers;

use \App\Student;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getAllStudents()
    {
      $students = Student::all();
      return response()->json($students);
    }
}
