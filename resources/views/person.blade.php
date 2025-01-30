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
        </script>
    @endpush
</x-app>
