<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemoRequest;
use App\Http\Requests\UpdateMemoRequest;
use Illuminate\Http\Request;
use App\Models\Memo;
use App\Models\Category;
use App\Repositories\MemoRepository;
use App\UseCase\CreateMemo\CreateInput;
use App\UseCase\CreateMemo\CreateInteractor;
use App\UseCase\UpdateMemo\UpdateInput;
use App\UseCase\UpdateMemo\UpdateInteractor;
use App\UseCase\DeleteMemo\DeleteInput;
use App\UseCase\DeleteMemo\DeleteInteractor;
use App\ValueObject\Title;
use App\ValueObject\Content;
use Illuminate\Support\Str;
use InvalidArgumentException;

class MemoController extends Controller
{
    protected $memoRepository;
    protected $createInteractor;
    protected $updateInteractor;
    protected $deleteInteractor;

    public function __construct(
        MemoRepository $memoRepository,
        CreateInteractor $createInteractor,
        UpdateInteractor $updateInteractor,
        DeleteInteractor $deleteInteractor,
    ) {
        $this->memoRepository = $memoRepository;
        $this->createInteractor = $createInteractor;
        $this->updateInteractor = $updateInteractor;
        $this->deleteInteractor = $deleteInteractor;
    }

    public function index(Request $request)
    {
        $memos = $this->memoRepository->filterMemo(
            $request->query('search'),
            $request->query('category'),
            $request->query('sort') ?? MemoRepository::SORT_DESC
        );

        $categories = Category::all();

        return view('memo.index', compact('memos', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('memo.create', compact('categories'));
    }

    public function store(StoreMemoRequest $request)
    {
        try{
            $input = new CreateInput(
                new Title($request->title),
                new Content($request->content),
                $request->category_id
            );
            $this->createInteractor->handle($input);
        
            return redirect()->route('memo.index');
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }


    public function edit(int $id)
    {
        $memo = Memo::find($id);

        if (!$memo) {
            return redirect()->route('memo.index')->withErrors(['error' => 'メモが見つかりませんでした']);
        }
        
        return view ('memo.edit', compact('memo'));
    }

    public function update(UpdateMemoRequest $request, int $id)
    {
        try {
            $input = new UpdateInput(
                $id,
                new Title($request->title),
                new Content($request->content),
            );
            $this->updateInteractor->handle($input);

            return redirect()->route('memo.index');
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroy(int $id)
    {
        try{
            $input = new DeleteInput($id);
            $this->deleteInteractor->handle($input);

            return redirect()->route('memo.index');
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function showDetail(int $id)
    {
        $memo = Memo::find($id);

        if (!$memo) {
            return redirect()->route('memo.index')->withErrors(['error' => 'メモが見つかりませんでした。']);
        }

        return view('memo.detail', compact('memo'));
    }
}


