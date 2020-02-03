<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    //
    public function profile() {
        return view('student.profile');
    }

    public function profileEdit(Request $request) {
        $user = Auth::user();

        $user->name = $request->name;
        $user->save();

        return redirect('/home')->with('success', 'Your profile updated');
    }
}
