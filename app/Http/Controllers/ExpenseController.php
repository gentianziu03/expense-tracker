<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function store(StoreExpenseRequest $request)
    {
        Expense::create($request->validated());

        return back()->with('status', 'Shpenzimi u shtua me sukses.');
    }

    public function edit(Expense $expense)
    {
        return view('expenses.edit', [
            'expense' => $expense->load('category'),
            'categories' => \App\Models\Category::orderBy('name')->get(),
        ]);
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->validated());

        return redirect()->route('dashboard')->with('status', 'Shpenzimi u përditësua me sukses.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return back()->with('status', 'Shpenzimi u fshi me sukses.');
    }
}
