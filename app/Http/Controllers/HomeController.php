<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\Support\Renderable {
        $cats = Cat::with('user','type');
        if($request->search){
            $search = $request->search;
            $cats
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhereHas('type', function($q) use($search){
                    return $q->where('name', 'LIKE', "%{$search}%");
                });
        }
        $data = [
            'title' => 'Welcome',
            'cats' => $cats->paginate(9)
        ];

        return view('home.index', $data);
    }
}
