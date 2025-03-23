<x-app>
    <div class="pt-3"></div>
    <div id="profile"></div>
    <div class="pt-3"></div>

    @push('js')
        <script>
            $(document).on('click','#buttonPerson', function() {
                const formData = new FormData();
                formData.append('_token', "{{csrf_token()}}");
                formData.append('name', $('#name').val());
                formData.append('password', $('#password').val());
                formData.append('address', $('#address').val());
                formData.append('username', $('#Username').val());
                formData.append('phone', $('#phone').val());
                formData.append('photo', $('#photo')[0].files[0]);
                $.ajax({
                    type: "post",
                    url: "{{ route('updateUser') }}",
                    data: formData,
                    contentType: false, // Tells jQuery not to set the content type
                    processData: false, // Tells jQuery not to process the data
                    success: function(response) {
                        window.location.href = "/acccount?success=1";
                    }
                });
            });

            $(document).on('click','#logout', function() {
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

            $.get('{{route('profile')}}', function(response) {
                $('#profile').html(response);
            });

            //jika ada query string success
            const urlParams = new URLSearchParams(window.location.search);
            const success = urlParams.get('success');
            if (success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil diupdate',
                });

                //menghapus query string success
                window.history.replaceState({}, document.title, "/" + "acccount");
            }
        </script>
    @endpush
</x-app>
