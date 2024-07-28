<?php
namespace App\UseCase\UpdateMemo;

use App\Models\Memo;
use App\UseCase\UpdateMemo\UpdateInput;
use App\UseCase\UpdateMemo\UpdateOutput;
use InvalidArgumentException;

class UpdateInteractor
{
  public function handle(UpdateInput $input): UpdateOutput
  {
    $id = $input->getId();
    $title = $input->getTitle();
    $content = $input->getContent();

    if (empty($title) && empty($content)) {
      throw new InvalidArgumentException('タイトルと本文の両方が入力されていません');
    }
    
    if (empty($title)) {
      throw new InvalidArgumentException('タイトルが入力されていません');
    }
    
    if (empty($content)) {
      throw new InvalidArgumentException('本文が入力されていません');
    }

    $memo = Memo::find($id);
    if (!$memo) {
      throw new InvalidArgumentException('指定されたメモが見つかりません。');
    }

    $memo->title = $title;
    $memo->content = $content;
    $memo->save();

    return new UpdateOutput($memo->id, $memo->title, $memo->content);
  }
}