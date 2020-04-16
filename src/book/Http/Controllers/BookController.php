<?php

namespace Book\Http\Controllers;

use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function getFromOzon()
    {
        $test = 'Hello world';

        return $test;
    }
}
