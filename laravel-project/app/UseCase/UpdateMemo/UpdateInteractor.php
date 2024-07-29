<?php
namespace App\UseCase\UpdateMemo;

use App\Models\Memo;
use App\UseCase\UpdateMemo\UpdateInput;
use App\UseCase\UpdateMemo\UpdateOutput;
use App\ValueObject\Title;
use App\ValueObject\Content;
use InvalidArgumentException;

class UpdateInteractor
{
  public function handle(UpdateInput $input): UpdateOutput
  {
    $id = $input->getId();
    $title = $input->getTitle();
    $content = $input->getContent();

    $titleValue = $title->getValue();
    $contentValue = $content->getValue();
    
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

    $memo->title = $titleValue;
    $memo->content = $contentValue;
    $memo->save();

    return new UpdateOutput($memo->id, new Title($titleValue), new Content($contentValue));
  }
}