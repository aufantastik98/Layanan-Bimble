<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use App\Jadwal;
use App\Transaction;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        $jadwal = Jadwal::with(['galleries','user'])->where('slug', $id)->firstOrFail();

        return view('pages.detail', [
            'jadwal' => $jadwal
        ]);
    }

    public function add(Request $request, $id)
    {
        $data = [
            'jadwals_id' => $id,
            'users_id' => Auth::user()->id
        ];

        Cart::create($data);

        return redirect()->route('cart');
    }
}
