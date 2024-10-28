@php
    use Carbon\Carbon;
@endphp

@extends('../withdraw')

@section('content')
    <table class="table table-sm table-bordered mt-2">
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

    <p class="m-0 pt-3 fw-bold h5 text-primary">History Withdraw Transaction</p>
    @foreach ($withdrawls as $index => $withdraw)
        <div class="card shadow mt-2">
            <div class="card-body d-flex flex-column">
                <span class="form-text">{{ Carbon::parse($withdraw->date)->translatedFormat('d F Y H:i') }}</span>
                <span class="fw-bold text-success">Rp {{ number_format($withdraw->nominal, 0, ',', '.') }}</span>
            </div>
        </div>
    @endforeach
@endsection