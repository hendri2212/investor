<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdraw;
use App\Models\Wallet;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class WithdrawController extends Controller
{
    public function index(){
        $withdrawls = Withdraw::with('user')->get();

        $totalNominal = $withdrawls->sum('nominal');

        $wallets = Wallet::with('user')->get();

        $additionalData = [];

        foreach ($wallets as &$wallet) {
            $data = [
                'start_date' => $wallet->start_date,
                'capital' => $wallet->capital,
                'yield' => $totalNominal,
                'persentase' => 0
            ];

            // Hitung persentase yield terhadap capital
            if ($data['capital'] > 0) {
                $data['persentase'] = ($data['yield'] / $data['capital']) * 100;
            }
            
            $today = Carbon::now();
            $startDate = Carbon::parse($data['start_date']);
            $period = CarbonPeriod::create($startDate, $today);
            
            // Filter only business days
            $businessDays = iterator_count($period->filter('isWeekday'));

            $data['business_days'] = $businessDays;
            $data['formatted_start_date'] = $startDate->translatedFormat('d F Y');

            // Tambahkan data yang telah diproses ke additionalData
            $additionalData[] = $data;
        }

        return view('withdraw.index', compact('withdrawls', 'additionalData'));
    }
    
    public function create() {
        $investors = User::where('id', '!=', 1)->get();

        return view('withdraw.create', compact('investors'));
    }

    public function store(Request $request)
    {
        return Withdraw::create([
            // 'user_id' => auth()->id(),
            'user_id' => $request->input('user_id'),
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