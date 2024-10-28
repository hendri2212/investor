@php
    use Carbon\Carbon;
@endphp

@extends('../withdraw')

@section('content')
<div class="container">
    <table class="table">
        <tr>
            <td>Full Name</td>
            <td>{{ $withdrawls->first()->user->name }}</td>
        </tr>
        <tr>
            <td>Start Date</td>
            <td>{{ $additionalData[0]['formatted_start_date'] }}</td>
        </tr>
        <tr>
            <td>Capital</td>
            <td>Rp {{ number_format($additionalData[0]['capital'], 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Yield</td>
            <td class="text-success fw-bold">Rp {{ number_format($additionalData[0]['yield'], 0, ',', '.') }}</td>

        </tr>
        <tr>
            <td>Persentase</td>
            <td>{{ $additionalData[0]['persentase'] }} %</td>
        </tr>
        <tr>
            <td>Long Time</td>
            <td>{{ $additionalData[0]['business_days'] }} days</td>
        </tr>
    </table>
    <p class="m-0 pt-4 fw-bold text-center text-uppercase text-primary">History Withdraw Transaction</p>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Date</th>
                    <th>Nominal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($withdrawls as $index => $withdraw)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-nowrap">{{ Carbon::parse($withdraw->date)->translatedFormat('d F Y H:i') }}</td>
                    <td class="text-nowrap">Rp {{ number_format($withdraw->nominal, 0, ',', '.') }}</td>
                    <td>{{ $withdraw->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection