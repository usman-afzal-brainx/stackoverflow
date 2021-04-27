<?php

namespace App\Http\Controllers;

use App\Models\UserType;

class UserTypeController extends Controller
{
    public function index()
    {
        $types = UserType::all();
        return response()->json(['userTypes' => [$types], 200], 200);
    }
}
