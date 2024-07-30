<?php
namespace App\UseCase\DeleteMemo;

use App\Models\Memo;
use App\UseCase\DeleteMemo\DeleteInput;
use InvalidArgumentException;

class DeleteInteractor
{
  public function handle(DeleteInput $input)
  {
    $id = $input->getId();
    $memo = Memo::find($id);

    if (!$memo) {
      throw new InvalidArgumentException('指定されたメモが見つかりません');
    }

    $memo->delete();
  }
}