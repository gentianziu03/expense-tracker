<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $timezone = 'Europe/Tirane';
        $selectedMonth = $request->string('month')->toString();

        if (! preg_match('/^\d{4}-\d{2}$/', $selectedMonth)) {
            $selectedMonth = Carbon::now($timezone)->format('Y-m');
        }

        $startOfMonth = Carbon::createFromFormat('Y-m', $selectedMonth, $timezone)->startOfMonth();
        $endOfMonth = (clone $startOfMonth)->endOfMonth();
        $categoryId = $request->integer('category_id') ?: null;

        $expensesQuery = Expense::query()
            ->with('category')
            ->whereBetween('spent_at', [$startOfMonth->toDateString(), $endOfMonth->toDateString()]);

        if ($categoryId) {
            $expensesQuery->where('category_id', $categoryId);
        }

        $expenses = $expensesQuery
            ->orderByDesc('spent_at')
            ->orderByDesc('id')
            ->get();

        $totalMonthly = (float) $expenses->sum('amount');
        $dailyAverage = $totalMonthly / $startOfMonth->daysInMonth;

        $totalsByCategory = Expense::query()
            ->selectRaw('category_id, SUM(amount) as total')
            ->with('category')
            ->whereBetween('spent_at', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
            ->groupBy('category_id')
            ->orderByDesc('total')
            ->get();

        return view('dashboard', [
            'categories' => Category::orderBy('name')->get(),
            'expenses' => $expenses,
            'totalMonthly' => $totalMonthly,
            'dailyAverage' => $dailyAverage,
            'totalsByCategory' => $totalsByCategory,
            'selectedMonth' => $selectedMonth,
            'selectedCategoryId' => $categoryId,
            'today' => Carbon::now($timezone)->toDateString(),
        ]);
    }
}
