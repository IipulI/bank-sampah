<?php


namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Sampah;
use App\Models\Staff;
use App\Models\Transaksi;
use App\Models\TransaksiSampah;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(){
        $anggota = Anggota::query()->count();
        $staff = Staff::query()->count();
        $tipeSampah = Sampah::query()->count();
        $sampahMasuk = TransaksiSampah::query()->count();
        $transaksiMasuk = Transaksi::query()->where('arus_transaksi', 'masuk')->count();
        $transaksiKeluar = Transaksi::query()->where('arus_transaksi', 'keluar')->count();
        $saldoKas = Transaksi::query()->where('arus_transaksi', 'masuk')->sum('jumlah_uang') - Transaksi::query()->where('arus_transaksi', 'keluar')->sum('jumlah_uang');

        $data = [
            'jumlah_anggota' => $anggota,
            'jumlah_staff' => $staff,
            'jumlah_tipe_sampah' => $tipeSampah,
            'jumlah_sampah_masuk' => $sampahMasuk,
            'jumlah_transaksi_masuk' => $transaksiMasuk,
            'jumlah_transaksi_keluar' => $transaksiKeluar,
            'saldo_kas' => $saldoKas
        ];

        return view('dashboard', $data);
    }
}
