<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page\Project;
use App\Models\Page\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Crypt;

class ProjectController extends Controller
{
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = Project::getProject($request);
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id_project.'" class="btn btn-success text-white rounded-pill btn-sm edit"><i class="bx bx-edit"></i></a> ';
				$button .= '<a href="javascript:void(0)" more_id="'.$data->id_project.'" class="btn btn-danger text-white rounded-pill btn-sm delete"><i class="bx bx-trash"></i></a> ';
				$button .= '<a href="javascript:void(0)" class="btn btn-info text-white rounded-pill btn-sm"><i class="fa fa-eye"></i></a>';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		$kategori = Kategori::all();
		return view('page.admin.project.index',compact('kategori'));
	}
	public static function save(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'id_kategori' => 'required',
			'judul' => 'required',
			'tanggal' => 'required',
			'deskripsi' => 'required'
		];
		$validateMessage += [
			'id_kategori.required' => 'Kategori harus dipilih.',
			'judul.required' => 'Judul harus diisi.',
			'tanggal.required' => 'Tanggal harus diisi.',
			'deskripsi.required' => 'Deskripsi harus diisi.'
		];
		if ($request->id_project == '') {
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
			if ($request->id_project == '') {
				$ambil=$request->file('image');
				$name=$ambil->getClientOriginalName();
				$namaFileBaru = uniqid();
				$namaFileBaru .= $name;
				$ambil->move(\base_path()."/public/project", $namaFileBaru);
				$data = New Project();
				$text = 'Project berhasil ditambahkan !!';
			}else{
				if (!empty($request->file('image'))) {
					$ambil=$request->file('image');
					$name=$ambil->getClientOriginalName();
					$namaFileBaru = uniqid();
					$namaFileBaru .= $name;
					$ambil->move(\base_path()."/public/project", $namaFileBaru);
					$berkas = public_path("project/".$request->imageLama);
					File::delete($berkas);
				}else{
					$namaFileBaru = $request->imageLama;
				}
				$data = Project::where('id_project',$request->id_project)->first();
				$text = 'Project berhasil diubah !!';
			}
			$data -> id_kategori = $request->id_kategori;
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
	public function get_edit($id_project)
	{
		$data = Project::getEdit($id_project);
		return response()->json($data);
	}
	public function delete($id_project)
	{
		try {
			DB::beginTransaction();
			$data = Project::where('id_project',$id_project)->first();
			$data -> delete();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Data Project berhasil dihapus !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
}
