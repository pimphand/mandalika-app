<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Customer extends Component
{
    public string $search = '';
    public $isBlacklist;
    public $route;
    use WithPagination;



    protected $paginationTheme = 'bootstrap';

    public function resetFilters(): void
    {
        $this->reset(['isBlacklist', 'search']);
    }

    public function render()
    {
        $customers = \App\Models\Customer::query()
            ->when(!request()->routeIs('customer'), function ($query) {
                $query->whereNotLike('is_blacklist', 'blacklist');
            })
            ->whereAny(['name', 'address', 'owner_address', 'store_name'], 'LIKE', "%$this->search%");

        if (isset($this->isBlacklist)) {
            $customers->where('is_blacklist', $this->isBlacklist);
        } else {
            $customers->whereUserId(auth()->id()); // filter by current user
        }

        $customers = $customers->paginate(7);
        return view('livewire.customer', ['customers' => $customers]);
    }
}
