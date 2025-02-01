<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ListOrder extends Component
{

    public string $customer = '';
    public string $product = '';
    public string $ids = '';
    public string $status = '';
    public $statusUpdate = '';
    protected $listeners = ['changeStatus'];
    public function render()
    {
        $orders = Http::withToken(session('token'))->get(config('app.api_url')
            . '/api/orders?customer=' . $this->customer
            . '&product=' . $this->product
            . '&status=' . $this->status
            . '&id=' . $this->ids);
        $orders = $orders->json();
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
