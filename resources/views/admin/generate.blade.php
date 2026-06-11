<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Sertifikat</title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

</head>
<body class="bg-gray-100">

<div class="flex">

    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-white text-black fixed">

        <div class="p-5 border-b border-gray-700">
            <h2 class="text-xl font-bold">
                E-SERTIFIKAT ADMIN
            </h2>
        </div>

        <nav class="mt-5 flex-1 space-y-2 px-4">
            <a href="/admin/dashboard" class="inline-flex w-56 h-12 items-center justify-center rounded-xl bg-gray-100 text-center hover:bg-blue-600 hover:text-white transition">
                Dashboard
            </a>

            <a href="/admin/generate" class="inline-flex w-56 h-12 items-center justify-center rounded-xl bg-blue-600 text-white text-center transition">
                Generate Sertifikat
            </a>

            <a href="/admin/sertifikat" class="inline-flex w-56 h-12 items-center justify-center rounded-xl bg-gray-100 text-center hover:bg-blue-600 hover:text-white transition">
                Data Sertifikat
            </a>
        </nav>

    </aside>

    <!-- Content -->
    <main class="ml-64 p-8 w-full">

        <div class="bg-white rounded-xl shadow p-8">

            <h1 class="text-2xl font-bold mb-6">
                Generate E-Sertifikat
            </h1>

            <form action="/admin/generate" method="POST" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="mb-4 rounded-lg bg-red-100 border border-red-300 text-red-700 p-4">
                        <p class="font-semibold mb-2">Perbaiki beberapa field berikut:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Informasi Event -->

                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label class="block mb-2 font-medium">
                            Nama Event
                        </label>

                        <input
                            type="text"
                            name="event_name"
                            value="{{ old('event_name') }}"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                        @error('event_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Nama Penyelenggara
                        </label>

                        <input
                            type="text"
                            name="organizer_name"
                            value="{{ old('organizer_name') }}"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                        @error('organizer_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Jenis Kegiatan
                        </label>

                        <select
                            name="activity_type"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                            <option value="">Pilih jenis kegiatan</option>
                            <option value="Seminar" {{ old('activity_type') == 'Seminar' ? 'selected' : '' }}>Seminar/Webinar</option>
                            <option value="Pelatihan" {{ old('activity_type') == 'Pelatihan' ? 'selected' : '' }}>Pelatihan</option>
                            <option value="Lomba" {{ old('activity_type') == 'Lomba' ? 'selected' : '' }}>Lomba</option>
                            <option value="Organisasi" {{ old('activity_type') == 'Organisasi' ? 'selected' : '' }}>Organisasi</option>

                        </select>

                        @error('activity_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Tanggal Event
                        </label>

                        <input
                            type="date"
                            name="event_date"
                            value="{{ old('event_date') }}"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                        @error('event_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Tanggal Terbit Sertifikat
                        </label>

                        <input
                            type="date"
                            name="certificate_issue_date"
                            value="{{ old('certificate_issue_date') }}"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                        @error('certificate_issue_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Prefix Nomor Sertifikat
                        </label>

                        <input
                            type="text"
                            name="certificate_prefix"
                            value="{{ old('certificate_prefix', 'CERT') }}"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                        <p class="text-sm text-gray-500 mt-1">
                            Contoh: CERT, SCT, ACME. Bagian awal sebelum tahun dan angka.
                        </p>

                        @error('certificate_prefix')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Inisiasi Nomor Sertifikat
                        </label>

                        <input
                            type="number"
                            name="certificate_start_number"
                            value="{{ old('certificate_start_number', 1) }}"
                            min="1"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                        <p class="text-sm text-gray-500 mt-1">
                            Nomor pertama untuk batch sertifikat ini.
                        </p>

                        @error('certificate_start_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Masa Aktif (Opsional)
                        </label>

                        <input
                            type="date"
                            name="valid_until"
                            class="w-full border rounded-lg px-4 py-2">
                    </div>

                </div>

                <!-- Upload Template -->

                <div class="mt-6">

                    <label class="block mb-2 font-medium">
                        Template Sertifikat
                    </label>

                    <div class="relative">
                        <input
                            id="templateInput"
                            type="file"
                            name="template"
                            accept=".png,.jpg,.jpeg"
                            required
                            class="w-full border p-3 rounded-lg">

                        <button
                            type="button"
                            data-clear-target="#templateInput"
                            class="absolute right-3 top-2 rounded-full bg-gray-200 px-2 py-1 text-gray-600 hover:bg-gray-300">
                            ×
                        </button>
                    </div>

                    @error('template')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                </div>

                <div class="mt-8">

                    <h3 class="font-semibold mb-3">
                        Atur Posisi Teks Sertifikat
                    </h3>

                    <div
                        id="certificate-preview"
                        class="relative border rounded-lg overflow-hidden bg-gray-100">

                        <img
                            id="template-preview"
                            src=""
                            class="w-full">

                        <div
                            id="drag-name"
                            class="absolute cursor-move font-bold text-3xl text-blue-600"
                            style="top:250px; left:300px; transform: translateX(-50%);">

                            NAMA PESERTA

                        </div>

                        <div
                            id="drag-category"
                            class="absolute cursor-move font-bold text-xl text-green-600"
                            style="top:320px; left:50%; transform: translateX(-50%);">

                            Kategori

                        </div>

                        <div
                            id="drag-number"
                            class="absolute cursor-move text-sm text-red-600"
                            style="top:180px; left:50%; transform: translateX(-50%);">

                            Nomor Sertifikat

                        </div>

                    </div>

                </div>

                <div class="mt-6 grid grid-cols-3 gap-4">

                <div class="border rounded-lg p-4">

                    <h4 class="font-semibold mb-3">
                        Nama Peserta
                    </h4>

                    <label>Warna</label>

                    <input
                        type="color"
                        id="name_color"
                        value="#000000"
                        class="w-full h-10">

                    <label class="mt-3 block">
                        Ukuran
                    </label>

                    <input
                        type="number"
                        id="name_size"
                        value="36"
                        class="w-full border rounded p-2">

                </div>

                <div class="border rounded-lg p-4">

                    <h4 class="font-semibold mb-3">
                        Kategori
                    </h4>

                    <label>Warna</label>

                    <input
                        type="color"
                        id="category_color"
                        value="#000000"
                        class="w-full h-10">

                    <label class="mt-3 block">
                        Ukuran
                    </label>

                    <input
                        type="number"
                        id="category_size"
                        value="24"
                        class="w-full border rounded p-2">

                </div>

                <div class="border rounded-lg p-4">

                    <h4 class="font-semibold mb-3">
                        Nomor Sertifikat
                    </h4>

                    <label>Warna</label>

                    <input
                        type="color"
                        id="number_color"
                        value="#000000"
                        class="w-full h-10">

                    <label class="mt-3 block">
                        Ukuran
                    </label>

                    <input
                        type="number"
                        id="number_size"
                        value="18"
                        class="w-full border rounded p-2">

                </div>

            </div>

                <!-- Upload Excel -->

                <div class="mt-6">

                    <label class="block mb-2 font-medium">
                        Upload Excel Peserta
                    </label>

                    <div class="relative">
                        <input
                            id="excelInput"
                            type="file"
                            name="excel"
                            accept=".xlsx,.xls"
                            required
                            class="w-full border p-3 rounded-lg">

                        <button
                            type="button"
                            data-clear-target="#excelInput"
                            class="absolute right-3 top-2 rounded-full bg-gray-200 px-2 py-1 text-gray-600 hover:bg-gray-300">
                            ×
                        </button>
                    </div>

                    @error('excel')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Format Excel -->

                <div class="mt-6 bg-gray-50 p-4 rounded-lg">

                    <h3 class="font-semibold mb-3">
                        Format Excel
                    </h3>

                    <table class="w-full border">

                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border p-2">Nama Peserta</th>
                                <th class="border p-2">Email</th>
                                <th class="border p-2">Kategori</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="border p-2">Dwi Riani Hanum</td>
                                <td class="border p-2">dwi@gmail.com</td>
                                <td class="border p-2">Peserta</td>
                            </tr>

                            <tr>
                                <td class="border p-2">Imel</td>
                                <td class="border p-2">imel@gmail.com</td>
                                <td class="border p-2">Panitia</td>
                            </tr>
                        </tbody>

                    </table>

                </div>

                <input type="hidden" name="name_x">
                <input type="hidden" name="name_y">

                <input type="hidden" name="category_x">
                <input type="hidden" name="category_y">

                <input type="hidden" name="number_x">
                <input type="hidden" name="number_y">

                <input type="hidden" name="name_color">
                <input type="hidden" name="name_size">

                <input type="hidden" name="category_color">
                <input type="hidden" name="category_size">

                <input type="hidden" name="number_color">
                <input type="hidden" name="number_size">

                <input type="hidden" name="name_left">
                <input type="hidden" name="name_top">

                <input type="hidden" name="category_left">
                <input type="hidden" name="category_top">

                <input type="hidden" name="number_left">
                <input type="hidden" name="number_top">

                <button
                    type="submit"
                    class="mt-6 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">

                    Generate Sertifikat

                </button>

            </form>

        </div>

    </main>

</div>

</body>
</html>