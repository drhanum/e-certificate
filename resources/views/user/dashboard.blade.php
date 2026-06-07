<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>

    @vite(['resources/css/app.css'])
    @php
    use Illuminate\Support\Facades\Auth;
    @endphp

</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between">

            <h1 class="font-bold text-xl">
                E-Sertifikat
            </h1>

            <div class="flex items-center gap-4">
                <span class="text-gray-600">
                    Halo, {{ Auth::user()->name }}
                </span>

                <a href="/"
                   class="bg-red-500 text-white px-4 py-2 rounded-lg">
                    Logout
                </a>
            </div>

        </div>
    </nav>

    <!-- Header -->
    <section class="container mx-auto px-6 py-8">

        <div class="bg-blue-600 text-white rounded-xl p-8 shadow">

            <h2 class="text-3xl font-bold mb-2">
                Selamat Datang, {{ Auth::user()->name }}
            </h2>

            <p>
                Kelola dan unduh sertifikat digital Anda dengan mudah.
            </p>

        </div>

    </section>

    <!-- Statistik -->
    <section class="container mx-auto px-6">

        <div class="grid md:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-gray-500">
                    Total Sertifikat
                </h3>

                <p class="text-3xl font-bold mt-2">
                    5
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-gray-500">
                    Sertifikat Aktif
                </h3>

                <p class="text-3xl font-bold mt-2">
                    5
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-gray-500">
                    Download
                </h3>

                <p class="text-3xl font-bold mt-2">
                    12
                </p>
            </div>

        </div>

    </section>

    <!-- Sertifikat -->
    <section class="container mx-auto px-6 py-10">

        <div class="bg-white rounded-xl shadow p-6">

            <h2 class="text-2xl font-bold mb-5">
                Sertifikat Saya
            </h2>

            <table class="w-full border">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border">No</th>
                        <th class="p-3 border">Nama Sertifikat</th>
                        <th class="p-3 border">Tanggal</th>
                        <th class="p-3 border">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td class="p-3 border">1</td>
                        <td class="p-3 border">
                            Seminar Teknologi AI
                        </td>
                        <td class="p-3 border">
                            01 Juni 2026
                        </td>
                        <td class="p-3 border">

                            <button
                                class="bg-green-600 text-white px-4 py-2 rounded">
                                Download
                            </button>

                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </section>

</body>
</html>