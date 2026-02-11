<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Elektronik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- ================= SIDEBAR ================= -->
    <aside class="w-64 bg-blue-600 text-white p-5">

        <h1 class="text-xl font-bold mb-8">Admin Elektronik</h1>

        <nav class="space-y-2">

            <a href="/admin"
               class="block px-3 py-2 rounded transition
               <?= uri_string() == 'admin' ? 'bg-blue-800' : 'hover:bg-blue-700' ?>">
                Dashboard
            </a>

            <a href="/admin/produk"
               class="block px-3 py-2 rounded transition
               <?= uri_string() == 'admin/produk' ? 'bg-blue-800' : 'hover:bg-blue-700' ?>">
                Produk
            </a>

            <a href="/admin/report"
               class="block px-3 py-2 rounded transition
               <?= uri_string() == 'admin/report' ? 'bg-blue-800' : 'hover:bg-blue-700' ?>">
                Laporan
            </a>

        </nav>
    </aside>

    <!-- ================= MAIN AREA ================= -->
    <div class="flex-1 flex flex-col">

        <!-- ================= NAVBAR ================= -->
        <header class="bg-white shadow px-6 py-3 flex items-center justify-between">

            <!-- SEARCH -->
            <div class="w-1/3">
                <input type="text"
                       id="searchInput"
                       placeholder="Search..."
                       class="w-full border rounded px-3 py-2 text-sm
                              focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <!-- RIGHT SIDE -->
            <div class="flex items-center space-x-4 relative">

                <!-- NOTIFICATION -->
                <div class="relative">
                    <button id="notifBtn"
                            class="relative text-gray-600 hover:text-gray-800 transition">
                        🔔
                        <span class="absolute -top-1 -right-2 bg-red-500 text-white text-xs px-1 rounded-full">
                            3
                        </span>
                    </button>

                    <div id="notifMenu"
                         class="hidden absolute right-0 mt-2 w-64 bg-white rounded shadow border z-50">
                        <div class="px-4 py-2 font-semibold border-b">
                            Notifications
                        </div>
                        <div class="px-4 py-2 text-sm hover:bg-gray-100">
                            New order received
                        </div>
                        <div class="px-4 py-2 text-sm hover:bg-gray-100">
                            Product stock is low
                        </div>
                        <div class="px-4 py-2 text-sm hover:bg-gray-100">
                            System update completed
                        </div>
                    </div>
                </div>

                <!-- MESSAGE -->
                <div class="relative">
                    <button id="msgBtn"
                            class="relative text-gray-600 hover:text-gray-800 transition">
                        💬
                        <span class="absolute -top-1 -right-2 bg-blue-500 text-white text-xs px-1 rounded-full">
                            7
                        </span>
                    </button>

                    <div id="msgMenu"
                         class="hidden absolute right-0 mt-2 w-64 bg-white rounded shadow border z-50">
                        <div class="px-4 py-2 font-semibold border-b">
                            Messages
                        </div>
                        <div class="px-4 py-2 text-sm hover:bg-gray-100">
                            Admin: Please check data
                        </div>
                        <div class="px-4 py-2 text-sm hover:bg-gray-100">
                            System: Backup completed
                        </div>
                        <div class="px-4 py-2 text-sm hover:bg-gray-100">
                            Support: Ticket updated
                        </div>
                    </div>
                </div>

                <!-- DIVIDER -->
                <div class="h-6 w-px bg-gray-300"></div>

                <!-- USER INFO -->
                <div class="flex items-center space-x-2">

                    <span class="text-sm text-gray-700 font-medium">
                        <?= esc(session()->get('username')) ?>
                    </span>

                    <a href="/logout"
                       class="text-red-500 text-sm hover:underline">
                        Logout
                    </a>

                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                        👤
                    </div>

                </div>

            </div>
        </header>

        <!-- ================= CONTENT ================= -->
        <main class="flex-1 p-6">
            <?= $this->renderSection('content') ?>
        </main>

    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchInput');
    const notifBtn  = document.getElementById('notifBtn');
    const notifMenu = document.getElementById('notifMenu');
    const msgBtn    = document.getElementById('msgBtn');
    const msgMenu   = document.getElementById('msgMenu');

    // SEARCH FILTER
    if (searchInput) {
        searchInput.addEventListener('keyup', function () {
            const keyword = this.value.toLowerCase();
            document.querySelectorAll('.produk-row').forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(keyword)
                    ? '' : 'none';
            });
        });
    }

    // TOGGLE MENU
    notifBtn?.addEventListener('click', () => {
        notifMenu.classList.toggle('hidden');
        msgMenu.classList.add('hidden');
    });

    msgBtn?.addEventListener('click', () => {
        msgMenu.classList.toggle('hidden');
        notifMenu.classList.add('hidden');
    });

    // CLOSE IF CLICK OUTSIDE
    document.addEventListener('click', (e) => {
        if (!notifBtn.contains(e.target) && !notifMenu.contains(e.target)) {
            notifMenu.classList.add('hidden');
        }
        if (!msgBtn.contains(e.target) && !msgMenu.contains(e.target)) {
            msgMenu.classList.add('hidden');
        }
    });

});
</script>

</body>
</html>
