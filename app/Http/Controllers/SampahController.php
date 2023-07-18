<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Sampah;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            ->when($search != null, function(Builder $query) use ($search){
                $query->where('nama', 'like', '%'.$search.'%');
            })->limit(10)->get();
    }

    public function setorSampah(Request $request){

        try {
            DB::beginTransaction();

            $transaksi = Transaksi::create([
                'staff_id' => Auth::user()->id,
                'anggota_id' => $request->input('anggota_id'),
                'kode_transaksi' => 'TRX-123124',
                'jumlah_uang' => $request->total_harga,
                'tanggal_transaksi' => Carbon::today(),
                'arus_transaksi' => 'masuk',
            ]);

            $attach = [];
            foreach ($request->input('satuan') as $sub => $subItem){
                $attach[$sub]['timbangan'] = $subItem;
            }
            foreach ($request->input('harga') as $sub => $subItem){
                $attach[$sub]['satuan'] = $subItem;
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
}
