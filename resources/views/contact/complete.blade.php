@extends('layout')

@section('content')

    <h1>お問い合わせが完了しました。</h1>
    <p>メールが正常に送信されました。</p>
    <p>今後ともよろしくお願いします。</p>
    <a href="{{ route('posts.index') }}">掲示板一覧に戻る</a>
@endsection