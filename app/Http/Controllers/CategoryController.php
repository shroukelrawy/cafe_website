<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $title="List Of Categories";
        return view('dashboard.categories', compact('categories','title'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title="List Of Categories";
        return view('dashboard.addcategory', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('dashboard.categories')->with('success', 'Category added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $title="Edit Category";
        return view('dashboard.editcategory', compact('category','title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('dashboard.categories')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->beverages()->exists()) {
            return redirect()->route('dashboard.categories')->with('error', 'Cannot delete category with associated beverages.');
        }

        $category->delete();

        return redirect()->route('dashboard.categories')->with('success', 'Category deleted successfully.');
    
    }
}
