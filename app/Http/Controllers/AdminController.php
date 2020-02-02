<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function test() {
        return 'you are Admin';
    }

    public function teacher() {
        return 'teacher';
    }

    public function student() {
        return 'student';
    }
}
