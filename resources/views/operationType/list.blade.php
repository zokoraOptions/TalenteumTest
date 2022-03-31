@extends('operationType.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-10">
        <h2>Liste des types d'opérations</h2>
    </div>
    <div class="col-lg-1">
        <a class="btn btn-sm btn-success" href="{{ route('operations.create') }}">Ajouter</a>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Libéllé</th>
        <th>Type</th>
        <th width="280px">Action</th>
    </tr>
    @php
    $i = 0;
    @endphp
    @foreach ($operations as $operationType)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $operationType->label }}</td>
        <td>{{ $operationType->type }}</td>
        <td>
            <form action="{{ route('operations.destroy',$operationType->id) }}" method="POST">
                <a class="btn btn-sm btn-info" href="{{ route('operations.show',$operationType->id) }}">Afficher</a>
                <a class="btn btn-sm btn-primary" href="{{ route('operations.edit',$operationType->id) }}">Modifier</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
