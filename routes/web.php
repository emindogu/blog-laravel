<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\Homepage;
use App\Http\Controllers\Back\Dashboard;
use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\PageController;
use App\Http\Controllers\Back\ConfigController;

//Back Routes
Route::get('aktif-degil',function(){
  return view('front.offline');
});

Route::prefix('admin')->name('admin.')->group(function() {

  //Route::group(['middleware' => 'isLogin'], function(){
    Route::get('giris',[AuthController::class,'login'])->name('login');
    Route::post('giris',[AuthController::class,'loginPost'])->name('login.post');
  //});

  Route::group(['middleware' => 'isAdmin'], function(){
    Route::get('panel',[Dashboard::class,'index'])->name('dashboard');
    //Makale
    Route::get('makaleler/silinenler',[ArticleController::class, 'trashed'])->name('trashed.article');
    Route::resource('makaleler', ArticleController::class);
    Route::get('switch',[ArticleController::class,'switch'])->name('switch');
    Route::get('deletearticle/{id}',[ArticleController::class,'delete'])->name('delete.article');
    Route::get('harddeletearticle/{id}',[ArticleController::class,'hardDelete'])->name('hard.delete.article');
    Route::get('recoverarticle/{id}',[ArticleController::class,'recover'])->name('recover.article');
    //Kategori
    Route::get('kategoriler',[CategoryController::class,'index'])->name('category.index');
    Route::post('kategoriler/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('kategoriler/update',[CategoryController::class,'update'])->name('category.update');
    Route::post('kategoriler/delete',[CategoryController::class,'delete'])->name('category.delete');
    Route::get('kategori/status',[CategoryController::class,'switch'])->name('category.switch');
    Route::get('kategori/getData',[CategoryController::class,'getData'])->name('category.getdata');
    //Sayfa
    Route::get('sayfalar',[PageController::class,'index'])->name('page.index');
    Route::get('sayfalar/olustur',[PageController::class,'create'])->name('page.create');
    Route::get('sayfalar/guncelle/{id}',[PageController::class,'update'])->name('page.edit');
    Route::post('sayfalar/guncelle/{id}',[PageController::class,'updatePost'])->name('page.edit.post');
    Route::post('sayfalar/olustur',[PageController::class,'post'])->name('page.create.post');
    Route::get('sayfa/switch',[PAgeController::class,'switch'])->name('page.switch');
    Route::get('sayfa/sil/{id}',[PageController::class,'delete'])->name('page.delete');
    Route::get('sayfa/siralama',[PageController::class,'orders'])->name('page.orders');
    //CONFİG
    Route::get('ayarlar',[ConfigController::class,'index'])->name('config.index');
    Route::post('ayarlar/update',[ConfigController::class,'update'])->name('config.update');
    //
    Route::get('cikis',[AuthController::class,'logout'])->name('logout');
  });
});

//Front Routes

Route::get('/', [Homepage::class,'index'])->name('homepage');
Route::get('/kategori/{category}',[Homepage::class,'category'])->name('category');
Route::get('/iletisim',[Homepage::class,'contact'])->name('contact');
Route::post('/iletişim',[Homepage::class,'contactpost'])->name('contact.post');
Route::get('/{category}/{slug}',[Homepage::class,'single'])->name('single');
Route::get('/{sayfa}',[Homepage::class,'page'])->name('page');
