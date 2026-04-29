<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function admin(){
        if(Auth::user()->id_role==1){
            $genres = DB::table('genres')->get();
            $times = DB::table('times')->get();
            $publishers = DB::table('publishers')->get();
            $rules = DB::table('rules')->get();
            $users = DB::table('users')->get();
            return view('admin', compact('genres', 'times', 'publishers', 'rules', 'users'));
        }
        else{
            return redirect('/');
        }
    }

    public function addGenres(Request $request){
        DB::table('genres')->insert(['name'=>$request->nameGenres]);
        return redirect()->back()->with('messageAddGenres', 'Жанр успешно добавлен');
    }

    public function dellGenres(Request $request){
        DB::table('genres')->where('id', '=', $request->id_genres)->delete();
        return redirect()->back()->with('messageDellGenres', 'Жанр успешно удален');
    }

    public function addTimes(Request $request){
        DB::table('times')->insert(['name'=>$request->nameTimes]);
        return redirect()->back()->with('messageAddTimes', 'Время игры успешно добавлено');
    }

    public function dellTimes(Request $request){
        DB::table('times')->where('id', '=', $request->id_times)->delete();
        return redirect()->back()->with('messageDellTimes', 'Время игры успешно удалено');
    }

    public function addPublishers(Request $request){
        DB::table('publishers')->insert(['name'=>$request->namePublishers]);
        return redirect()->back()->with('messageAddPublishers', 'Издатель успешно добавлен');
    }

    public function dellPublishers(Request $request){
        DB::table('publishers')->where('id', '=', $request->id_publishers)->delete();
        return redirect()->back()->with('messageDellPublishers', 'Издатель успешно удален');
    }

    public function addRules(Request $request){
        DB::table('rules')->insert(['name'=>$request->nameRules]);
        return redirect()->back()->with('messageAddRules', 'Правила игры успешно добавлены');
    }

    public function dellRules(Request $request){
        DB::table('rules')->where('id', '=', $request->id_rules)->delete();
        return redirect()->back()->with('messageDellRules', 'Правила игры успешно удалены');
    }

    public function addProduct(Request $request){
        $path = $request->file('image')->store('assets/img', 'public');
        $request->file('image')->move(public_path('assets/img/'), $path);

        DB::table('products')->insert([
            'name'=>$request->nameProduct,
            'about'=>$request->aboutProduct,
            'how_to_play'=>$request->howToPlayProduct,
            'inside_box'=>$request->insideBoxProduct,
            'id_genre'=>$request->id_genres,
            'id_time'=>$request->id_times,
            'id_publisher'=>$request->id_publishers,
            'id_rule'=>$request->id_rules,
            'image'=>$path,
        ]);
        return redirect()->back()->with('messageAddProduct', 'Игра успешно добавлена');
    }

    public function editProductView($id){
        $products = DB::table('products')->where('id', '=', $id)->first();
        $genres = DB::table('genres')->get();
        $times = DB::table('times')->get();
        $publishers = DB::table('publishers')->get();
        $rules = DB::table('rules')->get();
        return view('editProductView', compact('products', 'genres', 'times', 'publishers', 'rules'));
    }

    public function editProduct($id, Request $request){
        DB::table('products')->where('id', '=', $id)->update([
            'name'=>$request->name,
            'about'=>$request->about,
            'how_to_play'=>$request->how_to_play,
            'inside_box'=>$request->inside_box,
            'id_genre'=>$request->id_genre,
            'id_time'=>$request->id_time,
            'id_publisher'=>$request->id_publishers,
            'id_rule'=>$request->id_rules,
        ]);
        if(isset($request->image)){
            $img = $request->file('image');
            $typeImg = $img->extension();

            $uniqName = Str::random();
            $nameImg = $uniqName.'.'.$typeImg;
            $pathFolder = 'assets/img/';

            $img->move(public_path($pathFolder), $nameImg);

            DB::table('products')->where('id', '=', $id)->update([
                'image'=>$pathFolder . $nameImg
            ]);
        }
        return redirect()->back()->with('messageEditProduct', 'Игра успешно обновлена');
    }

    public function dellProduct(Request $request)
    {
        DB::table('products')->where('id','=',$request->id)->delete();
        return redirect()->back();
    }

    public function dellMessage(Request $request)
    {
        DB::table('chats')->where('id','=',$request->id)->delete();
        return redirect()->back()->with('messageDellMessage', 'Сообщение успешно удалено');
    }

    public function dellUser(Request $request)
    {
        DB::table('users')->where('id','=',$request->id)->delete();
        return redirect()->back()->with('messageDellUser', 'Пользователь успешно удален');
    }
}
