<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">

<div class="flex">

    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-gray-900 text-white fixed">

        <div class="p-5 border-b border-gray-700">
            <h2 class="text-xl font-bold">
                E-SERTIFIKAT ADMIN
            </h2>
        </div>

        <nav class="mt-5">

            <a href="/admin/dashboard"
               class="block px-5 py-3 hover:bg-gray-800">
                Dashboard
            </a>

            <a href="/admin/generate"
               class="block px-5 py-3 hover:bg-gray-800">
                Generate Sertifikat
            </a>

            <a href="/admin/sertifikat"
               class="block px-5 py-3 hover:bg-gray-800">
                Data Sertifikat
            </a>

            <a href="/admin/template"
               class="block px-5 py-3 hover:bg-gray-800">
                Template Sertifikat
            </a>

            <a href="/admin/profile"
               class="block px-5 py-3 hover:bg-gray-800">
                Profile
            </a>

        </nav>

    </aside>

    <!-- Content -->
    <main class="ml-64 p-8 w-full">

        <h1 class="text-3xl font-bold mb-8">
            Dashboard Admin
        </h1>

        <div class="grid grid-cols-3 gap-6">

            <div class="bg-white p-6 rounded-xl shadow">
                <h3>Total Sertifikat</h3>
                <p class="text-3xl font-bold mt-2">0</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3>Total Peserta</h3>
                <p class="text-3xl font-bold mt-2">0</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3>Total Template</h3>
                <p class="text-3xl font-bold mt-2">1</p>
            </div>

        </div>

    </main>

</div>

</body>
</html>