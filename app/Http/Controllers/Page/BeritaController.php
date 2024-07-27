<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page\Berita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Crypt;

class BeritaController extends Controller
{
    public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = Berita::all();
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id_berita.'" class="btn btn-success text-white rounded-pill btn-sm edit"><i class="bx bx-edit"></i></a> ';
				$button .= '<a href="javascript:void(0)" more_id="'.$data->id_berita.'" class="btn btn-danger text-white rounded-pill btn-sm delete"><i class="bx bx-trash"></i></a> ';
				$button .= '<a href="javascript:void(0)" class="btn btn-info text-white rounded-pill btn-sm"><i class="fa fa-eye"></i></a>';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		return view('page.admin.berita.index');
	}
	public static function save(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'judul' => 'required',
			'tanggal' => 'required',
			'deskripsi' => 'required'
		];
		$validateMessage += [
			'judul.required' => 'Judul harus diisi.',
			'tanggal.required' => 'Tanggal harus diisi.',
			'deskripsi.required' => 'Deskripsi harus diisi.'
		];
		if ($request->id_berita == '') {
			$validateRules += [
				'image' => 'required'
			];
			$validateMessage += [
				'image.required' => 'Gambar harus diupload.'
			];
		}
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();
			if ($request->id_berita == '') {
				$ambil=$request->file('image');
				$name=$ambil->getClientOriginalName();
				$namaFileBaru = uniqid();
				$namaFileBaru .= $name;
				$ambil->move(\base_path()."/public/berita", $namaFileBaru);
				$data = New Berita();
				$text = 'Berita berhasil ditambahkan !!';
			}else{
				if (!empty($request->file('image'))) {
					$ambil=$request->file('image');
					$name=$ambil->getClientOriginalName();
					$namaFileBaru = uniqid();
					$namaFileBaru .= $name;
					$ambil->move(\base_path()."/public/berita", $namaFileBaru);
					$berkas = public_path("berita/".$request->imageLama);
					File::delete($berkas);
				}else{
					$namaFileBaru = $request->imageLama;
				}
				$data = Berita::where('id_berita',$request->id_berita)->first();
				$text = 'Berita berhasil diubah !!';
			}
			$data -> judul = $request->judul;
			$data -> tanggal = $request->tanggal;
			$data -> deskripsi = $request->deskripsi;
			$data -> image = $namaFileBaru;
			$data -> save();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>$text]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function get_edit($id_berita)
	{
		$data = Berita::getEdit($id_berita);
		return response()->json($data);
	}
	public function delete($id_berita)
	{
		try {
			DB::beginTransaction();
			$data = Berita::where('id_berita',$id_berita)->first();
			$data -> delete();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Data Berita berhasil dihapus !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
}
