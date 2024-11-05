<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>header</title>
</head>
<body>
<header>
    <nav class="nav">
      <div class="nav-list">
        <a href="{{ route('memo.index') }}" class="nav-link">メモ一覧</a>
        <a href="{{ route('categories.index') }}" class="nav-link">カテゴリ一覧</a>
        <a href="{{ route('memo.create') }}" class="nav-link">メモを追加</a>
        <a href="{{ route('categories.create') }}" class="nav-link">カテゴリを追加</a>
      </div>
    </nav>
  </header>
</body>
</html>