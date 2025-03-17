<x-app>
    <style>
        .status-btn.active {
            border: 2px solid #fff;
            opacity: 0.8;
        }
    </style>
    <div class="pt-3"></div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <input class="form-control form-control-clicked" id="search" type="text"
                                placeholder="Cari Customer">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    @if (session('role') == 'sales')
                        <span style="color: #fff;" data-bs-toggle="tooltip" data-bs-placement="right"
                            data-bs-original-title="Orderan yg baru di ajukan oleh sales namun blm di approve oleh admin"
                            class="btn mb-1 badge bg-primary status-btn" data-type="pending">Pending</span>
                    @endif
                    <span style="color: #fff;" data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-original-title="Orderan yg telah di approve oleh admin dan akan di kirimkan ke toko"
                        class="btn mb-1 badge bg-warning status-btn" data-type="process">Proses</span>

                    <span style="color: #fff;" data-bs-placement="right"
                        data-bs-original-title="Orderan yg telah berhasil terkirim ke toko (barang telah sampai ke Costumer) pada tahap orderan sukses disini akan tercantum harga beserta total penjualan nya"
                        class="btn mb-1 badge bg-success status-btn" data-type="success">Sukses</span>
                    <span style="color: #fff;" data-type="cancel"
                        class="btn mb-1 badge bg-danger status-btn">Batal</span>
                </div>

                <div id="order"></div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            getData()

            function getData(customer = '', status = '') {
                $.get(`{{ route('orderData') }}?customer=${customer}&status=${status}`, function(data) {
                    $('#order').html(data);
                });
            }

            $(document).on('click', '.status-btn', function() {
                $('.status-btn').removeClass('active');
                $(this).addClass('active');
                getData($('#search').val(), $(this).data('type'));
            });

            $(document).on('keyup', '#search', function() {
                getData($(this).val(), $('.status-btn.active').data('type'));
            });
        </script>
    @endpush
</x-app>
