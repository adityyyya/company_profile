<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page\SusunanDireksi;
use App\Models\Page\Jabatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Crypt;

class SusunanDireksiController extends Controller
{
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = SusunanDireksi::getSusunanDireksi();
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id_direksi.'" class="btn btn-success text-white rounded-pill btn-sm edit"><i class="bx bx-edit"></i></a> ';
				$button .= '<a href="javascript:void(0)" more_id="'.$data->id_direksi.'" class="btn btn-danger text-white rounded-pill btn-sm delete"><i class="bx bx-trash"></i></a> ';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		$jabatan = Jabatan::all();
		return view('page.admin.direksi.index',compact('jabatan'));
	}
	public function save(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'id_jabatan' => 'required',
			'nama_direksi' => 'required',
			'upload' => 'required',
			'keterangan' => 'required'
		];
		$validateMessage += [
			'id_jabatan.required' => 'Jabatan harus dipilih.',
			'nama_direksi.required' => 'Nama harus diisi.',
			'upload.required' => 'Foto harus diupload.',
			'keterangan.required' => 'Keterangan harus diupload.'
		];
		if (isset($request->sosmed)) {
			foreach ($request->sosmed as $key => $value) {
				$validateRules += [
					'sosmed.*.jenis' => 'required',
					'sosmed.*.url' => 'required'
				];
				$validateMessage += [
					'sosmed.*.jenis.required' => 'Jenis Sosmed harus diisi.',
					'sosmed.*.url.required' => 'URL Sosmed harus diupload.'
				];
			}
		}
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();
			$ambil=$request->file('upload');
			$name=$ambil->getClientOriginalName();
			$namaFileBaru = uniqid();
			$namaFileBaru .= $name;
			$ambil->move(\base_path()."/public/susunan_direksi", $namaFileBaru);

			$data = New SusunanDireksi();
			$data -> id_jabatan = $request->id_jabatan;
			$data -> nama_direksi = $request->nama_direksi;
			$data -> foto_direksi = $namaFileBaru;
			$data -> keterangan = $request->keterangan;
			$data -> save();
			if (isset($request->sosmed)) {
				$jenis_array = [];
				foreach ($request->sosmed as $key => $value) {
					if (in_array($value['jenis'], $jenis_array)) {
						return response()->json(['status'=>'warning','message'=>'Jenis Sosial Media tidak boleh sama.']);
					}
					$jenis_array[] = $value['jenis'];
					DB::table('direksi_sosmed')->insert([
						'id_direksi'=>$data->id_direksi,
						'jenis'=>$value['jenis'],
						'url'=>$value['url']
					]);
				}
			}
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Susunan Direksi berhasil ditambahkan !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function get_edit($id_direksi)
	{
		$result = SusunanDireksi::getEdit($id_direksi);
		$data = $result['data'];
		$sosmed = $result['sosmed'];
		return response()->json(['data'=>$data,'sosmed'=>$sosmed]);
	}
	public function update(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'id_jabatan' => 'required',
			'nama_direksi' => 'required',
			// 'upload' => 'required',
			'keterangan' => 'required'
		];
		$validateMessage += [
			'id_jabatan.required' => 'Jabatan harus dipilih.',
			'nama_direksi.required' => 'Nama harus diisi.',
			// 'upload.required' => 'Foto harus diupload.',
			'keterangan.required' => 'Keterangan harus diupload.'
		];
		if (isset($request->sosmed)) {
			foreach ($request->sosmed as $key => $value) {
				$validateRules += [
					'sosmed.*.jenis' => 'required',
					'sosmed.*.url' => 'required'
				];
				$validateMessage += [
					'sosmed.*.jenis.required' => 'Jenis Sosmed harus diisi.',
					'sosmed.*.url.required' => 'URL Sosmed harus diupload.'
				];
			}
		}
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();
			if (!empty($request->file('upload'))) {
				$ambil=$request->file('upload');
				$name=$ambil->getClientOriginalName();
				$namaFileBaru = uniqid();
				$namaFileBaru .= $name;
				$ambil->move(\base_path()."/public/susunan_direksi", $namaFileBaru);
				$berkas = public_path("susunan_direksi/".$request->uploadLama);
				File::delete($berkas);
			}else{
				$namaFileBaru = $request->uploadLama;
			}
			$data = SusunanDireksi::where('id_direksi',$request->id_direksi)->first();
			$data -> id_jabatan = $request->id_jabatan;
			$data -> nama_direksi = $request->nama_direksi;
			$data -> foto_direksi = $namaFileBaru;
			$data -> keterangan = $request->keterangan;
			$data -> save();
			if (isset($request->sosmed)) {
				foreach ($request->sosmed as $key => $value) {
					DB::table('direksi_sosmed')->where('id_direksi_sosmed',$value['id_direksi_sosmed'])->update([
						'jenis'=>$value['jenis'],
						'url'=>$value['url']
					]);
				}
			}
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Susunan Direksi berhasil diubah !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function delete($id_direksi)
	{
		try {
			DB::beginTransaction();
			$data = SusunanDireksi::where('id_direksi',$id_direksi)->first();
			$data -> delete();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Susunan Direksi berhasil dihapus !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
}
