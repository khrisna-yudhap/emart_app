<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();

        $totalProduct = [];

        // foreach($categories as $category){

        // }

        return view('category', [
            'title' => "Product Category | E-Mart",
            'pageIndex' => 2,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'category_name' => 'required',
        ]);

        $category = Category::create(['category_name' => $validatedData['category_name']]);
        if ($category) {
            return redirect()->route('category.index')->with('success-add', 'Successfully create a category.');
        } else {
            return redirect()->router('category.index')->withErrors();
        }
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index');
    }
}
