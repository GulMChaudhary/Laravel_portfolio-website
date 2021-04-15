<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index ()
    {
       /* Getting latest data with ORM Model - Getting all data

       $categories = Category::latest()->get();

        Pagination

        */

        $categories = Category::latest()->paginate(5);

        /*
        ------------------- QueryBuilder Examples -------------------
        1. Getting latest data with Querybuilder

            $categories = DB::table('categories')->latest()->get();

        2. If we want to use Pagination

            $categories = DB::table('categories')->latest()->paginate(5);

       REMEMBER: diffForHumans() method will not work with QueryBuilder

       3. Joining / initiating relationship with User and Category table

            $categories = DB::table('categories')
                            ->join('users', 'categories.user_id', 'users.id')
                            ->select('categories.*', 'users.name')
                            ->latest()
                            ->paginate(5);

        */



        return view('admin.category.index', compact('categories'));
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

        // With this method, no need to use explicity Carbon class. Both created_at and updated_at
        // fields are updated automatically and diffForHumans() will work

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        return Redirect()->back()->with('success', 'New Category Added.');
    }
}
