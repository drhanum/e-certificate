<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    @vite(['resources/css/app.css', 'resources/js/logout-modal.js'])
    @php
        use App\Models\Certificate;

        $totalParticipants = Certificate::count();
        // Count distinct combinations of event_name, organizer_name and event_date
        $totalEvents = Certificate::select('event_name', 'organizer_name', 'event_date')
            ->groupBy('event_name', 'organizer_name', 'event_date')
            ->get()
            ->count();
    @endphp
</head>
<body class="bg-gray-100">

<div class="flex">

    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-white text-black fixed flex flex-col">

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
               class="inline-flex w-56 h-12 items-center justify-center rounded-xl bg-gray-100 text-center hover:bg-blue-600 hover:text-white transition">
                Data Sertifikat
            </a>

        </nav>

        <div class="p-5 border-t">
            <button id="logoutButton"
                class="w-full bg-red-500 text-white px-4 py-3 rounded-lg hover:bg-red-600">
                Logout
            </button>

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

    </aside>

    <!-- Content -->
    <main class="ml-64 p-8 w-full">

        <h1 class="text-3xl font-bold mb-8">
            Dashboard Admin
        </h1>

        <div class="grid grid-cols-2 gap-6">

            <div class="bg-white p-6 rounded-xl shadow">
                <h3>Total Event</h3>
                <p class="text-3xl font-bold mt-2">{{ $totalEvents }}</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3>Total Peserta</h3>
                <p class="text-3xl font-bold mt-2">{{ $totalParticipants }}</p>
            </div>

        </div>

    </main>

</div>

</body>
</html>