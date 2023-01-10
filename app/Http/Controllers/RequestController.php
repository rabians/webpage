<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cart;
use App\Models\Products;
use App\Models\Order;
use App\Mail\OrderMail;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;
use Session;

class RequestController extends Controller
{
    private $id_cart;

        public function store_products(Request $request)
        {
            $request->validate([
            'product_code' => ['required', 'unique:products,code'],
            'product_quantity' => 'required',
            'product_name' => 'required',
            'product_price' => 'required',
            'filename' => 'required',
            'product_description' => 'required',
            'product_catagory' => 'required',
        ]);
            $image_name = '';
        if ($request -> hasFile('filename')) {
            $destination_path = 'public/images/products';
            $image= $request-> file('filename');
            $extension = $request->file('filename')->extension();
            $image_name= request('product_code').'.'.$extension;
            $path = $request->file('filename')->storeAs($destination_path, $image_name);
            $input['filename'] = $image_name;
        }
        $products = new Products();
        $products -> name = request('product_name');
        $products -> code = request('product_code');
        $products -> qty = request('product_quantity');
        $products -> weight = request('product_weight');
        $products -> price = request('product_price');
        $products -> image = $image_name;
        $products -> dimension = request('dimension');
        $products -> description = request('product_description');
        $products -> catagory = request('product_catagory');

        $products->save();
        $products = Products::all();
        return view('home' , ['products' => $products]);
        }
         public function delete($id)
         {

            $products = Products::findOrFail($id);
            $products-> delete();
            return response()->json(['status'=>'Service Catagory Deleted']);
         }
         public function delete1($id)
         {

            $order = order::findOrFail($id);

            $order-> delete();
            return response()->json(['status'=>'Service Catagory Deleted']);
         }
    public function store_password(Request $request)
{
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with("status", "Password changed successfully!");
}
public function delete_product(Request $request)
{
      $request->session()->forget('cart');
      return redirect('/');

}
public function buy_now(Request $request, $id)
{
    $products = Products::find($id);
        $oldCart = Session::has('cart')? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($products , $products->id);
        $request -> session()->put('cart', $cart);
        $c = $request->session()->get('cart')->items;
        end($c);  
        $last = key($c);  
        $last_element = $c[$last];
        return view('cart' , ['products' => $cart->items, 'totalPrice' =>$cart-> totalPrice]);
}
public function checkout(Request $request, $id)
    {
        $products = Products::find($id);
        $oldCart = Session::has('cart')? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        //$i = 0;
        $cart->add($products , $products->id);
        $request -> session()->put('cart', $cart);
        $c = $request->session()->get('cart')->items;
        //->items[$products->id]['item']['id']);
        //dd($c);
        end($c);  
        $last = key($c);  
        $last_element = $c[$last];
        //dd($last_element['price']);
        return redirect()->back();
    }
    public function extra()
    {
        return view('extra');
    }
    public function manage_orders()
    {
        $orders = order::all();
        $orders->transform(function($order, $key)
            {
                $order->cart = unserialize($order->cart );
                //dd($order-> );
                return $order;
            });
        //dd($orders);
        return view('manage_orders', ['orders' => $orders]);
    }
    public function shopping_cart()
    {
        if(!Session ::has('cart'))
        {
            return view('cart', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

       // Session::forget('cart');
        return view('cart' , ['products' => $cart->items, 'totalPrice' =>$cart-> totalPrice]);
    }
    public function success()
    {
        return view('sucess_message');
    }
        public function index()
    {
        return view('mail.order-mail');
    }

    /*public function mailsending(Request $request, $cart)
    {
        $contact_data = [
            'full_name' => $request->input('full_name'),
            'phone_number' => $request->input('phone_number'),
            'subject' => 'Your order has been placed-',
            'email_address' => $request->input('email_address'),
            'address' => $request->input('address'),
            'postal_code' => $request->input('zip_code'),
            'city' => $request->input('city'),
            'message' => $cart,
        ];
        $email = $request->input('email_address');

        Mail::to($email)->send(new ContactMailable($contact_data));
        //dd($contact_data);
        //return redirect()->back()->with('status','Thank you for contact us. We will get back to asap.!');
    }*/
    public function cart_details(Request $request)
        {
             $request->validate([
            'full_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip_code' => 'required|integer', 
            'phone_number' => 'required', 
            'email_address' => 'required',
        ]);
        $oldCart = Session::has('cart')? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $order = new Order();
        $order->cart = serialize($cart);
        $order->total_Price = $cart->totalPrice;
        $order->total_qty = $cart->totalQty;
        $order->address = $request->input('address');
        $order->postal_code = $request->input('zip_code');
        $order->name = $request->input('full_name');
        $order->city = $request->input('city');
        $order->email = $request->input('email_address');
        $order->phone = $request->input('phone_number');
        $order->save();
        //send mail
       //dd($cart);
        
        $this->mailsending($request, $cart);
        //$this->mailsending($request, $cart);
        $request->session()->forget('cart');
        return view('sucess_message');
        }
    
    }
    ?>