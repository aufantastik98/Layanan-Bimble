<?php

namespace App\Http\Controllers;

use App\Category;
use App\Jadwal;

use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $jadwals = Jadwal::paginate($request->input('limit', 12));

        return view('pages.category',[
            'categories' => $categories,
            'jadwals' => $jadwals
        ]);
    }

    public function detail(Request $request, $slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $jadwals = Jadwal::where('categories_id', $category->id)->paginate($request->input('limit', 12));

        return view('pages.category',[
            'categories' => $categories,
            'category' => $category,
            'jadwals' => $jadwals
        ]);
    }
}
