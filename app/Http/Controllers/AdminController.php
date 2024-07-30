<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Lấy số lượng danh mục và sản phẩm
        $categoriesCount = Category::count();
        $productsCount = Product::count();

        return view('admin.dashboard', compact('categoriesCount', 'productsCount'));
    }
}
