<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カテゴリ一覧</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/top.css') }}">
</head>
<body>
    <header class="header">
        @include('header')
    </header>
    <main class="container">
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
                    <form action="{{ route('categories.destroy', ['id' => $category->id]) }}" method="post">
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
