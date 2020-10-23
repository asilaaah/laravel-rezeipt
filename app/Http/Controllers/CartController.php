<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sales;
use App\Models\User;
use App\Models\Store;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Session;
use App\Events\ProductReachedMinimumQuantity;

use Barryvdh\DomPDF\Facade as PDF;
use function PHPUnit\Framework\returnArgument;

class CartController extends Controller
{
    public function index()
    {
        return view ('dashboard.cashier');
    }

    public function productList()
    {
        $user = FacadesAuth::user();
        $products = Product::all();


        if (request()->category)
        {
            $products = Product::with('category')->whereHas('category', function ($query) {
                $query->where('name', request()->category);
            })->where('quantity', '>', 0)->get();
            $categories = Category::all();
        }
        else {
            $products = Product::where('quantity', '>', 0)->get();
            $categories = Category::all();
        }

        return view('cart.product-list', compact('products', 'user', 'categories'));
    }

    public function addToCart(Request $request, $id)
    {
        $qty = $request->get('qty');
        $product = Product::find($id);
        $quantity = $product->quantity;

        if(($quantity - $qty) >= 0){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);
        $cart->add($product, $product->id, $qty);

        $request->session()->put('cart', $cart);

        return redirect("/product-list");
        }
        else {
            return redirect('/product-list')->with(['error' => 'Item is not enough.', 'quantity' => $quantity]);
        }
    }


    public function cart()
    {
        $product = Product::all();
        if (!Session::has('cart')) {
            return view('cart.cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('cart.cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function reduceByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('cart.cart');
    }

    public function removeItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('cart.cart');
    }

    public function generateQRCode()
    {
        //insert function to generate qr code and save sales order

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $sales = new Sales();
        $sales->cart = serialize($cart);
        $sales->name = FacadesAuth::user()->name;
        FacadesAuth::user()->sales()->save($sales);

        $this->decreaseQuantitites();


        $products = Product::all();
        $user = FacadesAuth::user();

        foreach ($products as $product) {

        if ($product->quantity <= $product->minimum_quantity) {
            event(new ProductReachedMinimumQuantity($user, $product));
        }
    };


        Session::forget('cart');
        return view('cart.qrcode');
    }

    public function getReceipt(Request $request)
    {
        $receipt = FacadesAuth::user()->sales;
        $receipt->transform(function ($sales, $key) {
            $sales->cart = unserialize($sales->cart);
            return $sales;
        });

        $newreceipt = $receipt->sortByDesc('created_at')->first();
        $store = Store::all()->first();

        $paidAmount = $request->paidAmount;
        if ($request->session()->has('paidAmount')) {
            $paid = $request->session()->get('paidAmount');
            $change = $paid - $newreceipt->cart->totalPrice;
            session()->put('paid', $paid);
            session()->put('change', $change);

            $pdf = PDF::loadView('cart.receipt', compact('newreceipt', 'store', 'paid', 'change'));
            return $pdf->stream();

        }

    }


    public function decreaseQuantitites()
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        foreach ($cart->items as $item)
        {
            $product = Product::find($item['item']['id']);
            $product->decrement('quantity', $item['qty']);
        }
    }

    public function getChange(Request $request)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $paidAmount = $request->paidAmount;
        $request->session()->put('paidAmount', $paidAmount);

        if ($request->session()->has('paidAmount')) {
            $paid = $request->session()->get('paidAmount');
            $change = $paid - $cart->totalPrice;

            return redirect()->route('cart.cart')->with('change', $change);
        }

        else
            return redirect()->route('cart.cart');

    }




}
