<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HistoriTransaksiController extends Controller
{
    public function getData(Request $request){
        $search = $request->input('search');
        $filterDate = $request->input('filter-date');

        $transaksi = Transaksi::query()
            ->whereHas('tipeSampah')
            ->with('anggota')
            ->with('staff')
            ->when($search != null, function (Builder $query) use ($search) {
                $query->where('kode_transaksi', 'like', '%'.$search.'%');
                $query->orWhereHas('anggota', function (Builder $query) use($search){
                   $query->where('nama', 'like', '%'.$search.'%');
                });
            })
            ->when($filterDate != null, function (Builder $query) use ($filterDate) {
                $query->orderBy('tanggal_transaksi', $filterDate);
            })
            ->orderBy('tanggal_transaksi', 'desc')
            ->paginate(10);

        return $transaksi;
    }
}
