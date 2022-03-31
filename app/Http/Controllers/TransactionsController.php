<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankTransactions;
use App\Models\OperationType;
use App\Models\transactionType;
use Illuminate\Support\Facades\DB;

class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Contante utilisé pour calculer les centimes
     */
    const PERCENT = 100;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transactions = BankTransactions::orderBy('operation_date', 'desc')->get();
        $operationTypes = $this->formatOperationType();
        return view('transactions.list', compact('transactions', 'transactions', 'operationTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = OperationType::all();
        return view('transactions.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $total = $this->getTotal($request);
        $transaction = new BankTransactions([
            'id_type' => $request->get('id_type'),
            'operation_date' => $this->dateToEn($request->get('operation_date')),
            'note' => (empty($request->get('note')) ? ' ' : $request->get('note')),
            'total' => $total
        ]);
        $transaction = $transaction->save();

        return redirect('/transactions')->with('success', 'La transaction été enregistré avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BankTransactions  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(BankTransactions $transaction)
    {

        $operationTypes = $this->formatOperationType();
        return view('transactions.view', compact('transaction', 'operationTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(BankTransactions $transaction)
    {
        $types = OperationType::all();
        return view('transactions.edit', compact('transaction', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BankTransactions  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $total = $this->getTotal($request);
        $transaction = BankTransactions::find($id);
        $transaction->id_type = $request->get('id_type');
        $transaction->operation_date = $this->dateToEn($request->get('operation_date'));
        $transaction->note = $this->dateToEn($request->get('note'));
        $transaction->total = $total;

        $transaction->update();

        return redirect('/transactions')->with('success', 'La transaction été enregistré avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BankTransactions  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankTransactions $transaction)
    {
        //
        $transaction->delete();
        return redirect('/transactions')->with('success', 'La transaction été supprimé avec succès');
    }

    /**
     * Convertir une date Fr en date En
     *
     * @param string $date
     *
     * @return string
     */
    private function dateToEn($date)
    {
        $date = explode('/', $date);
        krsort($date);
        return implode('-', $date);
    }
    /**
     * Convertir une date Fr en date En
     *
     * @param string $date
     *
     * @return string
     */
    private function dateToFr($date)
    {
        $date = explode('-', $date);
        krsort($date);
        return implode('/', $date);
    }
    /**
     * Formatter les types d'opérations en tableau
     *
     * @return array
     */
    protected function formatOperationType()
    {
        $operationTypes = OperationType::get();
        $operationTypes = json_decode(json_encode($operationTypes));
        $operations = [];
        foreach ($operationTypes as $key => $operationType) {
            $operations[$operationType->id] = $operationType;
        }
        return $operations;
    }
    /**
     * Récupérer le total
     *
     * @param Request $request
     *
     * @return float
     */
    public function getTotal(Request $request)
    {
        $request->validate([
            'id_type' => 'required',
            'operation_date' => 'required',
        ]);
        $total = 0;
        $billets = $request->get('real_billet');
        if (!empty($billets)) {
            foreach ($billets as $billet => $qty) {
                $total += $billet * $qty;
            }
        }
        $pieces = $request->get('real_piece');
        if (!empty($pieces)) {
            foreach ($pieces as $piece => $qty) {
                $total += $piece * $qty;
            }
        }
        $centimes = $request->get('real_centime');
        if (!empty($centimes)) {
            foreach ($centimes as $centime => $qty) {
                $total += $centime * $qty / self::PERCENT;
            }
        }
        return $total;
    }
}
