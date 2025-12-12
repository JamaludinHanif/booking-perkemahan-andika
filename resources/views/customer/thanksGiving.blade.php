<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih | Panagaran Camp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
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
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center p-4 sm:p-6">
        <div class="w-full max-w-2xl">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden text-center">
                <!-- Header Section -->
                <div class="bg-primary px-6 py-8 sm:px-10 sm:py-12">
                    <div class="flex justify-center items-center mb-4">
                        <i data-feather="check-circle" class="text-white w-12 h-12"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-white">Booking Berhasil!</h1>
                </div>

                <!-- Content Section -->
                <div class="p-8 sm:p-10">
                    <div class="mx-auto max-w-md">
                        <i data-feather="smile" class="w-16 h-16 text-secondary mx-auto mb-6"></i>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4" id="customerName">Terima Kasih, {{ $booking->customer_name }}!</h2>
                        <p class="text-gray-600 mb-6">
                            Booking perkemahan Anda telah berhasil kami terima. Tim kami akan segera menghubungi Anda untuk konfirmasi lebih lanjut.
                        </p>
                        <div class="bg-gray-50 rounded-lg p-4 mb-6 text-left">
                            <h3 class="font-medium text-gray-700 mb-2">Detail Booking:</h3>
                            <ul class="space-y-1 text-sm text-gray-600">
                                <li><span class="font-medium">Area: {{ $booking->getCampsite() }}</span> <span id="campsiteLocation">-</span></li>
                                <li><span class="font-medium">Tanggal: {{ \Carbon\Carbon::parse($booking->start_date)->translatedFormat('d M Y') }} s/d  {{ \Carbon\Carbon::parse($booking->end_date)->translatedFormat('d M Y') }}</span> <span id="bookingDates">-</span></li>
                            </ul>
                        </div>
                        <a href="{{ route('customer.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                            <i data-feather="home" class="w-4 h-4 mr-2"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>