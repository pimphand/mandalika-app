<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Customer extends Component
{
    public string $search = '';
    public $isBlacklist;

    use WithPagination;



    protected $paginationTheme = 'bootstrap';

    public function resetFilters(): void
    {
        $this->reset(['isBlacklist', 'search']);
    }

    public function render()
    {
        $customers = \App\Models\Customer::withCount([
            'orders as order_pending' => function ($query) {
                $query->where('status', 'pending');
            },
            'orders as order_success' => function ($query) {
                $query->where('status', 'success');
            },
            'orders as order_cancel' => function ($query) {
                $query->where('status', 'cancel');
            },
            'orders as order_proses' => function ($query) {
                $query->where('status', 'proses');
            },
        ])
            ->when(!request()->routeIs('customer'), function ($query) {
                $query->whereNotLike('is_blacklist', 'blacklist');
            })
            ->whereAny(['name', 'address', 'owner_address', 'store_name'], 'LIKE', "%$this->search%");

        if (isset($this->isBlacklist)) {
            $customers->where('is_blacklist', $this->isBlacklist);
        }

        $customers = $customers->paginate(5);
        return view('livewire.customer', ['customers' => $customers]);
    }
}
