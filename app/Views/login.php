<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <!-- ================= LOGIN CARD ================= -->
    <div class="bg-white p-8 rounded shadow w-96">

        <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">
            Login Admin
        </h2>

        <!-- ================= ERROR MESSAGE ================= -->
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif ?>

        <!-- ================= FORM ================= -->
        <form method="post" action="/login">

            <?= csrf_field(); ?>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Username
                </label>
                <input type="text"
                       name="username"
                       required
                       class="border rounded p-2 w-full
                              focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium mb-1">
                    Password
                </label>
                <input type="password"
                       name="password"
                       required
                       class="border rounded p-2 w-full
                              focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <button type="submit"
                    class="bg-blue-600 text-white w-full py-2 rounded hover:bg-blue-700 transition">
                Login
            </button>

        </form>

    </div>

</body>
</html>
