<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    // use HasFactory;
	protected $table="lowongan";
	protected $primaryKey="id_lowongan";

	public static function getLowongan($request)
	{
		$data = Lowongan::join('jabatan','jabatan.id_jabatan','=','lowongan.id_jabatan');
		if (empty($request->status)) {
			$data->where('lowongan.status','A');
		}
		$data = $data->get();
		return $data;
	}
	public static function getEdit($id_lowongan)
	{
		$data = Lowongan::join('jabatan','jabatan.id_jabatan','=','lowongan.id_jabatan')
		->where('lowongan.id_lowongan',$id_lowongan)
		->get();
		return $data;
	}
	public static function getFormLamaran($nama_jabatan, $id_lowongan)
	{
		$data = Lowongan::join('jabatan','jabatan.id_jabatan','=','lowongan.id_jabatan')
		->where('jabatan.nama_jabatan',$nama_jabatan)
		->where('lowongan.id_lowongan',$id_lowongan)
		->get();
		return $data;
	}
}
