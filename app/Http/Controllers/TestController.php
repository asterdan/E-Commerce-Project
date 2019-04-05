<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TestController extends Controller
{
    //

    public function test(Request $request)
    {
        
        
            $title = $request->title;
            $body = $request->body;
            $data = ([
                'title' =>$title,
                'body' =>$body,
            ]);
            return  view('test')->with('data',$data);
    }
}
