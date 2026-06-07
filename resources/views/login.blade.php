<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">

        <h1 class="text-3xl font-bold text-center mb-6">
            Login
        </h1>

        <form action="/login" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-2">Email</label>

                <input
                    type="email"
                    name="email"
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="Masukkan email">
            </div>

            <div class="mb-6">
                <label class="block mb-2">Password</label>

                <input
                    type="password"
                    name="password"
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="Masukkan password">
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">
                Login
            </button>

        </form>

        <p class="text-center mt-4 text-gray-600">
            Belum punya akun?
            <a href="/register" class="text-blue-600">
                Register
            </a>
        </p>

    </div>

</body>
</html>