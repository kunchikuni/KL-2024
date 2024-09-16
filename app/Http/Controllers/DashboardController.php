<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;

class DashboardController extends Controller
{
    public function index(){
        $album = Album::latest()->with(['images']);
        return view('index', ['album' => $album]); 
    }
}
