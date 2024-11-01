@extends('../withdraw')

@section('content')
    <form action="{{ route('withdraw.store') }}" method="POST">
        @csrf
        <div class="mb-2">
            <label class="form-label">Ivestor</label>
            <select class="form-select" name="user_id">
                @foreach($investors as $investor)
                <option value="{{ $investor->id }}">{{ $investor->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label class="form-label">Date Transaction</label>
            <input type="datetime-local" name="date" class="form-control">
        </div>
        <div class="mb-2">
            <label class="form-label">Nominal</label>
            <input type="number" name="nominal" class="form-control">
        </div>
        <div class="d-flex flex-row-reverse">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
@endsection