@extends('operationType.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-10">
        <h2>Détails</h2>
    </div>
    <div class="col-lg-1">
        <a class="btn btn-sm btn-primary" href="{{ url('operations') }}"> Retour</a>
    </div>
</div>
<table class="table table-bordered">
    <tr>
        <th>Libellé:</th>
        <td>{{ $operation->label }}</td>
    </tr>

</table>
@endsection
