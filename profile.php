<?php

include "koneksi.php";

// Pastikan username diambil dari sesi pengguna
$username = $_SESSION['username'] ?? null;

if (!$username) {
    die("Gagal mendapatkan username dari sesi. Silakan login kembali.");
}

// Proses ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'];
    $foto = $_FILES['profile_picture'];

    // Proses ganti password (opsional)
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT); // Gunakan hashing
        $sql = "UPDATE user SET password = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hashed_password, $username);
        $stmt->execute();
        $stmt->close();
        echo "<p class='text-success'>Password berhasil diperbarui.</p>";
    }

    // Proses unggah foto
    if ($foto['size'] > 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($foto['name']);
        $upload_ok = 1;

        // Validasi: apakah folder uploads tersedia
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Validasi tipe file
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (!in_array($image_file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
            $upload_ok = 0;
            echo "<p class='text-danger'>Hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan.</p>";
        }

        // Hapus foto lama jika ada
        if ($upload_ok) {
            // Ambil foto profil lama dari database
            $sql = "SELECT foto FROM user WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($foto_lama);
            $stmt->fetch();
            $stmt->close();

            // Hapus foto lama jika file ada
            if ($foto_lama && file_exists($foto_lama)) {
                unlink($foto_lama); // Hapus file lama
            }

            // Pindahkan file baru ke folder tujuan
            if (move_uploaded_file($foto['tmp_name'], $target_file)) {
                // Simpan jalur file ke database
                $sql = "UPDATE user SET foto = ? WHERE username = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $target_file, $username);
                $stmt->execute();
                $stmt->close();
                echo "<p class='text-success'>Foto berhasil diunggah.</p>";
            } else {
                echo "<p class='text-danger'>Gagal mengunggah file. Periksa izin folder atau ukuran file.</p>";
            }
        }
    }
}

// Ambil data profil dari database
$sql = "SELECT foto FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($foto_saat_ini);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
       

        <form action="" method="post" enctype="multipart/form-data">
            <!-- Form Ganti Password -->
            <div class="mb-3">
                <label for="new_password" class="form-label">Ganti Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Masukkan password baru (Opsional)" />
            </div>

            <!-- Form Ganti Foto Profil -->
            <div class="mb-3">
                <label for="profile_picture" class="form-label">Ganti Foto Profil</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture" onchange="previewImage(event)" />
            </div>

            

            <!-- Menampilkan Foto Profil Saat Ini -->
            <div class="mb-3">
                <label class="form-label">Foto Profil Saat Ini</label>
                <?php
                if (!empty($foto_saat_ini)) {
                    echo "<img src='$foto_saat_ini' alt='Foto Profil' class='img-thumbnail' width='150' />";
                } else {
                    echo "<p>Foto profil tidak ada.</p>";
                }
                ?>
            </div>

            <!-- Tombol Simpan -->
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript untuk menampilkan pratinjau gambar -->
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('profile_preview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
