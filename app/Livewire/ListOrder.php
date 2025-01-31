<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ListOrder extends Component
{

    public string $customer = '';
    public string $product = '';
    public string $id = '';
    public string $status = '';


    public function render()
    {
        $orders = Http::withToken(session('token'))->get(config('app.api_url')
            . '/api/orders?customer=' . $this->customer
            . '&product=' . $this->product
            . '&status=' . $this->status
            . '&id=' . $this->id);
        $orders = $orders->json();
        return view('livewire.list-order', ['orders' => $orders]);
    }
}
