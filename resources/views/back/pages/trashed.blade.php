@extends('back.layouts.master')
@section('title','Silinen Makaleler')
@section('content')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Toplam {{$articles->count()}} Makale Bulunmaktadır
        <span class="float-right"><a href="{{route('admin.makaleler.index')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Aktif Makaleler</a></span>
      </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Fotoğraf</th>
              <th>Makale Başlığı</th>
              <th>Kategori</th>
              <th>Görünütlenme Sayısı</th>
              <th>Oluşturulma Tarihi</th>
              <th>İşlemler</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Fotoğraf</th>
              <th>Makale Başlığı</th>
              <th>Kategori</th>
              <th>Görünütlenme Sayısı</th>
              <th>Oluşturulma Tarihi</th>
              <th>İşlemler</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach($articles as $article)
              <tr>
                <td><img src="{{$article->image}}" width="80"></td>
                <td>{{$article->title}}</td>
                <td>{{$article->getCategory->name}}</td>
                <td>{{$article->hit}}</td>
                <td>{{Date::parse( $article->created_at )->diffForHumans()}}</td>
                <td>
                  <a href="{{route('admin.recover.article',$article->id)}}" title="Kurtar" class="btn btn-sm btn-primary" ><i class="fa fa-recycle"></i></a>
                  <a href="{{route('admin.hard.delete.article',$article->id)}}" title="Sil" class="btn btn-sm btn-danger" ><i class="fa fa-times"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
