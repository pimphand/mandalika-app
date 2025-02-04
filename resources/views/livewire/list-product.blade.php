<div class="card">
    @forelse ($products->chunk(12) as $key => $chunk)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <div class="row">
                @foreach ($chunk as $product)
                    <div class="col-6 col-sm-6 col-lg-3">
                        <div class="card single-product-card">
                            <div class="card-body p-3">
                                <!-- Product Thumbnail -->
                                <a class="product-thumbnail d-block" href="{{ route('product', $product->id) }}">
                                    @if (!$product->image?->path)
                                        <img loading="lazy"class="_image_{{ $product->id }}"
                                            src="{{ asset('logo_.png') }}?t={{ time() }}"
                                            alt="{{ $product->name }}">
                                    @else
                                        <img loading="lazy"src="{{ config('app.api_url') }}/storage/{{ $product->image->path }}?t={{ time() }}"
                                            alt="{{ $product->name }}">
                                    @endif
                                </a>
                                <!-- Product Title -->
                                <a class="product-title d-block text-truncate _name_{{ $product->id }} name"
                                    href="{{ route('product', $product->id) }}">{{ $product->name }}</a>
                                <p class="product-title d-block text-truncate _brand_{{ $product->id }} brand">
                                    {{ $product->product->name }}</p>
                                <p class="_category_{{ $product->id }} category" style="display: none;">
                                    {{ $product->category }}</p>
                                <p class="_packagin_{{ $product->id }} packaging" style="display: none;">
                                    {{ $product->packaging }}</p>
                                <!-- Product Price -->
                                @auth
                                    <a class="btn btn-success rounded-pill btn-sm" style="background-color: #008e3c;"
                                        onclick="addCart('{{ $product->id }}')">Masukan Keranjang</a>
                                @else
                                    <a class="btn btn-success btn-sm saveToCart"
                                        data-katalog="{{ $product->product?->file }}" href="javascript:void(0)"
                                        style="background-color: #008e3c;">Masukan
                                        Keranjang
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="text-center py-4">
            <p class="text-muted">Produk tidak ditemukan.</p>
        </div>
    @endforelse

    <div class="mb-3"></div>

    {{ $products->links() }}
</div>
