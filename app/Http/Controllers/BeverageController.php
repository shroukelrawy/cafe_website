<?php

namespace App\Http\Controllers;
use App\Models\Beverage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BeverageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title="List of Beverages";
        $search = $request->query('search');
        $beverages = Beverage::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%$search%")
                             ->orWhere('content', 'like', "%$search%");
            })
            ->paginate(10);

        return view('dashboard.beverages', compact('beverages','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title="Add Beverage";
        $categories = Category::all();
        return view('dashboard.addbeverage', compact('categories','title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'price' => 'required|numeric',
            'published' => 'nullable|boolean',
            'special' => 'nullable|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
        $imagePath = $request->file('image')->store('images', 'public');

        Beverage::create([
            'title' => $request->title,
            'content' => $request->content,
            'price' => $request->price,
            'published' => $request->has('published'),
            'special' => $request->has('special'),
            'image' => $imagePath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('dashboard.beverages')->with('success', 'Beverage added successfully.');
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
    public function edit(Beverage $beverage)
    {
        $title="Add Beverage";
        $categories = Category::all();
        return view('dashboard.editbeverage', compact('beverage', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Beverage $beverage)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'price' => 'required|numeric',
            'published' => 'nullable|boolean',
            'special' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $beverage->image);
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $beverage->image;
        }

        $beverage->update([
            'title' => $request->title,
            'content' => $request->content,
            'price' => $request->price,
            'published' => $request->has('published'),
            'special' => $request->has('special'),
            'image' => $imagePath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('dashboard.beverages')->with('success', 'Beverage updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Beverage $beverage)
    {
        Storage::delete('public/' . $beverage->image);
        $beverage->delete();

        return redirect()->route('dashboard.beverages')->with('success', 'Beverage deleted successfully.');
    }
}
