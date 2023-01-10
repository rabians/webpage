<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Cart;
use App\Models\Order;
use App\Mail\ContactMailable;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function index()
    {
        return view('mail.order-mail');
    }

    public function mailsending(Request $request, $cart)
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
    }

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