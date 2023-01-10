<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Products;
use Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     
    public function __construct()
    {
        $this->middleware('auth');
    }
*/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        if(Request::get('sort') =='price_asc')
        {
            $products = Products::select('id','price','image','name','catagory')->orderBy('price')->get();
        }
        else if(Request::get('sort') =='price_desc')
        {
            $products = Products::select('id','price','image','name','catagory')->orderByDesc('price')->get();
        }
        else if(Request::get('sort') =='newest')
        {
            $products = Products::select('id','price','image','name','catagory')->orderByDesc('created_at')->get();
        }
        else if(Request::get('filter') =='catagory_1')
        {
            $products = Products::select('id','price','image','name','catagory')->where('catagory', '1')->get();
        }
        else if(Request::get('filter') =='catagory_2')
        {
            $products = Products::select('id','price','image','name','catagory')->where('catagory', '2')->get();
        }
        else if(Request::get('filter') =='catagory_3')
        {
            $products = Products::select('id','price','image','name','catagory')->where('catagory', '3')->get();
        }
        else
        {
            $products = Products::all();
        }
        //
        return view('welcome', ['products' => $products]);
    }
     public function update_product($id, Request $request)
    {
         $request->validate([
            'product_quantity' => 'required',
            'product_name' => 'required',
            'product_price' => 'required',
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
        if($image_name=="")
        {
            $image_name = request('img_name');
        }
         $products= Products::findOrFail($id);
         $products -> name = request('product_name');
        $products -> qty = request('product_quantity');
        $products -> weight = request('product_weight');
        $products -> price = request('product_price');
        $products -> image = $image_name;
        $products -> dimension = request('dimension');
        $products -> description = request('product_description');
        $products -> catagory = request('product_catagory');
         $products->save();
         return back()->with("status", "Record updated successfully!");
    }
     public function update($id)
    {
        $products = Products::findOrFail($id);
        return view('update' , ['products' => $products]);
    }
    public function entry()
    {
        return view('admin.product_entry');
    }
    public function index()
    {
        $products = Products::all();
        return view('home', ['products' => $products]);
    }
    public function details($id)
    {
        $data = Products::find($id);
        return view('detail',['products' => $data] );
    }
    public function search()
    {
        $value = Request::get('query');
        $data = Products::
        where('name', 'like', '%'.$value.'%')
        ->get();
        return 
        view('search',['products' => $data] );;
    }
    public function change_password()
    {
        return view('admin.change_password');
    }
}
