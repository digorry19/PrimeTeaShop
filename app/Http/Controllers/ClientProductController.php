<?php

// app/Http/Controllers/ClientProductController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ClientProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(6); // Phân trang 10 sản phẩm mỗi trang
        $categories = Category::all();
        return view('client.products.index', compact('products', 'categories'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")->get();
        $categories = Category::all(); // Hoặc phương thức khác để lấy danh mục

        return view('client.products.index', compact('products', 'categories'));
    }
    public function filterByCategory(Category $category)
    {
        $products = Product::where('category_id', $category->id)->with('category')->paginate(10); // Phân trang 10 sản phẩm mỗi trang
        $categories = Category::all();
        return view('client.products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $categories = Category::all();
        return view('client.products.show', compact('product', 'categories'));
    }
}
