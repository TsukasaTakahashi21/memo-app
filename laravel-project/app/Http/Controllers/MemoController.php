<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Memo;
use App\UseCase\CreateMemo\CreateInput;
use App\UseCase\CreateMemo\CreateInteractor;
use App\UseCase\UpdateMemo\UpdateInput;
use App\UseCase\UpdateMemo\UpdateInteractor;

class MemoController extends Controller
{
    protected $createInteractor;
    protected $updateInteractor;
    
    public function __construct(CreateInteractor $createInteractor, UpdateInteractor $updateInteractor)
    {
        $this->createInteractor = $createInteractor;
        $this->updateInteractor = $updateInteractor;
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
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $input = new CreateInput($validated['title'], $validated['content']);
        $this->createInteractor->handle($input);

        return redirect()->route('memo.index');
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

        $input = new UpdateInput($id, $validated['title'], $validated['content']);
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
        $memo = Memo::find($id);
        $memo->delete();
        return redirect()->route('memo.index');
    }
}

