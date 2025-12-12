<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | {{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <link rel="stylesheet" href="{{ asset('ladda/ladda-themeless.min.css') }}">
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

<body class="bg-gray-50 min-h-screen flex items-center justify-center"
    style="background-image: url('{{ asset('img/panagaran_view.webp') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    <div class="w-full max-w-md z-10 px-4" style="zoom: 0.8">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden backdrop-blur-sm bg-opacity-90">
            <!-- Header Section -->
            <div class="bg-primary px-6 py-8 text-center">
                <div class="flex items-center justify-center">
                    <i data-feather="map" class="text-white mr-3 w-8 h-8"></i>
                    <h1 class="text-2xl font-bold text-white">{{ $title }}</h1>
                </div>
                <p class="mt-2 text-white">Login untuk mengelola data <b>Master</b> dan data <b>Booking</b></p>
            </div>

            <!-- Main Form Section -->
            <form method="POST" action="{{ route('auth.login') }}" class="p-6 space-y-6">
                @csrf
                <!-- Username Field -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                        Username
                    </label>
                    <div class="relative">
                        <input id="username" type="text" required name="username"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                            placeholder="Enter your username">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i data-feather="user" class="w-5 h-5 text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <div class="relative">
                        <input id="password" type="password" required name="password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                            placeholder="Enter your password">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i data-feather="lock" class="w-5 h-5 text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" type="checkbox"
                            class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                            Remember me
                        </label>
                    </div>
                    {{-- <div class="text-sm">
                        <a href="#" class="font-medium text-primary-600 hover:text-primary-500">
                            Forgot password?
                        </a>
                    </div> --}}
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                        <i data-feather="log-in" class="w-4 h-4 mr-2"></i> Log In
                    </button>
                </div>
            </form>

            <!-- Footer Section -->
            <div class="px-6 py-4 bg-gray-50 rounded-b-xl text-center">
                <p class="mt-1 text-xs text-gray-400">
                    &copy; {{ date('Y') }} {{ $title }}. All rights reserved (by Andika).
                </p>
            </div>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
    {{-- ladda --}}
    <script src="{{ asset('ladda/spin.min.js') }}"></script>
    <script src="{{ asset('ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('ladda/ladda.jquery.min.js') }}"></script>

    <script>
        $('#submitButton').on('click', function(e) {
            var form = $(this).closest('form');

            // Cek validasi form
            if (form[0].checkValidity() === false) {
                e.preventDefault(); // Cegah submit jika tidak valid
                e.stopPropagation();
            } else {
                $('#spinner').show(); // Tampilkan spinner
            }
        });
    </script>
</body>

</html>
