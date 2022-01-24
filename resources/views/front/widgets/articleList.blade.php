@if(count($articles)>0)
  @foreach($articles as $article)
    <!-- Post preview-->
    <div class="post-preview">
      <a href="{{route('single',[$article->getCategory->slug, $article->slug] )}}">
        <h2 class="post-title">{{$article->title}}</h2>
        <img src="{{$article->image}}" alt="{{$article->slug}}" width="200">
        <h3 class="post-subtitle">{!!str_limit($article->content,85)!!}</h3>
      </a>
      <p class="post-meta">Kategori:
        <a href="#!">{{$article->getCategory->name}}</a>
        <span class="float-end">{{$article->created_at->diffForHumans()}}</span>
      </p>
    </div>
    <!-- Divider-->
    @if(!$loop->last)
      <hr class="my-4" />
    @endif
    <!-- Post preview-->
  @endforeach()
  {{$articles->links('pagination::bootstrap-4')}}
@else
  <div class="alert alert-danger" style="text-align:center"> Bu Kategoriye Ait Veri Bulunamadı </div>
@endif
