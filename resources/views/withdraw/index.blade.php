@extends('../withdraw')

@section('content')
    <h3>{{ $withdrawls->first()->user->name }}</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Nominal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($withdrawls as $index => $withdraw)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $withdraw->date }}</td>
                <td>Rp {{ number_format($withdraw->nominal, 0, ',', '.') }}</td>
                <td>{{ $withdraw->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection