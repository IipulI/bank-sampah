<?php


namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Sampah;
use App\Models\Staff;
use App\Models\Transaksi;
use App\Models\TransaksiSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index(){
        $anggota = Anggota::query()->count();
        $staff = Staff::query()->count();
        $tipeSampah = Sampah::query()->count();
        $sampahMasuk = TransaksiSampah::query()->count();
        $transaksiMasuk = Transaksi::query()->where('arus_transaksi', 'masuk')->count();
        $transaksiKeluar = Transaksi::query()->where('arus_transaksi', 'keluar')->count();

        if (in_array(Auth::user()->role, ['admin', 'staff'])){
            $saldoKas = Transaksi::query()->where('arus_transaksi', 'masuk')->sum('jumlah_uang') - Transaksi::query()->where('arus_transaksi', 'keluar')->sum('jumlah_uang');

            $transaksi = Transaksi::query()
                ->with('anggota')
                ->orderByDesc('created_at')
                ->limit(7)
                ->get();
        } else {
            $user = Anggota::query()
                ->with('tabungan')
                ->with('transaksi')
                ->where('user_id', Auth::user()->id)
                ->first();

            $saldoKas = $user->tabungan()->exists() ? $user->tabungan->jumlah_uang : '0' ;
            $transaksi = Transaksi::query()
                ->where('anggota_id', $user->id)
                ->with('anggota')
                ->orderByDesc('created_at')
                ->limit(7)
                ->get();
        }

        $data = [
            'jumlah_anggota' => $anggota,
            'jumlah_staff' => $staff,
            'jumlah_tipe_sampah' => $tipeSampah,
            'jumlah_sampah_masuk' => $sampahMasuk,
            'jumlah_transaksi_masuk' => $transaksiMasuk,
            'jumlah_transaksi_keluar' => $transaksiKeluar,
            'saldo_kas' => $saldoKas,
            'transaksi' => $transaksi,
        ];

        return view('dashboard', $data);
    }
}
