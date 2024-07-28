
<div class="main">
  <div class="title"><h1 class="title-top">メモ登録</h1></div>
  <form action="{{ route('memo.store') }}" method="post" class="form">
    @csrf
    <div class="form-title">
      <label for="title" class="memo-title">title</label>
      <input type="text" name="title" id="title" placeholder="タイトル" class="input-title" value="">
    </div>
    <div class="form-content">
      <label for="content" class="memo-content">本文</label>
      <input type="text" name="content" id="content" placeholder="本文" class="input-content" value="">
    </div>
    <div class="submit">
      <button type="submit" class="submit-button">送信</button>
    </div>
  </form>
</div>
