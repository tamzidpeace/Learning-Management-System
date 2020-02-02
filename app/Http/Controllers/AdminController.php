<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use app\user;

class AdminController extends Controller
{
    //

    public function dashboard() {
        return view('admin.dashboard');
    }

    public function users() {

        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function teachers() {

        $teachers = User::where('role_id', 2)->get();
        return view('admin.teachers', compact('teachers'));
    }

    public function students() {

        $students = User::where('role_id', 1)->get();
        return view('admin.students', compact('students'));
        
    }
}
