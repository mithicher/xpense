<?php

namespace App\Http\Controllers;

use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::OfLoggedInUser()->where('expense_date', Carbon::today()->format('Y-m-d'))->get();

        $expensesYesterday = Expense::OfLoggedInUser()->where('expense_date', '=', Carbon::yesterday()->format('Y-m-d'))->sum('expense_amount');

        $expensesLastSevenDays = Expense::OfLoggedInUser()->where('expense_date', '>=', Carbon::today()->subDays(7))->sum('expense_amount');

        $expensesCurrentMonth = Expense::OfLoggedInUser()->where('expense_date', '>=', Carbon::today()->subDays(30))->sum('expense_amount');

        return view('home', compact('expenses', 'expensesLastSevenDays', 'expensesCurrentMonth', 'expensesYesterday'));
    }
}
