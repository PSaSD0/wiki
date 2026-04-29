<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class WebController extends Controller
{
    public function home()
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

    public function profile(){
        $user = Auth::user();

        $products = DB::table('chats')
        ->join('products', 'chats.id_product', '=', 'products.id')
        ->where('chats.id_user', '=', $user->id)
        ->select('products.*', DB::raw('COUNT(chats.id) as messages_count'))
        ->groupBy('products.id', 'products.name', 'products.image', 'products.about', 'products.how_to_play', 'products.inside_box', 'products.id_genre', 'products.id_time', 'products.id_publisher', 'products.id_rule')
        ->orderBy('messages_count', 'desc')
        ->get();

        return view('profile', compact('user', 'products'));
    }

    public function catalog(Request $request)
    {
        $sort = $request->sort;

        $array = DB::table('products')
            ->leftJoin('genres', 'products.id_genre', '=', 'genres.id')
            ->leftJoin('times', 'products.id_time', '=', 'times.id')
            ->leftJoin('publishers', 'products.id_publisher', '=', 'publishers.id')
            ->leftJoin('rules', 'products.id_rule', '=', 'rules.id')
            ->select('products.*',
                'genres.name as genre_name',
                'times.name as time_name',
                'publishers.name as publisher_name',
                'rules.name as rule_name');

        if($sort == 'genre'){
            $array->orderBy('genres.name');
        }
        elseif($sort == 'time'){
            $array->orderBy('times.name');
        }
        elseif($sort == 'publisher'){
            $array->orderBy('publishers.name');
        }
        elseif($sort == 'rule'){
            $array->orderBy('rules.name');
        }
        else{
            $array->orderBy('products.id', 'desc');
        }

        $array = $array->get();

        return view('catalog', compact('array'));
    }

    public function card($id){
        $card = DB::table('products')
            ->where('products.id', $id)
            ->join('genres', 'products.id_genre', '=', 'genres.id')
            ->join('times', 'products.id_time', '=', 'times.id')
            ->join('rules', 'products.id_rule', '=', 'rules.id')
            ->join('publishers', 'products.id_publisher', '=', 'publishers.id')
            ->select(
                'products.*',
                'genres.name as genre_name',
                'times.name as time_name',
                'rules.name as rule_name',
                'publishers.name as publisher_name'
            )->first();

        $messages = DB::table('chats')
            ->join('users', 'chats.id_user', '=', 'users.id')
            ->select('chats.*', 'users.name as user_name')
            ->where('chats.id_product', '=', $id)
            ->orderBy('chats.created_at', 'desc')
            ->get();

        return view('card', compact('card', 'messages'));
    }

    public function addMessage($id, Request $request){
        DB::table('chats')->insert([
            'id_product' => $id,
            'id_user' => Auth::user()->id,
            'message' => $request->message,
            'created_at' => now(),
        ]);
         return redirect()->back()->with('messageAddMessage', 'Сообщение добавлено');
    }
}
