<x-app>
    <div class="container">
        <div class="card product-details-card mb-3">
            {{--            <span class="badge bg-warning text-dark position-absolute product-badge">Sale -10%</span> --}}
            <div class="card-body">
                <div class="product-gallery-wrapper">
                    <div class="product-gallery gallery-img">
                        <a href="{{ config('app.api_url') }}/storage/{{ $product['data']['image'] }}"
                            class="image-zooming-in-out" title="Product One" data-gall="gallery2">
                            <img class="image_{{ $product['data']['id'] }}"
                                src="{{ config('app.api_url') }}/storage/{{ $product['data']['image'] }}"
                                alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card product-details-card mb-3 direction-rtl">
            <div class="card-body">
                <h4 class="name_{{ $product['data']['id'] }}">{{ $product['data']['name'] }}</h4>
                <h4 class="brand_{{ $product['data']['id'] }}">{{ $product['data']['brand'] }}</h4>
                <h4 class="category_{{ $product['data']['id'] }}">{{ $product['data']['category'] }}</h4>

                <h5>Kemasan : <span
                        class="packagin_{{ $product['data']['id'] }}">{{ $product['data']['packaging'] }}</span>
                </h5>
                <div class="input-group">
                    <input class="input-group-text form-control value" type="number" value="1">
                    <button class="btn btn-primary w-50" onclick="addCartProduct('{{ $product['data']['id'] }}')"
                        id="_add_to_cart" type="button">Tambah</button>
                </div>
            </div>
        </div>

        <div class="card product-details-card mb-3 direction-rtl">
            <div class="card-body">
                <h5>Description</h5>
                <p style="text-align: justify">{{ $product['data']['description'] }}</p>
            </div>
        </div>

        <div class="card related-product-card direction-rtl">
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
                                    <a class="product-title d-block text-truncate"
                                        href="{{ route('product', $recomended['id']) }}">{{ $recomended['name'] }}</a>
                                    <!-- Product Price -->
                                    <p class="sale-price">{{ $recomended['brand'] }}</p>
                                    <p class="sale-price">{{ $recomended['category'] }}</p>
                                    <p class="sale-price">{{ $recomended['packaging'] }}</p>

                                    <a class="btn btn-danger btn-sm" href="#">Tambah</a>
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
