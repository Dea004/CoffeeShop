<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CoffeShop</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <style>
        :root {
            --primary: #814e2b; 
            --secondary: #593b1f; 
            --bg-light: #fff8f0; 
            --text-light: #fff; 
            --text-dark: #593b1f; 
            --border: #e0e0e0; 
        }

        .swal2-container {
        z-index: 10000 !important;
        }
    </style>

</head>
<body style="background-color: #fff8f0" x-data="{ openLogin: false, openRegister: false, openForgotPassword: false }" class="flex flex-col min-h-screen">
    
    <!-- Navbar -->
    <nav class="bg-transparent" x-data="{ open: false, isSearchPage: window.location.pathname === '/search', accountMenuOpen: false }">
    <div class="container mx-auto flex justify-between items-center p-4">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img/Logo nobg.png') }}" alt="logo2" class="w-24" />
        </a>
        <div class="flex items-center md:hidden">
            <button id="mobile-menu-button" class="text-[var(--primary)] focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
        <div class="hidden md:flex items-center space-x-8">
            <!-- Home Link -->
            <a :class="{ 'text-gray-500': window.location.pathname === '/' }" class="text-[var(--primary)] font-medium" href="{{ url('/') }}">Home</a>
            
            <!-- CoffeeShop Link -->
            <a :class="{ 'text-gray-500': window.location.pathname === '/coffee_shop' }" class="text-[var(--primary)] font-medium" href="{{ route('coffe_shops.index') }}">CoffeeShop</a>
            
            <!-- Booking Link -->
            <!-- Fitur booking hanya untuk pengguna yang login -->
            @auth
                <a :class="{ 'text-gray-500': window.location.pathname === '/booking' }" class="text-[var(--primary)] font-medium" href="{{ url('/booking') }}" class="btn btn-primary">Booking</a>
            @endauth
            
            <!-- Search Link -->
            <a :class="{ 'text-gray-500': window.location.pathname === '/search' }" class="text-[var(--primary)] font-medium" href="{{ url('/search') }}">Search</a>
            
            <!-- Dropdown Filter -->
            <div class="relative" x-show="isSearchPage" x-data="{ open: false }">
                <button @click="open = !open" class="text-[var(--primary)] font-medium focus:outline-none">
                    Filter
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
                <ul x-show="open" @click.away="open = false" class="absolute left-0 mt-2 w-48 bg-white border rounded-lg shadow-lg z-20">
                    <li>
                        <a href="{{ route('search.filter', ['filter' => 'kategori']) }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Kategori
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('search.filter', ['filter' => 'favorite']) }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Daftar Favorite
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Account Menu (Visible on all pages) -->
            <div class="relative" x-data="{ accountMenuOpen: false }">
                @if(Auth::check())
                    <button @click="accountMenuOpen = !accountMenuOpen" class="text-[var(--primary)] font-medium flex items-center space-x-2">
                        <span>{{ Auth::user()->username }}</span>
                        <i class='w-4 h-4 bx bxs-user-circle'></i>
                    </button>
                    <ul x-show="accountMenuOpen" @click.away="accountMenuOpen = false" class="absolute right-0 mt-2 w-48 bg-white border border-[var(--border)] rounded-lg shadow-lg z-20" x-cloak>
                        <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ url('/profile') }}">Profil</a></li>
                        @auth
                            @if(isset($hasShop) && $hasShop)
                                <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('shop.index') }}">Toko Saya</a></li>
                            @endif
                        @endauth

                        @guest
                            <!-- Jika user belum login, item ini tidak muncul -->
                        @endguest

                        <li><a @click="confirmLogout" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a></li>
                    </ul>
                @else
                    <a @click="openLogin = true" class="text-[var(--primary)] font-medium cursor-pointer">Login</a>
                @endif
            </div>
        </div>
    </div>
    </nav>


    <!-- HIDDEN ITEM (NOT SHOW AT PAGES IF DONT CLICK BUTTON) -->

    <!-- Login Modal -->
    <div x-show="openLogin" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" style="z-index: 9999;" x-cloak>
        <div class="bg-white p-6 rounded-lg shadow-lg w-80 relative">
            <h2 class="text-xl font-semibold text-center mb-4" style="color: #814e2b;">Login</h2>
            <form method="POST" action="{{ route('login.submit') }}" id="loginForm">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium" style="color: #814e2b;">Email address</label>
                    <input class="w-full px-4 py-2 border border-[#814e2b] rounded focus:outline-none focus:ring-2 focus:ring-[#814e2b]" 
                        type="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium" style="color: #814e2b;">Password</label>
                    <input class="w-full px-4 py-2 border border-[#814e2b] rounded focus:outline-none focus:ring-2 focus:ring-[#814e2b]" 
                        type="password" name="password" placeholder="Password" required>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="rememberMe" name="rememberMe" type="checkbox" class="form-checkbox text-[#814e2b]">
                        <label for="rememberMe" class="ml-2 text-sm font-medium" style="color: #814e2b;">Remember me</label>
                    </div>
                    <button type="button" @click="openLogin = false; openForgotPassword = true" 
                            class="text-sm hover:underline" style="color: #814e2b;">Forgot Password?</button>
                </div>
                <div class="mt-4">
                    <button type="submit" style="background-color: #814e2b;" class="w-full px-4 py-2 bg-[#814e2b] text-white font-semibold rounded hover:bg-[#663d21]">Login</button>
                </div>
            </form>
            <button @click="openLogin = false" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">&times;</button>
            <p class="mt-10 text-center text-sm text-gray-500">
                Don't have an account?
                <a href="#" @click="openLogin = false; openRegister = true" class="font-semibold" style="color: #814e2b;">Register</a>
            </p>
        </div>
    </div> 

   <!-- Forgot Password Modal -->
    <div x-show="openForgotPassword" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" style="z-index: 9999;" x-cloak>
        <div class="bg-white p-6 rounded-lg shadow-lg w-80 relative">
            <h2 class="text-xl font-semibold text-center mb-4" style="color: #814e2b;">Forgot Password</h2>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium" style="color: #814e2b;">Email address</label>
                    <input class="w-full px-4 py-2 border border-[#814e2b] rounded focus:outline-none focus:ring-2 focus:ring-[#814e2b]" 
                        type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mt-4">
                    <button type="submit" style="background-color: #814e2b;" class="w-full px-4 py-2 bg-[#814e2b] text-white font-semibold rounded hover:bg-[#663d21]">
                        Send Reset Link
                    </button>
                </div>
            </form>
            <button @click="openForgotPassword = false" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">&times;</button>
            <p class="mt-10 text-center text-sm text-gray-500">
                Remembered your password?
                <a href="#" @click="openForgotPassword = false; openLogin = true" class="font-semibold" style="color: #814e2b;">Login</a>
            </p>
        </div>
    </div>

    <!-- Register Modal -->
    <div x-show="openRegister" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" style="z-index: 9999;" x-cloak>
        <div class="bg-white p-6 rounded-lg shadow-lg w-80 relative">
            <h2 class="text-xl font-semibold text-center mb-4">Register</h2>
            <form id="registerForm" action="{{ route('register.submit') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-900">Username</label>
                    <input class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#814e2b]" 
                        type="text" name="username" id="username" placeholder="Enter your username" required>
                </div>
                <div class="mb-4">
                    <label for="fullname" class="block text-sm font-medium text-gray-900">Full Name</label>
                    <input class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#814e2b]" 
                        type="text" name="fullname" id="fullname" placeholder="Enter your full name" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-900">Email Address</label>
                    <input class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#814e2b]" 
                        type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-900">Phone Number</label>
                    <input class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#814e2b]" 
                        type="text" name="phone" id="phone" placeholder="Enter your phone number" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                    <input class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#814e2b]" 
                        type="password" name="password" id="password" placeholder="Enter your password" required>
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-900">Confirm Password</label>
                    <input class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#814e2b]" 
                        type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" required>
                </div>
                <div class="mt-4">
                    <button type="submit" class="w-full px-4 py-2 text-white font-semibold rounded" style="background-color: #814e2b;">Register</button>
                </div>
            </form>
            <p class="mt-10 text-center text-sm text-gray-500">
                Already have an account? <a href="#" @click="openRegister = false; openLogin = true" class="font-semibold" style="color: #814e2b;">Login</a>
            </p>
            <button @click="openRegister = false" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">&times;</button>
        </div>
    </div>


    @yield('contents')
    

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    //Login validation
    document.getElementById("loginForm").onsubmit = function(event) {
        event.preventDefault(); // Mencegah pengiriman form

        // Ambil data dari form menggunakan FormData
        let formData = new FormData(this);
        
        // Kirim request ke backend menggunakan fetch
        fetch("{{ route('login.submit') }}", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Cek apakah ada error dalam response
            if (data.errors) {
                // Menampilkan error menggunakan SweetAlert
                if (data.errors.email) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal',
                        text: data.errors.email,
                        confirmButtonText: 'Coba Lagi'
                    });
                }
                if (data.errors.password) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal',
                        text: data.errors.password,
                        confirmButtonText: 'Coba Lagi'
                    });
                }
            } else {
                // Menampilkan notifikasi sukses jika login berhasil
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil',
                    text: data.message,
                    confirmButtonText: 'Ok'
                }).then(() => {
                    // Arahkan pengguna ke dashboard setelah sukses
                    window.location.href = "{{ route('dashboard') }}"; // Ganti dengan URL yang sesuai
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    };


    //Register validation
    document.getElementById('registerForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        
        // Pastikan data form berhasil diambil
        let formData = new FormData(this);
        console.log(formData); // Debugging, untuk memastikan form data diambil dengan benar
        
        fetch("{{ route('register.submit') }}", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Debugging response data
            if (data.errors) {
                if (data.errors.username) {
                    Swal.fire('Error', data.errors.username[0], 'error');
                }
                if (data.errors.email) {
                    Swal.fire('Error', data.errors.email[0], 'error');
                }
                if (data.errors.password) {
                    Swal.fire('Error', data.errors.password[0], 'error');
                }
            } else {
                Swal.fire('Success', data.message, 'success').then(() => {
                    // Menutup modal atau melakukan tindakan setelah berhasil
                    document.querySelector('[x-data]').__x.$data.openRegister = false;
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    // logout validation
    function confirmLogout() {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan keluar dari akun Anda.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, logout!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika pengguna memilih "Yes", arahkan mereka ke route logout
            window.location.href = "{{ route('logout') }}";
        }
    });
    }

    </script>

</body>
</html>
