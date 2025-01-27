<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    function home()
    {
        $get = Http::get(config('app.api_url') . '/api/banners');
        $data = $get->json();
        $getProduct = Http::withToken(session('token'))->get(config('app.api_url') . '/api/products');
        $products = $getProduct->json()['data'];

        return view('home', compact('data', 'products'));
    }

    public function products(Request $request)
    {

    }

    public function product($id): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $get = Http::withToken(session('token'))->get(config('app.api_url') . '/api/products/' . $id);
        $data = $get->json();
//        dd($data);
        return view('product', ['product' => $data]);
    }

}
