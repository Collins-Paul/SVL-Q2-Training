<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|unique:user',
            'phone' => 'required|numeric',
            'gender' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => false,
                'message' => "Validation Failed",
                'errors' => $errors,
            ], 422);
        }

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => "New User Created",
        ], 200);
    }

    public function index() {
        $users = User::get();
        if($users->count() > 0) {
            return response()->json([
                'status' => true,
                'message' => "All user gotten",
                'data' => $users
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => "No user found"
            ], 422);
        }
    }
}
