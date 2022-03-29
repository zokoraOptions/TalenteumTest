@extends('operationType.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-11">
        <h2>Add New operationType</h2>
    </div>
    <div class="col-lg-1">
        <a class="btn btn-primary" href="{{ url('operations') }}"> Back</a>
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
<form action="{{ route('operations.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="label">Libéllé:</label>
        <input type="text" class="form-control" id="label" placeholder="Libéllé" name="label">
    </div>
    <div class="form-group">
        <label for="label">Type:</label>
        <input type="radio" name="type" id="typecredit" value="retrait"> Retrait
        <input type="radio" name="type" id="typedebit" value="ajout"> Ajout
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
@endsection
