<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
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

        $sampah = Masyarakat::query()
            ->with('user')
            ->when($search != null, function (Builder $query) use ($search) {
                $query->where('nama', 'like', '%'.$search.'%')
                    ->orWhere('no_nik', 'like', '%'.$search.'%');
            })
            ->paginate(10);

        return $sampah;
    }

    public function submitData(Request $request){
        $inputNIK = $request->input('no_nik');
        $inputTelp = $request->input('nomor_telepon');
        $inputMail = $request->input('email');

        $userMail = User::query()
            ->where('email', $inputMail)
            ->first();
        $masyarakatNik = Masyarakat::query()
            ->where('no_nik', $inputNIK)
            ->first();
        $masyarakatTelp = Masyarakat::query()
            ->where('nomor_telepon', $inputTelp)
            ->first();

        if ($userMail != null){
            return redirect()->back()->with([
                'type' => 'error',
                'title' => 'Duplikasi data',
                'message' => 'User dengan email : ' . $inputMail . ' Sudah ada, mohon ganti dengan email lain'
            ]);
        }
        if ($masyarakatNik != null){
            return redirect()->back()->with([
                'type' => 'error',
                'title' => 'Duplikasi data',
                'message' => 'Masyarakat dengan NIK : ' . $inputNIK . ' Sudah ada, mohon ganti dengan NIK lain'
            ]);
        }
        if ($masyarakatTelp != null){
            return redirect()->back()->with([
                'type' => 'error',
                'title' => 'Duplikasi data',
                'message' => 'Masyarakat dengan nomor telepon : ' . $inputTelp . ' Sudah ada, mohon ganti dengan nomor_telepon lain'
            ]);
        }


        try {
            DB::beginTransaction();

            $anggota = User::create([
                'name' => $request->input('nama'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => 'member'
            ]);

            $anggota->anggota()->create([
                'no_nik' => $inputNIK,
                'nama' => $request->input('nama'),
                'alamat' => $request->input('alamat'),
                'nomor_telepon' => $inputTelp
            ]);

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();

            throw $e;
        }

        return redirect('masyarakat')->with([
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'message' => 'Masyarakat ' . $request->input('nama') .' Berhasil ditambahkan'
        ]);
    }

    public function editData(Request $request){
        $sampah = Masyarakat::query()
            ->with('user')
            ->where('no_nik', $request->input('id'))
            ->first();
        $user = User::query()
            ->where('email', $request->input('old_email'))
            ->first();


        if (!$sampah || !$user){
            return redirect('masyarakat')->with([
                'type' => 'error',
                'title' => 'Data tidak ditemukan',
                'message' => 'Terjadi kesalahan perubahan data'
            ]);
        }


        try {
            DB::beginTransaction();

            $sampah->nama = $request->input('nama');
            $user->email = $request->input('email');
            $sampah->no_nik = $request->input('no_nik');
            $sampah->alamat = $request->input('alamat');
            $sampah->nomor_telepon = $request->input('nomor_telepon');

            $user->save();
            $sampah->save();

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();

            throw $e;
        }

        return redirect('masyarakat')->with([
            'type' => 'success',
            'title' => 'Data berhasil dirubah',
            'message' => 'Masyarakat ' . $request->input('nama') .' Berhasil dirubah'
        ]);
    }

    public function detailAnggota(Request $request){
        $anggota = Masyarakat::query()
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
