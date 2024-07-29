<?php
namespace App\UseCase\CreateMemo;

use App\UseCase\CreateMemo\CreateInput;
use App\UseCase\CreateMemo\CreateOutput;
use App\Models\Memo;
use App\ValueObject\Title;
use App\ValueObject\Content;
use InvalidArgumentException;

class CreateInteractor 
{
  public function handle(CreateInput $input): CreateOutput
  {
    $titleValue = $input->getTitle()->getValue();
    $contentValue = $input->getContent()->getValue();

    $memo = Memo::create([
      'title' => $titleValue,
      'content' =>$contentValue
    ]);

    return new CreateOutput($memo->id, new Title($titleValue), new Content($contentValue));
  }
}