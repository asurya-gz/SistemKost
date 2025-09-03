<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeKamar;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function index()
    {
        $typeKamars = TypeKamar::all();
        $galleries = Gallery::all();
        
        return view('home', compact('typeKamars', 'galleries'));
    }
}
