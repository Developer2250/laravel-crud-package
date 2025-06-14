<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('Product.index', compact('products'));
    }

    public function create()
    {
        return view('Product.create');
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->all();
        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $item = Product::findOrFail($id);
        return view('Product.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Product::findOrFail($id);
        return view('Product.edit', compact('item'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $item = Product::findOrFail($id);
        $item->update($request->validated());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $item->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}