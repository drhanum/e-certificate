<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                <div>
                    <div class="text-gray-600">
                        Halo, {{ Auth::user()->name }}
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ Auth::user()->email }}
                    </div>
                </div>

                <button id="logoutButton"
                    class="bg-red-500 text-white px-4 py-2 rounded-lg">
                    Logout
                </button>
            </div>

            <div id="logoutModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center p-4">
                <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
                    <h2 class="text-xl font-bold mb-3">Konfirmasi Logout</h2>
                    <p class="text-gray-600 mb-6">Apakah Anda yakin ingin keluar?</p>
                    <div class="flex justify-end gap-3">
                        <button id="logoutCancel"
                            class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                            Batal
                        </button>
                        <form method="POST" action="/logout" class="inline">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                                Ya, Keluar
                            </button>
                        </form>
                    </div>
                </div>
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
                    {{ $certificates->count() }}
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-gray-500">
                    Sertifikat Aktif
                </h3>

                <p class="text-3xl font-bold mt-2">
                    {{ $certificates->count() }}
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-gray-500">
                    Download
                </h3>

                <p class="text-3xl font-bold mt-2">
                    {{ $certificates->count() }}
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

            <table class="w-full rounded-lg overflow-hidden shadow">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">No</th>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Kategori</th>
                        <th class="p-3 text-left">Nomor Sertifikat</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($certificates as $certificate)

                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3">
                            {{ $loop->iteration }}
                        </td>

                        <td class="p-3 align-top">
                            <span style="white-space:normal;">
                                {!! wordwrap(e($certificate->name), 21, '<br>', true) !!}
                            </span>
                        </td>

                        <td class="p-3">
                            {{ $certificate->email }}
                        </td>

                        <td class="p-3">
                            {{ $certificate->category }}
                        </td>

                        <td class="p-3">
                            {{ $certificate->certificate_number }}
                        </td>

                        <td class="p-3 text-center">
                            <div class="flex center gap-2">
                                <a href="{{ route('certificate.detail', $certificate->id) }}"
                                   class="bg-blue-100 text-blue-600 p-2 rounded-lg hover:bg-blue-200 transition">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('certificate.download', ['id' => $certificate->id, 'format' => 'pdf']) }}"
                                   class="bg-green-100 text-green-600 rounded-lg px-3 py-2 hover:bg-green-200 transition">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>
                                <a href="{{ route('certificate.download', ['id' => $certificate->id, 'format' => 'png']) }}"
                                   class="bg-blue-100 text-blue-600 rounded-lg px-3 py-2 hover:bg-blue-200 transition">
                                    <i class="fa-solid fa-image"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="p-4 text-center">
                            Belum ada sertifikat
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

</body>
</html>
