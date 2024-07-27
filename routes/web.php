<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Page\BerandaController;
use App\Http\Controllers\Page\ProfilController;
use App\Http\Controllers\Page\AboutController;
use App\Http\Controllers\Page\VisiMisiController;
use App\Http\Controllers\Page\KategoriController;
use App\Http\Controllers\Page\JabatanController;
use App\Http\Controllers\Page\SusunanDireksiController;
use App\Http\Controllers\Page\ProjectController;
use App\Http\Controllers\Page\BeritaController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Page\PesanMasukanController;
use App\Http\Controllers\Page\LowonganController;
use App\Http\Controllers\Page\LamaranController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear', function() {
	Artisan::call('cache:clear');
	Artisan::call('config:cache');
	dd("Sudah Bersih nih!, Silahkan Kembali ke Halaman Utama");
});


Route::get('/',[HomeController::class,'beranda'])->name('index.beranda');
Route::get('tentang_perusahaan',[HomeController::class,'about'])->name('index.about');
Route::get('direksi',[HomeController::class,'direksi'])->name('index.direksi');
Route::get('projects',[HomeController::class,'project'])->name('index.project');
Route::get('project/view/{id_project}',[HomeController::class,'project_view'])->name('project_view');
Route::get('news',[HomeController::class,'berita'])->name('index.berita');
Route::get('news/view/{judul}-{id_berita}',[HomeController::class,'view_berita'])->name('view_berita');
Route::get('kontak',[HomeController::class,'kontak'])->name('index.kontak');
Route::post('kontak/kirim_pesan_action',[HomeController::class,'kirim_pesan'])->name('save.kirim_pesan');
Route::get('karir',[HomeController::class,'karir'])->name('index.karir');



