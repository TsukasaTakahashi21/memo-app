<?php
namespace App\ValueObject;

use InvalidArgumentException;

class Title
{
  private string $value;

  public function __construct(string $value)
  {
    if (strlen($value) > 255 ) {
      throw new InvalidArgumentException('タイトルは255文字以下で記入してください');
    }

    if (empty($value)) {
      throw new InvalidArgumentException('タイトルを入力してください');
    }

    $this->value = $value;
  }

  public function getValue() 
  {
    return $this->value;
  }
}