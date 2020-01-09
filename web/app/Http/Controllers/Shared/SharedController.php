<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Constant;

class SharedController extends Controller
{
    public function home()
    {
    	if(auth()->user() && auth()->user()->role == Constant::USER_ROLES['admin']) {
            return redirect()->route('admin.dashboard', ['currentScholarYear' => config('scholaryear.current_scholar_year')]);
        } elseif(auth()->user() && auth()->user()->role == Constant::USER_ROLES['teacher']) {
            return redirect()->route('teacher.dashboard', ['currentScholarYear' => config('scholaryear.current_scholar_year')]);
        } elseif(auth()->user() && auth()->user()->role == Constant::USER_ROLES['student']) {
            return redirect()->route('student.dashboard', ['currentScholarYear' => config('scholaryear.current_scholar_year')]);
        } else {
            abort(403);
        }
    }

    public function profile()
    {
        switch (auth()->user()->role) {
            case Constant::USER_ROLES['student']:
                return view('student.pages.profile', [
                    'student' => auth()->user()->student
                ]);
            break;

            case Constant::USER_ROLES['teacher']:
                return view('teacher.pages.profile', [
                    'teacher' => auth()->user()->teacher
                ]);
            break;

            case Constant::USER_ROLES['admin']:
                return view('admin.pages.profile', [
                    'admin' => auth()->user()
                ]);
            break;
            
            default:
                abort(403);
            break;
        }
    }
}
