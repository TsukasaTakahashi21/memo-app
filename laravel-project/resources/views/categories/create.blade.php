<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カテゴリ追加</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create-edit.css') }}">
</head>
<body>
    <header class="header">
        @include('header')
    </header>

    <main class="container">
        <div class="title">
            <h1 class="title-top">カテゴリ登録</h1>
        </div>

        @if ($errors->any())
        <div class="error-messages">
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                <li class="error-item">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('categories.store') }}" method="post" class="form">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">カテゴリ名 :</label>
                <input type="text" name="name" id="name" placeholder="カテゴリ名" class="form-input" value="">
            </div>

            <div class="submit-group">
                <button type="submit" class="form-submit-button">送信</button>
            </div>
        </form>
    </main>
</body>
</html>
