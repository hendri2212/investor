<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class WithdrawController extends Controller
{
    public function index(){
        $withdrawls = Withdraw::with('user')->get();

        $totalNominal = $withdrawls->sum('nominal');

        $additionalData = [
            [
                'start_date' => '2024-10-24', 
                'capital' => 500000, 
                'yield' => $totalNominal,
                'persentase' => 10
            ]
        ];

        foreach ($additionalData as &$data) {
            $data['persentase'] = ($data['yield'] / $data['capital']) * 100;
            
            $today = Carbon::now();
            $startDate = Carbon::parse($data['start_date']);
            $period = CarbonPeriod::create($startDate, $today);
            
            // Filter only business days
            $businessDays = iterator_count($period->filter('isWeekday'));

            $data['business_days'] = $businessDays;
            
            $data['formatted_start_date'] = $startDate->translatedFormat('d F Y');
        }

        return view('withdraw.index', compact('withdrawls', 'additionalData'));
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