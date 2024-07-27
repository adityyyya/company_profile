<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page\About;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Crypt;

class AboutController extends Controller
{
	public function save(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'deskripsi' => 'required',
			'image' => 'required'
		];
		$validateMessage += [
			'deskripsi.required' => 'Deskripsi harus diisi.',
			'image.required' => 'Image harus diupload.'
		];
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();
			// if (!empty($request->file('logo'))) {
			$ambil=$request->file('image');
			$name=$ambil->getClientOriginalName();
			$namaFileBaru = uniqid();
			$namaFileBaru .= $name;
			$ambil->move(\base_path()."/public/about", $namaFileBaru);
			// }else{
			// 	$namaFileBaru = NULL;
			// }
			$data = New About();
			$data -> deskripsi = $request->deskripsi;
			$data -> image = $namaFileBaru;
			$data -> save();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Tentang Perusahaan berhasil di setting !!']);
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
			'deskripsi' => 'required'
		];
		$validateMessage += [
			'deskripsi.required' => 'Deskripsi harus diisi.'
		];
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();
			if (!empty($request->file('image'))) {
				$ambil=$request->file('image');
				$name=$ambil->getClientOriginalName();
				$namaFileBaru = uniqid();
				$namaFileBaru .= $name;
				$ambil->move(\base_path()."/public/about", $namaFileBaru);
			}else{
				$namaFileBaru = $request->imageLama;
			}
			$data = About::where('id_about',$request->id_about)->first();
			$data -> deskripsi = $request->deskripsi;
			$data -> image = $namaFileBaru;
			$data -> save();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Tentang Perusahaan berhasil diubah !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function delete($id_about)
	{
		try {
			DB::beginTransaction();
			$data = About::where('id_about',$id_about)->first();
			$data -> delete();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Tentang Perusahaan berhasil dihapus !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
}
