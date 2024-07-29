<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Memo;
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
    protected $createInteractor;
    protected $updateInteractor;
    protected $deleteInteractor;
    
    public function __construct(CreateInteractor $createInteractor, UpdateInteractor $updateInteractor, DeleteInteractor $deleteInteractor)
    {
        $this->createInteractor = $createInteractor;
        $this->updateInteractor = $updateInteractor;
        $this->deleteInteractor = $deleteInteractor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memos = Memo::all();
        return view('memo.index', compact('memos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('memo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ], [
            'title.required' => 'タイトルを入力してください',
            'title.max' => 'タイトルは255文字以下で入力してください',
            'content.required' => '内容を入力してください',
        ]);

        try{
            $title = new Title($validated['title']);
            $content = new Content($validated['content']);
            $input = new CreateInput($title, $content);
            $this->createInteractor->handle($input);
        
            return redirect()->route('memo.index');
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $memo = Memo::find($id);

        if (!$memo) {
            return redirect()->route('memo.index');
        }

        return view ('memo.edit', compact('memo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $title = new Title($validated['title']);
        $content = new Content($validated['content']);

        $input = new UpdateInput($id, $title, $content);
        $this->updateInteractor->handle($input);

        return redirect()->route('memo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $input = new DeleteInput($id);
        $this->deleteInteractor->handle($input);

        return redirect()->route('memo.index');
    }
}

