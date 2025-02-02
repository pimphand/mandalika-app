<x-app>
    @livewireStyles
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
    </style>
    <div class="pt-3"></div>

    <livewire:product />

</x-app>
