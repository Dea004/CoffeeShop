@extends('layouts.main')

@section('contents')

    <div class="w-full max-w-3xl mx-auto p-5">
        <!-- Carousel Section -->
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <div class="relative">
            @if($coffeeShop->profile_picture)
                <img class="w-full h-96 object-cover" src="{{ asset('storage/' . $coffeeShop->profile_picture) }}" alt="{{ $coffeeShop->shop_name }}">
            @else
                <img class="w-full h-96 object-cover" src="path/to/default-image.jpg" alt="Gambar Default">
            @endif
            <div class="absolute bottom-0 bg-gradient-to-t from-gray-500 to-transparent text-white p-4">
                <h1 class="text-5xl font-bold">{{ $coffeeShop->shop_name }}</h1>
                <p class="text-lg font-medium">{{ $coffeeShop->category }}</p>
            </div>
        </div>
        

        <div class="container mx-auto mt-8 px-4">
            <div class="flex gap-6">
                <!-- Jam Operasional -->
                <div class="bg-white p-6 shadow-md rounded-md w-1/3">
                    <h3 class="text-xl font-semibold mb-4"><i class="fas fa-clock"></i> Jam Operasional</h3>
                    <p><strong> Senin - Sabtu:</strong> </p>
                    <p>{{ \Carbon\Carbon::parse($coffeeShop->opening_hour)->format('H:i') }} - {{ \Carbon\Carbon::parse($coffeeShop->closing_hour)->format('H:i') }} WITA</p>
                </div>

                <!-- Fasilitas -->
                <div class="bg-white p-6 shadow-md rounded-md w-1/3">
                    <h3 class="text-xl font-semibold mb-4"><i class="fas fa-globe"></i> Fasilitas</h3>
                    <ul>
                        <li class="flex items-center"><i class="fas fa-wifi mr-2"></i> WiFi Gratis</li>
                        <li class="flex items-center"><i class="fas fa-toilet mr-2"></i> Toilet yang Nyaman</li>
                        <li class="flex items-center"><i class="fas fa-parking mr-2"></i> Parkir Gratis</li>
                        <li class="flex items-center"><i class="fa-solid fa-calendar-days mr-2"></i> Bisa Reservasi</li>
                        <li class="flex items-center"><i class="fa-solid fa-tree mr-2"></i> Tempat duduk area terbuka</li>
                    </ul>
                </div>

                <!-- Menu -->
                <div class="bg-white p-6 shadow-md rounded-md w-1/3">
                    <h3 class="text-xl font-semibold mb-4"><i class="fas fa-mug-hot"></i> Menu</h3>
                    <p>Nikmati Hidangan Mulai dari <strong>Rp16.000</strong></p>
                </div>
            </div>
        </div>

        <!-- Peta -->
        <div class="mb-4 w-full">
            <h3 class="text-xl font-semibold mb-5 mt-5"><i class="fas fa-map-marker-alt"></i> Peta Lokasi</h3>
            <iframe src="{{ $coffeeShop->google_maps_link }}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <!-- rating -->
        <div class="mb-4">
            <h3 class="text-xl font-semibold mb-2"><i class="fas fa-star"></i> Beri Rating</h3>
            <div class="flex space-x-1 star-rating">
                <span class="star" data-value="1"><i class="fas fa-star"></i></span>
                <span class="star" data-value="2"><i class="fas fa-star"></i></span>
                <span class="star" data-value="3"><i class="fas fa-star"></i></span>
                <span class="star" data-value="4"><i class="fas fa-star"></i></span>
                <span class="star" data-value="5"><i class="fas fa-star"></i></span>
            </div>
            <button type="button" class="mt-2 px-4 py-2 bg-blue-500 text-white font-semibold rounded-md" onclick="submitRating()">Submit Rating</button>
            <p id="currentRating" class="mt-3 text-gray-600"></p>
        </div>

        <!-- Review Section -->
        <div class="mt-10">
            <h3 class="text-xl font-semibold mb-4"><i class="fas fa-pen"></i> Ulasan</h3>
            <div class="flex items-start mb-4">
                <div>
                    <p><strong>Budi:</strong> "Tempatnya nyaman dan kopinya enak!"</p>
            </div>
        </div>

        <!-- Input for New Review -->
        <div>
            <textarea id="newReview" class="w-full p-4 border rounded-md" placeholder="Tulis ulasan Anda di sini..."></textarea>
            <button type="button" class="mt-2 px-4 py-2 bg-green-500 text-white font-semibold rounded-md" onclick="submitReview()">Submit Ulasan</button>
        </div>
    </div>
    <!-- SweetAlert Notification -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}", 
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <!-- Button -->
    <div class="flex justify-between items-center mt-10">
        <!-- Tombol Tambah ke Favorite -->
        <form action="{{ route('coffee-shop.favorite', ['id' => $coffeeShop->id_shop]) }}" method="POST">
            @csrf
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Tambah ke Favorite</button>
        </form>

        
        <!-- Tombol Booking dengan Laravel Route -->
        <a href="{{ url('/booking') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Booking Now</a>
        
        <!-- Tombol Previous -->
        <button class="bg-gray-500 text-white px-4 py-2 rounded" onclick="history.back()">Previous</button>
    </div>


    <script>
    let totalRatings = 0;
    let numberOfRatings = 0;
    let ratingValue;

    // Load previous ratings from localStorage
    function loadRatings() {
        const averageRating = localStorage.getItem('averageRating');
        const count = localStorage.getItem('numberOfRatings');

        if (averageRating && count) {
            numberOfRatings = parseInt(count);
            totalRatings = parseFloat(averageRating) * numberOfRatings;
            document.getElementById('currentRating').textContent = `Rata-rata rating: ${averageRating}/5 (${numberOfRatings} ulasan)`;
        }
    }

    // bintang ketika di klik
    const stars = document.querySelectorAll('.star');
    stars.forEach(star => {
        star.addEventListener('click', () => {
            ratingValue = star.getAttribute('data-value');
            highlightStars(ratingValue);
        });
    });

    function highlightStars(rating) {
        stars.forEach(star => {
            star.classList.remove('highlight');
            if (star.getAttribute('data-value') <= rating) {
                star.classList.add('highlight');
            }
        });
    }

    // Submit rating
    function submitRating() {
        if (ratingValue) {
            totalRatings += parseInt(ratingValue);
            numberOfRatings++;
            const averageRating = (totalRatings / numberOfRatings).toFixed(1);
            document.getElementById('currentRating').textContent = `Rata-rata rating: ${averageRating}/5 (${numberOfRatings} ulasan)`;
            saveRating(averageRating, numberOfRatings);
            Swal.fire("Rating ditambahkan!");
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Silakan pilih rating sebelum mengirim.',
            });
        }
    }

    function saveRating(averageRating, count) {
        localStorage.setItem('averageRating', averageRating);
        localStorage.setItem('numberOfRatings', count);
    }

    // Review functionality
    function submitReview() {
        const reviewText = document.getElementById('newReview').value;
        if (reviewText) {
            const reviewContainer = document.createElement('div');
            reviewContainer.classList.add('flex', 'items-start', 'mb-4');
            reviewContainer.innerHTML = `
                <img src="/img/logo1.png" alt="User" class="w-12 h-12 rounded-full mr-4">
                <div>
                    <p><strong>User:</strong> "${reviewText}"</p>
                </div>
            `;
            document.querySelector('.mt-10').appendChild(reviewContainer);
            document.getElementById('newReview').value = '';
            Swal.fire("Ulasan ditambahkan!");
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Silakan tulis ulasan sebelum mengirim.',
            });
        }
    }

    window.onload = loadRatings;


    // cek jam operasional
    function cekJamOperasional() {
    const sekarang = new Date();
    const hariSekarang = sekarang.getDay(); // 
    const jamSekarang = sekarang.getHours();
    // Update pesan operasional
    const pesanOperasional = document.getElementById('pesanOperasional');
    if (jamSekarang >= jamBuka && jamSekarang < jamTutup) {
        pesanOperasional.textContent = "Tujuh Dua Coffee sedang BUKA";
        pesanOperasional.classList.add('text-green-500');
        pesanOperasional.classList.remove('text-red-500');
    } else {
        pesanOperasional.textContent = "Tujuh Dua Coffee sedang TUTUP";
        pesanOperasional.classList.add('text-red-500');
        pesanOperasional.classList.remove('text-green-500');
    }
    }

    // Jalankan fungsi saat halaman dimuat
    window.onload = cekJamOperasional;

    </script>

    <style>
    .star {
        font-size: 30px;
        cursor: pointer;
        color: gray; 
    }

    .star.highlight {
        color: gold; 
    }
    </style>
    
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
@endsection

