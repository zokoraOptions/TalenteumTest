@extends('operationType.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-10">
        <h2>Modification des types d'opérations</h2>
    </div>
    <div class="col-lg-1">
        <a class="btn btn-sm btn-primary" href="{{ url('operations') }}"> Retour</a>
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
<form method="post" action="{{ route('operations.update',$operation->id) }}">
    @method('PATCH')
    @csrf
    <div class="form-group">
        <label for="label">Libéllé:</label>
        <input type="text" class="form-control" id="label" placeholder="Enter Libellé" name="label" value="{{ $operation->label }}">
    </div>
    <button type="submit" class="btn btn-sm btn-default">Sauvegarder</button>
</form>
@endsection
