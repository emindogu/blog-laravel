@extends('front.layouts.master')
@section('title','İletişim')
@section('bg','https://www.scame.com/documents/20143/232052098/header-Contact-us.jpg/9e186420-3a81-b244-47e4-6ba9afffdf80?t=1553717922505')
@section('content')
  <div class="col-md-10 col-lg-8 col-xl-7">
    <p><b>Bizimle İletişime geçebilirsiniz!</b></p>
    <div class="my-5">
      @if(session('success'))
        <div class="alert alert-success">
          {{session('success')}}
        </div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach($errors->all() as $error)
                <li>{{$error}}</li>
              @endforeach
          </ul>
        </div>
      @endif
      <form method="post" action="{{route('contact.post')}}">
        @csrf
        <div>
          <label for="name">Ad Soyad</label>
          <input class="form-control" name="name" value="{{old('name')}}" type="text" placeholder="Ad Soyad Giriniz..."  required />
        </div><br />

        <div>
          <label for="email">Email Adresi</label>
          <input class="form-control" name="email" value="{{old('email')}}" type="email" placeholder="Mail Adresi Giriniz..." required/>
        </div><br />

        <div>
          <label for="topic">Konu</label>
          <select class="form-control" name="topic">
            <option @if(old('topic')=='Bilgi') selected @endif>Bilgi</option>
            <option @if(old('topic')=='Destek') selected @endif>Destek</option>
            <option @if(old('topic')=='Genel') selected @endif>Genel</option>
          </select>
        </div><br />

        <div>
          <label for="message">Mesaj</label>
          <textarea class="form-control" name="message" placeholder="Mesaj Giriniz..." style="height: 12rem" required>{{old('message')}}</textarea>
          <div class="invalid-feedback" data-sb-feedback="message:required">Mesaj Gerekli</div>
        </div> <br />

        <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Gönder</button>

      </form>
    </div>
  </div>
@endsection
