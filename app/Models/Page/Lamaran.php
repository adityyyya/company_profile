<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lamaran extends Model
{
    // use HasFactory;
	protected $table="lamaran";
	protected $primaryKey="id_lamaran";

	public static function getLamaran()
	{
		$data = Lowongan::join('jabatan','jabatan.id_jabatan','=','lowongan.id_jabatan')
		->join('lamaran','lamaran.id_lowongan','=','lowongan.id_lowongan')
		->join('users','users.id','=','lamaran.id_user')
		->join('biodata','biodata.id_user','=','users.id')
		->select(
			\DB::RAW('users.name as name'),
			\DB::RAW('users.email as email'),
			\DB::RAW('biodata.telepon as telepon'),
			\DB::RAW('jabatan.nama_jabatan as nama_jabatan'),
			\DB::RAW('lowongan.id_lowongan as id_lowongan'),
			\DB::RAW('lamaran.id_lamaran as id_lamaran'),
			\DB::RAW('lamaran.created_at as tanggal_apply')
		);
		if (Auth::user()->level == 'Kandidat') {
			$data->where('lamaran.id_user',Auth::user()->id);
		}
		$data = $data->get();
		return $data;
	}
	public static function getDetailLamaran($id_lamaran)
	{
		$data = Lowongan::join('jabatan','jabatan.id_jabatan','=','lowongan.id_jabatan')
		->join('lamaran','lamaran.id_lowongan','=','lowongan.id_lowongan')
		->join('users','users.id','=','lamaran.id_user')
		->join('biodata','biodata.id_user','=','users.id')
		->select(
			\DB::RAW('users.name as name'),
			\DB::RAW('users.email as email'),
			\DB::RAW('biodata.telepon as telepon'),
			\DB::RAW('biodata.nik as nik'),
			\DB::RAW('biodata.jenis_kelamin as jenis_kelamin'),
			\DB::RAW('biodata.alamat as alamat'),
			\DB::RAW('biodata.foto as foto'),
			\DB::RAW('lowongan.deskripsi as deskripsi'),
			\DB::RAW('jabatan.nama_jabatan as nama_jabatan'),
			\DB::RAW('lowongan.id_lowongan as id_lowongan'),
			\DB::RAW('lamaran.berkas as berkas'),
			\DB::RAW('lamaran.id_lamaran as id_lamaran'),
			\DB::RAW('lamaran.created_at as tanggal_apply')
		);
		if (Auth::user()->level == 'Kandidat') {
			$data->where('lamaran.id_user',Auth::user()->id);
		}
		$data = $data->where('lamaran.id_lamaran',$id_lamaran)->get();
		return $data;
	}
}
