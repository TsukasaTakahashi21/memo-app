<?php
namespace App\UseCase\UpdateMemo;

use App\ValueObject\Title;
use App\ValueObject\Content;

class UpdateOutput
{
  private int $id;
  private Title $title;
  private Content $content;

  public function __construct(int $id, Title $title, Content $content)
  {
    $this->id = $id;
    $this->title = $title;
    $this->content = $content;
  }

  public function getId(): int 
  {
    return $this->id;
  }

  public function getTitle(): Title
  {
    return $this->title;
  }

  public function getContent(): Content
  {
    return $this->content;
  }
}