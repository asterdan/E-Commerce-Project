<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Redirect;
use GuzzleHttp\Client;

class ProductController extends Controller
{
    //

    public function createProduct(Request $request)
    {
        $this->validate($request,[
            'title' =>'required',
            'body' => 'required',
            'price' => 'required',
            'picture' =>'image|nullable|max:1999'
        ]);
        
        if ($request->hasFile('picture'))
        {
            //Get filename with the extension
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            //Get just the filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get Just extension
            $extension = $request->file('picture')->getClientOriginalExtension();
            //Filename to store
            $filnameToStore = $filename . '_' .time().'.'.$extension;
            //Upload image
            $path = $request->file('picture')->storeAs('public/product_images',$filnameToStore);
            $product = new Product;
            $product->title = $request->input('title');
            $product->description = $request->input('body');
            $product->price = $request->input('price');
            $product->picture = $filnameToStore;
            $product->save();
        }
        else
        {
            $filenameToStore = 'noimage.jpg';
            $product = new Product;
            $product->title = $request->input('title');
            $product->description = $request->input('body');
            $product->picture = 'noimage.jpg';
            $product->price = $request->input('price');
            $product->save();
        }

        

        return Redirect::back();
    }

    public function detail(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);
        $client = new Client();
        $res = $client->request('GET','http://localhost:5000/api/v1/resources/productRating/',[
           'query'=>['id'=>$id]
        ]);
        return view('product_detail')->with('product',$product);
    }
}
