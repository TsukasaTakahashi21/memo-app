<?php
namespace App\UseCase\DeleteMemo;

class DeleteInput
{
  private int $id;

  public function __construct(int $id)
  {
    $this->id = $id;
  }

  public function getId(): int
  {
    return $this->id;
  }
}