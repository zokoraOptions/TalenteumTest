@extends('transactions.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-11">
        <h2>Update transactions</h2>
    </div>
    <div class="col-lg-1">
        <a class="btn btn-primary" href="{{ url('transactions') }}"> Back</a>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="post" action="{{ route('transactions.update',$transaction->id) }}">
    @method('PATCH')
    @csrf
    <div class="form-group">
        <label for="label">Libéllé:</label>
        <input type="text" class="form-control" id="label" placeholder="Enter First Name" name="label" value="{{ $transaction->label }}">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
@endsection
