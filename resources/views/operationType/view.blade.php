@extends('operationType.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-11">
        <h2>Laravel 9 CRUD Example</h2>
    </div>
    <div class="col-lg-1">
        <a class="btn btn-primary" href="{{ url('operationType') }}"> Back</a>
    </div>
</div>
<table class="table table-bordered">
    <tr>
        <th>First Name:</th>
        <td>{{ $operation->label }}</td>
    </tr>

</table>
@endsection
