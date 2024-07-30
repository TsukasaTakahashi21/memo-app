<div class="main">
  <!-- 絞り込み検索 -->
  <form action="" class="search-form" method="GET">
    @csrf
    <input type="text" name="search" placeholder="Search..." class="search-form-input" value="{{ request('search') }}">
    <button type="submit" class="search-form-button">検索</button>
  </form>

  <div class="title">
    <h1 class="title-top">メモ一覧</h1>
  </div>
  <div class="link"><a href="{{ route('memo.create') }}" class="link-create">メモを追加</a></div>

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

  <table class="table" border="1">
    <tr class="table-tr">
      <th class="table-th">タイトル</th>
      <th class="table-th">内容</th>
      <th class="table-th">作成日時</th>
      <th class="table-th">編集</th>
      <th class="table-th">削除</th>
    </tr>

    @foreach($memos as $memo)
    <tr class="table-tr">
      <td class="table-td">{{ $memo->title->getValue() }}</td>
      <td class="table-td">{{ $memo->content->getValue() }}</td>
      <td class="table-td">{{ $memo->created_at }}</td>
      <td class="table-td">
        <a href="{{ route('memo.edit', ['id' => $memo->id]) }}" class="edit-link">編集</a>
      </td>
      <td class="table-td">
        <form action="{{ route('memo.destroy', ['id' => $memo->id]) }}" class="delete" method="POST">
          @method('DELETE')
          @csrf
          <input type="hidden" name="id" value="">
          <button type="submit" class="delete-button">削除</button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>