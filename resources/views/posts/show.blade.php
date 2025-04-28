@extends('layout')

@section('content')

    <h2>投稿詳細</h2>

    <div class="card mb-3">
        <div class="card-body">
            <h3 class="card-title">{{ $post->title }}</h3>
            <p class="card-text">{{ $post->content }}</p>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">戻る</a>
            @if(Auth::check() && Auth::user()->id == $post->user_id)
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">編集</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('削除しますか？')">削除</button>
                </form>
            @endif
        </div>
    </div> 

    {{-- いいねボタン --}}
    <form action="{{ route('posts.like', $post->id) }}" style="display: inline;" method="post">
        @csrf
        <button type="submit" class="btn {{ $post->likes->contains('user_id', Auth()->id()) ? 'btn-danger' : 'btn-outline-danger' }} ">
            {!! $post->likes->contains('user_id', Auth()->id()) ? '<i class="bi bi-heart-fill"></i>' : '<i class="bi bi-heart"></i>' !!} 
        </button>
    </form>

    {{-- いいねの数を表示 --}}
    <p>{{ $post->likes->count() }}件のいいね</p>

    {{-- コメント一覧 --}}
    <h3>コメント一覧</h3>
    @if($comments->isNotEmpty())
        @foreach ($comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    <p class="card-text">{{ $comment->content }}</p>
                    <p class="text-muted">投稿者: {{ $comment->user->name }} | 投稿日時: {{ $comment->created_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>
        @endforeach
    @endif

    {{-- コメントフォーム --}}
    <h3>コメントを投稿する</h3>
    @auth
        <form action="{{ route('comments.store', $post->id) }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="content" class="form-label">コメント内容</label>
                <textarea  name="content" id="content" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">コメント投稿</button>
        </form>
    @else
        <p>コメントを投稿するにはログインしてください。</p>
    @endauth

    
    @if($comments->isNotEmpty())
        <div class="d-flex justify-content-center mt-4">
            {{ $comments->onEachSide(1)->links() }}
        </div>
    @endif
@endsection