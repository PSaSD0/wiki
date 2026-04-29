<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        $array = DB::table('products')->get();
        $productNew = (DB::table("products"))->orderBy('id', 'desc')->limit(4)->get();
        $popularProduct = DB::table('products')
            ->join('chats', 'products.id', '=', 'chats.id_product')
            ->select('products.*', DB::raw('COUNT(chats.id) as messages_count'))
            ->groupBy('products.id')
            ->orderBy('messages_count', 'desc')
            ->limit(4)
            ->get();
        return view('home', compact('array', 'productNew', 'popularProduct'));
    }
}
