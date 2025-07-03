<?php
$pageTitle = 'Dashboard Asisten';
$activePage = 'dashboard';
require_once 'templates/header.php';
?>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <div class="bg-white p-8 rounded-2xl shadow-lg flex items-center space-x-6 transform hover:scale-105 transition-transform duration-300">
        <div class="bg-purple-100 p-4 rounded-full"><img src="https://img.icons8.com/fluency/48/000000/books.png" alt="icon"/></div>
        <div>
            <p class="text-base text-gray-500">Total Modul</p>
            <p class="text-3xl font-bold text-gray-800">12</p>
        </div>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-lg flex items-center space-x-6 transform hover:scale-105 transition-transform duration-300">
        <div class="bg-pink-100 p-4 rounded-full"><img src="https://img.icons8.com/fluency/48/000000/inbox.png" alt="icon"/></div>
        <div>
            <p class="text-base text-gray-500">Laporan Masuk</p>
            <p class="text-3xl font-bold text-gray-800">152</p>
        </div>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-lg flex items-center space-x-6 transform hover:scale-105 transition-transform duration-300">
        <div class="bg-orange-100 p-4 rounded-full"><img src="https://img.icons8.com/fluency/48/000000/document-approve.png" alt="icon"/></div>
        <div>
            <p class="text-base text-gray-500">Belum Dinilai</p>
            <p class="text-3xl font-bold text-gray-800">18</p>
        </div>
    </div>
</div>

<div class="bg-white p-8 rounded-2xl shadow-lg mt-10">
    <h3 class="text-2xl font-bold text-gray-800 mb-6">Aktivitas Laporan Terbaru</h3>
    <div class="space-y-5">
        <div class="flex items-center">
            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-pink-500 to-yellow-500 flex items-center justify-center mr-4 text-white font-bold text-lg">
                BS
            </div>
            <div>
                <p class="text-gray-800"><strong>Budi Santoso</strong> baru saja mengumpulkan laporan untuk <strong>Modul 2</strong></p>
                <p class="text-sm text-gray-500">10 menit lalu</p>
            </div>
        </div>
        <div class="border-t border-gray-100"></div>
        <div class="flex items-center">
            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-purple-500 to-indigo-500 flex items-center justify-center mr-4 text-white font-bold text-lg">
                CL
            </div>
            <div>
                <p class="text-gray-800"><strong>Citra Lestari</strong> baru saja mengumpulkan laporan untuk <strong>Modul 2</strong></p>
                <p class="text-sm text-gray-500">45 menit lalu</p>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'templates/footer.php';
?>