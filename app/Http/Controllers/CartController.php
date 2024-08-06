<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirm;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $products = [];

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
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        session()->put('cart', $cart);

        return redirect()->route('client.products.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId] = $quantity;
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function destroy($id)
    {
        $cartItems = session()->get('cart', []);

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
            'user_id' => Auth::id(),
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
    
        $order->load('items.product');
    
        if (Auth::check()) {
            $user = Auth::user();
            if ($user && $user->email) {
                $email = $user->email;
                Mail::to($email)->send(new OrderConfirm($order));
            } else {
                return redirect()->route('login')->with('error', 'You need to log in to place an order.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to log in to place an order.');
        }
    
        session()->forget('cart');
    
        return redirect()->route('cart.index')->with('success', 'Đơn hàng của bạn đã được đặt và xác nhận qua email!');
    }
    
}
