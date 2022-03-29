@extends('operationType.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-11">
        <h2>Update operationType</h2>
    </div>
    <div class="col-lg-1">
        <a class="btn btn-primary" href="{{ url('operationType') }}"> Back</a>
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
<form method="post" action="{{ route('operations.update',$operation->id) }}">
    @method('PATCH')
    @csrf
    <div class="form-group">
        <label for="label">Libéllé:</label>
        <input type="text" class="form-control" id="label" placeholder="Enter First Name" name="label" value="{{ $operation->label }}">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
@endsection
