<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitasi dan Validasi Nama
    $nama = htmlspecialchars(trim($_POST["nama"]));

    // Pastikan folder "tugas" sudah ada dan dapat ditulisi (writable).
    $targetDir = "tugas/";

    // File tugas yang diunggah akan disimpan dengan nama yang unik.
    $namaFile = uniqid() . "_" . basename($_FILES["tugas"]["name"]);
    $targetPath = $targetDir . $namaFile;

    // Memeriksa apakah file yang diunggah adalah file tugas yang valid.
    $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
    $allowedTypes = array("pdf", "doc", "docx", "txt"); // Tipe file yang diizinkan.
    <?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Proses pengiriman tugas seperti sebelumnya

    if (move_uploaded_file($_FILES["tugas"]["tmp_name"], $targetPath)) {
        // File berhasil diunggah dan disimpan. Anda dapat menyimpan informasi tugas ini ke database jika diperlukan.
        // Redirect kembali ke halaman "kirim-tugas.html" dengan status sukses
        header("Location: kirim-tugas.html?status=success");
        exit();
    } else {
        // Terjadi kesalahan saat mengunggah tugas.
        // Redirect kembali ke halaman "kirim-tugas.html" dengan status kesalahan
        header("Location: kirim-tugas.html?status=error");
        exit();
    }
}
?

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["tugas"]["tmp_name"], $targetPath)) {
            // File berhasil diunggah dan disimpan. Anda dapat menyimpan informasi tugas ini ke database jika diperlukan.
            echo "Tugas berhasil diunggah!";
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah tugas.";
        }
    } else {
        echo "Tipe file yang diunggah tidak diizinkan.";
    }
}
?>
