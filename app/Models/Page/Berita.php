<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    // use HasFactory;
    protected $table="berita";
	protected $primaryKey="id_berita";

	public static function getEdit($id_berita)
	{
		$data = Berita::where('id_berita',$id_berita)
		->get();
		return $data;
	}
}
