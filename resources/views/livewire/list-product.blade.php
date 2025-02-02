<div>

    <div class="container">
        <div class="card mb-2">
            <div class="card-body p-3">
                <div class="form-group mb-0 position-relative">
                    <input class="form-control form-control-clicked" wire:model.live.debounce.500ms="search" type="text"
                        placeholder="Cari Produk" wire:loading.attr="disabled">
                    <div wire:loading
                        class="spinner-border text-primary position-absolute top-50 end-0 translate-middle-y me-3"
                        role="status" style="width: 1.5rem; height: 1.5rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel -->
        <div id="productCarousel" class="carousel slide flex-d" data-bs-ride="carousel">
            <div class="carousel-inner">
                @forelse ($products->chunk(6) as $key => $chunk)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-6 g-3">
                            @foreach ($chunk as $product)
                                <div class="col">
                                    <div class="card single-product-card">
                                        <div class="card-body p-3">
                                            <!-- Product Thumbnail -->
                                            <a class="product-thumbnail d-block"
                                                href="{{ route('product', $product->id) }}">
                                                @if (!$product->image?->path)
                                                    <img class="_image_{{ $product->id }}"
                                                        src="{{ asset('assets/img/demo-img/funto.png') }}"
                                                        alt="{{ $product->name }}">
                                                @else
                                                    <img src="{{ config('app.api_url') }}/storage/{{ $product->image->path }}"
                                                        alt="{{ $product->name }}">
                                                @endif
                                            </a>
                                            <!-- Product Title -->
                                            <a class="product-title d-block text-truncate _name_{{ $product->id }} name"
                                                href="{{ route('product', $product->id) }}">{{ $product->name }}</a>
                                            <p
                                                class="product-title d-block text-truncate _brand_{{ $product->id }} brand">
                                                {{ $product->product->name }}</p>
                                            <p class="_category_{{ $product->id }} category" style="display: none;">
                                                {{ $product->category }}</p>
                                            <p class="_packagin_{{ $product->id }} packaging" style="display: none;">
                                                {{ $product->packaging }}</p>
                                            <!-- Product Price -->

                                            @auth
                                                <a class="btn btn-success rounded-pill btn-sm"
                                                    style="background-color: #008e3c;"
                                                    onclick="addCart('{{ $product->id }}')">Masukan Keranjang</a>
                                            @else
                                                <a class="btn btn-success btn-sm saveToCart" href="javascript:void(0)"
                                                    style="background-color: #008e3c;">Masukan Keranjang
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
            </div>
        </div>

    </div>

</div>
