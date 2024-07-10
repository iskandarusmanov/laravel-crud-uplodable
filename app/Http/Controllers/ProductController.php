<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10000',
        ]);

        $requestData = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/products', 'public');
            $requestData['image'] = $imagePath;
        }

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('files/products', 'public');
            $requestData['pdf'] = $pdfPath;
        }

        Product::create($requestData);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $products = Product::findOrFail($id);
        return view('products.show',  compact('products'));
    }

    public function edit($product)
    {
        $products = Product::find($product);
        return view('products.edit', compact('products'));
    }

    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10000',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->input('name'),
            'brand' => $request->input('brand'),
            'price' => $request->input('price'),
        ]);

        if ($request->hasFile('image')) {
            if (isset($product->image)) {
                Storage::delete($product->image);
            }
            $imagePath = $request->file('image')->store('images/products', 'public');
            $product->image = $imagePath;
            $product->save();
        }

        if ($request->hasFile('pdf')) {
             if (isset($product->pdf)) {
                Storage::delete($product->pdf);
            }
            $pdfPath = $request->file('pdf')->store('files/products', 'public');
            $product->pdf = $pdfPath;
            $product->save();
        }

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        if (isset($product->image)) {
            Storage::delete($product->image);
        }

        if (isset($product->pdf)) {
            Storage::delete($product->pdf);
        }

        $product->delete();
        return redirect()->route('products.index');
    }
}
