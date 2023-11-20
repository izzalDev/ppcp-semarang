<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $words=explode(' ', $request->query('search'));
        $perPage=$request->query('perPage')??10;
        $products = Product::query()
            ->with('category')
            ->where(function ($query) use ($words) {
                foreach ($words as $key) {
                    $query->orWhere('name', 'LIKE', '%' . $key . '%');
                }
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
        return Inertia::render('Product/Index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Product/Create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=>'required|unique:products,name',
            'category'=>'required|exists:categories,id',
            'price'=>'required|integer',
            'stocks'=>'required|integer',
        ]);
        $validated['quantity']=$validated['stocks'];
        $validated['category_id']=$validated['category'];
        unset($validated['stocks'],$validated['category']);
        Product::create($validated);
        return back()->with('message','Product has been created');
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
    public function edit(string $id)
    {
        $product=Product::find($id);
        $categories=Category::all();
        return Inertia::render('Product/Edit',[
            'product'=>$product,
            'categories'=>$categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'=>'required|unique:products,name,'.$id,
            'category'=>'required|exists:categories,id',
            'price'=>'required|integer',
            'stocks'=>'required|integer',
        ]);
        $validated['quantity']=$validated['stocks'];
        $validated['category_id']=$validated['category'];
        unset($validated['stocks'],$validated['category']);
        Product::find($id)->update($validated);
        return back()->with('message','Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return back()->with('message','product deleted');
    }
}
