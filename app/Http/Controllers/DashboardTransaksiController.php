<?php

namespace App\Http\Controllers;

use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardTransaksiController extends Controller
{
    public function index()
    {
        $sellTransactions = TransactionDetail::with(['transaction.user','jadwal.galleries'])
                            ->whereHas('jadwal', function($jadwal){
                                $jadwal->where('users_id', Auth::user()->id);
                            })->get();
        $buyTransactions = TransactionDetail::with(['transaction.user','jadwal.galleries'])
                            ->whereHas('transaction', function($transaction){
                                $transaction->where('users_id', Auth::user()->id);
                            })->get();
        
        return view('pages.dashboard-transactions',[
            'sellTransactions' => $sellTransactions,
            'buyTransactions' => $buyTransactions
        ]);
    }

     public function details(Request $request, $id)
    {
        $transaction = TransactionDetail::with(['transaction.user','jadwal.galleries'])
                            ->findOrFail($id);
        return view('pages.dashboard-transactions-details',[
            'transaction' => $transaction
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-transaction-details', $id);
    }
}
