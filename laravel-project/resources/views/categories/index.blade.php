<!DOCTYPE html>
<html>
<head>
    <title>カテゴリ一覧</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- スタイルシートをリンク -->
</head>
<body>
@include('header')
    <div class="main">
        <div class="title">
            <h1 class="title-top">カテゴリ一覧</h1>
        </div>

        <table class="table" border="1">
            <tr class="table-tr">
                <th class="table-th">カテゴリ名</th>
                <th class="table-th">編集</th>
                <th class="table-th">削除</th>
            </tr>

            @foreach($categories as $category)
            <tr class="table-tr">
                <td class="table-td">{{ $category->name }}</td>
                <td class="table-td">
                    <a href="{{ route('categories.edit', ['id' => $category->id]) }}" class="edit-link">編集</a>
                </td>
                <td class="table-td">
                    <form action="{{ route('categories.destroy', ['id' => $category->id]) }}" class="delete" method="POST">
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
</body>
</html>
