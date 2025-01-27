<x-app>

    <!-- Welcome Toast -->
    <div class="toast toast-autohide custom-toast-1 toast-primary home-page-toast shadow" role="alert" aria-live="assertive" aria-atomic="true"
         data-bs-delay="60000" data-bs-autohide="true" id="installWrap">
        <div class="toast-body p-4">
            <div class="toast-text me-2">
                <h6 class="text-white">Welcome to {{env('APP_NAME')}}!</h6>
                <span class="d-block mb-2">Click the <strong>Install Now</strong> button & enjoy it just like an
            app.</span>
                <button id="install{{env('APP_NAME')}}" class="btn btn-sm btn-warning">Install Now</button>
            </div>
        </div>
        <button class="btn btn-close btn-close-white position-absolute p-2" type="button" data-bs-dismiss="toast"
                aria-label="Close"></button>
    </div>

    <!-- Tiny Slider One Wrapper -->
    <div class="tiny-slider-one-wrapper">
        <div class="tiny-slider-one">
            <!-- Single Hero Slide -->
            @foreach($data as $banner)
                <div>
                    <div class="single-hero-slide bg-overlay" style="background-image: url({{config('app.api_url')}}/{{$banner['image']['path']}})">
                        <div class="h-100 d-flex align-items-center text-center">
                            <div class="container">
                                <h3 class="text-white mb-1">{{$banner['title']}}</h3>
                                <p class="text-white mb-4">{{$banner['description']}}</p>
                                @if($banner['url'])
                                    <a class="btn btn-creative btn-warning" href="{{$banner['url']}}">Lebih Detail</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="pt-3"></div>

    <div class="container direction-rtl">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-3">
                        <div class="feature-card mx-auto text-center">
                            <div class="card mx-auto bg-gray">
                                <img src="{{asset('assets')}}/img/demo-img/pwa.png" alt="">
                            </div>
                            <p class="mb-0">Produk</p>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="feature-card mx-auto text-center">
                            <div class="card mx-auto bg-gray">
                                <img src="{{asset('assets')}}/img/demo-img/pwa.png" alt="">
                            </div>
                            <p class="mb-0">Customer</p>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="feature-card mx-auto text-center">
                            <div class="card mx-auto bg-gray">
                                <img src="{{asset('assets')}}/img/demo-img/bootstrap.png" alt="">
                            </div>
                            <p class="mb-0">Omset</p>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="feature-card mx-auto text-center">
                            <div class="card mx-auto bg-gray">
                                <img src="{{asset('assets')}}/img/demo-img/js.png" alt="">
                            </div>
                            <p class="mb-0">Compro</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tiny Slider Three -->
    <div class="page-content-wrapper">
        <!-- Pagination -->
        <div class="shop-pagination pb-3">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <small class="ms-1">Paling Laku Minggu Ini</small>
                            <a class="btn btn-info btn-sm">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Products -->
        <div class="top-products-area">
            <div class="container">
                <div class="row g-3">

                    @foreach($products as $product)

                        <div class="col-6 col-sm-4 col-lg-3">
                            <div class="card single-product-card">
                                <div class="card-body p-3">
                                    <!-- Product Thumbnail -->
                                    <a class="product-thumbnail d-block" href="{{route('product',$product['id'])}}">
                                        <img src="{{config('app.api_url')}}/storage/{{$product['image']}}" alt="">
                                        <!-- Badge -->
                                    <!-- Product Title -->
                                    <a class="product-title d-block text-truncate" href="{{route('product',$product['id'])}}">{{$product['name']}}</a>
                                    <!-- Product Price -->
                                    <p class="sale-price">{{$product['brand']}}</p>
                                    <p class="sale-price">{{$product['category']}}</p>
                                    <a class="btn btn-danger rounded-pill btn-sm disabled" href="#">Tambah</a>
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

