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
        class="fixed top-0 left-[-260px] w-64 h-full bg-white text-black z-50 transition-all duration-300 flex flex-col">

        <div class="p-5 border-b border-gray-700">
            <h2 class="text-xl font-bold">
                CERTANA
            </h2>
        </div>

        <nav class="mt-5 flex-1 space-y-2 px-4">

            <a href="/"
               class="inline-flex w-56 h-12 items-center justify-center rounded-xl bg-gray-100 text-center hover:bg-blue-600 hover:text-white transition">
                Home
            </a>

            <a id="cekLink" href="#cek"
               class="inline-flex w-56 h-12 items-center justify-center rounded-xl bg-gray-100 text-center hover:bg-blue-600 hover:text-white transition">
                Cek Sertifikat
            </a>

            <a id="fiturLink" href="#fitur"
               class="inline-flex w-56 h-12 items-center justify-center rounded-xl bg-gray-100 text-center hover:bg-blue-600 hover:text-white transition">
                Details
            </a>

            <a id="hubungiLink" href="#hubungi-kami"
               class="inline-flex w-56 h-12 items-center justify-center rounded-xl bg-gray-100 text-center hover:bg-blue-600 hover:text-white transition">
                Hubungi Kami
            </a>

        </nav>

        <div class="space-y-2 p-4 border-t">

            <a href="/register_admin"
               class="inline-flex w-56 h-12 items-center justify-center rounded-xl bg-green-100 text-center hover:bg-green-600 hover:text-white transition">
                Register Admin
            </a>

            <a href="/login_admin"
               class="inline-flex w-56 h-12 items-center justify-center rounded-xl bg-gray-100 text-center hover:bg-blue-600 hover:text-white transition">
                Login Admin
            </a>

        </div>

    </div>

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full bg-white shadow z-40">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">

            <div class="flex items-center gap-3">
                <button id="menuBtn" class="text-xl">
                    ☰
                </button>

                <h1 class="font-bold text-lg">
                    Certana - Certificate Matana University
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

    <!-- Main Content -->
    <main class="pt-24">

        <!-- Hero Section -->
        <section class="container mx-auto px-6 py-12">

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
                            src="{{ asset('assets/temp-sertif-prisma.png') }}"
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

            <form id="certificateCheckForm" class="flex flex-col md:flex-row gap-4" onsubmit="return false;">

                <input
                    id="certificateNumberInput"
                    type="text"
                    placeholder="Masukkan Nomor Sertifikat"
                    class="flex-1 border rounded-lg px-4 py-3"
                >

                <button
                    id="certificateCheckBtn"
                    type="button"
                    class="bg-blue-600 text-white px-8 py-3 rounded-lg">
                    CEK
                </button>

            </form>

            <!-- Verification Modal -->
            <div id="verifyModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center p-4 z-50">
                <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 id="verifyTitle" class="text-xl font-bold">Hasil Verifikasi</h3>
                        <button id="verifyClose" class="text-gray-600 hover:text-gray-800">✕</button>
                    </div>

                    <div id="verifyContent">
                        <!-- Filled by JS -->
                    </div>

                    <div class="mt-6 text-right">
                        <!-- <a id="verifyDownload" href="#" class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 hidden">Download PDF</a> -->
                        <button id="verifyCloseBtn" class="ml-2 px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">Tutup</button>
                    </div>
                </div>
            </div>

            <script>
                (function () {
                    const btn = document.getElementById('certificateCheckBtn');
                    const input = document.getElementById('certificateNumberInput');
                    const modal = document.getElementById('verifyModal');
                    const content = document.getElementById('verifyContent');
                    const close = document.getElementById('verifyClose');
                    const closeBtn = document.getElementById('verifyCloseBtn');
                    // const downloadBtn = document.getElementById('verifyDownload');

                    function showModal() {
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                    }

                    function hideModal() {
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    }

                    function formatDate(d) {
                        if (!d) return '-';
                        const dt = new Date(d);
                        return dt.toLocaleDateString();
                    }

                    btn.addEventListener('click', function () {
                        const number = input.value.trim();
                        if (!number) return alert('Masukkan nomor sertifikat.');

                        fetch(`/certificate/check/${encodeURIComponent(number)}`)
                            .then(r => r.json())
                            .then(data => {
                                if (!data.found) {
                                    content.innerHTML = `<p class="text-red-600 font-semibold">Nomor sertifikat tidak terdaftar.</p>`;
                                    downloadBtn.classList.add('hidden');
                                    showModal();
                                    return;
                                }

                                const c = data.certificate;

                                content.innerHTML = `
                                    <div class="grid lg:grid-cols-2 gap-4">
                                        <div class="bg-gray-50 p-4 rounded">
                                            <h4 class="font-semibold mb-2">Data Event</h4>
                                            <p><strong>Nama Event:</strong> ${c.event_name}</p>
                                            <p><strong>Penyelenggara:</strong> ${c.organizer_name}</p>
                                            <p><strong>Tanggal Event:</strong> ${formatDate(c.event_date)}</p>
                                            <p><strong>Tanggal Terbit:</strong> ${formatDate(c.certificate_issue_date)}</p>
                                            <p><strong>Masa Aktif:</strong> ${c.valid_until ? formatDate(c.valid_until) : '-'}</p>
                                        </div>
                                        <div class="bg-gray-50 p-4 rounded">
                                            <h4 class="font-semibold mb-2">Data Peserta</h4>
                                            <p><strong>Nama:</strong> ${c.name}</p>
                                            <p><strong>Email:</strong> ${c.email}</p>
                                            <p><strong>Kategori:</strong> ${c.category}</p>
                                            <p><strong>Nomor Sertifikat:</strong> ${c.certificate_number}</p>
                                        </div>
                                    </div>
                                `;

                                    // downloadBtn.href = `/certificate/download/${c.id}`;
                                    // downloadBtn.classList.remove('hidden');
                                    showModal();
                            })
                            .catch(err => {
                                console.error(err);
                                alert('Terjadi kesalahan saat memeriksa sertifikat.');
                            });
                    });

                    close.addEventListener('click', hideModal);
                    closeBtn.addEventListener('click', hideModal);

                    // close when clicking outside
                    modal.addEventListener('click', function (e) {
                        if (e.target === modal) hideModal();
                    });
                })();
            </script>

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
                    <img src="{{ asset('assets/HMIF_Logo.png') }}" alt="Logo Mitra 1" class="mx-auto">
                </div>

                <div class="bg-gray-100 p-8 rounded-lg text-center">
                    <img src="{{ asset('assets/Logo_Creative.png') }}" alt="Logo Mitra 2" class="mx-auto">
                </div>

                <div class="bg-gray-100 p-8 rounded-lg text-center">
                    <img src="{{ asset('assets/Logo_Informatika.png') }}" alt="Logo Mitra 3" class="mx-auto">
                </div>

                <div class="bg-gray-100 p-8 rounded-lg text-center">
                    <img src="{{ asset('assets/logo_matana.png') }}" alt="Logo Mitra 4" class="mx-auto">
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

    </main>

</body>
</html>