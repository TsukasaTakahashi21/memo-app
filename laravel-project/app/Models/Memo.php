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
}
