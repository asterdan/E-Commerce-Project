<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class SearchController extends Controller
{
    //

    public function search(Request $request)
    {
        $title = $request->input('title');
        
        $products = Product::where('title','LIKE','%'.$title.'%')->get();
       
        $data = ([
            'products' => $products
        ]);

        return view('searchresult')->with('data',$data);
    }
}
