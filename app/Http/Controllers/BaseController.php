<?php

namespace App\Http\Controllers;

use App\Services\PostService;

class BaseController extends Controller
{
    public function __construct( public PostService $service )
    {
    }
}
