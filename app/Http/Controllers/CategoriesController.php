<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::OfLoggedInUser()->orderByDesc('created_at')->simplePaginate();

        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        // Todo: Already exists category check
        $validatedData = $this->validate($request, [
            'name' => 'required'
        ]);

        auth()->user()->categories()->create([
            'name' => $validatedData['name']
        ]);

        $categories = Category::OfLoggedInUser()->orderByDesc('created_at')->simplePaginate();
        $categories->withPath('/categories');

        session()->flash('success', 'Category created!');

        return view('categories.indexPartial', compact('categories'));
    }

    public function update($category, Request $request)
    {
        $validatedData = $this->validate($request, [
            'name' => 'required'
        ]);

        $expense = Category::OfLoggedInUser()->findOrFail($category);

        $expense->update([
            'name' => $validatedData['name'],
        ]);

        session()->flash('success', 'Category updated!');

        return response([
            'status' => 'success'
        ], 200);
    }

    public function destroy()
    {
        $category = Category::OfLoggedInUser()->findOrFail(request('category_id'));
        $category->delete();

        session()->flash('success', 'Category deleted!');

        return redirect()->back();
    }
}
