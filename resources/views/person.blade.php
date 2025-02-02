<x-app>
    <div class="pt-3"></div>
    <livewire:person />
    <div class="pt-3"></div>

    @push('js')
        <script>
            $('#buttonPerson').on('click', function() {
                //sweetalert
                Swal.fire({
                    title: 'Masih Dalam Pengembangan',
                    text: 'Mohon Maaf, Fitur ini masih dalam pengembangan',
                    icon: 'info',
                });
            });

            $('#logout').on('click', function() {
                $.ajax({
                    type: "post",
                    url: "{{ route('logout') }}",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        localStorage.removeItem('cart');
                        localStorage.removeItem('customer_id');
                        window.location.href = "/";
                    }
                });
            });
        </script>
    @endpush
</x-app>
