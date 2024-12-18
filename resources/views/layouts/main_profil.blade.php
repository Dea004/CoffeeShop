<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Our Workspace')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #814e2b;
            --secondary: #593b1f;
            --bg-light: #fff8f0;
            --text-light: #fff;
            --text-dark: #593b1f;
            --border: #e0e0e0;
        }
    </style>
</head>
<body class="bg-[#fff8f0] font-poppins">
    <!-- Sidebar -->
    <aside class="sidebar fixed top-0 left-0 bottom-0 w-[116px] h-screen p-[1.7rem] bg-[#734424] text-[#fff8f0] transition-all duration-500 ease-in-out lg:w-[240px] hover:w-[240px]">
        <div class="logo mb-6">
            <img src="{{ asset('img/Logo nobg.png') }}" alt="Logo" class="w-[60%]">
        </div>
        <ul class="menu h-[88%] relative space-y-4">
            <li class="hover:bg-[#814e2b] rounded-lg">
                <a href="{{ url('profile') }}" class="flex items-center space-x-3 text-sm">
                    <i class='bx bx-user'></i><span>Profil</span>
                </a>
            </li>
            <li class="hover:bg-[#814e2b] rounded-lg">
                <a href="{{ route('booking.manajemen') }}" class="flex items-center space-x-3 text-sm">
                    <i class='bx bx-calendar-check'></i><span>Booking Management</span>
                </a>
            </li>
            <li class="hover:bg-[#814e2b] rounded-lg">
                <a href="{{ url('/favorite') }}" class="flex items-center space-x-3 text-sm">
                    <i class='bx bxs-bookmark-heart'></i><span>Daftar Favorite</span>
                </a>
            </li>
            <li class="hover:bg-[#814e2b] rounded-lg">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3 text-sm">
                        <i class='bx bx-star'></i><span>Dashboard</span>
                    </a>
                </li>
            <li class="absolute bottom-0 w-full hover:bg-[#814e2b] rounded-lg">
                <a href="{{ url('/dashboard') }}" class="flex items-center space-x-3 text-sm">
                    <i class='bx bx-log-out'></i><span>Logout</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content ml-[116px] lg:ml-[240px] p-8">
        @yield('content')
    </div>
</body>
</html>