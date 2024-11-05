<?php

namespace App\Repositories;

use App\Models\Memo;
use Illuminate\Database\Eloquent\Collection;

class MemoRepository
{
  const SORT_ASC = 'asc';
  const SORT_DESC = 'desc';

  public function filterMemo(?string $search = null, ?int $categoryId = null, string $sort = 'desc'): Collection
  {
    $query = Memo::with('category');

    // 検索機能
    if ($search) {
      $query->where('title', 'like', '%' . $search . '%')
        ->orWhere('content', 'like', '%' . $search . '%');
    }

    // カテゴリによる絞り込み
    if ($categoryId) {
      $query->where('category_id', $categoryId);
    }

    // ソート機能（新しい順、古い順）
    if ($sort === 'newest') {
      $query->orderBy('created_at', self::SORT_DESC);
    } elseif ($sort === 'oldest') {
      $query->orderBy('created_at', self::SORT_ASC);
    } else {
      $query->orderBy('created_at', self::SORT_DESC);
    }

    return $query->get();
  }
}
