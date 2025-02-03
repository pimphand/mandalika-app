<x-app>
    <div class="container">
        <div class="card product-details-card mb-3">
            {{--            <span class="badge bg-warning text-dark position-absolute product-badge">Sale -10%</span> --}}
            <div class="card-body">
                <div class="product-gallery-wrapper">
                    <div class="product-gallery gallery-img">
                        <a href="{{ config('app.api_url') }}/storage/{{ $product['data']['image'] }}"
                            class="image-zooming-in-out" title="Product One" data-gall="gallery2">
                            @if ($product['data']['image'])
                                <img class="image_{{ $product['data']['id'] }}"
                                    src="{{ config('app.api_url') }}/storage/{{ $product['data']['image'] }}"
                                    alt="">
                            @else
                                <img class="image_{{ $product['data']['id'] }}" src="{{ asset('logo_.webp') }}"
                                    alt="">
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card product-details-card mb-3 direction-rtl">
            <div class="card-body">
                <h6 class="name_{{ $product['data']['id'] }} name">{{ $product['data']['name'] }}</h6>
                <h6 class="brand_{{ $product['data']['id'] }} brand">{{ $product['data']['brand'] }}</h6>
                <p class="category_{{ $product['data']['id'] }} category">{{ $product['data']['category'] }} <br>
                    Kemasan : <span
                        class="packagin_{{ $product['data']['id'] }} packaging">{{ $product['data']['packaging'] }}</span>
                </p>
                <div class="input-group">
                    <input class="input-group-text form-control value" type="number" value="1">
                    @auth
                        <button class="btn btn-success w-50" onclick="addCartProduct('{{ $product['data']['id'] }}')"
                            style="background-color: #008e3c;" id="_add_to_cart" type="button">Tambah</button>
                    @else
                        <a class="btn btn-success btn-sm saveToCart" href="javascript:void(0)"
                            data-katalog="{{ $product['data']['file'] }}" style="background-color: #008e3c;">Masukan
                            Keranjang
                        </a>
                    @endauth

                </div>
            </div>
        </div>

        <div class="card product-details-card mb-3 direction-rtl">
            <div class="card-body">
                <h5>Description</h5>
                <p style="text-align: justify">{{ $product['data']['description'] }}</p>
            </div>
        </div>

        <div class="top-products-area">
            <div class="card-body">
                <h5 class="mb-3">Related Products</h5>

                <div class="row g-3">
                    <!-- Single Top Product Card -->
                    @foreach ($product['recomended'] as $recomended)
                        <div class="col-6 col-sm-4 col-lg-3">
                            <div class="card single-product-card border">
                                <div class="card-body p-3">
                                    <!-- Product Thumbnail -->
                                    <a class="product-thumbnail d-block"
                                        href="{{ route('product', $recomended['id']) }}">
                                        <img src="{{ config('app.api_url') }}/storage/{{ $recomended['image'] }}"
                                            alt="">
                                        <!-- Badge -->
                                    </a>
                                    <!-- Product Title -->
                                    <a class="product-title d-block text-truncate name"
                                        href="{{ route('product', $recomended['id']) }}">{{ $recomended['name'] }}</a>
                                    <!-- Product Price -->
                                    <p class="sale-price brand">{{ $recomended['brand'] }}</p>
                                    <p class="sale-price category">{{ $recomended['category'] }}</p>
                                    <p class="sale-price packaging">{{ $recomended['packaging'] }}</p>

                                    @auth
                                        <a class="btn btn-success btn-sm" href="#"
                                            style="background-color: #008e3c;font-size:10px;padding:5px">Masukan
                                            Keranjang</a>
                                    @else
                                        <a class="btn btn-success btn-sm saveToCart" href="javascript:void(0)"
                                            data-katalog="{{ $recomended['file'] }}"
                                            style="background-color: #008e3c;">Masukan Keranjang
                                        </a>
                                    @endauth

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            function addCartProduct(id) {

                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                let product = $(`.image_${id}`).attr('src');
                let name = $(`.name_${id}`).text();
                let brand = $(`.brand_${id}`).text();
                let category = $(`.category_${id}`).text();
                let packaging = $(`.packagin_${id}`).text();
                let qty = $('.value').val();
                let find = cart.find((item) => item.id == id);
                if (find) {
                    find.qty += 1;
                } else {
                    cart.push({
                        id,
                        image: product,
                        name,
                        brand,
                        category,
                        packaging,
                        qty
                    });
                }
                localStorage.setItem('cart', JSON.stringify(cart));
                localStorage.setItem('cart', JSON.stringify(cart));
                Toast.fire({
                    icon: "success",
                    title: "Berhasil menambahkan ke keranjang"
                });
                $('.bi-cart').text(cart.length ? cart.length : '');
            }
        </script>
    @endpush
</x-app>
