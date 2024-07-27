<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page\Beranda;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Crypt;
use File;

class BerandaController extends Controller
{
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = Beranda::all();
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id_beranda.'" class="btn btn-success text-white rounded-pill btn-sm edit"><i class="bx bx-edit"></i></a> ';
				$button .= '<a href="javascript:void(0)" more_id="'.$data->id_beranda.'" class="btn btn-danger text-white rounded-pill btn-sm delete"><i class="bx bx-trash"></i></a>';
				// $button .= '<a href="javascript:void(0)" title="Detail" more_id="'.$data->id_beranda.'" class="btn btn-info text-white rounded-pill btn-sm view"><i class="bx bx-list-ul"></i></a>';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		return view('page.admin.beranda.index');
	}
	public function save(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'judul' => 'required',
			'deskripsi' => 'required',
			'image' => 'required'
		];
		$validateMessage += [
			'judul.required' => 'Judul harus diisi.',
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
			$ambil->move(\base_path()."/public/beranda", $namaFileBaru);
				// $berkas = public_path("foto_ktp/".$request->fotoLama);
				// File::delete($berkas);
			// }else{
			// 	$namaFileBaru = $request->fotoLama;
			// }
			$data = New Beranda();
			$data -> judul = $request->judul;
			$data -> deskripsi = $request->deskripsi;
			$data -> image = $namaFileBaru;
			$data -> save();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Menu Beranda berhasil di setting !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function get_edit($id_beranda)
	{
		$data = Beranda::where('id_beranda',$id_beranda)->get();
		return response()->json($data);
	}
	public function update(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'judul' => 'required',
			'deskripsi' => 'required'
		];
		$validateMessage += [
			'judul.required' => 'Judul harus diisi.',
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
				$ambil->move(\base_path()."/public/beranda", $namaFileBaru);
				$berkas = public_path("beranda/".$request->imageLama);
				File::delete($berkas);
			}else{
				$namaFileBaru = $request->imageLama;
			}
			$data = Beranda::where('id_beranda',$request->id_beranda)->first();
			$data -> judul = $request->judul;
			$data -> deskripsi = $request->deskripsi;
			$data -> image = $namaFileBaru;
			$data -> save();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Menu Beranda berhasil diubah !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function delete($id_beranda)
	{
		try {
			DB::beginTransaction();
			$data = Beranda::where('id_beranda',$id_beranda)->first();
			$data -> delete();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Menu Beranda berhasil dihapus !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function cek_beranda()
	{
		$data = Beranda::all();
		return response()->json($data);
	}
}
