<!DOCTYPE html>
<html>
<head>
    <title>カテゴリ追加</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- スタイルシートをリンク -->
</head>
<body>
@include('header')
    <div class="main">
        <div class="title">
            <h1 class="title-top">カテゴリ登録</h1>
        </div>

        @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('categories.store') }}" method="post" class="form">
            @csrf
            <div class="form-title">
                <label for="name" class="category-name">カテゴリ名 :</label>
                <input type="text" name="name" id="name" placeholder="カテゴリ名" class="input-name" value="">
            </div>

            <div class="submit">
                <button type="submit" class="submit-button">送信</button>
            </div>
        </form>
    </div>
</body>
</html>
