@extends('operationType.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-11">
        <h2>Liste des types d'opérations</h2>
    </div>
    <div class="col-lg-1">
        <a class="btn btn-success" href="{{ route('operations.create') }}">Add</a>
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
                <a class="btn btn-info" href="{{ route('operations.show',$operationType->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('operations.edit',$operationType->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
