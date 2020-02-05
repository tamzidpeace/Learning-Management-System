<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\Teacher;
use App\Category;
use App\Tutorial;
use App\Video;
use App\Enrole;
use App\Assign;
use DB;

class AdminController extends Controller
{
    //

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function teachers()
    {
        $teachers = User::where('role_id', 2)->get();
        return view('admin.teachers', compact('teachers'));
    }

    public function teacherReq()
    {
        $reqs = Teacher::where('status', 'pending')->get();
        return view('admin.teacher_req', compact('reqs'));
    }

    public function accept($id)
    {
        $req = Teacher::findOrFail($id);
        $user = User::findOrFail($req->user_id);

        $req->status = 'accepted';
        $user->role_id = '2';

        $req->save();
        $user->save();

        return redirect()->back()->with('success', 'New Teacher Added');
    }

    public function reject($id)
    {
        $req = Teacher::findOrFail($id);

        $req->delete();
        
        return redirect()->back()->with('info', 'Request Deleted');
    }

    public function students()
    {
        $students = User::where('role_id', 1)->get();
        return view('admin.students', compact('students'));
    }

    public function category()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    public function addCategory(Request $request)
    {
        $cate = new Category;
        $cate->name = $request->name;
        $cate->save();

        return redirect()->back()->with('info', 'category added!');
    }

    public function pendingTutorials()
    {
        $pts = Tutorial::where('status', 'pending')->get();

        return view('admin.pending_tutorial', compact('pts'));
    }

    public function tutorialDetails($id)
    {
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

    public function publishedTutorials()
    {
        $pts = Tutorial::where('status', 'published')->get();

        return view('admin.published_tutorials', compact('pts'));
    }

    public function deleteVideo($id)
    {
        $video = Video::findOrFail($id);

        $video->delete();

        return redirect()->back()->with('info', 'deleted');
    }

    public function allTutorials()
    {
        $tutorials = Tutorial::all();
        return view('admin.all_tutorials', compact('tutorials'));
    }

    public function deleteTutorial($id)
    {
        $tutorial = Tutorial::findOrFail($id);

        $tutorial->delete();

        return redirect()->back()->with('info', 'deleted');
    }

    public function enrolledStudents($id)
    {
        $enroles = Enrole::where('tutorial_id', $id)->get();
        $tutorial = Tutorial::find($id);

        $i = 0;

        $val = [];

        foreach ($enroles as $enrole) {
            $val[$i++] = $enrole->user_id;
        }

        $students = User::find($val);

        return view('admin.enroled_students', compact('students', 'tutorial'));
    }

    public function assignTutorial(Request $request)
    {
        $user_id = $request->user_id;
        $tutorial_id = $request->tutorial_id;

        $assign = new Assign;

        $assign->user_id = $user_id;
        $assign->tutorial_id = $tutorial_id;

        //return $request;
        $check = Assign::where([['user_id', $request->user_id], ['tutorial_id', $request->tutorial_id]])->first();

        if ($check) {
            return  redirect()->back()->with('warning', 'tutorial already assigned');
        } else {
            $assign->save();
            return redirect()->back()->with('success', 'tutorial assigned');
        }
    }

    public function groupAssign(Request $request)
    {
        $id = $request->tutorial_id;
        $enroles = Enrole::where('tutorial_id', $id)->get();
        $tutorial = Tutorial::find($id);

        $i = 0;

        $val = [];

        foreach ($enroles as $enrole) {
            $val[$i++] = $enrole->user_id;
        }

        $students = User::find($val);
        
        return view('admin.group_assign', compact('request', 'students', 'id'));
    }

    public function assignTutorialSave(Request $request)
    {
        $users = $request->present;
        $tutorial_id = $request->id;

        $assign = new Assign;

        // for ($i=0; $i<count($user); $i++) {
  
        //      $assign->user_id = $user[$i];
        //      $assign->tutorial_id = $tutorial_id;
        //      $assign->save();
           
        // }

        foreach ($users as $user) {
            $data[] = ['user_id'=> $user,
                      'tutorial_id'=>$request->id];
        }

        DB::table('assigns')->insert($data);
        

        return redirect('/admin/tutorial/enroled-students/' . $request->id)->with('success', 'tutorial assigned');
    }
}
