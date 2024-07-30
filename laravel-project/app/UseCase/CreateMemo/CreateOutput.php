<?php
namespace App\UseCase\CreateMemo;

use App\ValueObject\Title;
use App\ValueObject\Content;

class CreateOutput
{
    private $id;
    private $title;
    private $content;

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
