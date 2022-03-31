@extends('transactionsDashboard.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-10">
        <h2>Dashboard</h2>
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
        <th>Type</th>
        <th>Retraits</th>
        <th>Ajouts</th>
        <th>Total</th>
    </tr>
    @php
    $i = 0;
    @endphp
    @foreach ($transactions as $report)
    <tr>
        <td rowspan="{{count($report['list']) + 1}}">{{ $report['date'] }}</td>
        <td>Total</td>
        <td>{{ $report['credit'] }} €</td>
        <td>{{ $report['debit'] }} €</td>
        <td rowspan="{{count($report['list']) + 1}}">{{ $report['total'] }} €</td>
        <td></td>

    </tr>
    @foreach ($report['list'] as $transaction)
    <tr>
        <td>{{ $transaction['type'] }}</td>
        <td>{{ $transaction['credit'] }} €</td>
        <td>{{ $transaction['debit'] }} €</td>
        <td>

            <div class="display:none">
                <form action="{{ route('transactions.destroy',$transaction['id']) }}" method="POST">
                    <a class="btn btn-sm btn-primary" href="{{ route('transactions.edit',$transaction['id']) }}">Modifier</a>
                    <button class="btn btn-sm btn-danger delete_confirm">Supprimer</button>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger delete_line">Supprimer</button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
    @endforeach
</table>
<div>
    <script>
        $('.delete_line').hide();
        $('.delete_confirm').click(function(e) {
            var btn = $(this);
            e.preventDefault();
            $.confirm({
                title: 'Confirmation de suppression',
                content: 'Voulez-cous vraiment supprimer?',
                buttons: {
                    confirm: function() {
                        console.log($(btn).parent().find('.delete_line').length);
                        $(btn).parent().find('.delete_line').click();
                    },
                    cancel: function() {

                    }
                }
            });
        });
    </script>
</div>
@endsection
