@extends('layouts.main')

@section('contents')

    <!-- Main content -->
    <div class="container mx-auto mt-5 mb-16">
        <div class="flex flex-wrap">
            <!-- Bagian Kiri -->
            <div class="w-1/2 flex items-center">
                <div>
                    <h1 class="text-4xl font-bold font-poppins">Setiap cangkir kopi merupakan sebuah petualangan baru</h1>
                    <p class="font-poppins" style="color: #593b1f; margin-top: 20px; text-align: justify; max-width: 600px;">
                        Cari cafe yang pas untuk bekerja, bersantai, atau sekadar menikmati kopi? Kami menyediakan rekomendasi cafe terbaik dengan berbagai pilihan, mulai dari tempat tenang untuk bekerja hingga spot unik untuk konten sosial media. Temukan cafe yang sesuai dengan kebutuhan Anda sekarang!
                    </p>
                    <div class="flex gap-4 mt-5">
                        <!-- Tombol View Coffee Shop -->
                        <a href="{{ route('coffe_shops.index') }}" 
                            class="inline-block bg-yellow-600 text-white font-semibold px-6 py-3 rounded-md shadow-md hover:bg-yellow-500 transition-transform transform hover:scale-105">
                            Explore Coffee Shops
                        </a>
                        
                        <!-- Tombol Tambah Coffee Shop -->
                        <!-- Button to trigger modal -->
                        @if(Auth::check()) 
                            @if($hasShop)
                                <button 
                                    class="btn btn-success rounded-md px-4 py-2 text-white sm:block md:block lg:block" 
                                    style="background-color: #28a745;" 
                                    disabled
                                >
                                    Toko anda sudah terdaftar!
                                </button>
                            @else
                                <button 
                                    class="btn btn-secondary rounded-md px-4 py-2 text-white sm:block md:block lg:block" 
                                    style="background-color: #593b1f;" 
                                    onclick="openModal()"
                                >
                                    Tambah Coffee Shop
                                </button>
                            @endif
                        @else
                            <!-- Tidak menampilkan tombol jika user belum login -->
                        @endif

                        <!-- Modal -->
                        <div id="modal" 
                            class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden"
                            style="z-index: 9999;">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-4/5 sm:w-3/5 md:w-1/2 lg:w-1/3 overflow-y-auto max-h-screen relative">
                                <h3 class="text-2xl font-semibold text-center mb-4">Tambah Coffee Shop</h3>

                                <form action="{{ route('coffee-shops.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- id_user (auto-filled) -->
                                    <input type="hidden" name="id_user" value="{{ auth()->id() }}">

                                    <!-- shop_name -->
                                    <div class="mb-4">
                                        <label for="shop_name" class="block text-sm font-medium text-gray-700">Shop Name</label>
                                        <input type="text" id="shop_name" name="shop_name" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    </div>

                                    <!-- Email and Phone Number -->
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                            <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        </div>
                                        <div>
                                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                            <input type="text" id="phone_number" name="phone_number" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="mb-4">
                                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                        <textarea id="address" name="address" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                                    </div>

                                    <!-- Category -->
                                    <div class="mb-4">
                                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                        <select id="category" name="category" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                            <option value="coffee">Coffee</option>
                                            <option value="tea">Tea</option>
                                            <option value="bakery">Bakery</option>
                                            <!-- Add more categories as needed -->
                                        </select>
                                    </div>

                                    <!-- Opening and Closing Hour -->
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label for="opening_hour" class="block text-sm font-medium text-gray-700">Opening Hour</label>
                                            <input type="time" id="opening_hour" name="opening_hour" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        </div>
                                        <div>
                                            <label for="closing_hour" class="block text-sm font-medium text-gray-700">Closing Hour</label>
                                            <input type="time" id="closing_hour" name="closing_hour" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        </div>
                                    </div>

                                    <!-- Open Days -->
                                    <div class="mb-4">
                                        <label for="open_days" class="block text-sm font-medium text-gray-700">Open Days</label>
                                        <input type="text" id="open_days" name="open_days" placeholder="e.g., Monday to Friday" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-4">
                                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                        <textarea id="description" name="description" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                                    </div>

                                    <!-- Profile Picture -->
                                    <div class="mb-4">
                                        <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    </div>

                                    <!-- Google Maps Link -->
                                    <div class="mb-4">
                                        <label for="google_maps_link" class="block text-sm font-medium text-gray-700">Google Maps Link</label>
                                        <input type="url" id="google_maps_link" name="google_maps_link" placeholder="e.g., https://maps.google.com/..." required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="mt-4 flex justify-between items-center">
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Submit</button>
                                        <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/2">
                <img src="../img/landingPage.png" alt="Coffee shop" />
            </div>
        </div>
    </div>
    <!-- Main content end -->

    <!-- Hero Section with Textured Background -->
    <section class="relative bg-[#fdf8f3] py-20 px-6">
        <div class="container mx-auto flex flex-col md:flex-row items-center">
            <!-- Gambar Kiri -->
            <div class="w-full md:w-2/5 flex justify-center mb-8 md:mb-0">
            <img src="../img/brown.png" alt="Coffee Workspace Illustration" 
            class="w-[500px] md:w-[550px] object-cover rounded-lg shadow-lg">
            </div>

            <!-- Teks Kanan -->
            <div class="w-full md:w-3/5 text-left md:pl-16">
                <h1 class="text-5xl md:text-6xl font-serif text-[#7D5A50] mb-6 leading-snug">
                    WELCOME TO <br>
                    <span class="font-bold text-yellow-400">OUR WORKSPACE</span>
                </h1>
                <p class="text-lg text-[#5C4A3D] mb-8 leading-relaxed max-w-3xl">
                    Temukan tempat ideal untuk bekerja, bersantai, atau menikmati kopi dengan suasana 
                    yang nyaman dan inspiratif. Dapatkan pengalaman terbaik di setiap sudut cafe pilihan kami.
                </p>
                <!-- CTA Button -->
                <a href="{{ route('coffe_shops.index') }}" 
                class="inline-block bg-yellow-600 text-white font-semibold px-8 py-4 rounded-full shadow-md hover:bg-yellow-500 transition-transform transform hover:scale-105">
                    Explore Coffee Shops
                </a>
            </div>
        </div>
    </section>


    <!-- About Us Section -->
    <section class="relative bg-[#fdf8f3] py-16">
        <!-- Kontainer Utama -->
        <div class="container mx-auto flex flex-wrap items-center">
            <!-- Teks Bagian Kiri -->
            <div class="w-full md:w-1/2 px-6 text-left">
                <h2 class="text-6xl font-serif text-[#7D5A50] leading-tight mb-6">
                    Our <span class="block">Workspace</span>
                </h2>
                <p class="text-lg text-[#7D5A50] mb-6 leading-relaxed">
                    OurWorkspace adalah platform yang mempermudah Anda menemukan tempat terbaik untuk bekerja atau bersantai. 
                    Dengan beragam pilihan lokasi, fasilitas, dan suasana, kami membantu Anda menikmati momen produktif yang nyaman.
                </p>
                <p class="text-lg text-[#7D5A50] mb-8 leading-relaxed">
                    Temukan cafe favorit Anda, nikmati kopi terbaik, dan rasakan pengalaman yang berbeda di setiap sudut kota Anda.
                </p>
            </div>

            <!-- Gambar Bagian Kanan -->
            <div class="w-full md:w-1/2 px-6 mt-8 md:mt-0">
                <img src="../img/aboutus.png" alt="About Us" class="rounded-lg shadow-md">
            </div>
        </div>
    </section>


    <!-- Features Section -->
    <section class="relative container mx-auto py-16 text-center">
        <h2 class="text-4xl font-bold text-gray-800 mb-8 uppercase">Fitur Utama</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <i class="fas fa-map-marker-alt text-5xl text-yellow-500 mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Lokasi Cafe</h3>
                <p class="text-gray-600">Temukan cafe terbaik di lokasi terdekat Anda.</p>
            </div>
            <div>
                <i class="fas fa-calendar-alt text-5xl text-yellow-500 mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Jam Operasional</h3>
                <p class="text-gray-600">Pastikan cafe buka sesuai jadwal Anda.</p>
            </div>
            <div>
                <i class="fas fa-mug-hot text-5xl text-yellow-500 mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Kategori Cafe</h3>
                <p class="text-gray-600">Pilih cafe berdasarkan kebutuhan Anda.</p>
            </div>
        </div>
    </section>

    <!-- Call to Action for Adding Coffee Shop -->
    <section class="relative bg-[#fdf8f3] py-20">
        <div class="container mx-auto text-center px-6">
            <!-- Judul -->
            <h2 class="text-5xl font-serif text-[#7D5A50] mb-4">
                Bergabunglah dengan Kami!
            </h2>

            <!-- Deskripsi -->
            <p class="text-lg text-[#5C4A3D] mb-8 leading-relaxed max-w-3xl mx-auto">
                Jika Anda pemilik cafe, daftarkan toko Anda di 
                <span class="font-bold text-yellow-400">OurWorkspace</span> 
                dan dapatkan lebih banyak pelanggan yang mencari tempat nyaman untuk bekerja, berkumpul, atau bersantai.
            </p>

            <!-- Tombol CTA -->
            @if(Auth::check()) 
                <!-- Jika user sudah login -->
                @if($hasShop)
                    <!-- Jika pengguna sudah memiliki toko -->
                    <button 
                        class="bg-green-500 text-white px-6 py-3 rounded-md shadow-md cursor-not-allowed" 
                        style="background-color: #28a745;"
                        disabled
                    >
                        Toko anda sudah terdaftar!
                    </button>
                @else
                    <!-- Jika pengguna belum memiliki toko -->
                    <button 
                        class="bg-yellow-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-yellow-500 transition-all" 
                        onclick="openModal()"
                    >
                        Tambah Coffee Shop
                    </button>
                @endif
                @else
                    <!-- Jika user belum login -->
                    <button 
                        class="bg-gray-400 text-white px-6 py-3 rounded-md shadow-md cursor-pointer" 
                        onclick="showLoginModal()">
                        Tambah Coffee Shop
                    </button>
                @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto text-center">
        <p>&copy; 2024 OurWorkspace. All rights reserved.</p>
            <div class="mt-4">
                <a href="#" class="text-yellow-500 hover:text-yellow-400 mx-2">Privacy Policy</a> |
                <a href="#" class="text-yellow-500 hover:text-yellow-400 mx-2">Terms of Service</a>
            </div>
        </div>
    </footer>

    <!-- Modal Script -->
    <script>
        // Open the modal
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        // Close the modal
        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session("success") }}',
                timer: 3000,
                showConfirmButton: true,  // Show the confirm button
                confirmButtonText: 'OK'   // Text for the button
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session("error") }}',
                timer: 3000,
                showConfirmButton: true,  // Show the confirm button
                confirmButtonText: 'Retry' // Text for the button
            });
        </script>
    @endif

    <!-- Tambah Toko -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showLoginModal() {
        Swal.fire({
            title: 'Silakan Login',
            text: "Anda harus login terlebih dahulu untuk menambahkan Coffee Shop.",
            icon: 'warning',
            cancelButtonText: 'Batal',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                // Trigger event custom Alpine.js
                window.dispatchEvent(new CustomEvent('open-login'));
            }
        });
    }


        function openModal() {
            // Fungsi untuk membuka modal jika user sudah login
            document.getElementById('modal').classList.remove('hidden');
        }
    </script>

@endsection