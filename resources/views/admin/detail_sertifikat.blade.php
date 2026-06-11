<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Detail Sertifikat</title>

    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">

<div class="flex">

    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-white shadow fixed flex flex-col">

        <div class="p-5 border-b border-gray-700">
            <h2 class="text-xl font-bold">
                E-SERTIFIKAT ADMIN
            </h2>
        </div>

        <nav class="mt-5 flex-1 space-y-2 px-4">

            <a href="/admin/dashboard"
               class="inline-flex w-56 h-12 items-center justify-center rounded-xl bg-gray-100 text-center hover:bg-blue-600 hover:text-white transition">
                Dashboard
            </a>

            <a href="/admin/generate"
               class="inline-flex w-56 h-12 items-center justify-center rounded-xl bg-gray-100 text-center hover:bg-blue-600 hover:text-white transition">
                Generate Sertifikat
            </a>

            <a href="/admin/sertifikat"
               class="inline-flex w-56 h-12 items-center justify-center rounded-xl bg-blue-600 text-white text-center transition">
                Data Sertifikat
            </a>

        </nav>

        <div class="p-5 border-t">
            <button id="logoutButton"
                class="w-full bg-red-500 text-white px-4 py-3 rounded-lg hover:bg-red-600">
                Logout
            </button>
        </div>

    </aside>

    <!-- Content -->
    <main class="ml-64 p-8 w-full">

        <div class="flex justify-between items-center mb-6">

            <div>

                <h1 class="text-3xl font-bold">
                    {{ $certificates->first()->event_name }}
                </h1>

                <p class="text-gray-500">
                    {{ $certificates->first()->organizer_name }}
                </p>

            </div>

            <div class="flex gap-3">

                <button id="deleteBtn"
                   class="bg-red-600 text-white px-4 py-2 rounded hidden hover:bg-red-700">
                    <i class="fa-solid fa-trash"></i> Hapus
                </button>

                <a href="/admin/sertifikat"
                   class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                    Kembali
                </a>

            </div>

        </div>

        @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ $message }}
        </div>
        @endif

        @if ($message = Session::get('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ $message }}
        </div>
        @endif

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <form id="deleteForm" method="POST" action="/admin/sertifikat/delete">

                @csrf

                <table class="w-full">

                    <thead class="bg-gray-200">

                        <tr>

                            <th class="p-3 text-center" style="width: 50px;">
                                <input type="checkbox" id="selectAll" class="cursor-pointer">
                            </th>

                            <th class="p-3 text-left">No</th>
                            <th class="p-3 text-left">Nama</th>
                            <th class="p-3 text-left">Email</th>
                            <th class="p-3 text-left">Kategori</th>
                            <th class="p-3 text-left">Nomor Sertifikat</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($certificates as $certificate)

                        <tr class="border-t hover:bg-gray-50">

                            <td class="p-3 text-center">
                                <input type="checkbox" name="ids[]" value="{{ $certificate->id }}" class="certificate-checkbox cursor-pointer">
                            </td>

                            <td class="p-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="p-3">
                                {{ $certificate->name }}
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

                            <td class="text-center">

                                <div class="flex center gap-2">

                                    <a href="{{ route('certificate.detail', $certificate->id) }}"
                                    class="bg-blue-100 text-blue-600 p-2 rounded-lg hover:bg-blue-200 transition">

                                        <i class="fa-solid fa-eye"></i>

                                    </a>

                                    <a href="{{ route('certificate.download', $certificate->id) }}"
                                    class="bg-green-100 text-green-600 rounded-lg px-3 py-2 hover:bg-green-200 transition">

                                        <i class="fa-solid fa-download"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </form>

        </div>

        <script>
            // Select All checkbox
            document.getElementById('selectAll').addEventListener('change', function() {
                const isChecked = this.checked;
                document.querySelectorAll('.certificate-checkbox').forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
                toggleDeleteButton();
            });

            // Individual checkbox
            document.querySelectorAll('.certificate-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', toggleDeleteButton);
            });

            function toggleDeleteButton() {
                const checkedCount = document.querySelectorAll('.certificate-checkbox:checked').length;
                const deleteBtn = document.getElementById('deleteBtn');
                
                if (checkedCount > 0) {
                    deleteBtn.classList.remove('hidden');
                } else {
                    deleteBtn.classList.add('hidden');
                }
            }

            // Delete button click
            document.getElementById('deleteBtn').addEventListener('click', function() {
                const checkedCount = document.querySelectorAll('.certificate-checkbox:checked').length;
                
                if (checkedCount === 0) {
                    alert('Pilih minimal satu sertifikat untuk dihapus');
                    return;
                }

                if (confirm(`Apakah Anda yakin ingin menghapus ${checkedCount} sertifikat? Data yang dihapus tidak dapat dikembalikan.`)) {
                    document.getElementById('deleteForm').submit();
                }
            });

            lucide.createIcons();
        </script>

    </main>

</div>

</body>
</html>