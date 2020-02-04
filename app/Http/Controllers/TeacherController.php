<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Teacher;
use App\Tutorial;
use App\Category;

class TeacherController extends Controller
{
    //

    public function beTeacher()
    {
        $user = Auth::user();

        return view('teacher.teacher_req', compact('user'));
    }

    public function request(Request $request)
    {
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

    public function profile()
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();
        
        return view('teacher.profile', compact('teacher'));
    }

    public function profileEdit(Request $request)
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();

        $user->name = $request->name;
        $teacher->name = $request->name;
        $teacher->expert = $request->expert;
        $teacher->about = $request->about;

        $user->save();
        $teacher->save();

        return redirect('/home')->with('success', 'profile updated successfully');
    }

    public function tutorial()
    {
        $user = Auth::user();
        $tutorials = Tutorial::where('user_id', $user->id)->get();
        return view('teacher.tutorial', compact('tutorials'));
    }

    public function createNewTutorial()
    {
        $categories = Category::pluck('name', 'id')->all();
        return view('teacher.create_new_tutorial', compact('categories'));
    }

    public function save(Request $request)
    {
        $user = Auth::user();
        $tutorial = new Tutorial;
        
        $file = $request->file('cover');
        $cover_image_name = time() . '_' . $file->getClientOriginalName();
        $file->move('image/tutorial', $cover_image_name);

        $tutorial->user_id = $user->id;
        $tutorial->category_id = $request->category;
        $tutorial->title = $request->title;
        $tutorial->cover_image =  $cover_image_name;
        $tutorial->link = 'image/tutorial' . $cover_image_name;
        $tutorial->description = $request->desc;

        $tutorial->save();

        return redirect('teacher-tutorial')->with('success', 'New Tutorial Created');
    }

    public function publish($id)
    {
        $tutorial = Tutorial::findOrFail($id);
        $tutorial->status = 'pending';

        $tutorial->save();

        return redirect()->back()->with('info', 'tutorial submitted for publication');
    }
}
