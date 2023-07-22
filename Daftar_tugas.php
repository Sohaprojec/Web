<!DOCTYPE html>

<?php
session_start();

// Periksa apakah sesi pengguna telah terautentikasi
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<html>
<head>
    <title>Daftar Tugas Diterima</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>Daftar Tugas Diterima</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.html">Beranda</a></li>
            <li><a href="tugas.html">Penerimaan Tugas</a></li>
            <li><a href="kirim-tugas.html">Kirim Tugas</a></li>
        </ul>
    </nav>
    <section>
        <h2>Daftar Tugas</h2>
        <div id="filter">
            <label for="search">Cari Tugas:</label>
            <input type="text" id="search" onkeyup="searchTugas()" placeholder="Masukkan nama tugas">
        </div>
        <ul id="daftarTugas">
            <?php
            // Daftar tugas yang telah diterima akan diambil dari folder "tugas"
            $targetDir = "tugas/";
            $daftarTugas = scandir($targetDir);

            // Loop untuk menampilkan daftar tugas yang diterima
            foreach ($daftarTugas as $tugas) {
                if ($tugas !== '.' && $tugas !== '..') {
                    echo "<li><a href='$targetDir$tugas' target='_blank'>$tugas</a></li>";
                }
            }
            ?>
        </ul>
    </section>
    <footer>
        <p>Hak Cipta &copy; 2023 Daftar Tugas.</p>
    </footer>
    <script>
        function searchTugas() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            ul = document.getElementById("daftarTugas");
            li = ul.getElementsByTagName("li");

            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
