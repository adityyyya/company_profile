<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page\VisiMisi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Crypt;

class VisiMisiController extends Controller
{
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = VisiMisi::all();
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id_visi_misi.'" class="btn btn-success text-white rounded-pill btn-sm edit"><i class="bx bx-edit"></i></a> ';
				$button .= '<a href="javascript:void(0)" more_id="'.$data->id_visi_misi.'" class="btn btn-danger text-white rounded-pill btn-sm delete"><i class="bx bx-trash"></i></a> ';
				$button .= '<a href="javascript:void(0)" title="Detail" more_id="'.$data->id_visi_misi.'" class="btn btn-info text-white rounded-pill btn-sm view"><i class="bx bx-list-ul"></i></a>';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		return view('page.admin.visi_misi.index');
	}
	public function cek_visimisi()
	{
		$visi = VisiMisi::where('jenis','Visi')->get();
		$misi = VisiMisi::where('jenis','Misi')->get();
		return response()->json(['visi'=>$visi,'misi'=>$misi]);
	}
	public function save(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'jenis' => 'required',
			'deskripsi' => 'required',
			'image' => 'required'
		];
		$validateMessage += [
			'jenis.required' => 'Jenis harus dipilih.',
			'deskripsi.required' => 'Deskripsi harus diisi.',
			'image.required' => 'Gambar harus diupload.'
		];
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();
			// if (!empty($request->file('image'))) {
			$ambil=$request->file('image');
			$name=$ambil->getClientOriginalName();
			$namaFileBaru = uniqid();
			$namaFileBaru .= $name;
			$ambil->move(\base_path()."/public/visi_misi", $namaFileBaru);
				// $berkas = public_path("foto_ktp/".$request->fotoLama);
				// File::delete($berkas);
			// }else{
			// 	$namaFileBaru = $request->fotoLama;
			// }
			$data = New VisiMisi();
			$data -> jenis = $request->jenis;
			$data -> deskripsi = $request->deskripsi;
			$data -> image = $namaFileBaru;
			$data -> save();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>$request->jenis.' berhasil di tambahkan !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function get_edit($id_visi_misi)
	{
		$data = VisiMisi::where('id_visi_misi',$id_visi_misi)->get();
		return response()->json($data);
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
				$ambil->move(\base_path()."/public/visi_misi", $namaFileBaru);
				$berkas = public_path("visi_misi/".$request->imageLama);
				File::delete($berkas);
			}else{
				$namaFileBaru = $request->imageLama;
			}
			$data = VisiMisi::where('id_visi_misi',$request->id_visi_misi)->first();
			$data -> jenis = $request->jenis;
			$data -> deskripsi = $request->deskripsi;
			$data -> image = $namaFileBaru;
			$data -> save();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>$request->jenis.' berhasil diubah !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function delete($id_visi_misi)
	{
		try {
			DB::beginTransaction();
			$data = VisiMisi::where('id_visi_misi',$id_visi_misi)->first();
			$data -> delete();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Data berhasil dihapus !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
}
