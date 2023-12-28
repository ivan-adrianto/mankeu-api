<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'date' => 'required|date',
            'note' => 'string|nullable',
            'attachment' => 'string|nullable',
            'is_recurring' => 'boolean|nullable',
            'is_installment' => 'boolean|nullable',
            'recurring_period' => 'integer|nullable',
            'installment_period' => 'integer|nullable',
            'spending' => 'required|integer',
            'total' => 'required|integer',
            'type' => 'required|in:expense,category'
        ]);

        Transaction::create($validatedRequest);

        return response()->json([
            'status' => 'success',
            'message' => 'successfully created transaction',
            'transaction' => $validatedRequest
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
