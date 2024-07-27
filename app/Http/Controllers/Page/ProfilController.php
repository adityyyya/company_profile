<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page\ProfileCompany;
use App\Models\Page\About;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Crypt;

class ProfilController extends Controller
{
	public function index(Request $request)
	{
		if (!empty($request->menu) && $request->menu == 'profil_perusahaan') {
			$data = ProfileCompany::first();
			return view('page.admin.profile_company.index',compact('data'));
		}elseif (!empty($request->menu) && $request->menu == 'tentang_perusahaan'){
			$data = About::first();
			return view('page.admin.about.index',compact('data'));
		}
	}
	public function save(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'nama' => 'required',
			'email' => 'required',
			'telepon' => 'required',
			'alamat' => 'required',
			'deskripsi' => 'required'
		];
		$validateMessage += [
			'nama.required' => 'Nama Perusahaan harus diisi.',
			'email.required' => 'Email harus diisi.',
			'telepon.required' => 'Telepon harus diisi.',
			'alamat.required' => 'Alamat harus diisi.',
			'deskripsi.required' => 'Deskripsi harus diisi.'
		];
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();
			if (!empty($request->file('logo'))) {
				$ambil=$request->file('logo');
				$name=$ambil->getClientOriginalName();
				$namaFileBaru = uniqid();
				$namaFileBaru .= $name;
				$ambil->move(\base_path()."/public/profil_perusahaan", $namaFileBaru);
			}else{
				$namaFileBaru = NULL;
			}
			$data = New ProfileCompany();
			$data -> nama = $request->nama;
			$data -> email = $request->email;
			$data -> telepon = $request->telepon;
			$data -> alamat = $request->alamat;
			$data -> deskripsi = $request->deskripsi;
			$data -> logo = $namaFileBaru;
			$data -> save();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Profil Perusahaan berhasil di setting !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function update(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'nama' => 'required',
			'email' => 'required',
			'telepon' => 'required',
			'alamat' => 'required',
			'deskripsi' => 'required'
		];
		$validateMessage += [
			'nama.required' => 'Nama Perusahaan harus diisi.',
			'email.required' => 'Email harus diisi.',
			'telepon.required' => 'Telepon harus diisi.',
			'alamat.required' => 'Alamat harus diisi.',
			'deskripsi.required' => 'Deskripsi harus diisi.'
		];
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();
			if (!empty($request->file('logo'))) {
				$ambil=$request->file('logo');
				$name=$ambil->getClientOriginalName();
				$namaFileBaru = uniqid();
				$namaFileBaru .= $name;
				$ambil->move(\base_path()."/public/profil_perusahaan", $namaFileBaru);
			}else{
				$namaFileBaru = $request->logoLama;
			}
			$data = ProfileCompany::where('id_profil',$request->id_profil)->first();
			$data -> nama = $request->nama;
			$data -> email = $request->email;
			$data -> telepon = $request->telepon;
			$data -> alamat = $request->alamat;
			$data -> deskripsi = $request->deskripsi;
			$data -> logo = $namaFileBaru;
			$data -> save();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Profil Perusahaan berhasil diubah !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function delete($id_profil)
	{
		try {
			DB::beginTransaction();
			$data = ProfileCompany::where('id_profil',$id_profil)->first();
			$data -> delete();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Profil Perusahaan berhasil dihapus !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
}
