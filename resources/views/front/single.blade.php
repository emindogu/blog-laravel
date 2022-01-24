@extends('front.layouts.master')
@section('title',$article->title)
@section('bg',$article->image)
@section('content')
  <div class="col-md-9 mx-auto">
    <h2 class="section-heading">{{$article->title}}</h2>
    <p>{!!$article->content!!}</p>
    <blockquote class="blockquote">{{$article->created_at}}
    <span class="float-end">Görüntülenme Sayısı: <b><span class="text-danger">{{$article->hit}}</span></b></span>
     </blockquote>
    </div>
  @include('front.widgets.categoryWidget')
@endsection
