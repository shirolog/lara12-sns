@extends('layout')

@section('content')

    <h2>お問い合わせ</h2>

    <form action="{{ route('contact.send') }}" method="post">
        @csrf

        <input type="hidden" name="name" value="{{ $contactData['name'] }}">
        <input type="hidden" name="email" value="{{ $contactData['email'] }}">
        <input type="hidden" name="message" value="{{ $contactData['message'] }}">

        <div class="mb-3">
            <label for="name" class="form-label">お名前</label>
            <p>{{ $contactData['name'] }}</p>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <p>{{ $contactData['email'] }}</p>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">メッセージ</label>
            <p>{{ $contactData['message'] }}</p>
        </div>

        <button type="button" onclick="history.back()" class="btn btn-secondary">修正</button>
        <button type="submit" class="btn btn-primary">送信</button>
    </form>
        
@endsection