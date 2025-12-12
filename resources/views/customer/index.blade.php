<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Perkemahan | {{ $title }}</title>
    <meta content="{{ csrf_token() }}" name="_token">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/custom.css') }}">
    <link rel="stylesheet" href="style.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#595857',
                        secondary: '#10B981'
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom styles for file input preview */
        #payment_proof {
            display: none;
        }

        /* Animation for form elements */
        input,
        select,
        textarea {
            transition: all 0.3s ease;
        }

        /* Hover effects for buttons */
        button {
            transition: all 0.2s ease;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .sm\:col-span-2 {
                grid-column: span 1 / span 1;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <div id="notification-container" aria-live="assertive"
        class="pointer-events-none fixed inset-0 flex items-start px-4 py-6 sm:p-6 z-50">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end"></div>
    </div>
    <div class="min-h-screen flex items-center justify-center p-4 sm:p-6">
        <div class="w-full max-w-3xl">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Header Section -->
                <div class="bg-primary px-6 py-4 sm:px-8 sm:py-6">
                    <div class="flex items-center">
                        <i data-feather="map" class="text-white mr-3"></i>
                        <h1 class="text-2xl font-bold text-white">{{ $title }}</h1>
                    </div>
                    <p class="mt-1 text-white">Booking perkemahan Anda dengan mudah</p>
                </div>

                <!-- Main Form Section -->
                <form id="form" class="p-6 sm:p-8">
                    <div class="space-y-8">
                        <!-- Form Header -->
                        <div class="border-b border-gray-200 pb-6">
                            <h2 class="text-xl font-semibold text-gray-800">Formulir Booking</h2>
                            <p class="mt-1 text-sm text-gray-600">
                                <span class="text-red-500">*</span> Harap lengkapi seluruh data dibawah ini
                            </p>
                        </div>

                        <!-- Form Grid -->
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Campsite Selection -->
                            <div class="sm:col-span-2">
                                <label for="campsite_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Area Kemah <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select id="campsite_id" name="campsite_id" required
                                        class="appearance-none w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
                                        <option value="" disabled selected>Pilih Area Kemah</option>
                                        @foreach (App\Models\Campsite::where('is_active', true)->get() as $campsite)
                                            <option value="{{ $campsite->id }}">{{ $campsite->name }}</option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <i data-feather="chevron-down" class="w-4 h-4"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Personal Information -->
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input id="customer_name" type="text" name="customer_name" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                                        placeholder="Nama anda">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <i data-feather="user" class="w-4 h-4 text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input id="customer_email" type="email" name="customer_email" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                                        placeholder="email@contoh.com">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <i data-feather="mail" class="w-4 h-4 text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nomor Telepon <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input id="customer_phone" type="tel" name="customer_phone" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                                        placeholder="0812 3456 7890">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <i data-feather="phone" class="w-4 h-4 text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Date Selection -->
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">
                                    Check-in <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input id="start_date" type="date" name="start_date" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <i data-feather="calendar" class="w-4 h-4 text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">
                                    Check-out <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input id="end_date" type="date" name="end_date" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <i data-feather="calendar" class="w-4 h-4 text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Proof -->
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Bukti Pembayaran <span class="text-red-500">*</span>
                                </label>
                                <div
                                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg transition hover:border-primary-500">
                                    <div class="space-y-1 text-center">
                                        <div class="flex justify-center">
                                            <i data-feather="upload-cloud" class="w-12 h-12 text-gray-400"></i>
                                        </div>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="payment_proof"
                                                class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none">
                                                <span>Upload file</span>
                                                <input id="payment_proof" name="payment_proof" type="file"
                                                    class="sr-only" required>
                                            </label>
                                            <p class="pl-1">atau drag & drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG maksimal 5MB</p>
                                    </div>
                                </div>
                                <div id="previewContainer" class="mt-4 hidden">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                                    <div class="flex items-center space-x-4">
                                        <img id="previewBukti" class="h-20 w-auto rounded-md border"
                                            alt="Preview Bukti Pembayaran">
                                        <button type="button" onclick="clearPreview()"
                                            class="text-sm text-red-600 hover:text-red-800">
                                            <i data-feather="trash-2" class="w-4 h-4"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                        <button type="button" onclick="resetForm()"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                            <i data-feather="x" class="w-4 h-4 inline mr-2"></i> Batalkan
                        </button>
                        <button type="submit"
                            class="px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition flex items-center">
                            <i data-feather="send" class="w-4 h-4 inline mr-2"></i> Kirim Booking
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer Note -->
            <div class="mt-6 text-center text-sm text-gray-500">
                <p>Masih ada pertanyaan? Hubungi kami via <a href="https://wa.me/6285693336698?text=Halo%20ka%20andika%20saya%20mau%20tanya-tanya%20tentang%20{{ $title }}"
                        class="text-blue-600 hover:text-blue-800">WhatsApp</a></p>
            </div>
        </div>
    </div>

    <div id="preloader"></div>

    <div>
        <script src="{{ asset('atlantis/assets/js/core/jquery.3.2.1.min.js') }}"></script>
        <script src="{{ asset('atlantis/assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('atlantis/assets/js/core/bootstrap.min.js') }}"></script>

        <!-- jQuery UI -->
        <script src="{{ asset('atlantis/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('atlantis/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

        <!-- jQuery Scrollbar -->
        <script src="{{ asset('atlantis/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

        <!-- Datatables -->
        <script src="{{ asset('atlantis/assets/js/plugin/datatables/datatables.min.js') }}"></script>

        <!-- Bootstrap Notify -->
        <script src="{{ asset('atlantis/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

        {{-- jquery-confirm --}}
        <script src="{{ asset('atlantis/assets/js/plugin/jquery-confirm/jquery-confirm.js') }}"></script>

        {{-- ladda --}}
        <script src="{{ asset('ladda/spin.min.js') }}"></script>
        <script src="{{ asset('ladda/ladda.min.js') }}"></script>
        <script src="{{ asset('ladda/ladda.jquery.min.js') }}"></script>

        <!-- Atlantis JS -->
        <script src="{{ asset('atlantis/assets/js/atlantis.min.js') }}"></script>

        {{-- select2 --}}
        <script src="{{ asset('select2/select2.min.js') }}"></script>

        <!-- Atlantis DEMO methods, don't include it in your project! -->
        {{-- <script src="{{ asset('atlantis/assets/js/setting-demo.js') }}"></script> --}}
        <script src="{{ asset('atlantis/assets/js/demo.js') }}"></script>
        <script src="{{ asset('atlantis/assets/js/myJs.js') }}"></script>
    </div>

    {{-- start logic --}}
    <script>
        // File preview functionality
        document.getElementById('payment_proof').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            // Validate file type
            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('Format file tidak didukung. Harap upload file JPEG, PNG, atau GIF.');
                this.value = '';
                return;
            }

            // Validate file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 5MB.');
                this.value = '';
                return;
            }

            // Create preview
            const previewContainer = document.getElementById('previewContainer');
            const preview = document.getElementById('previewBukti');
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }

            reader.readAsDataURL(file);
        });

        function clearPreview() {
            document.getElementById('payment_proof').value = '';
            document.getElementById('previewBukti').src = '';
            document.getElementById('previewContainer').classList.add('hidden');
        }

        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mengosongkan formulir?')) {
                document.getElementById('form').reset();
                clearPreview();
            }
        }

        // Form submission
        document.getElementById('form').addEventListener('submit', function(e) {
            e.preventDefault();

            // Validate dates
            const startDate = new Date(document.getElementById('start_date').value);
            const endDate = new Date(document.getElementById('end_date').value);

            if (startDate >= endDate) {
                alert('Tanggal check-out harus setelah tanggal check-in');
                return;
            }

            // Simulate form submission
            alert('Booking berhasil dikirim! Kami akan menghubungi Anda segera.');
        });

        // Date validation for min date (today)
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('start_date').min = today;
            document.getElementById('end_date').min = today;

            // Update min end date when start date changes
            document.getElementById('start_date').addEventListener('change', function() {
                document.getElementById('end_date').min = this.value;
            });
        });

        $(function() {

            const $form = $('#form');
            const $formSubmitBtn = $form.find(`[type="submit"]`);
            const originalBtnText = $formSubmitBtn.text();

            $form.on('submit', function(e) {
                e.preventDefault();
                $('.message-error').html('');

                const formData = new FormData(this);
                $formSubmitBtn.prop('disabled', true).text(
                    'Loading...');

                ajaxSetup();
                $.ajax({
                        url: `{{ route('customer.store') }}`,
                        method: 'post',
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                    })
                    .done(response => {
                        alertTailwind('Berhasil!',
                            response.message, 'success'
                        );
                        $formSubmitBtn.prop('disabled', false).text(
                            originalBtnText);
                        let url = "{{ route('customer.thanksGiving', ':id') }}";
                        url = url.replace(':id', response.id);
                        setTimeout(() => {
                            location.href = url;
                        }, 1500)
                    })
                    .fail(error => {
                        $formSubmitBtn.prop('disabled', false).text(
                            originalBtnText);
                        if (error.responseJSON) {
                            if (error.responseJSON.errors) {
                                const validationErrors = Object.values(error.responseJSON.errors)
                                    .map(errArray => errArray.join('<br>'))
                                    .join('<br>');
                                alertTailwind('Pesan Validasi!', validationErrors, 'warning');
                            } else {
                                const errorMessage = error.responseJSON.message || error.responseJSON
                                    .details;
                                alertTailwind('Gagal!', errorMessage, 'error');
                            }
                        } else {
                            alertTailwind('Error!', 'An unexpected error occurred. Please try again.',
                                'error');
                        }
                    });
            });

        })
    </script>

    <script>
        feather.replace();
    </script>
</body>

</html>
