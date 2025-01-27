<x-app>
    <div class="container">
        <div class="card product-details-card mb-3">
{{--            <span class="badge bg-warning text-dark position-absolute product-badge">Sale -10%</span>--}}
            <div class="card-body">
                <div class="product-gallery-wrapper">
                    <div class="product-gallery gallery-img">
                        <a href="{{config('app.api_url')}}/storage/{{$product['data']['image']}}" class="image-zooming-in-out" title="Product One"
                           data-gall="gallery2">
                            <img class="" src="{{config('app.api_url')}}/storage/{{$product['data']['image']}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card product-details-card mb-3 direction-rtl">
            <div class="card-body">
                <h3>{{$product['data']['name']}}</h3>
                <h1>{{$product['data']['brand']}}</h1>
                <h3>{{$product['data']['category']}}</h3>
                <form action="#">
                    <h5>Kemasan : {{$product['data']['packaging']}}</h5>
                    <div class="input-group">
                        <input class="input-group-text form-control" type="number" value="1">
                        <button class="btn btn-primary w-50" type="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card product-details-card mb-3 direction-rtl">
            <div class="card-body">
                <h5>Description</h5>
                <p style="text-align: justify">{{$product['data']['description']}}</p>
            </div>
        </div>

        <div class="card related-product-card direction-rtl">
            <div class="card-body">
                <h5 class="mb-3">Related Products</h5>

                <div class="row g-3">
                    <!-- Single Top Product Card -->
                    @foreach($product['recomended'] as $recomended)
                        <div class="col-6 col-sm-4 col-lg-3">
                            <div class="card single-product-card border">
                                <div class="card-body p-3">
                                    <!-- Product Thumbnail -->
                                    <a class="product-thumbnail d-block" href="{{route('product',$recomended['id'])}}">
                                        <img src="{{config('app.api_url')}}/storage/{{$recomended['image']}}" alt="">
                                        <!-- Badge -->
                                    </a>
                                    <!-- Product Title -->
                                    <a class="product-title d-block text-truncate" href="{{route('product',$recomended['id'])}}">{{$recomended['name']}}</a>
                                    <!-- Product Price -->
                                    <p class="sale-price">{{$recomended['brand']}}</p>
                                    <p class="sale-price">{{$recomended['category']}}</p>
                                    <a class="btn btn-danger btn-sm" href="#">Tambah</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app>
