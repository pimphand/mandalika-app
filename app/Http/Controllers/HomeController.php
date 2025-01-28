<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
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

    public function product($id): Application|Factory|View
    {
        $get = Http::withToken(session('token'))->get(config('app.api_url') . '/api/products/' . $id);
        $data = $get->json();
        return view('product', ['product' => $data]);
    }

    public function cart(): View|Factory|Application
    {
        return view('cart');
    }

    public function customer(): View|Factory|Application
    {
        return view('customer');
    }

    public function customerData(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = Customer::whereAny(['name', 'email', 'address','owner_address'],'LIKE', "%$request->search%")->get();
        return response()->json($data);
    }
}
