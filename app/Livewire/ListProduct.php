<?php

namespace App\Livewire;

use App\Models\Sku;
use Livewire\Component;

class ListProduct extends Component
{
    public string $search = '';
    public function render()
    {


        return view('livewire.list-product', compact('products'));
    }
}
