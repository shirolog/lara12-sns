@extends('layout')

@section('content')

    <h2>お問い合わせ</h2>

    <form action="{{ route('contact.confirm') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">お名前</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="name" required>            
            @if($errors->has('name'))
                <div class="text-danger">{{ $errors->first('name') }}</div>
            @endif
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="name" required>            
            @if($errors->has('email'))
                <div class="text-danger">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">メッセージ</label>
            <textarea id="message" name="message" class="form-control" required rows="5">{{ old('message') }}</textarea>            
            @if($errors->has('message'))
                <div class="text-danger">{{ $errors->first('message') }}</div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">確認</button>
    </form>
        
@endsection