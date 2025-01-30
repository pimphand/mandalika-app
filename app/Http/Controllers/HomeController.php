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

    public function products(Request $request) {}

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
        $data = Customer::whereAny(['name', 'email', 'address', 'owner_address'], 'LIKE', "%$request->search%")->get();
        return response()->json($data);
    }

    public function saveCustomer(Request $request) //: \Illuminate\Http\JsonResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'owner_address' => 'required',
            'store_name' => 'required',
            'npwp' => 'nullable',
            'others' => 'nullable',
            'store_photo' => 'required|image',
            'owner_photo' => 'required|image',
        ], [
            'name.required' => 'Nama wajib diisi',
            'phone.required' => 'Nomor telepon wajib diisi',
            'phone.numeric' => 'Nomor telepon harus berupa angka',
            'address.required' => 'Alamat wajib diisi',
            'owner_address.required' => 'Alamat pemilik wajib diisi',
            'store_name.required' => 'Nama toko wajib diisi',
            'store_photo.required' => 'Foto toko wajib diisi',
            'store_photo.image' => 'Foto toko harus berupa gambar',
            'owner_photo.required' => 'Foto pemilik wajib diisi',
            'owner_photo.image' => 'Foto pemilik harus berupa gambar',
            'npwp.nullable' => 'NPWP harus berupa angka',
        ]);

        $post = Http::withToken(session("token"))
            ->acceptJson()
            ->attach('store_photo', file_get_contents($request->file('store_photo')), 'store_photo.jpg')
            ->attach('owner_photo', file_get_contents($request->file('owner_photo')), 'owner_photo.jpg')
            ->post(config('app.api_url') . "/api/customers", [
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'owner_address' => $request->input('owner_address'),
                'store_name' => $request->input('store_name'),
                'npwp' => $request->input('npwp'),
                'others' => $request->input('others'),
            ]);

        $data = $post->json();
        return response()->json($data, $post->status());
    }

    public function orders(Request $request)
    {
        try {
            $get = Http::withToken(session('token'))
                ->acceptJson()
                ->post(config('app.api_url') . '/api/orders', $request->all());
            //get response code
            $response = $get->status();
            //check if response code is 201
            if ($response == 200) {
                return response()->json(['message' => 'Pesanan berhasil dibuat']);
            }
            return response()->json($get->json(), 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
