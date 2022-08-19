<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get('user_role') === 'admin'){
            $permission = ['all'];

        }else{
            $role = Role::find(Auth::user()->role_id);
            $permission = json_decode($role->permissions,true);
        }

        if (! has_role('product_view',$permission)){
            return redirect()->with(Session::flush('alert-danger','You do not have permission'));
        }

        $data = [
            'products'=> Product::OrderBy('id', 'DESC')->get(),
            'permission'=> $permission
        ];

        return view('product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Session::get('user_role') === 'admin'){
            $permission = ['all'];

        }else{
            $role = Role::find(Auth::user()->role_id);
            $permission = json_decode($role->permissions,true);
        }

        if (! has_role('product_create',$permission)){
            return redirect()->with(Session::flush('alert-danger','You do not have permission'));
        }

        $data =[
            'categories' => Category::Where('status', '1')->get(),
            'permission'=> $permission
        ];

        return view('product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'barcode' => 'required',
            'status' => 'required',
        ],[
            'category_id.required' => 'please select category',
            'name.required' => 'please enter product name',
            'price.required' => 'please enter product price',
            'quantity.required' => 'please enter product quantity',
            'barcode.required' => 'please enter product barcode',
            'status.required' => 'please enter product status',
        ]);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->barcode = $request->barcode;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->save();
        return response()->json(['success' => 'Product '. $product->name .' Added successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if (Session::get('user_role') === 'admin'){
            $permission = ['all'];

        }else{
            $role = Role::find(Auth::user()->role_id);
            $permission = json_decode($role->permissions,true);
        }

        if (! has_role('product_edit',$permission)){
            return redirect()->with(Session::flush('alert-danger','You do not have permission'));
        }

        $data = [
            'product' => Product::find($product->id),
            'categories' => Category::Where('status', '1')->get(),
            'permission' => $permission
        ];

        return view('product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if (Session::get('user_role') === 'admin'){
            $permission = ['all'];

        }else{
            $role = Role::find(Auth::user()->role_id);
            $permission = json_decode($role->permissions,true);
        }

        if (! has_role('product_update',$permission)){
            return redirect()->with(Session::flush('alert-danger','You do not have permission'));
        }

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'barcode' => 'required',
            'status' => 'required',
        ],[
            'category_id.required' => 'please select category',
            'name.required' => 'please enter product name',
            'price.required' => 'please enter product price',
            'quantity.required' => 'please enter product quantity',
            'barcode.required' => 'please enter product barcode',
            'status.required' => 'please enter product status',
        ]);

        $product = Product::find($product->id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->barcode = $request->barcode;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->update();

        return redirect()->route('product.index')->with(Session::flash('alert-success', 'Product Updated Successfully!!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (Session::get('user_role') === 'admin'){
            $permission = ['all'];

        }else{
            $role = Role::find(Auth::user()->role_id);
            $permission = json_decode($role->permissions,true);
        }

        if (! has_role('product_delete',$permission)){
            return redirect()->with(Session::flush('alert-danger','You do not have permission'));
        }

        $product = Product::find($request->id);
        if ($product->image){
            $image = $product->image;
            Storage::delete('public/product/'. $image);
        }
        $product->delete();
        return response()->json(['success' => 'Product '. $product->name .' Deleted successfully'], 200);
    }
}
