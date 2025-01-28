<x-app>
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
                                <th scope="col">Hapus</th>
                            </tr>
                            </thead>
                            <tbody id="list-cart">

                            </tbody>
                        </table>
                    </div>

                    <div class="card-body border-top">
                        <div class="apply-coupon">
                            <h6 class="mb-0">Pilih Customer</h6>
                            <!-- Coupon Form -->
                            <div class="coupon-form mt-2">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="form-control input-group-text text-start" type="text"
                                               placeholder="OFFER30">
                                        <button class="btn btn-primary" type="submit">Apply</button>
                                    </div>
                                </div>
                                <!-- Checkout -->
                                <button class="btn btn-danger w-100 mt-3" href="checkout.html">$38.89 &amp; Pay</button>
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
                    $.each(cart, function (index, value) {
                        $('#list-cart').append(`
                        <tr>
                            <td>
                                <img src="${value.image}" alt="${value.name}" style="width: 100px">
                            </td>
                            <td>
                                <h6>${value.name}</h6>
                                <p class="mb-0">${value.brand}</p>
                                <p class="mb-0">${value.category}</p>
                                <p class="mb-0">${value.packaging}</p>
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
        </script>
    @endpush
</x-app>
