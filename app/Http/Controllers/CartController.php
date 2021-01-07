<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sales;
use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Session;
use App\Events\ProductReachedMinimumQuantity;
use App\Models\Redemption;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade as PDF;

class CartController extends Controller
{
    public function index(User $user)
    {
        return view ('dashboard.cashier', compact('user'));
    }

    public function productList()
    {
        $user = FacadesAuth::user();


        if (request()->category)
        {
            $products = Product::with('category')->whereHas('category', function ($query) {
                $query->where('name', request()->category);
            })->where('quantity', '>', 0)->where('storeId',$user->storeId)->get();
            $categories = Category::all();
        }
        else {
            $products = Product::where('quantity', '>', 0)->where('storeId',$user->storeId)->get();
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

    public function reduceItem($id){
        $qty = request()->get('qty');
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduce($id,$qty);

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
        $sales->id = Str::random(16);
        $sales->cart = serialize($cart);
        $sales->name = FacadesAuth::user()->name;
        FacadesAuth::user()->sales()->save($sales);
        $id = $sales->id;

        $this->decreaseQuantitites();

        $products = Product::all();
        $user = FacadesAuth::user();

        foreach ($products as $product) {

        if ($product->quantity <= $product->minimum_quantity) {
            event(new ProductReachedMinimumQuantity($user, $product));
        }};

        Session::forget('cart');
        return view('cart.qrcode', compact('id'));
    }

    public function getReceipt(Request $request, $id)
    {
        $user = FacadesAuth::user();
        $receipt = FacadesAuth::user()->sales;
        $receipt->transform(function ($sales, $key) {
            $sales->cart = unserialize($sales->cart);
            return $sales;
        });
        $newreceipt = $receipt->sortByDesc('created_at')->first();
        $store = Store::find($user->storeId);
        $redemptionCode = $request->session()->get('redemptionCode');
        $rewardDetails = Redemption::where('couponCode', $redemptionCode)->first();
        if ($request->session()->has('paidAmount')) {
            $paid = $request->session()->get('paidAmount');
            $change = $paid - $newreceipt->cart->totalPrice;

        $pdf = PDF::loadView('cart.receipt', compact('newreceipt', 'store', 'paid', 'change','rewardDetails'));
        session()->forget('redemptionCode');
        session()->forget('paidAmount');
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
        $redemptionCode = $request->session()->get('redemptionCode');
        $rewardDetails = Redemption::where('couponCode',$redemptionCode)->first();

        if ($request->session()->has('paidAmount')) {
            $paid = $request->session()->get('paidAmount');
            $change = $paid - $cart->totalPrice;

            return redirect()->route('cart.cart')->with(['change'=> $change,'rewardDetails'=>$rewardDetails]);
        }

        else
            return redirect()->route('cart.cart');
    }

    public function validateCode(Request $request)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $redemptionCode = $request->redemptionCode;

        if ($redemptionCode) {
            $validCode = $request->validate([
                'redemptionCode' => 'exists:App\Models\Redemption,couponCode'
            ]);
            $request->session()->put('redemptionCode', $redemptionCode);
            $rewardDetails = Redemption::where('couponCode',$redemptionCode)->first();
            $newTotal = $cart->totalPrice - ($rewardDetails->discountAmount/100)*$cart->totalPrice;
            $priceBeforeDiscount = $cart->totalPrice;
            $cart->totalPrice = $newTotal;
            Session::put('cart', $cart);
            Session::put('priceBeforeDiscount', $priceBeforeDiscount);

        return redirect()->route('cart.cart')->with('rewardDetails', $rewardDetails);
        }
        else{
            return redirect()->route('cart.cart')->with('error', "Error code");
}
}
    public function destroyCode(Request $request)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $redemptionCode = $request->session()->get('redemptionCode');
        $priceBeforeDiscount = $request->session()->get('priceBeforeDiscount');
        $rewardDetails = Redemption::where('couponCode',$redemptionCode)->first();
        $newTotal = $cart->totalPrice + ($rewardDetails->discountAmount/100)*$priceBeforeDiscount;
        $cart->totalPrice = $newTotal;
        Session::put('cart', $cart);
        session()->forget('redemptionCode');

        return back()->with('success_message', 'Coupon has been removed.');
    }

    public function destroyChange(Request $request)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $request->session()->forget('paidAmount');

        return back();
    }
}
