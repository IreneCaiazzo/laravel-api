<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        //chiamata al db
        $projects = Project::with('type', 'technologies')->paginate(5);

        //il metodo json ci dà come risposta la lista dei progetti in formato json e non html
        return response()->json($projects);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return response()->json($project);
    }
}
