@extends('../withdraw')

@section('content')
    <form action="{{ route('withdraw.store') }}" method="POST">
        @csrf
        <input type="datetime-local" name="date" class="form-control">
        <input type="number" name="nominal" class="form-control">
        <button type="submit">Submit</button>
    </form>
@endsection