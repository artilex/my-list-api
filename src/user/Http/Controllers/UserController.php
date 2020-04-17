<?php

namespace User\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function detail(Request $request)
    {
        return $request->user();
    }
}
