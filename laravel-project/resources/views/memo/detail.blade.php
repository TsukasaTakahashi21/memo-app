<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メモ詳細ページ</title>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/top.css') }}">
</head>
<body>
<header class="header">
    @include('header')
  </header>
  <main class="container">
  <div class="title">
      <h1 class="title-top">メモ詳細</h1>
    </div>

    <div class="memo-detail">
      <h2 class="title">{{$memo->title->getValue() }}</h2>
      <p class="category">カテゴリ: {{ $memo->category ? $memo->category->name : 'カテゴリなし' }}</p>
      <p class="content">{{ $memo->content->getValue() }}</p>
    </div>

    <a href="{{ route('memo.index') }}" class="back-link">戻る</a>
  </main>
</body>
</html>