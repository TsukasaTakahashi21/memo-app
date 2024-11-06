<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Memo;
use App\Models\Category;
use App\UseCase\CreateMemo\CreateInput;
use App\UseCase\CreateMemo\CreateInteractor;
use App\UseCase\UpdateMemo\UpdateInput;
use App\UseCase\UpdateMemo\UpdateInteractor;
use App\UseCase\DeleteMemo\DeleteInput;
use App\UseCase\DeleteMemo\DeleteInteractor;
use App\ValueObject\Title;
use App\ValueObject\Content;
use InvalidArgumentException;


class MemoController extends Controller
{

    public function index(Request $request)
    {
        $query = Memo::with('category');
        
        // 検索機能
        if ($search = $request->query('search')) {
            $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('content', 'like', '%'. $search. '%');
        }

        // カテゴリによる絞り込み
        if ($categoryId = $request->query('category')) {
            $query->where('category_id', $categoryId);
        }

        // ソート機能（新しい順、古い順）
        if ($sort = $request->query('sort')) {
            if ($sort === 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $memos = $query->get();
        $categories = Category::all();

        return view('memo.index', compact('memos', 'categories'));
    }

    
    public function create()
    {
        $categories = Category::all();
        return view('memo.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ], [
            'title.required' => 'タイトルを入力してください',
            'title.max' => 'タイトルは255文字以下で入力してください',
            'content.required' => '内容を入力してください',
            'category_id.required' => 'カテゴリ名を入力してください',
            'category_id.exists' => '選択されたカテゴリは存在しません',
        ]);

        try{
            $title = new Title($validated['title']);
            $content = new Content($validated['content']);
            $categoryId = $validated['category_id'];
            $input = new CreateInput($title, $content, $categoryId);
            $createInteractor = new CreateInteractor();
            $createInteractor->handle($input);
        
            return redirect()->route('memo.index');
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }


    public function edit($id)
    {
        $memo = Memo::find($id);

        if (!$memo) {
            return redirect()->route('memo.index');
        }

        return view ('memo.edit', compact('memo'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ], [
            'title.required' => 'タイトルを入力してください',
            'title.max' => 'タイトルは255文字以下で入力してください',
            'content.required' => '内容を入力してください',
        ]);

        $title = new Title($validated['title']);
        $content = new Content($validated['content']);

        $input = new UpdateInput($id, $title, $content);
        $updateInteractor = new UpdateInteractor();
        $updateInteractor->handle($input);

        return redirect()->route('memo.index');
    }

    public function destroy($id)
    {
        $input = new DeleteInput($id);
        $deleteInteractor = new DeleteInteractor();
        $deleteInteractor->handle($input);

        return redirect()->route('memo.index');
    }

    public function indexBlog()
    {
        return view('blog.index', compact('blog'));
    }
}


