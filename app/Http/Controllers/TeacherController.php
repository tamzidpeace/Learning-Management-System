<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Teacher;
use App\Tutorial;
use App\Category;
use App\Video;
use App\Section;

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
        $teacher->status = 'accepted';

        $user->role_id = 2;

        $teacher->save();

        $user->save();
        

        return redirect('/home')->with('success', 'Your are a Teacher now!');
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
        $tutorial->link = '/image/tutorial/' . $cover_image_name;
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

    public function details($id)
    {
        $tutorial = Tutorial::findOrFail($id);
        $videos = Video::where('tutorial_id', $id)->orderBy('section_id')->paginate(5);
        $sections = Section::where('tutorial_id', $id)->orderBy('serial_no')->get();

        return view('teacher.tutorial_details', compact('tutorial', 'videos', 'sections'));
    }

    public function sections($id)
    {
        $tutorial = Tutorial::findOrFail($id);

        $sections = Section::where('tutorial_id', $id)->orderBy('serial_no')->get();

        

        return view('teacher.section', compact('tutorial', 'sections'));
    }

    public function addSection(Request $request)
    {
        $name = $request->name;
        $serial = $request->serial;
        $tutorial_id = $request->tutorial_id;

        $section = new Section;

        $section->name = $name;
        $section->serial_no = $serial;
        $section->tutorial_id = $tutorial_id;

        $section->save();

        return redirect()->back()->with('success', 'New section added');
    }

    public function uploadVideo($id)
    {
        $tutorial = Tutorial::findOrFail($id);

        $sections = Section::where('tutorial_id', $id)->pluck('name', 'id')->all();

        // return $sections;

        return view('teacher.upload_video', compact('tutorial', 'sections'));
    }

    public function upload(Request $request, $id)
    {
        if ($request->file('video')) {
            $file = $request->file('video');

            $ext = $file->getClientOriginalName();
            $len = strlen($ext);
            $extention = $ext[$len-4] . $ext[$len-3] . $ext[$len-2] . $ext[$len-1];

            if ($extention == '.pdf' || $extention == '.txt') {
                $video_name = 'file';
                $file->move('file/tutorial', time() . '_' . $file->getClientOriginalName());
                $link = '/file/tutorial/'.time(). '_' .$ext;
            } else {
                $video_name = time() . '_' . $file->getClientOriginalName();
                $file->move('video/tutorial', $video_name);
                $link = '/video/tutorial/' . $video_name;
            }

        } else {
            $x = $request->video_link;
            //https://www.youtube.com/watch?v=bkyjiXSx6WE&t=3s
            $video_link = str_replace("watch?v=", "embed/", $x);
            $video_name = 'yt';
            $link = $video_link;
        }

         

        $video = new Video;

        $video->tutorial_id = $id;
        $video->section_id = $request->section;
        $video->name = $request->name;
        $video->video = $video_name;
        $video->link = $link;

        

        

        $video->save();

        if (Auth::user()->role_id == 2) {
            return redirect('/teacher/tutorials/details/' . $id)->with('success', 'uploaded');
        } else {
            return redirect('/admin/tutorial/details/' . $id)->with('success', 'uploaded');
        }
    }
}
