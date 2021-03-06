@extends('transactions.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-10">
        <h2>Détails</h2>
    </div>
    <div class="col-lg-1">
        <a class="btn btn-sm btn-primary" href="{{ url('transactions') }}"> Retour</a>
    </div>
</div>
<table class="table table-bordered">
    <tr>
        <th>Type d'opération:</th>
        <td>{{ $operationTypes[$transaction->id_type]->label }}</td>
    </tr>
    <tr>
        <th>Date:</th>
        <td>{{ date('d/m/Y', strtotime($transaction->operation_date)) }}</td>
    </tr>
    <tr>
        <th>Note :</th>
        <td>{{ $transaction->note }}</td>
    </tr>
    <tr>
        <th>Montant :</th>
        <td>{{ $transaction->total }} €</td>
    </tr>

</table>
@endsection
