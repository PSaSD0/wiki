<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        $results = DB::table('products')
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        return view('searchResults', [
            'results' => $results,
            'search' => $search
        ]);
    }
}
