<x-app>

    <!-- Tiny Slider One Wrapper -->
    <div class="tiny-slider-one-wrapper">
        <div class="tiny-slider-one">
            <!-- Single Hero Slide -->
            @foreach ($data as $banner)
                <div>
                    <div class="single-hero-slide"
                        style="background-image: url({{ config('app.api_url') }}/storage/{{ $banner['image']['path'] }})">
                        <div class="h-100 d-flex align-items-center text-center">
                            <div class="container">
                                {{-- <h3 class="text-white mb-1">{{ $banner['title'] }}</h3>
                            <p class="text-white mb-4">{{ $banner['description'] }}</p> --}}
                                @if ($banner['url'])
                                    <a class="btn btn-creative btn-warning" href="{{ $banner['url'] }}">Lebih Detail</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <div class="container direction-rtl">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3 justify-content-between">
                    <div class="col-3">
                        <a class="feature-card mx-auto text-center" href="{{ route('products') }}">
                            <div class="card mx-auto bg-gray">
                                <img loading="lazy" src="{{ asset('icon/ic_produk.png') }}" alt="">
                            </div>
                            <p class="mb-0">Produk</p>
                        </a>
                    </div>

                    <div class="col-3">
                        <a class="feature-card mx-auto text-center" href="{{ config('app.api_url') }}/blogs"
                            target="_blank">
                            <div class="card mx-auto bg-gray">
                                <img loading="lazy" src="{{ asset('icon/ic_artikel.png') }}" alt="">
                            </div>
                            <p class="mb-0">Artikel</p>
                        </a>
                    </div>

                    @auth
                        <div class="col-3">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img loading="lazy" src="{{ asset('icon/ic_omset.png') }}" alt="">
                                </div>
                                <p class="mb-0">Omset</p>
                            </div>
                        </div>
                    @endauth

                    @if($about)
                        <div class="col-3">
                            <a href="{{config('app.api_url')}}/storage/{{$about['data']['profile']}}" target="_blank" class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img loading="lazy" src="{{ asset('icon/iz_compro.png') }}" alt="">
                                </div>
                                <p class="mb-0">Compro</p>
                            </a>
                        </div>
                    @else
                        <div class="col-3">
                            <a href="" class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img loading="lazy" src="{{ asset('icon/iz_compro.png') }}" alt="">
                                </div>
                                <p class="mb-0">Compro</p>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Tiny Slider Three -->
    <div class="page-content-wrapper" style="margin-top: 20px;">
        <!-- Pagination -->
        <div class="shop-pagination pb-3">
            <div class="container">
                <div class="card" style="background-color: #e7f3ed;">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <small class="ms-1">Paling Laku Minggu Ini</small>
                            <a class="btn btn-info btn-sm" style="background-color: #008e3c;">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Products -->
        <div class="top-products-area">
            <div class="container">
                <div class="row g-3">

                    @foreach ($products as $product)
                        <div class="col-6 col-sm-4 col-lg-3">
                            <div class="card single-product-card">
                                <div class="card-body p-3">
                                    <!-- Product Thumbnail -->
                                    <a class="product-thumbnail d-block {{ $product['id'] }}"
                                        href="{{ route('product', $product['id']) }}">
                                        <img loading="lazy"class="_image_{{ $product['id'] }}"
                                            src="{{ config('app.api_url') }}/storage/{{ $product['image'] }}"
                                            alt="">
                                        <!-- Badge -->
                                        <!-- Product Title -->
                                        <a class="product-title d-block text-truncate _name_{{ $product['id'] }} name"
                                            href="{{ route('product', $product['id']) }}">{{ $product['name'] }}</a>
                                        <!-- Product Price -->
                                        <p class="sale-price _brand_{{ $product['id'] }} brand">
                                            {{ $product['brand'] }}</p>
                                        <p class="_category_{{ $product['id'] }} category">
                                            {{ $product['category'] }}</p>
                                        <p class="_packagin_{{ $product['id'] }} packaging">
                                            {{ $product['packaging'] }}</p>
                                        @auth
                                            <a class="btn btn-success btn-sm" href="javascript:void(0)"
                                                style="background-color: #008e3c;"
                                                onclick="addCart('{{ $product['id'] }}')">Masukan Keranjang
                                            </a>
                                        @else
                                            <a class="btn btn-success btn-sm saveToCart"
                                                data-katalog="{{ $product['file'] }}" href="javascript:void(0)"
                                                style="background-color: #008e3c;">Masukan Keranjang
                                            </a>
                                        @endauth
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="pt-3"></div>

    @push('js')
    @endpush
</x-app>
