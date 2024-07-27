<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // use HasFactory;
    protected $table="project";
	protected $primaryKey="id_project";

	public static function getProject($request)
	{
		$data = Project::leftJoin('kategori','kategori.id_kategori','=','project.id_kategori')
		->get();
		return $data;
	}
	public static function getEdit($id_project)
	{
		$data = Project::leftJoin('kategori','kategori.id_kategori','=','project.id_kategori')
		->where('project.id_project',$id_project)
		->get();
		return $data;
	}
}
