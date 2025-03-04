<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ListOrder extends Component
{

    public string $customer = '';
    public string $product = '';
    public string $ids = '';
    public string $status = '';

    public bool $form = false;
    protected $listeners = ['changeStatus','setRetur'];
    public function render(): View|Factory|Application
    {
        $orders = Http::withToken(session('token'))->get(config('app.api_url')
            . '/api/orders?customer=' . $this->customer
            . '&product=' . $this->product
            . '&status=' . $this->status
            . '&id=' . $this->ids);
        $orders = $orders->json();
        return view('livewire.list-order', ['orders' => $orders]);
    }

    public function changeFrom(): void
    {
        $this->form = !$this->form ? true : false;
    }
}
