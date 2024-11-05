<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'category_id'];

    public function getTitleAttribute($value)
    {
        return new \App\ValueObject\Title($value);
    }

    public function getContentAttribute($value)
    {
        return new \App\ValueObject\Content($value);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
