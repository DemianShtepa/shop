<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::getTree();
        return view("categories.index", compact("categories"));
    }


    public function create()
    {
        $categories = Category::get()->toTree();
        return view("categories.create", compact("categories"));
    }

    public function store(CategoryRequest $request)
    {
        Category::createCategory($request->toArray());

        return redirect(route("category.index"));
    }


    public function edit($id)
    {
        $currentCategory = Category::where("id", $id)->withTrashed()->firstOrFail();
        $categories = Category::getTree();

        return view("categories.edit", ["currentCategory" => $currentCategory, "categories" => $categories]);
    }

    public function update(CategoryRequest $request, Category $currentCategory)
    {
        $currentCategory->updateCategory($request->toArray());

        return redirect(route("category.index"));
    }

    public function resort(Request $request)
    {
        $currentCategory = Category::where("id", $request->input("currentID"))->withTrashed()->firstOrFail();
        $currentCategory->resort($request->input("prevID"), $request->input("nextID"));

        return response()->json("done", 200);
    }

    public function delete(Category $currentCategory)
    {
        $currentCategory->delete();

        return redirect(route("category.index"));
    }

    public function forceDelete(Category $currentCategory)
    {
        $currentCategory->forceDelete();

        return redirect(route("category.index"));
    }


    public function restore($id)
    {
        $currentCategory = Category::where("id", $id)->withTrashed()->firstOrFail();
        $currentCategory->restore();

        return redirect(route("category.index"));
    }

}
