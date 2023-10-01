<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Session;
use Stripe;

class HomeController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if($role=='1'){
            $total_product=Product::all()->count();
            $total_order=Order::all()->count();
            $total_user=Auth::user()->count();
            $order=order::all();
            $total_revenue=0;

            foreach ($order as $order) {
                $total_revenue=$total_revenue+$order->price;
            }

            $total_delivered=Order::where('delivery_status','=','delivered')->get()->count();
            $total_pending=Order::where('delivery_status','=','pending')->get()->count();


            return view('admin.dashboard',compact('total_product','total_order','total_user','total_revenue','total_delivered','total_pending'));
        }
        else{
            return view('customer.dashboard',);
        }
    }

    public function wperfume()
    {
        $product = Product::all(); // Fetch all products from the database
        return view('customer.wperfume',compact('product'));
    }

    public function mperfume()
    {
        $mproduct = Product::all(); // Fetch all products from the database
        return view('customer.mperfume',compact('mproduct'));
    }

    public function product_details($id)
    {
        $product = Product::find($id); // Fetch all products from the database
        return view('customer.product_details',compact('product'));
    }

    public function add_cart(Request $request,$id)
    {
        $user=Auth::user();
        $product = Product::find($id); // Fetch all products from the database

        $product_exist_id=Cart::where('Product_id',$id)->where('user_id',$user->id)->get('id')->first();

        if($product_exist_id!=NULL){
            $cart=Cart::find($product_exist_id->id)->first();
            $cart->quantity=$cart->quantity+$request->quantity;

            if($product->discount_price==NULL){
                $cart->price=$product->price * $cart->quantity;
            }
            else{
                $cart->price=$product->discount_price * $cart->quantity;
            }

            $cart->save();
            return redirect()->back()->with('message','Product Added to Cart Successfully');
        }
        else
        {
            $cart = new Cart();

            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->user_id=$user->id;

            $cart->Product_title=$product->title;

            if($product->discount_price==NULL){
                $cart->price=$product->price * $request->quantity;
            }
            else{
                $cart->price=$product->discount_price * $request->quantity;
            }

            $cart->quantity=$request->quantity;
            $cart->image=$product->image;
            $cart->Product_id=$product->id;

            $cart->save();

            return redirect()->back()->with('message','Product Added to Cart Successfully');
        }


    }

    public function show_cart()
    {
        $user=Auth::user();
        $cart=Cart::where('user_id',$user->id)->get();
        return view('customer.show_cart',compact('cart'));
    }

    public function remove_cart($id)
    {
        $cart=Cart::find($id);
        $cart->delete();
        return redirect()->back()->with('message','Product Removed from Cart Successfully');
    }

    public function cash_order()
    {
        $user=Auth::user();
        $cart=Cart::where('user_id',$user->id)->get();

        foreach($cart as $cart)
        {
            $order = new Order();

            $order->name=$cart->name;
            $order->email=$cart->email;
            $order->phone=$cart->phone;
            $order->address=$cart->address;
            $order->user_id=$cart->user_id;

            $order->product_title=$cart->product_title;
            $order->quantity=$cart->quantity;
            $order->price=$cart->price;
            $order->image=$cart->image;
            $order->Product_id=$cart->Product_id;

            $order->payment_status='cash on delivery';
            $order->delivery_status='pending';
            $order->save();

            $cart_id=$cart->id;
            $cart=Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message','Order Placed Successfully. We will contact you soon.');
    }

    public function stripe($totalprice)
    {
        return view('customer.stripe',compact('totalprice'));
    }

    public function stripePost(Request $request,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
            "amount" => $totalprice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thank you for the purchase."
        ]);

        $user=Auth::user();
        $cart=Cart::where('user_id',$user->id)->get();

        foreach($cart as $cart)
        {
            $order = new Order();

            $order->name=$cart->name;
            $order->email=$cart->email;
            $order->phone=$cart->phone;
            $order->address=$cart->address;
            $order->user_id=$cart->user_id;

            $order->product_title=$cart->product_title;
            $order->quantity=$cart->quantity;
            $order->price=$cart->price;
            $order->image=$cart->image;
            $order->Product_id=$cart->Product_id;

            $order->payment_status='Paid';
            $order->delivery_status='pending';
            $order->save();

            $cart_id=$cart->id;
            $cart=Cart::find($cart_id);
            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');

        return back();
    }

    public function show_order()
    {
        $user=Auth::user();
        $order=Order::where('user_id',$user->id)->get();
        return view('customer.show_order',compact('order'));
    }

    public function cancel_order($id)
    {
        $order=Order::find($id);
        $order->delivery_status='ORDER CANCELLED';
        $order->save();
        return redirect()->back()->with('message','Order Cancelled Successfully');
    }


}
