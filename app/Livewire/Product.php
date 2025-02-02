<?php

namespace App\Livewire;

use App\Models\Sku;
use Livewire\Component;

class Product extends Component
{
    public $search = '';
    public function render()
    {
        $products = Sku::with(['image', 'product'])->whereAny(['name', 'description'], 'LIKE', "%$this->search%")->inRandomOrder()->limit(8)->get();
        // dd($products);
        return view('livewire.product', ['products' => $products]);
    }
}
