<div>

    <div class="container">
        <div class="card mb-2">
            <div class="card-body p-3">
                <div class="form-group mb-0">
                    <input class="form-control form-control-clicked" type="text" wire:model="search"
                        placeholder="Cari produk">
                </div>
            </div>
        </div>

        <!-- Carousel -->
        <div id="productCarousel" class="carousel slide flex-d" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($products->chunk(6) as $key => $chunk)
                    <!-- Mengelompokkan setiap slide -->
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
                                            <a class="product-title d-block text-truncate _name_{{ $product->id }}"
                                                href="{{ route('product', $product->id) }}">{{ $product->name }}</a>
                                            <p class="product-title d-block text-truncate _brand_{{ $product->id }}">
                                                {{ $product->product->name }}</p>
                                            <p class="_category_{{ $product->id }}" style="display: none;">
                                                {{ $product->category }}</p>
                                            <p class="_packagin_{{ $product->id }}" style="display: none;">
                                                {{ $product->packaging }}</p>
                                            <!-- Product Price -->
                                            @auth
                                                <a class="btn btn-success rounded-pill btn-sm"
                                                    style="background-color: #008e3c;"
                                                    onclick="addCart('{{ $product->id }}')">Tambah Keranjang</a>
                                            @else
                                                <a class="btn btn-success rounded-pill btn-sm"
                                                    style="background-color: #008e3c;">Tambah Keranjang</a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach


            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    </div>

</div>
