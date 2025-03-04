<div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <input class="form-control form-control-clicked" wire:model.live.debounce.300ms="customer"
                                   type="text" placeholder="Cari Customer">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    @if(session('role') == 'sales')
                        <span wire:click="$set('status', 'pending')" style="color: #fff;" data-bs-toggle="tooltip"
                              data-bs-placement="right"
                              data-bs-original-title="Orderan yg baru di ajukan oleh sales namun blm di approve oleh admin"
                              class="btn mb-1 badge bg-primary status-btn" onclick="setActive(this)">Pending</span>
                    @endif
                    <span wire:click="$set('status', 'process')" style="color: #fff;" data-bs-toggle="tooltip"
                          data-bs-placement="right"
                          data-bs-original-title="Orderan yg telah di approve oleh admin dan akan di kirimkan ke toko"
                          class="btn mb-1 badge bg-warning status-btn" onclick="setActive(this)">Proses</span>

                    <span wire:click="$set('status', 'success')" style="color: #fff;" data-bs-placement="right"
                          data-bs-original-title="Orderan yg telah berhasil terkirim ke toko (barang telah sampai ke Costumer) pada tahap orderan sukses disini akan tercantum harga beserta total penjualan nya"
                          class="btn mb-1 badge bg-success status-btn" onclick="setActive(this)">Sukses</span>
                    <span wire:click="$set('status', 'cancel')" style="color: #fff;"
                          class="btn mb-1 badge bg-danger status-btn" onclick="setActive(this)">Batal</span>

                </div>
                <div class="accordion accordion-style-five" id="accordionStyle5">
                    <!-- Single Accordion -->
                    @php
                        $status = [
                            'pending' => 'primary',
                            'process' => 'warning',
                            'success' => 'success',
                            'cancel' => 'danger',
                            'done' => 'success',
                        ];

                        $statusId = [
                            'pending' => 'Pending',
                            'process' => 'Proses',
                            'success' => 'Selesai',
                            'cancel' => 'Batal',
                            'done' => 'Selesai',
                        ];
                    @endphp
                    {{-- session --}}
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('error') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    @forelse ($orders['data'] as $order)
                        <div class="accordion-item accordion-bg-{{ $status[$order['status']] }}">
                            <div class="accordion-header" id="{{ $order['id'] }}">
                                <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleFive{{ $order['id'] }}"
                                    aria-expanded="false" aria-controls="accordionStyleFive{{ $order['id'] }}"
                                    class="collapsed">
                                    <i class="bi bi-plus-lg"></i> {{ $order['id'] }} -
                                    {{ $order['customer']['store_name'] }}
                                </h6>
                                <div class="accordion-collapse collapse" id="accordionStyleFive{{ $order['id'] }}"
                                     aria-labelledby="{{ $order['id'] }}" data-bs-parent="#accordionStyle5"
                                     style="">
                                    <table class="table table-bordered ">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <p style="font-size: 13px" class="text-start mb-0">Toko </p>
                                            </td>
                                            <td>
                                                <p style="font-size: 13px" class="text-end mb-0">
                                                    {{$order['customer']['store_name']}} -
                                                    ({{ $order['customer']['name'] }})</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="font-size: 13px" class="text-start mb-0">Tanggal Order </p>
                                            </td>
                                            <td>
                                                <p style="font-size: 13px"
                                                   class="text-end mb-0"> {{ date('d M Y', strtotime($order['created_at'])) }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="font-size: 13px" class="text-start mb-0">Alamat </p>
                                            </td>
                                            <td>
                                                <p style="font-size: 13px"
                                                   class="text-end mb-0"> {{ $order['customer']['address'] }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="font-size: 13px" class="text-start mb-0">Telp </p>
                                            </td>
                                            <td>
                                                <p style="font-size: 13px"
                                                   class="text-end mb-0"> {{ $order['customer']['phone'] }}</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="p-3 mb-2 bg-{{ $status[$order['status']] }} text-white rounded">Status
                                        : {{ $statusId[$order['status']] }}</div>

                                    <div class="table-responsive mt-1">
                                        <table class="table table-bordered ">
                                            <thead>
                                            <tr>
                                                <th>Produk</th>
                                                <th>Kemasan</th>
                                                <th>Qty</th>
                                                <th>Qty Terkirim</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($order['order_items'] as $order_detail)
                                                <tr>
                                                    <td width="70%">
                                                        {{ $order_detail['sku']['name'] }} -
                                                        {{ $order_detail['sku']['product']['name'] }}
                                                    </td>
                                                    <td width="10%">{{ $order_detail['sku']['packaging'] }}</td>
                                                    <td width="10%">{{ $order_detail['quantity'] }}</td>
                                                    <td width="10%">{{ $order_detail['quantity'] }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <h6>Detail Pengiriman</h6>
                                        <table class="table table-bordered mt-1 ">
                                            <thead>
                                            <tr>
                                                <th>Pengirim</th>
                                                <th>No Surat Jalan</th>
                                                <th>Tanggal Pengiriman</th>
                                                <th>Bukti Pengiriman</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    {{$order['driver']['name']}}
                                                </td>
                                                <td>
                                                    {{$order['surat_jalan']}}
                                                </td>
                                                <td>
                                                    {{$order['date_delivery']}}
                                                </td>
                                                <td>
                                                    @if($order['bukti_pengiriman'])
                                                        <a href="{{ $order['bukti_pengiriman']}}"
                                                           target="_blank">Lihat Bukti Pengiriman</a>
                                                    @else
                                                        {{$order['bukti_pengiriman'] ?? 'Belum ada bukti pengiriman'}}
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="text-retur-{{$order['id']}}" style="display: none">
                                            <h6>Retur
                                                Pengiriman</h6>
                                            <form class="form-update-{{$order['id']}}" action="{{route('orders.update', $order['id'])}}" method="post">
                                                @csrf
                                                <table class="table table-bordered mt-1">
                                                    <thead>
                                                    <tr>
                                                        <th>Produk</th>
                                                        <th>Kemasan</th>
                                                        <th>Jumlah</th>
                                                        <th>Jumlah Returs</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($order['order_items'] as $update)
                                                        <tr>
                                                            <td width="40%">
                                                                {{ $update['sku']['name'] }} -
                                                                {{ $update['sku']['product']['name'] }}
                                                            </td>
                                                            <td width="10%">{{ $update['sku']['packaging'] }}</td>
                                                            <td width="20%">{{ $update['quantity'] }}</td>
                                                            <td width="30%">

                                                                <input hidden="" name="type" class="type-{{$order['id']}}">
                                                                <input class="form-control" name="quantity[]"
                                                                       type="number"
                                                                       value="0">
                                                                <input hidden="" class="form-control" name="id[]"
                                                                       type="text" value="{{ $update['id'] }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="catatan">
                                                        <td colspan="4">
                                                            <textarea class="form-control" name="note" id="note"
                                                                      placeholder="Catatan"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr class="file">
                                                        <td colspan="4">
                                                            <label>File</label>
                                                            <input class="form-control" type="file" name="file">
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>

                                        @if($statusId[$order['status']] == "Selesai")
                                            <span><strong>Catatan : `</strong> {{$order['note']}}</span>
                                        @else
                                            <button class="btn bg-primary btn-show text-white returBtn"
                                                    data-type="terkirim"
                                                    data-id="{{$order['id']}}">Proses
                                            </button>
                                            {{--button saveReturn--}}
                                            <button class="btn bg-primary btn-show text-white save"
                                                    data-id="{{$order['id']}}" id="save" style="display: none">Simpan
                                            </button>
                                            {{--button ubahJumlah--}}
                                            <button class="btn bg-danger btn-show text-white cancel"
                                                    data-id="{{$order['id']}}" style="display: none">Batal
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div>
                            <h6 class="text-center">Data tidak ditemukan</h6>
                        </div>
                    @endforelse

                </div>

                @if (count($orders['data']) >= 10)
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <!-- Previous Page Link -->
                                @if (!is_null($orders['links']['prev']))
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $orders['links']['prev'] }}"
                                           aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-hidden="true">&laquo;</span>
                                    </li>
                                @endif

                                <!-- Page Number Links -->
                                @foreach ($orders['meta']['links'] as $link)
                                    @if ($link['active'])
                                        <li class="page-item active" aria-current="page">
                                            <span class="page-link">{{ $link['label'] }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                <!-- Next Page Link -->
                                @if (!is_null($orders['links']['next']))
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $orders['links']['next'] }}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-hidden="true">&raquo;</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $(".returBtn").click(function () {
            let id = $(this).data('id');
            let type = $(this).data('type');
            $(".retur-" + id).toggle();
            $(".btn-show").hide();
            $(".cancel").show();
            $(".save").show();
            $(".type-"+id).val(type);
            $('.text-retur-' + id).toggle();
        });

        $('.cancel').click(function () {
            let id = $(this).data('id');
            $(".retur-" + id).hide();
            $(".btn-show").show();
            $(".cancel").hide();
            $(".save").hide();
            $('.text-retur-' + id).hide();
        });

        $('.save').click(function (e) {
            e.preventDefault();
            let orderId = $(this).data('id'); // Ambil ID pesanan

            let form = $('.form-update-' + orderId)[0]; // Ambil formulir berdasarkan ID order
            let formData = new FormData(form); // Buat objek FormData dari form

            $.ajax({
                url: $('.form-update-' + orderId).attr('action'), // Ambil URL dari form
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Jika menggunakan Laravel
                },
                success: function (response) {
                    alert('Data berhasil disimpan!');
                    location.reload(); // Reload halaman setelah sukses
                },
                error: function (xhr) {
                    alert('Terjadi kesalahan, coba lagi.');
                    console.log(xhr.responseText);
                }
            });
        });

    });


</script>
