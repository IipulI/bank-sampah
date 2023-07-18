<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Sampah;
use App\Models\Tabungan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class SampahController extends Controller
{
    public function getData(Request $request){
        $search = $request->input('search');

        $sampah = Sampah::query()
            ->when($search != null, function (Builder $query) use ($search) {
                $query->where('nama', 'like', '%'.$search.'%');
            })
            ->paginate(10);

        return $sampah;
    }

    public function submitData(Request $request){
        try {
            DB::beginTransaction();

            $sampah = new Sampah();
            $sampah->nama = $request->input('nama');
            $sampah->satuan = $request->input('satuan');
            $sampah->harga_satuan = $request->input('harga_satuan');
            $sampah->save();

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();

            return $e;
        }

        return redirect('tipe-sampah')->with([
            'message' => 'Data ' . 'nama_data' .' Berhasil dirubah'
        ]);
    }

    public function editData(Request $request){
        try {
            DB::beginTransaction();

            $sampah = Sampah::query()
                ->where('id', $request->input('id'))
                ->firstOrFail();

            $sampah->nama = $request->input('nama');
            $sampah->satuan = $request->input('satuan');
            $sampah->harga_satuan = $request->input('harga_satuan');
            $sampah->save();

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();

            return $e;
        }

        return redirect('tipe-sampah')->with([
            'message' => 'Data ' . 'nama_data' .' Berhasil dirubah'
        ]);
    }

    public function getSampah(Request $request){
        $search = $request->input('q');

        return Sampah::query()
            ->when($search != null, function (Builder $query) use ($search) {
                $query->where('nama', 'like', '%'.$search.'%');
            })
            ->limit(5)->get();
    }

    public function searchSampah(Request $request){
        $col = $request->input('col');

        return Sampah::query()
            ->when($col != null, function (Builder $query) use ($col) {
                $query->select([$col]);
            })
            ->where('id', $request->input('id'))
            ->first();
    }

    public function getMember(Request $request){
        $search = $request->input('search');

        return Anggota::query()
            ->with(['latestTransaksi' => function($query){
                $query->latest()->first();
            }])
            ->with('tabungan')
            ->when($search != null, function(Builder $query) use ($search){
                $query->where('nama', 'like', '%'.$search.'%');
            })->limit(10)->get();
    }

    public function setorSampah(Request $request){

        try {
            DB::beginTransaction();

            $anggota = Anggota::query()
                ->with('tabungan')
                ->where('id', $request->input('anggota_id'))
                ->first();

            if($anggota->tabungan()->exists()){
                $anggota->tabungan->jumlah_uang += $request->input('total_harga');

            } else{
                $anggota->tabungan()->create([
                    'jumlah_uang' => $request->input('total_harga')
                ]);
            }

            dump($anggota->tabungan);

            $transaksi = Transaksi::create([
                'staff_id' => Auth::user()->id,
                'anggota_id' => $request->input('anggota_id'),
                'kode_transaksi' => 'TRX-I-' . Carbon::now()->format('d-m-Y-G-i'),
                'jumlah_uang' => $request->total_harga,
                'tanggal_transaksi' => Carbon::today(),
                'arus_transaksi' => 'masuk',
            ]);

            $attach = [];
            foreach ($request->input('satuan') as $sub => $subItem){
                $attach[$sub]['timbangan'] = $subItem;
            }
            foreach ($request->input('harga') as $sub => $subItem){
                $attach[$sub]['harga'] = $subItem;
            }

            foreach ($request->input('item') as $key => $item){
                $transaksi->TipeSampah()->attach($item, $attach[$key]);
            }

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();

            throw $e;
        }

        return redirect('histori-transaksi');
    }

    public function tarikDana(Request $request){
        $anggota =  Anggota::query()
            ->with('tabungan')
            ->where('id', $request->input('anggotaId'))
            ->first();

        $tabungan = Tabungan::query()
            ->where('anggota_id', $request->input('anggotaId'))
            ->first();

        try {
            DB::beginTransaction();

            $tabungan->jumlah_uang = $tabungan->jumlah_uang - $request->input('inputTarik');
            $tabungan->save();

            $anggota->transaksi()->create([
                'staff_id' => Auth::user()->id,
                'jumlah_uang' => $request->input('inputTarik'),
                'kode_transaksi' => 'TRX-O-' . Carbon::now()->format('d-m-Y-G-i'),
                'tanggal_transaksi' => Carbon::today(),
                'arus_transaksi' => 'keluar'
            ]);

            DB::commit();
        }catch (Exception $e){
            DB::rollBack();

            return response()->json([
                'status' => 422,
                'message' => 'Unexpected error'
            ])->setStatusCode(422);
        }

        return response()->json([
            'status' => 200,
            'message' => 'success'
        ]);
    }
}
