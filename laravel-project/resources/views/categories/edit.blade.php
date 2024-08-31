<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>カテゴリー編集</title>
</head>
<body>
@include('header')
<div class="main">
  <div class="title">
    <h1 class="title-top">カテゴリー編集</h1>
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

  <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="POST" class="form">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="name" class="form-label">タイトル</label>
      <input type="text" name="name" id="name" placeholder="タイトル" class="form-input" value="{{ old('name', $category->name) }}">
    </div>
    
    <div class="form-group">
      <button type="submit" class="form-submit-button">更新</button>
    </div>
  </form>
</div>
</body>
</html>
