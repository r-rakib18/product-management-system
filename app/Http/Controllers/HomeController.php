<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data = [
            'total_category' => Category::Where('status', '1')->count(),
            'total_product' => Product::Where('status', '1')->count(),
            'total_admin' => User::Where('role_id', '1')->count(),
            'total_user' => User::Where('role_id', '2')->count(),
        ];

        if (Session::get('user_role') === 'admin'){
            $data['permission'] = ['all'];

        }else{
            $role = Role::find(Auth::user()->role_id);
            $data['permission'] = json_decode($role->permissions,true);
        }

        return view('dashboard',$data);
    }
}
