@if ($paginator->hasPages())
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination direction-rtl pagination-three">
                            {{-- Tombol Previous --}}
                            @if ($paginator->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="bi bi-chevron-left"></i></span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                                        data-page="{{ $paginator->currentPage() - 1 }}" aria-label="Previous">
                                        <i class="bi bi-chevron-left"></i>
                                    </a>
                                </li>
                            @endif

                            {{-- Nomor Halaman --}}
                            <li class="page-item">
                                <a class="page-link" href="#"
                                    data-page="{{ $paginator->currentPage() }}">{{ $paginator->currentPage() }}</a>
                            </li>

                            {{-- Tombol Next --}}
                            @if ($paginator->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}"
                                        data-page="{{ $paginator->currentPage() + 1 }}" aria-label="Next">
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="bi bi-chevron-right"></i></span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                    <small>Showing {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}</small>
                </div>
            </div>
        </div>
    </div>
@endif
