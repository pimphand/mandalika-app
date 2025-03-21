<x-app>
    <style>
        .single-product-card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .single-product-card .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .product-thumbnail img {
            width: 100%;
            height: 150px;
            /* Sesuaikan ukuran */
            object-fit: cover;
        }


        .sale-price {
            text-align: center;
        }

        .btn {
            width: 100%;
        }

        /* Pastikan carousel hanya 1 baris */
        .carousel-inner .row {
            flex-wrap: nowrap;
            /* Jangan biarkan membungkus ke baris kedua */
            overflow-x: auto;
        }

        .single-product-card {
            flex: 1 1 auto;
            /* Semua elemen mengambil ruang sama */
            max-width: 100%;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .product-thumbnail img {
            height: 150px;
            /* Tinggi konsisten */
            object-fit: cover;
            width: 100%;
        }

        .product-title {
            text-align: center;
            font-size: 12px;
        }

        .sale-price {
            text-align: center;
        }

        /* Animasi saat hover */
        .category-item {
            display: block;
            text-align: center;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
        }

        .category-item:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Efek saat aktif */
        .category-item.aktif {
            background-color: #008e3c !important;
        }

        .category-item.aktif p {
            color: #fff !important;
        }

        .swiper-container {
            width: 100%;
            overflow: hidden;
            padding: 10px 0;
        }

        .swiper-slide {
            text-align: center;
            width: auto;
        }
    </style>
    <div class="pt-3"></div>

    <div>

        <div class="container">
            <div class="card mb-2">
                <div class="card-body p-3">
                    <div class="form-group mb-0 position-relative">
                        <input class="form-control form-control-clicked" id="search" type="text"
                            placeholder="Cari Produk" wire:loading.attr="disabled">
                        <div id="loadingSpinner"
                            class="spinner-border text-primary position-absolute top-50 end-0 translate-middle-y me-3"
                            role="status" style="width: 1.5rem; height: 1.5rem; display: none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $brands = \Illuminate\Support\Facades\DB::table('brands')->get();
            @endphp
            <!-- User Status Slide -->

            <div class="swiper-container flex">
                <div class="swiper-wrapper">
                    @foreach ($brands as $brand)
                        <div class="swiper-slide">
                            <a href="#" class="category-item" data-category="{{ $brand->name }}">
                                <img loading="lazy" src="{{ config('app.api_url') }}/storage/{{ $brand->logo }}?t={{ time() }}"
                                    alt="">
                                <p class="mb-2 mt-1 text-truncate title" style="color: #000;">{{ $brand->name }}</p>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>

            <!-- Carousel -->
            <div id="dataProduct" class="mt-3 mb-3"></div>

        </div>


    </div>

    @push('js')
        <!-- Tambahkan Swiper.js CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

        <script>
            function getData(category = null, page = 1) {
                $("#loadingSpinner").show(); // Tampilkan spinner sebelum AJAX request

                $.ajax({
                    type: "get",
                    url: "{{ route('productsData') }}",
                    data: {
                        search: $("#search").val(),
                        category: category,
                        page: page
                    },
                    success: function(response) {
                        $("#dataProduct").html(response);
                    },
                    complete: function() {
                        $("#loadingSpinner").hide(); // Sembunyikan spinner setelah AJAX selesai
                    }
                });
            }

            $(document).ready(function() {
                getData();
            });

            $("#search").on("keyup", function() {
                getData();
            });

            $(document).ready(function() {
                $(".category-item").on("click", function(e) {
                    e.preventDefault(); // Mencegah navigasi default jika href="#"
                    $(".category-item").removeClass("aktif"); // Hapus class aktif dari semua item
                    $(this).addClass("aktif"); // Tambahkan class aktif ke elemen yang diklik

                    //ganti warna font menjadi putih
                    $(".category-item").css("color", "#000");
                    $(this).css("color", "#fff");
                });

                $(".category-item").on("click", function() {
                    let category = $(this).data("category");
                    getData(category);
                });
            });

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault(); // Cegah halaman reload
                var page = $(this).data('page'); // Ambil nomor halaman
                var category = $("#category").val(); // Ambil nilai kategori jika diperlukan
                getData(category, page); // Panggil fungsi getData dengan parameter halaman
            });


            document.addEventListener("DOMContentLoaded", function() {
                var swiper = new Swiper(".swiper-container", {
                    slidesPerView: 4, // Menampilkan 4 kategori sekaligus
                    spaceBetween: 10,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    mousewheel: {
                        forceToAxis: true, // Agar hanya scroll horizontal, bukan vertikal
                        sensitivity: 1,
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 4
                        }, // Di layar besar, tampilkan 4 kategori
                        480: {
                            slidesPerView: 2
                        } // Di layar kecil, tampilkan 2 kategori
                    }
                });
            });
        </script>
    @endpush

</x-app>
