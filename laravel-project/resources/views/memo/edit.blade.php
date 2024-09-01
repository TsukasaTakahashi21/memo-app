<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メモ編集</title>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create-edit.css') }}">
</head>
<body>
  <header class="header">
        @include('header')
  </header>

  <main class="container">
    <div class="title">
      <h1 class="title-top">メモ編集</h1>
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

    <form action="{{ route('memo.update', ['id' => $memo->id]) }}" method="POST" class="form">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="title" class="form-label">title :</label>
        <input type="text" name="title" id="title" placeholder="タイトル" class="form-input" value="{{ old('title', $memo->title->getValue()) }}">
      </div>

      <div class="form-group">
        <label for="content" class="form-label">本文 :</label>
        <textarea name="content" id="content" placeholder="本文" class="form-textarea">{{ old('content', $memo->content->getValue()) }}</textarea>
      </div>
      
      <div class="submit-group">
        <button type="submit" class="form-submit-button">送信</button>
      </div>
    </form>
  </main>
</body>
</html>

