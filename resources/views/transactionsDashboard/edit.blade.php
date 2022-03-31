@extends('transactions.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-10">
        <h2>Update transactions</h2>
    </div>
    <div class="col-lg-1">
        <a class="btn btn-sm btn-primary" href="{{ url('transactions') }}"> Retour</a>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    Un des champs n'est pas correctement renseigné.<br><br>
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
        <input type="text" class="form-control" id="label" placeholder="Enter Libellé" name="label" value="{{ $transaction->label }}">
    </div>
    <button type="submit" class="btn btn-sm btn-default">Sauvegarder</button>
</form>
@endsection
