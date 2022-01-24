@extends('back.layouts.master')
@section('title',$article->title.' Makalesini Güncelle')
@section('content')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    </div>
    <div class="card-body">
      @if($errors->any())
        <div class="alert alert-danger">
          @foreach($errors->all() as $error)
            <li>
              {{$error}}
            </li>
          @endforeach
        </div>
      @endif
      <form action="{{route('admin.makaleler.update',$article->id)}}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
          <label>Makale Başlığı</label>
          <input type="text" name="title" class="form-control" value="{{$article->title}}" required></input>
        </div>
        <div class="form-group">
          <label>Makale Kategori</label>
          <select class="form-control" name="category" required>
            <option style="cursor:pointer">Seçim Yapınız...</option>
            @foreach($categories as $category)
              <option  @if($article->category_id==$category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="fileUpload">Makale Fotoğrafı</label><br>
            <img src="{{asset($article->image)}}" class="img-thumbnail rounded img-fluid" width="200">
            <input type="file" id="fileUpload" name="image" class="form-control"></input>
          </div>
          <div class="form-group">
            <label>Makale İçeriği</label>
            <textarea name="content" id="editor" class="form-control" rows="4" required>{!!$article->content!!}</textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" >Makale Oluştur</button>
          </div>
        </div>
      </form>
    </div>
  @endsection
  @section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
    input[type=file]::file-selector-button {
      margin-left: -6px;
      padding: 0px;
      height: 25px;
      width: 100px;
      color: red;
      cursor:pointer;
    }
    </style>
  @endsection
  @section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $('#editor').summernote(
        {
          height:250
        }
      );
    });
  </script>
@endsection
