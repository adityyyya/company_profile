<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page\Beranda;
use App\Models\Page\About;
use App\Models\Page\VisiMisi;
use App\Models\Page\ProfileCompany;
use App\Models\Page\Lamaran;
use App\Models\Page\SusunanDireksi;
use App\Models\Page\Project;
use App\Models\Page\Lowongan;
use App\Models\Page\PesanMasukkan;
use App\Models\Page\Berita;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
	protected $company_name;

	public function __construct()
	{
		$this->company_name = ProfileCompany::first();
	}

	public function beranda()
	{
		$beranda = Beranda::all();
		return view('home.beranda.index',compact('beranda'))->with('company_name', $this->company_name->nama ?? '');
	}
	public function about()
	{
		$about = About::all();
		$visi_misi = VisiMisi::all();
		return view('home.about.index',compact('about','visi_misi'))->with('company_name', $this->company_name->nama ?? '');
	}
	public function direksi()
	{
		$data = SusunanDireksi::getSusunanDireksi();
		return view('home.direksi.index',compact('data'));
	}
	public function project(Request $request)
	{
		$data = Project::getProject($request);
		return view('home.project.index',compact('data'));
	}
	public function project_view($id_project)
	{
		$project_id = Crypt::decryptString($id_project);
		$data = Project::leftJoin('kategori','kategori.id_kategori','=','project.id_kategori')
		->where('project.id_project',$project_id)
		->get();
		return view('home.project.view',compact('data'));
	}
	public function berita()
	{
		$data = Berita::all();
		return view('home.berita.index',compact('data'));
	}
	public function view_berita($judul, $id_berita)
	{
		$data = Berita::where('judul',$judul)
		->where('id_berita',$id_berita)->get();
		$lain = Berita::where('judul','!=',$judul)
		->where('id_berita','!=',$id_berita)
		->limit('8')
		->get();
		return view('home.berita.view',compact('data','lain'));
	}
	public function kontak()
	{
		$company_name = ProfileCompany::first();
		return view('home.kontak.index',compact('company_name'));
	}
	public function kirim_pesan(Request $request)
	{
		$validateRules = [];
		$validateMessage = [];

		$validateRules += [
			'nama' => 'required',
			'email' => 'required',
			'isi' => 'required'
		];
		$validateMessage += [
			'nama.required' => 'Nama wajib diisi.',
			'email.required' => 'Telepon harus diisi.',
			'isi.required' => 'Isi/Keterangan harus diisi.'
		];
		$request->validate($validateRules, $validateMessage);
		try {
			DB::beginTransaction();
			$data = New PesanMasukkan();
			$data -> nama = $request->nama;
			$data -> email = $request->email;
			$data -> isi = $request->isi;
			$data -> save();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Terimakasih telah memberi saran dan masukkan untuk kami !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function karir(Request $request)
	{
		$data = Lowongan::getLowongan($request);
		return view('home.karir.index',compact('data'));
	}
	public function register(Request $request)
	{
		try {
			DB::beginTransaction();
			$data = New User();
			$data -> name = $request->name;
			$data -> email = $request->email;
			$data -> password = hash::make($request->password);
			$data -> level = 'Kandidat';
			$data -> status_user = 'A';
			$data -> save();
			DB::table('biodata')->insert([
				'id_user'=>$data->id,
				'nik'=>$request->nik
			]);
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Daftar Akun berhasil, silahkan Login !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function edit_profil(Request $request)
	{
		try {
			DB::beginTransaction();
			$data = User::where('id',Auth::user()->id)->first();
			if (Auth::user()->level == 'Admin') {
				$data -> name = $request->name_profil;
				$data -> email = $request->email_profil;
			}
			if ($request->password != '') {
				$data -> password = hash::make($request->password_profil);
			}
			$data -> save();
			DB::commit();
			return redirect()->back();
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function dashboard()
	{
		$lamaran = Lamaran::whereDate('created_at', now()->toDateString())->count();
		$user = User::where('level','Kandidat')->count();
		return view('page.admin.dashboard.index',compact('lamaran','user'));
	}
	// 
	public function data_kandidat(Request $request)
	{
		if ($request->ajax()) {
			$data = User::join('biodata','biodata.id_user','=','users.id')
			->get();
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id.'" class="btn btn-danger text-white rounded-pill btn-sm delete"><i class="bx bx-trash"></i></a>';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		return view('page.admin.user.index');
	}
	public function delete_kandidat($id)
	{
		try {
			DB::beginTransaction();
			$data = User::where('id',$id)->first();
			$data -> delete();
			DB::commit();
			return response()->json(['status'=>'true', 'message'=>'Kandidat berhasil dihapus !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
}
