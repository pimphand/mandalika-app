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
            @if (request()->routeIs('customer'))
                <div>
                    <button class="btn btn-sm btn-outline-primary" wire:click="resetFilters" id="resetFilters">Semua
                    </button>
                    <button class="btn btn-sm btn-outline-success" wire:click="$set('isBlacklist', 'aktif')">Aktif
                    </button>

                    <button class="btn btn-sm btn-outline-dark" wire:click="$set('isBlacklist', 'blacklist')">Blacklist
                    </button>

                </div>
            @endif

        </div>
        <ul class="ps-0 chat-user-list mb-2">
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
                                    <p class="mb-0 text-truncate"
                                        style="overflow: hidden;text-overflow: ellipsis; white-space: nowrap">
                                        {{ Str::limit($customer->address, 30, '...') }}</p>
                                    <p class="mb-0 text-truncate">Toko : {{ $customer->store_name }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- Options -->
                    @if (request()->routeIs('customer'))
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
                    @endif
                </li>
            @endforeach
        </ul>
        {{ $customers->links() }}
    </div>
</div>
