<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Welcome'
        ];
        return view('admin.v_admin_index', $data);
    }
}
