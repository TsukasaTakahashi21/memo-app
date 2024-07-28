<?php
namespace App\UseCase\CreateMemo;

use App\UseCase\CreateMemo\CreateInput;
use App\UseCase\CreateMemo\CreateOutput;
use App\Models\Memo;
use InvalidArgumentException;

class CreateInteractor 
{
  public function handle(CreateInput $input): CreateOutput
  {
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

    $memo = Memo::create([
      'title' => $title,
      'content' =>$content
    ]);

    return new CreateOutput($memo->id, $memo->title, $memo->content);
  }
}