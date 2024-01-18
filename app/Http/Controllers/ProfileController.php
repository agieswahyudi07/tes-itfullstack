<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $title = "Profile";
        $data = [
            'title' => $title,
        ];

        return view('profile.index', compact('data'));
    }
}
