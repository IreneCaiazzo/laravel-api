<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        //filtro risultati
        //gestione parametro q
        $searchString = $request->query('q', '');

        //chiamata al db
        $projects = Project::with('type', 'technologies')->where('title', 'LIKE', "%{$searchString}%")->paginate(6);

        //il metodo json ci dà come risposta la lista dei progetti in formato json e non html
        return response()->json([
            'success' => true,
            'results' => $projects,
        ]);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->first();

        return response()->json([
            'success' => $project ? true : false,
            'results' => $project,
        ]);
    }

    public function random()
    {
        $project = Project::inRandomOrder()->limit(9)->get();

        return response()->json([
            'success' => true,
            'results' => $project,
        ]);
    }
}
