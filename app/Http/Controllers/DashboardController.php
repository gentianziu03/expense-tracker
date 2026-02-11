<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $timezone = 'Europe/Tirane';
        $selectedMonth = $request->string('month')->toString();

        $monthDate = $selectedMonth
            ? CarbonImmutable::createFromFormat('Y-m', $selectedMonth, $timezone)
            : CarbonImmutable::now($timezone);

        $startOfMonth = $monthDate->startOfMonth()->toDateString();
        $endOfMonth = $monthDate->endOfMonth()->toDateString();
        $daysInMonth = $monthDate->daysInMonth;

        $categoryId = $request->integer('category_id') ?: null;

        $monthlyBaseQuery = Expense::query()
            ->with('category')
            ->whereBetween('spent_at', [$startOfMonth, $endOfMonth]);

        $expensesQuery = (clone $monthlyBaseQuery)
            ->when($categoryId, fn ($q) => $q->where('category_id', $categoryId));

        $expenses = $expensesQuery
            ->orderByDesc('spent_at')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        $totalMonthly = (clone $expensesQuery)->sum('amount');
        $dailyAverage = $daysInMonth > 0 ? $totalMonthly / $daysInMonth : 0;

        $totalsByCategory = Expense::query()
            ->join('categories', 'categories.id', '=', 'expenses.category_id')
            ->whereBetween('spent_at', [$startOfMonth, $endOfMonth])
            ->selectRaw('categories.id, categories.name, categories.color, SUM(expenses.amount) as total')
            ->groupBy('categories.id', 'categories.name', 'categories.color')
            ->orderByDesc('total')
            ->get();

        return view('dashboard.index', [
            'categories' => Category::orderBy('name')->get(),
            'expenses' => $expenses,
            'selectedMonth' => $monthDate->format('Y-m'),
            'selectedCategoryId' => $categoryId,
            'today' => Carbon::now($timezone)->toDateString(),
            'totalMonthly' => $totalMonthly,
            'dailyAverage' => $dailyAverage,
            'daysInMonth' => $daysInMonth,
            'totalsByCategory' => $totalsByCategory,
        ]);
    }
}
