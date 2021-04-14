<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index ()
    {

        return view('admin.category.index');
    }

    public function store (Request $request)
    {
        //validate data

        $request->validate([
            'category_name' => 'required|max:100|unique:categories',
        ]);

        // Method A
        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);

        //Method B: RECOMMENDED METHOD

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        return Redirect()->back()->with('success', 'New Category Added.');
    }
}
