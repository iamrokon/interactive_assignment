<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $works = File::json(database_path('data/works.json'));
        $sliders = File::json(database_path('data/sliders.json'));
        $experiences = File::json(database_path('data/experiences.json'));
        $expertises = File::json(database_path('data/expertises.json'));

        return view('project',compact('works','sliders','experiences','expertises'));
    }
    public function show($id){
        $works = File::json(database_path('data/works.json'));
        $work_detail = array_filter($works, function($work) use ($id){
            return $work['id'] == $id;
        });
        $work = array();
        foreach($work_detail as $work_detail_info){
            $work = $work_detail_info;
            break;
        }

        return view('project-detail', compact('work'));
    }
}
