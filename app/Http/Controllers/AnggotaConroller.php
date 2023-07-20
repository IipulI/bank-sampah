<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder as Builders;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AnggotaConroller extends Controller
{
    public function getData(Request $request){
        $search = $request->input('search');

        $sampah = Anggota::query()
            ->with('user')
            ->when($search != null, function (Builder $query) use ($search) {
                $query->where('nama', 'like', '%'.$search.'%')
                    ->orWhere('no_nik', 'like', '%'.$search.'%');
            })
            ->paginate(10);

        return $sampah;
    }

    public function submitData(Request $request){
        try {
            DB::beginTransaction();

            $anggota = User::create([
                'name' => $request->input('nama'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);

            $anggota->anggota()->create([
                'no_nik' => $request->input('no_nik'),
                'nama' => $request->input('nama'),
                'alamat' => $request->input('alamat'),
                'nomor_telepon' => $request->input('nomor_telepon')
            ]);

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();

            return $e;
        }

        return redirect('anggota')->with([
            'message' => 'Data ' . 'nama_data' .' Berhasil dirubah'
        ]);
    }

    public function editData(Request $request){
        try {
            DB::beginTransaction();

            $sampah = Anggota::query()
                ->with('user')
                ->where('id', $request->input('id'))
                ->firstOrFail();

            $sampah->nama = $request->input('nama');
            $sampah->user->email = $request->input('email');
            $sampah->no_nik = $request->input('no_nik');
            $sampah->alamat = $request->input('alamat');
            $sampah->nomor_telepon = $request->input('nomor_telepon');
            $sampah->save();

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();

            return $e;
        }

        return redirect('anggota')->with([
            'message' => 'Data ' . 'nama_data' .' Berhasil dirubah'
        ]);
    }

    public function detailAnggota(Request $request){
        $anggota = Anggota::query()
            ->with('user')
            ->with('tabungan')
            ->with(['transaksi' => function(Builders $query){
                $query->orderByDesc('created_at')
                    ->limit(5);
            }])
            ->where('no_nik', $request->input('nik'))
            ->first();

        $data['anggota'] = $anggota;

        return view('app.detail-anggota', $data);
    }
}
