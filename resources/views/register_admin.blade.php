<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>

    @vite(['resources/css/app.css'])

</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">

        <h1 class="text-3xl font-bold text-center mb-6">
            Register Admin
        </h1>

        <form>

            <div class="mb-4">
                <label class="block mb-2">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="Masukkan nama">
            </div>

            <div class="mb-4">
                <label class="block mb-2">
                    Email
                </label>

                <input
                    type="email"
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="Masukkan email">
            </div>

            <div class="mb-4">
                <label class="block mb-2">
                    Password
                </label>

                <input
                    type="password"
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="Masukkan password">
            </div>

            <div class="mb-6">
                <label class="block mb-2">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="Konfirmasi password">
            </div>

            <button
                type="submit"
                class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700">
                Register
            </button>

        </form>

        <p class="text-center mt-4 text-gray-600">
            Sudah punya akun?
            <a href="/login_admin" class="text-blue-600">
                Login
            </a>
        </p>

    </div>

</body>
</html>