<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @group Products
     *
     * List Produk
     *
     * Menampilkan daftar produk dengan pagination dan search.
     *
     * @authenticated
     *
     * @queryParam search string Nama produk yang dicari. Example: laptop
     *
     * @response 200 {
     *   "current_page":1,
     *   "data":[]
     * }
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        return response()->json(
            $query->paginate(10)
        );
    }

    /**
     * @group Products
     *
     * Tambah Produk
     *
     * Menambahkan produk baru.
     *
     * @authenticated
     *
     * @bodyParam category_id integer required ID kategori. Example: 1
     * @bodyParam name string required Nama produk. Example: Laptop Asus
     * @bodyParam description string Deskripsi produk.
     * Example: Laptop gaming terbaru
     *
     * @bodyParam price integer required Harga produk. Example: 12000000
     * @bodyParam image file Gambar produk.
     *
     * @response 201 {
     *   "id":1,
     *   "name":"Laptop Asus"
     * }
     */
    public function store(Request $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')
                ->store('products', 'public');
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath
        ]);

        return response()->json($product);
    }

    /**
     * @group Products
     *
     * Detail Produk
     *
     * Menampilkan detail produk beserta kategori.
     *
     * @authenticated
     */
    public function show(Product $product)
    {
        return $product->load('category');
    }

    /**
     * @group Products
     *
     * Update Produk
     *
     * Memperbarui data produk.
     *
     * @authenticated
     *
     * @bodyParam category_id integer required ID kategori.
     * @bodyParam name string required Nama produk.
     * @bodyParam description string Deskripsi produk.
     * @bodyParam price integer required Harga produk.
     * @bodyParam image file Gambar produk.
     */
    public function update(Request $request, Product $product)
    {
        if ($request->hasFile('image')) {

            if ($product->image) {
                Storage::disk('public')
                    ->delete($product->image);
            }

            $product->image = $request->file('image')
                ->store('products', 'public');
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $product->image
        ]);

        return response()->json($product);
    }

    /**
     * @group Products
     *
     * Hapus Produk
     *
     * Menghapus produk berdasarkan ID.
     *
     * @authenticated
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')
                ->delete($product->image);
        }

        $product->delete();

        return response()->json([
            'message' => 'Deleted'
        ]);
    }
}
