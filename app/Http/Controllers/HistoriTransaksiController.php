<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HistoriTransaksiController extends Controller
{
    public function getData(Request $request){
        $search = $request->input('search');
        $dateStart = $request->input('date-start');
        $dateEnd = $request->input('date-end');
        $filter = $request->input('type');

        $transaksi = Transaksi::query()
            ->with('anggota')
            ->with('staff')
//            ->has('tipeSampah')
            ->when($search != null, function (Builder $query) use ($search) {
                $query->where('kode_transaksi', 'like', '%'.$search.'%');
                $query->orWhereHas('anggota', function (Builder $query) use($search){
                    $query->where('nama', 'like', '%'.$search.'%');
                });
            })
            ->when($dateStart != null, function (Builder $query) use ($dateStart) {
                $query->where('tanggal_transaksi', '>=', Carbon::parse($dateStart));

            })
            ->when($dateEnd != null, function (Builder $query) use ($dateEnd) {
                $query->where('tanggal_transaksi', '<=', Carbon::parse($dateEnd));

            })
            ->when($filter != null, function (Builder $query) use ($filter) {
                $query->where('arus_transaksi', $filter);

            })
//            ->has('tipeSampah')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $transaksi;
    }

    public function detail(Request $request){

        $transaksi = Transaksi::query()
            ->with('anggota')
            ->with('staff')
            ->with('tipeSampah')
            ->where('kode_transaksi', $request->input('kode'))
            ->first();

        $data['transaksi'] = $transaksi;



        return view('app.detail-transaksi', $data);
    }
}
