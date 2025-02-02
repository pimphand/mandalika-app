<?php

namespace App\Livewire;

use App\Models\Sku;
use Livewire\Component;

class Product extends Component
{
    public string $cariData = '';
    public function render()
    {
        $products = Sku::with(['image', 'product'])->whereAny(['name', 'description'], 'LIKE', "%$this->cariData%")->inRandomOrder()->limit(8)->get();
        // dd($products);
        return view('livewire.product', ['products' => $products]);
    }
}
