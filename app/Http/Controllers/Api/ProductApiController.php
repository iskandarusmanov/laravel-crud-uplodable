<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Get list of products",
     *     description="Returns a list of products",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Product"))
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Create a new product",
     *     description="Create a new product with the provided data",
     *    @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *      required={"name", "brand", "price"},
     *      @OA\Property(property="name", type="string"),
     *      @OA\Property(property="brand", type="string"),
     *      @OA\Property(property="price", type="number", format="float"),
     *      @OA\Property(property="image", type="string", format="binary"),
     *      @OA\Property(property="pdf", type="string", format="binary"),
     *      ),
     *  ),
     *     @OA\Response(
     *         response=201,
     *         description="Product created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10000',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images');
            $product->image = $imagePath;
        }

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('product_pdfs');
            $product->pdf = $pdfPath;
        }

        $product->save();

        return response()->json($product, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/product-edit/{id}",
     *     tags={"Products"},
     *     summary="Update an existing product",
     *     description="Update an existing product with the provided data",
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         description="ID of the product to update",
     *         @OA\Schema(type="integer")
     *     ),
     *    @OA\RequestBody(
     *      required=true,
     *    @OA\JsonContent(
     *      required={"name", "brand", "price"},
     *      @OA\Property(property="name", type="string"),
     *      @OA\Property(property="brand", type="string"),
     *      @OA\Property(property="price", type="number", format="float"),
     *      @OA\Property(property="image", type="string", format="binary"),
     *      @OA\Property(property="pdf", type="string", format="binary"),
     *    ),
     *  ),

     *     @OA\Response(
     *         response=200,
     *         description="Product updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     ),
     * )
     */
    public function update(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10000',
        ]);

        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images');
            $product->image = $imagePath;
        }

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('product_pdfs');
            $product->pdf = $pdfPath;
        }

        $product->save();

        return response()->json($product);
    }


 /**
 * @OA\Delete(
 *     path="/api/remove-product/{id}",
 *     tags={"Products"},
 *     summary="Delete a product",
 *     description="Delete a product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the product to delete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Product deleted successfully",
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Product not found"
 *     )
 * )
 */
public function deleteProduct($id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    if (isset($product->image)) {
        Storage::delete($product->image);
    }

    if (isset($product->pdf)) {
        Storage::delete($product->pdf);
    }

    DB::table('products')->where('id', $id)->delete();

    return response()->json(['message' => ' Product deleted successfully'], 200);
}

}
