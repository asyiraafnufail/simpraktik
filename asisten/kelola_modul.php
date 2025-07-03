<?php
$pageTitle = 'Kelola Modul Praktikum';
$activePage = 'modul';
require_once 'templates/header.php';
require_once '../config.php';

// --- LOGIKA UNTUK MENAMBAHKAN MODUL BARU ---
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_modul'])) {
    $id_praktikum = $_POST['id_praktikum'];
    $nama_modul = $_POST['nama_modul'];
    $deskripsi = $_POST['deskripsi'];
    $file_materi_path = '';

    // Cek apakah ada file yang di-upload
    if (isset($_FILES['file_materi']) && $_FILES['file_materi']['error'] == 0) {
        $target_dir = "../uploads/materi/";
        // Membuat nama file unik untuk menghindari tumpukan file dengan nama sama
        $file_materi_path = time() . '_' . basename($_FILES["file_materi"]["name"]);
        
        // Pindahkan file dari temporary location ke folder uploads/materi
        move_uploaded_file($_FILES["file_materi"]["tmp_name"], $target_dir . $file_materi_path);
    }

    // Memasukkan data ke database
    $stmt = $conn->prepare("INSERT INTO modul (id_praktikum, nama_modul, deskripsi, file_materi) VALUES (?, ?, ?, ?)");
    // Perbaikan: 'file_materi' bukan 'file_mteri'
    $stmt->bind_param("isss", $id_praktikum, $nama_modul, $deskripsi, $file_materi_path);
    $stmt->execute();
    $stmt->close();
    
    // Redirect kembali ke halaman ini agar form bersih
    header("Location: kelola_modul.php?status=sukses");
    exit();
}

// --- LOGIKA UNTUK MENGHAPUS MODUL ---
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    
    // Opsional: hapus file fisik dari server sebelum menghapus data di DB
    $stmt_select = $conn->prepare("SELECT file_materi FROM modul WHERE id = ?");
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $res = $stmt_select->get_result();
    if($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        if(!empty($row['file_materi']) && file_exists("../uploads/materi/" . $row['file_materi'])) {
            unlink("../uploads/materi/" . $row['file_materi']);
        }
    }
    $stmt_select->close();
    
    // Hapus data dari database
    $stmt_delete = $conn->prepare("DELETE FROM modul WHERE id = ?");
    $stmt_delete->bind_param("i", $id);
    $stmt_delete->execute();
    $stmt_delete->close();
    
    header("Location: kelola_modul.php?status=dihapus");
    exit();
}
?>

<div class="bg-white p-8 rounded-2xl shadow-lg mb-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Modul Baru</h2>
    
    <?php if(isset($_GET['status']) && $_GET['status'] == 'sukses'): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
            <p class="font-bold">Berhasil!</p>
            <p>Modul baru telah berhasil ditambahkan.</p>
        </div>
    <?php endif; ?>

    <form action="kelola_modul.php" method="POST" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label for="id_praktikum" class="block font-semibold text-gray-700 mb-1">Pilih Mata Praktikum</label>
            <select name="id_praktikum" id="id_praktikum" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-[#8E44AD]" required>
                <option value="">-- Pilih Praktikum --</option>
                <?php
                $praktikum_list = $conn->query("SELECT id, nama_praktikum FROM mata_praktikum ORDER BY nama_praktikum");
                while($p = $praktikum_list->fetch_assoc()) {
                    echo "<option value='{$p['id']}'>".htmlspecialchars($p['nama_praktikum'])."</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label for="nama_modul" class="block font-semibold text-gray-700 mb-1">Nama Modul (Contoh: Modul 1 - HTML Dasar)</label>
            <input type="text" name="nama_modul" id="nama_modul" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8E44AD]" required>
        </div>
        <div>
            <label for="file_materi" class="block font-semibold text-gray-700 mb-1">File Materi (PDF/DOCX, Opsional)</label>
            <input type="file" name="file_materi" id="file_materi" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
        </div>
        <div>
            <label for="deskripsi" class="block font-semibold text-gray-700 mb-1">Deskripsi Singkat</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8E44AD]"></textarea>
        </div>
        <button type="submit" name="submit_modul" class="w-full btn-primary text-white font-bold py-3 px-4 rounded-lg hover:opacity-90 transition-opacity">
            + Tambahkan Modul
        </button>
    </form>
</div>

<div class="bg-white p-8 rounded-2xl shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Daftar Modul</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="border-b-2 border-gray-200">
                <tr>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm text-gray-600">Praktikum</th>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm text-gray-600">Nama Modul</th>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm text-gray-600">File</th>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <?php
                $sql = "SELECT m.*, mp.nama_praktikum FROM modul m JOIN mata_praktikum mp ON m.id_praktikum = mp.id ORDER BY mp.nama_praktikum, m.created_at DESC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0):
                    while($row = $result->fetch_assoc()): ?>
                    <tr class="border-b border-gray-100 hover:bg-purple-50">
                        <td class="py-4 px-4 text-sm text-gray-500"><?php echo htmlspecialchars($row['nama_praktikum']); ?></td>
                        <td class="py-4 px-4 font-semibold"><?php echo htmlspecialchars($row['nama_modul']); ?></td>
                        <td class="py-4 px-4">
                            <?php if(!empty($row['file_materi'])): ?>
                            <a href="../uploads/materi/<?php echo $row['file_materi']; ?>" target="_blank" class="text-purple-600 hover:underline text-sm">Unduh</a>
                            <?php else: ?>
                            <span class="text-gray-400 text-sm">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="py-4 px-4">
                             <a href="kelola_modul.php?hapus=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus modul ini?')" class="bg-red-500 text-white py-1 px-3 rounded-md text-xs font-semibold hover:bg-red-600">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile;
                else: ?>
                    <tr><td colspan="4" class="text-center py-6 text-gray-500">Belum ada modul yang ditambahkan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$conn->close();
require_once 'templates/footer.php';
?>