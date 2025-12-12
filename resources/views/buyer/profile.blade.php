@extends('layouts.buyer')

@section('content')

    <body class="bg-white">
        <div class="max-w-7xl mx-auto">
            {{-- header --}}
            <div class="rounded-lg shadow overflow-hidden">
                <div class="relative">
                    <img alt="Mountain landscape with a cloudy sky" class="w-full h-64 object-cover" height="400"
                        src="https://storage.googleapis.com/a1aa/image/Yx6LzL6ZliJlKZ9jBzO1kOhiqWYZye8vb92uvmkfRMzuIu5TA.jpg"
                        width="1200" />
                    <button class="absolute top-4 right-4 bg-black text-white px-4 py-2 rounded-full flex items-center">
                        <i class="fas fa-camera mr-2">
                        </i>
                        Edit Cover
                    </button>
                    <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2">
                        <img alt="Profile picture of a person" class="w-24 h-24 rounded-full border-4" height="100"
                            src="{{ asset('user-avatar.jpg') }}" width="100" />
                    </div>
                </div>
                <div class="text-center mt-16 mb-5">
                    <h1 class="text-2xl font-semibold mb-5">
                        {{ session('userData')->name }}
                    </h1>
                    <h1 class="text-sm lg:text-base text-gray-500 mb-5">
                        {{ session('userData')->email }}
                    </h1>
                </div>

                {{-- nav --}}
                <div class="">
                    <div
                        class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-8 py-4 px-4 text-sm md:text-base font-semibold">
                        <!-- Ganti Password -->
                        <button type="button" data-target="#content-password"
                            class="hidden md:inline-block nav-desktop border-b-4 text-indigo-600 border-indigo-600 pb-1 md:pb-0.5">
                            Ganti Password
                        </button>
                        <button type="button" data-target="#content-password"
                            class="md:hidden nav-mobile text-white bg-indigo-600 flex justify-center items-center gap-x-1.5 rounded-md px-3 py-2 text-sm font-semibold shadow-sm">
                            Ganti Password
                            <i class="fas fa-edit ml-0.5"></i>
                        </button>

                        <!-- Kritik Dan Saran -->
                        <button type="button" data-target="#content-feedback"
                            class="hidden md:inline-block nav-desktop border-b-4 pb-1 md:pb-0.5">
                            Kritik Dan Saran
                        </button>
                        <button type="button" data-target="#content-feedback"
                            class="md:hidden nav-mobile text-white bg-gray-600 flex justify-center items-center gap-x-1.5 rounded-md px-3 py-2 text-sm font-semibold shadow-sm">
                            Kritik Dan Saran
                            <i class="fas fa-thumbs-up ml-0.5"></i>
                        </button>
                    </div>

                </div>
            </div>
            <!-- Konten -->
            <div class="">

                {{-- ganti password --}}
                <div id="content-password" class="content rounded-md mt-4">
                    <div class="bg-white">
                        <div class="mx-auto max-w-xl px-4 py-10 sm:px-6">
                            <div class="max-w-xl">
                                <h1 id="your-orders-heading" class="text-xl font-bold tracking-tight text-gray-900">Ganti
                                    Password</h1>
                            </div>

                            <form id="formChangePassword">
                                <div class="mt-5 grid grid-cols-1 relative">
                                    <input type="password" name="password" id="password"
                                        class="block w-full rounded-md bg-white py-3 pl-10 pr-3 text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:pl-9 text-sm lg:text-base"
                                        placeholder="Masukkan Password Baru Anda">
                                    <i
                                        class="fas fa-edit pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 size-5"></i>
                                </div>
                                <div class="flex justify-center mt-5 lg:mt-11 mb-16">
                                    <button type="submit"
                                        class="rounded-md m-auto bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        Ganti Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- feedback --}}
                <div id="content-feedback" class="hidden content rounded-md mt-4">
                    <main class="grid min-h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
                        <div class="text-center">
                            <p class="text-base font-semibold text-indigo-600">404</p>
                            <h1 class="mt-4 text-balance text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">
                                Page not found</h1>
                            <p class="mt-6 text-pretty text-lg font-medium text-gray-500 sm:text-xl/8">Sorry, we couldn’t
                                find the page you’re looking for.</p>
                            <div class="mt-10 flex items-center justify-center gap-x-6">
                                <a href="{{ url('/') }}"
                                    class="rounded-md bg-indigo-600 hover:text-white px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Go
                                    back home</a>
                                <a href="#" class="text-sm font-semibold text-gray-900">Contact support <span
                                        aria-hidden="true">&rarr;</span></a>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </body>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Fungsi untuk mengatur warna aktif dan tidak aktif
            function setActive(button) {
                // Hapus kelas aktif dari semua tombol desktop dan mobile
                $('.nav-desktop').removeClass('text-indigo-600 border-indigo-600').addClass('text-gray-600');
                $('.nav-mobile').removeClass('bg-indigo-600').addClass('bg-gray-600');

                // Tambahkan kelas aktif ke tombol yang diklik
                $(button).hasClass('nav-desktop') ?
                    $(button).addClass('text-indigo-600 border-indigo-600').removeClass('text-gray-600') :
                    $(button).addClass('bg-indigo-600').removeClass('bg-gray-600');
            }

            $('button[data-target]').click(function() {
                // Sembunyikan semua konten terlebih dahulu
                $('.content').hide();

                // Tampilkan konten yang sesuai dengan tombol yang diklik
                let target = $(this).data('target');
                $(target).show();

                // Atur tombol aktif
                setActive(this);
            });
        });

        $(function() {

            const $formChangePassword = $('#formChangePassword');
            const $formChangePasswordSubmitBtn = $('#formChangePassword').find(`[type="submit"]`);
            const originalBtnText = $formChangePasswordSubmitBtn.text();

            $formChangePassword.on('submit', function(e) {
                e.preventDefault();
                $('.message-error').html('')

                const formData = $(this).serialize();
                $formChangePasswordSubmitBtn.prop('disabled', true).text(
                    'Loading...');

                ajaxSetup();
                $.ajax({
                        url: `{{ route('buyer.changePassword') }}`,
                        method: 'post',
                        data: formData,
                        dataType: 'json'
                    })
                    .done(response => {
                        alertTailwind('Berhasil!', response.success, 'success', 3000);
                        $formChangePasswordSubmitBtn.prop('disabled', false).text(
                            originalBtnText);
                    })
                    .fail(error => {
                        $formChangePasswordSubmitBtn.prop('disabled', false).text(
                            originalBtnText);
                        if (error.responseJSON) {
                            if (error.responseJSON.errors) {
                                const validationErrors = Object.values(error.responseJSON.errors)
                                    .map(errArray => errArray.join(
                                        '<br>'))
                                    .join('<br>');
                                alertTailwind('Pesan Validasi!', validationErrors, 'warning', 3000);
                            } else {
                                const errorMessage = error.responseJSON.message || error.responseJSON
                                    .details; //detailsnya nanti harus diganti jadi error
                                alertTailwind('Gagal!', errorMessage, 'error', 3000);
                            }
                        } else {
                            alertTailwind('Error!', 'An unexpected error occurred. Please try again.',
                                'error');
                        }
                    })
            })

        })
    </script>
@endsection
