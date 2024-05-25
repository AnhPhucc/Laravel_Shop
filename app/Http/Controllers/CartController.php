<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::all();
        $countcart = Cart::count();
        return view('cart', compact('carts', 'countcart'));

    }
    public function addToCart(Request $request)
    {
        // check login
        if (!Auth::check()) {
            return redirect()->back()->with('errors', 'Vui lòng đăng nhập');
        }
        //check product exitàng

        $product = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();
        if ($product) {
            $product->quantity += 1;
            $product->save();
            return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng');

        }
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->qty,
            'price' => 0,

        ]);
        return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng');

    }
    public function updateCart(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->quantity = $request->quantity;
        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }
    public function deleteCart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed successfully!');
    }

}
