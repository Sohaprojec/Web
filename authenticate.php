<?php
session_start();

// Koneksi ke database (disesuaikan dengan informasi database Anda)
$servername = "localhost";
$username = "db_username";
$password = "db_password";
$dbname = "db_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk mencari pengguna berdasarkan username
$sql = "SELECT * FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Memeriksa apakah password sesuai dengan password yang di-hash di database
    if (password_verify($password, $row['password'])) {
        // Autentikasi berhasil, simpan data pengguna di sesi
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];

        // Redirect ke halaman setelah login (misalnya halaman "kirim-tugas.html")
        header("Location: kirim-tugas.html");
        exit();
    } else {
        // Password salah, redirect kembali ke halaman login
        header("Location: login.php?error=invalid");
        exit();
    }
} else {
    // Pengguna tidak ditemukan, redirect kembali ke halaman login
    header("Location: login.php?error=notfound");
    exit();
}
$stmt->close();
$conn->close();
?>
