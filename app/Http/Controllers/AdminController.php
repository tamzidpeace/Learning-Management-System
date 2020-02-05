<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\Teacher;
use App\Category;
use App\Tutorial;
use App\Video;

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

    public function teacherReq() {
        $reqs = Teacher::where('status', 'pending')->get();
        return view('admin.teacher_req', compact('reqs'));
    }

    public function accept($id) {
        $req = Teacher::findOrFail($id);
        $user = User::findOrFail($req->user_id);

        $req->status = 'accepted';
        $user->role_id = '2';

        $req->save();
        $user->save();

        return redirect()->back()->with('success', 'New Teacher Added');

    }

    public function reject($id) {
        $req = Teacher::findOrFail($id);

        $req->delete();
        
        return redirect()->back()->with('info', 'Request Deleted');
    }

    public function students() {

        $students = User::where('role_id', 1)->get();
        return view('admin.students', compact('students'));
        
    }

    public function category() {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    public function addCategory(Request $request) {
        
        $cate = new Category;
        $cate->name = $request->name;
        $cate->save();

        return redirect()->back()->with('info', 'category added!');
    }

    public function pendingTutorials() {

        $pts = Tutorial::where('status', 'pending')->get();

        return view('admin.pending_tutorial', compact('pts'));
    }

    public function tutorialDetails($id) {
        $pt = Tutorial::findOrFail($id);
        $videos = Video::where('tutorial_id', $id)->paginate(5);
        return view('admin.tutorial_details', compact('pt', 'videos'));
    }

    public function publish($id)
    {
        $tutorial = Tutorial::findOrFail($id);
        $tutorial->status = 'published';

        $tutorial->save();

        return redirect('/admin/tutorial/pending')->with('info', 'tutorial published');
    }
}