<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index()
    {
        $startOfCurrentMonth = Carbon::now()->startOfMonth();
        $endOfCurrentMonth = Carbon::now()->endOfMonth();
        $expenses = Expense::OfLoggedInUser()->whereBetween('expense_date', [$startOfCurrentMonth, $endOfCurrentMonth])
            ->select('expense_date', DB::raw('sum(expense_amount) as total_expense'))
            ->groupBy('expense_date')
            ->get();

        $expensesDataForGraph = $expenses->mapWithKeys(function ($v, $k) {
            return [$v->expense_date->format('d-m-Y') => (int) $v->total_expense];
        });

        $categories = Category::OfLoggedInUser()->selectRaw("categories.*, (select sum(expense_amount) from expenses where expenses.category_id = categories.id and expenses.expense_date >= '$startOfCurrentMonth' and expenses.expense_date <= '$endOfCurrentMonth') as total_expense")->get();

        $categoryWiseExpenseGraph = $categories->mapWithKeys(function ($v, $k) {
            return [$v->name => (int) $v->total_expense];
        });

        return view('reports.index', compact('expensesDataForGraph', 'categoryWiseExpenseGraph'));
    }
}
