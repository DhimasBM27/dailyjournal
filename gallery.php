<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th class="w-50">Gambar</th>
            <th class="w-50">Deskripsi</th>
            <th class="w-25">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "koneksi.php";

        // Pagination variables
        $hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
        $limit = 5;
        $limit_start = ($hlm - 1) * $limit;
        $no = $limit_start + 1;
        
        // Query to get gallery items with limit
        $sql = "SELECT * FROM gallery ORDER BY id DESC LIMIT $limit_start, $limit";
        $hasil = $conn->query($sql);
        while ($row = $hasil->fetch_assoc()) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <?php
                    if ($row["image"] != '') {
                        if (file_exists('gallery/' . $row["image"] . '')) {
                    ?>
                            <img src="gallery/<?= $row["image"] ?>" width="150">
                    <?php
                        }
                    }
                    ?>
                </td>
                <td><?= $row["description"] ?></td>
                <td>
                    <a href="#" title="edit" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>"><i class="bi bi-pencil"></i></a>
                    <a href="#" title="delete" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>"><i class="bi bi-x-circle"></i></a>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Galeri</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi</label>
                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                            <textarea class="form-control" name="description" placeholder="Tulis deskripsi..." required><?= $row["description"] ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ganti Gambar</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Gambar Lama</label>
                                            <?php
                                            if ($row["image"] != '') {
                                                if (file_exists('gallery/' . $row["image"] . '')) {
                                            ?>
                                                    <br><img src="gallery/<?= $row["image"] ?>" width="100">
                                            <?php
                                                }
                                            }
                                            ?>
                                            <input type="hidden" name="old_image" value="<?= $row["image"] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" value="Simpan" name="update_gallery" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Edit -->

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="modalHapus<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Galeri</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <p>Yakin akan menghapus gambar ini?</p>
                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                        <input type="hidden" name="image" value="<?= $row["image"] ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <input type="submit" value="Hapus" name="delete_gallery" class="btn btn-danger">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Hapus -->
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<?php 
$sql1 = "SELECT * FROM gallery";
$hasil1 = $conn->query($sql1); 
$total_records = $hasil1->num_rows;
?>
<p>Total Galeri : <?= $total_records ?></p>
<nav class="mb-2">
    <ul class="pagination justify-content-end">
        <?php
        $jumlah_page = ceil($total_records / $limit);
        $jumlah_number = 1;
        $start_number = ($hlm > $jumlah_number) ? $hlm - $jumlah_number : 1;
        $end_number = ($hlm < ($jumlah_page - $jumlah_number)) ? $hlm + $jumlah_number : $jumlah_page;

        if ($hlm == 1) {
            echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        } else {
            $link_prev = ($hlm > 1) ? $hlm - 1 : 1;
            echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item halaman" id="'.$link_prev.'"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for ($i = $start_number; $i <= $end_number; $i++) {
            $link_active = ($hlm == $i) ? ' active' : '';
            echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
        }

        if ($hlm == $jumlah_page) {
            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
        } else {
            $link_next = ($hlm < $jumlah_page) ? $hlm + 1 : $jumlah_page;
            echo '<li class="page-item halaman" id="'.$link_next.'"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            echo '<li class="page-item halaman" id="'.$jumlah_page.'"><a class="page-link" href="#">Last</a></li>';
        }
        ?>
    </ul>
</nav>