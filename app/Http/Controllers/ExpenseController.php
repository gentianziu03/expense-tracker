<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Category;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function store(StoreExpenseRequest $request)
    {
        Expense::create($request->validated());

        return redirect()
            ->route('dashboard', [
                'month' => now('Europe/Tirane')->format('Y-m'),
            ])
            ->with('status', 'Shpenzimi u shtua me sukses.');
    }

    public function edit(Expense $expense)
    {
        return view('expenses.edit', [
            'expense' => $expense,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->validated());

        return redirect()
            ->route('dashboard', [
                'month' => $expense->spent_at->format('Y-m'),
            ])
            ->with('status', 'Shpenzimi u përditësua me sukses.');
    }

    public function destroy(Expense $expense)
    {
        $month = $expense->spent_at->format('Y-m');
        $expense->delete();

        return redirect()
            ->route('dashboard', ['month' => $month])
            ->with('status', 'Shpenzimi u fshi me sukses.');
    }
}
