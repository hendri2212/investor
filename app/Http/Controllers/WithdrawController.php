<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index(){
        $withdrawls = Withdraw::with('user')->get();
        return view('withdraw.index', compact('withdrawls'));
    }
    
    public function create()
    {
        return view('withdraw.create');
    }

    public function store(Request $request)
    {
        return Withdraw::create([
            // 'user_id' => auth()->id(),
            'user_id' => 2,
            'date' => $request->input('date'),
            'nominal' => $request->input('nominal'),
            'status' => ''
        ]);
    
        return redirect()->route('withdraw.index');
    }
    

    public function show($id)
    {
        $withdraw = Withdraw::findOrFail($id);
        return view('withdraw.show', compact('withdraw'));
    }

    public function edit($id)
    {
        $withdraw = Withdraw::findOrFail($id);
        return view('withdraw.edit', compact('withdraw'));
    }

    public function update(Request $request, $id)
    {
        $withdraw = Withdraw::findOrFail($id);
        $withdraw->update($request->all());
        return redirect()->route('withdraw.index');
    }

    public function destroy($id)
    {
        $withdraw = Withdraw::findOrFail($id);
        $withdraw->delete();
        return redirect()->route('withdraw.index');
    }
}