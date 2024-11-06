<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メモ登録</title>
</head>

<body>
@include('header')
  <div class="main">
    <div class="title">
      <h1 class="title-top">メモ登録</h1>
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

    <form action="{{ route('memo.store') }}" method="post" class="form">
    @csrf
      <div class="form-group">
        <label for="category" class="form-label">カテゴリ</label>
        <select name="category_id" id="category"  class="form-select">
          <option value="">カテゴリを選択</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
          <label for="title" class="memo-title">タイトル</label>
          <input type="text" name="title" id="title" placeholder="タイトル" class="input-title" value="">
      </div>

      <div class="form-group">
        <label for="content" class="form-label">本文</label>
        <textarea name="content" id="content" placeholder="本文" class="form-textarea">{{ old('content') }}</textarea>
      </div>

      <div class="form-group">
        <button type="submit" class="form-submit-button">送信</button>
      </div>
    </form>
  </div>
</body>
</html>