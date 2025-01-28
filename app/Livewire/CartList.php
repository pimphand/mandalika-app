<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartList extends Component
{
    public function render(): View|Factory|Application
    {
        return view('livewire.cart-list');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ConnectionException
     */
    public function checkout(): void
    {
        $cart = session()->get('cart');
        $data = [];
        foreach ($cart as $item) {
            $data[] = [
                'product_id' => $item['id'],
                'quantity' => $item['quantity']
            ];
        }
        $response = Http::withToken(session('token'))->post(config('app.api_url') . '/api/checkout', ['data' => $data]);
        $response = $response->json();
        if ($response['status'] == 'success') {
            session()->forget('cart');
            session()->flash('success', 'Checkout success');
        } else {
            session()->flash('error', 'Checkout failed');
        }
    }
}
