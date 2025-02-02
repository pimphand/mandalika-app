<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ env('APP_NAME') }} - Mobile">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Title -->
    <title>{{ env('APP_NAME') }} - Mobile</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets') }}/img/core-img/favicon.ico">
    <link rel="apple-touch-icon" href="{{ asset('assets') }}/img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets') }}/img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('assets') }}/img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets') }}/img/icons/icon-180x180.png">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/style.css?t={{ time() }}">

    <!-- Web App Manifest -->
    {{-- <link rel="manifest" href="{{ asset('assets') }}/manifest.json"> --}}
    @livewireStyles
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Internet Connection Status -->
    <div class="internet-connection-status" id="internetStatus"></div>

    <x-header />

    <div class="page-content-wrapper">
        {{ $slot }}
    </div>

    <x-navbar />

    <!-- Add new contact modal -->
    <div class="add-new-contact-modal modal fade px-0" id="addnewcontact" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="addnewcontactlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="modal-title" id="addnewcontactlabel">Tambah Customer</h6>
                        <button class="btn btn-close p-1 ms-auto me-0" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form action="#" id="multi-step-form">
                        <!-- Step 1 -->
                        <div id="step-1">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Pemilik</label>
                                <input class="form-control" type="text" placeholder="masukan nama pemilik"
                                    id="name" aria-label="Name" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor Telepon <small>(Whatsapp)</small>
                                </label>
                                <input class="form-control" type="number" placeholder="masukan nomor telepon"
                                    id="phone" aria-label="Phone" required>
                            </div>

                            <div class="mb-3">
                                <label for="store_name" class="form-label">Nama Toko</label>
                                <input class="form-control" type="text" placeholder="masukan nama toko"
                                    id="store_name" aria-label="Store Name" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat Toko</label>
                                <input class="form-control" type="text" placeholder="masukan alamat" id="address"
                                    aria-label="Address" required>
                            </div>

                            <button class="btn btn-primary w-100" type="button" onclick="nextStep(2)">Next</button>
                        </div>

                        <!-- Step 2 (Initially hidden) -->
                        <div id="step-2" style="display: none;">
                            <div class="mb-3">
                                <label for="npwp" class="form-label">NPWP <small>(optional)</small></label>
                                <input class="form-control" type="text" placeholder="Enter NPWP" id="npwp"
                                    aria-label="NPWP">
                            </div>

                            <div class="mb-3">
                                <label for="store_photo" class="form-label">Store Photo</label>
                                <input class="form-control" type="file" id="store_photo" accept="image/*"
                                    aria-label="Store Photo">
                            </div>

                            <div class="mb-3">
                                <label for="owner_photo" class="form-label">Owner Photo</label>
                                <input class="form-control" type="file" id="owner_photo" accept="image/*"
                                    aria-label="Owner Photo">
                            </div>

                            <!-- Back Button -->
                            <button class="btn btn-warning w-100 mb-1" type="button"
                                onclick="previousStep(1)">Kembali</button>
                            <!-- Submit Button -->
                            <button class="btn btn-primary w-100" type="button" id="submit-btn">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- All JavaScript Files -->
    <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/js/slideToggle.min.js"></script>
    <script src="{{ asset('assets') }}/js/internet-status.js"></script>
    <script src="{{ asset('assets') }}/js/tiny-slider.js"></script>
    <script src="{{ asset('assets') }}/js/venobox.min.js"></script>
    <script src="{{ asset('assets') }}/js/countdown.js"></script>
    <script src="{{ asset('assets') }}/js/rangeslider.min.js"></script>
    <script src="{{ asset('assets') }}/js/vanilla-dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/js/index.js"></script>
    <script src="{{ asset('assets') }}/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('assets') }}/js/isotope.pkgd.min.js"></script>
    <script src="{{ asset('assets') }}/js/dark-rtl.js"></script>
    <script src="{{ asset('assets') }}/js/active.js"></script>
    {{-- <script src="{{ asset('assets') }}/js/pwa.js"></script> --}}

    @stack('js')
    <script>
        // JavaScript to switch between steps
        function nextStep(step) {
            if (step === 2) {
                // Validate Step 1 before moving to Step 2
                const name = document.getElementById('name').value;
                const phone = document.getElementById('phone').value;
                const address = document.getElementById('address').value;

                // Check if all required fields are filled in
                if (!name || !phone || !address) {
                    //sweetalert
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pastikan semua kolom diisi!',
                    });
                    return;
                }

                // Hide Step 1 and show Step 2
                document.getElementById('step-1').style.display = 'none';
                document.getElementById('step-2').style.display = 'block';
            }
        }

        // JavaScript to go back to Step 1
        function previousStep(step) {
            if (step === 1) {
                // Hide Step 2 and show Step 1
                document.getElementById('step-2').style.display = 'none';
                document.getElementById('step-1').style.display = 'block';
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            // Get cart from local storage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            $('.bi-cart').text(cart.length ? cart.length : '');
        });

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });


        function addCart(id) {

            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let product = $(`._image_${id}`).attr('src');
            let name = $(`._name_${id}`).text();
            let brand = $(`._brand_${id}`).text();
            let category = $(`._category_${id}`).text();
            let packaging = $(`._packagin_${id}`).text();
            let qty = 1;
            let find = cart.find((item) => item.id == id);
            if (find) {
                find.qty += 1;
            } else {
                cart.push({
                    id,
                    image: product,
                    name,
                    brand,
                    category,
                    packaging,
                    qty
                });
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            localStorage.setItem('cart', JSON.stringify(cart));
            Toast.fire({
                icon: "success",
                title: "Berhasil menambahkan ke keranjang"
            });
            $('.bi-cart').text(cart.length ? cart.length : '');
        }

        function removeCart(index) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            getCart();
            $('.bi-cart').text(cart.length ? cart.length : '');
            Toast.fire({
                icon: "success",
                title: "Berhasil menghapus dari keranjang"
            });
        }

        // Event listener for input fields to remove the error when typing
        $('#name, #phone, #address, #owner_address, #store_name, #npwp').on('input', function() {
            const inputField = $(this);
            inputField.removeClass('is-invalid'); // Remove invalid class
            inputField.siblings('.invalid-feedback').remove(); // Remove the error message
        });

        // Event listener for file inputs to remove the error when a file is selected
        $('#store_photo, #owner_photo').on('change', function() {
            const inputField = $(this);
            inputField.removeClass('is-invalid'); // Remove invalid class
            inputField.siblings('.invalid-feedback').remove(); // Remove the error message
        });

        $(document).ready(function() {
            $('#submit-btn').on('click', function() {
                // Collect data from the form
                const formData = new FormData();

                // Step 1
                formData.append('name', $('#name').val());
                formData.append('phone', $('#phone').val());
                formData.append('address', $('#address').val());

                // Step 2
                formData.append('store_name', $('#store_name').val());
                formData.append('npwp', $('#npwp').val());
                formData.append('others', $('#others').val());

                // Files
                formData.append('store_photo', $('#store_photo')[0].files[0]);
                formData.append('owner_photo', $('#owner_photo')[0].files[0]);

                //csrf token
                formData.append('_token', '{{ csrf_token() }}');

                // Send the data using AJAX
                $.ajax({
                    url: '{{ route('customer') }}', // Replace with your actual server-side URL
                    type: 'POST',
                    data: formData,
                    contentType: false, // Tells jQuery not to set the content type
                    processData: false, // Tells jQuery not to process the data
                    success: function(response) {
                        //sweetalert
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil disimpan!',
                        });
                        //modal hide
                        $('#addnewcontact').modal('hide');
                        // You can reset the form here if needed
                        $('#multi-step-form')[0].reset();
                        $('#resetFilters').click();
                    },
                    error: function(xhr, status, error) {
                        // Parse the error response
                        const response = xhr.responseJSON;

                        // Check if there are validation errors
                        if (response.errors) {
                            // Loop through the errors and display them dynamically
                            $.each(response.errors, function(field, messages) {
                                const inputField = $('#' + field);

                                // Move to the appropriate step
                                if (field === 'phone' || field === 'name' || field ===
                                    'address' || field === 'owner_address') {
                                    $('#step-2').hide();
                                    $('#step-1').show();
                                } else {
                                    $('#step-1').hide();
                                    $('#step-2').show();
                                }

                                // Add the 'is-invalid' class to highlight the input field
                                inputField.addClass('is-invalid');

                                // Remove any existing error message before adding the new one
                                inputField.siblings('.invalid-feedback').remove();

                                // Display the error message below the field
                                inputField.after('<div class="invalid-feedback">' +
                                    messages[0] + '</div>');
                            });
                        } else {
                            alert('There was an error submitting the form');
                            console.log(error);
                        }
                    }
                });
            });
        });
    </script>
    @livewireScripts
</body>

</html>
