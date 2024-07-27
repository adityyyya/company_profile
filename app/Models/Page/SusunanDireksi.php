<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SusunanDireksi extends Model
{
    // use HasFactory;
    protected $table="direksi";
	protected $primaryKey="id_direksi";

	public static function getSusunanDireksi()
	{
		$data = SusunanDireksi::leftJoin('jabatan','jabatan.id_jabatan','=','direksi.id_jabatan')
		->get();
		return $data;;
	}
	public static function getEdit($id_direksi)
	{
		$result = SusunanDireksi::leftJoin('jabatan','jabatan.id_jabatan','=','direksi.id_jabatan')
		->where('direksi.id_direksi',$id_direksi);
		$data = clone $result;
		$data = $data->get();
		$sosmed = clone $result;
		$sosmed = $sosmed->join('direksi_sosmed','direksi_sosmed.id_direksi','=','direksi.id_direksi')
		->get();
		return ['data'=>$data,'sosmed'=>$sosmed];
	}
}
