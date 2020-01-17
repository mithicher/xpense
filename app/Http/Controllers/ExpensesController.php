<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ExpensesController extends Controller
{
    public function index()
    {
        $expenses = Expense::OfLoggedInUser()
            ->select('expense_date', DB::raw('sum(expense_amount) as total_expense'))
            ->groupBy('expense_date')
            ->orderBy('expense_date', 'desc')
            ->simplePaginate();

        return view('expenses.index', compact('expenses'));
    }

    public function expensesIndex()
    {
        $expenses = Expense::OfLoggedInUser()
            ->select('expense_date', DB::raw('sum(expense_amount) as total_expense'))
            ->groupBy('expense_date')
            ->orderBy('expense_date', 'desc')
            ->simplePaginate();

        $expenses->withPath('/expenses');

        return view('expenses.indexPartial', compact('expenses'));
    }

    public function create()
    {
        $categories = Category::OfLoggedInUser()->get();

        return view('expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $categoryIds = Category::OfLoggedInUser()->pluck('id');

        $validatedData = $this->validate($request, [
            'category' => [
                'required',
                Rule::in($categoryIds),
            ],
            'expense_name' => 'required',
            'expense_date' => 'required|date',
            'expense_amount' => 'required|numeric',
            'expense_details' => 'sometimes',
        ]);

        Expense::create([
            'user_id' => auth()->id(),
            'category_id' => $validatedData['category'],
            'expense_name' => $validatedData['expense_name'],
            'expense_details' => $validatedData['expense_details'],
            'expense_date' =>  Carbon::parse($validatedData['expense_date'])->format('Y-m-d'),
            'expense_amount' => $validatedData['expense_amount']
        ]);

        session()->flash('success', 'Your expense saved!');

        return response([
            'status' => 'success'
        ], 200);
    }

    public function show($expense, Request $request)
    {
        $expenses = Expense::with('category')
            ->OfLoggedInUser()
            ->where('expense_date', $expense)
            ->orderBy('expense_date', 'desc')
            ->get();

        $categoriesGroupByName = collect($expenses)->groupBy('category.name');

        $expensesDataForGraph = $categoriesGroupByName->map(function ($v, $k) {
            return collect($v)->sum('expense_amount');
        });

        return view('expenses.show', compact('expenses', 'expensesDataForGraph'));
    }

    public function edit($expense, Request $request)
    {
        $expense = Expense::OfLoggedInUser()->findOrFail($expense);
        $categories = Category::all();

        return view('expenses.edit', compact('expense', 'categories'));
    }

    public function update($expense, Request $request)
    {
        $categoryIds = Category::OfLoggedInUser()->pluck('id');

        $validatedData = $this->validate($request, [
            'category' => [
                'required',
                Rule::in($categoryIds),
            ],
            'expense_name' => 'required',
            'expense_date' => 'required|date',
            'expense_amount' => 'required|numeric',
            'expense_details' => 'sometimes',
        ]);

        $expense = Expense::OfLoggedInUser()->findOrFail($expense);
        $expense->update([
            'category_id' => $validatedData['category'],
            'expense_name' => $validatedData['expense_name'],
            'expense_date' =>  Carbon::parse($validatedData['expense_date'])->format('Y-m-d'),
            'expense_amount' => $validatedData['expense_amount']
        ]);

        session()->flash('success', 'Expense details updated!');

        return response([
            'status' => 'success'
        ], 200);
    }

    public function destroy()
    {
        $expense = Expense::OfLoggedInUser()->findOrFail(request('expense_id'));
        $expense->delete();

        session()->flash('success', 'Expense details deleted!');

        return redirect()->back();
    }
}
