<?php

namespace Book\Http\Controllers;

use Book\Services\GoogleBookService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $googleBookService;

    public function __construct(
        GoogleBookService $googleBookService
    ) {
        $this->googleBookService = $googleBookService;
    }

    public function find(Request $request)
    {
        return $this->googleBookService->getBooksByTitle($request->name, 0, 20, 'en');
    }
}
