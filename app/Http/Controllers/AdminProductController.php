<?php

// app/Http/Controllers/AdminProductController.php

// app/Http/Controllers/AdminProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $selectedCategoryId = $request->input('category_id');

        if ($selectedCategoryId) {
            $products = Product::where('category_id', $selectedCategoryId)->paginate(3);
        } else {
            $products = Product::with('category')->paginate(3);
        }

        return view('admin.products.index', compact('products', 'categories', 'selectedCategoryId'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'quantity' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
    ]);

    // Lấy dữ liệu từ request
    $data = $request->except('image'); // Loại bỏ key image
    $data['image'] = ''; // Đặt giá trị mặc định cho image

    // Kiểm tra nếu có ảnh mới được tải lên
    if ($request->hasFile('image')) {
        // Xóa ảnh cũ nếu tồn tại
        if ($request->old_image) {
            Storage::disk('public')->delete($request->old_image);
        }

        // Lưu ảnh mới
        $path_image = $request->file('image')->store('images', 'public');
        $data['image'] = $path_image;
    } else {
        // Nếu không có ảnh mới, giữ ảnh cũ
        if ($request->old_image) {
            $data['image'] = $request->old_image;
        }
    }

    // Tạo sản phẩm mới
    Product::create($data);

    return redirect()->route('products.index')->with('success', 'Product added successfully.');
}

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->except('image');

    if ($request->hasFile('image')) {
        // Xóa ảnh cũ nếu có
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $path_image = $request->file('image')->store('images', 'public');
        $data['image'] = $path_image;
    } else {
        // Giữ lại ảnh cũ nếu không có ảnh mới
        $data['image'] = $product->image;
    }

    $product->update($data);

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
