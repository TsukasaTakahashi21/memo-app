<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:categories,name',
        ], [
            'name.required' => 'カテゴリ名を入力してください',
            'name.max' => 'カテゴリ名は50文字以下で入力してください',
            'name.unique' => 'このカテゴリ名はすでに存在します',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:categories,name,'
        ], [
            'name.required' => 'カテゴリ名を入力してください',
            'name.max' => 'カテゴリ名は50文字以下で入力してください',
            'name.unique' => 'このカテゴリ名はすでに存在します',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->only('name'));

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
