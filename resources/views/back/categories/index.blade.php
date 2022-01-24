@extends('back.layouts.master')
@section('title','Tüm Kategoriler')
@section('content')
  <div class="row">
    <div class="col-md-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
        </div>
        <div class="card-body">
          <form class="" action="{{route('admin.category.create')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="">Kategori Adı</label>
              <input class="form-control" type="text" name="category" required value="">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block" name="">Ekle</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Kategori Adı</th>
                  <th>Makale Sayısı</th>
                  <th>Durum</th>
                  <th>İşlemler</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Kategori Adı</th>
                  <th>Makale Sayısı</th>
                  <th>Durum</th>
                  <th>İşlemler</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach($categories as $category)
                  <tr>
                    <td>{{$category->name}}</td>
                    <td>{{$category->getArticleCount()}}</td>
                    <td><input type="checkbox" class="switch" category-id="{{$category->id}}" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" @if($category->status==1) checked @endif data-toggle="toggle"></td>
                      <td>
                        <a category-id="{{$category->id}}" class="btn -btn-sm btn-primary edit-click" title="Kategoriyi Düzenle"><i class="fa fa-edit"></i></a>
                        <a category-id="{{$category->id}}" category-name="{{$category->name}}" category-count="{{$category->getarticleCount()}}" class="btn -btn-sm btn-danger remove-click" title="Kategoriyi Sil"><i class="fa fa-times"></i></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- The Modal EditModal -->
    <div class="modal" id="editModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Kategoriyi Düzenle</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <form class="" action="{{route('admin.category.update')}}" method="post">
              @csrf
              <div class="form-group">
                <label for="">Kategori Adı</label>
                <input id="category" type="text" class="form-control" name="category" value="">
                <input type="hidden" name="id" id="category_id" value="">
              </div>
              <div class="form-group">
                <label for="">Kategori Slug</label>
                <input id="slug" type="text" class="form-control" name="slug" value="">
              </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Kaydet</button>
              <button type="button" class="btn btn-warning" data-dismiss="modal">İptal</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- The Modal DeleteModal -->
    <div class="modal" id="deleteModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Kategoriyi Sil</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger" id="articleAlert"></div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <form class="" action="{{route('admin.category.delete')}}" method="post">
              @csrf
              <button id="deleteButton" type="submit" class="btn btn-danger">Sil</button>
              <input type="hidden" name="id" id="deleteId" value="">
              <button type="button" class="btn btn-warning" data-dismiss="modal">İptal</button>
            </form>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('css')
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script>
  $(function() {

    $('.remove-click').click(function(){
      id=$(this)[0].getAttribute('category-id');
      count=$(this)[0].getAttribute('category-count');
      name=$(this)[0].getAttribute('category-name');
      if(id==1){
        $('#articleAlert').html(name +' Kategorisi Silinemez!');
        $('#deleteButton').hide();
        $('#deleteModal').modal();
        return;
      }
      $('#deleteButton').show();
      $('#deleteId').val(id);
      if(count>0){
        $('#articleAlert').html('Bu Kategoriye Ait ' + count + ' Makale Bulunmaktadır! Kategoriyi Silmek İstediğinizden Emin misiniz?' );
      }
      else{
        $('#articleAlert').html('Bu Kategoriye Ait Makale Bulunmamaktadır! Kategoriyi Silmek İstediğinize Emin misiniz ?');
      }
      $('#deleteModal').modal();
    });

    $('.edit-click').click(function(){
      id=$(this)[0].getAttribute('category-id');
      $.ajax({
        type:'GET',
        url:'{{route('admin.category.getdata')}}',
        data:{id:id},
        success:function(data){
          console.log(data);
          $('#category').val(data.name);
          $('#slug').val(data.slug);
          $('#category_id').val(data.id);
          $('#editModal').modal()
        }
      });
    });

    $('.switch').change(function(){
      id=$(this)[0].getAttribute('category-id');
      //alert(id);return; //aldığı id değerini göster
      statu=$(this).prop('checked');
      //alert(statu); return; //aldığı statu değerini göster
      $.get("{{route('admin.category.switch')}}", {id:id, statu:statu}, function(data, status){
      });
    });

  })
  </script>
@endsection
