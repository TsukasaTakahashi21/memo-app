
<div class="main">
  <div class="title"><h1 class="title-top">編集</h1></div>
  <form action="{{ route('memo.update', ['id' => $memo->id]) }}" method="POST" class="form">
    @csrf
    @method('PUT')
    <div class="form-title">
      <label for="title" class="memo-title">title</label>
      <input type="text" name="title" id="title" placeholder="タイトル" class="input-title" value="{{ old('title', $memo->title) }}">
    </div>
    <div class="form-content">
      <label for="content" class="memo-content">本文</label>
      <textarea name="content" id="content" placeholder="本文" class="input-content">{{ old('content', $memo->content) }}</textarea>
    </div>
    <div class="submit">
      <button type="submit" class="submit-button">送信</button>
    </div>
  </form>
</div>