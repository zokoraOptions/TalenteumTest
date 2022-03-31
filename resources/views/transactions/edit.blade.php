@extends('transactions.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-10">
        <h2>Modification transactions</h2>
    </div>
    <div class="col-lg-1">
        <a class="btn btn-sm btn-primary" href="{{ url('transactions') }}"> Retour</a>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    Un des champs n'est pas correctement renseigné..<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('transactions.update',$transaction->id) }}" method="POST">
    @method('PATCH')
    @csrf
    <h3>Entrée de fond de caisse</h3>
    <div class="form-group">
        <label for="label">Type:</label>
        <select class="form-control" id="id_type" name="id_type">
            @foreach($types AS $type)
            @if ($type->id == $transaction->id_type)
            <option value="{{ $type->id }}" selected>{{ $type->label }}</option>
            @else
            <option value="{{ $type->id }}">{{ $type->label }}</option>
            @endif
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <label for="operation_date">Date:</label>
                <div class='input-group date' id='divoperation_date'>
                    <input type='text' class="form-control" value="{{ date('d/m/Y', strtotime($transaction->operation_date)) }}" name=" operation_date" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <label for="label">: Commentaire</label>
                <textarea name="note" id="note" cols="30" rows="10" value="{{ $transaction->note }}"></textarea>
            </div>
        </div>
    </div>
    <h3>Billets</h3>
    <div class=" row">
        <div class='col-sm-6'>
            <div class="form-group">
                <label for="label">: Nominale</label>
                <select name="billets" id="billets">
                    <option value="5">5€</option>
                    <option value="10">10€</option>
                    <option value="20">20€</option>
                    <option value="50">50€</option>
                    <option value="100">100€</option>
                    <option value="200">200€</option>
                    <option value="500">500€</option>
                </select>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group">
                <label for="label">: Quanité</label>
                <input type="number" min="1" value="1" name="quantite_billet" id="quantite_billet">
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-sm add_billet">Ajouter</button>
        <div>
            <table class="billets_list table">
                <tbody></tbody>
            </table>
            <div class="billets_list_inputs">

            </div>
        </div>
    </div>
    <h3>Pièces</h3>
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <label for="label">: Nominale</label>
                <select name="pieces" id="pieces">
                    <option value="1">1€</option>
                    <option value="2">2€</option>
                </select>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group">
                <label for="label">: Quanité</label>
                <input type="number" min="1" value="1" name="quantite_piece" id="quantite_piece">
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-sm add_piece">Ajouter</button>
        <div>
            <table class="pieces_list table">
                <tbody></tbody>
            </table>
            <div class="pieces_list_inputs">

            </div>
        </div>
    </div>
    <h3>Centimes</h3>
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <label for="label">: Nominale</label>
                <select name="centimes" id="centimes">
                    <option value="1">1 centime</option>
                    <option value="2">2 centimes</option>
                    <option value="5">5 centimes</option>
                    <option value="10">10 centimes</option>
                    <option value="20">20 centimes</option>
                    <option value="50">50 centimes</option>
                </select>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group">
                <label for="label">: Quanité</label>
                <input type="number" min="1" value="1" name="quantite_centime" id="quantite_centime">
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-sm add_centime">Ajouter</button>
        <div>
            <table class="centimes_list table">
                <tbody></tbody>
            </table>
            <div class="centimes_list_inputs">

            </div>
        </div>
    </div>
    <div class="form-group">
        <div>
            <table class="total table">
                <tbody>
                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td class="total_all"></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <button type="submit" class="btn btn-sm btn-default">Sauvegarder</button>
</form>
<script type="text/javascript">
    var moneyList = {
        billet: [],
        piece: [],
        centime: [],
        total: 0
    };
    $(function() {
        $('#divoperation_date').datetimepicker({
            format: "DD/MM/YYYY",
            locale: 'fr'
        });
        $('.add_billet').click(function(event) {
            event.preventDefault();
            manageMoney('billet');
            calculateTotal();
        });
        $('.add_piece').click(function(event) {
            event.preventDefault();
            manageMoney('piece');
            calculateTotal();
        });
        $('.add_centime').click(function(event) {
            event.preventDefault();
            manageMoney('centime');
            calculateTotal();
        });

        function manageMoney(type) {
            var billetVal = $('#' + type + 's').val();
            var billetLabel = $('#' + type + 's :selected').text();
            var qty = $('#quantite_' + type).val();
            if (moneyList[type][type + '_' + billetVal] == undefined) {
                moneyList[type][type + '_' + billetVal] = 0;
            }
            moneyList[type][type + '_' + billetVal] += parseInt(qty);
            if ($('#' + type + '_' + billetVal).length > 0) {
                $('#' + type + '_' + billetVal + ' .qty').text(moneyList[type][type + '_' + billetVal]);
                $('#' + type + '_' + billetVal + ' .total').text(parseInt(moneyList[type][type + '_' + billetVal]) * parseInt(billetVal));
            } else {
                var total = parseInt(billetVal) * parseInt(qty);
                $('.' + type + 's_list tbody').append(
                    '<tr id="' + type + '_' + billetVal +
                    '"><td >' + billetLabel + '</td><td class="qty">' +
                    qty + '</td><td class="total">' + total +
                    '</td><td ><button class="delete_line">Supprimer</button></td></tr>')
            }
            for (var i in moneyList[type]) {
                val = moneyList[type][i];
                var billetId = i.replace(type + '_', '');
                if ($('.' + type + 's_list_inputs input[name="real_' + type + '[' + billetId + ']"]').length > 0) {
                    $('.' + type + 's_list_inputs input[name="real_' + type + '[' + billetId + ']"]').remove();
                }
                $('.' + type + 's_list_inputs').append('<input type="hidden" name="real_' + type + '[' + billetId + ']" value="' + val + '">');

            };
            $('.' + type + 's_list .delete_line').click(function(event) {
                event.preventDefault();
                var lineId = $(this).parent().parent().attr('id');
                $('#' + lineId).remove();
                var billetId = lineId.replace(type + '_', '');
                $('input[name="real_' + type + '[' + billetId + ']"]').remove();
            });

        }

        function calculateTotal() {
            var totalAll = 0;
            for (var i in moneyList) {
                for (var j in moneyList[i]) {
                    var valueMoney = j.split('_')[1];
                    var currentTotal = (valueMoney * moneyList[i][j]);
                    if (i == 'centime') {
                        currentTotal = currentTotal / 100;
                    }
                    totalAll += currentTotal;
                }
            }
            console.log(totalAll);
            $('.total_all').text(totalAll.toFixed(2));
        }
    });
</script>
@endsection
