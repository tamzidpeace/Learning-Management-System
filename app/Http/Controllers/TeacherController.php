<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Teacher;

class TeacherController extends Controller
{
    //

    public function beTeacher() {

        $user = Auth::user();

        return view('teacher.teacher_req', compact('user'));
    }

    public function request(Request $request) {
        
        $user = Auth::user();

        $teacher = new Teacher();

        $teacher->user_id = $user->id;
        $teacher->name = $user->name;
        $teacher->email = $user->email;
        $teacher->expert = $request->expert;
        $teacher->about = $request->about;

        $teacher->save();

        return redirect('/home')->with('success', 'Your request has been submitted!');
    }
}
