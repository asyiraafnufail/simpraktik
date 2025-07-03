<?php
$pageTitle = 'Dashboard';
$activePage = 'dashboard';
require_once 'templates/header_mahasiswa.php';
?>
<div class="bg-gradient-to-r from-[#A26BFF] to-[#8E44AD] text-white p-8 rounded-2xl shadow-lg mb-8">
    <h1 class="text-4xl font-bold">Selamat Datang, <?php echo htmlspecialchars($_SESSION['nama']); ?>!</h1>
    <p class="mt-2 text-lg opacity-90">Terus pantau progres dan tugas praktikum Anda di sini.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-md flex items-center space-x-4 transform hover:scale-105 transition-transform">
        <div class="bg-pink-100 p-4 rounded-full"><img src="https://img.icons8.com/fluency/48/000000/classroom.png" alt="icon"/></div>
        <div>
            <p class="text-sm text-gray-500">Praktikum Diikuti</p>
            <p class="text-3xl font-bold text-gray-800">3</p>
        </div>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-md flex items-center space-x-4 transform hover:scale-105 transition-transform">
        <div class="bg-green-100 p-4 rounded-full"><img src="https://img.icons8.com/fluency/48/000000/task-completed.png" alt="icon"/></div>
        <div>
            <p class="text-sm text-gray-500">Tugas Selesai</p>
            <p class="text-3xl font-bold text-gray-800">8</p>
        </div>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-md flex items-center space-x-4 transform hover:scale-105 transition-transform">
        <div class="bg-yellow-100 p-4 rounded-full"><img src="https://img.icons8.com/fluency/48/000000/sand-watch.png" alt="icon"/></div>
        <div>
            <p class="text-sm text-gray-500">Menunggu Penilaian</p>
            <p class="text-3xl font-bold text-gray-800">4</p>
        </div>
    </div>
</div>

<div class="bg-white p-6 rounded-2xl shadow-md">
    <h3 class="text-2xl font-bold text-gray-800 mb-5">Aktivitas & Notifikasi</h3>
    <ul class="space-y-4">
        <li class="flex items-center p-4 border border-gray-200 rounded-lg bg-gray-50">
            <span class="text-2xl mr-4">🎉</span>
            <div>
                Nilai untuk laporan <a href="#" class="font-semibold text-purple-600 hover:underline">Modul 1: HTML & CSS</a> telah diberikan. Cek sekarang!
            </div>
        </li>
        <li class="flex items-center p-4 border border-gray-200 rounded-lg bg-gray-50">
            <span class="text-2xl mr-4">⏳</span>
            <div>
                Batas waktu pengumpulan <a href="#" class="font-semibold text-purple-600 hover:underline">Modul 2: PHP Native</a> tinggal <strong>1 hari lagi!</strong>
            </div>
        </li>
        <li class="flex items-center p-4 border border-gray-200 rounded-lg bg-gray-50">
            <span class="text-2xl mr-4">✅</span>
            <div>
                Anda berhasil mendaftar pada mata praktikum <a href="#" class="font-semibold text-purple-600 hover:underline">Jaringan Komputer</a>.
            </div>
        </li>
    </ul>
</div>

<?php
require_once 'templates/footer_mahasiswa.php';
?>