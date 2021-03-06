@extends('transactions.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-10">
        <h2>Liste des opérations</h2>
    </div>
    <div class="col-lg-1">
        <a class="btn btn-sm btn-success" href="{{ route('transactions.create') }}">Ajouter</a>
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
        <th>Type</th>
        <th>Date</th>
        <th>Note</th>
        <th>Total</th>
        <th width="280px">Action</th>
    </tr>
    @php
    $i = 0;
    @endphp
    @foreach ($transactions as $transaction)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $operationTypes[$transaction->id_type]->label }}</td>
        <td>{{ date('d/m/Y', strtotime($transaction->operation_date)) }}</td>
        <td>{{ $transaction->note }}</td>
        <td>{{ $transaction->total }} €</td>
        <td>
            <form action="{{ route('transactions.destroy',$transaction->id) }}" method="POST">
                <a class="btn btn-sm btn-info" href="{{ route('transactions.show',$transaction->id) }}">Afficher</a>
                <a class="btn btn-sm btn-primary" href="{{ route('transactions.edit',$transaction->id) }}">Modifier</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
