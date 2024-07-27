<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page\Lowongan;
use App\Models\Page\Lamaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DataTables;
use Exception;

class LamaranController extends Controller
{
    public function form_lamar($nama_jabatan, $id_lowongan)
    {
        $data = Lowongan::getFormLamaran($nama_jabatan, $id_lowongan);
        $profil = User::getMyProfil();
        $cek = Lamaran::where('id_lowongan', $id_lowongan)
            ->where('id_user', Auth::user()->id)
            ->first();
        return view('page.kandidat.lamar.form', compact('data', 'profil', 'cek'));
    }

    public function kirim_lamaran(Request $request)
    {
        $request->validate([
            'berkas.*' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',
        ], [
            'berkas.*.required' => 'File berkas diperlukan',
            'berkas.*.mimes' => 'Berkas harus berupa file bertipe: jpeg, png, jpg, pdf',
            'berkas.*.max' => 'Ukuran berkas maksimal 2MB',
        ]);

        try {
            DB::beginTransaction();
            $cek = Lamaran::where('id_lowongan', $request->id_lowongan)
                ->where('id_user', Auth::user()->id)
                ->first();

            if (!empty($cek)) {
                return response()->json(['status' => 'warning', 'message' => 'Lamaran sudah pernah dikirim !!']);
            } else {
                if (!empty($request->file('foto'))) {
                    $ambil = $request->file('foto');
                    $name = $ambil->getClientOriginalName();
                    $namaFileBaru = uniqid() . '_' . $name;
                    $ambil->move(public_path('foto_profil'), $namaFileBaru);
                } else {
                    $namaFileBaru = $request->fotoLama;
                }

                $user = User::where('id', Auth::user()->id)->first();
                $user->name = $request->name;
                $user->save();

                DB::table('biodata')->where('id_user', $user->id)->update([
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'telepon' => $request->telepon,
                    'alamat' => $request->alamat,
                    'foto' => $namaFileBaru
                ]);

                $berkas = "";
                foreach ($request->berkas as $key => $value) {
                    if (!empty($request->file('berkas')[$key])) {
                        $ambil_berkas = $request->file('berkas')[$key];
                        $name_berkas = $ambil_berkas->getClientOriginalName();
                        $namaFileBaruBerkas = uniqid() . '_' . $name_berkas;
                        $berkas .= $namaFileBaruBerkas . ';';
                        $ambil_berkas->move(public_path('berkas_lamaran'), $namaFileBaruBerkas);
                    }
                }

                $data = new Lamaran();
                $data->id_user = $user->id;
                $data->id_lowongan = $request->id_lowongan;
                $data->berkas = $berkas;
                $data->save();
            }

            DB::commit();
            return response()->json(['status' => 'true', 'message' => 'Berhasil submit lamaran pekerjaan, mohon menunggu informasi untuk tahap selanjutnya !!']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
        }
    }

    public function riwayat_lamaran(Request $request)
    {
        if ($request->ajax()) {
            $data = Lamaran::getLamaran();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('', function ($data) {
                    $a = '';
                    return $a;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('page.kandidat.riwayat_lamaran.index');
    }

    public function detail_riwayat_lamaran($id_lamaran)
    {
        $data = Lamaran::getDetailLamaran($id_lamaran);
        return view('page.kandidat.riwayat_lamaran.detail', compact('data'));
    }
}
