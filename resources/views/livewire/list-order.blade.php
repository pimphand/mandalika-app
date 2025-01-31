<div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group mb-3">
                            <input class="form-control form-control-clicked" wire:model.live.debounce.300ms="customer"
                                type="text" placeholder="Cari Customer">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-3">
                            <input class="form-control form-control-clicked" wire:model.live.debounce.300ms="product"
                                type="text" placeholder="Cari Produk">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-3">
                            <input class="form-control form-control-clicked" wire:model.live.debounce.300ms="id"
                                type="text" placeholder="Cari Order">
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <span wire:click="$set('status', '')" style="color: #fff;" class="btn badge bg-secondary status-btn"
                        onclick="setActive(this)">Semua</span>
                    <span wire:click="$set('status', 'process')" style="color: #fff;"
                        class="btn badge bg-warning status-btn" onclick="setActive(this)">Proses</span>
                    <span wire:click="$set('status', 'pending')" style="color: #fff;"
                        class="btn badge bg-primary status-btn" onclick="setActive(this)">Pending</span>
                    <span wire:click="$set('status', 'success')" style="color: #fff;"
                        class="btn badge bg-success status-btn" onclick="setActive(this)">Sukses</span>
                    <span wire:click="$set('status', 'cancel')" style="color: #fff;"
                        class="btn badge bg-danger status-btn" onclick="setActive(this)">Batal</span>

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
                    @forelse ($orders['data'] as $order)
                        <div class="accordion-item accordion-bg-{{ $status[$order['status']] }}">
                            <div class="accordion-header" id="{{ $order['id'] }}">
                                <h6 data-bs-toggle="collapse" data-bs-target="#accordionStyleFive{{ $order['id'] }}"
                                    aria-expanded="false" aria-controls="accordionStyleFive{{ $order['id'] }}"
                                    class="collapsed">
                                    <i class="bi bi-plus-lg"></i> {{ $order['id'] }} - {{ $order['customer']['name'] }}
                                </h6>
                                <div class="accordion-collapse collapse" id="accordionStyleFive{{ $order['id'] }}"
                                    aria-labelledby="{{ $order['id'] }}" data-bs-parent="#accordionStyle5"
                                    style="">
                                    <p class="mb-0 mt-2" style="color: #000;">
                                        Toko : {{ $order['customer']['store_name'] }}<br>
                                        Alamat : {{ $order['customer']['address'] }}<br>
                                        Telp : {{ $order['customer']['phone'] }}<br>
                                        Status : <strong>{{ $statusId[$order['status']] }}</strong>
                                    </p>
                                    <div class="table-responsive mt-1">
                                        <table class="table table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th>Kategori</th>
                                                    <th>Produk</th>
                                                    <th>Kemasan</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order['items'] as $order_detail)
                                                    <tr>
                                                        <td>{{ $order_detail['category'] }}</td>
                                                        <td>
                                                            {{ $order_detail['name'] }} - <br>
                                                            {{ $order_detail['brand'] }}
                                                        </td>
                                                        <td>{{ $order_detail['package'] }}</td>
                                                        <td>{{ $order_detail['quantity'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
