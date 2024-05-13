<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        //dd("Listar");
        return view('courses.index');
    }
    public function create()
    {
        //dd("Listar");
        return view('courses.create');
    }
    public function show()
    {
        //dd("Listar");
        return view('courses.show');
    }
    public function edit()
    {
        //dd("Listar");
        return view('courses.edit');
    }
}
