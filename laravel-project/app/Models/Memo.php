<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;

    // titleおよびcontentフィールドをマスアサインメントで使用
    // 入力データを使ってモデルの属性を一括で設定
    protected $fillable = ['title', 'content'];

    public function getTitleAttribute($value)
    {
        return new \App\ValueObject\Title($value);
    }

    public function getContentAttribute($value)
    {
        return new \App\ValueObject\Content($value);
    }
}
