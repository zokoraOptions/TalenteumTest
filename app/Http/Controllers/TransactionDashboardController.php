<?php

namespace App\Http\Controllers;

use App\Models\BankTransactions;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TransactionDashboardController extends TransactionsController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = BankTransactions::all();
        $transactions = $this->groupTransaction($transactions);
        return view('transactionsDashboard.list', compact('transactions', 'transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function groupTransaction(Collection $collection)
    {
        $operationTypes = $this->formatOperationType();
        $arrayFormattedCollection = json_decode(json_encode($collection));
        $transactionGroupped = [];
        foreach ($arrayFormattedCollection as $key => $transaction) {
            $operationType = $operationTypes[$transaction->id_type];
            $transactionGroupped[$transaction->operation_date][$operationType->type][] = $transaction;
        }
        $formatted = [];
        dump($transactionGroupped);
        foreach ($transactionGroupped as $key => $transactionByType) {
            $formatted[$key] = [
                'date' => date('d/m/Y', strtotime($key)),
                'credit' => 0,
                'debit' => 0,
                'total' => 0,
                // 'id' => 0,
            ];
            if (!empty($transactionByType['retrait'])) {
                foreach ($transactionByType['retrait'] as $transactions) {
                    $formatted[$key]['credit'] += $transactions->total;
                }
            }
            if (!empty($transactionByType['ajout'])) {
                foreach ($transactionByType['ajout'] as $transactions) {
                    $formatted[$key]['debit'] += $transactions->total;
                }
            }
            $formatted[$key]['total'] += $formatted[$key]['debit'] + $formatted[$key]['credit'];
        }
        dump($formatted);
        return $formatted;
    }
}
