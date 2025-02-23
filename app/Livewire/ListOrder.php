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
    public $statusUpdate = '';

    public string $retur = '';

    public function setRetur($value)
    {
        $this->retur = $value;
    }
    protected $listeners = ['changeStatus','setRetur'];
    public function render(): View|Factory|Application
    {
        $orders = Http::withToken(session('token'))->get(config('app.api_url')
            . '/api/orders?customer=' . $this->customer
            . '&product=' . $this->product
            . '&status=' . $this->status
            . '&id=' . $this->ids);
        $orders = $orders->json();
//        dd($orders);
        return view('livewire.list-order', ['orders' => $orders]);
    }

    public function changeStatus($id, $status)
    {
        $get = Http::withToken(session('token'))
            ->acceptJson()
            ->put(config('app.api_url') . '/api/orders/' . $id, [
                'status' => $status
            ]);
        if ($get->status() == 200) {
            session()->flash('success', 'Berhasil mengubah status order ' . $id);
        } else {
            session()->flash('error', 'Gagal mengubah status order ' . $id);
        }
    }
}
