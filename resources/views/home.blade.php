<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Sertifikat</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-100">

    <!-- Overlay -->
    <div id="overlay"
        class="fixed inset-0 bg-black/50 hidden z-40">
    </div>

    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed top-0 left-[-260px] w-64 h-full bg-white text-black z-50 transition-all duration-300">

        <div class="p-5 border-b border-gray-700 flex justify-between">
            <h2 class="font-bold">MENU</h2>

            <button id="closeBtn">
                ✕
            </button>
        </div>

        <nav class="flex flex-col h-[calc(100%-73px)]">

            <!-- Menu Utama -->
            <div class="mt-4">

                <a href="/" class="block px-5 py-3 hover:bg-blue-300">
                    Home
                </a>

                <a id="cekLink"
                href="#cek"
                class="block px-5 py-3 hover:bg-blue-300">
                    Cek Sertifikat
                </a>

                <a id="fiturLink"
                href="#fitur"
                class="block px-5 py-3 hover:bg-blue-300">
                    Details
                </a>

                <a id="hubungiLink"
                href="#hubungi-kami"
                class="block px-5 py-3 hover:bg-blue-300">
                    Hubungi Kami
                </a>

            </div>

            <!-- Menu Admin -->
            <div class="mt-auto border-t">

                <a href="/register_admin"
                class="block px-5 py-3 hover:bg-green-200">
                    Register Admin
                </a>

                <a href="/login_admin"
                class="block px-5 py-3 hover:bg-blue-300">
                    Login Admin
                </a>

            </div>

        </nav>

    </div>

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full bg-white shadow z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">

            <div class="flex items-center gap-3">
                <button id="menuBtn" class="text-xl">
                    ☰
                </button>

                <h1 class="font-bold text-lg">
                    WEBSITE E-SERTIFIKAT
                </h1>
            </div>

            <div class="flex gap-3">
                <a href="/register"
                   class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                    Sign Up
                </a>

                <a href="/login"
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Login
                </a>
            </div>

        </div>
    </nav>

    <!-- Hero Section -->
    <section class="container mx-auto px-6 pt-24 pb-12">

        <div class="grid md:grid-cols-2 gap-10 items-center">

            <div>
                <h1 class="text-5xl font-bold text-gray-800 mb-6">
                    Sistem E-Sertifikat Digital
                </h1>

                <p class="text-gray-600 text-lg mb-6">
                    Platform untuk membuat, mengelola, memverifikasi,
                    dan mengunduh sertifikat digital secara cepat dan aman.
                </p>

                <div class="flex gap-4">
                    <a href="#cek"
                       class="border border-blue-600 text-blue-600 px-6 py-3 rounded-lg">
                        Verifikasi Sertifikat
                    </a>
                </div>
                
            </div>

            <div>
                <div class="bg-white shadow-lg rounded-xl p-5">
                    <img
                        src="https://placehold.co/800x500"
                        alt="Preview Sertifikat"
                        class="rounded-lg w-full"
                    >
                </div>
            </div>

        </div>

    </section>

    <!-- Cek Sertifikat -->
    <section id="cek" class="py-16 bg-white">

        <div class="container mx-auto px-6 max-w-3xl">

            <h2 class="text-3xl font-bold text-center mb-3">
                Cek Keaslian Sertifikat
            </h2>

            <p class="text-center text-gray-500 mb-8">
                Masukkan nomor sertifikat untuk melakukan verifikasi.
            </p>

            <form class="flex flex-col md:flex-row gap-4">

                <input
                    type="text"
                    placeholder="Masukkan Nomor Sertifikat"
                    class="flex-1 border rounded-lg px-4 py-3"
                >

                <button
                    type="submit"
                    class="bg-blue-600 text-white px-8 py-3 rounded-lg">
                    CEK
                </button>

            </form>

        </div>

    </section>

    <!-- Fitur -->
    <section id="fitur" class="container mx-auto px-6 py-16">

        <h2 class="text-3xl font-bold text-center mb-10">
            Fitur Utama
        </h2>

        <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="font-bold text-xl mb-3">
                    Generate Sertifikat
                </h3>

                <p class="text-gray-600">
                    Membuat sertifikat digital secara otomatis.
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="font-bold text-xl mb-3">
                    Download PDF
                </h3>

                <p class="text-gray-600">
                    Sertifikat dapat diunduh dalam format PDF.
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="font-bold text-xl mb-3">
                    Verifikasi Online
                </h3>

                <p class="text-gray-600">
                    Cek keaslian sertifikat dengan nomor unik.
                </p>
            </div>

        </div>

    </section>

    <section class="bg-white py-16">
        <div class="container mx-auto px-6">

            <h2 class="text-3xl font-bold text-center mb-4">
                Mitra & Partner
            </h2>

            <p class="text-center text-gray-500 mb-10">
                Institusi dan organisasi yang telah bekerja sama dengan kami.
            </p>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">

                <div class="bg-gray-100 p-8 rounded-lg text-center">
                    Logo Mitra 1
                </div>

                <div class="bg-gray-100 p-8 rounded-lg text-center">
                    Logo Mitra 2
                </div>

                <div class="bg-gray-100 p-8 rounded-lg text-center">
                    Logo Mitra 3
                </div>

                <div class="bg-gray-100 p-8 rounded-lg text-center">
                    Logo Mitra 4
                </div>

            </div>

        </div>
    </section>

    <section class="py-16 bg-blue-600 text-white">
        <div class="container mx-auto px-6">

            <div class="grid md:grid-cols-4 gap-8 text-center">

                <div>
                    <h3 class="text-4xl font-bold">500+</h3>
                    <p>Sertifikat Terbit</p>
                </div>

                <div>
                    <h3 class="text-4xl font-bold">200+</h3>
                    <p>Peserta</p>
                </div>

                <div>
                    <h3 class="text-4xl font-bold">25+</h3>
                    <p>Event</p>
                </div>

                <div>
                    <h3 class="text-4xl font-bold">10+</h3>
                    <p>Mitra</p>
                </div>

            </div>

        </div>
    </section>

    <section class="py-16">
        <div class="container mx-auto px-6">

            <h2 class="text-3xl font-bold text-center mb-10">
                Testimoni Pengguna
            </h2>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-600 mb-4">
                        Sistem sangat membantu proses distribusi sertifikat.
                    </p>

                    <h4 class="font-semibold">
                        BEM Matana
                    </h4>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-600 mb-4">
                        Verifikasi sertifikat menjadi lebih mudah dan cepat.
                    </p>

                    <h4 class="font-semibold">
                        HIMTI
                    </h4>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-600 mb-4">
                        Tampilan modern dan mudah digunakan.
                    </p>

                    <h4 class="font-semibold">
                        Peserta Seminar
                    </h4>
                </div>

            </div>

        </div>
    </section>

    <section id="hubungi-kami" class="bg-white py-16">
        <div class="container mx-auto px-6">

            <h2 class="text-3xl font-bold text-center mb-4">
                Hubungi Kami
            </h2>

            <p class="text-center text-gray-500 mb-10">
                Jika memiliki pertanyaan atau kendala terkait sertifikat, silakan hubungi kami.
            </p>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="bg-gray-50 p-6 rounded-xl shadow text-center">
                    <h3 class="font-bold text-xl mb-3">
                        Email
                    </h3>

                    <p class="text-gray-600">
                        info@esertifikat.com
                    </p>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl shadow text-center">
                    <h3 class="font-bold text-xl mb-3">
                        Telepon
                    </h3>

                    <p class="text-gray-600">
                        +62 812-3456-7890
                    </p>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl shadow text-center">
                    <h3 class="font-bold text-xl mb-3">
                        Alamat
                    </h3>

                    <p class="text-gray-600">
                        Tangerang, Banten, Indonesia
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6 text-center">
        © 2026 Website E-Sertifikat
    </footer>

</body>
</html>