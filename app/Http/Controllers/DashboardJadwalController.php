<?php

namespace App\Http\Controllers;

use App\User;
use App\Jadwal;
use App\Category;
use App\JadwalGallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\JadwalRequest;

class DashboardJadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with(['galleries','category'])->get();

        return view('pages.dashboard-jadwals',[
            'jadwals' => $jadwals
        ]);
    }

    public function details(Request $request, $id)
    {
        $jadwal = Jadwal::with(['galleries','user','category'])->findOrFail($id);
        $categories = Category::all();

        return view('pages.dashboard-jadwals-details',[
            'jadwal' => $jadwal,
            'categories' => $categories
        ]);
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();

        $data['fotos'] = $request->file('fotos')->store('assets/jadwal', 'public');

        JadwalGallery::create($data);

        return redirect()->route('dashboard-jadwal-details', $request->jadwals_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = JadwalGallery::findorFail($id);
        $item->delete();

        return redirect()->route('dashboard-jadwal-details', $item->jadwals_id);
    }

    public function create()
    {
        $users = User::all();
        $categories = Category::all();

        return view('pages.dashboard-jadwals-create',[
            'users' => $users,
            'categories' => $categories
        ]);
    }

    public function store(JadwalRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $jadwal = Jadwal::create($data);

        $gallery = [
            'jadwals_id' => $jadwal->id,
            'fotos' => $request->file('foto')->store('assets/jadwal', 'public')
        ];
        JadwalGallery::create($gallery);

        return redirect()->route('dashboard-jadwal');
    }

    public function update(JadwalRequest $request, $id)
    {
        $data = $request->all();

        $item = Jadwal::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('dashboard-jadwal');
    }
}
