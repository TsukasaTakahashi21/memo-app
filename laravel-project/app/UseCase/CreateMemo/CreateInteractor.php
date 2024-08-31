<?php
namespace App\UseCase\CreateMemo;

use App\UseCase\CreateMemo\CreateInput;
use App\Models\Memo;
use App\ValueObject\Title;
use App\ValueObject\Content;
use InvalidArgumentException;

class CreateInteractor 
{
  public function handle(CreateInput $input)
  {
    $titleValue = $input->getTitle()->getValue();
    $contentValue = $input->getContent()->getValue();
    $categoryId = $input->getCategoryId();

    Memo::create([
      'title' => $titleValue,
      'content' =>$contentValue,
      'category_id' => $categoryId
    ]);
  }
}