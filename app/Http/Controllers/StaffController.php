<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
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
        $inputMail = $request->input('email');

        $userMail = User::query()
            ->where('email', $inputMail)
            ->first();

        if ($userMail != null){
            return redirect()->back()->with([
                'type' => 'error',
                'title' => 'Duplikasi data',
                'message' => 'User dengan email : ' . $inputMail . ' Sudah ada, mohon ganti dengan email lain'
            ]);
        }

        try {
            DB::beginTransaction();

            $anggota = User::create([
                'name' => $request->input('nama'),
                'email' => $inputMail,
                'password' => Hash::make($request->input('password')),
                'role' => 'staff'
            ]);

            Staff::create([
                'user_id' => $anggota->user_id,
                'nama' => $request->input('nama'),
                'role' => 'staff'
            ]);

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();

            throw $e;
        }

        return redirect('staff')->with([
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'message' => 'Staff ' . $request->input('nama') .' berhasil ditambahkan'
        ]);
    }

    public function editData(Request $request){
        $staff = Staff::query()
            ->with('user')
            ->where('staff_id', $request->input('id'))
            ->first();
        $user = User::query()
            ->where('email', $request->input('old_email'))
            ->first();

        if (!$staff || !$user){
            return redirect('staff')->with([
                'type' => 'error',
                'title' => 'Data tidak ditemukan',
                'message' => 'Terjadi kesalahan perubahan data'
            ]);
        }

        try {
            DB::beginTransaction();

            $staff->nama = $request->input('nama');
            $user->email = $request->input('email');
            $user->save();
            $staff->save();

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();

            throw $e;
        }

        return redirect('staff')->with([
            'type' => 'success',
            'title' => 'Data berhasil dirubah',
            'message' => 'Staff ' . $request->input('nama') .' berhasil ditambahkan'
        ]);
    }
}
