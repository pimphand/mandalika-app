<x-app>
    <style>
        .customer.active {
            background-color: #007bff !important;
            /* Warna biru */
            color: #fff !important;
            /* Warna teks putih */
            border-radius: 5px;
        }
    </style>
    <div>
        <div class="pt-3"></div>

        <div class="container">
            <!-- Cart Wrapper -->
            <div class="cart-wrapper-area">
                <div class="cart-table card mb-3">
                    <div class="table-responsive card-body">
                        <table class="table mb-0 text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="list-cart">
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body border-top">
                        <div class="apply-coupon">
                            <h6 class="mb-0">Pilih Customer</h6>
                            <livewire:customer />
                            <!-- Coupon Form -->
                            {{--                            <div class="d-flex"> --}}
                            {{--                                <div class="form-check m-2"> --}}
                            {{--                                    <input class="form-check-input" value="process" type="radio" name="status" id="primaryRadio"> --}}
                            {{--                                    <label class="form-check-label" for="primaryRadio">Bayar</label> --}}
                            {{--                                </div> --}}

                            {{--                                <div class="form-check m-2"> --}}
                            {{--                                    <input class="form-check-input" value="pending" checked type="radio" name="status" id="lightRadio"> --}}
                            {{--                                    <label class="form-check-label" for="lightRadio">Pending</label> --}}
                            {{--                                </div> --}}
                            {{--                            </div> --}}
                            <div class="coupon-form mt-2">
                                <!-- Checkout -->
                                <button class="btn btn-danger w-100 mt-3" id="save">Simpan</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            // Get cart from local storage
            getCart();

            function getCart() {
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                $('#list-cart').html('');
                if (cart.length > 0) {
                    $.each(cart, function(index, value) {
                        $('#list-cart').append(`
                        <tr>
                            <td>
                                <img loading="lazy"src="${value.image}" alt="${value.name}" style="width: 100px">
                            </td>
                            <td>
                                <h6>${value.name}</h6>
                                <p class="mb-0">${value.brand}</p>
                                <p class="mb-0">${value.category}</p>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input class="form-control" type="number" value="${value.qty}">
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-danger" onclick="removeCart(${index})">Remove</button>
                            </td>
                        </tr>
                    `);
                    });
                } else {
                    $('#list-cart').append(`
                    <tr>
                        <td colspan="4">Tidak Ada Data</td>
                    </tr>
                `);
                }
            }

            //click customer
            $(document).on('click', '.customer', function() {
                let id = $(this).data('id');
                console.log(id);

                // Hapus class 'active' dari semua elemen .customer
                $('.customer').removeClass('active');

                // Tambahkan class 'active' ke elemen yang diklik
                $(this).addClass('active');

                // Simpan id customer ke local storage
                localStorage.setItem('customer_id', id);
            });

            //click save
            $('#save').click(function(e) {
                e.preventDefault();
                //cart
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                if (cart.length > 0) {
                    let customer_id = localStorage.getItem('customer_id');
                    let status = $('input[name="status"]:checked').val();
                    let updatedCart = cart.map(item => ({
                        product_id: item.id, // Ubah id menjadi product_id
                        quantity: item.qty,
                    }));
                    let data = {
                        _token: '{{ csrf_token() }}',
                        customer_id: customer_id,
                        status: status,
                        items: updatedCart
                    };
                    $.post("{{ route('orders') }}", data, function(response) {

                        // Jika sukses, kosongkan keranjang
                        localStorage.removeItem('cart');
                        localStorage.removeItem('customer_id');
                        getCart();
                        Swal.fire({
                            title: "Pesanan Berhasil Disimpan",
                            icon: "success",
                            draggable: true
                        });
                    }).fail(function(xhr, status, error) {
                        let xhrJSON = xhr.responseJSON;
                        Swal.fire({
                            title: xhrJSON.message.customer_id,
                            icon: "error",
                            draggable: true
                        });
                    });
                } else {
                    Swal.fire({
                        title: "Keranjang Tidak Kosong",
                        icon: "error",
                        draggable: true
                    });
                }
            })

            $('#filter_customer').remove();
        </script>
    @endpush
</x-app>
