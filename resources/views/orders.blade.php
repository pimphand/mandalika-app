<x-app>
    <style>
        .status-btn.active {
            border: 2px solid #fff;
            opacity: 0.8;
        }
    </style>
    <div class="pt-3"></div>
    <livewire:list-order />

    @push('js')
        <script>
            function setActive(element) {
                // Menghapus kelas 'active' dari semua elemen dengan class 'status-btn'
                document.querySelectorAll('.status-btn').forEach(btn => btn.classList.remove('active'));

                // Menambahkan kelas 'active' ke elemen yang diklik
                element.classList.add('active');
            }
        </script>
    @endpush
</x-app>
