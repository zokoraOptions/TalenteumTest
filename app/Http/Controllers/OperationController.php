<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OperationType;

class OperationController extends Controller
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
        //
        $operations = OperationType::all();
        return view('operationType.list', compact('operations', 'operations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('operationType.create');
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
        $request->validate([
            'label' => 'required'
        ]);

        $operation = new OperationType([
            'label' => $request->get('label'),
            'type' => $request->get('type')
        ]);

        $operation->save();
        return redirect('/operations')->with('success', 'operationType has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OperationType  $operation
     * @return \Illuminate\Http\Response
     */
    public function show(OperationType $operation)
    {
        //
        return view('operationType.view', compact('operation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function edit(OperationType $operation)
    {
        //
        return view('operationType.edit', compact('operation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OperationType  $operation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([
            'label' => 'required'
        ]);


        $operation = OperationType::find($id);
        $operation->label = $request->get('label');

        $operation->update();

        return redirect('/operations')->with('success', 'operationType updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OperationType  $operation
     * @return \Illuminate\Http\Response
     */
    public function destroy(OperationType $operation)
    {
        //
        $operation->delete();
        return redirect('/operations')->with('success', 'operationType deleted successfully');
    }
}
