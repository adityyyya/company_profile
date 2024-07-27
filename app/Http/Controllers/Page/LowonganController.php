<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page\Jabatan;
use App\Models\Page\Lowongan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Crypt;

class LowonganController extends Controller
{
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = Lowongan::getLowongan($request);
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id_lowongan.'" class="btn btn-success text-white rounded-pill btn-sm edit"><i class="bx bx-edit"></i></a> ';
				$button .= '<a href="javascript:void(0)" more_id="'.$data->id_lowongan.'" class="btn btn-danger text-white rounded-pill btn-sm delete"><i class="bx bx-trash"></i></a> ';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		$jabatan = Jabatan::all();
		return view('page.admin.lowongan.index',compact('jabatan'));
	}
	public function get_edit($id_lowongan)
	{
		$data = Lowongan::getEdit($id_lowongan);
		return response()->json($data);
	}
	public function save(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'id_jabatan' => 'required',
			'tanggal_buka' => 'required',
			'tanggal_tutup' => 'required',
			'persyaratan' => 'required',
			'status' => 'required',
			'deskripsi' => 'required'
		];
		$validateMessage += [
			'id_jabatan.required' => 'Jabatan harus dipilih.',
			'image.required' => 'Poster Lowongan harus diupload.',
			'tanggal_buka.required' => 'Tanggal Buka harus diisi.',
			'tanggal_tutup.required' => 'Tanggal Tutup harus diisi.',
			'persyaratan.required' => 'Persyaratan harus diisi.',
			'status.required' => 'Status harus dipilih.',
			'deskripsi.required' => 'Deskripsi harus diisi.'
		];
		if ($request->id_lowongan == '') {
			$validateRules += [
				'image' => 'required'
			];
			$validateMessage += [
				'image.required' => 'Poster Lowongan harus diupload.'
			];
		}
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();
			if ($request->id_lowongan == '') {
				$ambil=$request->file('image');
				$name=$ambil->getClientOriginalName();
				$namaFileBaru = uniqid();
				$namaFileBaru .= $name;
				$ambil->move(\base_path()."/public/poster_lowongan", $namaFileBaru);
				$data = New Lowongan();
				$text = 'Lowongan berhasil ditambahkan !!';
			}else{
				if (!empty($request->file('image'))) {
					$ambil=$request->file('image');
					$name=$ambil->getClientOriginalName();
					$namaFileBaru = uniqid();
					$namaFileBaru .= $name;
					$ambil->move(\base_path()."/public/poster_lowongan", $namaFileBaru);
					$berkas = public_path("poster_lowongan/".$request->imageLama);
					File::delete($berkas);
				}else{
					$namaFileBaru = $request->imageLama;
				}
				$data = Lowongan::where('id_lowongan',$request->id_lowongan)->first();
				$text = 'Lowongan berhasil diubah !!';
			}
			$data -> id_jabatan = $request->id_jabatan;
			$data -> tanggal_buka = $request->tanggal_buka;
			$data -> tanggal_tutup = $request->tanggal_tutup;
			$data -> image = $namaFileBaru;
			$data -> persyaratan = $request->persyaratan;
			$data -> deskripsi = $request->deskripsi;
			$data -> status = $request->status;
			$data -> save();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>$text]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function delete($id_lowongan)
	{
		try {
			DB::beginTransaction();
			$data = Lowongan::where('id_lowongan',$id_lowongan)->first();
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
