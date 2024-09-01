<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メモ一覧</title>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/top.css') }}">
</head>
<body>
  <header class="header">
    @include('header')
  </header>
  <main class="container">
    <div class="title">
      <h1 class="title-top">メモ一覧</h1>
    </div>

    <!-- 絞り込み検索 -->
    <div class="filter">
      <div class="memo-filter">
        <form action="" class="search-form" method="GET">
          @csrf
          <input type="text" name="search" placeholder="Search..." class="search-form-input" value="{{ request('search') }}">
          <button type="submit" class="search-form-button">検索</button>
        </form>

        <div class="sort">
          <form action="{{ route('memo.index') }}" class="sort-new" method="GET">
            @csrf
            <input type="hidden" name="search" value="{{ request('search') }}">
            <button type="submit" class="sort-new-button" name="sort" value="newest">新しい順</button>
          </form>
          <form action="{{ route('memo.index') }}" class="sort-old" method="GET">
            @csrf
            <input type="hidden" name="search" value="{{ request('search') }}">
            <button type="submit" class="sort-old-button" name="sort" value="oldest">古い順</button>
          </form>
        </div>
      </div>

      <div class="category-filter">
        <!-- 検索とカテゴリフィルター -->
        <form action="{{ route('memo.index') }}" class="search-form" method="GET">
              @csrf
              <label for="category" class="search-form-label">カテゴリ:</label>
              <select id="category" name="category" class="search-form-select">
                <option value="">すべて</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                      {{ $category->name }}
                  </option>
                @endforeach
              </select>
              <button type="submit" class="search-form-button">検索</button>
          </form>
      </div>
    </div>

    

    <table class="table" border="1">
      <tr class="table-tr">
        <th class="table-th">タイトル</th>
        <th class="table-th">内容</th>
        <th class="table-th">カテゴリ</th>
        <th class="table-th">編集</th>
        <th class="table-th">削除</th>
      </tr>

      @foreach($memos as $memo)
      <tr class="table-tr">
        <td class="table-td">{{ $memo->title->getValue() }}</td>
        <td class="table-td">{{ $memo->content->getValue() }}</td>
        <td class="table-td">{{ $memo->category ? $memo->category->name : 'カテゴリなし' }}</td>
        <td class="table-td">
          <a href="{{ route('memo.edit', ['id' => $memo->id]) }}" class="edit-link">編集</a>
        </td>
        <td class="table-td">
          <form action="{{ route('memo.destroy', ['id' => $memo->id]) }}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit" class="delete-link"">削除</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </main>
</body>
</html>
