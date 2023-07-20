<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function getData(Request $request){
        $search = $request->input('search');

        $sampah = Staff::query()
            ->with('user')
            ->when($search != null, function (Builder $query) use ($search) {
                $query->where('nama', 'like', '%'.$search.'%');
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
                'password' => Hash::make($request->input('password')),
                'role' => 'staff'
            ]);

            $anggota->staff()->create([
                'nama' => $request->input('nama'),
                'role' => 'staff'
            ]);

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();

            return $e;
        }

        return redirect('staff')->with([
            'message' => 'Data ' . 'nama_data' .' Berhasil dirubah'
        ]);
    }

    public function editData(Request $request){
        try {
            DB::beginTransaction();

            $sampah = Staff::query()
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

        return redirect('staff')->with([
            'message' => 'Data ' . 'nama_data' .' Berhasil dirubah'
        ]);
    }
}
