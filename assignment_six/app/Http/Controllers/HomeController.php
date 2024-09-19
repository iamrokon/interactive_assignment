<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $works = File::json(database_path('data/works.json'));
        $sliders = File::json(database_path('data/sliders.json'));
        $experiences = File::json(database_path('data/experiences.json'));
        $expertises = File::json(database_path('data/expertises.json'));
        // dd($works);
        return view('home',compact('works','sliders','experiences','expertises'));
    }
}
