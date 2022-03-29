@extends('transactions.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-11">
        <h2>Liste des types d'opérations du jour</h2>
    </div>
    <div class="col-lg-1">
        <a class="btn btn-success" href="{{ route('transactions.create') }}">Add</a>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>Date</th>
        <th>Retraits</th>
        <th>Ajouts</th>
        <th>Total</th>
        <th width="280px">Action</th>
    </tr>
    @php
    $i = 0;
    @endphp
    @foreach ($transactions as $transaction)
    <tr>
        <td>{{ $transaction['date'] }}</td>
        <td>{{ $transaction['credit'] }} €</td>
        <td>{{ $transaction['debit'] }} €</td>
        <td>{{ $transaction['total'] }} €</td>
        <td>
            <!--  -->
        </td>
    </tr>
    @endforeach
</table>
@endsection
