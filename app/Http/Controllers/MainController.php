<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Jadwal;

class MainController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::take(6)->get();
        $jadwals = Jadwal::with('galleries')->take(8)->get();

        return view('pages.home',[
            'categories' => $categories,
            'jadwals' => $jadwals
        ]);
    }
}
