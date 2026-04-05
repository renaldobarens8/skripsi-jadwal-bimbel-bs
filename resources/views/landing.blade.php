<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BS Learning Center - Bimbingan Belajar Les Terbaik</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Inter Font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <style>
        /* Custom styles using Inter font */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc; /* Tailwind slate-50 */
        }
        /* Custom accent color for buttons and highlights */
        .accent-blue {
            background-color: #3b82f6; /* Blue 500 */
        }
        .accent-blue:hover {
            background-color: #2563eb; /* Blue 600 */
        }
        /* Custom shadow for card effects */
        .custom-shadow {
            box-shadow: 0 15px 30px -10px rgba(23, 75, 127, 0.1);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <!-- Header & Navigation -->
    <header class="bg-white custom-shadow sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <!-- Logo/Title -->
            <div class="flex items-center space-x-2">
                <!-- Simple educational icon using SVG -->
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.47 9.282 5 7.5 5S4.168 5.47 3 6.253v13C4.168 18.47 5.718 18 7.5 18s3.332.47 4.5 1.253m0-13C13.168 5.47 14.718 5 16.5 5s3.332.47 4.5 1.253v13C19.832 18.47 18.282 18 16.5 18s-3.332.47-4.5 1.253"></path></svg>
                <h1 class="text-2xl font-extrabold text-gray-800 tracking-tight">
                    BS Learning Center 
                    {{-- <span class="text-blue-600">Ilmu</span> --}}
                </h1>
            </div>

            <!-- Login and Register Links (Integrated with Blade/Laravel Routes) -->
            <div class="space-x-4 flex items-center">
                <!-- Login Link with Blade Route -->
                <a href="{{ route('login') }}" id="login-btn" class="text-gray-600 font-medium hover:text-blue-600 transition duration-150 ease-in-out px-3 py-2">
                    Login
                </a>
                <!-- Register Link with Blade Route (Accent style) -->
                <a href="{{ route('register') }}" id="register-btn" class="accent-blue text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                    Register Now
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content: Hero Section -->
    <main class="flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="lg:flex lg:items-center lg:justify-between">
                <!-- Text Content -->
                <div class="lg:w-1/2">
                    <span class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                        Bimbingan Belajar Premium
                    </span>
                    <h2 class="mt-4 text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
                        Raih Potensi Akademik <span class="text-blue-600">Maksimal</span>
                    </h2>
                    <p class="mt-6 text-lg text-gray-600 max-w-lg">
                        Sinar Ilmu menyediakan les privat dan kelompok kecil dengan pengajar terbaik. Kami fokus pada pemahaman mendalam, bukan sekadar nilai ujian.
                    </p>

                    <div class="mt-10 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6">
                        <!-- Main Call to Action (Register) using Blade Route -->
                        <a href="{{ route('register') }}" id="cta-register-btn" class="flex items-center justify-center accent-blue text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 ease-in-out transform hover:-translate-y-1">
                            Mulai Belajar Sekarang
                        </a>

                        <!-- WhatsApp Link -->
                        <a href="https://wa.me/6281234567890" target="_blank" class="flex items-center justify-center space-x-2 bg-white text-green-600 font-semibold py-3 px-8 rounded-xl border border-green-600 shadow-md hover:bg-green-50 hover:border-green-700 transition duration-300 ease-in-out transform hover:scale-[1.02]">
                            <!-- WhatsApp Icon SVG -->
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.68 2.58 15.34 3.4 16.82L2.3 21.78L7.33 20.47C8.75 21.23 10.37 21.64 12.04 21.64C17.5 21.64 21.95 17.19 21.95 11.73C21.95 6.27 17.5 2 12.04 2ZM17.15 15.65C16.92 16.14 14.88 17.12 14.56 17.19C14.23 17.26 14.03 17.3 13.79 17.2C13.56 17.11 12.83 16.87 11.92 16.11C10.99 15.35 10.34 14.47 9.85 13.82C9.36 13.17 9.07 12.44 9.4 12.11C9.65 11.87 10.04 11.45 10.29 11.16C10.53 10.87 10.56 10.66 10.74 10.37C10.92 10.08 11.0 9.95 11.13 9.69C11.26 9.43 11.23 9.21 11.16 8.97C11.1 8.74 10.71 7.74 10.55 7.42C10.4 7.1 10.24 7.15 10.09 7.15C9.93 7.15 9.77 7.15 9.61 7.15C9.44 7.15 9.17 7.15 8.91 7.51C8.65 7.87 7.95 8.51 7.95 9.94C7.95 11.37 8.97 12.76 9.12 12.98C9.27 13.2 11.08 16.03 13.8 17.27C14.46 17.58 14.97 17.74 15.35 17.86C15.73 17.98 16.32 17.93 16.75 17.87C17.18 17.8 18.06 17.38 18.23 16.81C18.4 16.24 18.4 15.76 18.33 15.65C18.26 15.55 17.38 15.28 17.15 15.65Z"/></svg>
                            Hubungi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Features Section (Adding depth and professionalism) -->
    <section class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-900">Mengapa Memilih Sinar Ilmu?</h3>
                <p class="mt-3 text-lg text-gray-600">Fokus kami adalah pada kualitas pengajaran dan hasil nyata siswa.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1: Pengajar Terbaik -->
                <div class="bg-white p-6 rounded-xl custom-shadow hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-600 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.828-1.22l-1.045 1.045C16.84 18.995 17.2 19 17.5 19h1.5zm-3-4a1.5 1.5 0 00-1.5 1.5c0 .828.672 1.5 1.5 1.5.828 0 1.5-.672 1.5-1.5 0-.828-.672-1.5-1.5-1.5zM12 4a4 4 0 100 8 4 4 0 000-8zM4 14a4 4 0 100 8 4 4 0 000-8z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Pengajar Berpengalaman</h4>
                    <p class="text-gray-500 text-sm">Lulusan universitas ternama, berdedikasi tinggi, dan menguasai materi secara mendalam.</p>
                </div>

                <!-- Feature 2: Kurikulum Adaptif -->
                <div class="bg-white p-6 rounded-xl custom-shadow hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-600 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Kurikulum Personal</h4>
                    <p class="text-gray-500 text-sm">Materi disesuaikan dengan kebutuhan dan gaya belajar unik setiap siswa.</p>
                </div>

                <!-- Feature 3: Laporan Perkembangan -->
                <div class="bg-white p-6 rounded-xl custom-shadow hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-600 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0h6"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Monitor Kemajuan</h4>
                    <p class="text-gray-500 text-sm">Laporan perkembangan berkala untuk orang tua dan siswa agar tetap pada jalur kesuksesan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center">
            <p class="text-gray-400 text-sm">&copy; 2024 BS Learning Center. Bimbingan Belajar. All rights reserved.</p>
            {{-- <div class="mt-4 space-x-4">
                <a href="#" class="text-gray-400 hover:text-blue-400 transition">Kebijakan Privasi</a>
                <a href="#" class="text-gray-400 hover:text-blue-400 transition">Syarat & Ketentuan</a>
            </div> --}}
        </div>
    </footer>

    <!-- JavaScript for Button Interaction (Custom Alert utility kept, but navigation handlers removed) -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // NOTE: The click listeners for login-btn, register-btn, and cta-register-btn 
            // were removed because they are now <a> tags using the Blade route function 
            // (e.g., href="{{ route('login') }}"), which handles navigation directly.

            // 3. Custom Alert/Message Box (Replaces alert() and confirm())
            function alertMessage(message) {
                const messageBox = document.createElement('div');
                messageBox.className = 'fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300';
                messageBox.innerHTML = `
                    <div class="bg-white p-8 rounded-xl shadow-2xl max-w-sm w-full transform transition-all duration-300 scale-100">
                        <p class="text-lg font-semibold text-gray-800 mb-4">${message}</p>
                        <button id="close-msg" class="w-full accent-blue text-white font-bold py-2 rounded-lg">
                            OK
                        </button>
                    </div>
                `;
                document.body.appendChild(messageBox);
                
                // Close functionality
                document.getElementById('close-msg').addEventListener('click', () => {
                    messageBox.remove();
                });

                // Optional: Auto-remove after 3 seconds
                setTimeout(() => {
                    if (messageBox.parentNode) {
                        messageBox.remove();
                    }
                }, 3000);
            }
        });
    </script>
</body>
</html>
