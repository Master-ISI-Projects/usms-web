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
            $user = [
                'id' => $student->id,
                'firstName' => $student->user->first_name,
                'lastName' => $student->user->last_name,
                'classeId' => optional($student->currentClasse)->id ?? '##',
                'classeName' => optional($student->currentClasse)->name ?? '##',
                'token' => $token,
            ];

            return response()->json($user, 200);
        }

        return response()->json([
            'error' => 'Unauthorized'
        ], 401);
    }
}
