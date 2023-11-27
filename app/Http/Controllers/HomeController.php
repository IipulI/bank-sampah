<?php


namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Sampah;
use App\Models\Staff;
use App\Models\Transaksi;
use App\Models\TransaksiSampah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index(){
        $today = Carbon::now();

        $anggota = Masyarakat::query()->count();
//        $staff = Staff::query()->count();
//        $tipeSampah = Sampah::query()->count();
//        $sampahMasuk = TransaksiSampah::query()->count();


        if (in_array(Auth::user()->role, ['admin', 'staff'])){
            $saldoKas = Transaksi::query()->where('arus_transaksi', 'masuk')->sum('jumlah_uang') - Transaksi::query()->where('arus_transaksi', 'keluar')->sum('jumlah_uang');

            $transaksi = Transaksi::query()
                ->with('masyarakat')
                ->orderByDesc('created_at')
                ->limit(7)
                ->get();

            $transaksiMasuk = Transaksi::query()
                ->whereBetween('tanggal_transaksi', [$today->firstOfMonth()->toDateString(), $today->lastOfMonth()->toDateString()])
                ->where('arus_transaksi', 'masuk')
                ->get()
                ->sum('jumlah_uang')
            ;
            $transaksiKeluar = Transaksi::query()
                ->whereBetween('tanggal_transaksi', [$today->firstOfMonth()->toDateString(), $today->lastOfMonth()->toDateString()])
                ->where('arus_transaksi', 'keluar')
                ->get()
                ->sum('jumlah_uang')
            ;
        } else {
            $user = Masyarakat::query()
                ->with('tabungan')
                ->with('transaksi')
                ->where('user_id', Auth::id())
                ->first();

            $saldoKas = $user->tabungan()->exists() ? $user->tabungan->jumlah_uang : '0' ;
            $transaksi = Transaksi::query()
                ->where('no_nik', $user->no_nik)
                ->with('masyarakat')
                ->orderByDesc('created_at')
                ->limit(7)
                ->get();

            $transaksiMasuk = Transaksi::query()
                ->where('no_nik', $user->no_nik)
                ->whereBetween('tanggal_transaksi', [$today->firstOfMonth()->toDateString(), $today->lastOfMonth()->toDateString()])
                ->where('arus_transaksi', 'masuk')->sum('jumlah_uang');
            $transaksiKeluar = Transaksi::query()
                ->where('no_nik', $user->no_nik)
                ->whereBetween('tanggal_transaksi', [$today->firstOfMonth()->toDateString(), $today->lastOfMonth()->toDateString()])
                ->where('arus_transaksi', 'keluar')->sum('jumlah_uang');
        }

        $data = [
            'jumlah_anggota' => $anggota,
            'transaksi_masuk' => $transaksiMasuk,
            'transaksi_keluar' => $transaksiKeluar,
            'saldo_kas' => $saldoKas,
            'transaksi' => $transaksi,
        ];

        return view('dashboard', $data);
    }
}
