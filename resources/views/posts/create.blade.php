@extends('layout')

@section('content')

        <h2>新規投稿</h2>
        <form action="{{ route('posts.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">タイトル</label>
                <input type="text" name="title" class="form-control" id="title">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">内容</label>
                <textarea class="form-control" name="content" id="content" rows="5" value="" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">投稿</button>
        </form>
        <div class="mt-3">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">戻る</a>
        </div>
@endsection