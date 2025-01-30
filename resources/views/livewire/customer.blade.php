<div>
    <div class="container">
        <div class="card-body p-2">
            <div class="chat-search-box">
                <!-- Search Form -->
                <div class="input-group">
                    <span class="input-group-text" id="searchbox">
                        <i class="bi bi-search"></i>
                    </span>
                    <input class="form-control" wire:model.live.debounce.300ms="search" type="search"
                        placeholder="Cari Customer" aria-describedby="searchbox">
                </div>
            </div>
        </div>
        <div class="add-new-contact-wrap">
            <a class="shadow" href="#" data-bs-toggle="modal" data-bs-target="#addnewcontact">
                <i class="bi bi-plus-lg"></i>
            </a>
        </div>
        <div class="element-heading d-flex justify-content-between align-items-center mb-2">
            <h6 class="ps-1">Customer</h6>
            <div>
                <button class="btn btn-sm btn-outline-primary" wire:click="resetFilters" id="resetFilters">Semua
                </button>
                <button class="btn btn-sm btn-outline-success" wire:click="$set('isBlacklist', 'aktif')">Aktif
                </button>
                <button class="btn btn-sm btn-outline-dark" wire:click="$set('isBlacklist', 'blacklist')">Blacklist
                </button>
            </div>
            <div>
                <span class="badge bg-primary">Pending</span>
                <span class="badge bg-warning">Proses</span>
                <span class="badge bg-success">Sukses</span>
                <span class="badge bg-danger">Batal</span>
            </div>
        </div>
        <ul class="ps-0 chat-user-list">
            <!-- Single Chat User -->
            @foreach ($customers as $customer)
                <li class="p-3 chat-unread customer" data-id="{{ $customer->id }}">
                    <a class="d-flex" href="javascript:void(0)">
                        <!-- Thumbnail -->
                        <div class="chat-user-thumbnail me-3 shadow">
                            <img class="img-circle"
                                src="{{ $customer->store_photo ? config('app.api_url') . '/' . $customer->store_photo : asset('assets/img/bg-img/user1.png') }}"
                                alt="">
                            <span class="active-status"></span>
                        </div>
                        <!-- Info -->
                        <div class="chat-user-info">
                            <h6 class="text-truncate mb-0">{{ $customer->name }}</h6>
                            <div class="last-chat d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0 text-truncate">{{ $customer->address }}</p>
                                    <p class="mb-0 text-truncate">Toko : {{ $customer->store_name }}</p>
                                </div>
                                @if ($customer->orders_count > 0)
                                    <div class="chat-time text-end">
                                        Order :
                                        @if ($customer->order_pending > 0)
                                            <span class="badge bg-primary">{{ $customer->order_pending }}</span>
                                        @endif
                                        @if ($customer->order_proses > 0)
                                            <span class="badge bg-warning">{{ $customer->order_proses }}</span>
                                        @endif
                                        @if ($customer->order_success > 0)
                                            <span class="badge bg-success">{{ $customer->order_success }}</span>
                                        @endif
                                        @if ($customer->order_cancel > 0)
                                            <span class="badge bg-danger">{{ $customer->order_cancel }}</span>
                                        @endif

                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                    <!-- Options -->
                    <div class="dropstart chat-options-btn">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="bi bi-mic-mute"></i>Mute</a></li>
                            <li><a href="#"><i class="bi bi-slash-circle"></i>Ban</a></li>
                            <li><a href="#"><i class="bi bi-trash"></i>Remove</a></li>
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
        {{ $customers->links() }}
    </div>
</div>
