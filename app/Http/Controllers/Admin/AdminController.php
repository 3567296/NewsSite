<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $limit = 5;
    protected $uploadPath;

    /**
     * Create a new controller instance.
     *
     * @return \App\Http\Controllers\Admin\AdminController
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->uploadPath = public_path(config('cms.image.directory'));
    }
}