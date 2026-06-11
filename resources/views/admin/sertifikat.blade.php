<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sertifikat</title>

    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">

<div class="flex">

    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-white shadow fixed">

        <div class="p-5 border-b">
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

    </aside>

    <!-- Content -->
    <main class="ml-64 p-8 w-full">

        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <div class="p-6 border-b flex justify-between items-center">

                <div>
                    <h2 class="text-xl font-bold">
                        Data Event Sertifikat
                    </h2>

                    <p class="text-gray-500 text-sm">
                        Daftar event yang telah dibuat sertifikatnya
                    </p>
                </div>

                <div class="flex gap-3">
                    <button id="deleteEventBtn"
                       class="bg-red-600 text-white px-4 py-2 rounded hidden hover:bg-red-700">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>

                    <input
                        type="text"
                        id="searchEvent"
                        placeholder="Cari event..."
                        class="border rounded-lg px-4 py-2 w-72">
                </div>

            </div>

            @if ($message = Session::get('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 m-4 rounded">
                {{ $message }}
            </div>
            @endif

            @if ($message = Session::get('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 m-4 rounded">
                {{ $message }}
            </div>
            @endif

            <div class="overflow-x-auto">

                <form id="deleteEventForm" method="POST" action="/admin/sertifikat/delete-event">

                    @csrf

                    <table class="w-full">

                        <thead class="bg-gray-50">

                            <tr class="text-gray-600 text-sm">

                                <th class="px-6 py-4 text-center" style="width: 50px;">
                                    <input type="checkbox" id="selectAllEvents" class="cursor-pointer">
                                </th>

                                <th class="px-6 py-4 text-left">
                                    Event
                                </th>

                                <th class="px-6 py-4 text-left">
                                    Penyelenggara
                                </th>

                                <th class="px-6 py-4 text-left">
                                    Tanggal
                                </th>

                                <th class="px-6 py-4 text-center">
                                    Peserta
                                </th>

                                <th class="px-6 py-4 text-center">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($events as $event)

                            <tr class="border-t hover:bg-gray-50 transition">

                                <td class="px-6 py-4 text-center">
                                    <input type="checkbox" name="events[]" value="{{ $event->event_name }}" class="event-checkbox cursor-pointer">
                                </td>

                                <td class="px-6 py-4">

                                    <div class="font-semibold text-gray-800">
                                        {{ $event->event_name }}
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        {{ $event->activity_type ?? 'Kegiatan' }}
                                    </div>

                                </td>

                                <td class="px-6 py-4">
                                    {{ $event->organizer_name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4 text-center">

                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $event->total_peserta }}
                                    </span>

                                </td>

                                <td class="px-6 py-4 text-center">

                                    <a
                                        href="/admin/sertifikat/{{ urlencode($event->event_name) }}"
                                        class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">

                                        Detail

                                    </a>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </form>

            </div>

        </div>

    </main>

</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<script>
    // Select All checkbox for events
    document.getElementById('selectAllEvents').addEventListener('change', function() {
        const isChecked = this.checked;
        document.querySelectorAll('.event-checkbox').forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        toggleDeleteEventButton();
    });

    // Individual event checkbox
    document.querySelectorAll('.event-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', toggleDeleteEventButton);
    });

    function toggleDeleteEventButton() {
        const checkedCount = document.querySelectorAll('.event-checkbox:checked').length;
        const deleteBtn = document.getElementById('deleteEventBtn');
        
        if (checkedCount > 0) {
            deleteBtn.classList.remove('hidden');
        } else {
            deleteBtn.classList.add('hidden');
        }
    }

    // Delete event button click
    document.getElementById('deleteEventBtn').addEventListener('click', function() {
        const checkedCount = document.querySelectorAll('.event-checkbox:checked').length;
        
        if (checkedCount === 0) {
            alert('Pilih minimal satu event untuk dihapus');
            return;
        }

        if (confirm(`Apakah Anda yakin ingin menghapus ${checkedCount} event beserta semua sertifikatnya? Data yang dihapus tidak dapat dikembalikan.`)) {
            document.getElementById('deleteEventForm').submit();
        }
    });

    // Search functionality
    const searchInput = document.getElementById('searchEvent');
    const tableRows = document.querySelectorAll('tbody tr');

    searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();

        tableRows.forEach(row => {
            const eventName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const organizer = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

            if (eventName.includes(searchTerm) || organizer.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>