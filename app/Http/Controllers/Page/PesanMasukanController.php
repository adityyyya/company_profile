<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page\Project;
use App\Models\Page\PesanMasukkan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Crypt;

class PesanMasukanController extends Controller
{
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = PesanMasukkan::all();
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id_pesan.'" class="btn btn-danger text-white rounded-pill btn-sm delete"><i class="bx bx-trash"></i></a> ';
				$button .= '<a href="javascript:void(0)" title="Detail" more_id="'.$data->id_pesan.'" class="btn btn-info text-white rounded-pill btn-sm view"><i class="bx bx-list-ul"></i></a>';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		return view('page.admin.pesan_masukan.index');
	}
	public function get_view($id_pesan)
	{
		$data = PesanMasukkan::where('id_pesan',$id_pesan)->get();
		return response()->json($data);
	}
	public function delete($id_pesan)
	{
		try {
			DB::beginTransaction();
			$data = PesanMasukkan::where('id_pesan',$id_pesan)->first();
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