Route::get('auth', function () {
	return view('page.login');
})->name('login');
Route::get('daftar', function () {
	return view('page.register');
})->name('register');
Route::post('auth/request_login',[AuthController::class,'ceklogin'])->name('ceklogin');
Route::post('register/save',[HomeController::class,'register'])->name('register.akun');
Route::get('back/auth-logout',[AuthController::class,'logout'])->name('logout');
Route::middleware(['auth'])->prefix('page/company_menu')->group(function() {
	Route::get('beranda',[BerandaController::class,'index'])->name('data.beranda');
	Route::get('beranda/cek_beranda',[BerandaController::class,'cek_beranda'])->name('cek_beranda');
	Route::post('beranda/save',[BerandaController::class,'save'])->name('save.beranda');
	Route::get('beranda/get_edit/{id_beranda}',[BerandaController::class,'get_edit']);
	Route::post('beranda/update',[BerandaController::class,'update'])->name('update.beranda');
	Route::get('beranda/destroy/{id_beranda}',[BerandaController::class,'delete'])->name('delete.beranda');

	Route::get('profil',[ProfilController::class,'index'])->name('data.profil');
	Route::post('profil/save',[ProfilController::class,'save'])->name('save.profil');
	Route::post('profil/update',[ProfilController::class,'update'])->name('update.profil');
	Route::get('profil/destroy/{id_profil}',[ProfilController::class,'delete']);

	Route::post('about/save',[AboutController::class,'save'])->name('save.about');
	Route::post('about/update',[AboutController::class,'update'])->name('update.about');
	Route::get('about/destroy/{id_about}',[AboutController::class,'delete'])->name('delete.about');

	Route::get('visi_misi',[VisiMisiController::class,'index'])->name('data.visi_misi');
	Route::get('visi_misi/cek_visi_misi',[VisiMisiController::class,'cek_visimisi'])->name('cek_visimisi');
	Route::post('visi_misi/save',[VisiMisiController::class,'save'])->name('save.visi_misi');
	Route::get('visi_misi/get_edit/{id_visi_misi}',[VisiMisiController::class,'get_edit']);
	Route::post('visi_misi/update',[VisiMisiController::class,'update'])->name('update.visi_misi');
	Route::get('visi_misi/destroy/{id_visi_misi}',[VisiMisiController::class,'delete']);

	Route::get('susunan_direksi',[SusunanDireksiController::class,'index'])->name('data.direksi');
	Route::post('susunan_direksi/save',[SusunanDireksiController::class,'save'])->name('save.direksi');
	Route::get('susunan_direksi/get_edit/{id_direksi}',[SusunanDireksiController::class,'get_edit']);
	Route::post('susunan_direksi/update',[SusunanDireksiController::class,'update'])->name('update.direksi');
	Route::get('susunan_direksi/destroy/{id_direksi}',[SusunanDireksiController::class,'delete'])->name('delete.direksi');

	Route::get('project',[ProjectController::class,'index'])->name('data.project');
	Route::post('project/save',[ProjectController::class,'save'])->name('save.project');
	Route::get('project/get_edit/{id_project}',[ProjectController::class,'get_edit']);
	Route::get('project/destroy/{id_project}',[ProjectController::class,'delete']);

	Route::get('berita',[BeritaController::class,'index'])->name('data.berita');
	Route::post('berita/save',[BeritaController::class,'save'])->name('save.berita');
	Route::get('berita/get_edit/{id_berita}',[BeritaController::class,'get_edit']);
	Route::get('berita/destroy/{id_berita}',[BeritaController::class,'delete']);
});
Route::middleware(['auth'])->prefix('page/master_data')->group(function() {
	Route::get('kandidat',[HomeController::class,'data_kandidat'])->name('index.kandidat');
	Route::get('kandidat/destroy/{id_user}',[HomeController::class,'delete_kandidat']);

	Route::get('jabatan',[JabatanController::class,'index'])->name('index.jabatan');
	Route::post('jabatan/save',[JabatanController::class,'save'])->name('save.jabatan');
	Route::get('jabatan/get_edit/{id_jabatan}',[JabatanController::class,'get_edit']);
	Route::post('jabatan/update',[JabatanController::class,'update'])->name('update.jabatan');
	Route::get('jabatan/destroy/{id_jabatan}',[JabatanController::class,'delete']);

	Route::get('kategori',[KategoriController::class,'index'])->name('index.kategori');
	Route::post('kategori/save',[KategoriController::class,'save'])->name('save.kategori');
	Route::get('kategori/get_edit/{id_kategori}',[KategoriController::class,'get_edit']);
	Route::post('kategori/update',[KategoriController::class,'update'])->name('update.kategori');
	Route::get('kategori/destroy/{id_kategori}',[KategoriController::class,'delete']);
});
Route::middleware(['auth'])->prefix('page')->group(function() {
	Route::get('dashboard',[HomeController::class,'dashboard'])->name('index.dashboard');
	
	Route::get('pesan_masukkan',[PesanMasukanController::class,'index'])->name('index.pesan_masukkan');
	Route::get('pesan_masukkan/get_view/{id_pesan}',[PesanMasukanController::class,'get_view']);
	Route::get('pesan_masukkan/destroy/{id_pesan}',[PesanMasukanController::class,'delete']);
});
Route::middleware(['auth'])->prefix('page/master_karir')->group(function() {
	Route::get('lowongan',[LowonganController::class,'index'])->name('data.lowongan');
	Route::post('lowongan/save',[LowonganController::class,'save'])->name('save.lowongan');
	Route::get('lowongan/get_edit/{id_lowongan}',[LowonganController::class,'get_edit']);
	Route::get('lowongan/destroy/{id_lowongan}',[LowonganController::class,'delete']);
});

Route::middleware(['auth'])->prefix('page')->group(function() {
	Route::get('lamar_kerja/{nama_jabatan}/{id_lowongan}',[LamaranController::class,'form_lamar'])->name('form_lamar');
	Route::post('lamar-send',[LamaranController::class,'kirim_lamaran'])->name('kirim_lamaran');
	Route::get('riwayat_lamaran',[LamaranController::class,'riwayat_lamaran'])->name('riwayat_lamaran');
	Route::get('riwayat_lamaran/view/{id_lamaran}',[LamaranController::class,'detail_riwayat_lamaran'])->name('detail_riwayat_lamaran');
});
Route::post('myprofil',[HomeController::class,'edit_profil'])->name('edit_profil');