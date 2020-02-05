<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tutorial;
use App\Video;
use App\Enrole;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tutorials = Tutorial::where('status', 'published')->paginate(5);
        return view('home', compact('tutorials'));
    }

    public function tutorialDetails($id)
    {
        $tutorial = Tutorial::findOrFail($id);
        $videos = Video::where('tutorial_id', $id)->paginate(5);
        $enrole = Enrole::where([['tutorial_id', $id], ['user_id', Auth::user()->id]])->first();
        $owner = Tutorial::where('user_id', Auth::user()->id)->first();

        //return $enrole;

        return view('tutorial_details', compact('tutorial', 'videos', 'enrole', 'owner'));
    }

    public function purchase($id)
    {
        $user = Auth::user();
        return view('purchase', compact('id', 'user'));
    }

    public function purchaseNenrole(Request $request)
    {
        if (Auth::user()->role_id == 3) {
            return redirect('/home')->with('danger', 'You are an Admin!');
        } else {
            $tutorial_id = $request->tutorial_id;
            $user_id = $request->user_id;

            

            $enrole = new Enrole;

            $enrole->user_id = $user_id;
            $enrole->tutorial_id = $tutorial_id;

            $enrole->save();

            return redirect('/home')->with('success', 'Successfully Purchased & Enroled');

        }
    }

    public function enroleTutorial() {
        $enroles = Enrole::select('tutorial_id')->where('user_id', Auth::user()->id)->get();
        $i=0;
        foreach($enroles as $enrole) {
            $value[$i++] = $enrole->tutorial_id;
        }

       

        $tutorials = Tutorial::find($value);

      //return gettype($tutorials);
       return view('enrole_tutorial', compact('tutorials', 'enroles'));
      
    }
}
