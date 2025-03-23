<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Customer;
use App\Models\Sku;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    function home()
    {
        $get = Http::get(config('app.api_url') . '/api/banners');
        $data = $get->json();

        $getProduct = Http::get(config('app.api_url') . '/api/products?home=true');
        $products = $getProduct->json()['data'];

        $about = About::where('type', 'profile')->first();
        if ($about) {
            $about->content = json_decode($about->content);
        } else {
            $about = [];
        }

        return view('home', compact('data', 'products', 'about'));
    }

    public function products(Request $request)
    {
        return view('products');
    }

    public function productsData(Request $request)
    {
        $products = Sku::with(['image', 'product'])
            ->whereAny(['name', 'description'], 'LIKE', "%$request->search%")
            // ->orWhereHas('product', function ($query) use ($request) {
            //     $query->where('name', 'LIKE', "%$request->search%");
            // })
            ->when($request->category, function ($query) use ($request) {
                $query->whereHas("product", function ($query) use ($request) {
                    $query->where('name', $request->category);
                });
            })
            ->inRandomOrder()
            ->paginate(12);

        return view('livewire.list-product', ['products' => $products]);
    }

    public function product($id): Application|Factory|View
    {
        $get = Http::get(config('app.api_url') . '/api/products/' . $id);
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

    public function customerData(Request $request): JsonResponse
    {
        $data = Customer::whereAny(['name', 'email', 'address', 'owner_address'], 'LIKE', "%$request->search%")->get();
        return response()->json($data);
    }

    public function saveCustomer(Request $request) //: \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
//            'owner_address' => 'required',
            'store_name' => 'required',
            'npwp' => 'nullable',
            'others' => 'nullable',
            'store_photo' => 'required|image',
            'owner_photo' => 'required|image',
            'city' => 'required',
            'state' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi',
            'phone.required' => 'Nomor telepon wajib diisi',
            'phone.numeric' => 'Nomor telepon harus berupa angka',
            'address.required' => 'Alamat wajib diisi',
//            'owner_address.required' => 'Alamat pemilik wajib diisi',
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
                'city' => $request->input('city'),
                'state' => $request->input('state'),
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

    public function listOrders(Request $request): View|Factory|Application
    {
        return view('orders');
    }

    public function acccount(Request $request): View|Factory|Application
    {
        return view('person');
    }

    public function updateOrder(Request $request, $id): JsonResponse
    {
        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('orders-/file', 'public'); // Stores in storage/app/public/orders/file
            $fileName = asset('storage/' . $filePath); // Generates a public URL
        }

        $get = Http::withToken(session('token'))
            ->acceptJson()
            ->put(config('app.api_url') . '/api/orders/' . $id, array_merge($request->except('file'), ['file' => $fileName]));


        if ($get->status() == 200) {
            return response()->json(['message' => 'Berhasil mengubah order']);
        }else{
            return response()->json($get->json(), 422);
        }

    }
}
