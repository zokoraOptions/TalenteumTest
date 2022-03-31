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
        foreach ($transactionGroupped as $key => $transactionByType) {
            $trans = [];
            $formatted[$key] = [
                'date' => date('d/m/Y', strtotime($key)),
                'credit' => 0,
                'debit' => 0,
                'total' => 0,
            ];
            if (!empty($transactionByType['retrait'])) {
                foreach ($transactionByType['retrait'] as $transactions) {
                    $formatted[$key]['credit'] += $transactions->total;
                    $formatted[$key]['list'][] = [
                        'type' => $operationTypes[$transactions->id_type]->label,
                        'credit' => $transactions->total,
                        'debit' => 0,
                        'id' => $transactions->id
                    ];
                }
            }
            if (!empty($transactionByType['ajout'])) {
                foreach ($transactionByType['ajout'] as $transactions) {
                    $formatted[$key]['debit'] += $transactions->total;
                    $formatted[$key]['list'][] = [
                        'type' => $operationTypes[$transactions->id_type]->label,
                        'credit' => 0,
                        'debit' => $transactions->total,
                        'id' => $transactions->id
                    ];
                }
            }
            $formatted[$key]['total'] += $formatted[$key]['debit'] + $formatted[$key]['credit'];
        }
        return $formatted;
    }
}
