<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('approved');
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (Category::where('name', $request->name)->first()) {
            return redirect('/category/index')->with('error','Category already exist! ');
        }
        else{
        $category = new Category($data);
        $category->save();

        return redirect('/category/index')->with('success','New category added successfully');
        }
    }


        public function index()
    {
        $categories = Category::all();

        return view('category.index', compact('categories'));
    }

    public function destroy(Category $category)
    {
        $category->products()->delete();
        $category->delete();

        return redirect('/category/index')->with('success','Category and all products under it deleted successfully');
    }

}
