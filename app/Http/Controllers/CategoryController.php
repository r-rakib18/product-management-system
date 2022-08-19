<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
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

        if (! has_role('category_view',$permission)){

            return redirect()->with(Session::flush('alert-danger','You do not have permission'));
        }

        $data = [
            'categories'=> Category::OrderBy('id', 'DESC')->get(),
            'permission'=> $permission
        ];

        return view('category.index', $data);
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

        if (! has_role('category_create',$permission)){
            return redirect()->with(Session::flush('alert-danger','You do not have permission'));
        }

        $data['permission']= $permission;
        return view('category.create',$data);
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
            'name' => 'required',
            'status' => 'required',
        ],[
            'name.required' => 'please enter category name',
            'status.required' => 'please enter category status',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->save();

        return response()->json(['success' => 'Category '. $category->name .' Added successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (Session::get('user_role') === 'admin'){
            $permission = ['all'];

        }else{
            $role = Role::find(Auth::user()->role_id);
            $permission = json_decode($role->permissions,true);
        }

        if (! has_role('category_edit',$permission)){
            return redirect()->with(Session::flush('alert-danger','You do not have permission'));
        }

        $data = [
            'category' => Category::find($category->id),
            'permission'=> $permission
        ];

        return view('category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if (Session::get('user_role') === 'admin'){
            $permission = ['all'];

        }else{
            $role = Role::find(Auth::user()->role_id);
            $permission = json_decode($role->permissions,true);
        }

        if (! has_role('category_update',$permission)){
            return redirect()->with(Session::flush('alert-danger','You do not have permission'));
        }

        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ],[
            'name.required' => 'please enter category name',
            'status.required' => 'please enter category status',
        ]);

        $category = Category::find($category->id);
        //dd($category);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->update();

        return redirect()->route('category.index')->with(Session::flash('alert-success', 'Category Updated Successfully!!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
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

        if (! has_role('category_delete',$permission)){
            return redirect()->with(Session::flush('alert-danger','You do not have permission'));
        }

        $category = Category::find($request->id);
        $category->delete();
        return response()->json(['success' => 'Category '. $category->name .' Deleted successfully'], 200);
    }
}
