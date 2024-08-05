<?php
// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index()
    {
        // Lấy các mục giỏ hàng từ session
        $cartItems = session()->get('cart', []);
    
        // Khởi tạo mảng chứa các sản phẩm
        $products = [];
    
        // Tìm sản phẩm từ cơ sở dữ liệu dựa trên ID
        foreach ($cartItems as $productId => $quantity) {
            $product = Product::find($productId);
    
            if ($product) {
                $products[] = [
                    'product' => $product,
                    'quantity' => $quantity
                ];
            }
        }
    
        return view('client.cart.index', ['cartItems' => $products]);
    }
    public function store(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
    
        // Lấy sản phẩm từ cơ sở dữ liệu
        // $product = Product::find($productId);
    
        // // Kiểm tra nếu sản phẩm tồn tại
        // if (!$product) {
        //     return redirect()->back()->with('error', 'Product not found!');
        // }
    
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
    
        // Thêm sản phẩm vào giỏ hàng
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }
    
        // Cập nhật giỏ hàng vào session
        session()->put('cart', $cart);
    
        return redirect()->route('client.products.index')->with('success', 'Product added to cart!');
    }
    
// app/Http/Controllers/CartController.php

public function update(Request $request)
{
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity');

    // Lấy giỏ hàng từ session
    $cart = session()->get('cart', []);

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    if (isset($cart[$productId])) {
        $cart[$productId] = $quantity;
        session()->put('cart', $cart);
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}

public function destroy($id)
{
    // Lấy giỏ hàng từ session
    $cartItems = session()->get('cart', []);

    // Tìm và loại bỏ sản phẩm khỏi giỏ hàng
    if (isset($cartItems[$id])) {
        unset($cartItems[$id]);
        session()->put('cart', $cartItems);
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}
public function getCartQuantity()
{
    $cartItems = session()->get('cart', []);
    $totalQuantity = array_sum($cartItems);

    return response()->json(['quantity' => $totalQuantity]);
}

public function processCheckout(Request $request)
{
    $request->validate([
        'address' => 'required|string',
        // Thêm các trường khác nếu cần
    ]);

    $cartItems = session()->get('cart', []);
    if (empty($cartItems)) {
        return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
    }

    $totalAmount = 0;
    foreach ($cartItems as $productId => $quantity) {
        $product = Product::find($productId);
        $totalAmount += $product->price * $quantity;
    }

    $order = Order::create([
        'user_id' => auth()->id(),
        'total_amount' => $totalAmount,
        'status' => 'pending',
        'address' => $request->input('address')
    ]);

    foreach ($cartItems as $productId => $quantity) {
        $product = Product::find($productId);
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $productId,
            'quantity' => $quantity,
            'price' => $product->price
        ]);
    }

    session()->forget('cart');

    // Gửi email xác nhận đơn hàng
    Mail::to(auth()->user()->email)->send(new OrderConfirmation($order));

    return redirect()->route('cart.index')->with('success', 'Đơn hàng của bạn đã được đặt và xác nhận qua email!');
}

}
