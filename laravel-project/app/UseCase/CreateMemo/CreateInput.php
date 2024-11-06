<?php
namespace App\UseCase\CreateMemo;

use App\ValueObject\Title;
use App\ValueObject\Content;

class CreateInput
{
  private Title $title;
  private Content $content;
  private int $categoryId;

  public function __construct(Title $title, Content $content, int $categoryId)
  {
    $this->title = $title;
    $this->content = $content;
    $this->categoryId = $categoryId;

  }

  public function getTitle(): Title
  {
    return $this->title;
  }

  public function getContent(): Content
  {
    return $this->content;
  }

  public function getCategoryId(): int
  {
    return $this->categoryId;
  }
}