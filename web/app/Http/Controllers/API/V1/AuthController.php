<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Http\Resources\API\V1\StudentResource;
use JWTAuth;

class AuthController extends Controller
{
    public function login()
    {
        $student = Student::with('user')
                            ->where('apogee_number', request()->apogee_number)
                            ->where('birth_date', request()->birth_date)
                            ->first();

        if($student && $token = JWTAuth::fromUser($student->user)) {
            return response()->json(StudentResource::make($student), 200);
        }

        return response()->json([
            'error' => 'Unauthorized'
        ], 401);
    }
}
